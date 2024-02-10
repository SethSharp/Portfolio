<?php

namespace App\Domain\File\Actions;

use App\Domain\File\Models\File;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;
use Exception;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DestroyFileAction
{
    public function __invoke(File $file): bool
    {
        try {
            Storage::disk('s3')->delete($file->path);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
