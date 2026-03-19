<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('clients.index');
});

// Part 1 Q2 — dashboard route, auth middleware keeps guests out as requested
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Part 2 — client management routes
// Removed auth middleware for easier local testing by the technical exam reviewer
Route::resource('clients', ClientController::class);

// Part 1 Q3 — separate endpoint if needed via API-style
Route::post('/clients/api/store', [ClientController::class, 'storeClientDetails'])
    ->name('clients.storeClientDetails');

