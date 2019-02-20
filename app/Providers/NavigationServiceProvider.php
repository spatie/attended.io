<?php

namespace App\Providers;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use App\Http\Front\Controllers\Account\ChangePasswordController;
use App\Http\Front\Controllers\Account\SettingsController;
use App\Http\Front\Controllers\EventAdmin\EventsController;
use App\Http\Front\Controllers\EventAdmin\EventsController as EventAdminEventsController;
use App\Http\Front\Controllers\EventAdmin\SlotsController;
use App\Http\Front\Controllers\EventAdmin\TracksController;
use App\Http\Front\Controllers\Events\AttendingEventListController;
use App\Http\Front\Controllers\Events\ShowEventFeedbackController;
use App\Http\Front\Controllers\Events\ShowEventScheduleController;
use App\Http\Front\Controllers\Events\SpeakingAtEventsListController;
use App\Http\Front\Controllers\Profile\EventsController as ProfileEventsController;
use App\Http\Front\Controllers\Profile\ReviewsController;
use App\Http\Front\Controllers\Profile\TalksController;
use Illuminate\Support\ServiceProvider;

use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('main', function () {
            return Menu::new()
                ->actionIf(
                    optional(auth()->user())->organisesEvents(),
                    [EventsController::class, 'index'],
                    'Organizing',
                    )
                ->actionIf(
                    optional(auth()->user())->speaksAtEvents(),
                    SpeakingAtEventsListController::class,
                    'Speaking',
                    )
                ->actionIf(
                    optional(auth()->user())->attendsEvents(),
                    AttendingEventListController::class,
                    'Attending',
                    );
        });

        Menu::macro('event', function (Event $event) {
            return Menu::new()
                ->action(ShowEventScheduleController::class, 'Schedule', $event->idSlug())
                ->action(ShowEventFeedbackController::class, 'Feedback', $event->idSlug());
        });

        Menu::macro('eventAdmin', function (Event $event) {
            return Menu::new()
                ->action([EventAdminEventsController::class, 'edit'], 'Details', $event->idSlug())
                ->action([TracksController::class, 'index'], 'Tracks', $event->idSlug())
                ->action([SlotsController::class, 'index'], 'Slots', $event->idSlug());
        });

        Menu::macro('profile', function (User $user) {
            return Menu::new()
                ->action(TalksController::class, 'Talks', $user->idSlug())
                ->action(ProfileEventsController::class, 'Events', $user->idSlug())
                ->action(ReviewsController::class, 'Reviews', $user->idSlug());
        });

        Menu::macro('account', function () {
            return Menu::new()
                ->action([SettingsController::class, 'edit'], 'Profile')
                ->action([ChangePasswordController::class, 'edit'], 'Change password');
        });
    }
}
