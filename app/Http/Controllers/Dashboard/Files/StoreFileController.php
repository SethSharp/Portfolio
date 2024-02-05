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
        dd($file);
        return [
            'url' => 'some-url-to-the-image'
        ];
    }
}
