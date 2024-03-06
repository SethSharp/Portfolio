<?php

namespace Http\Dashboard\group;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Group;
use App\Providers\RouteServiceProvider;

class StoreGroupTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.group.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.group.store'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.group.store'))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
                'description' => 'The description field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.group.store'), [
                'title' => 1234,
                'description' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title must be a string.',
                'description' => 'The description must be a string.',
            ]);
    }

    /** @test */
    public function group_must_be_unique()
    {
        Group::factory()->create([
            'title' => 'Group #1',
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.group.store'), [
                'title' => 'Group #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function admin_can_store_a_new_group()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.group.store'), [
                'title' => 'New Group',
                'description' => 'New Group',
            ])
            ->assertRedirect(route('dashboard.group.index'));

        $this->assertDatabaseHas('groups', [
            'title' => 'New Group',
            'description' => 'New Group',
        ]);
    }
}
