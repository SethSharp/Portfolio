<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\EnvironmentEnum;
use App\Http\Controllers\Controller;

class ShowContactController extends Controller
{
    public function __invoke(): View
    {
        $path = 'pages.seth.contact';
        
        if (config('environment.current') === EnvironmentEnum::BETH->value) {
            $path = 'pages.beth.contact';
        }

        return view($path);
    }
}
