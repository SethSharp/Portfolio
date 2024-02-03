<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Domain\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Tags\UpdateTagRequest;

class UpdateTagController extends Controller
{
    public function __invoke(Tag $tag, UpdateTagRequest $updateTagRequest): RedirectResponse
    {
        $tag->update([
            'name' => $updateTagRequest->input('name')
        ]);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', $tag->name . ' successfully updated.');
    }
}
