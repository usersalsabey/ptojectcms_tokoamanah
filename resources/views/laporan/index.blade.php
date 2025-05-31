@extends('layouts.app')

@section('title', 'Laporan Penjualan Harian')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Penjualan Harian</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Transaksi</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('Y-m-d') }}</td>
                <td>{{ $row->jumlah_transaksi }}</td>
                <td>Rp {{ number_format($row->total_penjualan) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
