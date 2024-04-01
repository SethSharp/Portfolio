<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use SethSharp\BlogCrud\Models\File;
use Illuminate\Support\Facades\Storage;
use SethSharp\BlogCrud\Actions\Files\DestroyFileAction;

class DestroyFileActionTest extends TestCase
{
    /** @test */
    public function can_destroy_file()
    {
        Storage::fake('s3');

        $uploadedFile = UploadedFile::fake()->image('file.jpg');

        $path = Storage::disk('s3')->put('testing', $uploadedFile);

        $file = File::create([
            'path' => $path,
        ]);

        app(DestroyFileAction::class)($file);

        Storage::assertMissing($uploadedFile->hashName('testing'));
    }
}
