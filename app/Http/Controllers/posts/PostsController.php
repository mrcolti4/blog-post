<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostNotification;
use App\Services\UploadImageService;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\View\View as View;
use Notification;

class PostsController extends Controller
{
    public function __construct(
        protected UploadImageService $service
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::latest()->with('user')->paginate(12);
        $posts->onEachSide(3);

        return view("app.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("app.posts.create");
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
        $followers = $user->followers()->get();
        DB::beginTransaction();

        try {
            $post = $user->posts()->create([
                "title" => $attrs["title"],
                "body" => $attrs["content"],
                "category_id" => 1,
            ]);

            $posterImage = $this->service->upload($request->file('poster_image'), "poster");
            $heroImage = $this->service->upload($request->file('hero_image'), "background");

            $post->images()->createMany([
                $posterImage,
                $heroImage,
            ]);

            $post->hero_image = $heroImage["url"];
            $post->poster_image = $posterImage["url"];
            $post->save();

            DB::commit();
            Notification::send($followers, new NewPostNotification($post));

            return back()->with("success", "You did publish the post");
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());

            return back()->with("error", "Something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        $otherPosts = Post::latest()
            ->where("user_id", $post->user->id)
            ->where("id", "!=", $post->id)
            ->take(5)
            ->get();
        $comments = Comment::where("post_id", $post->id)
            ->with("user.profile", "activities")
            ->orderByDesc('created_at')
            ->get();

        return view("app.posts.show", compact("post", "otherPosts", "comments"));
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
