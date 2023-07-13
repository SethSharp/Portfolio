<?php

use App\Http\Controllers\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view("app");
});

Route::controller(App::class)->group(function () {
    Route::get('/about', 'about');
    Route::get('/capabilities', 'capabilities');
    Route::get('/projects', 'projects');
    Route::get('/wil', 'wil');
});
