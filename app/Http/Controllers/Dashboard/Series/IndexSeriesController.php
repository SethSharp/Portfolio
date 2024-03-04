<?php

namespace App\Http\Controllers\Dashboard\Series;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Models\Series;
use App\Http\Controllers\Controller;

class IndexSeriesController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('manage', Series::class);

        return Inertia::render('Dashboard/Series/Index', [
            'allSeries' => Series::with('blogs')->get()
        ]);
    }
}
