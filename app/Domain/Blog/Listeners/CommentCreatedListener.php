<?php

namespace App\Domain\Blog\Listeners;

use Illuminate\Support\Facades\Notification;
use SethSharp\BlogCrud\Models\Events\CommentCreatedEvent;
use App\Domain\Blog\Notifications\NotifySlackOfCommentNotification;

class CommentCreatedListener
{
    public function handle(CommentCreatedEvent $event): void
    {
        $comment = $event->comment;

        $comment->loadMissing(['user', 'blog']);

        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new NotifySlackOfCommentNotification($comment->user, $comment, $comment->blog));
    }
}
