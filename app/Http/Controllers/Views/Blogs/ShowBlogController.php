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
                if (! auth()->user()->hasRole([User::ROLE_ADMIN])) {
                    abort(403, 'Blog is currently in a draft status');
                }
            } else {
                abort(403, 'Blog is currently in a draft status');
            }
        }

        $prev = null;
        $next = null;
        $blogSeries = $blog->collection()->first();

        if ($order = $blogSeries?->getBlogOrder($blog)) {
            $prev = $blogSeries->blogs()->where('order', $order - 1)->first();
            $next = $blogSeries->blogs()->where('order', $order + 1)->first();
        }

        return view('blogs.show', [
            'blog' => $blog,
            'prev' => $prev,
            'next' => $next
        ]);
    }
}
