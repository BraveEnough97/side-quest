<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameServerController;

// Initial page
Route::get('/', [GameServerController::class, 'index'])->name('dashboard');
// To start a server
Route::post('/servers/{id}/start', [GameServerController::class, 'start']);
// To stop a server
Route::post('/servers/{id}/start', [GameServerController::class, 'stop']);


// NOTE: inertia is fine to use if the starting page is completely static
// ie. Doesn't need any data from the backend, at least on initial load
// Explantion of inertia (because I took a bit to understand it): It's great because it solves 2 problems
// 1. With the old method of loading views from a controller, the whole page has to reload. Can't dynamically changes individual parts of a page
// 2. To solve that vue routes became a thing. Great but meant more maintenance because now you have a vue router to manage
// Using inertia means we don't need to manage all the extra stuff
// Not sure where (if at all) it can be used for this project but good to know...
// Route::inertia('/', 'MainDashboard')->name('home');

/*
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
*/
require __DIR__.'/settings.php';
