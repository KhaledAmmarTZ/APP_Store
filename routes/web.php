<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StaffRegistrationController;
use App\Http\Controllers\StaffProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/staff/confirm', [StaffRegistrationController::class, 'confirm'])->name('staff.confirm');
Route::get('/staff/password/setup', [StaffRegistrationController::class, 'showPasswordSetupForm'])->name('staff.password.setup');
Route::post('/staff/password/setup', [StaffRegistrationController::class, 'setupPassword'])->name('staff.password.store');

Route::middleware(['auth:staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    Route::get('/staff/profile', [StaffProfileController::class, 'edit'])->name('staff.profile.edit');
    Route::patch('/staff/profile', [StaffProfileController::class, 'update'])->name('staff.profile.update');
    Route::get('/staff/profile/password', [StaffProfileController::class, 'showUpdatePasswordForm'])->name('staff.profile.show-update-password');
    Route::patch('/staff/profile/password', [StaffProfileController::class, 'updatePassword'])->name('staff.profile.update-password');
});

// Staff logout route
Route::post('/staff/logout', function (Request $request) {
    Auth::guard('staff')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('staff.logout');

// User logout route
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/admin-staff.php';