<?php

use App\Http\Front\Controllers\Events\ShowEventController;
use App\Http\Front\Controllers\Events\RecentAndUpcomingEventsListController;
use App\Http\Front\Controllers\ReviewsController;
use App\Http\Front\Controllers\SlotsController;
use App\Http\Front\Controllers\UsersController;

Route::get('/', [RecentAndUpcomingEventsListController::class, 'index']);

Route::get('/events/{event}', [ShowEventController::class, 'show'])->name('events.show');

Route::get('/slots/{slot}', [SlotsController::class, 'show'])->name('slots.show');

Route::post('reviews', [ReviewsController::class, 'store'])->name('reviews.store');

Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
