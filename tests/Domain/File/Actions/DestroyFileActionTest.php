<?php

namespace Tests\Domain\File\Actions;

use Tests\TestCase;
use App\Domain\File\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Domain\File\Actions\DestroyFileAction;

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
