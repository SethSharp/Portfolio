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

        app(StoreBlogCoverAction::class)($file, $blog->id);

        Storage::disk('s3')->assertExists('testing/blogs/' . $blog->id . '/cover-image.jpg');
    }
}
