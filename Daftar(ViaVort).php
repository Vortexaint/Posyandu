<?php
session_start();
include 'koneksi.php';

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Simpan password langsung tanpa hashing
    $role = 'warga';

    // Validasi input
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Username harus berupa email yang valid.";
        header("Location: Daftar(ViaVort).php");
        exit;
    }

    // Periksa apakah username sudah ada
    $checkUser = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($checkUser) > 0) {
        $_SESSION['error'] = "Username sudah digunakan.";
        header("Location: Daftar(ViaVort).php");
        exit;
    }

    // Tambahkan pengguna baru
    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: Login.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat mendaftar.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Posyandu Desa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 2px solid #4CAF50;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .footer {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .dashboard-title { margin: 20px 0; font-size: 2rem; color: #333; }
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            font-size: 1rem;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover { background-color: #388E3C; }
    </style>
    <script>
        function validateForm() {
            const username = document.forms["loginForm"]["username"].value;
            const password = document.forms["loginForm"]["password"].value;
            const emailPattern = /^[\w.-]+@[\w.-]+\.(com|co\.id|net|org)$/;
            const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])/;

            if (!emailPattern.test(username)) {
                alert("Username harus berupa email yang valid (misal: user@example.com)");
                return false;
            }
            if (!passwordPattern.test(password)) {
                alert("Password harus memiliki minimal 1 angka dan 1 simbol.");
                return false;
            }
            return true;
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</head>
<body>
    <div class="dashboard-container">
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="Daftar(ViaVort).php" method="POST" autocomplete="off">
            <a href="Dashboard.php">
                <div class="footer">Posyandu Desa</div>
            </a>
            <h1 class="dashboard-title">Daftar</h1>
            <input type="text" class="form-control" name="username" placeholder="Email" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div style="text-align: left; margin: 10px 0;">
                <input type="checkbox" id="showPassword" onclick="togglePassword()"> Show Password
            </div>
            <div class="buttons">
                <button type="submit" class="button">Daftar</button>
            </div>
        </form>
        <p>Sudah punya akun? <a href="Login.php">Login di sini</a></p>
    </div>
</body>
</html>