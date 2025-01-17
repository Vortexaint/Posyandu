<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'kader') {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bayi = $_POST['id_bayi'];
    $lingkar_kepala = $_POST['lingkar_kepala'];

    $updateQuery = "UPDATE data_bayi SET linkar_kepala='$lingkar_kepala' WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $updateQuery);
}

$query = "SELECT id_bayi, nama_bayi, linkar_kepala FROM data_bayi";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Lingkar Kepala</title>
    <link rel="stylesheet" href="css/kader.css">
</head>
<body>
    <h1>Kelola Data Lingkar Kepala Bayi</h1>
    <div class="form-create">
        <table>
            <tr>
                <th>ID Bayi</th>
                <th>Nama Bayi</th>
                <th>Lingkar Kepala (cm)</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <form method="POST">
                    <td><?= htmlspecialchars($row['id_bayi']) ?></td>
                    <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
                    <td><input type="number" name="lingkar_kepala" value="<?= $row['linkar_kepala'] ?>" step="0.01"></td>
                    <td>
                        <input type="hidden" name="id_bayi" value="<?= $row['id_bayi'] ?>">
                        <button type="submit" class="button">Update</button>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <br>
    <a href="kaderDashboard.php" class="back-link">Kembali ke Dashboard</a>
    <footer>
        &copy; 2024 Posyandu Desa. Semua Hak Dilindungi.
    </footer>
</body>
</html>
<?php mysqli_close($koneksi); ?>
