<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

// Vendor Management (requires admin authentication)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/vendors', [VendorController::class, 'listVendors'])->name('admin.vendors');
    Route::post('/admin/vendors/{vendor}/approve', [VendorController::class, 'approveVendor'])->name('admin.vendors.approve');
    Route::post('/admin/vendors/{vendor}/decline', [VendorController::class, 'declineVendor'])->name('admin.vendors.decline');
});

// Admin Authentication (login/logout)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store']);
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');
});

// Admin Password Reset (for guests)
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('admin.password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('admin.password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('admin.password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('admin.password.store');
});

// Admin Panel (requires admin authentication)
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/profiles', fn() => view('admin.profiles'))->name('admin.profiles');
    Route::get('/profiles/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profiles/edit', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profiles/edit', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');

    // Email Verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('admin.verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('admin.verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    // Password Confirmation & Update
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');
});
