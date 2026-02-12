<?php

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::prefix('auth')->name('auth.')->group(function () {
//    Route::post('token', [AuthController::class, 'createToken'])->name('create-token');
//    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
//    Route::post('verify-reset-code', [AuthController::class, 'verifyResetCode'])->name('verify-reset-code');
//    Route::post('reset-password-with-token', [AuthController::class, 'resetPasswordWithToken'])->name('reset-password-with-token');
// });

Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
