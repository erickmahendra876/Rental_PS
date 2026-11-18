<?php
include "koneksi.php";

$id       = $_GET['id'];
$aksi     = $_GET['aksi'];
$bilik_id = isset($_GET['bilik_id']) ? $_GET['bilik_id'] : 0;

if($aksi == "lunas"){
    mysqli_query($connect, "UPDATE booking SET status_pembayaran = 'Lunas' WHERE id = $id");
}elseif($aksi == "mulai"){
    mysqli_query($connect, "UPDATE booking SET status_booking = 'Berlangsung' WHERE id = $id");
    mysqli_query($connect, "UPDATE bilik SET status = 'Digunakan' WHERE id = $bilik_id");
}elseif($aksi == "selesai"){
    mysqli_query($connect, "UPDATE booking SET status_booking = 'Selesai', status_pembayaran = 'Lunas' WHERE id = $id");
    mysqli_query($connect, "UPDATE bilik SET status = 'Tersedia' WHERE id = $bilik_id");
}elseif($aksi == "hapus"){
    mysqli_query($connect, "DELETE FROM booking WHERE id = $id");
    if($bilik_id != 0){
        mysqli_query($connect, "UPDATE bilik SET status = 'Tersedia' WHERE id = $bilik_id");
    }
}

header("Location: tampil_booking.php");
?>