<?php

namespace Dashboard\Blogs;

use Tests\TestCase;
use Mockery\MockInterface;
use App\Domain\Iam\Models\User;
use App\Domain\File\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Domain\File\Actions\StoreFileAction;
use App\Domain\File\Actions\DestroyFileAction;

class StoreBlogImageTest extends TestCase
{
    protected MockInterface $destroyFileAction;
    protected MockInterface $storeFileAction;

    /** @test */
    public function must_be_authenticated()
    {
        $this->postJson(route('dashboard.blogs.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function file_is_required()
    {
        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => null,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'file' => 'The file field is required'
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
                'file' => 'The file must be an image'
            ]);
    }

    /** @test */
    public function fields_must_be_a_string()
    {
        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'fileId' => 1234,
                'blogId' => 1234,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'fileId' => 'The file id must be a string',
                'blogId' => 'The blog id must be a string'
            ]);
    }

    /** @test */
    public function fields_are_not_required()
    {
        Storage::fake('s3');

        $uploadedFile = UploadedFile::fake()->image('file.jpg');

        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => $uploadedFile,
            ])
            ->assertOk();
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
            'url' => '/storage/some-old-path'
        ]);

        $this->storeFileAction->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($uploadedFileInstance) {
                return $uploadedFileInstance instanceof UploadedFile;
            })
            ->andReturn('new-file-path');

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
                'fileId' => (string)$file->id
            ])
            ->assertOk();

        $this->assertDatabaseHas('files', [
            'blog_id' => null,
            'path' => 'new-file-path',
            'url' => '/storage/new-file-path'
        ]);
    }

    /** @test */
    public function new_file_is_created_if_no_file_is_is_stored()
    {
        Storage::fake('s3');

        $this->storeFileAction = $this->mock(StoreFileAction::class);
        app()->instance(StoreFileAction::class, $this->storeFileAction);

        $file = UploadedFile::fake()->image('file.jpg');

        $this->storeFileAction->shouldReceive('__invoke')
            ->once()
            ->withArgs(function ($uploadedFile) use ($file) {
                return $uploadedFile instanceof UploadedFile;
            })
            ->andReturn('some-random-path');

        $this->actingAs(User::factory()->author()->create())
            ->postJson(route('dashboard.blogs.image.store'), [
                'file' => $file,
            ])
            ->assertOk();

        $this->assertDatabaseHas('files', [
            'blog_id' => null,
            'path' => 'some-random-path',
            'url' => '/storage/some-random-path'
        ]);
    }
}
