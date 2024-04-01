<?php

namespace App\Http\Controllers\Dashboard\Tags;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Tag;

class IndexTagsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Tag::class);

        return Inertia::render('Dashboard/Tags/Index', [
            'tags' => Tag::withTrashed()->get()
        ]);
    }
}
