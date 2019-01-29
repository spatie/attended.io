<?php

use App\Http\Front\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
