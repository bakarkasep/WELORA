<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

// --- HALAMAN PUBLIK (Bisa diakses siapa saja) ---
Route::get('/', [ShopController::class, 'index'])->name('home');

// --- AUTHENTICATION (Login & Register) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- HALAMAN KHUSUS MEMBER (Harus Login Dulu) ---
Route::middleware('auth')->group(function () {
    // Keranjang
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
    Route::get('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.cart');
    Route::get('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/delete/{id}', [ShopController::class, 'deleteCart'])->name('cart.delete');

    // Checkout & Payment
    Route::get('/payment', [ShopController::class, 'payment'])->name('payment');
    Route::post('/payment', [ShopController::class, 'processPayment'])->name('payment.process');

    // Nota
    Route::get('/nota/{id}', [ShopController::class, 'nota'])->name('nota');
});