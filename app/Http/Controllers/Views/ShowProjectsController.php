<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowProjectsController extends Controller
{
    public function __invoke(): View
    {
        return view('projects');
    }
}
