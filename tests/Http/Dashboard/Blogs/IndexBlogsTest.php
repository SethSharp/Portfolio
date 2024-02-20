<?php

namespace Http\Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Providers\RouteServiceProvider;

class IndexBlogsTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->get(route('dashboard.blogs.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function must_have_author_or_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function can_see_if_user_has_admin_or_author_role()
    {
        $this->actingAs(User::factory()->author()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertOk();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertOk();
    }
}
