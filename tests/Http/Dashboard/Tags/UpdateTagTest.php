<?php

namespace Dashboard\Tags;

use Tests\TestCase;
use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;

class UpdateTagTest extends TestCase
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
        $this->putJson(route('dashboard.tags.update', $this->tag))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_author_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.tags.update', $this->tag))
            ->assertForbidden();
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.update', $this->tag))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name' => 'The name field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.update', $this->tag), [
                'name' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name' => 'The name must be a string.',
            ]);
    }

    /** @test */
    public function tag_must_be_unique()
    {
        Tag::factory()->create([
            'name' => 'Tag-1',
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.update', $this->tag), [
                'name' => 'Tag-1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name' => 'The name has already been taken.',
            ]);
    }

    /** @test */
    public function ignores_current_tag_name()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.update', $this->tag), [
                'name' => $this->tag->name
            ])
            ->assertRedirect();
    }

    /** @test */
    public function can_update_as_author()
    {
        $this->actingAs($user = User::factory()->author()->create())
            ->putJson(route('dashboard.tags.update', $this->tag), [
                'name' => 'Tag 1',
            ])
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
        ]);
    }

    /** @test */
    public function can_update_as_a_admin()
    {
        $this->actingAs($user = User::factory()->admin()->create())
            ->putJson(route('dashboard.tags.update', $this->tag), [
                'name' => 'Tag 1',
            ])
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
        ]);
    }
}
