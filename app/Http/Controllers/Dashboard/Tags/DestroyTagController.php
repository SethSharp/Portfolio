<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

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
