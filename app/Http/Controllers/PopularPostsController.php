<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PopularPostsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::where('likes', '>', 100)->orderByDesc('likes')->with('user')->paginate(15);

        return view("app.user.posts", [
            "posts" => $posts
        ]);
    }
}
