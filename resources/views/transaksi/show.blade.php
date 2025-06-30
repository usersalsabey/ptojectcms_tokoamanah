@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <h2>Detail Transaksi</h2>

    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $transaksi->tanggal }} <br>
        <strong>Pembeli:</strong> {{ $transaksi->nama_pembeli }} <br>
        <strong>No HP:</strong> {{ $transaksi->no_hp }} <br>
        <strong>Kasir:</strong> {{ $transaksi->nama_kasir }} <br>
        <strong>Metode Pembayaran:</strong> {{ $transaksi->metode_pembayaran }} <br> 
        <strong>Total Harga:</strong> Rp {{ number_format($transaksi->total) }}
    </div>

    <h4>Barang Dibeli</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->harga_satuan) }}</td>
                <td>Rp {{ number_format($item->jumlah * $item->harga_satuan) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
