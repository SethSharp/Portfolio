<?php

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

Route::get("/", function() {
    return view("app");
});

Route::controller(\App\Http\Controllers\App::class)->group(function () {
    Route::get('/home', 'home');
    Route::get('/about', 'about');
    Route::get('/qualifications', 'qualifications');
    Route::get('/projects', 'projects');
});
