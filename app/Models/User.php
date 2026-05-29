<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\TaskCompletion;
use App\Models\DailyHealthEntry;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'experience',
        'role',
        'goal_weight',
        'goal_water',
        'goal_steps',
        'goal_sleep',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'goal_weight' => 'float',
            'goal_water' => 'integer',
            'goal_steps' => 'integer',
            'goal_sleep' => 'float',
        ];
    }

    public function taskCompletions()
    {
        return $this->hasMany(TaskCompletion::class);
    }

    public function dailyEntries()
    {
        return $this->hasMany(DailyHealthEntry::class);
    }

    public function getLevelAttribute(): int
    {
        return intdiv($this->experience, 500) + 1;
    }

    public function getExperienceToNextLevelAttribute(): int
    {
        return ($this->level * 500) - $this->experience;
    }

    public function getLevelProgressAttribute(): int
    {
        return (int) round(($this->experience % 500) / 500 * 100);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
