<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\EnvironmentEnum;
use App\Http\Controllers\Controller;
use SethSharp\BlogCrud\Models\Blog\Collection;

class ShowCollectionController extends Controller
{
    public function __invoke(Collection $collection): View
    {
        $blogs = $collection->blogs()->published()->orderByDesc('order')->get();

        $path = 'pages.seth.collection.show';

        if (config('environment.current') === EnvironmentEnum::BETH->value) {
            $path = 'pages.beth.collection.show';
        }

        return view($path, [
            'collection' => $collection,
            'blogs' => $blogs
        ]);
    }
}
