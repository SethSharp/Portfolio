<?php

namespace App\Domain\File\Actions;

use Intervention\Image\ImageManager;
use League\Flysystem\Visibility;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreBlogCoverAction
{
    public function __invoke(UploadedFile $file, int $blogId, string $path = '/content/'): string
    {
        $newFile = ImageManager::gd()->read($file)->resize(600, 400)->encode();

        $structure = app()->environment('testing') || app()->environment('local')
            ? 'testing/' : 'production/';

        $filename = uniqid() . '_' . $file->getClientOriginalName();

        $path = $structure . 'blogs/' . $blogId . $path . $filename;

        Storage::disk('s3')->put($path, $newFile, Visibility::PUBLIC);

        return $path;
    }
}
