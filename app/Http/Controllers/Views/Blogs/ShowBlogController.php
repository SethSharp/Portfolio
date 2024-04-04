<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): View
    {
        $this->authorize('show', [Blog::class, $blog]);

        return view('blogs.show', [
            'blog' => $blog,
        ]);
    }
}
