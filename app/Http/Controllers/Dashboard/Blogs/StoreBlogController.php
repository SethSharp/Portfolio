<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Actions\StoreBlogAction;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogController extends Controller
{
    public function __invoke(StoreBlogRequest $request, StoreBlogAction $storeBlogAction): RedirectResponse
    {
        $blog = $storeBlogAction($request);

        $drafted = (bool)$request->input('is_draft');

        return redirect()->back()->with('success', $blog->title . ' successfully ' . ($drafted ? 'drafted' : 'published'));
    }
}
