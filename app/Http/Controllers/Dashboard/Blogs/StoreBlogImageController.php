<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\File\Actions\StoreFileAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogImageRequest;

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
