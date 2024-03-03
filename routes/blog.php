<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Tags\StoreTagController;
use App\Http\Controllers\Auth\Profile\EditProfileController;
use App\Http\Controllers\Dashboard\Blogs\EditBlogController;
use App\Http\Controllers\Dashboard\Blogs\ShowBlogController;
use App\Http\Controllers\Dashboard\Tags\IndexTagsController;
use App\Http\Controllers\Dashboard\Tags\UpdateTagController;
use App\Http\Controllers\Dashboard\Blogs\StoreBlogController;

use App\Http\Controllers\Dashboard\Files\StoreFileController;
use App\Http\Controllers\Dashboard\Tags\DestroyTagController;
use App\Http\Controllers\Dashboard\Tags\RestoreTagController;
use App\Http\Controllers\Auth\Profile\DeleteProfileController;
use App\Http\Controllers\Auth\Profile\UpdateProfileController;
use App\Http\Controllers\Dashboard\Blogs\CreateBlogController;
use App\Http\Controllers\Dashboard\Blogs\IndexBlogsController;
use App\Http\Controllers\Dashboard\Blogs\UpdateBlogController;
use App\Http\Controllers\Dashboard\Files\CreateFileController;
use App\Http\Controllers\Dashboard\Series\IndexSeriesController;
use App\Http\Controllers\Dashboard\Series\StoreSeriesController;
use App\Http\Controllers\Dashboard\Series\UpdateSeriesController;
use App\Http\Controllers\Dashboard\Blogs\StoreBlogImageController;
use App\Http\Controllers\Dashboard\Series\DestroySeriesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:admin,author'])->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/file/create', CreateFileController::class)->name('files.create');
        Route::post('/file/store', StoreFileController::class)->name('files.store');

        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', IndexBlogsController::class)->name('index');
            Route::get('/create', CreateBlogController::class)->name('create');
            Route::get('/{blog}', ShowBlogController::class)->name('show');
            Route::get('/{blog}/edit', EditBlogController::class)->name('edit');
            Route::post('/store', StoreBlogController::class)->name('store');
            Route::post('/store/image', StoreBlogImageController::class)->name('image.store');
            Route::put('/{blog}/update', UpdateBlogController::class)->name('update');
        });

        Route::prefix('tags')->name('tags.')->group(function () {
            Route::get('/', IndexTagsController::class)->name('index');
            Route::post('/store', StoreTagController::class)->name('store');
            Route::put('/{tag}/update', UpdateTagController::class)->name('update');
            Route::delete('/{tag}/destroy', DestroyTagController::class)->name('destroy');
            Route::put('/restore', RestoreTagController::class)->name('restore');
        });

        Route::prefix('series')->name('series.')->group(function () {
            Route::get('/', IndexSeriesController::class)->name('index');
            Route::post('/store', StoreSeriesController::class)->name('store');
            Route::put('/{series}/update', UpdateSeriesController::class)->name('update');
            Route::delete('/{series}/destroy', DestroySeriesController::class)->name('destroy');
        });
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', EditProfileController::class)->name('edit');
        Route::patch('/', UpdateProfileController::class)->name('update');
        Route::delete('/', DeleteProfileController::class)->name('destroy');
    });
});
