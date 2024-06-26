<?php

namespace Dashboard\Tags;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;

class DestroyTagTest extends TestCase
{
    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tag = Tag::factory()->create();
    }

    /** @test */
    public function must_be_authenticated()
    {
        $this->deleteJson(route('dashboard.tags.destroy', $this->tag))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->deleteJson(route('dashboard.tags.destroy', $this->tag))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function can_destroy_as_a_admin()
    {
        $this->actingAs($user = User::factory()->admin()->create())
            ->delete(route('dashboard.tags.destroy', $this->tag))
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => $this->tag->name,
            'deleted_at' => now()
        ]);
    }
}
