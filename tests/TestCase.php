<?php

namespace Tests;

use Carbon\Carbon;
use Tests\Traits\SeedsRoles;
use Tests\Traits\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use SeedsRoles;
    use RefreshDatabase;
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        $this->seedRoles();

        Carbon::setTestNow(now());
    }
}
