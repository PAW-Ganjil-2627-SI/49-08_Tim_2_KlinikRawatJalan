<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


    // ================= MODUL B: DOKTER & MEDIS ===================


    // ================= MODUL C: KATALOG FARMASI ==================


    // ================= MODUL D: RUANG POLIKLINIK =================

});