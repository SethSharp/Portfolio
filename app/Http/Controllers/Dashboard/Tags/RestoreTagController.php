<?php

namespace App\Http\Controllers\Dashboard\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Tag;

class RestoreTagController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $this->authorize('restore', Tag::class);

        $tag = Tag::withTrashed()->whereId($request->input('tag_id'))->first();

        $tag->restore();

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', 'Tag successfully restored.');
    }
}
