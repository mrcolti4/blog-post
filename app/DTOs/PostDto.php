<?php

namespace App\DTOs;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\UploadedFile;

class PostDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $body,
        public readonly string $category_id,
        public readonly ?UploadedFile $poster_image,
        public readonly ?UploadedFile $hero_image
    )
    {
    }

    public static function fromApp(PostRequest|UpdatePostRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            body: $request->validated('body'),
            category_id: $request->validated('category_id'),
            poster_image: $request->validated('poster_image'),
            hero_image: $request->validated('hero_image')
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => $this->category_id,
            'poster_image' => $this->poster_image,
            'hero_image' => $this->hero_image
        ];
    }
}
