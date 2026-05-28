<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'points',
        'target',
    ];

    public function completions()
    {
        return $this->hasMany(TaskCompletion::class);
    }
}
