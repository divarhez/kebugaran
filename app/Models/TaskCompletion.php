<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'health_task_id',
        'date',
        'points',
        'comment',
    ];

    public function task()
    {
        return $this->belongsTo(HealthTask::class, 'health_task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
