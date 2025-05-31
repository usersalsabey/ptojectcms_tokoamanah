<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = DB::table('transaksi')
            ->join('pembeli', 'transaksi.pembeli_id', '=', 'pembeli.id')
            ->join('kasir', 'transaksi.kasir_id', '=', 'kasir.id')
            ->select('transaksi.*', 'pembeli.nama as nama_pembeli', 'kasir.nama as nama_kasir')
            ->get();

        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        $pembeli = DB::table('pembeli')->get();
        $kasir = DB::table('kasir')->get();
        $barang = DB::table('barang')->get();

        return view('transaksi.create', compact('pembeli', 'kasir', 'barang'));
    }

    public function show($id)
    {
        $transaksi = DB::table('transaksi')
            ->join('pembeli', 'transaksi.pembeli_id', '=', 'pembeli.id')
            ->join('kasir', 'transaksi.kasir_id', '=', 'kasir.id')
            ->select('transaksi.*', 'pembeli.nama as nama_pembeli', 'kasir.nama as nama_kasir')
            ->where('transaksi.id', $id)
            ->first();

        $detail = DB::table('transaksi_detail')
            ->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')
            ->select('barang.nama_barang as nama_barang', 'transaksi_detail.*') 
            ->where('transaksi_id', $id)
            ->get();

        return view('transaksi.show', compact('transaksi', 'detail'));
    }

    public function store(Request $request)
    {
        // Hitung total dari jumlah × harga satuan
        $total = collect($request->jumlah)
            ->zip($request->harga_satuan)
            ->reduce(function ($carry, $item) {
                return $carry + ((float) $item[0] * (float) $item[1]);
            }, 0);

        // Simpan transaksi utama
        $transaksi_id = DB::table('transaksi')->insertGetId([
            'pembeli_id' => $request->pembeli_id,
            'kasir_id' => $request->kasir_id,
            'tanggal' => now(),
            'total' => $total,
        ]);

        // Simpan detail barang yang dibeli
        foreach ($request->barang_id as $i => $barang_id) {
            DB::table('transaksi_detail')->insert([
                'transaksi_id' => $transaksi_id,
                'barang_id' => $barang_id,
                'jumlah' => $request->jumlah[$i],
                'harga_satuan' => $request->harga_satuan[$i],
            ]);
        }

        return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Hapus detail terlebih dahulu
        DB::table('transaksi_detail')->where('transaksi_id', $id)->delete();

        // Hapus transaksi utama
        DB::table('transaksi')->where('id', $id)->delete();

        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus!');
    }
}
