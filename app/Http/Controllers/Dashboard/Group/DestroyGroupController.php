<?php

namespace App\Http\Controllers\Dashboard\Group;

use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Group\DestroyGroupRequest;

class DestroyGroupController extends Controller
{
    public function __invoke(Group $group, DestroyGroupRequest $destroyGroupRequest): RedirectResponse
    {
        $this->authorize('manage', Group::class);

        $group->delete();

        return redirect()
            ->route('dashboard.group.index')
            ->with('success', 'Group successfully deleted.');
    }
}
