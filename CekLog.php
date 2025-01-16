<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ($password === $user['password']) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        if ($user['role'] !== 'admin') {
            if ($user['role'] === 'kader') {
                header("Location: kaderDashboard.php");
            } else {
                header("Location: Dashboard.php");
            }
        } else {
            header("Location: adminDashboard.php");
        }
        exit;
        } else {
        $_SESSION['error'] = "Password salah!";
    }
} else {
    $_SESSION['error'] = "Username tidak ditemukan!";
}

header("Location: Login.php");
exit;
?>