<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Actions\Blogs\DeleteBlogAction;

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
