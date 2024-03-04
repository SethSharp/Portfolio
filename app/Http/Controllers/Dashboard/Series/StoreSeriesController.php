<?php

namespace App\Http\Controllers\Dashboard\Series;

use App\Domain\Blog\Models\Series;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Dashboard\Series\StoreSeriesRequest;

class StoreSeriesController extends Controller
{
    public function __invoke(StoreSeriesRequest $storeSeriesRequest): RedirectResponse
    {
        $series = Series::create([
            'title' => $storeSeriesRequest->input('title'),
            'description' => $storeSeriesRequest->input('description')
        ]);

        $blogs = $storeSeriesRequest->input('blogs');

        $series->blogs()->sync($blogs);

        return redirect()
            ->route('dashboard.series.index')
            ->with('success', $series->name . ' successfully stored.');
    }
}
