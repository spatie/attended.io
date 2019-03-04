<?php

namespace App\Providers;

use App\Domain\User\Models\User;
use Illuminate\Support\Str;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    protected function gate()
    {
        Gate::define('viewHorizon', function (User $user) {
            return Str::endsWith($user->email, '@spatie.be');
        });
    }
}
