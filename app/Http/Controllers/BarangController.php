<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('barang');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_barang', 'like', '%' . $search . '%');
            // Kolom kode_barang dihapus karena tidak ada di database
        }

        $data = $query->get();

        return view('barang.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'masa_berlaku' => 'required|date',
        ]);

        DB::insert('INSERT INTO barang (nama_barang, harga, stok, kategori, masa_berlaku) VALUES (?, ?, ?, ?, ?)', [
            $request->nama_barang,
            $request->harga,
            $request->stok,
            $request->kategori,
            $request->masa_berlaku,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = DB::selectOne('SELECT * FROM barang WHERE id = ?', [$id]);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan.');
        }
        return view('barang.edit', ['barang' => $barang]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'masa_berlaku' => 'required|date',
        ]);

        DB::update('UPDATE barang SET nama_barang = ?, harga = ?, stok = ?, kategori = ?, masa_berlaku = ? WHERE id = ?', [
            $request->nama_barang,
            $request->harga,
            $request->stok,
            $request->kategori,
            $request->masa_berlaku,
            $id,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM barang WHERE id = ?', [$id]);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }
}
