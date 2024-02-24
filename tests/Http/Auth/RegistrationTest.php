<?php

namespace Tests\Http\Auth;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function sends_verification_email()
    {
        Notification::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::BLOG);

        $user = User::first();

        Notification::assertSentTo($user, VerifyEmail::class);
    }
}
