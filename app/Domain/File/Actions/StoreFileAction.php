<?php

namespace App\Domain\File\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    public function __invoke(UploadedFile $file): string
    {
        $structure = app()->environment('local') ? 'testing/' : 'production/';

        $dir = $structure . 'blogs/images';

        $path = Storage::disk('s3')->put($dir, $file);

        return Storage::disk('s3')->url($path);
    }
}
