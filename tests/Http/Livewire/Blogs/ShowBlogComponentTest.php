<?php

namespace Tests\Http\Livewire\Blogs;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Blogs\ShowBlog;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use Illuminate\Support\Facades\Notification;
use SethSharp\BlogCrud\Models\Blog\Collection;
use App\Domain\Blog\Notifications\NotifySlackOfLikeNotification;

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
    public function does_not_get_latest_blog_if_there_is_none()
    {
        $blog = Blog::factory()->published()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('recentBlog', null);
    }

    /** @test */
    public function does_not_get_a_draft_blog_for_the_next_blog()
    {
        $collection = Collection::factory()->create();

        $blog = Blog::factory()->published()->create([
            'collection_id' => $collection->id
        ]);

        $draft = Blog::factory()->draft()->create();

        $collection->blogs()->attach($blog->id, [
            'order' => 1
        ]);

        $collection->blogs()->attach($draft->id, [
            'order' => 2
        ]);

        Livewire::actingAs(User::factory()->create())
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('next', null);
    }

    /** @test */
    public function does_not_get_a_draft_blog_for_the_prev_blog()
    {
        $collection = Collection::factory()->create();

        $blog = Blog::factory()->published()->create([
            'collection_id' => $collection->id
        ]);

        $draft = Blog::factory()->draft()->create([
            'collection_id' => $collection->id
        ]);

        $collection->blogs()->attach($blog->id, [
            'order' => 2
        ]);

        $collection->blogs()->attach($draft->id, [
            'order' => 1
        ]);

        Livewire::actingAs(User::factory()->create())
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('prev', null);
    }

    /** @test */
    public function can_see_blog_likes()
    {
        Notification::fake();

        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $blog->likes()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('blogLikes', 1);
    }

    /** @test */
    public function can_like_blog()
    {
        Notification::fake();

        $user = User::factory()->create();
        $blog = Blog::factory()->create();

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->call('like')
            ->assertSet('isLiked', true)
            ->assertSet('blogLikes', 1);

        $this->assertDatabaseHas('likes', [
            'blog_id' => $blog->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function can_unlike_post()
    {
        Notification::fake();

        $user = User::factory()->create();
        $blog = Blog::factory()->create();
        $blog->likes()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->assertSet('isLiked', true)
            ->assertSet('blogLikes', 1)
            ->call('like')
            ->assertSet('isLiked', false)
            ->assertSet('blogLikes', 0);

        $this->assertDatabaseMissing('likes', [
            'blog_id' => $blog->id,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function can_get_prev_and_next_blogs()
    {
        $collection = Collection::factory()->create();

        $first = Blog::factory()->published()->create([
            'collection_id' => $collection->id
        ]);

        $second = Blog::factory()->published()->create([
            'collection_id' => $collection->id
        ]);

        $third = Blog::factory()->published()->create([
            'collection_id' => $collection->id
        ]);

        $collection->blogs()->attach($first->id, [
            'order' => 1
        ]);

        $collection->blogs()->attach($second->id, [
            'order' => 2
        ]);

        $collection->blogs()->attach($third->id, [
            'order' => 3
        ]);

        Livewire::actingAs(User::factory()->create())
            ->test(ShowBlog::class, ['blog' => $second])
            ->assertOk()
            ->assertSet('prev.id', $first->id)
            ->assertSet('next.id', $third->id);
    }

    /** @test */
    public function gets_latest_blog_to_show()
    {
        $first = Blog::factory()->published()->create();

        $new = Blog::factory()->published()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(ShowBlog::class, ['blog' => $first])
            ->assertOk()
            ->assertSet('recentBlog.id', $new->id);
    }

    /** @test */
    public function sends_notification_of_like()
    {
        Notification::fake();

        $user = User::factory()->create();
        $blog = Blog::factory()->create();

        Livewire::actingAs($user)
            ->test(ShowBlog::class, ['blog' => $blog])
            ->assertOk()
            ->call('like')
            ->assertSet('isLiked', true)
            ->assertSet('blogLikes', 1);

        $this->assertDatabaseHas('likes', [
            'blog_id' => $blog->id,
            'user_id' => $user->id
        ]);

        Notification::assertSentOnDemand(NotifySlackOfLikeNotification::class);
    }
}
