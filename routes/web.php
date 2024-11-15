<?php

use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

// Apply rate limiting to homepage
Route::get('/', function() {
    return view('welcome');  // or whatever your homepage view is
})->middleware('throttle:limiter');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// route for handling uploading excel file
// Route::controller(FileUploadController::class)->group(function () {
//     Route::view('/uploads', 'dashboard');
//     Route::post('/uploads', 'uploading');
// });
Route::get('/uploads', [FileUploadController::class, 'show'])->name('uploads');
Route::post('/uploads', [FileUploadController::class, 'uploading'])->name('uploads');

// Search 
Route::controller(SearchController::class)->group(function () {
    Route::get('search', 'search');
});

// Constituencies
Route::controller(ConstituencyController::class)->group(function () {
    Route::get('constituencies', 'index');
    Route::get('/constituency/{id}', 'show');
});


// Districts
Route::controller(DistrictController::class)->group(function () {
    Route::get('polling-districts', 'index');
    Route::get('/polling-districts/{id}', 'show');
});


// Stations
Route::controller(StationController::class)->group(function(){
    Route::get('polling-stations', 'index');
});

require __DIR__.'/auth.php';
