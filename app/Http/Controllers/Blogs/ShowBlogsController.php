<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ShowBlogsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Blogs/Index');
    }
}
