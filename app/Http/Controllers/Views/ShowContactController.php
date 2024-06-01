<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Http\EnvironmentEnum;
use Illuminate\View\View;

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
