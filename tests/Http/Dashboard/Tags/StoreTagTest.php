<?php

namespace Dashboard\Tags;

use Tests\TestCase;
use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;
use App\Providers\RouteServiceProvider;

class StoreTagTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.tags.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_author_role()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.tags.store'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.tags.store'))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name' => 'The name field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.tags.store'), [
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
            ->postJson(route('dashboard.tags.store'), [
                'name' => 'Tag-1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name' => 'The name has already been taken.',
            ]);
    }

    /** @test */
    public function can_store_as_author()
    {
        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.tags.store'), [
                'name' => 'Tag 1',
            ])
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
        ]);
    }

    /** @test */
    public function can_store_as_admin()
    {
        $this->actingAs($user = User::factory()->admin()->create())
            ->postJson(route('dashboard.tags.store'), [
                'name' => 'Tag 1',
            ])
            ->assertRedirect(route('dashboard.tags.index'));

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag 1',
        ]);
    }
}
