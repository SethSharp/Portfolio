<?php

namespace App\Providers;

use App\Domain\Blog\Listeners\LikeCreatedListener;
use App\Domain\Blog\Listeners\CommentCreatedListener;
use SethSharp\BlogCrud\Models\Events\LikeCreatedEvent;
use SethSharp\BlogCrud\Models\Events\CommentCreatedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CommentCreatedEvent::class => [
            CommentCreatedListener::class
        ],
        LikeCreatedEvent::class => [
            LikeCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
