<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowHomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'blog' => Blog::published()->latest()->first()
        ]);
    }
}
