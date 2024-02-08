<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;

class StoreBlogImageController extends Controller
{
    public function __invoke(StoreBlogImageRequest $request, StoreFileAction $action): JsonResponse
    {
        //        $file = $action($request->file('file'));

        return response()->json([
            'path' => 'https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
        ]);
    }
}
