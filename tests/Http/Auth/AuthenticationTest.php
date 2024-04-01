<?php

namespace Tests\Http\Auth;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

class AuthenticationTest extends TestCase
{
    /** @test */
    public function user_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function user_is_redirected_to_blog_if_intended_url_is_set()
    {
        $blog = Blog::factory()->create();
        session(['url.intended' => route('blogs.show', $blog)]);

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('blogs.show', $blog));
    }
}
