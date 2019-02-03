<?php

use App\Http\Front\Controllers\Events\PastEventsListController;
use App\Http\Front\Controllers\Events\RecentAndUpcomingEventsListController;
use App\Http\Front\Controllers\Events\ShowEventController;
use App\Http\Front\Controllers\ReviewsController;
use App\Http\Front\Controllers\Slots\ClaimSlotController;
use App\Http\Front\Controllers\Slots\ShowSlotController;
use App\Http\Front\Controllers\UsersController;

Route::get('/', RecentAndUpcomingEventsListController::class);
Route::get('/past-events', PastEventsListController::class);

Route::get('/events/{event}', [ShowEventController::class, 'show'])->name('events.show');

Route::get('/slots/{slot}', ShowSlotController::class)->name('slots.show');
Route::post('/slots/{slot}/claim', ClaimSlotController::class)->name('slots.claim');

Route::post('reviews', [ReviewsController::class, 'store'])->name('reviews.store');

Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
