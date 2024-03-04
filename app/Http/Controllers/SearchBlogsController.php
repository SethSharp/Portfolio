<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Blog\Models\Blog;
use Illuminate\Http\JsonResponse;

class SearchBlogsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $search = $request->input('search');

        return response()->json([
            'blogs' => Blog::where('title', 'LIKE', '%' . $search . '%')->get()
        ]);
    }
}
