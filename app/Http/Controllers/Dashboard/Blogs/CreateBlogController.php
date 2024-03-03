<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Series;
use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Blogs/Create', [
            'series' => Series::all(),
            'tags' => Tag::all(),
        ]);
    }
}
