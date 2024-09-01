<?php

namespace App\Services;

use App\DTOs\PostDto;
use App\Exceptions\CannotUpdatePostException;
use App\Exceptions\ImageUploadException;
use App\Exceptions\PostNotCreatedException;
use Exception;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Notification;
use App\Notifications\NewPostNotification;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(protected UploadImageService $uploadImageService)
    {
    }

    public function index(): array
    {
        $posts = Post::latest()->with('user')->paginate(12);
        $posts->onEachSide(3);

        return compact('posts');
    }

    public function create(): array
    {
        $categories = Category::all();
        return compact('categories');
    }

    public function show(Post $post): array
    {
        $post->load(['user.profile', 'comments.user.profile', 'comments.activities']);

        return [
            'post' => $post,
            'otherPosts' => $this->getOtherPosts($post),
            'comments' => $this->getComments($post),
        ];
    }

    public function store(PostDto $dto): Post
    {
        $user = Auth::user();
        DB::beginTransaction();

        try {
            $post = $user->posts()->create([
                "title" => $dto->title,
                "body" => $dto->body,
                "category_id" => $dto->category_id,
            ]);
            // Upload images on Cloudinary
            $posterImage = $this->uploadImageService->upload($dto->poster_image, "poster");
            $heroImage = $this->uploadImageService->upload($dto->hero_image, "hero");

            // Create images related to current post
            $post->images()->createMany([
                $posterImage,
                $heroImage,
            ]);
            // Save image urls to post
            $post->hero_image = $heroImage["url"];
            $post->poster_image = $posterImage["url"];
            $post->save();
            // Notify followers
            $this->notifyFollowers($user, $post);

            DB::commit();
            return $post;
        } catch (QueryException $th) {
            DB::rollBack();
            // Delete images from Cloudinary
            $this->uploadImageService->destroy($posterImage["public_id"]);
            $this->uploadImageService->destroy($heroImage["public_id"]);
            throw PostNotCreatedException('Post was not created', $th);
        }
    }

    public function edit(Post $post): array
    {
        if (request()->user()->cannot('update', $post)) {
            throw CannotUpdatePostException("You cannot update this post", 403);
        }
        $categories = Category::all();
        return compact('post', 'categories');
    }

    public function update(PostDto $dto, Post $post): void
    {
        // If user can't update post, abort
        if (request()->user()->cannot('update', $post)) {
            throw CannotUpdatePostException("You cannot update this post", 403);
        }

        // If user upload file, delete on Cloudinary, from database and upload new one
        if ($dto->hero_image) {
            $this->updateImage($dto, $post, "hero_image", "background");
        }
        if ($dto->poster_image) {
            $this->updateImage($dto, $post, "poster_image", "poster");
        }

        // Update post
        $post->update([
            "title" => $dto->title,
            "body" => $dto->body,
            "category_id" => $dto->category_id,
        ]);
    }

    public function destroy(Post $post): void
    {
        try {
            // Get all image ids reltated to post
            $publicIds = $post->images()->pluck("public_id")->toArray();
            // Delete images from Cloudinary
            $this->uploadImageService->destroy($publicIds);
            // Delete post
            $post->delete();
        } catch (QueryException $th) {
            throw Exception("Post was not deleted", $th);
        } catch (ApiError $th) {
            throw ImageUploadException("Images were not deleted from Cloudinary", $th);
        }
    }

    private function getOtherPosts(Post $post): Collection
    {
        return $post->user->posts()
            ->latest()
            ->whereNot("id", $post->id)
            ->take(5)
            ->get();
    }

    private function getComments(Post $post): LengthAwarePaginator
    {
        return $post->comments()
            ->with("user.profile", "activities")
            ->latest()
            ->paginate(5);
    }

    private function updateImage(PostDto $dto, Post $post, $imageType, $alt): void
    {
        try {
            // Upload new image
            $image = $this->uploadImageService->upload($dto->$imageType, $alt);
            // Delete old image from Cloudinary
            $oldImage = $post->images()
                ->where("type", $imageType === "hero_image" ? "background" : "poster")
                ->first();
            $this->uploadImageService->destroy($oldImage->public_id);
            // Change image url in database
            $post->$imageType = $image["url"];
            $post->images()->create($image);
            // Delete image from database
            $post->images()->where("public_id", $oldImage->public_id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function notifyFollowers(User $user, Post $post): void
    {
        $followers = $user->followers()->get();
        Notification::send($followers, new NewPostNotification($post));
    }
}
