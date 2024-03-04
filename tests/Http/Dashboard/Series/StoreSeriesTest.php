<?php

namespace Dashboard\Series;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;
use App\Providers\RouteServiceProvider;

class StoreSeriesTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.series.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.series.store'))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.series.store'))
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
            ->postJson(route('dashboard.series.store'), [
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
    public function series_must_be_unique()
    {
        Series::factory()->create([
            'title' => 'Series #1',
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.series.store'), [
                'title' => 'Series #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function provided_blog_ids_must_exist()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.series.store'), [
                'title' => 'New Series',
                'description' => 'New Series',
                'blogs' => [
                    [
                        'id' => 12
                    ]
                ]
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'blogs.0.id' => 'The selected blogs.0.id is invalid.'
            ]);
    }

    /** @test */
    public function admin_can_store_a_new_series()
    {
        $this->actingAs($user = User::factory()->admin()->create())
            ->postJson(route('dashboard.series.store'), [
                'title' => 'New Series',
                'description' => 'New Series',
            ])
            ->assertRedirect(route('dashboard.series.index'));

        $this->assertDatabaseHas('series', [
            'title' => 'New Series',
            'description' => 'New Series',
        ]);
    }

    /** @test */
    public function can_attach_blogs()
    {
        $blog = Blog::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.series.store'), [
                'title' => 'New Series',
                'description' => 'New Series',
                'blogs' => [$blog]
            ])
            ->assertRedirect(route('dashboard.series.index'));

        $this->assertDatabaseHas('series', [
            'title' => 'New Series',
            'description' => 'New Series',
        ]);

        $series = Series::where([
            'title' => 'New Series',
            'description' => 'New Series',
        ])->first();

        $this->assertDatabaseHas('blog_series', [
            'blog_id' => $blog->id,
            'series_id' => $series->id
        ]);
    }
}
