<?php

namespace Http\Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Blog\Enums\BlogStatus;
use Inertia\Testing\AssertableInertia;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

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
    public function filters_published_by_default()
    {
        Blog::factory()->draft()->create();
        $published = Blog::factory()->published()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index'))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('blogs.data.0.id', $published->id)
            );
    }

    /** @test */
    public function can_filter_by_published_blogs()
    {
        Blog::factory()->draft()->create();
        $published = Blog::factory()->published()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index', ['filter' => ['status' => BlogStatus::PUBLISHED->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('blogs.data.0.id', $published->id)
            );
    }

    /** @test */
    public function can_filter_by_drafted_blogs()
    {
        Blog::factory()->published()->create();
        $drafted = Blog::factory()->draft()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index', ['filter' => ['status' => BlogStatus::DRAFTED->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('blogs.data.0.id', $drafted->id)
            );
    }

    /** @test */
    public function can_filter_by_deleted_blogs()
    {
        Blog::factory()->published()->create();
        Blog::factory()->draft()->create();
        $deleted = Blog::factory()->draft()->create();
        $deleted->delete();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index', ['filter' => ['status' => BlogStatus::DELETED->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('blogs.data.0.id', $deleted->id)
            );
    }

    /** @test */
    public function published_blogs_are_ordered_by_published_at()
    {
        $blog1 = Blog::factory()->published()->create();
        $blog2 = Blog::factory()->published()->create();
        $blog3 = Blog::factory()->published()->create();

        $blog1->update([
            'published_at' => now()->subDay()
        ]);

        $blog2->update([
            'published_at' => now()
        ]);

        $blog3->update([
            'published_at' => now()->subDays(4)
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.blogs.index', ['filter' => ['status' => BlogStatus::PUBLISHED->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('blogs.data.0.id', $blog2->id)
                    ->where('blogs.data.1.id', $blog1->id)
                    ->where('blogs.data.2.id', $blog3->id)
            );
    }
}
