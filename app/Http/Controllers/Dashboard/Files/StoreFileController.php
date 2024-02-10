<?php

namespace App\Http\Controllers\Dashboard\Files;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Domain\File\Actions\StoreFileAction;
use App\Http\Requests\Dashboard\Files\StoreFileRequest;

class StoreFileController extends Controller
{
    public function __invoke(StoreFileRequest $request, StoreFileAction $action): array
    {
        $result = DB::table('blogs')->max('id');

        // logic here if there is a fileId provided
        dd($request->input('fileId'));

        $file = $action($request->file('file'), $result + 1);

        return [
            'fileId' => $file->id,
            'blogId' => $result,
            'path' => 'https://portfoliotesting.s3.ap-southeast-2.amazonaws.com/testing/categories/pNCrkKF5ZsY5U6jwuivOQHZJ2xD8IhjglP7xq5yu.png' // $file->path
        ];
    }
}
