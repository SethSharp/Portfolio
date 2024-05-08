<?php

namespace App\Domain;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class TestMessageWithCronJobsNotification extends Notification
{
    public function __construct(
        public string $message,
    ) {
    }

    public function via($notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content($this->message);
    }
}
