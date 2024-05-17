<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Register your events and listeners here
        'App\Events\MemeUploaded' => [
            'App\Listeners\NotifyMemeUploaded',
        ],
        'App\Events\MemeLiked' => [
            'App\Listeners\NotifyMemeLiked',
        ],
        'App\Events\MemeCommented' => [
            'App\Listeners\NotifyMemeCommented',
        ],
        'App\Events\UserFollowed' => [
            'App\Listeners\NotifyUserFollowed',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Additional event bindings can also go here
    }
}

