<?php
session_start();
include "koneksi.php";

$username = $_POST['usn'];
$password = $_POST['pwd'];

$query = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
$cek   = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_array($query);
    $_SESSION['name']   = $data['nama'];
    $_SESSION['role']   = $data['role'];
    $_SESSION['status'] = "Login";
    header("Location: index.php");
}else{
    header("Location: login.php?pesan=gagal");
}
?>