<?php

namespace App\Http\Controllers\Dashboard\Collection;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Collection;

class IndexCollectionController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('manage', Collection::class);

        return Inertia::render('Dashboard/Collection/Index', [
            'allCollections' => Collection::with(['blogs' => fn ($q) => $q->orderBy('order')])->get()
        ]);
    }
}
