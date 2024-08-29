<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
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

        return view("app.posts.index", [
            "posts" => $posts
        ]);
    }
}
