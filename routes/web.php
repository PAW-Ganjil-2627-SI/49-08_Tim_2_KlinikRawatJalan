<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Middleware guest & throttle untuk halaman login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:20,1')
        ->name('login.proses');
});

// Semua halaman modul wajib login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ================= MODUL A: MANAJEMEN PASIEN =================
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/pasiens/create', [PasienController::class, 'create'])->name('pasiens.create');
        Route::post('/pasiens', [PasienController::class, 'store'])->name('pasiens.store');
        Route::get('/pasiens/{pasien}/edit', [PasienController::class, 'edit'])->name('pasiens.edit');
        Route::put('/pasiens/{pasien}', [PasienController::class, 'update'])->name('pasiens.update');
        Route::delete('/pasiens/{pasien}', [PasienController::class, 'destroy'])->name('pasiens.destroy');
    });

    Route::middleware(['role:admin,user'])->group(function () {
        Route::get('/pasiens', [PasienController::class, 'index'])->name('pasiens.index');
        Route::get('/pasiens/{pasien}', [PasienController::class, 'show'])->name('pasiens.show');
    });

    // ================= MODUL B: DOKTER & MEDIS ===================


    // ================= MODUL C: KATALOG FARMASI ==================


    // ================= MODUL D: RUANG POLIKLINIK =================

});