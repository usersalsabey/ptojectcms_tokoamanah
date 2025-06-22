<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Barang;

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
        $kasir = DB::table('kasir')->get(); 
        $barang = Barang::all();

        return view('transaksi.create', compact('kasir', 'barang'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['barang', 'detail'])->find($id);

        if (!$transaksi) {
            return redirect('/transaksi')->with('error', 'Transaksi tidak ditemukan!');
        }

        return view('transaksi.show', compact('transaksi'));
    }

    public function store(Request $request)
    {
        // Hitung total dari jumlah × harga satuan
        $total = collect($request->jumlah)
            ->zip($request->harga_satuan)
            ->reduce(function ($carry, $item) {
                return $carry + ((float) $item[0] * (float) $item[1]);
            }, 0);

        // Simpan pembeli baru ke tabel pembeli
        $pembeli_id = DB::table('pembeli')->insertGetId([
            'nama' => $request->nama_pembeli,
            'no_hp' => $request->no_hp
        ]);

        // Simpan transaksi utama ke tabel transaksi
        $transaksi_id = DB::table('transaksi')->insertGetId([
            'pembeli_id' => $pembeli_id,
            'kasir_id' => $request->kasir_id,
            'tanggal' => now(),
            'total' => $total
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
    DB::table('transaksi_detail')->where('transaksi_id', $id)->delete();
    DB::table('transaksi')->where('id', $id)->delete();

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
}


    public function delete($id)
        {
            $transaksi = DB::table('transaksi')
             ->join('pembeli', 'transaksi.pembeli_id', '=', 'pembeli.id')
             ->join('kasir', 'transaksi.kasir_id', '=', 'kasir.id')
             ->select('transaksi.*', 'pembeli.nama as nama_pembeli', 'kasir.nama as nama_kasir')
             ->where('transaksi.id', $id)
             ->first();

    if (!$transaksi) {
        return redirect('/transaksi')->with('error', 'Transaksi tidak ditemukan!');
    }

    return view('transaksi.delete', compact('transaksi'));
}

}
