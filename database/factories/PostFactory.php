<?php

namespace Database\Factories;

use App\Models\Profile;
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
            "profile_id" => Profile::all()->random(),
            "title" => fake()->realTextBetween(10, 100),
            "body" => fake()->realText(),
            "image" => fake()->imageUrl(),
            "likes" => fake()->numberBetween(-100, 1000)
        ];
    }
}
