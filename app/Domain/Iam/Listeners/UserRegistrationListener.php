<?php

namespace App\Domain\Iam\Listeners;

use App\Domain\Iam\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;

class UserRegistrationListener
{
    public function handle(Registered $event): void
    {
        if (!$event->user->hasVerifiedEmail()) {
            $event->user->notify(new VerifyEmail());
        }
    }
}
