<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    public function index()
    {
        $data = DB::table('pembeli')->get();
        return view('pembeli.index', compact('data'));
    }

    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        DB::table('pembeli')->insert([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/pembeli')->with('success', 'Data pembeli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pembeli = DB::table('pembeli')->where('id', $id)->first();
        return view('pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, $id)
    {
        DB::table('pembeli')->where('id', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect('/pembeli')->with('success', 'Data pembeli berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::table('pembeli')->where('id', $id)->delete();
        return redirect('/pembeli')->with('success', 'Data pembeli berhasil dihapus');
    }
}

