<?php

namespace App\Http\Controllers\posts;

use App\DTOs\PostDto;
use App\Exceptions\CannotUpdatePostException;
use App\Exceptions\ImageUploadException;
use App\Exceptions\PostNotCreatedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function __construct(
        protected PostService $postService
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("app.posts.index", $this->postService->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("app.posts.create", $this->postService->create());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $post = $this->postService->store(PostDto::fromApp($request));
            return redirect()->route("posts.show", ["post" => $post->id])
            ->with("success", "You did create the post");
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
        return view("app.posts.edit", $this->postService->edit($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $this->postService->update(PostDto::fromApp($request), $post);
            return back()->with("success", "You did update the post");
        } catch (CannotUpdatePostException $th) {
            return back()->with("error", $th->getMessage());
        } catch (\Throwable $th) {
            return back()->with("error", $th);
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
            return redirect()->route("posts.index")
                ->with("success", "You did delete the post");
        } catch (Exception $th) {
            return back()->with("error", $th->getMessage());
        } catch (ImageUploadException $th) {
            return back()->with("error", $th->getMessage());
        }
    }
}
