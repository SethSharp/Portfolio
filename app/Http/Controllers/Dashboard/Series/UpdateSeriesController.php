<?php

namespace App\Http\Controllers\Dashboard\Series;

use App\Domain\Blog\Models\Series;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Series\UpdateSeriesRequest;

class UpdateSeriesController extends Controller
{
    public function __invoke(Series $series, UpdateSeriesRequest $updateSeriesRequest): RedirectResponse
    {
        $series->update([
            'title' => $updateSeriesRequest->input('title'),
            'description' => $updateSeriesRequest->input('description')
        ]);

        return redirect()
            ->route('dashboard.series.index')
            ->with('success', $series->name . ' successfully updated.');
    }
}
