<?php

/*
|==========================================================================
| Part 1 — Coding Questions
| These are standalone code answers. The actual implementations live in
| the controller and repository files.
|==========================================================================
*/

/*
|--------------------------------------------------------------------------
| Question 1 — Eloquent Query
|--------------------------------------------------------------------------
| Get all active users, newest first.
*/

// $users = \App\Models\User::where('status', 'active')
//              ->orderBy('created_at', 'desc')
//              ->get();


/*
|--------------------------------------------------------------------------
| Question 2 — Routing (see routes/web.php for the actual route)
|--------------------------------------------------------------------------
|
| Route::get('/dashboard', [DashboardController::class, 'index'])
|     ->middleware('auth')
|     ->name('dashboard');
|
| I used the 'auth' middleware because it's the built-in Laravel guard
| that redirects anyone who isn't logged in to the login page.
| No need to reinvent the wheel here — it does exactly what's needed.
*/


/*
|--------------------------------------------------------------------------
| Question 3 — storeClientDetails (see ClientController.php)
|--------------------------------------------------------------------------
|
| The method lives in ClientController@storeClientDetails.
| It validates the request, passes the data to ClientRepository::create(),
| and returns a JSON response like the one below:
|
| {
|     "status": "success",
|     "client": { ...client fields... }
| }
|
| The ClientRepository is in app/Repositories/ClientRepository.php
*/
