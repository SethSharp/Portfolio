<?php

namespace Http\Dashboard\Collection;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Collection;
use App\Providers\RouteServiceProvider;

class StoreCollectionTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.collection.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.collection.store'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.collection.store'))
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
            ->postJson(route('dashboard.collection.store'), [
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
    public function collection_must_be_unique()
    {
        Collection::factory()->create([
            'title' => 'CollectionPolicy #1',
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.collection.store'), [
                'title' => 'CollectionPolicy #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function admin_can_store_a_new_collection()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.collection.store'), [
                'title' => 'New CollectionPolicy',
                'description' => 'New CollectionPolicy',
            ])
            ->assertRedirect(route('dashboard.collection.index'));

        $this->assertDatabaseHas('collections', [
            'title' => 'New CollectionPolicy',
            'description' => 'New CollectionPolicy',
        ]);
    }
}
