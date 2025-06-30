@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Transaksi</h2>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tombol tambah transaksi --}}
    <a href="{{ url('/transaksi/create') }}" class="btn btn-primary mb-3">Transaksi Baru</a>

    {{-- Tabel transaksi --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Metode Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $trx)
            <tr>
                <td>{{ $trx->tanggal }}</td> <!-- alias: AS tanggal -->
                <td>{{ $trx->nama_pembeli }}</td> <!-- alias: AS nama_pembeli -->
                <td>{{ $trx->nama_kasir }}</td> <!-- alias: AS nama_kasir -->
                <td>{{ $trx->total }}</td> <!-- alias: AS total -->
                 <td>{{ $trx->metode_pembayaran }}</td>

                <td class="d-flex gap-1">
                    {{-- Tombol detail --}}
                    <a href="{{ url('/transaksi/' . $trx->id) }}" class="btn btn-sm btn-info">Detail</a>

                    {{-- Tombol edit --}}
                    <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    {{-- Tombol konfirmasi delete --}}
                    <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
