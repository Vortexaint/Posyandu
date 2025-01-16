<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Createfss 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $umur = $_POST['umur'];

    $insertQuery = "INSERT INTO data_kader (nama, alamat, umur) VALUES ('$nama', '$alamat', '$umur')";
    mysqli_query($koneksi, $insertQuery);
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_kader = $_POST['id_kader'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $umur = $_POST['umur'];

    $updateQuery = "UPDATE data_kader SET nama='$nama', alamat='$alamat', umur='$umur' WHERE id_kader='$id_kader'";
    mysqli_query($koneksi, $updateQuery);
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_kader = $_POST['id_kader'];

    $deleteQuery = "DELETE FROM data_kader WHERE id_kader='$id_kader'";
    mysqli_query($koneksi, $deleteQuery);
}

// Fetch Data
$query = "SELECT * FROM data_kader";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Kader</title>
    <link rel="stylesheet" href="adminlinkarkepala.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Data Kader</h1>
    <button class="button" onclick="openModal('createModal')">Tambah Data Kader</button>

    <table>
        <tr>
            <th>ID Kader</th>
            <th>Nama Kader</th>
            <th>Alamat</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id_kader']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['umur']) ?></td>
            <td>
                <button class="button" onclick="openModal('updateModal', <?= htmlspecialchars(json_encode($row)) ?>)">Update</button>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_kader" value="<?= $row['id_kader'] ?>">
                    <button type="submit" name="delete" class="button delete-button">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('createModal')">&times;</span>
            <h2>Tambah Data Kader</h2>
            <form method="POST">
                <input type="text" name="nama" placeholder="Nama Kader" required>
                <input type="text" name="alamat" placeholder="Alamat" required>
                <input type="text" name="umur" placeholder="Umur" required>
                <button type="submit" name="create" class="button">Tambah</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update Data Kader</h2>
            <form method="POST">
                <input type="hidden" name="id_kader" id="update-id">
                <input type="text" name="nama" id="update-nama" required>
                <input type="text" name="alamat" id="update-alamat" required>
                <input type="text" name="umur" id="update-umur" required>
                <button type="submit" name="update" class="button">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, data = null) {
            document.getElementById(modalId).style.display = "block";
            if (data && modalId === 'updateModal') {
                document.getElementById('update-id').value = data.id_kader;
                document.getElementById('update-nama').value = data.nama;
                document.getElementById('update-alamat').value = data.alamat;
                document.getElementById('update-umur').value = data.umur;
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        window.onclick = function(event) {
            const modals = document.getElementsByClassName('modal');
            Array.from(modals).forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        };
    </script>
</body>
</html>
<?php mysqli_close($koneksi); ?>
