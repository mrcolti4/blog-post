<?php

namespace App\Traits;

use App\Models\Activity;

trait Likeable
{
    public function like($userId)
    {
        return $this->addLikeOrDislike($userId, "like");
    }

    public function dislike($userId)
    {
        return $this->addLikeOrDislike($userId, "dislike");
    }

    private function addLikeOrDislike($userId, $type)
    {
        $action = Activity::where("target_id", $this->id)
            ->where("user_id", $userId)
            ->where("target_type", get_class($this))
            ->first();

        if ($action && $action->action_type !== $type) {
            $action->delete();
        }

        return Activity::updateOrInsert([
            "user_id" => $userId,
            "action_type" => $type,
            "target_type" => get_class($this),
            "target_id" => $this->id
        ]);
    }

    public function getLikesCount()
    {
        return $this->activities()
            ->where("action_type", "like")
            ->count();
    }

    public function getDislikesCount()
    {
        return $this->activities()
            ->where("action_type", "dislike")
            ->count();
    }
}
