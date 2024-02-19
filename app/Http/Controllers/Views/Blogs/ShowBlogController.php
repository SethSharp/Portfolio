<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): View
    {
        $this->authorize('viewPublic', [Blog::class, $blog]);

        return view('blogs.show', [
            'blog' => $blog
        ]);
    }
}
