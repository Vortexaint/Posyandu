<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $insertQuery = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($koneksi, $insertQuery);
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE user SET username = '$username', password = '$password', role = '$role' WHERE id_user = '$id_user'";
    mysqli_query($koneksi, $updateQuery);
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_user = $_POST['id_user'];

    $deleteQuery = "DELETE FROM user WHERE id_user='$id_user'";
    mysqli_query($koneksi, $deleteQuery);
}

// Fetch Data
$query = "SELECT id_user, username, password, role FROM user";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data User</title>
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
    <h1>Kelola Data User</h1>
    <button class="button" onclick="openModal('createModal')">Tambah User</button>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id_user']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['password']) ?></td>
            <td><?= htmlspecialchars($row['role']) ?></td>
            <td>
                <button class="button" onclick="openModal('updateModal', <?= htmlspecialchars(json_encode($row)) ?>)">Update</button>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
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
            <h2>Tambah User</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="role" placeholder="Role" required>
                <button type="submit" name="create" class="button">Tambah</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <h2>Update User</h2>
            <form method="POST">
                <input type="hidden" name="id_user" id="update-id">
                <input type="text" name="username" id="update-username" required>
                <input type="password" name="password" id="update-password" required>
                <input type="text" name="role" id="update-role" required>
                <button type="submit" name="update" class="button">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, data = null) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            if (data && modalId === 'updateModal') {
                document.getElementById('update-id').value = data.id_user;
                document.getElementById('update-username').value = data.username;
                document.getElementById('update-password').value = data.password;
                document.getElementById('update-role').value = data.role;
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
</body>
</html>
<?php mysqli_close($koneksi); ?>
