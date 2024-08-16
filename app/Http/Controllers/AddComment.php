<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class AddComment extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Post $post)
    {
        $request->validate([
            "body" => "required|string"
        ]);

        $post->comments()->create([
            "body" => $request->body,
            "user_id" => Auth::user()->id
        ]);

        return back()->with("success", "You did comment this post");
    }
}
