<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\File\Models\File;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Domain\File\Actions\StoreFileAction;
use App\Domain\File\Actions\DestroyFileAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;

class StoreBlogImageController extends Controller
{
    public function __invoke(StoreBlogImageRequest $request, StoreFileAction $action): JsonResponse
    {
        $path = $action($request->file('file'));
        $url = Storage::disk('s3')->url($path);

        $fileId = intval($request->input('fileId'));
        $blogId = intval($request->input('blogId')) ?: null;

        if ($fileId) {
            $file = File::whereId($fileId)->first();

            $deleted = app(DestroyFileAction::class)($file);

            if ($deleted) {
                $file->update([
                    'path' => $path,
                    'url' => $url,
                ]);
            } else {
                return response()->json([
                    'failed' => $deleted
                ]);
            }
        } else {
            $file = File::create([
                'blog_id' => null,
                'path' => $path,
                'url' => $url,
            ]);
        }

        return response()->json([
            'fileId' => $file->id,
            'blogId' => $blogId,
            'path' => $url
        ]);
    }
}
