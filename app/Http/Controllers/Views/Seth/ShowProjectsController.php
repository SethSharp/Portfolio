<?php

namespace App\Http\Controllers\Views\Seth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowProjectsController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.seth.projects');
    }
}
