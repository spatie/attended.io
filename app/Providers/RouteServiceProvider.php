<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Slot;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this
            ->registerBindings()
            ->mapApiRoutes()
            ->mapWebRoutes();
    }

    protected function registerBindings()
    {
        Route::bind('event', function (string $idSlug) {
            [$id] = explode('-', $idSlug);

            return Event::find($id);
        });

        Route::bind('slot', function (string $idSlug) {
            [$id] = explode('-', $idSlug);

            return Slot::find($id);
        });

        return $this;
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

        return $this;
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->prefix('auth')
            ->group(base_path('routes/auth.php'));

        Route::middleware('web')
            ->group(base_path('routes/front.php'));

        return $this;
    }
}
