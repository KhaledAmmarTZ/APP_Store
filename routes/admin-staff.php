<?php
use App\Http\Controllers\Admin\StaffController;

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('staff', StaffController::class);
});