<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', \App\Http\Controllers\Views\ShowHomeController::class)->name('home');
Route::get('/about', \App\Http\Controllers\Views\ShowHomeController::class)->name('about');
Route::get('/experience', \App\Http\Controllers\Views\ShowExperienceController::class)->name('experience');
Route::get('/capabilities', \App\Http\Controllers\Views\ShowCapabiltiesController::class)->name('capabilities');
Route::get('/portfolio', \App\Http\Controllers\Views\ShowProjectsController::class)->name('projects');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
