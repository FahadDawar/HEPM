<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicianController;
use App\Http\Controllers\ClinicianProfileController;
use App\Http\Controllers\ClinicianAuth\PasswordController;
use App\Http\Controllers\ClinicianAuth\NewPasswordController;
use App\Http\Controllers\ClinicianAuth\VerifyEmailController;
use App\Http\Controllers\ClinicianAuth\RegisteredUserController;
use App\Http\Controllers\ClinicianAuth\PasswordResetLinkController;
use App\Http\Controllers\ClinicianAuth\ConfirmablePasswordController;
use App\Http\Controllers\ClinicianAuth\AuthenticatedSessionController;
use App\Http\Controllers\ClinicianAuth\EmailVerificationPromptController;
use App\Http\Controllers\ClinicianAuth\EmailVerificationNotificationController;

Route::middleware('guest:clinician')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:clinician')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});


// Clinician routes
Route::middleware('auth:clinician')->group(function () {

    // Profile routes
    Route::get('profile', [ClinicianProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ClinicianProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ClinicianProfileController::class, 'destroy'])->name('profile.destroy');
    // Image routes
    Route::get('images', [ClinicianController::class, 'index'])->name('images');
    Route::post('images', [ClinicianController::class, 'store'])->name('images.store');
    Route::get('images/{filename}', [ClinicianController::class, 'show_image'])->name('images.show');
    Route::post('images/{image}/innotate', [ClinicianController::class, 'innotate_image'])->name('images.innotate');
    // download image
    Route::get('images/{filename}/download', [ClinicianController::class, 'download_image'])->name('images.download');
    // Dashboard route
    Route::get('/', [ClinicianController::class, 'dashboard'])->name('dashboard');

});

