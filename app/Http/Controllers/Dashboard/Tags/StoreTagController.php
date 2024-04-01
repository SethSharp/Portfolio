<?php

namespace App\Http\Controllers\Dashboard\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use SethSharp\BlogCrud\Actions\Tags\StoreTagAction;
use SethSharp\BlogCrud\Requests\Tags\StoreTagRequest;

class StoreTagController extends Controller
{
    public function __invoke(StoreTagRequest $storeTagRequest, StoreTagAction $storeTagAction): RedirectResponse
    {
        $tag = $storeTagAction($storeTagRequest);

        return redirect()
            ->route('dashboard.tags.index')
            ->with('success', $tag->name . ' successfully stored.');
    }
}
