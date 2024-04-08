<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use SethSharp\BlogCrud\Models\File;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;
use SethSharp\BlogCrud\Support\Cache\CacheKeys;
use SethSharp\BlogCrud\Actions\Blogs\AddBlogToCollectionAction;

class UpdateBlogTest extends TestCase
{
    protected Blog $blog;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->admin()->create();
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
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'title',
                'slug' => 'slug',
                'content' => 'test',
                'meta_title' => null,
                'meta_tags' => null,
                'meta_description' => null,
            ])
            ->assertRedirect();
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
    public function can_assign_a_collection()
    {
        $collection = Collection::factory()->create();

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'collection_id' => $collection->id,
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
            'collection_id' => $collection->id,
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

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blog->id,
            'collection_id' => $collection->id,
            'order' => 1
        ]);
    }

    /** @test */
    public function can_update_a_blog_collection()
    {
        $collection = Collection::factory()->create();

        $originalCollection = Collection::factory()->create();

        $this->blog->update([
            'collection_id' => $originalCollection->id
        ]);

        // adds the blog to the pivot
        app(AddBlogToCollectionAction::class)($this->blog, $originalCollection);

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'collection_id' => $collection->id,
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
            'collection_id' => $collection->id,
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

        // assert that entry is not duplicated
        $this->assertDatabaseCount('blog_collection', 1);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blog->id,
            'collection_id' => $collection->id,
            'order' => 1
        ]);
    }

    /** @test */
    public function can_assign_a_collection_with_other_blogs()
    {
        $collection = Collection::factory()->create();
        $blog = Blog::factory()->create([
            'collection_id' => $collection->id
        ]);

        app(AddBlogToCollectionAction::class)($blog, $collection);

        $blog2 = Blog::factory()->create();

        $this->actingAs(User::factory()->admin()->create())
            ->putJson(route('dashboard.blogs.update', $blog2->id), [
                'title' => 'Some Title',
                'collection_id' => $collection->id,
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
            'collection_id' => $collection->id,
            'author_id' => $blog2->author->id,
            'title' => 'Some Title',
            'slug' => 'some-slug',
            'meta_title' => 'some title',
            'meta_tags' => 'some tag',
            'meta_description' => 'some description',
            'content' => 'some content here'
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blog->id,
            'collection_id' => $collection->id,
            'order' => 1
        ]);

        $this->assertDatabaseHas('blog_collection', [
            'blog_id' => $blog2->id,
            'collection_id' => $collection->id,
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
    public function can_publish_a_draft_blog()
    {
        $this->blog->update([
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

        $blog = Blog::factory()->create([
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

        $this->actingAs(User::factory()->admin()->create())
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
    public function captures_all_unused_files_and_deletes_them()
    {
        $file = File::create([
            'blog_id' => $this->blog->id,
            'path' => 'some-path',
        ]);

        $anotherFile = File::create([
            'blog_id' => $this->blog->id,
            'path' => 'some-path',
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
        ]);

        $this->assertDatabaseMissing('files', [
            'blog_id' => $anotherFile->id,
            'path' => 'some-path',
        ]);
    }

    /** @test */
    public function content_in_cache_is_updated()
    {
        $file = File::create([
            'path' => 'some-path',
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

    /** @test */
    public function can_update_and_blog_cover_is_not_reset()
    {
        $this->blog->update([
            'cover_image' => 'original cover'
        ]);

        $this->actingAs($this->user)
            ->putJson(route('dashboard.blogs.update', $this->blog), [
                'title' => 'Some Title',
                'slug' => 'some-slug',
                'cover_image' => null,
                'meta_title' => 'Some title',
                'meta_description' => 'Some description',
                'meta_tags' => 'Some tags',
                'content' => "Some content",
                'is_draft' => true
            ])
            ->assertRedirect(route('dashboard.blogs.index'));

        $this->assertDatabaseHas('blogs', [
            'title' => 'Some Title',
            'cover_image' => 'original cover'
        ]);
    }
}
