<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Staff\ProductApprovalController;

Route::middleware(['auth:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

});
Route::middleware(['auth:staff'])->prefix('staff')->group(function () {
    Route::get('/products/pending', [ProductApprovalController::class, 'index'])->name('staff.products.pending');
    Route::post('/products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('staff.products.approve');
    Route::post('/products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('staff.products.reject');
});