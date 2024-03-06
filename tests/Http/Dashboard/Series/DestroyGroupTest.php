<?php

namespace Http\Dashboard\group;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;
use App\Providers\RouteServiceProvider;

class DestroyGroupTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->deleteJson(route('dashboard.group.destroy', Group::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->deleteJson(route('dashboard.group.destroy', Group::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function cannot_destroy_group_if_blogs_are_attached()
    {
        $group = Group::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.group.destroy', $group))
            ->assertRedirect(route('dashboard.group.index'));
    }

    /** @test */
    public function can_destroy_group_if_no_blogs_are_attached()
    {
        $group = Group::factory()->create();
        $blog = Blog::factory()->create();
        $group->blogs()->attach($blog->id, [
            'order' => 1
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.group.destroy', $group))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'group' => 'This group has 1 or more blogs attached.'
            ]);
    }
}
