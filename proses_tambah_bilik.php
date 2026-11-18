<?php
include "koneksi.php";

$nama_bilik    = $_POST['nama_bilik'];
$tipe_konsol   = $_POST['tipe_konsol'];
$fasilitas     = $_POST['fasilitas'];
$harga_per_jam = $_POST['harga_per_jam'];
$status        = $_POST['status'];

mysqli_query($connect, "INSERT INTO bilik (nama_bilik, tipe_konsol, fasilitas, harga_per_jam, status) 
                        VALUES ('$nama_bilik', '$tipe_konsol', '$fasilitas', '$harga_per_jam', '$status')");

header("Location: index.php");
?>