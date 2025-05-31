@extends('layouts.app')

@section('title', 'Daftar Kasir')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Kasir</h1>
    <a href="{{ url('/kasir/create') }}" class="btn btn-success">+ Tambah Kasir</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>Hari Kerja</th>
            <th>Jam Kerja</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kasir as $k)
        <tr>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->hari_kerja }}</td>
            <td>{{ $k->jam_kerja }}</td>
            <td>{{ $k->kontak }}</td>
            <td>
                <a href="{{ url('/kasir/' . $k->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ url('/kasir/' . $k->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
