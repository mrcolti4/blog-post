<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $type, $id)
    {
        if (!$request->user()) {
            return response()->json(["error" => "You need to be logged in"], 401);
        }
        try {
            $model = $type === 'post' ? Post::findOrFail($id) : Comment::findOrFail($id);
            // Get post or comment model
            // Get "like" or "dislike" event, default "like"
            $event = $request->input("event", "like");
            if (Activity::where("target_id", $id)
                ->where("target_type", get_class($model))
                ->where("user_id", $request->user()->id)
                ->where("action_type", $event)
                ->exists()
            ) {
                return response()->json(["error" => "Already voted", 400]);
            }

            // Check if event is valid
            if (!in_array($event, ["like", "dislike"])) {
                return response()->json(["error" => "Invalid event", 400]);
            }
            // Run event on model, get the result and send notification
            $post = $model->$event($request->user()->id);
            $result = $post->getLikesCount() - $post->getDislikesCount();
            // Send notification to post author if event is "like"
            if ($event === "like") {
                // Check if notification has already been sent
                $hasNotification = Notification::where('type', LikeNotification::class)
                    ->where("data->target_id", $post->id)
                    ->where("data->user_id", $request->user()->id)
                    ->exists();
                // Send notification if it hasn't been sent
                if (!$hasNotification) {
                    $post->user->notify(new LikeNotification($post, $request->user()));
                }
            }

            // Return response in json format
            return response()->json([
                "event" => $event,
                "result" => $result,
                "target" => [
                    "id" => $post->id,
                    "type" => get_class($post),
                ],
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
