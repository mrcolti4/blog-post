<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View as View;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::latest()->with('user')->paginate(12);
        $posts->onEachSide(3);

        return view("app.user.posts", [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("app.user.post-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $attrs = $request->validate([
            'title' => 'required',
            'poster_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            "content" => "required"
        ]);
        $hero_image = $request->file('hero_image');
        $poster_image = $request->file('poster_image');

        $hero_path = $hero_image->storeAs("images", time() . '.' . $request->hero_image->getClientOriginalExtension(), 'public');
        $poster_path = $poster_image->storeAs("images", time() . '.' . $request->poster_image->getClientOriginalExtension(), 'public');

        $post = $user->posts()->create([
            "title" => $request->title,
            "body" => $request->content
        ]);

        $post->images()->createMany([
            [
                "path" => $hero_path,
                "alt" => "Hero image",
                "type" => "hero"
            ],
            [
                "path" => $poster_path,
                "alt" => "Poster image",
                "type" => "poster"
            ]
        ]);

        return back()->with("success", "You did publish the post");
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
