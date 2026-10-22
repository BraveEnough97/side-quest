<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameServerController;

// Initial page
Route::get('/', [GameServerController::class, 'index'])->name('home');
// To start a server
Route::post('/servers/{id}/start', [GameServerController::class, 'start']);
// To stop a server
Route::post('/servers/{id}/stop', [GameServerController::class, 'stop']);

Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

/*
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
*/
require __DIR__.'/settings.php';
