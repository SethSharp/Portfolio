<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Domain\TestMessageWithCronJobsNotification;

class TestMe extends Command
{
    protected $signature = 'test-me';
    protected $description = 'Sends a test message to slack';

    public function handle(): void
    {
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new TestMessageWithCronJobsNotification("This cron job is working"));
    }
}
