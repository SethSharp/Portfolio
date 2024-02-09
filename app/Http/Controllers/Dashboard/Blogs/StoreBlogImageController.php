<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\File\Models\File;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;
use Illuminate\Support\Facades\DB;

class StoreBlogImageController extends Controller
{
    public function __invoke(StoreBlogImageRequest $request, StoreFileAction $action): JsonResponse
    {
        $path = $action($request->file('file'));
        $file = null;

        // 2. Determine if this image is a temporary image
        $blogId = intval($request->input('blogId')) ?: DB::table('blogs')->max('id') + 1;


        // this case we are: Editing an image
        if ($fileId = $request->input('fileId') !== "null") {
            $file = File::whereId($fileId)->first();

            $file->update([
                'temporary_path' => $path
            ]);
        } else {
            // in store blog we search for files like this which do not have a blog id
            // blog_id will be updated

            $file = File::create([
                'blog_id' => $blogId,
                'path' => $path,
                'temporary_path' => null
            ]);
        }

        return response()->json([
            'fileId' => $file->id,
            'blogId' => $blogId,
            'path' => 'https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
        ]);
    }
}
