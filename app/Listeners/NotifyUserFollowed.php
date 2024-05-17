<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\Models\Notification;

class NotifyUserFollowed
{
    public function handle(UserFollowed $event)
    {
        Notification::create([
            'user_id' => $event->followed->id,
            'type' => 'user_followed',
            'message' => "{$event->follower->name} has followed you",
            'notifiable_id' => $event->follower->id,
            'notifiable_type' => 'App\Models\User'
        ]);
    }
}
