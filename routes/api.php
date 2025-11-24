<?php

use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
// Route::get('events/{event}', [EventController::class, 'show']);

// Route::middleware(['auth:sanctum'])->group(function () {

//     Route::middleware('role:super_admin|admin')->group(function () {
//         Route::post('events', [EventController::class, 'store']);
//         Route::put('events/{event}', [EventController::class, 'update']);
//         Route::patch('events/{event}', [EventController::class, 'update']);
//         Route::delete('events/{event}', [EventController::class, 'destroy']);
//     });
// });
