<?php

namespace App\Domain\File\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __invoke(UploadedFile $file): string
    {
        $structure = app()->environment('testing') || app()->environment('local')
            ? 'testing/' : 'production/';

        return Storage::disk('s3')->put($structure . 'blogs', $file);
    }
}
