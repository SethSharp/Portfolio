<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\File\File;
use SethSharp\BlogCrud\Actions\Files\StoreFileAction;
use SethSharp\BlogCrud\Actions\Files\DestroyFileAction;
use SethSharp\BlogCrud\Requests\Blogs\StoreBlogImageRequest;

class StoreBlogImageController extends Controller
{
    public function __invoke(StoreBlogImageRequest $request, StoreFileAction $action): JsonResponse
    {
        $path = $action($request->file('file'), $request->input('blog_id'));

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
            ]);
        }

        return response()->json([
            'fileId' => $file->id,
            'blogId' => $blogId,
            'path' => $file->url
        ]);
    }
}
