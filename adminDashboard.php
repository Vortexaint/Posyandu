<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding-top: 50px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <a href="adminBMI.php" class="button">Kelola Data BMI</a>
    <a href="adminLingkarKepala.php" class="button">Kelola Lingkar Kepala</a>
    <a href="logout.php" class="button">Logout</a>
</body>
</html>
