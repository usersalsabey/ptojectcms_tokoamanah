<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

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
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/create', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->where('id', '[0-9]+');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

//route untuk fitur laporan
Route::get('/laporan', [LaporanController::class, 'index']);

