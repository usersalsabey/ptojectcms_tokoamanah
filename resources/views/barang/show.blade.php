@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Barang</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $barang->nama_barang }}</p>
            <p><strong>Harga:</strong> Rp{{ number_format($barang->harga, 0, ',', '.') }}</p>
            <p><strong>Stok:</strong> {{ $barang->stok }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ url('/barang') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
