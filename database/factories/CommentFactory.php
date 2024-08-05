<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "profile_id" => Profile::all()->random(),
            "post_id" => Post::all()->random(),
            "body" => fake()->realText(200),
            "likes" => fake()->numberBetween(-100, 100)
        ];
    }
}
