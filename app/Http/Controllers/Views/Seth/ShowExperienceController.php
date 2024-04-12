<?php

namespace App\Http\Controllers\Views\Seth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowExperienceController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.seth.experiences');
    }
}
