<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = DB::table('metode_pembayaran')
            ->join('pembeli', 'metode_pembayaran.pembeli_id', '=', 'pembeli.id')
            ->join('kasir', 'metode_pembayaran.kasir_id', '=', 'kasir.id')
            ->select(
                'metode_pembayaran.id',
                'metode_pembayaran.tanggal_transaksi as tanggal',
                'metode_pembayaran.total_harga as total',
                'metode_pembayaran.metode_pembayaran',
                'pembeli.nama as nama_pembeli',
                'kasir.nama as nama_kasir'
            )
            ->get();

        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        $kasir = DB::table('kasir')->get(); 
        $barang = DB::table('barang')->select('id', 'nama', 'harga')->get();

        return view('transaksi.create', compact('kasir', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'nama_pembeli' => 'required',
    'no_hp' => 'required',
    'kasir_id' => 'required',
    'metode_pembayaran' => 'required',
    'barang_id' => 'required|array',
    'jumlah' => 'required|array',
    'harga_satuan' => 'required|array',
]);


        $total = 0;
        foreach ($request->barang_id as $i => $barang_id) {
            $jumlah = (float) $request->jumlah[$i];
            $harga_satuan = (float) $request->harga_satuan[$i];
            $total += $jumlah * $harga_satuan;
        }

        $pembeli_id = DB::table('pembeli')->insertGetId([
            'nama' => $request->nama_pembeli,
            'no_hp' => $request->no_hp
        ]);

        $transaksi_id = DB::table('metode_pembayaran')->insertGetId([
            'pembeli_id' => $pembeli_id,
            'kasir_id' => $request->kasir_id,
            'tanggal_transaksi' => now(),
            'total_harga' => $total,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

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

   public function show($id)
{
    $transaksi = DB::table('metode_pembayaran')
        ->join('pembeli', 'metode_pembayaran.pembeli_id', '=', 'pembeli.id')
        ->join('kasir', 'metode_pembayaran.kasir_id', '=', 'kasir.id')
        ->where('metode_pembayaran.id', $id)
        ->select(
            'metode_pembayaran.id',
            'metode_pembayaran.tanggal_transaksi as tanggal',
            'metode_pembayaran.total_harga as total',
            'metode_pembayaran.metode_pembayaran',
            'pembeli.nama as nama_pembeli',
            'pembeli.no_hp',
            'kasir.nama as nama_kasir'
        )
        ->first(); // ✅ WAJIB ADA titik koma dan pemanggilan first()

    if (!$transaksi) {
        return redirect('/transaksi')->with('error', 'Transaksi tidak ditemukan!');
    }

    $detail = DB::table('transaksi_detail')
        ->join('barang', 'transaksi_detail.barang_id', '=', 'barang.id')
        ->where('transaksi_detail.transaksi_id', $id)
        ->select('barang.nama', 'transaksi_detail.jumlah', 'transaksi_detail.harga_satuan')
        ->get();

    return view('transaksi.show', compact('transaksi', 'detail'));
}

    public function edit($id)
    {
        $transaksi = DB::table('metode_pembayaran')
            ->select('id', 'tanggal_transaksi', 'kasir_id', 'pembeli_id', 'metode_pembayaran')
            ->where('id', $id)
            ->first();

        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Data tidak ditemukan!');
        }

        $kasir = DB::table('kasir')->get();
        $pembeli = DB::table('pembeli')->get();

        return view('transaksi.edit', compact('transaksi', 'kasir', 'pembeli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'kasir_id' => 'required',
            'pembeli_id' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        DB::table('metode_pembayaran')->where('id', $id)->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'kasir_id' => $request->kasir_id,
            'pembeli_id' => $request->pembeli_id,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('transaksi_detail')->where('transaksi_id', $id)->delete();
        DB::table('metode_pembayaran')->where('id', $id)->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function delete($id)
    {
        $transaksi = DB::table('metode_pembayaran')
            ->join('pembeli', 'metode_pembayaran.pembeli_id', '=', 'pembeli.id')
            ->join('kasir', 'metode_pembayaran.kasir_id', '=', 'kasir.id')
            ->select(
                'metode_pembayaran.id',
                'metode_pembayaran.tanggal_transaksi as tanggal',
                'metode_pembayaran.total_harga as total',
                'pembeli.nama as nama_pembeli',
                'kasir.nama as nama_kasir'
            )
            ->where('metode_pembayaran.id', $id)
            ->first();

        if (!$transaksi) {
            return redirect('/transaksi')->with('error', 'Transaksi tidak ditemukan!');
        }

        return view('transaksi.delete', compact('transaksi'));
    }
}
