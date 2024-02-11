<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Domain\File\Models\File;
use App\Support\Cache\CacheKeys;
use Illuminate\Support\Facades\Cache;

class StoreBlogTest extends TestCase
{
    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.blogs.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function must_have_author_role()
    {
        $this->actingAs(User::factory()->create())
            ->postJson(route('dashboard.blogs.store'))
            ->assertForbidden();
    }

    /** @test */
    public function fields_are_required()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.blogs.store'))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => 'The title field is required.',
                'slug' => 'The slug field is required.',
                'tags' => 'The tags field is required.',
                'content' => 'The content field is required.',
                'is_draft' => 'The is draft field is required.',
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->admin()->create())
            ->postJson(route('dashboard.blogs.store'), [
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
            ->postJson(route('dashboard.blogs.store'), [
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
            ->postJson(route('dashboard.blogs.store'), [
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
            ->postJson(route('dashboard.blogs.store'), [
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
    public function can_store_as_author()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function can_store_as_admin()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->admin()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => false
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function if_is_draft_is_provided_blog_is_stored_as_draft()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);
    }

    /** @test */
    public function tags_is_attached_to_blog()
    {
        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => 'some content here',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
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

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => '<tt-image blogid="null"> </tt-image>',
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertDatabaseHas('blogs', [
            'author_id' => $user->id,
            'is_draft' => 1,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
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

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
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

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
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
    public function content_is_cached()
    {
        $file = File::create([
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $tag = Tag::factory()->create();

        $this->actingAs($user = User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.store'), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'tags' => [
                    [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ]
                ],
                'meta_title' => 'some title',
                'meta_tags' => 'some tag',
                'meta_description' => 'some description',
                'content' => "<tt-image fileid=\"$file->id\" blogid='null'> </tt-image>",
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $blog = Blog::first();

        $this->assertDatabaseHas('files', [
            'blog_id' => $blog->id,
            'path' => 'some-path',
            'url' => 'some-url'
        ]);

        $this->assertEquals("<img fileid=\"$file->id\" blogid='null'> </img>", Cache::get(CacheKeys::renderedBlogContent($blog)));
    }
}
