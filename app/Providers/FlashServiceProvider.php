<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;
use Spatie\Flash\Message;

class FlashServiceProvider extends ServiceProvider
{
    public function register()
    {
        Flash::levels([
            'message' => 'flash-message-class',
            'success' => 'flash-success-class',
            'error' => 'flesh-error-class',
        ]);
    }
}
