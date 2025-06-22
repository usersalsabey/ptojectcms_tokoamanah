<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $query = Barang::orderBy('id', 'desc');

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_barang', 'like', '%' . $search . '%')
              ->orWhere('kode_barang', 'like', '%' . $search . '%');
        });
    }

    $data = $query->get();

    $jumlah = Barang::count();

    return view('barang.index', compact('data', 'jumlah'));
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

    public function show($id) 
    {
    $barang = \App\Models\Barang::findOrFail($id); 
    return view('barang.show', compact('barang'));
    }

    public function showTryCatch($id)
    {
    try {
        $barang = \App\Models\Barang::findOrFail($id); 
        return view('barang.show', compact('barang'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->view('errors.barang-not-found', [], 404); 
    }
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
