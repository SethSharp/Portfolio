<?php

namespace App\Domain\Blog\Notifications;

use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use Illuminate\Notifications\Notification;
use SethSharp\BlogCrud\Models\Blog\Comment;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifySlackOfCommentNotification extends Notification
{
    public function __construct(
        public User    $user,
        public Comment $comment,
        public Blog    $blog
    ) {}

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content("Blog: <" . route('blogs.show', $this->blog) . "|{$this->blog->title}>: {$this->comment['comment']}");
    }
}
