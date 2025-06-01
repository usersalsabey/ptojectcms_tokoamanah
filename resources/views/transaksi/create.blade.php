@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>

    <form action="{{ url('/transaksi') }}" method="POST">
        @csrf

        {{-- Input Pembeli --}}
        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" placeholder="Ketik nama pembeli..." required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="081234567890">
        </div>

        {{-- Dropdown Kasir --}}
        <div class="mb-3">
            <label>Kasir</label>
            <select name="kasir_id" class="form-control" required>
                @foreach ($kasir as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h5>Barang Dibeli</h5>

        <div id="barang-wrapper">
            <div class="row mb-2 barang-item">
                <div class="col">
                    <select name="barang_id[]" class="form-control" required>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="col">
                    <input type="number" name="harga_satuan[]" class="form-control" placeholder="Harga Satuan" required>
                </div>
            </div>
        </div>

        <button type="button" id="tambah-barang" class="btn btn-sm btn-secondary mb-3">+ Tambah Barang</button>

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.getElementById('tambah-barang').addEventListener('click', function () {
    const wrapper = document.getElementById('barang-wrapper');
    const clone = wrapper.querySelector('.barang-item').cloneNode(true);
    clone.querySelectorAll('input').forEach(input => input.value = '');
    wrapper.appendChild(clone);
});
</script>
@endsection
