<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        return Inertia::render('Blogs/Show', [
            'blog' => $blog
        ]);
    }
}
