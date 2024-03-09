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
        $path = $action($request->file('file'), $request->input('blog_id'));
        $url = Storage::disk('s3')->url($path);

        $fileId = intval($request->input('file_id'));
        $blogId = intval($request->input('blog_id'));

        if ($fileId) {
            $file = File::whereId($fileId)->first();

            if ($file) {
                // delete old file
                $deleted = app(DestroyFileAction::class)($file);

                // replace with new
                if ($deleted) {
                    $file->update([
                        'blog_id' => $blogId,
                        'path' => $path,
                        'url' => $url,
                    ]);
                } else {
                    return response()->json([
                        'failed' => $deleted
                    ]);
                }
            }
        } else {
            $file = File::create([
                'blog_id' => $blogId,
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
