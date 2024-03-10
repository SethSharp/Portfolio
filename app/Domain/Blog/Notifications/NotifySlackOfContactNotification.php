<?php

namespace App\Domain\Blog\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifySlackOfContactNotification extends Notification
{
    public function __construct(
        public string $name,
        public string $subject,
        public string $content,
    ) {
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content('New Contact on your portfolio!')
            ->attachment(function ($attachment) use ($notifiable) {
                $attachment->title("New Contact on your portfolio!")
                    ->fields([
                        "Name" => $this->name,
                        "Subject" => $this->subject,
                    ])
                    ->fallback($this->content);
            });
    }
}
