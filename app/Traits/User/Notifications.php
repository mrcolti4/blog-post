<?php

namespace App\Traits\User;

use App\Models\Notification;
use App\Notifications\LikeNotification;
use App\Notifications\NewPostNotification;
use App\Notifications\FollowNotification;

trait Notifications
{
   /**
     * Get all notifications
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    private function getAllNotifications()
    {
        return $this->morphMany(
            Notification::class,
            'notifiable',
            'notifiable_type',
            'notifiable_id',
            'id'
        );
    }

    public function newPostNotifications()
    {
        return $this->getAllNotifications()
            ->where("type", NewPostNotification::class);
    }

    public function followNotifications()
    {
        return $this->getAllNotifications()
            ->where("type", FollowNotification::class);
    }

    public function likeNotifications()
    {
        return $this->getAllNotifications()
            ->where("type", LikeNotification::class);
    }
}
