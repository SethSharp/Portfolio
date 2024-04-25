<?php

namespace App\Http\Controllers\Views\Blogs;

use App\Http\EnvironmentEnum;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowBlogController extends Controller
{
    public function __invoke(Blog $blog): View
    {
        $this->authorize('show', [Blog::class, $blog]);

        $path = 'pages.seth.blogs.show';

        if (config('environment.current') === EnvironmentEnum::BETH->value) {
            $path = 'pages.beth.blogs.show';
        }

        return view($path, [
            'blog' => $blog,
        ]);
    }
}
