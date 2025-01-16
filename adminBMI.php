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
    $bb = $_POST['bb'];
    $umur = $_POST['umur'];

    $insertQuery = "INSERT INTO data_bayi (nama_bayi, bb, umur) VALUES ('$nama_bayi', '$bb', '$umur')";
    mysqli_query($koneksi, $insertQuery);
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_bayi = $_POST['id_bayi'];
    $bb = $_POST['bb'];
    $umur = $_POST['umur'];

    $updateQuery = "UPDATE data_bayi SET bb='$bb', umur='$umur' WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $updateQuery);
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_bayi = $_POST['id_bayi'];

    $deleteQuery = "DELETE FROM data_bayi WHERE id_bayi='$id_bayi'";
    mysqli_query($koneksi, $deleteQuery);
}

// Fetch Data
$query = "SELECT id_bayi, nama_bayi, bb, umur, (bb / (umur * umur)) AS BMI FROM data_bayi";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data BMI Bayi (Popup)</title>
    <link rel="stylesheet" href="adminbmi.css">
</head>
<body>
    <h1>Data BMI Bayi</h1>

    <!-- Button to trigger modal -->
    <button class="button" onclick="openModal('createModal')">Tambah Data Bayi</button>

    <!-- Table Read -->
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
            <td><?= htmlspecialchars($row['id_bayi']) ?></td>
            <td><?= htmlspecialchars($row['nama_bayi']) ?></td>
            <td><?= $row['bb'] ?></td>
            <td><?= $row['umur'] ?></td>
            <td><?= round($row['BMI'], 2) ?></td>
            <td>
                <!-- Update Button -->
                <button class="button" onclick="openModal('updateModal', <?= htmlspecialchars(json_encode($row)) ?>)">Update</button>
                <!-- Delete Button -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_bayi" value="<?= $row['id_bayi'] ?>">
                    <button type="submit" name="delete" class="button delete-button">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="adminDashboard.php" class="back-link">Kembali ke Dashboard</a>

    <!-- Modal for Create -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('createModal')">&times;</span>
            <h2>Tambah Data Bayi</h2>
            <form method="POST">
                <input type="text" name="nama_bayi" placeholder="Nama Bayi" required>
                <input type="number" name="bb" placeholder="Berat Badan (kg)" step="0.01" required>
                <input type="number" name="umur" placeholder="Umur (tahun)" step="0.01" required>
                <button type="submit" name="create" class="button">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Modal for Update -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update Data Bayi</h2>
            <form method="POST">
                <input type="hidden" name="id_bayi" id="update-id">
                <input type="text" name="nama_bayi" id="update-nama" disabled>
                <input type="number" name="bb" id="update-bb" placeholder="Berat Badan (kg)" step="0.01" required>
                <input type="number" name="umur" id="update-umur" placeholder="Umur (tahun)" step="0.01" required>
                <button type="submit" name="update" class="button">Update</button>
            </form>
        </div>
    </div>

    <script>
        // Open modal
        function openModal(modalId, data = null) {
            document.getElementById(modalId).style.display = "block";
            if (data && modalId === 'updateModal') {
                document.getElementById('update-id').value = data.id_bayi;
                document.getElementById('update-nama').value = data.nama_bayi;
                document.getElementById('update-bb').value = data.bb;
                document.getElementById('update-umur').value = data.umur;
            }
        }

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Close modal when clicking outside content
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