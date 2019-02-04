<?php

use App\Http\Front\Controllers\Auth\ForgotPasswordController;
use App\Http\Front\Controllers\Auth\LoginController;
use App\Http\Front\Controllers\Auth\RegisterController;
use App\Http\Front\Controllers\Auth\ResetPasswordController;
use App\Http\Front\Controllers\Auth\VerificationController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

    Route::middleware('throttle:6,1')->group(function () {
        Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware('signed');
        Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
