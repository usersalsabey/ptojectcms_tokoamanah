<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk cek koneksi Oracle (tes koneksi database)
Route::get('/cek-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Koneksi ke Oracle berhasil!';
    } catch (\Exception $e) {
        return '❌ Gagal koneksi: ' . $e->getMessage();
    }
});

// Middleware contoh cek umur
Route::get('/cek-umur', function () {
    return 'Selamat datang, kamu cukup umur! 🥳';
})->middleware('check.age');


// ===============================
// ROUTE BARANG
// ===============================
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang/show/{id}', [BarangController::class, 'show'])->name('barang.show');
Route::get('/barang/show-try/{id}', [BarangController::class, 'showTryCatch'])->name('barang.showTryCatch');


// ===============================
// ROUTE KASIR
// ===============================
Route::get('/kasir', [KasirController::class, 'index']);
Route::get('/kasir/create', [KasirController::class, 'create']);
Route::post('/kasir', [KasirController::class, 'store']);
Route::get('/kasir/{id}/edit', [KasirController::class, 'edit']);
Route::put('/kasir/{id}', [KasirController::class, 'update']);
Route::delete('/kasir/{id}', [KasirController::class, 'destroy']);


// ===============================
// ROUTE PEMBELI
// ===============================
Route::get('/pembeli', [PembeliController::class, 'index']);
Route::get('/pembeli/create', [PembeliController::class, 'create']);
Route::post('/pembeli', [PembeliController::class, 'store']);
Route::get('/pembeli/{id}/edit', [PembeliController::class, 'edit']);
Route::put('/pembeli/{id}', [PembeliController::class, 'update']);
Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy']);


// ===============================
// ROUTE TRANSAKSI
// ===============================
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// Pastikan route path panjang/spesifik didahulukan
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

Route::get('/transaksi/{id}/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

// Route detail transaksi (paling bawah agar tidak bentrok)
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');


// ===============================
// ROUTE LAPORAN
// ===============================
Route::get('/laporan', [LaporanController::class, 'index']);


// ===============================
// ROUTE IMAGE
// ===============================
Route::get('/upload', [ImageController::class, 'create'])->name('image.create');
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.delete');
Route::get('/gallery', [ImageController::class, 'gallery'])->name('image.gallery');


// ===============================
// ROUTE AUTH
// ===============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contoh halaman dashboard hanya untuk user sudah login
Route::get('/home', function () {
    return view('home');
})->middleware('auth');


// Optional: route default '/' untuk redirect berdasarkan status login
Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return view('welcome');
    } else {
        return redirect('/login');
    }
});

