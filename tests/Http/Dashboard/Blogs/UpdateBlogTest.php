<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\File\Models\File;
use App\Support\Cache\CacheKeys;
use App\Domain\Blog\Models\Group;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;

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
            ->assertRedirect(RouteServiceProvider::BLOG);
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
                'is_draft' => 'The is draft field is required.',
            ]);
    }

    /** @test */
    public function fields_are_required_when_blog_is_a_draft()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'is_draft' => true
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
            ])
            ->assertJsonMissingValidationErrors([
                'content' => 'The content field is required.'
            ]);
    }

    /** @test */
    public function fields_are_required_when_blog_is_not_a_draft()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'is_draft' => false,
                'meta_title' => null
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
                'content' => 'The content field is required when is draft is false.',
                'meta_title' => 'The meta title field is required when is draft is false.',
                'meta_description' => 'The meta description field is required when is draft is false.',
                'meta_tags' => 'The meta tags field is required when is draft is false.'
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
    public function tags_must_be_an_array()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'tags' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'tags' => 'The tags must be an array.',
            ]);
    }

    /** @test */
    public function meta_data_is_nullable()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.store', $this->blog), [
                'title' => 'title',
                'slug' => 'slug',
                'content' => 'test',
                'meta_title' => null,
                'meta_tags' => null,
                'meta_description' => null,
            ])
            ->assertJsonMissingValidationErrors([
                'meta_title',
                'meta_tags',
                'meta_description'
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
        $tag = Tag::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => $this->blog->title,
                'slug' => $this->blog->slug,
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'content' => 'new content',
                'is_draft' => false,
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'some tags'
            ])
            ->assertRedirect(route('dashboard.blogs.index'));
    }

    /** @test */
    public function if_slug_is_not_provided_title_is_slugified()
    {
        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'tags' => [],
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
            'slug' => 'some-title',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function can_update_as_owner()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'some tags',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'some tags',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function can_assign_a_group()
    {
        $group = Group::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'group_id' => $group->id,
                'slug' => 'some-slug',
                'tags' => [],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'id' => $this->blog->id,
            'group_id' => $group->id,
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);

        $blog = Blog::where([
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
        ])->first();

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blog->id,
            'group_id' => $group->id,
            'order' => 1
        ]);
    }

    /** @test */
    public function can_assign_a_group_with_other_blogs()
    {
        $group = Group::factory()->create();
        $blog = Blog::factory()->create([
            'group_id' => $group->id
        ]);

        $group->blogs()->attach($blog, [
            'order' => 1
        ]);

        $blog2 = Blog::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $blog2->id), [
                'title' => 'Some Title',
                'group_id' => $group->id,
                'slug' => 'some-slug',
                'tags' => [],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'id' => $blog2->id,
            'group_id' => $group->id,
            'author_id' => $blog2->author->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blog->id,
            'group_id' => $group->id,
            'order' => 1
        ]);

        $this->assertDatabaseHas('blog_group', [
            'blog_id' => $blog2->id,
            'group_id' => $group->id,
            'order' => 2
        ]);
    }

    /** @test */
    public function can_update_as_admin()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function if_is_draft_is_provided_blog_is_updated_as_draft_and_published_at_is_reset()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => 'some content here',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => 'some content here',
            'published_at' => null
        ]);
    }

    /** @test */
    public function can_published_a_draft_blog()
    {
        $this->blog->update([
            'is_draft' => false,
            'published_at' => null
        ]);

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'is_draft' => 0,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => 'some content here',
            'published_at' => now()
        ]);
    }

    /** @test */
    public function published_at_is_not_reset_if_blog_is_updated()
    {
        $user = User::factory()->author()->create();

        $blog = Blog::factory()->published()->create([
            'author_id' => $user->id,
            'published_at' => now()->subDay()
        ]);

        $this->actingAs($user)
            ->putJson(route('dashboard.blogs.update', $blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'is_draft' => 0,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => 'some content here',
            'published_at' => now()->subDay()
        ]);
    }

    /** @test */
    public function tags_is_attached_to_blog()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => 'some content here',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => 'some content here'
        ]);

        $blog = Blog::first();

        $this->assertDatabaseHas('blog_tag', [
            'blog_id' => $blog->id,
            'tag_id' => $tag->id,
        ]);
    }

    /** @test */
    public function will_replace_blog_id_in_content()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => '<tt-image blogid="null"> </tt-image>',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertDatabaseHas('blogs', [
            'author_id' => $this->user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'Some title',
            'meta_description' => 'Some description',
            'meta_tags' => 'Some tags',
            'content' => "<tt-image blogid=\"$blog->id\"> </tt-image>"
        ]);
    }

    /** @test */
    public function any_files_without_blog_id_will_be_assigned_recently_created_one()
    {
        $file = File::create([
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => "<tt-image fileid=\"$file->id\" blogid=\"null\"> </tt-image>",
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertDatabaseHas('files', [
            'blog_id' => $blog->id,
            'path' => 'some-path',
            'url' => 'some-url'
        ]);
    }

    /** @test */
    public function captures_all_unused_files_and_deletes_them()
    {
        $file = File::create([
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $anotherFile = File::create([
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => "<tt-image fileid=\"$file->id\" blogid='null'> </tt-image> <tt-image fileid=\"$file->id\" blogid='null'> </tt-image>",
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertDatabaseHas('files', [
            'blog_id' => $blog->id,
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $this->assertDatabaseMissing('files', [
            'blog_id' => $anotherFile->id,
            'path' => 'some-path',
            'url' => 'some-url'
        ]);
    }

    /** @test */
    public function content_in_cache_is_updated()
    {
        $file = File::create([
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $tag = Tag::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => "<tt-image fileid=\"$file->id\" blogid='null'> </tt-image>",
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertEquals("<img fileid=\"$file->id\" blogid='null'> </img>", Cache::get(CacheKeys::renderedBlogContent($blog)));
    }
}
