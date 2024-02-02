<?php

namespace Dashboard\Blogs;

use App\Domain\Iam\Models\User;
use Tests\TestCase;

class StoreBlogTest extends TestCase
{
    /** @test */
    public function must_be_a_author_or_admin()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.blogs.store'))
            ->assertForbidden();
    }

    /** @test */
    public function test_me()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.blogs.store'), [

            ])
            ->assertStatus(422);
    }
}
