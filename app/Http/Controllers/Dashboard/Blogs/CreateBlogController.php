<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

class CreateBlogController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Blogs/Create');
    }
}
