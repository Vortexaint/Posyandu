<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $nama_bayi = $_POST['nama_bayi'];
    $lingkar_kepala = $_POST['lingkar_kepala'];

    $insertQuery = "INSERT INTO data_bayi (nama_bayi, linkar_kepala) VALUES ('$nama_bayi', '$lingkar_kepala')";
    mysqli_query($koneksi, $insertQuery);
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_bayi = $_POST['id_bayi'];
    $lingkar_kepala = $_POST['lingkar_kepala'];

    $updateQuery = "UPDATE data_bayi SET linkar_kepala='$lingkar_kepala' WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $updateQuery);
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_bayi = $_POST['id_bayi'];

    $deleteQuery = "DELETE FROM data_bayi WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $deleteQuery);
}

// Fetch Data
$query = "SELECT id_bayi, nama_bayi, linkar_kepala FROM data_bayi";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Lingkar Kepala</title>
    <link rel="stylesheet" href="css/adminCRUD.css">
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
    <h1>Data Lingkar Kepala Bayi</h1>
    <button class="button" onclick="openModal('createModal')">Tambah Data Bayi</button>
    <table>
        <tr>
            <th>ID Bayi</th>
            <th>Nama Bayi</th>
            <th>Lingkar Kepala (cm)</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id_bayi']) ?></td>
            <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
            <td><?= $row['linkar_kepala'] ?></td>
            <td>
                <button class="button" onclick="openModal('updateModal', <?= htmlspecialchars(json_encode($row)) ?>)">Update</button>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_bayi" value="<?= $row['id_bayi'] ?>">
                    <button type="submit" name="delete" class="button delete-button">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="adminDashboard.php" class="back-link">Kembali ke Dashboard</a>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('createModal')">&times;</span>
            <h2>Tambah Data Bayi</h2>
            <form method="POST">
                <input type="text" name="nama_bayi" placeholder="Nama Bayi" required>
                <input type="number" name="lingkar_kepala" placeholder="Lingkar Kepala (cm)" step="0.01" required>
                <button type="submit" name="create" class="button">Tambah</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update Data Bayi</h2>
            <form method="POST">
                <input type="hidden" name="id_bayi" id="update-id">
                <input type="text" name="nama_bayi" id="update-nama" disabled>
                <input type="number" name="lingkar_kepala" id="update-lingkar" placeholder="Lingkar Kepala (cm)" step="0.01" required>
                <button type="submit" name="update" class="button">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, data = null) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            if (data && modalId === 'updateModal') {
                document.getElementById('update-id').value = data.id_bayi;
                document.getElementById('update-nama').value = data.nama_bayi;
                document.getElementById('update-lingkar').value = data.linkar_kepala;
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        window.onclick = function (event) {
            const modals = document.getElementsByClassName('modal');
            Array.from(modals).forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        };
    </script>
    <footer>
        &copy; 2024 Posyandu Desa. Semua Hak Dilindungi.
    </footer>
</body>
</html>
<?php mysqli_close($koneksi); ?>