<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: Login.php");
    exit;
}

$query = "SELECT id_bayi, nama_bayi, linkar_kepala FROM `data_bayi`";
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
    <title>Lingkar Kepala Bayi</title>
    <link rel="stylesheet" href="lingkarkepala.css">
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
        <h1>Data Lingkar Kepala Bayi</h1>
        <table border="1">
            <tr>
                <th>ID Bayi</th>
                <th>Nama Bayi</th>
                <th>Lingkar Kepala (cm)</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['id_bayi']) ?></td>
                <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
                <td><?= htmlspecialchars($row['linkar_kepala']) ?> cm</td>
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

