<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Actions\CreateBlogAction;
use Symfony\Component\HttpFoundation\Response;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        $blog = app(CreateBlogAction::class);

        return Inertia::location(route('dashboard.blogs.edit', $blog));
    }
}
