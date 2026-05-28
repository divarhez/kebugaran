<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyHealthEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'sleep_hours',
        'water_glasses',
        'steps',
        'calories',
        'mood',
        'note',
        'points_earned',
    ];

    protected $casts = [
        'date' => 'date',
        'sleep_hours' => 'float',
        'water_glasses' => 'integer',
        'steps' => 'integer',
        'calories' => 'integer',
        'points_earned' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
