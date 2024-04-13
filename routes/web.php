<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views\ShowHomeController;
use App\Http\Controllers\Views\ShowSitemapController;
use App\Http\Controllers\Views\Blogs\ShowBlogController;
use App\Http\Controllers\Views\ShowCollectionController;
use App\Http\Controllers\Views\Beth\ShowContactController;
use App\Http\Controllers\Views\Blogs\IndexBlogsController;
use App\Http\Controllers\Views\Seth\ShowProjectsController;
use App\Http\Controllers\Views\Beth\ShowEducationController;
use App\Http\Controllers\Views\Seth\ShowExperienceController;

/*
|--------------------------------------------------------------------------
| Rules with these environment routes
|--------------------------------------------------------------------------
|
| 1. Shared routes like home/about/sitemap will have a controller level condition to render pages
| 2. Non shared routes require a 'noindex, nofollow' tag, as these pages are access through route
|    with no protection no matter the environment - to ensure google does not crawl env 1 page
|    for env 2 page
|
*/

// shared routes
Route::get('/', ShowHomeController::class)->name('home');
Route::get('/sitemap', ShowSitemapController::class)->name('sitemap');

// routes specific to seth
Route::get('/experience', ShowExperienceController::class)->name('experience');
Route::get('/projects', ShowProjectsController::class)->name('projects');

// routes specific to beth
Route::get('/education-course-work', ShowEducationController::class)->name('education');
Route::get('/contact', ShowContactController::class)->name('contact');

// public facing blog related routes
Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', IndexBlogsController::class)->name('index');
    Route::get('/{blog:slug}', ShowBlogController::class)->name('show');
});

Route::get('/collection/{collection}', ShowCollectionController::class)->name('collections.show');

require __DIR__ . '/auth.php';
require __DIR__ . '/blog.php';
