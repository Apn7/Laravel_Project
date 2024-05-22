<?php

namespace App\Listeners;

use App\Events\MemeCommented;
use App\Models\Notification;

class NotifyMemeCommented
{
    public function handle(MemeCommented $event)
    {
        Notification::create([
            'user_id' => $event->meme->user_id,
            'type' => 'meme_commented',
            'message' => "{$event->user->username} commented on your meme",
            'notifiable_id' => $event->meme->id,
            'notifiable_type' => 'App\Models\Meme'
        ]);
    }
}
