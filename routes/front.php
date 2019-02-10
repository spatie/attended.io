<?php

use App\Http\Front\Controllers\EventAdmin\Events\MyEventsController;
use App\Http\Front\Controllers\Events\AttendEventController;
use App\Http\Front\Controllers\Events\DoNotAttendEventController;
use App\Http\Front\Controllers\Events\PastEventsListController;
use App\Http\Front\Controllers\Events\RecentAndUpcomingEventsListController;
use App\Http\Front\Controllers\Events\ShowEventController;
use App\Http\Front\Controllers\ReviewsController;
use App\Http\Front\Controllers\SlotOwnershipClaims\ApproveSlotOwnershipClaimController;
use App\Http\Front\Controllers\SlotOwnershipClaims\RejectSlotOwnershipClaimController;
use App\Http\Front\Controllers\Slots\ClaimSlotController;
use App\Http\Front\Controllers\Slots\ShowSlotController;
use App\Http\Front\Controllers\UsersController;
use App\Models\Slot;

Route::get('/', RecentAndUpcomingEventsListController::class);
Route::get('past-events', PastEventsListController::class);

Route::prefix('my-events')->middleware('auth')->group(function () {
    Route::get('/', [MyEventsController::class, 'index']);
    Route::get('create', [MyEventsController::class, 'create'])->name('event-admin.events.create');
    Route::post('create', [MyEventsController::class, 'store'])->name('event-admin.events.store');
    Route::get('events/{event}', [MyEventsController::class, 'edit'])->name('event-admin.events.edit');
});

Route::prefix('/events/{event}')->group(function () {
    Route::get('/', [ShowEventController::class, 'show'])->name('events.show');
    Route::post('attend', AttendEventController::class);
    Route::post('do-not-attend', DoNotAttendEventController::class);
});

Route::get('slots/{slot}', ShowSlotController::class)->name('slots.show');
Route::post('slots/{slot}/claim', ClaimSlotController::class)->name('slots.claim');

Route::prefix('slot-ownership-claims/{slotOwnershipClaim}')->group(function () {
    Route::post('approve', ApproveSlotOwnershipClaimController::class)->name('slot-ownership-claims.approve');
    Route::post('reject', RejectSlotOwnershipClaimController::class)->name('slot-ownership-claims.reject');
});

Route::post('reviews', [ReviewsController::class, 'store'])->name('reviews.store');

Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');

Route::get('{slotShortSlug}', function (Slot $slot) {
    return redirect()->route('slots.show', $slot->idSlug());
})->where(['slotShortSlug' => '[a-zA-Z0-9]{6}']);
