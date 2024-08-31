<?php

namespace App\Http\Controllers\posts;

use App\Exceptions\ImageUploadException;
use App\Exceptions\PostNotCreatedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use App\Services\UploadImageService;
use Exception;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function __construct(
        protected UploadImageService $uploadImageService,
        protected PostService $postService
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
        $categories = Category::all();
        return view("app.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $this->postService->store($request);
            return back()->with("success", "You did create the post");
        } catch (PostNotCreatedException $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("app.posts.show", $this->postService->show($post));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }

        $categories = Category::all();
        return view("app.posts.edit", compact("categories", "post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $this->postService->update($request, $post);
            return back()->with("success", "You did update the post");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (request()->user()->cannot('delete', $post)) {
            return back()->with("error", "You can't delete this post");
        }
        try {
            $this->postService->destroy($post);
            return redirect()->to("/posts")->with("success", "You did delete the post");
        } catch (Exception $th) {
            return back()->with("error", $th->getMessage());
        } catch (ImageUploadException $th) {
            return back()->with("error", $th->getMessage());
        }
    }
}
