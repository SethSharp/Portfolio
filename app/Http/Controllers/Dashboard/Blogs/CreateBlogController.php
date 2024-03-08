<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Models\Collection;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Blogs/Create', [
            'collections' => Collection::all(),
            'tags' => Tag::all(),
        ]);
    }
}
