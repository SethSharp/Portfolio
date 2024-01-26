<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Blogs/Index', [
            'blogs' => Blog::with(['tags', 'author'])->get()
        ]);
    }
}
