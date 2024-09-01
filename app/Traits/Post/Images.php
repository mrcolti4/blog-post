<?php

namespace App\Traits\Post;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Images
{
    public function poster_image()
    {
        return $this->images()->where("type", "poster");
    }

    public function hero_image()
    {
        return $this->images()->where("type", "hero");
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
