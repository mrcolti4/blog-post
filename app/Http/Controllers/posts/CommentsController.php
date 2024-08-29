<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Post $post): JsonResponse
    {
        $sort = $request->input('sort', 'latest');
        $comments = Comment::where("post_id", $post->id)->with("user.profile")->orderBy($sort === 'popular' ? 'likes' : 'created_at', 'desc')->get();

        $html = view("components.user.comments", compact('comments'))->render();

        return response()->json(["body" => $html]);
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
    public function store(Request $request, Post $post)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
