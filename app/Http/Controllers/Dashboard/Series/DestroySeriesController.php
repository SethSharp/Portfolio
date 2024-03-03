<?php

namespace App\Http\Controllers\Dashboard\Series;

use App\Domain\Blog\Models\Series;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Series\DestroySeriesRequest;

class DestroySeriesController extends Controller
{
    public function __invoke(Series $series, DestroySeriesRequest $destroySeriesRequest): RedirectResponse
    {
        $this->authorize('manage', Series::class);

        $series->delete();

        return redirect()
            ->route('dashboard.series.index')
            ->with('success', 'Series successfully deleted.');
    }
}
