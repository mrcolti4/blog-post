<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use CanResetPassword;

    protected $guarded = [];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function latestPosts(): HasMany
    {
        return $this->posts()->orderBy('created_at', 'desc');
    }

    public function favoritePosts()
    {
        return $this->morphedByMany(Post::class, 'target', 'activities')
            ->where('activities.action_type', 'like');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function followers()
    {
        return $this->morphedByMany(User::class, 'target', 'activities')
            ->where('activities.action_type', 'follow');
    }

    public function getRouteKeyName(): string
    {
        return "username";
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
