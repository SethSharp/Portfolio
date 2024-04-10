<?php

namespace App\Domain\Blog\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifySlackOfContactNotification extends Notification
{
    public function __construct(
        public string $email,
        public string $name,
        public string $message,
    )
    {
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content('Name: ' . $this->name . '. Email: ' . $this->email . '. Message: ' . $this->message);
    }
}
