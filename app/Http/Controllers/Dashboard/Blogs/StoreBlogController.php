<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use App\Domain\Blog\Actions\StoreBlogAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;
use Illuminate\Http\RedirectResponse;

class StoreBlogController extends Controller
{
    public function __invoke(StoreBlogRequest $request, StoreBlogAction $storeBlogAction): RedirectResponse
    {
        $blog = $storeBlogAction($request);

        $drafted = (bool)$request->input('draft');

        return redirect()->back()->with('success', $blog . ' has successfully been ' . $drafted ? 'drafted' : 'published' . '!');
    }
}
