<?php

namespace App\Models;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Likeable;

    const EXCERPT_LENGTH = 100;
    const TITLE_LENGTH = 30;

    protected $target_type = "post";
    protected $guarded = [];

    public function excerpt()
    {
        return Str::limit($this->body, Post::EXCERPT_LENGTH);
    }

    public function short_title()
    {
        return Str::limit($this->title, Post::TITLE_LENGTH);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'target');
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

    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body
        ];
    }
}
