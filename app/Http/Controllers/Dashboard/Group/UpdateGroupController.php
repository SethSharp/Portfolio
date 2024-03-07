<?php

namespace App\Http\Controllers\Dashboard\Group;

use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Group\UpdateGroupRequest;

class UpdateGroupController extends Controller
{
    public function __invoke(Group $group, UpdateGroupRequest $updateGroupRequest): RedirectResponse
    {
        $group->update([
            'title' => $updateGroupRequest->input('title'),
            'description' => $updateGroupRequest->input('description')
        ]);

        $blogs = $updateGroupRequest->input('blogs');

        foreach ($blogs as $index => $blog) {
            $group->blogs()->updateExistingPivot($blog['id'], [
                'order' => $index + 1
            ]);
        }

        return redirect()
            ->route('dashboard.group.index')
            ->with('success', $group->title . ' successfully updated.');
    }
}
