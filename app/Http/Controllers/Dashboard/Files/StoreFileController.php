<?php

namespace App\Http\Controllers\Dashboard\Files;

use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;
use App\Http\Requests\Dashboard\Files\StoreFileRequest;

class StoreFileController extends Controller
{
    public function __invoke(StoreFileRequest $request, StoreFileAction $action): array
    {
        $file = $action($request->file('file'));

        return [
            'path' => 'https://portfoliotesting.s3.ap-southeast-2.amazonaws.com/testing/categories/pNCrkKF5ZsY5U6jwuivOQHZJ2xD8IhjglP7xq5yu.png' // $file->path
        ];
    }
}
