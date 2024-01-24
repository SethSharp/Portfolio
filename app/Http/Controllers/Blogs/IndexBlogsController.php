<?php

namespace App\Http\Controllers\Blogs;

use App\Domain\Blog\Models\Blog;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Inertia\Response;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Blogs/Index', [
            'blogs' => Blog::all()
        ]);
    }
}
