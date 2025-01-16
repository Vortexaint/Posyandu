<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $bb = $_POST['bb'];
    $kondisi = $_POST['kondisi'];

    $insertQuery = "INSERT INTO data_warga (nama, alamat, no_tlp, bb, kondisi) VALUES ('$nama', '$alamat', '$no_tlp', '$bb', '$kondisi')";
    mysqli_query($koneksi, $insertQuery);
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_warga = $_POST['id_warga'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $bb = $_POST['bb'];
    $kondisi = $_POST['kondisi'];

    $updateQuery = "UPDATE data_warga SET nama='$nama', alamat='$alamat', no_tlp='$no_tlp', '$bb', '$kondisi' WHERE id_warga='$id_warga'";
    mysqli_query($koneksi, $updateQuery);
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_warga = $_POST['id_warga'];

    $deleteQuery = "DELETE FROM data_warga WHERE id_warga='$id_warga'";
    mysqli_query($koneksi, $deleteQuery);
}

// Fetch Data
$query = "SELECT * FROM data_warga";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Warga</title>
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
    <h1>Data Warga</h1>
    <button class="button" onclick="openModal('createModal')">Tambah Data Warga</button>

    <table>
        <tr>
            <th>ID Warga</th>
            <th>Nama Warga</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Berat Badan</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id_warga']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td><?= htmlspecialchars($row['no_tlp']) ?></td>
            <td><?= htmlspecialchars($row['bb']) ?></td>
            <td><?= htmlspecialchars($row['kondisi']) ?></td>
            <td>
                <button class="button" onclick="openModal('updateModal', <?= htmlspecialchars(json_encode($row)) ?>)">Update</button>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_warga" value="<?= $row['id_warga'] ?>">
                    <button type="submit" name="delete" class="button delete-button">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('createModal')">&times;</span>
            <h2>Tambah Data Warga</h2>
            <form method="POST">
                <input type="text" name="nama" placeholder="Nama Warga" required>
                <input type="text" name="alamat" placeholder="Alamat" required>
                <input type="text" name="no_tlp" placeholder="No Telepon" required>
                <input type="text" name="bb" placeholder="Berat Badan" required>
                <input type="text" name="kondisi" placeholder="Kondisi" required>
                <button type="submit" name="create" class="button">Tambah</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update Data Warga</h2>
            <form method="POST">
                <input type="hidden" name="id_warga" id="update-id">
                <input type="text" name="nama" id="update-nama" required>
                <input type="text" name="alamat" id="update-alamat" required>
                <input type="text" name="no_tlp" id="update-telepon" required>
                <input type="text" name="bb" id="update-beratBadan" required>
                <input type="text" name="kondisi" id="update-kondisi" required>
                <button type="submit" name="update" class="button">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, data = null) {
            document.getElementById(modalId).style.display = "block";
            if (data && modalId === 'updateModal') {
                document.getElementById('update-id').value = data.id_warga;
                document.getElementById('update-nama').value = data.nama;
                document.getElementById('update-alamat').value = data.alamat;
                document.getElementById('update-telepon').value = data.no_tlp;
                document.getElementById('update-beratBadan').value = data.bb;
                document.getElementById('update-kondisi').value = data.kondisi;
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
