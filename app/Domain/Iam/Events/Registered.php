<?php

namespace App\Domain\Iam\Events;

use App\Event;
use App\Domain\Iam\Models\User;
use Illuminate\Queue\SerializesModels;

class Registered extends Event
{
    use SerializesModels;

    public function __construct(
        public User $user
    ) {
    }
}
