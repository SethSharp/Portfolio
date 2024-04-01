<?php

namespace App\Http\Controllers\Dashboard\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Actions\Tags\RestoreTagAction;

class RestoreTagController extends Controller
{
    public function __invoke(Request $request, RestoreTagAction $restoreTagAction): RedirectResponse
    {
        $this->authorize('restore', Tag::class);

        $tag = Tag::withTrashed()->whereId($request->input('tag_id'))->first();

        $restoreTagAction($tag);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', 'Tag successfully restored.');
    }
}
