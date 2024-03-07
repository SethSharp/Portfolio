<?php

namespace App\Http\Controllers\Dashboard\Group;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Group;
use App\Http\Controllers\Controller;

class IndexGroupController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('manage', Group::class);

        return Inertia::render('Dashboard/Group/Index', [
            'allGroups' => Group::with(['blogs' => fn ($q) => $q->orderBy('order')])->whereHas('blogs')->get()
        ]);
    }
}
