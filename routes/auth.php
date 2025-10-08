<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// ----------------- Guest Routes (only for not-logged-in users) -----------------
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register'); // Show register form
    Route::post('register', [RegisteredUserController::class, 'store']); // Register user

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Show login form
    Route::post('login', [AuthenticatedSessionController::class, 'store']); // Login user

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request'); // Forgot pass form
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email'); // Send reset link

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset'); // Show reset form
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store'); // Update password
});

// ----------------- Auth Routes (only for logged-in users) -----------------
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice'); // Show verify email
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify'); // Verify email

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')->name('verification.send'); // Resend verify mail

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm'); // Confirm pass form
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Confirm password

    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); // Update password
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // Logout user
});