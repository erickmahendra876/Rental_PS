<?php
session_start();
if(!isset($_SESSION['status'])){
    header("Location: login.php?pesan=belum");
}
include "koneksi.php";

$bilik_terpilih = isset($_GET['bilik_id']) ? $_GET['bilik_id'] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Bilik - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">PlayZone PS</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="index.php">Daftar Bilik</a>
                <a class="nav-link active" href="booking.php">Booking Bilik</a>
                <a class="nav-link" href="tampil_booking.php">Data Transaksi</a>
            </div>
            <div class="d-flex align-items-center gap-2 text-white">
                <span>Halo, <b><?= $_SESSION['name']; ?></b> (<?= $_SESSION['role']; ?>)</span>
                <a href="logout.php" class="btn btn-danger btn-sm" onclick="return konfirmasiLogout()">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="card mx-auto shadow-sm" id="card-form">
            <div class="card-body p-4">
                <h3 class="card-title mb-3">Form Pemesanan Jadwal Main</h3>

                <?php
                if(isset($_GET['pesan']) && $_GET['pesan'] == "bentrok"){
                    echo "<div class='alert alert-danger'>JADWAL BENTROK! Bilik sudah dipesan pada jam tersebut.</div>";
                }
                ?>

                <form action="proses_booking.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" class="form-control" value="<?= $_SESSION['name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Bilik & Konsol</label>
                        <select name="bilik_id" id="bilik_id" class="form-select" onchange="hitungTotal()" required>
                            <option value="" data-harga="0">-- Pilih Bilik --</option>
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM bilik WHERE status != 'Perbaikan'");
                            while($b = mysqli_fetch_array($query)){
                                $selected = ($b['id'] == $bilik_terpilih) ? "selected" : "";
                            ?>
                                <option value="<?= $b['id']; ?>" data-harga="<?= $b['harga_per_jam']; ?>" <?= $selected; ?>>
                                    <?= $b['nama_bilik']; ?> - <?= $b['tipe_konsol']; ?> (Rp <?= number_format($b['harga_per_jam'], 0, ',', '.'); ?>/jam)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Main</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="14:00" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi Main (Jam)</label>
                        <input type="number" name="durasi" id="durasi" class="form-control" min="1" max="12" value="2" oninput="hitungTotal()" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Metode Pembayaran</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" value="Bayar di Tempat (Cash)" checked>
                            <label class="form-check-label">Cash di Kasir</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" value="Transfer Bank" onclick="infoPembayaran('Transfer Bank')">
                            <label class="form-check-label">Transfer Bank</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" value="QRIS / E-Wallet" onclick="infoPembayaran('QRIS')">
                            <label class="form-check-label">QRIS / E-Wallet</label>
                        </div>
                    </div>

                    <div class="kotak-total mb-3">
                        Estimasi Total Bayar: <b id="tampil_total">Rp 0</b>
                    </div>

                    <div class="d-flex gap-2">
                        <input type="submit" value="Konfirmasi Booking" class="btn btn-primary">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>