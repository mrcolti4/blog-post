<?php

namespace App\Models;

use App\Traits\Likeable;
use App\Traits\Post\Images;
use App\Traits\Post\Relations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Likeable, Searchable;
    use Images, Relations;

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

    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "category_slug" => $this->category_slug,
        ];
    }
}
