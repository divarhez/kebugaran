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
        $today = now()->toDateString();

        $tasks = HealthTask::orderBy('points', 'desc')->get();
        $completedToday = TaskCompletion::where('user_id', $user->id)
            ->where('date', $today)
            ->pluck('health_task_id')
            ->all();

        $entry = $user->dailyEntries()->firstWhere('date', $today);
        $weeklyEntries = $user->dailyEntries()->orderByDesc('date')->take(7)->get();
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
