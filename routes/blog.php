<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/home', \App\Http\Controllers\Dashboard\ShowHomeController::class)->name('home');

        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', \App\Http\Controllers\Dashboard\Blogs\IndexBlogsController::class)->name('index');
            Route::get('/create', \App\Http\Controllers\Dashboard\Blogs\CreateBlogController::class)->name('create');
            Route::get('/{blog}', \App\Http\Controllers\Dashboard\Blogs\ShowBlogController::class)->name('show');
            Route::get('/{blog}/edit', \App\Http\Controllers\Dashboard\Blogs\EditBlogController::class)->name('edit');
            Route::post('/store', \App\Http\Controllers\Dashboard\Blogs\StoreBlogController::class)->name('store');
            Route::put('/{blog/update', \App\Http\Controllers\Dashboard\Blogs\UpdateBlogController::class)->name('update');
        });
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', \App\Http\Controllers\Auth\Profile\EditProfileController::class)->name('edit');
        Route::patch('/', \App\Http\Controllers\Auth\Profile\UpdateProfileController::class)->name('update');
        Route::delete('/', \App\Http\Controllers\Auth\Profile\DeleteProfileController::class)->name('destroy');
    });
});
