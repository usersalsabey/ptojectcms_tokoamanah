@extends('layouts.app')

@section('title', 'Edit Kasir')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Kasir</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/kasir/' . $kasir->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $kasir->nama }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hari Kerja</label>
            <input type="text" class="form-control" name="hari_kerja" value="{{ $kasir->hari_kerja }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Kerja</label>
            <input type="text" class="form-control" name="jam_kerja" value="{{ $kasir->jam_kerja }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" class="form-control" name="kontak" value="{{ $kasir->kontak }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('/kasir') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
