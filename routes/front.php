<?php

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Http\Front\Controllers\Account\ChangePasswordController;
use App\Http\Front\Controllers\Account\SettingsController;
use App\Http\Front\Controllers\EventAdmin\ApproveEventController;
use App\Http\Front\Controllers\EventAdmin\EventsController;
use App\Http\Front\Controllers\EventAdmin\PublishEventController;
use App\Http\Front\Controllers\EventAdmin\SlotsController;
use App\Http\Front\Controllers\EventAdmin\TracksController;
use App\Http\Front\Controllers\Events\AllEventsController;
use App\Http\Front\Controllers\Events\AttendEventController;
use App\Http\Front\Controllers\Events\AttendingEventListController;
use App\Http\Front\Controllers\Events\DoNotAttendEventController;
use App\Http\Front\Controllers\Events\ShowEventFeedbackController;
use App\Http\Front\Controllers\Events\ShowEventScheduleController;
use App\Http\Front\Controllers\Events\SpeakingAtEventsListController;
use App\Http\Front\Controllers\Profile\EventsController as ProfileEventsController;
use App\Http\Front\Controllers\Profile\ReviewsController as ProfileReviewsController;
use App\Http\Front\Controllers\Profile\TalksController;
use App\Http\Front\Controllers\ReviewsController;
use App\Http\Front\Controllers\SearchController;
use App\Http\Front\Controllers\SlotOwnershipClaims\ApproveSlotOwnershipClaimController;
use App\Http\Front\Controllers\SlotOwnershipClaims\RejectSlotOwnershipClaimController;
use App\Http\Front\Controllers\Slots\ClaimSlotController;
use App\Http\Front\Controllers\Slots\ShowSlotController;
use App\Http\Front\Controllers\UsersController;

Route::get('/', AllEventsController::class)->name('events');
Route::get('speaking', SpeakingAtEventsListController::class)->middleware('auth')->name('speaking');
Route::get('attending', AttendingEventListController::class)->middleware('auth')->name('attending');

Route::prefix('organizing')->middleware('auth')->group(function () {
    Route::get('/', [EventsController::class, 'index'])->name('event-admin.events.index');
    Route::get('create', [EventsController::class, 'create'])->name('event-admin.events.create');
    Route::post('create', [EventsController::class, 'store'])->name('event-admin.events.store');
    Route::get('events/{event}', [EventsController::class, 'edit'])->name('event-admin.events.edit');
    Route::post('events/{event}', [EventsController::class, 'update'])->name('event-admin.events.update');
    Route::delete('events/{event}/delete', [EventsController::class, 'destroy'])->name('event-admin.events.delete');
    Route::post('events/{event}/approve', ApproveEventController::class)->name('event-admin.events.approve');
    Route::post('events/{event}/publish', PublishEventController::class)->name('event-admin.events.publish');

    Route::get('events/{event}/tracks', [TracksController::class, 'edit'])->name('event-admin.tracks');
    Route::post('events/{event}/tracks', [TracksController::class, 'update'])->name('event-admin.tracks.update');

    Route::get('events/{event}/slots', [SlotsController::class, 'index'])->name('event-admin.slots');
    Route::get('events/{event}/slots/create', [SlotsController::class, 'create'])->name('event-admin.slots.create');
    Route::post('events/{event}/slots', [SlotsController::class, 'store'])->name('event-admin.slots.store');
    Route::get('events/{event}/slots/{slot}', [SlotsController::class, 'edit'])->name('event-admin.slots.edit');
    Route::post('events/{event}/slots/{slot}', [SlotsController::class, 'update'])->name('event-admin.slots.update');
    Route::delete('events/{event}/slots/{slot}', [SlotsController::class, 'destroy'])->name('event-admin.slots.delete');
});

Route::prefix('/events/{event}')->group(function () {
    Route::get('/', function (Event $event) {
        return redirect()->route('events.show-schedule', $event->idSlug());
    });
    Route::get('schedule', ShowEventScheduleController::class)->name('events.show-schedule');
    Route::get('feedback', ShowEventFeedbackController::class)->name('events.show-feedback');
    Route::post('attend', AttendEventController::class);
    Route::post('do-not-attend', DoNotAttendEventController::class);
});

Route::get('slots/{slot}', ShowSlotController::class)->name('slots.show');
Route::post('slots/{slot}/claim', ClaimSlotController::class)->name('slots.claim');

Route::prefix('slot-ownership-claims/{slotOwnershipClaim}')->group(function () {
    Route::post('approve', ApproveSlotOwnershipClaimController::class)->name('slot-ownership-claims.approve');
    Route::post('reject', RejectSlotOwnershipClaimController::class)->name('slot-ownership-claims.reject');
});

Route::prefix('reviews')->group(function () {
    Route::post('/', [ReviewsController::class, 'store'])->name('reviews.store');
    Route::delete('{review}', [ReviewsController::class, 'delete'])->name('reviews.delete');
});

Route::prefix('profile/{user}')->group(function () {
    Route::get('talks', TalksController::class)->name('profile.talks.show');
    Route::get('events', ProfileEventsController::class)->name('profile.events.show');
    Route::get('reviews', ProfileReviewsController::class)->name('profile.reviews.show');
});

Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('settings', [SettingsController::class, 'edit'])->name('account.settings.edit');
    Route::post('settings', [SettingsController::class, 'update'])->name('account.settings.update');

    Route::get('password', [ChangePasswordController::class, 'edit'])->name('account.password.edit');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('account.password.update');
});

Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');

Route::view('about', 'front.about')->name('about');
Route::view('assets', 'front.assets')->name('assets');

Route::get('search', SearchController::class)->name('search');

Route::get('{slotShortSlug}', function (Slot $slot) {
    return redirect()->route('slots.show', $slot->idSlug());
})->where(['slotShortSlug' => '[a-zA-Z0-9]{6}']);
