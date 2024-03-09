<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): View
    {
        if ($blog->isDraft()) {
            if (auth()->check()) {
                if (!auth()->user()->hasRole([User::ROLE_ADMIN])) {
                    abort(403, 'Blog is currently in a draft status');
                }
            } else {
                abort(403, 'Blog is currently in a draft status');
            }
        }

        return view('blogs.show', [
            'blog' => $blog,
        ]);
    }
}
