<?php

use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/home', [JadwalController::class, 'home'])->name('home');
    Route::prefix('jadwal')->group(function () {
        Route::get('/', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/seimbangkan', [JadwalController::class, 'sortBalanced'])->name('jadwal.seimbangkan');
        Route::post('/store', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::get('/{id}', [JadwalController::class, 'show'])->name('jadwal.show');
        Route::get('/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    });
});