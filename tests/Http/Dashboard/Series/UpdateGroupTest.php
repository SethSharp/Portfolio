<?php

namespace Http\Dashboard\group;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;
use App\Providers\RouteServiceProvider;

class UpdateGroupTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->putJson(route('dashboard.group.update', Group::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.group.update', Group::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', Group::factory()->create()))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
                'description' => 'The description field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', Group::factory()->create()), [
                'title' => 1234,
                'description' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title must be a string.',
                'description' => 'The description must be a string.',
            ]);
    }

    /** @test */
    public function group_must_be_unique()
    {
        Group::factory()->create([
            'title' => 'Group #1',
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', Group::factory()->create()), [
                'title' => 'Group #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function admin_can_update_a_group()
    {
        $group = Group::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', $group), [
                'title' => 'New Group',
                'description' => 'New Group',
            ])
            ->assertRedirect(route('dashboard.group.index'));

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'title' => 'New Group',
            'description' => 'New Group',
        ]);
    }

    /** @test */
    public function will_ignore_current_group_name()
    {
        $group = Group::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', $group), [
                'title' => $group->title,
                'description' => 'New Group',
            ])
            ->assertRedirect(route('dashboard.group.index'));

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'title' => $group->title,
            'description' => 'New Group',
        ]);
    }

    /** @test */
    public function can_update_blog_order()
    {
        $blogs = Blog::factory(3)->create();
        $group = Group::factory()->create();

        $group->blogs()->attach($blogs->pluck('id')->toArray());

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.group.update', $group), [
                'title' => $group->title,
                'description' => 'New Group',
                'blogs' => [
                    $blogs[2],
                    $blogs[0],
                    $blogs[1],
                ]
            ])
            ->assertRedirect(route('dashboard.group.index'));

        $this->assertDatabaseHas('groups', [
            'id' => $group->id,
            'title' => $group->title,
            'description' => 'New Group',
        ])->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[0]->id,
            'group_id' => $group->id,
            'order' => 2
        ])->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[1]->id,
            'group_id' => $group->id,
            'order' => 3
        ])->assertDatabaseHas('blog_group', [
            'blog_id' => $blogs[2]->id,
            'group_id' => $group->id,
            'order' => 1
        ]);
    }
}
