<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::all()->random(),
            "title" => fake()->realTextBetween(10, 100),
            "body" => fake()->realText(),
            "poster_image" => fake()->imageUrl(),
            "hero_image" => fake()->imageUrl(),
            "likes" => fake()->numberBetween(-100, 1000)
        ];
    }
}
