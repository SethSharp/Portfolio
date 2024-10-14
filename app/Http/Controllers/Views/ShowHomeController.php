<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\EnvironmentEnum;
use App\Http\Controllers\Controller;

class ShowHomeController extends Controller
{
    public function __invoke(): View
    {
        $path = 'pages.seth.home';

        if (config('environment.current') === EnvironmentEnum::BETH->value) {
            $path = 'pages.beth.home';
        }

        return view($path, [
            'blogs' => [] //Blog::published()->orderByDesc('published_at')->take(3)->get()
        ]);
    }
}
