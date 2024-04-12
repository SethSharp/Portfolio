<?php

namespace App\Http\Controllers\Views\Beth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ShowEducationController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.beth.education');
    }
}
