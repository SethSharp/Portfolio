<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Actions\DeleteBlogAction;

class DeleteBlogController extends Controller
{
    public function __invoke(Blog $blog, DeleteBlogAction $deleteBlogAction): RedirectResponse
    {
        $this->authorize('delete', Blog::class);

        $deleteBlogAction($blog);

        return redirect()
            ->route('dashboard.blogs.index')
            ->with('success', $blog->title . ' successfully deleted');
    }
}
