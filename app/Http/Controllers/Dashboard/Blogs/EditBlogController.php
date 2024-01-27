<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog
        ]);
    }
}
