<?php

namespace App\Domain\Blog\Notifications;

use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifySlackOfLikeNotification extends Notification
{
    public function __construct(
        public User $user,
        public Blog $blog
    ) {
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content("{$this->user->name} liked blog: <" . route('blogs.show', $this->blog) . "|{$this->blog->title}>");
    }
}
