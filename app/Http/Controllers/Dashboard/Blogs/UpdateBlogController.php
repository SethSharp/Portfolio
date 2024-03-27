<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use sethsharp\Models\Blog\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use sethsharp\Models\Actions\UpdateBlogAction;
use sethsharp\Models\Requests\UpdateBlogRequest;

class UpdateBlogController extends Controller
{
    public function __invoke(Blog $blog, UpdateBlogRequest $updateBlogRequest, UpdateBlogAction $updateBlogAction): RedirectResponse
    {
        $blog = $updateBlogAction($blog, $updateBlogRequest);

        $drafted = (bool)$updateBlogRequest->input('is_draft');

        return redirect()
            ->route('dashboard.blogs.index')
            ->with('success', $blog->title . ' successfully ' . ($drafted ? 'drafted' : 'published'));
    }
}
