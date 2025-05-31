<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Toko Amanah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #fff0f5, #ffe4ec);
            font-family: 'Outfit', sans-serif;
            color: #6b4c4c;
        }
        .welcome-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            margin-bottom: 10px;
        }
        p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .btn-start {
            background-color: #ffb6c1;
            border: none;
            font-size: 18px;
            padding: 10px 30px;
            border-radius: 25px;
            transition: 0.3s;
        }
        .btn-start:hover {
            background-color: #ffa6b5;
            transform: scale(1.05);
        }
        .section-buttons {
            display: none;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        .section-buttons.show {
            display: flex;
            opacity: 1;
        }
        .section-buttons a {
            background-color: #fff;
            border: 2px solid #ffb6c1;
            padding: 10px 20px;
            border-radius: 15px;
            color: #d63384;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s ease;
        }
        .section-buttons a:hover {
            background-color: #ffd1dc;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 id="welcome-title">🎀 Selamat Datang, Maniezz!</h1>
        <p id="welcome-desc">Di Toko Amanah yang imut dan terpercaya~</p>
        <button onclick="showMenu()" id="btnMasuk" class="btn btn-start">Masuk ke Toko 💅</button>

        <div id="menu" class="section-buttons mt-4">
            <a href="{{ url('/barang') }}">🧺 Barang</a>
            <a href="{{ url('/kasir') }}">👩‍🍳 Kasir</a>
            <a href="{{ url('/pembeli') }}">🧍‍♀️ Pembeli</a>
            <a href="{{ url('/transaksi') }}">🛒 Transaksi</a>
            <a href="{{ url('/laporan') }}">📊 Laporan</a>
        </div>
    </div>

    <script>
        function showMenu() {
            // Ganti teks sambutan
            document.getElementById('welcome-title').textContent = '🛍️ Butuh apa??';
            document.getElementById('welcome-desc').style.display = 'none';

            // Hilangkan tombol masuk
            document.getElementById('btnMasuk').style.display = 'none';

            // Tampilkan tombol entitas
            document.getElementById('menu').classList.add('show');
        }
    </script>
</body>
</html>
