<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UsersPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $posts = Post::where("user_id", $user->id)->paginate(10);
        return view("app.posts.index", [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        $other_posts = Post::latest()
            ->where("user_id", $post->user->id)
            ->where("id", "!=", $post->id)
            ->take(5)
            ->get();
        $comments = Comment::where("post_id", $post->id)
            ->with("user.profile", "activities")
            ->orderByDesc('created_at')
            ->get();

        return view("app.posts.show", [
            "post" => $post,
            "images" => $post->images,
            "comments" => $comments,
            "other_posts" => $other_posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
