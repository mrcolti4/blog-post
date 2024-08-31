<?php

namespace App\DTOs;

use App\Http\Requests\PostRequest;

readonly class PostDto
{
    public function __construct(
        public string $title,
        public string $body,
        public string $category_id,
        public string $poster_image,
        public string $hero_image
    )
    {
    }

    public function fromApp(PostRequest $request)
    {
        return new self(
            $request->validated('title'),
            $request->validated('body'),
            $request->validated('category_id'),
            $request->validated('poster_image'),
            $request->validated('hero_image')
        );
    }
}
