<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Blog::class);

        return Inertia::render('Dashboard/Blogs/Index', [
            'publishedBlogs' => Blog::with(['tags', 'author', 'likes'])
                ->orderByDesc('created_at')
                ->published()
                ->get()
                ->each(fn (Blog $blog) => $blog->append('cover')),
            'draftBlogs' => Blog::with(['tags', 'author', 'likes'])
                ->orderByDesc('created_at')
                ->notPublished()
                ->get()
                ->each(fn (Blog $blog) => $blog->append('cover')),
        ]);
    }
}
