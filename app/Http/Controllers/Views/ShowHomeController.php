<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Blog;

class ShowHomeController extends Controller
{
    public function __invoke(): View
    {
        if (config('environment.current') === \App\Http\EnvironmentEnum::SETH->value) {
            return view('pages.seth.home', [
                'blog' => Blog::published()->orderByDesc('published_at')->first()
            ]);
        } else {
            return view('pages.beth.home');
        }
    }
}
