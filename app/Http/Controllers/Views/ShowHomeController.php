<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;

class ShowHomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'blog' => Blog::latest()->first()
        ]);
    }
}
