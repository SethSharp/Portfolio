<?php

namespace App\Http\Controllers\Dashboard\Files;

use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;

class StoreFileController extends Controller
{
    public function __invoke(StoreFileAction $action): array
    {
        return [
            'url' => 'some-url-to-the-image'
        ];
    }
}
