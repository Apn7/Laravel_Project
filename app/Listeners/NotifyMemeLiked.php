<?php

namespace App\Listeners;

use App\Events\MemeLiked;
use App\Models\Notification;

class NotifyMemeLiked
{
    public function handle(MemeLiked $event)
    {
        Notification::create([
            'user_id' => $event->meme->user_id,
            'type' => 'meme_liked',
            'message' => "{$event->user->username} liked your meme",
            'notifiable_id' => $event->meme->id,
            'notifiable_type' => 'App\Models\Meme'
        ]);
    }
}
