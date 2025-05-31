{{-- resources/views/barang/form.blade.php --}}
<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    <label>Nama Barang:
        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}">
    </label><br>

    <label>Harga:
        <input type="number" name="harga" value="{{ old('harga', $barang->harga ?? '') }}">
    </label><br>

    <label>Stok:
        <input type="number" name="stok" value="{{ old('stok', $barang->stok ?? '') }}">
    </label><br>

    <label>Kategori:
        <input type="text" name="kategori" value="{{ old('kategori', $barang->kategori ?? '') }}">
    </label><br>

    <label>Masa Berlaku:
        <input type="date" name="masa_berlaku" value="{{ old('masa_berlaku', isset($barang->masa_berlaku) ? date('Y-m-d', strtotime($barang->masa_berlaku)) : '') }}">
    </label><br>

    <button type="submit">{{ $button }}</button>
</form>
