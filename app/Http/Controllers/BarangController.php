<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Database\Eloquent\ModelNotFoundException; // ✅ Tambahkan ini agar bisa catch exception

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        $data = $query->get();
        $jumlah = Barang::count();

        return view('barang.index', compact('data', 'jumlah'));
    }

    // ✅ Tambahan method create
    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {

         Log::info('User Registered', [
           
            'time' => now()->toDateTimeString(),
        ]);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'masa_berlaku' => 'required|date',
        ]);

        DB::insert('INSERT INTO barang (nama, harga, stok, kategori, masa_berlaku) VALUES (?, ?, ?, ?, ?)', [
            $request->nama,
            $request->harga,
            $request->stok,
            $request->kategori,
            $request->masa_berlaku,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id)
{
    try {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
    }
}

    public function showTryCatch($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            return view('barang.show', compact('barang'));
        } catch (ModelNotFoundException $e) {
            return response()->view('errors.barang-not-found', [], 404);
        }
    }

    public function edit($id)
    {
        try {
            $barang = Barang::findOrFail($id); // Pakai Eloquent
            return view('barang.edit', ['barang' => $barang]);
        } catch (ModelNotFoundException $e) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'masa_berlaku' => 'required|date',
        ]);

        DB::update('UPDATE barang SET nama = ?, harga = ?, stok = ?, kategori = ?, masa_berlaku = ? WHERE id = ?', [
            $request->nama,
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
