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
    ) {
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content($this->comment['comment']);

        return (new SlackMessage())
            ->text('New comment on your blog!')
            ->headerBlock('New comment on your blog - ' . $this->blog->title)
            ->sectionBlock(function (SectionBlock $block) {
                $block->field("Name: " . $this->user->name)->markdown();
                $block->field("Email: " . $this->user->email)->markdown();
            })
            ->actionsBlock(function (ActionsBlock $block) use ($notifiable) {
                $block->button('View Here')->url(route('blogs.show', $this->blog));
            })
            ->dividerBlock()
            ->sectionBlock(function (SectionBlock $block) use ($notifiable) {
                $block->text($this->comment['comment']);
            });
    }
}
