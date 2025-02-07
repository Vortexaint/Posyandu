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
    <link rel="stylesheet" href="css/adminDashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <div class="button-group">
            <a href="adminBMI.php" class="button">Kelola Data BMI</a>
            <a href="adminLingkarKepala.php" class="button">Kelola Lingkar Kepala</a>
            <a href="adminWarga.php" class="button">Kelola Data Warga</a>
            <a href="adminKader.php" class="button">Kelola Data Kader</a>
            <a href="adminUser.php" class="button">Kelola Data Login</a>
            <a href="signOut.php" class="button">Logout</a>
        </div>
    </div>
</body>
</html>