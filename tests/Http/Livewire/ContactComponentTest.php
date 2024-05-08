<?php

namespace Livewire;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Http\Livewire\ContactComponent;
use Illuminate\Support\Facades\Notification;
use App\Domain\Blog\Notifications\NotifySlackOfContactNotification;

class ContactComponentTest extends TestCase
{
    /** @test */
    public function email_field_must_be_email()
    {
        Livewire::test(ContactComponent::class)
            ->set('email', 'not an email')
            ->set('name', 'a name')
            ->set('message', 'some message')
            ->call('send')
            ->assertHasErrors([
                'email' => 'The email must be a valid email address.'
            ])
            ->assertSee('The email must be a valid email address.');
    }

    /** @test */
    public function message_must_be_50_characters()
    {
        Notification::fake();

        Livewire::test(ContactComponent::class)
            ->set('email', 'someone@test.com')
            ->set('name', 'a name')
            ->set('message', Str::random(10))
            ->call('send')
            ->assertHasErrors([
                'message' => 'The message must be at least 50 characters.'
            ])
            ->assertSee('The message must be at least 50 characters.');

        Notification::assertNothingSent();
    }

    /** @test */
    public function can_send_notification()
    {
        Notification::fake();

        Livewire::test(ContactComponent::class)
            ->set('email', 'someone@test.com')
            ->set('name', 'a name')
            ->set('message', Str::random(50))
            ->call('send')
            ->assertOk();

        Notification::assertSentOnDemand(NotifySlackOfContactNotification::class);
    }
}
