@extends('layouts.app')

@section('title', 'Tambah Pembeli')

@section('content')
<div class="container">
    <h2>Tambah Pembeli</h2>

    <form action="{{ url('/pembeli') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url('/pembeli') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
