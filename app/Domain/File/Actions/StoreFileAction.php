<?php

namespace App\Domain\File\Actions;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __invoke(UploadedFile $file): string
    {
        // 1. Store the image in our s3 bucket

        //        $img = Image::make($file)->encode();
        //
        //        $dir = app()->environment('local')
        //            ? 'testing/'
        //            : 'production/';
        //
        //        $path = $file->hashName(path: $dir . 'categories');
        //
        //        Storage::disk('s3')
        //            ->put($path, $img, 'public-read');

        return 'some-path';// $path;
    }
}
