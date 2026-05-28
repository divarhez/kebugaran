<?php

namespace App\Http\Controllers;

use App\Models\DailyHealthEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthEntryController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $data = $request->validate([
            'sleep_hours' => ['required', 'numeric', 'between:0,24'],
            'water_glasses' => ['required', 'integer', 'min:0', 'max:20'],
            'steps' => ['required', 'integer', 'min:0'],
            'calories' => ['required', 'integer', 'min:0'],
            'mood' => ['required', 'string', 'max:60'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $points = $this->calculatePoints($data);

        $entry = DailyHealthEntry::updateOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            array_merge($data, ['points_earned' => $points])
        );

        $originalPoints = $entry->getOriginal('points_earned') ?? 0;
        $diff = $points - $originalPoints;

        if ($diff !== 0) {
            $user->increment('experience', $diff);
        }

        return back()->with('status', 'Data kesehatan harian berhasil tersimpan.');
    }

    protected function calculatePoints(array $data): int
    {
        $points = 0;

        if ($data['water_glasses'] >= 8) {
            $points += 20;
        }

        if ($data['sleep_hours'] >= 7) {
            $points += 20;
        }

        if ($data['steps'] >= 7000) {
            $points += 15;
        }

        if ($data['calories'] > 0 && $data['calories'] <= 2400) {
            $points += 15;
        }

        if (strtolower($data['mood']) !== 'buruk') {
            $points += 10;
        }

        return $points;
    }
}
