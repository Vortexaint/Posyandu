<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu Desa</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between; /* Membuat header terbagi antara kiri & kanan */
            align-items: center; /* Memposisikan elemen di tengah secara vertikal */
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px; /* Tambahkan padding untuk jarak */
        }

        header h2 {
            margin: 0; /* Hilangkan margin default pada h2 */
        }

        .login-button {
            background-color: white;
            color: #4CAF50;
            padding: 5px 15px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid white;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .login-button:hover {
            background-color: #388E3C;
            color: white;
            border: 2px solid #388E3C;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: linear-gradient(to right, #e0f7e0, #a1d2d6);
        }

        .hero-text {
            max-width: 50%;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .hero p {
            font-size: 1.1rem;
            color: #555;
        }

        .hero-list {
            margin-top: 20px;
            color: #2e7d32;
            font-weight: bold;
        }

        .hero img {
            width: 45%;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Posyandu Desa</h2>
        <a href="login.php" class="login-button">Sign In</a>
    </header>
    <nav>
        <a href="#">Beranda</a>
        <a href="#">Tentang Posyandu</a>
        <a href="#">Layanan Kesehatan</a>
        <a href="#">Kegiatan</a>
        <a href="#">Kontak Kami</a>
    </nav>
    <section class="hero">
        <div class="hero-text">
            <h1>Selamat Datang di Posyandu Desa</h1>
            <p>Posyandu Desa menyediakan layanan kesehatan dasar bagi ibu dan anak, imunisasi, serta pemantauan tumbuh kembang anak.</p>
            <ul class="hero-list">
                <li>Layanan Kesehatan Gratis</li>
                <li>Pemantauan Tumbuh Kembang Anak</li>
                <li>Imunisasi Rutin</li>
                <li>Edukasi Kesehatan Ibu & Anak</li>
            </ul>
        </div>
        <img src="Assets\th.jfif" alt="Kegiatan Posyandu Desa">
    </section>
    <footer>
        &copy; 2024 Posyandu Desa. Semua Hak Dilindungi.
    </footer>
</body>
</html>
