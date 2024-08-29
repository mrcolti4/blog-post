<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(50)->create();
        Category::factory()->count(10)->create();
        foreach ($users as $user) {
            Profile::factory()->create(["user_id" => $user->id]);
            $posts = Post::factory()
                ->for($user)
                ->count(random_int(0, 5))
                ->create();

            foreach ($posts as $post) {
                Comment::factory()
                    ->for($post)
                    ->for($user)
                    ->count(random_int(0, 5))
                    ->create();
            }
        }
    }
}
