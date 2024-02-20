<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\ShowHomeController;
use App\Http\Controllers\Views\ShowProjectsController;
use App\Http\Controllers\Views\Blogs\ShowBlogController;
use App\Http\Controllers\Views\ShowExperienceController;
use App\Http\Controllers\Views\ShowCapabiltiesController;
use App\Http\Controllers\Views\Blogs\IndexBlogsController;

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

Route::get('/', ShowHomeController::class)->name('home');
Route::get('/about', ShowHomeController::class)->name('about');
Route::get('/experience', ShowExperienceController::class)->name('experience');
Route::get('/capabilities', ShowCapabiltiesController::class)->name('capabilities');
Route::get('/portfolio', ShowProjectsController::class)->name('projects');

Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', IndexBlogsController::class)->name('index');
    Route::get('/{blog:slug}', ShowBlogController::class)->name('show');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/blog.php';
