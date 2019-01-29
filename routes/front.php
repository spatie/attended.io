<?php

use App\Http\Front\Controllers\EventsController;
use App\Http\Front\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/events/{event}', [EventsController::class, 'show'])->name('events.show');

