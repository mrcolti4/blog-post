<?php

namespace App\Traits\User;

use App\Models\Activity;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Activities
{
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function followers()
    {
        return $this->morphedByMany(User::class, 'target', 'activities', 'target_id', 'user_id')
            ->where('action_type', 'follow');
    }

    public function favoritePosts()
    {
        return $this->morphedByMany(Post::class, 'target', 'activities')
            ->where('activities.action_type', 'like');
    }
}
