<?php 
 
$koneksi = mysqli_connect("localhost","root","","posyandu");

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>