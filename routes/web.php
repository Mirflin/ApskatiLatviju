<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\apiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ServicesController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Travels
Route::get('/travels', [TravelController::class, 'index'])->name('travels.index');
Route::get('/travels/travel-details/{id}', [TravelController::class, 'showTravelDetails'])->name('travel.details');
Route::post('/travels/{travel_id}/review', [TravelController::class, 'storeReview'])->name('travel.review.store');

// Find by check
Route::match(['get', 'post'], '/my-checks', [WelcomeController::class, 'myChecks'])->name('my.checks');

// News
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'showNewsDetails'])->name('news.details');

// Support
Route::get('/support', [SupportController::class, 'support'])->name('support');
Route::post('/support/send-ticket', [apiController::class, 'createTicket'])->name('send.ticket');
Route::post('/support/submit', [apiController::class, 'createTicket'])->name('ticket.submit');

// Services
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/service-request', [ServicesController::class, 'serviceRequest'])->name('service.request');

// About
Route::get('/about', [AboutController::class, 'about'])->name('about');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';