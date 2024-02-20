<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Actions\StoreBlogAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogController extends Controller
{
    public function __invoke(StoreBlogRequest $storeBlogRequest, StoreBlogAction $storeBlogAction): RedirectResponse
    {
        $blog = $storeBlogAction($storeBlogRequest);

        $drafted = (bool)$storeBlogRequest->input('is_draft');

        return redirect()
            ->route('dashboard.blogs.index')
            ->with('success', $blog->title . ' successfully ' . ($drafted ? 'drafted' : 'published'));
    }
}
