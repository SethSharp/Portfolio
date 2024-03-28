<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Models\Collection;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        $blog->load('tags')
            ->append('cover_image');

        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog,
            'collections' => Collection::all(),
            'tags' => Tag::all(),
        ]);
    }
}
