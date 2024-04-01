<?php

namespace App\Http\Controllers\Dashboard\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Collection;
use SethSharp\BlogCrud\Actions\Collections\UpdateCollectionAction;
use SethSharp\BlogCrud\Requests\Collection\UpdateCollectionRequest;

class UpdateCollectionController extends Controller
{
    public function __invoke(Collection $collection, UpdateCollectionRequest $updateCollectionRequest): RedirectResponse
    {
        $collection = app(UpdateCollectionAction::class)($updateCollectionRequest, $collection);

        return redirect()
            ->route('dashboard.collection.index')
            ->with('success', $collection->title . ' successfully updated.');
    }
}
