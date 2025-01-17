<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Posyandu</title>
    <style>
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
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
        }

        header h2 {
            margin: 0;
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
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
            <b><span>Halo, <?= htmlspecialchars($_SESSION['username']); ?></span></b>
            <a href="signOut.php" class="login-button">Logout</a>
        <?php else: ?>
            <a href="Login.php" class="login-button">Sign In</a>
        <?php endif; ?>
    </header>
    <nav>
        <a href="Dashboard.php">Beranda</a>
        <a href="About.php">Tentang Posyandu</a>
        <a href="BMI.php">BMI</a>
        <a href="LingkarKepala.php">Lingkar Kepala Bayi</a>
        <a href="Contact.php">Kontak Kami</a>
    </nav>
    <section class="content">
        <h1>Tentang Posyandu Desa</h1>
        <p>Posyandu Desa adalah pusat pelayanan terpadu yang memberikan berbagai layanan kesehatan dasar untuk ibu dan anak, seperti:</p>
        <ul>
            <li>Imunisasi untuk bayi dan balita</li>
            <li>Pemantauan tumbuh kembang anak</li>
            <li>Konsultasi kesehatan ibu dan anak</li>
            <li>Edukasi tentang pola hidup sehat</li>
        </ul>
        <p>Dengan dukungan dari para kader dan tenaga medis, kami berkomitmen untuk meningkatkan kesejahteraan masyarakat.</p>
    </section>
    <footer>
        &copy; 2024 Posyandu Desa. Semua Hak Dilindungi.
    </footer>
</body>
</html>
