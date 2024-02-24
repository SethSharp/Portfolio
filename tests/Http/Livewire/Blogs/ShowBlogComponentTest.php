<?php

namespace Tests\Http\Livewire\Blogs;

use Tests\TestCase;
use Livewire\Livewire;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Http\Livewire\blogs\ShowBlog;

class ShowBlogComponentTest extends TestCase
{
    /** @test */
    public function cannot_like_blog_if_user_is_unauthenticated()
    {
        $blog = Blog::factory()->create();

        Livewire::test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->call('like')
            ->assertSet('isLiked', false)
            ->assertSet('blogLikes', 0)
            ->assertSet('showRegisterModal', true);
    }

    /** @test */
    public function can_see_blog_likes()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $blog->likes()->attach([
            $user->id
        ]);

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('blogLikes', 1);
    }

    /** @test */
    public function can_like_blog()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->call('like')
            ->assertSet('isLiked', true)
            ->assertSet('blogLikes', 1);

        $this->assertDatabaseHas('blog_likes', [
            'blog_id' => $blog->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function can_unlike_post()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $blog->likes()->attach([
            $user->id
        ]);

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('isLiked', true)
            ->assertSet('blogLikes', 1)
            ->call('like')
            ->assertSet('isLiked', false)
            ->assertSet('blogLikes', 0);

        $this->assertDatabaseMissing('blog_likes', [
            'blog_id' => $blog->id,
            'user_id' => $user->id
        ]);
    }
}
