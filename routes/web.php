<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Jadwal_paController;
use Illuminate\Support\Facades\Route;

// Import semua controller
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\JadwalIbadahController;
use App\Http\Controllers\JadwalPaController;
use App\Http\Controllers\WartaMimbarController;
use App\Http\Controllers\JadwalPelayananController;
use App\Http\Controllers\JadwalKegiatanController;
use App\Http\Controllers\PelayanController;
use App\Http\Controllers\PendaftaranKatekesasiController;
use App\Http\Controllers\PublicController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jadwal_ibadah', function () {
    return view('jadwal_ibadah');
});

Route::get('/jadwal_ibadah', [PublicController::class, 'jadwalibadah'])->name('user.jadwal_ibadah');
Route::get('/jadwal-pa', [PublicController::class, 'jadwalpa'])->name('user.jadwal-pa');
Route::get('/kegiatan', [PublicController::class, 'jadwalkegiatan'])->name('user.kegiatan');
Route::get('/warta-mimbar', [PublicController::class, 'wartaMimbar'])->name('user.warta-mimbar');
Route::get('/pendaftaran-katekesasi', [PublicController::class, 'pendaftaranKatekesasi'])->name('user.pendaftaran-katekesasi');
Route::post('/daftar-katekesasi', [PendaftaranKatekesasiController::class, 'simpanPendaftaran'])->name('user.simpan-pendaftaran');

// Route Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Group Middleware Auth
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ----------------------------------------------------
    // ROUTE CRUD (Gunakan Route::resource saja)
    // ----------------------------------------------------

    Route::resource('jemaat', JemaatController::class);
    Route::resource('ibadah', JadwalIbadahController::class);
    Route::resource('warta', WartaMimbarController::class);

    // Ini saja sudah mencakup: index, create, store, edit, update, destroy
    Route::resource('jadwal-kegiatan', JadwalKegiatanController::class);

    Route::resource('jadwal_pa', Jadwal_paController::class);
    Route::resource('pendaftaran_katekesasi', PendaftaranKatekesasiController::class);
    Route::resource('pelayan', PelayanController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});