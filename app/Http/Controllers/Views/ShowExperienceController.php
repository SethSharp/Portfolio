<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowExperienceController extends Controller
{
    public function __invoke(): View
    {
        return view('experiences');
    }
}
