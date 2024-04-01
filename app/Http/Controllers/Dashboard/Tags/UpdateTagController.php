<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Actions\Tags\UpdateTagAction;
use SethSharp\BlogCrud\Requests\Tags\UpdateTagRequest;

class UpdateTagController extends Controller
{
    public function __invoke(Tag $tag, UpdateTagRequest $updateTagRequest, UpdateTagAction $updateTagAction): RedirectResponse
    {
        $tag = $updateTagAction($tag, $updateTagRequest);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', $tag->name . ' successfully updated.');
    }
}
