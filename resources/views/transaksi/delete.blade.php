@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">🗑️ Konfirmasi Hapus Transaksi</h3>

    <div class="alert alert-danger text-center">
        <strong>Yakin ingin menghapus transaksi ini?</strong><br>
        Data ini tidak dapat dikembalikan setelah dihapus 😢
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
            <p><strong>Pembeli:</strong> {{ $transaksi->nama_pembeli }}</p>
            <p><strong>Kasir:</strong> {{ $transaksi->nama_kasir }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-between">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-danger">Hapus Sekarang</button>
        </div>
    </form>
</div>
@endsection
