<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route Login dan Register (hanya dapat diakses oleh guest)
Route::middleware('guest')->group(function () {
    // Route Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Route Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route Logout (hanya dapat diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route untuk halaman yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    // Tambahkan route lain yang memerlukan autentikasi di sini
});