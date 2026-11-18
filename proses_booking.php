<?php
include "koneksi.php";

$bilik_id          = $_POST['bilik_id'];
$nama_penyewa      = $_POST['nama_penyewa'];
$tanggal           = $_POST['tanggal'];
$jam_mulai         = $_POST['jam_mulai'];
$durasi            = $_POST['durasi'];
$metode_pembayaran = $_POST['metode_pembayaran'];

// Hitung jam selesai otomatis
$jam_selesai = date("H:i", strtotime("+$durasi hours", strtotime($jam_mulai)));

// Ambil harga per jam
$data_bilik  = mysqli_fetch_array(mysqli_query($connect, "SELECT harga_per_jam FROM bilik WHERE id = $bilik_id"));
$total_harga = $data_bilik['harga_per_jam'] * $durasi;

// Validasi anti bentrok jadwal
$cek_jadwal = mysqli_query($connect, "SELECT * FROM booking 
    WHERE bilik_id = '$bilik_id' 
    AND tanggal = '$tanggal' 
    AND status_booking != 'Selesai' 
    AND (jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_mulai')");

if(mysqli_num_rows($cek_jadwal) > 0){
    header("Location: booking.php?bilik_id=$bilik_id&pesan=bentrok");
}else{
    mysqli_query($connect, "INSERT INTO booking (bilik_id, nama_penyewa, tanggal, jam_mulai, durasi, jam_selesai, total_harga, metode_pembayaran, status_pembayaran, status_booking) 
        VALUES ('$bilik_id', '$nama_penyewa', '$tanggal', '$jam_mulai', '$durasi', '$jam_selesai', '$total_harga', '$metode_pembayaran', 'Belum Lunas', 'Menunggu')");

    header("Location: tampil_booking.php?pesan=sukses");
}
?>