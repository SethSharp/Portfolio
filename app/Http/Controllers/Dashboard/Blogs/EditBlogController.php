<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;
use App\Http\Controllers\Controller;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        $blog->load('tags');

        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog,
            'series' => Series::all(),
            'tags' => Tag::all(),
        ]);
    }
}
