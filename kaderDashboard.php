<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'kader') {
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kader</title>
    <link rel="stylesheet" href="kaderDashboard.css"> <!-- Pastikan nama file CSS sudah benar -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <div class="button-group">
            <a href="kaderBMI.php" class="button">Kelola Data BMI</a>
            <a href="kaderLingkarKepala.php" class="button">Kelola Lingkar Kepala</a>
            <a href="signOut.php" class="button">Logout</a>
        </div>
    </div>
</body>
</html>
