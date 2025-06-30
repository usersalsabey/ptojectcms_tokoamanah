@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">✏️ Edit Barang</h2>

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/barang/' . $barang->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- 🔥 Penting agar route PUT dikenali --}}

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $barang->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $barang->kategori }}" required>
        </div>

        <div class="mb-3">
            <label>Masa Berlaku</label>
            <input type="date" name="masa_berlaku" class="form-control" value="{{ $barang->masa_berlaku }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url('/barang') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
