<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Collection;

class ShowCollectionController extends Controller
{
    public function __invoke(Collection $collection): View
    {
        $blogs = $collection->blogs()->published()->orderByDesc('order')->get();

        return view('collection.show', [
            'collection' => $collection,
            'blogs' => $blogs
        ]);
    }
}
