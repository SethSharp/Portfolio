<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Tag;

class DestroyTagController extends Controller
{
    public function __invoke(Tag $tag): RedirectResponse
    {
        $this->authorize('destroy', Tag::class);

        $tag->delete();

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', 'Tag successfully deleted.');
    }
}
