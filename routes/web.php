<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProfileController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('staff', StaffController::class);
    Route::get('orders', [CustomerOrderController::class, 'index']) ->name('orders');
    Route::patch('/orders/{id}/accept-order', [CustomerOrderController::class, 'acceptOrder'])->name('orders.acceptorder');
    Route::patch('/orders/{id}/reject', [CustomerOrderController::class, 'rejectOrder'])->name('orders.reject');

});

require __DIR__.'/auth.php';
