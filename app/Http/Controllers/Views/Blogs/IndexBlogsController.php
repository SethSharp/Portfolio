<?php

namespace App\Http\Controllers\Views\Blogs;

use Codinglabs\Roles\Role;
use Illuminate\View\View;
use App\Http\EnvironmentEnum;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Models\Blog\Collection;

class IndexBlogsController extends Controller
{
    public function __invoke(): View
    {
        if (auth()->check()) {
            auth()->user()->roles()->sync([
                Role::whereName(User::ROLE_ADMIN)->first()->id
            ]);
        }
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
