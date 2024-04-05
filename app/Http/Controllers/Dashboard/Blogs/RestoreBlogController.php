<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Actions\Blogs\RestoreBlogAction;

class RestoreBlogController extends Controller
{
    public function __invoke(Request $request, RestoreBlogAction $restoreBlogAction): RedirectResponse
    {
        $this->authorize('restore', Blog::class);

        $blog = Blog::withTrashed()->whereId($request->input('blog_id'))->first();

        $restoreBlogAction($blog);

        return redirect()
            ->route('dashboard.blogs.index')
            ->with('success', $blog->title . ' successfully restored.');
    }
}
