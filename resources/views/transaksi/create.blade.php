@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>

    {{-- ✅ Menampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/transaksi') }}" method="POST">
        @csrf

        {{-- Input Pembeli --}}
        <div class="mb-3">
            <label>Nama Pembeli</label>
            <input type="text" name="nama_pembeli" class="form-control" placeholder="Ketik nama pembeli..." required
                value="{{ old('nama_pembeli') }}">
        </div>

       <div class="mb-3">
    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control" placeholder="081234567890"
        value="{{ old('no_hp') }}" required>
</div>


        {{-- Dropdown Kasir --}}
        <div class="mb-3">
            <label>Kasir</label>
            <select name="kasir_id" class="form-control" required>
                <option value="">-- Pilih Kasir --</option>
                @foreach ($kasir as $k)
                    <option value="{{ $k->id }}" {{ old('kasir_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control"
                placeholder="Misal: Tunai / Transfer / QRIS" value="{{ old('metode_pembayaran') }}" required>
        </div>

        <hr>
        <h5>Barang Dibeli</h5>

        <div id="barang-wrapper">
            @php
                $old_barang = old('barang_id', [null, null]);
                $old_jumlah = old('jumlah', []);
                $old_harga = old('harga_satuan', []);
                $jumlah_barang = max(count($old_barang), 2);
            @endphp

            @for ($i = 0; $i < $jumlah_barang; $i++)
            <div class="row mb-2 barang-item">
                <div class="col">
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}"
                                {{ isset($old_barang[$i]) && $old_barang[$i] == $b->id ? 'selected' : '' }}>
                                {{ $b->nama }} - Rp {{ number_format($b->harga) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah"
                        value="{{ $old_jumlah[$i] ?? '' }}" required>
                </div>
                <div class="col">
                    <input type="number" name="harga_satuan[]" class="form-control" placeholder="Harga Satuan"
                        value="{{ $old_harga[$i] ?? '' }}" required>
                </div>
            </div>
            @endfor
        </div>

        <button type="button" id="tambah-barang" class="btn btn-sm btn-secondary mb-3">+ Tambah Barang</button>

        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.getElementById('tambah-barang').addEventListener('click', function () {
    const wrapper = document.getElementById('barang-wrapper');
    const firstItem = wrapper.querySelector('.barang-item');
    const clone = firstItem.cloneNode(true);
    
    // Reset value pada input dan select
    clone.querySelectorAll('input').forEach(input => input.value = '');
    clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    
    wrapper.appendChild(clone);
});
</script>
@endsection
