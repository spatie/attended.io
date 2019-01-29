<?php

use App\Http\Front\Controllers\EventsController;

Route::get('events', [EventsController::class, 'index']);
