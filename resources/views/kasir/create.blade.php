@extends('layouts.app')

@section('title', 'Tambah Kasir')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Kasir</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/kasir') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hari Kerja</label>
            <input type="text" class="form-control" name="hari_kerja" value="{{ old('hari_kerja') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Kerja</label>
            <input type="text" class="form-control" name="jam_kerja" value="{{ old('jam_kerja') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" class="form-control" name="kontak" value="{{ old('kontak') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/kasir') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
