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

Route::post('/ticket/submit', [apiController::class, 'createTicket'])->name('ticket.submit');
Route::post('/send-ticket', [apiController::class, 'createTicket'])->name('send.ticket');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/api/user-list', [apiController::class, 'userList'])->name('send.user');
    Route::get('/api/top-moderators', [apiController::class, 'activeModerator'])->name('send.moderators');
    Route::get('/api/get-travel-requests', [apiController::class, 'getTravelRequests'])->name('send.travelrequests');
    Route::get('/api/get-service-requests', [apiController::class, 'getServiceRequests'])->name('send.servicerequests');
    Route::get('/api/get-news', [apiController::class, 'getNews'])->name('send.news');
    Route::get('/api/get-travels', [apiController::class, 'getTravels'])->name('send.travels');
    Route::get('/api/get-services', [apiController::class, 'getServices'])->name('send.services');
    Route::get('/api/get-history', [apiController::class, 'getHistory'])->name('send.history');
    Route::get('/api/get-seazons', [apiController::class, 'getSeazons'])->name('send.seazons');
    Route::get('/api/get-travel-groups', [apiController::class, 'getTravelGroups'])->name('send.groups');

    Route::get('/api/get-users', [apiController::class, 'getUsers'])->name('send.users');
    Route::get('/api/get-current-user', [apiController::class, 'getCurrentUser'])->name('send.currentusers');
    Route::post('/api/create-new-user', [apiController::class, 'createNewUser'])->name('create.user');
    Route::post('/api/delete-user', [apiController::class, 'deleteUser'])->name('delete.user');
    Route::post('/api/restore-user', [apiController::class, 'restoreUser'])->name('restore.user');

    Route::post('/api/create-new-service', [apiController::class, 'createNewService'])->name('create.service');
    Route::post('/api/delete-service', [apiController::class, 'deleteService'])->name('delete.service');

    Route::post('/api/create-new-news', [apiController::class, 'createNews'])->name('create.news');
    Route::post('/api/edit-news', [apiController::class, 'editNews'])->name('edit.news');
    Route::post('/api/delete-news', [apiController::class, 'deleteNews'])->name('delete.news');

    Route::post('/api/create-new-travel', [apiController::class, 'createTravel'])->name('create.travel');
    Route::post('/api/edit-travel', [apiController::class, 'editTravel'])->name('edit.travel');
    Route::post('/api/delete-travel', [apiController::class, 'deleteTravel'])->name('delete.travel');
    Route::post('/api/restore-travel', [apiController::class, 'restoreTravel'])->name('restore.travel');

    Route::post('/api/delete-travel-request', [apiController::class, 'deleteTravelRequest'])->name('delete.travelrequest');
    Route::post('/api/delete-service-request', [apiController::class, 'deleteServiceRequest'])->name('delete.servicerequest');
});

require __DIR__.'/auth.php';
