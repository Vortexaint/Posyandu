<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bayi = $_POST['id_bayi'];
    $bb = $_POST['bb'];
    $umur = $_POST['umur'];

    $updateQuery = "UPDATE data_bayi SET bb='$bb', umur='$umur' WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $updateQuery);
}

$query = "SELECT id_bayi, nama_bayi, bb, umur, (bb / (umur * umur)) AS BMI FROM data_bayi";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data BMI</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        .button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <h1>Kelola Data BMI Bayi</h1>
    <table>
        <tr>
            <th>ID Bayi</th>
            <th>Nama Bayi</th>
            <th>Berat Badan (kg)</th>
            <th>Umur (tahun)</th>
            <th>BMI</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <form method="POST">
                <td><?= htmlspecialchars($row['id_bayi']) ?></td>
                <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
                <td><input type="number" name="bb" value="<?= $row['bb'] ?>" step="0.01"></td>
                <td><input type="number" name="umur" value="<?= $row['umur'] ?>" step="0.01"></td>
                <td><?= round($row['BMI'], 2) ?></td>
                <td>
                    <input type="hidden" name="id_bayi" value="<?= $row['id_bayi'] ?>">
                    <button type="submit" class="button">Update</button>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="adminDashboard.php">Kembali ke Dashboard</a>
</body>
</html>
<?php mysqli_close($koneksi); ?>
