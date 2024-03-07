<?php

namespace Domain\Blog\Actions;

use Tests\TestCase;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;
use App\Domain\Blog\Actions\AddBlogToGroupAction;
use App\Domain\Blog\Actions\RemoveBlogFromGroupAction;

class RemoveBlogFromGroupActionTest extends TestCase
{
    /** @test */
    public function can_handle_a_group_not_part_of_the_series()
    {
        $group = Group::factory()->create();
        $blogs = Blog::factory(3)->create([
            'group_id' => $group->id
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Blog " . $blogs[0]->title . " does not exist in group " . $group->title);

        app(RemoveBlogFromGroupAction::class)($blogs[0], $group);
    }

    /** @test */
    public function can_properly_order_removing_blog_at_the_start()
    {
        $group = Group::factory()->create();
        $blogs = Blog::factory(3)->create([
            'group_id' => $group->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToGroupAction::class)($blog, $group);
        }

        app(RemoveBlogFromGroupAction::class)($blogs[0], $group);

        $this->assertDatabaseMissing('blog_group', [
            'blog_id' => $blogs[0]->id,
            'group_id' => $group->id
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[1]->id,
            'group_id' => $group->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[2]->id,
            'group_id' => $group->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_group', 2);
    }

    /** @test */
    public function can_properly_remove_blog_in_the_middle()
    {
        $group = Group::factory()->create();
        $blogs = Blog::factory(3)->create([
            'group_id' => $group->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToGroupAction::class)($blog, $group);
        }

        app(RemoveBlogFromGroupAction::class)($blogs[1], $group);

        $this->assertDatabaseMissing('blog_group', [
            'blog_id' => $blogs[1]->id,
            'group_id' => $group->id
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[0]->id,
            'group_id' => $group->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[2]->id,
            'group_id' => $group->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_group', 2);
    }

    /** @test */
    public function can_properly_remove_blog_from_the_end()
    {
        $group = Group::factory()->create();
        $blogs = Blog::factory(3)->create([
            'group_id' => $group->id
        ]);

        foreach ($blogs as $blog) {
            app(AddBlogToGroupAction::class)($blog, $group);
        }

        app(RemoveBlogFromGroupAction::class)($blogs[2], $group);

        $this->assertDatabaseMissing('blog_group', [
            'blog_id' => $blogs[2]->id,
            'group_id' => $group->id
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[0]->id,
            'group_id' => $group->id,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[1]->id,
            'group_id' => $group->id,
            'order' => 2,
        ]);

        $this->assertDatabaseCount('blog_group', 2);
    }
}
