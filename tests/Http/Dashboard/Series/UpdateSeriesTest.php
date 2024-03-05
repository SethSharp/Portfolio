<?php

namespace Http\Dashboard\Series;

use Tests\TestCase;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Series;
use App\Providers\RouteServiceProvider;

class UpdateSeriesTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->putJson(route('dashboard.series.update', Series::factory()->create()))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_admin_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.series.update', Series::factory()->create()))
            ->assertRedirect(RouteServiceProvider::BLOG);
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.series.update', Series::factory()->create()))
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
            ->putJson(route('dashboard.series.update', Series::factory()->create()), [
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
            ->putJson(route('dashboard.series.update', Series::factory()->create()), [
                'title' => 'Series #1'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
            ]);
    }

    /** @test */
    public function admin_can_update_a_series()
    {
        $series = Series::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.series.update', $series), [
                'title' => 'New Series',
                'description' => 'New Series',
            ])
            ->assertRedirect(route('dashboard.series.index'));

        $this->assertDatabaseHas('series', [
            'id' => $series->id,
            'title' => 'New Series',
            'description' => 'New Series',
        ]);
    }

    /** @test */
    public function will_ignore_current_series_name()
    {
        $series = Series::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.series.update', $series), [
                'title' => $series->title,
                'description' => 'New Series',
            ])
            ->assertRedirect(route('dashboard.series.index'));

        $this->assertDatabaseHas('series', [
            'id' => $series->id,
            'title' => $series->title,
            'description' => 'New Series',
        ]);
    }
}
