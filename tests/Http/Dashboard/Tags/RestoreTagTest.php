<?php

namespace Dashboard\Tags;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;

class RestoreTagTest extends TestCase
{
    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tag = Tag::factory()->create();

        $this->tag->delete();
    }

    /** @test */
    public function must_be_authenticated()
    {
        $this->putJson(route('dashboard.tags.restore'), [
            'tag_id' => $this->tag->id
        ])
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.tags.restore'), [
                'tag_id' => $this->tag->id
            ])
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function can_restore_as_a_admin()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.restore'), [
                'tag_id' => $this->tag->id
            ])
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => $this->tag->name,
            'deleted_at' => null
        ]);
    }
}
