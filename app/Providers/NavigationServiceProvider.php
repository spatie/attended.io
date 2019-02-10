<?php

namespace App\Providers;

use App\Http\Front\Controllers\EventAdmin\Events\OrganizingEventsController;
use App\Http\Front\Controllers\Events\PastEventsListController;
use App\Http\Front\Controllers\Events\RecentAndUpcomingEventsListController;
use App\Http\Front\Controllers\Events\ShowEventFeedbackController;
use App\Http\Front\Controllers\Events\ShowEventScheduleController;
use App\Http\Front\Controllers\Events\SpeakingAtEventsListController;
use App\Models\Event;
use Illuminate\Support\ServiceProvider;

use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('main', function () {
            return Menu::new()
                ->actionIf(
                    optional(current_user())->organisesEvents(),
                    [OrganizingEventsController::class, 'index'],
                    'Organizing',
                    )
                ->actionIf(
                    optional(current_user())->speaksAtEvents(),
                    SpeakingAtEventsListController::class,
                    'Speaking',
                    );
        });

        Menu::macro('events', function () {
            return Menu::new()
                ->action(RecentAndUpcomingEventsListController::class, 'Recent and upcoming')
                ->action(PastEventsListController::class, 'Past events')
                ->action([OrganizingEventsController::class, 'index'], 'My events');
        });

        Menu::macro('event', function (Event $event) {
            return Menu::new()
                ->action(ShowEventScheduleController::class, 'Schedule', $event->idSlug())
                ->action(ShowEventFeedbackController::class, 'Feedback', $event->idSlug());
        });
    }
}
