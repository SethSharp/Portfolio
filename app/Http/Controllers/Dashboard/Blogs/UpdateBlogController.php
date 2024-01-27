<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UpdateBlogController extends Controller
{
    public function __invoke(Blog $blog): RedirectResponse
    {
        return redirect()->back()->with('success', 'updated!');
    }
}
