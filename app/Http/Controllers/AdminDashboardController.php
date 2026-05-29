<?php

namespace App\Http\Controllers;

use App\Models\DailyHealthEntry;
use App\Models\HealthTask;
use App\Models\TaskCompletion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isAdmin()) {
            abort(403);
        }

        $today = now()->toDateString();
        $weekStart = now()->subDays(6)->toDateString();

        $totalUsers = User::count();
        $newUsersThisWeek = User::where('created_at', '>=', now()->subDays(7))->count();
        $todayEntries = DailyHealthEntry::where('date', $today)->count();
        $todayCompletions = TaskCompletion::where('date', $today)->count();
        $totalTasks = HealthTask::count();
        $totalCompletions = TaskCompletion::count();
        $weeklyActiveUsers = User::whereHas('dailyEntries', function ($query) use ($weekStart, $today) {
            $query->whereBetween('date', [$weekStart, $today]);
        })->count();
        $avgStepsToday = (int) DailyHealthEntry::where('date', $today)->avg('steps');
        $avgSleepToday = (float) DailyHealthEntry::where('date', $today)->avg('sleep_hours');
        $mostActiveUsers = User::orderByDesc('experience')->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $topTasks = HealthTask::withCount(['completions as today_completions' => function ($query) use ($today) {
            $query->where('date', $today);
        }])->orderByDesc('today_completions')->take(5)->get();
        $bestTasksOverall = HealthTask::withCount('completions')->orderByDesc('completions_count')->take(5)->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'newUsersThisWeek' => $newUsersThisWeek,
            'todayEntries' => $todayEntries,
            'todayCompletions' => $todayCompletions,
            'totalTasks' => $totalTasks,
            'totalCompletions' => $totalCompletions,
            'weeklyActiveUsers' => $weeklyActiveUsers,
            'avgStepsToday' => $avgStepsToday,
            'avgSleepToday' => $avgSleepToday,
            'mostActiveUsers' => $mostActiveUsers,
            'recentUsers' => $recentUsers,
            'topTasks' => $topTasks,
            'bestTasksOverall' => $bestTasksOverall,
        ]);
    }
}
