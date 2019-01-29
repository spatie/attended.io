<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this
            ->mapApiRoutes()
            ->mapWebRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->group(base_path('routes/api.php'))
            ->middleware('api');

        return $this;
    }

    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->group(base_path('routes/auth.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        return $this;
    }


}
