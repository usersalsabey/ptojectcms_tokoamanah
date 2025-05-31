{{-- resources/views/barang/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tambah Barang</h2>
    </div>

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
                <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori" value="{{ old('kategori') }}" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Masa Berlaku</label>
            <input type="date" class="form-control" name="masa_berlaku" value="{{ old('masa_berlaku') }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('/barang') }}" class="btn btn-secondary">
                ← Batal
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
@endsection
