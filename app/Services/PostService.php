<?php

namespace App\Services;

use App\Exceptions\ImageUploadException;
use App\Exceptions\PostNotCreatedException;
use Exception;
use App\Http\Requests\PostRequest;
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

    public function show(Post $post): array
    {
        $post->load(['user.profile', 'comments.user.profile', 'comments.activities']);

        return [
            'post' => $post,
            'otherPosts' => $this->getOtherPosts($post),
            'comments' => $this->getComments($post),
        ];
    }

    public function store(PostRequest $request): void
    {
        $user = Auth::user();

        $attrs = $request->validate();

        DB::beginTransaction();

        try {
            $post = $user->posts()->create([
                "title" => $attrs["title"],
                "body" => $attrs["content"],
                "category_id" => $attrs["category_id"],
            ]);
            // Upload images on Cloudinary
            $posterImage = $this->uploadImageService->upload($request->file('poster_image'), "poster");
            $heroImage = $this->uploadImageService->upload($request->file('hero_image'), "background");

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
        } catch (QueryException $th) {
            DB::rollBack();
            $this->uploadImageService->destroy($posterImage["public_id"]);
            $this->uploadImageService->destroy($heroImage["public_id"]);
            throw PostNotCreatedException('Post was not created', $th);
        }
    }
    public function update(PostRequest $request, Post $post): void
    {
        // If user can't update post, abort
        if (request()->user()->cannot('update', $post)) {
            abort(403);
        }
        // Validate request
        $attrs = $request->validate();

        // If user upload file, delete on Cloudinary, from database and upload new one
        if ($request->hasFile("hero_image")) {
            $this->updateImage($request, $post, "hero_image", "background");
        }
        if ($request->hasFile("poster_image")) {
            $this->updateImage($request, $post, "poster_image", "poster");
        }

        // Update post
        $post->update($attrs);
    }

    public function destroy(Post $post): void
    {
        try {
            $post->delete();
            $this->uploadImageService->destroy($post->hero_image->public_id);
            $this->uploadImageService->destroy($post->poster_image->public_id);
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

    private function updateImage(PostRequest $request, Post $post, $imageType, $alt): void
    {
        try {
            // Upload new image
            $image = $this->uploadImageService->upload($request->file($imageType), $alt);
            // Delete old image from Cloudinary
            $oldImage = $post->$imageType;
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
