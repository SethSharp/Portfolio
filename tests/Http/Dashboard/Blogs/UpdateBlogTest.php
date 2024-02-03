<?php

namespace Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Domain\Iam\Models\User;
use Tests\TestCase;
use function Symfony\Component\Translation\t;

class UpdateBlogTest extends TestCase
{
    protected Blog $blog;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->author()->create();
        $this->blog = Blog::factory()->create([
            'author_id' => $this->user->id
        ]);
    }

    /** @test */
    public function must_be_authenticated()
    {
        $this->putJson(route('dashboard.blogs.update', $this->blog))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_author_role()
    {
        $this->actingAs(User::factory()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog))
            ->assertForbidden();
    }

    /** @test */
    public function must_be_the_author()
    {
        $this->actingAs(User::factory()->author()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog))
            ->assertForbidden();
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
                'slug' => 'The slug field is required.',
                'content' => 'The content field is required.',
                'is_draft' => 'The is draft field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 1234,
                'slug' => 1234,
                'content' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title must be a string.',
                'slug' => 'The slug must be a string.',
                'content' => 'The content must be a string.',
            ]);
    }

    /** @test */
    public function fields_must_be_unique()
    {
        Blog::factory()->create([
            'title' => 'Some Title',
            'slug' => 'some-slug'
        ]);

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'content' => 'test'
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title has already been taken.',
                'slug' => 'The slug has already been taken.',
            ]);
    }

    /** @test */
    public function unique_fields_ignore_current_blog()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => $this->blog->title,
                'slug' => $this->blog->slug,
                'content' => 'new content',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));
    }

    /** @test */
    public function can_update_as_owner()
    {
        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function can_update_as_admin()
    {
        $this->actingAs($user = User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function if_is_draft_is_provided_blog_is_updated_as_draft()
    {
        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }
}
