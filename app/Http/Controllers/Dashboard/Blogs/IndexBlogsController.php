<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Blog::class);

        return Inertia::render('Dashboard/Blogs/Index', [
            'blogs' => Blog::with(['tags', 'author'])->get()
        ]);
    }
}
