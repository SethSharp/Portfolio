<?php

namespace Tests\Http\Controllers\Views;

use App\Http\EnvironmentEnum;
use Tests\TestCase;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowHomeControllerTest extends TestCase
{
    /** @test */
    public function can_view_seth_home_page()
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Seth Sharp')
            ->assertDontSee('Bethany Frankis');
    }

    /** @test */
    public function can_view_beth_home_page()
    {
        config(['environment.current' => EnvironmentEnum::BETH->value]);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('Seth Sharp')
            ->assertSee('Bethany Frankis');
    }

    /** @test */
    public function adds_no_index_no_follow_if_environment_is_not_beth()
    {
        config(['environment.current' => EnvironmentEnum::BETH->value]);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('Seth Sharp')
            ->assertSee('Bethany Frankis');
    }
}
