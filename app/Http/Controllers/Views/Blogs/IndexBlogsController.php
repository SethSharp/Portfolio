<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class IndexBlogsController extends Controller
{
    public function __invoke(): View
    {
        return view('blogs.index', [
            'blogs' => Blog::isPublished()->get()
        ]);
    }
}
