@extends('layouts.app')

@section('title', 'Upload Gambar Produk')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">🖼️ Upload Gambar ke Entitas</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4 shadow-sm bg-white">
        @csrf

        <ol>
            <li class="mb-3">
                <label class="form-label">Pilih Entitas Tujuan</label>
                <select name="entitas" class="form-control" required>
                    <option value="barang">Barang</option>
                    <option value="kasir">Kasir</option>
                    <option value="pembeli">Pembeli</option>
                    <option value="transaksi">Transaksi</option>
                    <option value="laporan">Laporan</option>
                </select>
            </li>
            <li class="mb-3">
                <label class="form-label">Judul Gambar</label>
                <input type="text" name="title" class="form-control" required>
            </li>
            <li class="mb-3">
                <label class="form-label">Pilih Gambar</label>
                <input type="file" name="image" class="form-control" required>
            </li>
        </ol>

        <button type="submit" class="btn btn-success">Upload Sekarang</button>
    </form>

    @if (session('image'))
        <hr>
        <div class="alert alert-info mt-4">
            ✅ Gambar untuk <strong>{{ session('image')->entitas }}</strong> berhasil diupload!
        </div>
        <div class="text-center">
            <p><strong>{{ session('image')->title }}</strong></p>
            <img src="{{ asset('storage/' . session('image')->image_path) }}" width="200" class="img-thumbnail">
        </div>
    @endif
</div>
@endsection
