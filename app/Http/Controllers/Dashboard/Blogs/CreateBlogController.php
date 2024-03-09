<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Models\Collection;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            'slug' => 'this-is-my-blog',
            'title' => 'This is my blog!',
            'content' => '',
            'is_draft' => true,
        ]);

        return Inertia::render('Dashboard/Blogs/Edit', [
            'blog' => $blog,
            'collections' => Collection::all(),
            'tags' => Tag::all(),
        ]);
    }
}
