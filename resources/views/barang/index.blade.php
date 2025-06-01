@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">🎀 Daftar Barang</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- ✅ Total data barang (jawaban soal 1b) --}}
    @isset($jumlah)
        <div class="alert alert-info text-center">
            Total Barang: <strong>{{ $jumlah }}</strong>
        </div>
    @endisset

    {{-- Form pencarian --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ url('/barang') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari barang..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('/barang/create') }}" class="btn btn-success">+ Tambah Barang</a>
        </div>
    </div>

    <table class="table table-bordered table-hover shadow-sm">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $barang)
            <tr>
                <td class="text-center">{{ $barang->id }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>Rp {{ number_format($barang->harga) }}</td>
                <td>{{ $barang->stok }}</td>
                <td class="d-flex gap-1 justify-content-center">
                    <a href="{{ url('/barang/' . $barang->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ url('/barang/' . $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Barang yang kamu cari sedang kosong 😢</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
