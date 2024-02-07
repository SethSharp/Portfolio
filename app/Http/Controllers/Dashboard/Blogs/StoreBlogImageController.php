<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\File\Actions\StoreFileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Actions\StoreBlogAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogImageController extends Controller
{
    public function __invoke(StoreBlogImageRequest $request, StoreFileAction $action): RedirectResponse
    {
        $file = $action($request->file('file'));

        return [
            'path' => ''
        ];
    }
}
