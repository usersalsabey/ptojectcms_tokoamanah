<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
public function showWithTryCatch($id)
  {
        try {
            $kasir = Kasir::findOrFail($id);
            return view('kasir.show', compact('kasir'));
        } catch (ModelNotFoundException $e) {
            return response()->view('errors.notfound', [], 404);
        }
    }




    public function index()
    {
        $kasir = DB::select("SELECT * FROM kasir");
        return view('kasir.index', compact('kasir'));
    }

    public function create()
    {
        return view('kasir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'hari_kerja' => 'required',
            'jam_kerja' => 'required',
            'kontak' => 'required',
        ]);

        DB::insert("INSERT INTO kasir (nama, hari_kerja, jam_kerja, kontak) VALUES (?, ?, ?, ?)", [
            $request->nama,
            $request->hari_kerja,
            $request->jam_kerja,
            $request->kontak,
        ]);

        return redirect('/kasir')->with('success', 'Data kasir berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kasir = DB::selectOne("SELECT * FROM kasir WHERE id = ?", [$id]);
        return view('kasir.edit', compact('kasir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'hari_kerja' => 'required',
            'jam_kerja' => 'required',
            'kontak' => 'required',
        ]);

        DB::update("UPDATE kasir SET nama = ?, hari_kerja = ?, jam_kerja = ?, kontak = ? WHERE id = ?", [
            $request->nama,
            $request->hari_kerja,
            $request->jam_kerja,
            $request->kontak,
            $id
        ]);

        return redirect('/kasir')->with('success', 'Data kasir berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM kasir WHERE id = ?", [$id]);
        return redirect('/kasir')->with('success', 'Data kasir berhasil dihapus!');
    }
}
