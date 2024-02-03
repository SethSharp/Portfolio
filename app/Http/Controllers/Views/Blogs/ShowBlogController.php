<?php

namespace App\Http\Controllers\Views\Blogs;

use App\Domain\Blog\Models\Blog;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): View
    {
        return view('blogs.show', [
            'blog' => $blog
        ]);
    }
}
