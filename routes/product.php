<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Staff\ProductApprovalController;
use App\Http\Controllers\ReviewController;

Route::middleware(['auth:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
});
Route::middleware(['auth:staff'])->prefix('staff')->group(function () {
    Route::get('/products/pending', [ProductApprovalController::class, 'index'])->name('staff.products.pending');
    Route::post('/products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('staff.products.approve');
    Route::post('/products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('staff.products.reject');
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'adminindex'])->name('admin.products.index');
});

Route::get('/products/{id}', [ProductController::class, 'indexforall'])->name('products-index');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');