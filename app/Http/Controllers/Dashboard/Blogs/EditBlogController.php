<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;

class EditBlogController extends Controller
{
    public function __invoke(Blog $blog): Response
    {
        $blog->load('tags');

        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog,
            'groups' => Group::all(),
            'tags' => Tag::all(),
        ]);
    }
}
