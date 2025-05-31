@extends('layouts.app')

@section('title', 'Data Pembeli')

@section('content')
<div class="container">
    <h2>Data Pembeli</h2>
    <a href="{{ url('/pembeli/create') }}" class="btn btn-primary mb-3">Tambah Pembeli</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pembeli)
            <tr>
                <td>{{ $pembeli->nama }}</td>
                <td>{{ $pembeli->alamat }}</td>
                <td>{{ $pembeli->no_hp }}</td>
                <td>
                    <a href="{{ url('/pembeli/' . $pembeli->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ url('/pembeli/' . $pembeli->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
