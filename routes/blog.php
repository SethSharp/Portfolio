<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Tags\StoreTagController;
use App\Http\Controllers\Auth\Profile\EditProfileController;
use App\Http\Controllers\Dashboard\Blogs\EditBlogController;
use App\Http\Controllers\Dashboard\Blogs\ShowBlogController;
use App\Http\Controllers\Dashboard\Tags\IndexTagsController;
use App\Http\Controllers\Dashboard\Tags\UpdateTagController;
use App\Http\Controllers\Dashboard\Tags\DestroyTagController;
use App\Http\Controllers\Dashboard\Tags\RestoreTagController;
use App\Http\Controllers\Auth\Profile\DeleteProfileController;
use App\Http\Controllers\Auth\Profile\UpdateProfileController;
use App\Http\Controllers\Dashboard\Blogs\CreateBlogController;
use App\Http\Controllers\Dashboard\Blogs\DeleteBlogController;
use App\Http\Controllers\Dashboard\Blogs\IndexBlogsController;
use App\Http\Controllers\Dashboard\Blogs\UpdateBlogController;
use App\Http\Controllers\Dashboard\Blogs\StoreBlogImageController;
use App\Http\Controllers\Dashboard\Collection\IndexCollectionController;
use App\Http\Controllers\Dashboard\Collection\StoreCollectionController;
use App\Http\Controllers\Dashboard\Collection\UpdateCollectionController;
use App\Http\Controllers\Dashboard\Collection\DestroyCollectionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:admin,author'])->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', IndexBlogsController::class)->name('index');
            Route::post('/create', CreateBlogController::class)->name('create');
            Route::get('/{blog}', ShowBlogController::class)->name('show');
            Route::get('/{blog}/edit', EditBlogController::class)->name('edit');
            Route::post('/store/image', StoreBlogImageController::class)->name('image.store');
            Route::put('/{blog}/update', UpdateBlogController::class)->name('update');
            Route::delete('/{blog}/delete', DeleteBlogController::class)->name('delete');
        });

        Route::prefix('tags')->name('tags.')->group(function () {
            Route::get('/', IndexTagsController::class)->name('index');
            Route::post('/store', StoreTagController::class)->name('store');
            Route::put('/{tag}/update', UpdateTagController::class)->name('update');
            Route::delete('/{tag}/destroy', DestroyTagController::class)->name('destroy');
            Route::put('/restore', RestoreTagController::class)->name('restore');
        });

        Route::prefix('collection')->name('collection.')->group(function () {
            Route::get('/', IndexCollectionController::class)->name('index');
            Route::post('/store', StoreCollectionController::class)->name('store');
            Route::put('/{collection}/update', UpdateCollectionController::class)->name('update');
            Route::delete('/{collection}/destroy', DestroyCollectionController::class)->name('destroy');
        });
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', EditProfileController::class)->name('edit');
        Route::patch('/', UpdateProfileController::class)->name('update');
        Route::delete('/', DeleteProfileController::class)->name('destroy');
    });
});
