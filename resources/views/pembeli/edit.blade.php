@extends('layouts.app')

@section('title', 'Edit Pembeli')

@section('content')
<div class="container">
    <h2>Edit Pembeli</h2>

    <form action="{{ url('/pembeli/' . $pembeli->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pembeli->nama }}">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pembeli->alamat }}">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pembeli->no_hp }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('/pembeli') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
