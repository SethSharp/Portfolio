<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class ShowSitemapController extends Controller
{
    public function __invoke(): View
    {
        return view('sitemap', [
            'blogs' => Blog::published()->get()
        ]);
    }
}
