<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: Login.php");
    exit;
}

$query = "SELECT id_bayi, nama_bayi, bb, umur, (bb / (umur * umur)) AS BMI FROM `data_bayi`";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data BMI Bayi</title>
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
        <a href="login.php" class="login-button">Sign In</a>
    </header>
    <nav>
        <a href="Dashboard.php">Beranda</a>
        <a href="About.php">Tentang Posyandu</a>
        <a href="BMI.php">BMI</a>
        <a href="LingkarKepala.php">Lingkar Kepala Bayi</a>
        <a href="Contact.php">Kontak Kami</a>
    </nav>
    <section class="content">
        <h1>Data BMI Bayi</h1>
        <table border="1">
            <tr>
                <th>ID Bayi</th>
                <th>Nama Bayi</th>
                <th>Berat Badan (kg)</th>
                <th>Umur (tahun)</th>
                <th>BMI</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['id_bayi']) ?></td>
                <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
                <td><?= htmlspecialchars($row['bb']) ?></td>
                <td><?= htmlspecialchars($row['umur']) ?></td>
                <td><?= round($row['BMI'], 2) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>
    <footer>
        &copy; 2024 Posyandu Desa. Semua Hak Dilindungi.
    </footer>
</body>
</html>
<?php mysqli_close($koneksi); ?>
