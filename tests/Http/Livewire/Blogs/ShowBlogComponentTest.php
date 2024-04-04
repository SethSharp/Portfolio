<?php

namespace Tests\Http\Livewire\Blogs;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Blogs\ShowBlog;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

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
    public function shows_no_index_if_blog_is_in_a_draft_state()
    {
        $blog = Blog::factory()->draft()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('blogs.show', $blog))
            ->assertSee('noindex, nofollow');
    }

    /** @test */
    public function does_not_show_no_index_if_blog_is_published()
    {
        $blog = Blog::factory()->published()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('blogs.show', $blog))
            ->assertDontSee('noindex, nofollow');
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
