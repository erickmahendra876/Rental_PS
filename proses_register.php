<?php
include "koneksi.php";

$nama     = $_POST['nama'];
$username = $_POST['usn'];
$password = $_POST['pwd'];

mysqli_query($connect, "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', 'pelanggan')");

header("Location: login.php?pesan=daftar_sukses");
?>