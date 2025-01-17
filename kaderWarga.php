<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'kader') {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_warga = $_POST['id_warga'];
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $bb = $_POST['bb'];
    $kondisi = $_POST['kondisi'];

    $updateQuery = "UPDATE data_warga SET id_user = '$id_user', nama = '$nama', alamat = '$alamat', no_tlp = '$no_tlp', bb = '$bb', kondisi = '$kondisi' WHERE id_warga='$id_warga'";
    mysqli_query($koneksi, $updateQuery);
}

$query = "SELECT id_warga, nama, alamat, no_tlp, bb, kondisi FROM data_warga";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Warga</title>
    <link rel="stylesheet" href="css/kader.css">
</head>
<body>
    <h1>Manajemen Data Warga</h1>
    <div class="form-create">
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Berat Badan</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>   
                <form method="POST">        
                    <td><?= htmlspecialchars($row['id_warga']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= htmlspecialchars($row['no_tlp']) ?></td>
                    <td><input type="number" name="bb" value="<?= $row['bb'] ?>" step="0.01"></td>
                    <td><input type="text" name="kondisi" value="<?= $row['kondisi'] ?>"</td>
                    <td>
                        <input type="hidden" name="id_warga" value="<?= $row['id_warga'] ?>">
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