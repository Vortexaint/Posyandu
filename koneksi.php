<?php 
 
$koneksi = mysqli_connect("localhost","redonion_rafi","R@fi8181.","redonion_posyandu");

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>