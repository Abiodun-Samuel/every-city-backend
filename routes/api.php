<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::post('/login', [AuthController::class, 'login']);

Route::post('/forms/contact', [FormController::class, 'submitContact']);
Route::post('/forms/prayer', [FormController::class, 'submitPrayer']);
Route::post('/forms/bhop-application', [FormController::class, 'submitBhopApplication']);
Route::post('/forms/mail-list', [FormController::class, 'submitMailList']);
Route::get('events/{event}', [EventController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/forms', [FormController::class, 'index']);
    Route::get('/forms/{form}', [FormController::class, 'show']);

    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);

    // Route::middleware('role:super_admin|admin')->group(function () {
    // });
});
