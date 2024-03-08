<?php

namespace App\Http\Controllers\Views\Blogs;

use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;

class IndexBlogsController extends Controller
{
    public function __invoke(): View
    {
        return view('blogs.index', [
            'blogs' => Blog::published()->get(),
            'groups' => Group::all()
        ]);
    }
}
