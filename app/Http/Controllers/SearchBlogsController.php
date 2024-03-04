<?php

namespace App\Http\Controllers;

use App\Domain\Blog\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchBlogsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $search = $request->input('search');

        return response()->json([
            'data' => $search,
            'blogs' => Blog::where('title', 'LIKE', '%' . $search . '%')->get()
        ]);
    }
}
