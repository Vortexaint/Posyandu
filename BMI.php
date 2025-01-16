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
    <link rel="stylesheet" href="adminbmi.css">
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
        <table>
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

