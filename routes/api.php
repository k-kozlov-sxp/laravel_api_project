<?php

use App\Http\ApiV1\Modules\Bookings\Controllers\BookingController;
use App\Http\ApiV1\Modules\Items\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/items', [ItemController::class, 'index']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items/{itemId}', [ItemController::class, 'show']);
    Route::put('/items/{itemId}', [ItemController::class, 'replace']);
    Route::patch('/items/{itemId}', [ItemController::class, 'update']);
    Route::delete('/items/{itemId}', [ItemController::class, 'destroy']);

    Route::get('/items/{itemId}/bookings', [ItemController::class, 'getAllBookingsForSpecificItem']);
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{bookingId}', [BookingController::class, 'show']);
    Route::put('/bookings/{bookingId}', [BookingController::class, 'replace']);
    Route::patch('/bookings/{bookingId}', [BookingController::class, 'update']);
    Route::delete('/bookings/{bookingId}', [BookingController::class, 'destroy']);
});
