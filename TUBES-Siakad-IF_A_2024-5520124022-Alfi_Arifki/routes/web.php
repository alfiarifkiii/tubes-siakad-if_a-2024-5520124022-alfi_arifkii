<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Halaman awal bawaan Laravel
});

// Jalur yang wajib Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Halaman Dashboard (Bisa diakses Admin & Mahasiswa)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // JALUR KHUSUS ADMIN (Kelola Data Master)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('matakuliah', MatakuliahController::class);
        
        // Admin mengelola jadwal secara penuh (CRUD)
        Route::resource('jadwal', JadwalController::class);
    });

    // JALUR KHUSUS MAHASISWA
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/jadwalku', [JadwalController::class, 'jadwalMahasiswa'])->name('jadwal.mahasiswa');
        
        // Tambahan Rute Cetak PDF
        Route::get('/krs/pdf', [KrsController::class, 'cetakPdf'])->name('krs.pdf');
        
        Route::resource('krs', KrsController::class);
    });

    // Bawaan Profile Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';