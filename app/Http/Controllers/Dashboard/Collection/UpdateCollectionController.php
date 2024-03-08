<?php

namespace App\Http\Controllers\Dashboard\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Domain\Blog\Models\Collection;
use App\Http\Requests\Dashboard\Group\UpdateCollectionRequest;

class UpdateCollectionController extends Controller
{
    public function __invoke(Collection $collection, UpdateCollectionRequest $updateCollectionRequest): RedirectResponse
    {
        $collection->update([
            'title' => $updateCollectionRequest->input('title'),
            'description' => $updateCollectionRequest->input('description')
        ]);

        if ($blogs = $updateCollectionRequest->input('blogs')) {
            foreach ($blogs as $index => $blog) {
                $collection->blogs()->updateExistingPivot($blog['id'], [
                    'order' => $index + 1
                ]);
            }
        }

        return redirect()
            ->route('dashboard.collection.index')
            ->with('success', $collection->title . ' successfully updated.');
    }
}
