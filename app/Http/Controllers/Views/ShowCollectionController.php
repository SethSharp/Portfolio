<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Collection;

class ShowCollectionController extends Controller
{
    public function __invoke(Collection $collection): View
    {
        $collection->blogs()->orderBy('order');
        return view('collection.show', [
            'collection' => $collection
        ]);
    }
}
