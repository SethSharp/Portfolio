<?php

namespace App\Http\Controllers\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Blogs/Index', [
            'blogs' => Blog::all()
        ]);
    }
}
