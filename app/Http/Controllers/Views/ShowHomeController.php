<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ShowHomeController extends Controller
{
    public function __invoke(): View
    {
        return view('app');
    }
}
