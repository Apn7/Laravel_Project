<?php

namespace App\Listeners;

use App\Events\MemeUploaded;
use App\Models\Notification;

class NotifyMemeUploaded
{
    public function handle(MemeUploaded $event)
    {
        foreach ($event->user->follower as $follower) {
            Notification::create([
                'user_id' => $follower->id,
                'type' => 'meme_uploaded',
                'message' => "New meme uploaded by {$event->user->name}",
                'notifiable_id' => $event->meme->id,
                'notifiable_type' => 'App\Models\Meme'
            ]);
        }
    }
}
