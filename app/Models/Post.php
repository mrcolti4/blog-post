<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const EXCERPT_LENGTH = 100;

    protected $guarded = [];

    public function excerpt()
    {
        return Str::limit($this->body, Post::EXCERPT_LENGTH);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function posterImage()
    {
        return $this->images()->where("type", "poster");
    }

    public function heroImage()
    {
        return $this->images()->where("type", "hero");
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
