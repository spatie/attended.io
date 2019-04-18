<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class FlashServiceProvider extends ServiceProvider
{
    public function register()
    {
        Flash::levels([
            'message' => 'alert is-message',
            'success' => 'alert is-success',
            'error' => 'alert is-error',
        ]);
    }
}
