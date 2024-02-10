<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Domain\File\Actions\StoreFileAction;

class StoreFileActionTest extends TestCase
{
    /** @test */
    public function can_store_file()
    {
        Storage::fake();

        $file = UploadedFile::fake()->image('file.jpg');

        app(StoreFileAction::class)($file);

        Storage::assertExists($file->hashName('testing/blogs'));
    }
}
