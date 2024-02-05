<?php

namespace App\Domain\File\Actions;

use App\Domain\File\Models\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __invoke(UploadedFile $file): File
    {
        $img = Image::make($file)
            ->fit(300)
            ->encode();

        $dir = app()->environment('local')
            ? 'testing/'
            : 'production';

        $path = $file->hashName(path: $dir . 'categories');

        Storage::disk(config('filesystems.default'))
            ->put($path, $img, 'public');

        return File::create([
            'path' => app()->environment('local')
                ? $path
                : Storage::url($path)
        ]);
    }
}
