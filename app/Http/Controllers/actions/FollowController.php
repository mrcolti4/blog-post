<?php

namespace App\Http\Controllers\actions;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Notifications\FollowNotification;
use App\Models\Notification;

class FollowController extends Controller
{
    public function __invoke(User $user)
    {
        // Prevent following self
        if ($user == auth()->user()) {
            return response()->json(["error" => "You can't follow yourself"], 403);
        }
        // Return error if user is already followed
        if (Activity::where("target_id", $user->id)
            ->where("target_type", get_class($user))
            ->where("user_id", auth()->id())
            ->where("action_type", "follow")
            ->exists()
        ) {
            return response()->json(["error" => "You already followed this user"], 403);
        }

        try {
            // Follow user
            Activity::updateOrInsert([
                "user_id" => auth()->id(),
                "action_type" => "follow",
                "target_id" => $user->id,
                "target_type" => get_class($user),
            ]);
            // Check if notification was sent before
            $hasNotification = Notification::where("notifiable_id", $user->id)
                ->where("type", FollowNotification::class)
                ->exists();
            if (!$hasNotification) {
                // Send notification
                $user->notify(new FollowNotification(auth()->user()));
            }
            // Return success
            return response()->json(["message" => "You followed {$user->username}"], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 500);
        }
    }
}
