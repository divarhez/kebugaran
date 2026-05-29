<?php

namespace App\Http\Controllers;

use App\Models\HealthTask;
use App\Models\TaskCompletion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $today = now()->toDateString();

        $tasks = HealthTask::orderBy('points', 'desc')->get();
        $completedToday = TaskCompletion::where('user_id', $user->id)
            ->where('date', $today)
            ->pluck('health_task_id')
            ->all();

        $entry = $user->dailyEntries()->firstWhere('date', $today);
        $weeklyEntries = $user->dailyEntries()
            ->whereBetween('date', [now()->subDays(6)->toDateString(), $today])
            ->orderBy('date')
            ->get();
        $weeklyXp = $weeklyEntries->sum('points_earned');
        $streak = $this->calculateCurrentStreak($weeklyEntries, $today);

        return view('dashboard', [
            'user' => $user,
            'tasks' => $tasks,
            'completedToday' => $completedToday,
            'entry' => $entry,
            'weeklyEntries' => $weeklyEntries,
            'weeklyXp' => $weeklyXp,
            'streak' => $streak,
            'today' => $today,
        ]);
    }

    public function updateGoals(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'goal_weight' => ['nullable', 'numeric', 'min:0'],
            'goal_water' => ['nullable', 'integer', 'min:0'],
            'goal_steps' => ['nullable', 'integer', 'min:0'],
            'goal_sleep' => ['nullable', 'numeric', 'min:0', 'max:24'],
        ]);

        $user->update($data);

        return back()->with('status', 'Target kesehatan berhasil diperbarui.');
    }

    private function calculateCurrentStreak($entries, $today)
    {
        $streak = 0;
        $expectedDate = now()->parse($today);

        foreach ($entries as $entry) {
            if (! $entry->date instanceof \Illuminate\Support\Carbon) {
                $entryDate = now()->parse($entry->date);
            } else {
                $entryDate = $entry->date;
            }

            if ($entryDate->isSameDay($expectedDate)) {
                $streak++;
                $expectedDate->subDay();
                continue;
            }

            if ($entryDate->lt($expectedDate)) {
                break;
            }
        }

        return $streak;
    }
}
