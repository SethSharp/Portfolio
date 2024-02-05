<?php

namespace App\Http\Controllers\Dashboard\Files;

use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;
use Inertia\Inertia;
use Inertia\Response;

class CreateFileController extends Controller
{
    public function __invoke(StoreFileAction $action): Response
    {
        return Inertia::render('Dashboard/Files/Create');
    }
}
