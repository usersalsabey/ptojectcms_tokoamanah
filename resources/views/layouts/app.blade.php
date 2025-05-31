<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Toko Amanah</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font: Coquette vibes --}}
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Outfit', sans-serif;
        }
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
        }
        .navbar {
            background-color: #ffd1dc;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: #6b4c4c !important;
        }
        .navbar-nav .nav-link {
            color: #6b4c4c !important;
            font-weight: 500;
            transition: 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #d63384 !important;
            transform: scale(1.05);
        }
        .nav-link.active {
            font-weight: bold;
            color: #d63384 !important;
        }
        .btn-primary {
            background-color: #ffb6c1;
            border-color: #ffb6c1;
        }
        .btn-primary:hover {
            background-color: #ffa6b5;
            border-color: #ffa6b5;
        }
        .table th {
            background-color: #ffe4ec;
        }
        .container {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">🛍️ Toko Amanah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCoquette" aria-controls="navbarCoquette" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCoquette">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}" href="{{ url('/barang') }}">🧺 Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kasir*') ? 'active' : '' }}" href="{{ url('/kasir') }}">👩‍🍳 Kasir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}" href="{{ url('/transaksi') }}">🛒 Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pembeli*') ? 'active' : '' }}" href="{{ url('/pembeli') }}">🧍‍♀️ Pembeli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ url('/laporan') }}">📊 Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
