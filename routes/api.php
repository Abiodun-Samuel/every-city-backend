<?php

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::apiResource('events', EventController::class);

Route::post('/forms/contact', [FormController::class, 'submitContact']);
Route::post('/forms/prayer', [FormController::class, 'submitPrayer']);
Route::post('/forms/bhop-application', [FormController::class, 'submitBhopApplication']);
Route::post('/forms/mail-list', [FormController::class, 'submitMailList']);

Route::get('/forms', [FormController::class, 'index']);
Route::get('/forms/{form}', [FormController::class, 'show']);
// Route::get('events/{event}', [EventController::class, 'show']);

// Route::middleware(['auth:sanctum'])->group(function () {

//     Route::middleware('role:super_admin|admin')->group(function () {
//         Route::post('events', [EventController::class, 'store']);
//         Route::put('events/{event}', [EventController::class, 'update']);
//         Route::patch('events/{event}', [EventController::class, 'update']);
//         Route::delete('events/{event}', [EventController::class, 'destroy']);
//     });
// });
