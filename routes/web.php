<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/travel-details/{id}', [WelcomeController::class, 'showTravelDetails'])->name('travel.details');
Route::get('/travel-request', [WelcomeController::class, 'travelRequest'])->name('travel.request');

Route::get('/news/{id}', [WelcomeController::class, 'showNewsDetails'])->name('news.details');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
