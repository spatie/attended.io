<?php

use App\Http\Front\Controllers\Auth\ForgotPasswordController;
use App\Http\Front\Controllers\Auth\LoginController;
use App\Http\Front\Controllers\Auth\ResetPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
