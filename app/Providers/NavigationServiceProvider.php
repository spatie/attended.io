<?php

namespace App\Providers;

use App\Http\Front\Controllers\EventAdmin\Events\MyEventsController;
use App\Http\Front\Controllers\Events\PastEventsListController;
use App\Http\Front\Controllers\Events\RecentAndUpcomingEventsListController;
use Illuminate\Support\ServiceProvider;

use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('events', function () {
            return Menu::new()
                ->action(RecentAndUpcomingEventsListController::class, 'Recent and upcoming')
                ->action(PastEventsListController::class, 'Past events')
                ->action([MyEventsController::class, 'index'], 'My events');
        });
    }
}
