<?php

namespace App\Http\Controllers\Blogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class ShowBlogsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Blogs/Index');
    }
}
