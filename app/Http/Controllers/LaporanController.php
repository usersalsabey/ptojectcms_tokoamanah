<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('transaksi')
            ->select(
                DB::raw("TRUNC(tanggal) as tanggal"),
                DB::raw("COUNT(*) as jumlah_transaksi"),
                DB::raw("SUM(total) as total_penjualan")
            )
            ->groupBy(DB::raw("TRUNC(tanggal)"))
            ->orderBy(DB::raw("TRUNC(tanggal)"), 'desc')
            ->get();

        return view('laporan.index', compact('laporan'));
    }
}
