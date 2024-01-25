<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', \App\Http\Controllers\Dashboard\ShowHomeController::class)->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', \App\Http\Controllers\Auth\Profile\EditProfileController::class)->name('edit');
        Route::patch('/', \App\Http\Controllers\Auth\Profile\UpdateProfileController::class)->name('update');
        Route::delete('/', \App\Http\Controllers\Auth\Profile\DeleteProfileController::class)->name('destroy');
    });
});
