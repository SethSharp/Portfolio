<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use Mockery\MockInterface;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SethSharp\BlogCrud\Actions\Files\StoreFileAction;
use SethSharp\BlogCrud\Actions\Files\DestroyFileAction;

class StoreBlogImageTest extends TestCase
{
    protected MockInterface $destroyFileAction;
    protected MockInterface $storeFileAction;

    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.blogs.image.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function fields_is_required()
    {
        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => null,
                'blog_id' => null,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'file' => 'The file field is required',
                'blog_id' => 'The blog id field is required'
            ]);
    }

    /** @test */
    public function file_must_be_an_image()
    {
        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => '1234',
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'file' => 'The file must be a file.'
            ]);
    }

    /** @test */
    public function blog_id_must_exist()
    {
        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'blog_id' => 1,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'blog_id' => 'The selected blog id is invalid.'
            ]);
    }

    /** @test */
    public function file_info_is_replaced_with_new_info_if_id_is_provided()
    {
        Storage::fake('s3');

        $this->storeFileAction = $this->mock(StoreFileAction::class);
        app()->instance(StoreFileAction::class, $this->storeFileAction);

        $this->destroyFileAction = $this->mock(DestroyFileAction::class);
        app()->instance(DestroyFileAction::class, $this->destroyFileAction);

        $uploadedFile = UploadedFile::fake()->image('file.jpg');

        $file = File::create([
            'path' => 'some-old-path',
        ]);

        $this->storeFileAction->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($uploadedFileInstance) {
                return $uploadedFileInstance instanceof UploadedFile;
            })
            ->andReturn('new-file-path');

        $blog = Blog::factory()->create();

        $this->destroyFileAction->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($storedFileInstance) use ($file) {
                return $storedFileInstance instanceof File
                    && $file->is($storedFileInstance);
            })
            ->andReturn('new-file-path');

        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => $uploadedFile,
                'file_id' => (string)$file->id,
                'blog_id' => $blog->id
            ])
            ->assertOk();

        $this->assertDatabaseHas('files', [
            'blog_id' => $blog->id,
            'path' => 'new-file-path',
        ]);
    }

    /** @test */
    public function new_file_is_created_if_no_file_is_is_stored()
    {
        Storage::fake('s3');

        $this->storeFileAction = $this->mock(StoreFileAction::class);
        app()->instance(StoreFileAction::class, $this->storeFileAction);

        $file = UploadedFile::fake()->image('file.jpg');
        $blog = Blog::factory()->create();

        $this->storeFileAction->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($uploadedFile) use ($file) {
                return $uploadedFile instanceof UploadedFile;
            })
            ->andReturn('some-random-path');

        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => $file,
                'blog_id' => $blog->id
            ])
            ->assertOk();

        $this->assertDatabaseHas('files', [
            'blog_id' => $blog->id,
            'path' => 'some-random-path',
        ]);
    }

    /** @test */
    public function path_is_stored_correctly()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('file.jpg');
        $blog = Blog::factory()->create();

        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store', $blog), [
                'file' => $file,
                'blog_id' => $blog->id
            ])
            ->assertOk();

        $file = File::first();

        $this->assertStringContainsString('testing/blogs/' . $blog->id . '/content/', $file->path);
    }
}
