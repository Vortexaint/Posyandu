<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($result) > 0) {
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $username;
    header("Location: Dashboard.php");
} else {
    echo "Username atau password Salah!";
    header("Location: Login.php");
}
?>