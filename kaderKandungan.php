<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'kader') {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_data'])) {
    $id_ibu_hamil = $_POST['id_ibu_hamil'];
    $id_warga = $_POST['id_warga'];
    $usia_kehamilan = $_POST['usia_kehamilan'];
    $kondisi_janin = $_POST['kondisi_janin'];

    $updateQuery = "UPDATE data_ibu_hamil SET id_warga = '$id_warga', usia_kehamilan = '$usia_kehamilan', kondisi_janin = '$kondisi_janin' WHERE id_ibu_hamil = '$id_ibu_hamil'";
    mysqli_query($koneksi, $updateQuery);
}

$query = "SELECT id_warga, usia_kehamilan, kondisi_janin FROM data_ibu_hamil";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kandungan</title>
    <link rel="stylesheet" href="css/kader.css">
</head>
<body>
    <h1>Data Kandungan</h1>

    <button onclick="document.getElementById('addModal').style.display='block'">Tambah Data</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Warga</th>
                <th>Usia Kehamilan</th>
                <th>Kondisi Janin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_ibu_hamil as $data): ?>
                <tr>
                    <td><?= $data['id_ibu_hamil'] ?></td>
                    <td><?= $data['id_warga'] ?></td>
                    <td><?= $data['usia_kehamilan'] ?></td>
                    <td><?= $data['kondisi_janin'] ?></td>
                    <td>
                        <button onclick="editData(<?= htmlspecialchars(json_encode($data)) ?>)">Edit</button>
                        <a href="?delete_id=<?= $data['id_ibu_hamil'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Modal -->
    <div id="addModal" style="display:none;">
        <form method="POST">
            <input type="hidden" name="add_data" value="1">
            <label>ID Warga:</label>
            <input type="number" name="id_warga" required>
            <label>Usia Kehamilan:</label>
            <input type="number" step="0.1" name="usia_kehamilan" required>
            <label>Kondisi Janin:</label>
            <input type="text" name="kondisi_janin" required>
            <button type="submit">Simpan</button>
            <button type="button" onclick="document.getElementById('addModal').style.display='none'">Batal</button>
        </form>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" style="display:none;">
        <form method="POST">
            <input type="hidden" name="update_data" value="1">
            <input type="hidden" name="id_ibu_hamil" id="edit_id_ibu_hamil">
            <label>ID Warga:</label>
            <input type="number" name="id_warga" id="edit_id_warga" required>
            <label>Usia Kehamilan:</label>
            <input type="number" step="0.1" name="usia_kehamilan" id="edit_usia_kehamilan" required>
            <label>Kondisi Janin:</label>
            <input type="text" name="kondisi_janin" id="edit_kondisi_janin" required>
            <button type="submit">Simpan</button>
            <button type="button" onclick="document.getElementById('editModal').style.display='none'">Batal</button>
        </form>
    </div>

    <script>
        function editData(data) {
            document.getElementById('edit_id_ibu_hamil').value = data.id_ibu_hamil;
            document.getElementById('edit_id_warga').value = data.id_warga;
            document.getElementById('edit_usia_kehamilan').value = data.usia_kehamilan;
            document.getElementById('edit_kondisi_janin').value = data.kondisi_janin;
            document.getElementById('editModal').style.display = 'block';
        }
    </script>
</body>
</html>
