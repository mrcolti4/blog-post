<?php

namespace App\Models;

use App\Traits\User\Activities;
use App\Traits\User\Notifications;
use App\Traits\User\Posts;
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
    use Notifications, Posts, Activities;

    protected $guarded = [];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
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
