@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #fff0f5, #ffe4ec);
        font-family: 'Outfit', sans-serif;
        color: #6b4c4c;
    }
    .home-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
    }
    .home-title {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        margin-bottom: 20px;
    }
    .button-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
        max-width: 500px;
        width: 100%;
    }
    .button-grid a {
        background-color: #fff;
        border: 2px solid #ffb6c1;
        padding: 12px 20px;
        border-radius: 15px;
        color: #d63384;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s ease;
        font-size: 16px;
    }
    .button-grid a:hover {
        background-color: #ffd1dc;
        transform: scale(1.05);
    }
</style>

<div class="home-container">
    <h1 class="home-title">🛍️ Butuh apa??</h1>
    <div class="button-grid mt-3">
        <a href="{{ url('/barang') }}">🧺 Barang</a>
        <a href="{{ url('/kasir') }}">👩‍🍳 Kasir</a>
        <a href="{{ url('/pembeli') }}">🧍‍♀️ Pembeli</a>
        <a href="{{ url('/transaksi') }}">🛒 Transaksi</a>
        <a href="{{ url('/laporan') }}">📊 Laporan</a>
    </div>
</div>
@endsection
