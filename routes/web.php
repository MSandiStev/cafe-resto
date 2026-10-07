<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

// --- Halaman Publik ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{product}', [MenuController::class, 'show'])->name('menu.show');

// --- Keranjang ---
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

// --- Checkout dan Lacak Pesanan ---
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/pesanan/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/lacak', [TrackingController::class, 'create'])->name('tracking.index');
Route::post('/lacak', [TrackingController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('tracking.store');

// --- Akun Pelanggan ---
Route::get('/dashboard', [AccountController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Auth Routes (Breeze) ---
require __DIR__.'/auth.php';
Route::redirect('/admin/login', '/login');
