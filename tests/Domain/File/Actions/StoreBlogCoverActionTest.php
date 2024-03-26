<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use App\Domain\Blog\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Domain\File\Actions\StoreBlogCoverAction;

class StoreBlogCoverActionTest extends TestCase
{
    /** @test */
    public function can_store_file()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('file.jpg');

        $blog = Blog::factory()->create();

        app(StoreBlogCoverAction::class)($file, $blog->id);

        // since filename is generated in the action, we can't test that it is stored
        // but can test that the directory is created -> file is created
        Storage::disk('s3')->assertExists('testing/blogs/' . $blog->id . '/cover-images/');
    }
}
