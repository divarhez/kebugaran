<?php

namespace App\Http\Controllers;

use App\Models\HealthTask;
use App\Models\TaskCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthTaskController extends Controller
{
    public function complete(HealthTask $task)
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $alreadyCompleted = TaskCompletion::where('user_id', $user->id)
            ->where('health_task_id', $task->id)
            ->where('date', $today)
            ->exists();

        if (! $alreadyCompleted) {
            TaskCompletion::create([
                'user_id' => $user->id,
                'health_task_id' => $task->id,
                'date' => $today,
                'points' => $task->points,
                'comment' => 'Selesai pada ' . now()->format('H:i'),
            ]);

            $user->increment('experience', $task->points);
        }

        return back();
    }
}
