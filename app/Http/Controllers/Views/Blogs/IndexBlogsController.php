<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use Codinglabs\Roles\Role;
use App\Http\EnvironmentEnum;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class IndexBlogsController extends Controller
{
    public function __invoke(): View
    {
        if (config('environment.current') === EnvironmentEnum::SETH->value) {
            return view('pages.seth.blogs.index', [
                'blogs' => Blog::published()
                    ->with('likes')
                    ->orderByDesc('published_at')
                    ->get(),
                'collection' => Collection::first()
            ]);
        } else {
            return view('pages.beth.blogs.index', [
                'blogs' => Blog::published()
                    ->with('likes')
                    ->orderByDesc('published_at')
                    ->get(),
                'collection' => Collection::first()
            ]);
        }
    }
}
