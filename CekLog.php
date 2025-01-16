<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: adminDashboard.php");
    } elseif ($user['role'] === 'kader') {
        header("Location: kaderDashboard.php");
    } else {
        header("Location: Dashboard.php");
    }
    exit;
    
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: Login.php");
    exit;
}
?>
