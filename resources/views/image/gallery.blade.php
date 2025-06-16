@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">📸 Galeri Foto yang Sudah Diupload</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse ($images as $img)
            <div class="col-md-4 mb-4">
                <div class="card gallery-card shadow-lg h-100">
                    <div class="img-hover-wrap">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="img-hover-text">✨ Tersedia ✨</div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $img->title }}</h5>
                        <form action="{{ route('image.delete', $img->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus foto ini? 🥺')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100 gallery-delete-btn">🗑️ Hapus Foto</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada foto yang diupload nih 😢</p>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .gallery-card {
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
    }

    .gallery-card:hover {
        transform: scale(1.02);
    }

    .gallery-delete-btn {
        background-color: #ff6b81;
        border: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .gallery-delete-btn:hover {
        background-color: #ff4757;
    }

    .img-hover-wrap {
        position: relative;
    }

    .img-hover-text {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, 0.7);
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: bold;
        color: #d63384;
        opacity: 0;
        transition: opacity 0.4s ease-in-out;
    }

    .img-hover-wrap:hover .img-hover-text {
        opacity: 1;
    }
</style>
@endpush
@endsection
