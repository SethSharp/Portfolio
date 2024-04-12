<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Actions\Blogs\StoreBlogCoverAction;

class StoreBlogCoverActionTest extends TestCase
{
    /** @test */
    public function can_store_file()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('file.jpg');

        $blog = Blog::factory()->create();

        app(StoreBlogCoverAction::class)($file, $blog);

        Storage::disk('s3')->assertExists('testing/blogs/' . $blog->id . '/cover-images');
    }

    /** @test */
    public function can_store_new_file_and_delete_old_one()
    {
        Storage::fake('s3');

        $blog = Blog::factory()->create();

        $oldFile = UploadedFile::fake()->image('old-file.jpg');
        $newFile = UploadedFile::fake()->image('new-file.jpg');

        $path = app(StoreBlogCoverAction::class)($oldFile, $blog);

        $blog->update([
            'cover_image' => $path
        ]);

        app(StoreBlogCoverAction::class)($newFile, $blog);

        Storage::disk('s3')->assertMissing('testing/blogs/' . $blog->id . '/cover-images/' . $path);

        $actualCount = count(Storage::disk('s3')->files('testing/blogs/' . $blog->id . '/cover-images'));
        $this->assertEquals(1, $actualCount);
    }
}
