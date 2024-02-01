<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        return Inertia::render('Blogs/Edit', [
            'blog' => $blog
        ]);
    }
}
