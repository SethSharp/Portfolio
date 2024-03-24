<?php

namespace Domain\Blog\Actions;

use Tests\TestCase;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Collection;
use App\Domain\Blog\Actions\AddBlogToCollectionAction;
use App\Domain\Blog\Actions\RemoveBlogFromCollectionAction;

class RemoveBlogFromGroupActionTest extends TestCase
{
    /** @test */
    public function can_handle_a_blog_not_part_of_the_collection()
    {
        $collection = Collection::factory()->create();
        $blog = Blog::factory()->create();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Blog " . $blog->title . " does not exist in collection " . $collection->title);

        app(RemoveBlogFromCollectionAction::class)($blog, $collection);
    }

    /** @test */
    public function can_properly_order_removing_blog_at_the_start()
    {
        $collection = Collection::factory()->create();
        $blogs = Blog::factory(3)->create([
            'collection_id' => $collection->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToCollectionAction::class)($blog, $collection);
        }

        app(RemoveBlogFromCollectionAction::class)($blogs[0], $collection);

        $this->assertDatabaseMissing('blog_collection', [
            'blog_id' => $blogs[0]->id,
            'collection_id' => $collection->id
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[1]->id,
            'collection_id' => $collection->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[2]->id,
            'collection_id' => $collection->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_collection', 2);
    }

    /** @test */
    public function can_properly_remove_blog_in_the_middle()
    {
        $collection = Collection::factory()->create();
        $blogs = Blog::factory(3)->create([
            'collection_id' => $collection->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToCollectionAction::class)($blog, $collection);
        }

        app(RemoveBlogFromCollectionAction::class)($blogs[1], $collection);

        $this->assertDatabaseMissing('blog_collection', [
            'blog_id' => $blogs[1]->id,
            'collection_id' => $collection->id
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[0]->id,
            'collection_id' => $collection->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[2]->id,
            'collection_id' => $collection->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_collection', 2);
    }

    /** @test */
    public function can_properly_remove_blog_from_the_end()
    {
        $collection = Collection::factory()->create();
        $blogs = Blog::factory(3)->create([
            'collection_id' => $collection->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToCollectionAction::class)($blog, $collection);
        }

        app(RemoveBlogFromCollectionAction::class)($blogs[2], $collection);

        $this->assertDatabaseMissing('blog_collection', [
            'blog_id' => $blogs[2]->id,
            'collection_id' => $collection->id
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[0]->id,
            'collection_id' => $collection->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blogs[1]->id,
            'collection_id' => $collection->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_collection', 2);
    }
}
