<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SethSharp\BlogCrud\Actions\Blogs\CreateBlogAction;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        $blog = app(CreateBlogAction::class);

        return Inertia::location(route('dashboard.blogs.edit', $blog));
    }
}
