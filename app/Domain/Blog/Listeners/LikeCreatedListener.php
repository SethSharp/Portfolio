<?php

namespace App\Domain\Blog\Listeners;

use Illuminate\Support\Facades\Notification;
use SethSharp\BlogCrud\Models\Events\LikeCreatedEvent;
use App\Domain\Blog\Notifications\NotifySlackOfLikeNotification;

class LikeCreatedListener
{
    public function handle(LikeCreatedEvent $event): void
    {
        $like = $event->like;

        $like->loadMissing(['user', 'blog']);

        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new NotifySlackOfLikeNotification($like->user, $like->blog));
    }
}
