<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RegistrationController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/forms/contact', [FormController::class, 'submitContact']);
Route::post('/forms/prayer', [FormController::class, 'submitPrayer']);
Route::post('/forms/bhop-application', [FormController::class, 'submitBhopApplication']);
Route::post('/forms/mail-list', [FormController::class, 'submitMailList']);
Route::get('events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show']);
Route::post('events/{event}/registrations', [RegistrationController::class, 'store']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/forms', [FormController::class, 'index']);
    Route::get('/forms/{form}', [FormController::class, 'show']);
    //events
    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);
    // registration
    Route::get('events/{event}/registrations', [RegistrationController::class, 'index']);
    // dashbaord
    Route::get('dashboard', [DashboardController::class, 'index']);
});
