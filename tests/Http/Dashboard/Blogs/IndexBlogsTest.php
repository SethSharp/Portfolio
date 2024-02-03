<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;

class IndexBlogsTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->get(route('dashboard.blogs.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function must_have_author_role()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertForbidden();
    }
}
