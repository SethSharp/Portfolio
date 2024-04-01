<?php

namespace App\Http\Controllers\Dashboard\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Models\Blog\Collection;
use SethSharp\BlogCrud\Requests\Collection\DestroyCollectionRequest;

class DestroyCollectionController extends Controller
{
    public function __invoke(Collection $collection, DestroyCollectionRequest $destroyGroupRequest): RedirectResponse
    {
        $this->authorize('manage', Collection::class);

        $collection->delete();

        return redirect()
            ->route('dashboard.collection.index')
            ->with('success', 'CollectionPolicy successfully deleted.');
    }
}
