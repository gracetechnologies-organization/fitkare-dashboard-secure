<?php

Route::middleware('admin_guard')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('/employees', [AdminController::class, 'employees'])->name('admin.employees');
    Route::get('/order', [AdminController::class, 'orders'])->name('admin.orders');
    Route::resource('/menu-items', ProductController::class);
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/update-admin', [AdminController::class, 'update_admin'])->name('admin.update');
    Route::post('/update-password', [AdminController::class, 'update_admin_password'])->name('admin.update_password');
});