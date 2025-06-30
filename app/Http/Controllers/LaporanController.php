<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('metode_pembayaran') // ganti nama tabel
            ->select(
                DB::raw("TRUNC(tanggal_transaksi) as tanggal"), // ganti nama kolom
                DB::raw("COUNT(*) as jumlah_transaksi"),
                DB::raw("SUM(total_harga) as total_penjualan") // ganti nama kolom
            )
            ->groupBy(DB::raw("TRUNC(tanggal_transaksi)"))
            ->orderBy(DB::raw("TRUNC(tanggal_transaksi)"), 'desc')
            ->get();

        return view('laporan.index', compact('laporan'));
    }
}
