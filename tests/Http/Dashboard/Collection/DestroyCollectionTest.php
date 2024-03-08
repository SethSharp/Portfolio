<?php

namespace Http\Dashboard\Collection;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Collection;
use App\Providers\RouteServiceProvider;

class DestroyCollectionTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->deleteJson(route('dashboard.collection.destroy', Collection::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->deleteJson(route('dashboard.collection.destroy', Collection::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function cannot_destroy_collection_if_blogs_are_attached()
    {
        $collection = Collection::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.collection.destroy', $collection))
            ->assertRedirect(route('dashboard.collection.index'));
    }

    /** @test */
    public function can_destroy_collection_if_no_blogs_are_attached()
    {
        $collection = Collection::factory()->create();
        $blog = Blog::factory()->create();
        $collection->blogs()->attach($blog->id, [
            'order' => 1
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.collection.destroy', $collection))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'collection' => 'This collection has 1 or more blogs attached.'
            ]);
    }
}
