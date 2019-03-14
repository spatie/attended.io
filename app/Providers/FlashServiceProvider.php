<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;
use Spatie\Flash\Message;

class FlashServiceProvider extends ServiceProvider
{
    public function register()
    {
        Flash::macro('message', function (string $message) {
            return $this->flash(new Message($message, 'flash-message-class'));
        });

        Flash::macro('success', function (string $message) {
            return $this->flash(new Message($message, 'flash-success-class'));
        });

        Flash::macro('error', function (string $message) {
            return $this->flash(new Message($message, 'flash-error-class'));
        });
    }
}
