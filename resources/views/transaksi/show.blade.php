@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">🧾 Detail Transaksi</h2>

    @if ($transaksi)
    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $transaksi->tanggal }}<br>
        <strong>Pembeli:</strong> {{ $transaksi->pembeli->nama ?? $transaksi->nama_pembeli }}<br>
        <strong>Kasir:</strong> {{ $transaksi->kasir->nama ?? $transaksi->nama_kasir }}<br>
        <strong>Total:</strong> Rp {{ number_format($transaksi->total) }}
    </div>

    <h4 class="mt-4">Barang yang Dibeli</h4>
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="text-center table-light">
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi->barang as $barang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td class="text-center">{{ $barang->pivot->jumlah }}</td>
                <td>Rp {{ number_format($barang->pivot->harga_satuan) }}</td>
                <td>Rp {{ number_format($barang->pivot->jumlah * $barang->pivot->harga_satuan) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada barang dalam transaksi ini 😢</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @else
    <div class="alert alert-danger">
        Transaksi tidak ditemukan 😢
    </div>
    @endif

    <div class="mt-3 text-end">
        <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
