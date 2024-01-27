<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StoreBlogController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->back()->with('success', 'stored!');
    }
}
