<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Tags\StoreTagRequest;

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
