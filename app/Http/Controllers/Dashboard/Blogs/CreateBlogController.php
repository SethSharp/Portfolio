<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class CreateBlogController extends Controller
{
    public function __invoke()
    {
        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            'slug' => 'this-is-my-blog',
            'title' => 'This is my blog!',
            'content' => '',
            'is_draft' => true,
        ]);

        return Inertia::location(route('dashboard.blogs.edit', $blog));
    }
}
