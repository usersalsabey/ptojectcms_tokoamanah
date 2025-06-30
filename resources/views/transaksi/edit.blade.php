@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container">
    <h2>Edit Transaksi</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control"
                value="{{ old('tanggal_transaksi', date('Y-m-d', strtotime($transaksi->tanggal_transaksi))) }}" required>
        </div>

        <div class="mb-3">
            <label for="kasir_id" class="form-label">Nama Kasir</label>
            <select name="kasir_id" class="form-control" required>
                @foreach ($kasir as $k)
                    <option value="{{ $k->id }}" {{ $transaksi->kasir_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pembeli_id" class="form-label">Nama Pembeli</label>
            <select name="pembeli_id" class="form-control" required>
                @foreach ($pembeli as $p)
                    <option value="{{ $p->id }}" {{ $transaksi->pembeli_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control"
                value="{{ old('metode_pembayaran', $transaksi->metode_pembayaran) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
