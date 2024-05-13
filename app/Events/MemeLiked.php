<?php

namespace App\Events;

use App\Models\User;
use App\Models\Meme;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MemeLiked
{
    use Dispatchable, SerializesModels;

    public $user;
    public $meme;

    public function __construct(User $user, Meme $meme)
    {
        $this->user = $user;
        $this->meme = $meme;
    }
}
