<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ObatController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:20,1')
        ->name('login.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ================= MODUL A: MANAJEMEN PASIEN =================


    // ================= MODUL B: DOKTER & MEDIS ===================
    Route::middleware('role:admin')->group(function () {
        Route::get('/dokters/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('/dokters', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('/dokters/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::put('/dokters/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
        Route::delete('/dokters/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    });

    Route::middleware('role:admin,user')->group(function () {
        Route::get('/dokters', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('/dokters/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    });

    // ================= MODUL C: KATALOG FARMASI ==================
    Route::middleware('role:admin,user')->group(function () {
        Route::get('/obats', [ObatController::class, 'index'])->name('obats.index');
        Route::get('/obats/{obat}', [ObatController::class, 'show'])->name('obats.show');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/obats/create', [ObatController::class, 'create'])->name('obats.create');
        Route::post('/obats', [ObatController::class, 'store'])->name('obats.store');
        Route::get('/obats/{obat}/edit', [ObatController::class, 'edit'])->name('obats.edit');
        Route::put('/obats/{obat}', [ObatController::class, 'update'])->name('obats.update');
        Route::delete('/obats/{obat}', [ObatController::class, 'destroy'])->name('obats.destroy');
    });

    // ================= MODUL D: RUANG POLIKLINIK =================

});