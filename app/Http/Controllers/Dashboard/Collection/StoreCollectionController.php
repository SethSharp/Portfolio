<?php

namespace App\Http\Controllers\Dashboard\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Models\Collection;
use App\Http\Requests\Dashboard\Group\StoreCollectionRequest;

class StoreCollectionController extends Controller
{
    public function __invoke(StoreCollectionRequest $storeCollectionRequest): RedirectResponse
    {
        $collection = Collection::create([
            'title' => $storeCollectionRequest->input('title'),
            'description' => $storeCollectionRequest->input('description')
        ]);

        return redirect()
            ->route('dashboard.collection.index')
            ->with('success', $collection->title . ' successfully stored.');
    }
}
