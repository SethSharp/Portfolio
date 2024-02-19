<?php

namespace Tests\Http\Controllers\Views\Blogs;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;

class ShowBlogTest extends TestCase
{
    /** @test */
    public function cannot_view_blog_if_is_draft()
    {
        $blog = Blog::factory()->draft()->create();

        $this->get(route('blogs.show', $blog))
            ->assertForbidden();
    }

    /** @test */
    public function admin_can_view_blog_if_is_draft()
    {
        $blog = Blog::factory()->draft()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('blogs.show', $blog))
            ->assertOk();
    }
}
