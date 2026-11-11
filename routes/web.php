<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.attempt');
});

// Hanya admin; middleware role berjalan SETELAH auth karena berada di dalam grup auth
Route::get('/pengguna', [PenggunaController::class, 'index'])
    ->middleware('role:admin')
    ->name('pengguna.index');

// Halaman internal: hanya bisa dibuka bila SUDAH login
Route::middleware(['auth', 'no-back'])->group(function () {


Route::get('/', fn()=>redirect()->route('dashboard'));
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Data KRS
// 1) Endpoint JSON DataTables
Route::get('/krs/data', [KrsController::class, 'data'])->name('krs.data');

// 2) Tambah, ubah, hapus: khusus admin (role berjalan SETELAH auth)
Route::middleware('role:admin')->group(function () {
    Route::resource('krs', KrsController::class)
        ->except(['index', 'show']);
    });

// 3) Daftar dan detail: semua pengguna yang sudah login
Route::resource('krs', KrsController::class)
    ->only(['index', 'show']);

// Data Mata Kuliah 
// 1) Endpoint JSON DataTables
Route::get('/matakuliah/data', [MataKuliahController::class, 'data'])->name('matakuliah.data');

// 2) Tambah, ubah, hapus: khusus admin (role berjalan SETELAH auth)
Route::middleware('role:admin')->group(function () {
    Route::resource('matakuliah', MataKuliahController::class)
        ->except(['index', 'show']);
    });

// 3) Daftar dan detail: semua pengguna yang sudah login
Route::resource('matakuliah', MataKuliahController::class)->only(['index', 'show']);

// Data Mahasiswa
// 1) Endpoint JSON DataTables
Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])->name('mahasiswa.data');

// 2) Tambah, ubah, hapus: khusus admin (role berjalan SETELAH auth)
Route::middleware('role:admin')->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)
        ->except(['index', 'show']);
    });

// 3) Daftar dan detail: semua pengguna yang sudah login
Route::resource('mahasiswa', MahasiswaController::class)->only(['index', 'show']);

// Data Dosen
// 1) Endpoint JSON DataTables: HARUS di atas route yang memuat {dosen}
Route::get('/dosen/data', [DosenController::class, 'data'])->name('dosen.data');

// 2) Tambah, ubah, hapus: khusus admin (role berjalan SETELAH auth)
Route::middleware('role:admin')->group(function () {
    Route::resource('dosen', DosenController::class)
        ->except(['index', 'show']);
    });

// 3) Daftar dan detail: semua pengguna yang sudah login
Route::resource('dosen', DosenController::class)
    ->only(['index', 'show']);
});