<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\StaffRegistrationController;
use App\Http\Controllers\StaffProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Home
Route::get('/', [HomeController::class, 'index']);

// User Dashboard & Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Staff Registration & Password Setup
Route::get('/staff/confirm', [StaffRegistrationController::class, 'confirm'])->name('staff.confirm');
Route::get('/staff/password/setup', [StaffRegistrationController::class, 'showPasswordSetupForm'])->name('staff.password.setup');
Route::post('/staff/password/setup', [StaffRegistrationController::class, 'setupPassword'])->name('staff.password.store');

// Staff Dashboard & Profile
Route::middleware(['auth:staff'])->group(function () {
    Route::get('/staff/dashboard', fn() => view('staff.dashboard'))->name('staff.dashboard');
    Route::get('/staff/profile', [StaffProfileController::class, 'edit'])->name('staff.profile.edit');
    Route::patch('/staff/profile', [StaffProfileController::class, 'update'])->name('staff.profile.update');
    Route::get('/staff/profile/password', [StaffProfileController::class, 'showUpdatePasswordForm'])->name('staff.profile.show-update-password');
    Route::patch('/staff/profile/password', [StaffProfileController::class, 'updatePassword'])->name('staff.profile.update-password');
});

// Staff Logout
Route::post('/staff/logout', function (Request $request) {
    Auth::guard('staff')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('staff.logout');

// User Logout
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Vendor Registration & Password Setup
Route::get('/vendor/register', [VendorController::class, 'showRegistrationForm'])->name('vendor.register.form');
Route::post('/vendor/register', [VendorController::class, 'register'])->name('vendor.register');
Route::get('/vendor/password/setup', [VendorController::class, 'showPasswordSetupForm'])->name('vendor.password.setup');
Route::post('/vendor/password/setup', [VendorController::class, 'setupPassword'])->name('vendor.password.store');

// Vendor Invite Page
Route::view('/vendor', 'vendor-invite')->name('vendor-invite');

// Vendor Dashboard
Route::middleware(['auth:vendor'])->group(function () {
    Route::get('/vendor/dashboard', fn() => view('vendor.dashboard'))->name('vendor.dashboard');
});

// Vendor Logout
Route::post('/vendor/logout', function (Request $request) {
    Auth::guard('vendor')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('vendor.logout');

// Include other route files
require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/admin-staff.php';
require __DIR__.'/product.php';