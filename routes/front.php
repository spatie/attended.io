<?php

use App\Http\Front\Controllers\EventsController;
use App\Http\Front\Controllers\HomeController;
use App\Http\Front\Controllers\SlotsController;
use App\Http\Front\Controllers\UsersController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/events/{event}', [EventsController::class, 'show'])->name('events.show');
Route::get('/slots/{slot}', [SlotsController::class, 'show'])->name('slots.show');
Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');



