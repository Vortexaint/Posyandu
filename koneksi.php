<?php 
 
$koneksi = mysqli_connect("localhost","rafi","R@fi8181.","redonion_posyandu");

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>