<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Actions\UpdateBlogAction;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

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
