<?php
session_start();
if(!isset($_SESSION['status'])){
    header("Location: login.php?pesan=belum");
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bilik - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">PlayZone PS</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link active" href="index.php">Daftar Bilik</a>
                <a class="nav-link" href="booking.php">Booking Bilik</a>
                <a class="nav-link" href="tampil_booking.php">Data Transaksi</a>
            </div>
            <div class="d-flex align-items-center gap-2 text-white">
                <span>Halo, <b><?= $_SESSION['name']; ?></b> (<?= $_SESSION['role']; ?>)</span>
                <a href="logout.php" class="btn btn-danger btn-sm" onclick="return konfirmasiLogout()">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="mb-0">Daftar Bilik & Fasilitas Konsol PS</h2>
                <p class="text-muted mb-0">Pilih bilik yang tersedia untuk mulai memesan jadwal main</p>
            </div>
            <?php if($_SESSION['role'] == "admin"){ ?>
                <a href="tambah_bilik.php" class="btn btn-primary">+ Tambah Bilik</a>
            <?php } ?>
        </div>

        <div class="wadah-kartu">
            <?php
            $query = mysqli_query($connect, "SELECT * FROM bilik");
            while($data = mysqli_fetch_array($query)){
            ?>
            <div class="card kartu-bilik shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary fw-bold"><?= $data['tipe_konsol']; ?></span>
                        <?php if($data['status'] == "Tersedia"){ ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php }elseif($data['status'] == "Digunakan"){ ?>
                            <span class="badge bg-warning text-dark">Digunakan</span>
                        <?php }else{ ?>
                            <span class="badge bg-danger">Perbaikan</span>
                        <?php } ?>
                    </div>

                    <h5 class="card-title"><?= $data['nama_bilik']; ?></h5>
                    <p class="card-text text-muted"><?= $data['fasilitas']; ?></p>
                    <p class="fw-bold fs-5 mb-3">Rp <?= number_format($data['harga_per_jam'], 0, ',', '.'); ?> <small class="text-muted fs-6">/ jam</small></p>

                    <div class="d-flex gap-2">
                        <?php if($data['status'] != "Perbaikan"){ ?>
                            <a href="booking.php?bilik_id=<?= $data['id']; ?>" class="btn btn-primary btn-sm">Booking Bilik</a>
                        <?php }else{ ?>
                            <button class="btn btn-secondary btn-sm" disabled>Dalam Perbaikan</button>
                        <?php } ?>

                        <?php if($_SESSION['role'] == "admin"){ ?>
                            <a href="edit_bilik.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_bilik.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return konfirmasiHapus()">Hapus</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>