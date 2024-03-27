<?php

namespace Http\Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Providers\RouteServiceProvider;

class DeleteBlogTest extends TestCase
{
    protected Blog $blog;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blog = Blog::factory()->create();
    }

    /** @test */
    public function must_be_authenticated()
    {
        $this->deleteJson(route('dashboard.blogs.delete', $this->blog))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->deleteJson(route('dashboard.blogs.delete', $this->blog))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function can_delete_as_an_admin()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.blogs.delete', $this->blog))
            ->assertRedirect(route('dashboard.blogs.index'));
    }
}
