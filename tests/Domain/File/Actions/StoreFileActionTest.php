<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Actions\Files\StoreFileAction;

class StoreFileActionTest extends TestCase
{
    /** @test */
    public function can_store_file()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('file.jpg');

        $blog = Blog::factory()->create();

        app(StoreFileAction::class)($file, $blog->id);

        $path = $file->hashName(path: "testing/blogs/{$blog->id}/content");

        Storage::disk('s3')->assertExists($path);
    }
}
