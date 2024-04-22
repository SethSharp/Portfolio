<?php

namespace Tests\Http\Livewire\Blogs\Comments;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Str;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use Illuminate\Support\Facades\Notification;
use App\Http\Livewire\Blogs\Comments\BlogComments;
use App\Domain\Blog\Notifications\NotifySlackOfCommentNotification;

class BlogCommentsComponentTest extends TestCase
{
    /** @test */
    public function cannot_comment_if_not_authenticated()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::test(BlogComments::class, ['blog' => $blog])
            ->call('save')
            ->assertSet('showRegisterModal', true);

        $this->assertDatabaseCount('comments', 0);
    }

    /** @test */
    public function comment_is_required()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(BlogComments::class, ['blog' => $blog])
            ->set('comment')
            ->call('save')
            ->assertSet('showRegisterModal', false)
            ->assertHasErrors(['comment']);
    }

    /** @test */
    public function does_not_send_slack_notification_if_not_authenticated()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::test(BlogComments::class, ['blog' => $blog])
            ->call('save')
            ->assertSet('showRegisterModal', true);

        Notification::assertNothingSent();
    }

    /** @test */
    public function comment_must_not_exceed_1000_characters()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(BlogComments::class, ['blog' => $blog])
            ->set('comment', Str::random(1000))
            ->call('save')
            ->assertSet('showRegisterModal', false)
            ->assertHasErrors(['comment']);
    }

    /** @test */
    public function can_comment_if_authenticated()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::actingAs($user = User::factory()->unverified()->create())
            ->test(BlogComments::class, ['blog' => $blog])
            ->set('comment', 'Some comment')
            ->call('save')
            ->assertSet('showRegisterModal', false);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'comment' => 'Some comment'
        ]);
    }

    /** @test */
    public function sends_slack_notification_if_validation_passes()
    {
        Notification::fake();

        $blog = Blog::factory()->create();

        Livewire::actingAs($user = User::factory()->create())
            ->test(BlogComments::class, ['blog' => $blog])
            ->set('comment', 'Some comment')
            ->call('save')
            ->assertSet('showRegisterModal', false);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'comment' => 'Some comment'
        ]);

        Notification::assertSentOnDemand(NotifySlackOfCommentNotification::class);
    }
}
