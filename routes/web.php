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

Route::get('/cek-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Koneksi ke Oracle berhasil!';
    } catch (\Exception $e) {
        return '❌ Gagal koneksi: ' . $e->getMessage();
    }
});

Route::get('/cek-umur', function () {
    return 'Selamat datang, kamu cukup umur! 🥳';
})->middleware('check.age');


// Route untuk fitur Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang', [BarangController::class, 'store']);
Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
Route::post('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
Route::get('/barang/show/{id}', [BarangController::class, 'show']);
Route::get('/barang/show-try/{id}', [BarangController::class, 'showTryCatch']);

// Rute untuk fitur kasir
Route::get('/kasir', [KasirController::class, 'index']);
Route::get('/kasir/create', [KasirController::class, 'create']);
Route::post('/kasir', [KasirController::class, 'store']);
Route::get('/kasir/{id}/edit', [KasirController::class, 'edit']);
Route::put('/kasir/{id}', [KasirController::class, 'update']);
Route::delete('/kasir/{id}', [KasirController::class, 'destroy']);

// Route untuk fitur pembeli
Route::get('/pembeli', [PembeliController::class, 'index']);
Route::get('/pembeli/create', [PembeliController::class, 'create']);
Route::post('/pembeli', [PembeliController::class, 'store']);
Route::get('/pembeli/{id}/edit', [PembeliController::class, 'edit']);
Route::put('/pembeli/{id}', [PembeliController::class, 'update']);
Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy']);

//Route untuk fitur transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::get('/transaksi/{id}/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');


//route untuk fitur laporan
Route::get('/laporan', [LaporanController::class, 'index']);

//route untul img
Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.delete');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
Route::get('/gallery', [ImageController::class, 'gallery'])->name('image.gallery');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Contoh halaman dashboard yang hanya bisa diakses setelah login
Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, tampilkan welcome
        return view('welcome');
    } else {
        // Jika belum login, redirect ke halaman login
        return redirect('/login');
    }
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

