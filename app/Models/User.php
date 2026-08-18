<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id

 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $total_goals
 * @property int|null $countdown_minutes
 * @property int|null $daily_tasks
 * @property int|null $completed_tasks
 * @property string|null $last_reset_date
 * @property string|null $reward
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['email', 'password', 'countdown_minutes', 'completed_stretch_task_ids', 'total_goals', 'daily_tasks', 'completed_tasks', 'last_reset_date', 'reward', 'created_at', 'updated_at'])]
#[Hidden(['password', 'remember_token','created_at', 'updated_at'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'completed_stretch_task_ids' => 'array',
        ];
    }

    /**
     * @return HasMany<Timecard, $this>
     */
    public function timecards(): HasMany
    {
        return $this->hasMany(Timecard::class);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::length($this->email) > 1
            ? Str::substr($this->email, 0, 1).Str::substr($this->email, -1)
            : $this->email;
    }
}
