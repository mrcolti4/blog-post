<?php

namespace App\Traits\User;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Posts
{
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function latestPosts(): HasMany
    {
        return $this->posts()->orderBy('created_at', 'desc');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
