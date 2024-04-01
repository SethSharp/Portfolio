<?php

namespace App\Http\Controllers\Dashboard\Tags;

use SethSharp\BlogCrud\Models\Blog\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Requests\Tags\StoreTagRequest;

class StoreTagController extends Controller
{
    public function __invoke(StoreTagRequest $storeTagRequest): RedirectResponse
    {
        $tag = Tag::create([
            'name' => $storeTagRequest->input('name')
        ]);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', $tag->name . ' successfully stored.');
    }
}
