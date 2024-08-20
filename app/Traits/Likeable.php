<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

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
        return DB::table("likes")->updateOrInsert(
            ["user_id" => $userId, $this->field => $this->id],
            ["vote" => $type]
        );
    }

    public function getLikesCount()
    {
        return $this->likes()
            ->where("vote", "like")
            ->get()
            ->count();
    }

    public function getDislikesCount()
    {
        return $this->likes()
            ->where("vote", "dislike")
            ->get()
            ->count();
    }
}
