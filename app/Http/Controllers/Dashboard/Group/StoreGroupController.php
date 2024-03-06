<?php

namespace App\Http\Controllers\Dashboard\Group;

use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Group\StoreGroupRequest;

class StoreGroupController extends Controller
{
    public function __invoke(StoreGroupRequest $storeGroupRequest): RedirectResponse
    {
        $group = Group::create([
            'title' => $storeGroupRequest->input('title'),
            'description' => $storeGroupRequest->input('description')
        ]);

        return redirect()
            ->route('dashboard.group.index')
            ->with('success', $group->title . ' successfully stored.');
    }
}
