<?php

namespace Tests\Http\Dashboard\Tags;

use Tests\TestCase;
use App\Domain\Blog\Enums\TagStatus;
use Inertia\Testing\AssertableInertia;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;

class IndexTagsTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->get(route('dashboard.tags.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function must_have_author_or_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard.tags.index'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function can_see_if_user_has_admin_or_author_role()
    {
        $this->actingAs(User::factory()->author()->create())
            ->get(route('dashboard.tags.index'))
            ->assertOk();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.tags.index'))
            ->assertOk();
    }

    /** @test */
    public function filters_active_by_default()
    {
        Tag::factory()->create()->delete();
        $tag = Tag::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.tags.index'))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('tags.data.0.id', $tag->id)
            );
    }

    /** @test */
    public function can_filter_by_active_tags()
    {
        Tag::factory()->create()->delete();
        $tag = Tag::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.tags.index', ['filter' => ['status' => TagStatus::ACTIVE->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('tags.data.0.id', $tag->id)
            );
    }

    /** @test */
    public function can_filter_by_deleted_tags()
    {
        Tag::factory()->create();
        Tag::factory()->create();
        $deleted = Tag::factory()->create();
        $deleted->delete();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.tags.index', ['filter' => ['status' => TagStatus::DELETED->value]]))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('tags.data.0.id', $deleted->id)
            );
    }

    /** @test */
    public function tags_are_ordered_by_created_at()
    {
        $tag3 = Tag::factory()->create();
        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard.tags.index'))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->where('tags.data.0.id', $tag3->id)
                    ->where('tags.data.1.id', $tag1->id)
                    ->where('tags.data.2.id', $tag2->id)
            );
    }
}
