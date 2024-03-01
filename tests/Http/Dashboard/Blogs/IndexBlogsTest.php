<?php

namespace Http\Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use Inertia\Testing\AssertableInertia;
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

    /** @test */
    public function can_separate_draft_and_published_blogs()
    {
        $draft = Blog::factory()->draft()->create();
        $published = Blog::factory()->published()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                ->where('publishedBlogs.0.id', $published->id)
                ->where('draftBlogs.0.id', $draft->id)
            );
    }
}
