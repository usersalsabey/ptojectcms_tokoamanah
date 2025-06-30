@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Barang</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/barang') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Masa Berlaku</label>
            <input type="date" name="masa_berlaku" class="form-control" value="{{ old('masa_berlaku') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('/barang') }}" class="btn btn-secondary">← Batal</a>
            <button type="submit" class="btn btn-success">+ Simpan</button>
        </div>
    </form>
</div>
@endsection
