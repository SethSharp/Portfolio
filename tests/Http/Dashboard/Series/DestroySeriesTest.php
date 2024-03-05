<?php

namespace Http\Dashboard\Series;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;
use App\Providers\RouteServiceProvider;

class DestroySeriesTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->deleteJson(route('dashboard.series.destroy', Series::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->deleteJson(route('dashboard.series.destroy', Series::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function cannot_destroy_series_if_blogs_are_attached()
    {
        $series = Series::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.series.destroy', $series))
            ->assertRedirect(route('dashboard.series.index'));
    }

    /** @test */
    public function can_destroy_series_if_no_blogs_are_attached()
    {
        $series = Series::factory()->create();
        $blog = Blog::factory()->create();
        $series->blogs()->attach($blog->id, [
            'order' => 1
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->deleteJson(route('dashboard.series.destroy', $series))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'series' => 'This series has 1 or more blogs attached.'
            ]);
    }
}
