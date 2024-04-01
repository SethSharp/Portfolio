<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Actions\Tags\DestroyTagAction;

class DestroyTagController extends Controller
{
    public function __invoke(Tag $tag, DestroyTagAction $destroyTagAction): RedirectResponse
    {
        $this->authorize('destroy', Tag::class);

        $destroyTagAction($tag);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', 'Tag successfully deleted.');
    }
}
