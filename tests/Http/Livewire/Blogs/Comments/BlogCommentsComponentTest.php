<?php

namespace Tests\Http\Livewire\Blogs\Comments;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use Illuminate\Support\Facades\Notification;
use App\Http\Livewire\blogs\comments\BlogCommentsComponent;
use App\Domain\Blog\Notifications\NotifySlackOfCommentNotification;

class BlogCommentsComponentTest extends TestCase
{
    /** @test */
    public function cannot_comment_if_not_authenticated()
    {
        $blog = Blog::factory()->create();

        Livewire::test(BlogCommentsComponent::class, ['blog' => $blog])
            ->call('save')
            ->assertSet('showRegisterModal', true);

        $this->assertDatabaseCount('comments', 3);
    }

    /** @test */
    public function comment_is_required()
    {
        $blog = Blog::factory()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(BlogCommentsComponent::class, ['blog' => $blog])
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

        Livewire::test(BlogCommentsComponent::class, ['blog' => $blog])
            ->call('save')
            ->assertSet('showRegisterModal', true);

        Notification::assertNothingSent();
    }

    /** @test */
    public function comment_is_must_not_exceed_1000_characters()
    {
        $blog = Blog::factory()->create();

        Livewire::actingAs(User::factory()->create())
            ->test(BlogCommentsComponent::class, ['blog' => $blog])
            ->set('comment', Str::random(1000))
            ->call('save')
            ->assertSet('showRegisterModal', false)
            ->assertHasErrors(['comment']);
    }

    /** @test */
    public function can_comment_if_authenticated()
    {
        $blog = Blog::factory()->create();

        Livewire::actingAs($user = User::factory()->create())
            ->test(BlogCommentsComponent::class, ['blog' => $blog])
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
            ->test(BlogCommentsComponent::class, ['blog' => $blog])
            ->set('comment', 'Some comment')
            ->call('save')
            ->assertSet('showRegisterModal', false);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'comment' => 'Some comment'
        ]);

        Notification::assertSentTo($user, NotifySlackOfCommentNotification::class);
    }
}
