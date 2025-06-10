<?php

use App\Http\Controllers\apiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// sections (news, travels)
Route::get('/travels', [WelcomeController::class, 'travels'])->name('travels');
Route::get('/travels/travel-request', [WelcomeController::class, 'travelRequest'])->name('travel.request');
Route::get('/travels/travel-details/{id}', [WelcomeController::class, 'showTravelDetails'])->name('travel.details');

Route::get('/news/{id}', [WelcomeController::class, 'showNewsDetails'])->name('news.details');

Route::get('/my-travels', [WelcomeController::class, 'myTravels'])->name('my.travels');

Route::get('/support', [WelcomeController::class, 'support'])->name('support');

Route::get('/services', [WelcomeController::class, 'services'])->name('services');
Route::get('/services/service-request', [WelcomeController::class, 'serviceRequest'])->name('service.request');

Route::post('/support/send-ticket', [apiController::class, 'createTicket']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
