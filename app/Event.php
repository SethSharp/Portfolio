<?php

namespace App;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
}
