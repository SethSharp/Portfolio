<?php

namespace App\Http\Controllers\Dashboard\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Actions\Collections\StoreCollectionAction;
use SethSharp\BlogCrud\Requests\Collection\StoreCollectionRequest;

class StoreCollectionController extends Controller
{
    public function __invoke(StoreCollectionRequest $storeCollectionRequest): RedirectResponse
    {
        $collection = app(StoreCollectionAction::class)($storeCollectionRequest);

        return redirect()
            ->route('dashboard.collection.index')
            ->with('success', $collection->title . ' successfully stored.');
    }
}
