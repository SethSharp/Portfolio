<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        $blog->load('tags');

        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog,
            'collections' => Collection::all(),
            'tags' => Tag::all(),
        ]);
    }
}
