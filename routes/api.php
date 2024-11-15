<?php

use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\StationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('throttle:limiter')->group(function () {
    // test endpoint for rate limiting
    Route::get('/test-limit', function() {
        return response()->json([
            'message' => 'If you see this more than 3 times per minute, rate limiting is not working',
            'timestamp' => now()->toTimeString()
        ]);
    });

    // we want to pass the user through middleware for token authentication
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    // pass all my endpoints through middleware for secure token authentication
    // Constituencies routes
    Route::prefix('constituencies')->group(function () {
        Route::get('/constituencies', [ConstituencyController::class, 'index']);
        Route::get('/constituency/{id}', [ConstituencyController::class, 'show']); 
    });

    // Polling districts routes
    Route::prefix('polling-districts')->group(function () {
        Route::get('/polling-districts', [DistrictController::class, 'index']); 
        Route::get('/polling-districts/{id}', [DistrictController::class, 'show']); 
    });

    // Polling stations routes
    Route::prefix('polling-stations')->group(function () {
        Route::get('/polling-stations', [StationController::class, 'index']);
    }); 
});