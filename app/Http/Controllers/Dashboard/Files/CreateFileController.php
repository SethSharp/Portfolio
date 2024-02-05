<?php

namespace App\Http\Controllers\Dashboard\Files;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;

class CreateFileController extends Controller
{
    public function __invoke(StoreFileAction $action): Response
    {
        return Inertia::render('Dashboard/Files/Create');
    }
}
