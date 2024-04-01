<?php

namespace Http\Dashboard\Collection;

use Tests\TestCase;
use SethSharp\BlogCrud\Models\Iam\User;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class UpdateCollectionTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->putJson(route('dashboard.collection.update', Collection::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.collection.update', Collection::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.collection.update', Collection::factory()->create()))
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
            ->putJson(route('dashboard.collection.update', Collection::factory()->create()), [
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
            ->putJson(route('dashboard.collection.update', Collection::factory()->create()), [
                'title' => 'CollectionPolicy #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function admin_can_update_a_collection()
    {
        $collection = Collection::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.collection.update', $collection), [
                'title' => 'New CollectionPolicy',
                'description' => 'New CollectionPolicy',
            ])
            ->assertRedirect(route('dashboard.collection.index'));

        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
            'title' => 'New CollectionPolicy',
            'description' => 'New CollectionPolicy',
        ]);
    }

    /** @test */
    public function will_ignore_current_collection_name()
    {
        $collection = Collection::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.collection.update', $collection), [
                'title' => $collection->title,
                'description' => 'New CollectionPolicy',
            ])
            ->assertRedirect(route('dashboard.collection.index'));

        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
            'title' => $collection->title,
            'description' => 'New CollectionPolicy',
        ]);
    }

    /** @test */
    public function can_update_blog_order()
    {
        $blogs = Blog::factory(3)->create();
        $collection = Collection::factory()->create();

        $collection->blogs()->attach($blogs->pluck('id')->toArray());

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.collection.update', $collection), [
                'title' => $collection->title,
                'description' => 'New CollectionPolicy',
                'blogs' => [
                    $blogs[2],
                    $blogs[0],
                    $blogs[1],
                ]
            ])
            ->assertRedirect(route('dashboard.collection.index'));

        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
            'title' => $collection->title,
            'description' => 'New CollectionPolicy',
        ])->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[0]->id,
            'collection_id' => $collection->id,
            'order' => 2
        ])->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[1]->id,
            'collection_id' => $collection->id,
            'order' => 3
        ])->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[2]->id,
            'collection_id' => $collection->id,
            'order' => 1
        ]);
    }
}
