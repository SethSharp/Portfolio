<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class IndexBlogsController extends Controller
{
    public function __invoke(): View
    {
        return view('blogs.index', [
            'blogs' => Blog::published()
                ->with('likes')
                ->orderByDesc('published_at')
                ->get(),
            'collection' => Collection::first()
        ]);
    }
}
