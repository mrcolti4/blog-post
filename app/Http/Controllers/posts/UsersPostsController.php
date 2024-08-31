<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;

class UsersPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $posts = Post::where("user_id", $user->id)->paginate(10);
        return view("app.posts.index", [
            "posts" => $posts,
        ]);
    }
}
