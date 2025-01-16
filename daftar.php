<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "Posyandu";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $role = 'warga';

    if (!empty($username) && !empty($password)) {
        $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Pendaftaran berhasil!'); window.location.href='Dashboard.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Semua kolom wajib diisi!');</script>";
    }
}

$conn->close();
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
</head>
<body>
    <div class="dashboard-container">
        <a href="index.php">
            <div class="footer">Posyandu Desa</div>
        </a>
        <h1 class="dashboard-title">Daftar</h1>
        <form name="registerForm" action="" method="POST" autocomplete="off">
            <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
            <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
            <div class="buttons">
                <button type="submit" class="button">Daftar</button>
            </div>
        </form>
    </div>
</body>
</html>
