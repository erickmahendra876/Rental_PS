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
    <title>Data Transaksi - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">PlayZone PS</a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="index.php">Daftar Bilik</a>
                <a class="nav-link" href="booking.php">Booking Bilik</a>
                <a class="nav-link active" href="tampil_booking.php">Data Transaksi</a>
            </div>
            <div class="d-flex align-items-center gap-2 text-white">
                <span>Halo, <b><?= $_SESSION['name']; ?></b> (<?= $_SESSION['role']; ?>)</span>
                <a href="logout.php" class="btn btn-danger btn-sm" onclick="return konfirmasiLogout()">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-1">Data Pemesanan & Transaksi</h3>
                <p class="text-muted mb-3">Riwayat jadwal booking, status pembayaran, dan kontrol sesi bermain</p>

                <?php
                if(isset($_GET['pesan']) && $_GET['pesan'] == "sukses"){
                    echo "<div class='alert alert-success'>Pemesanan bilik berhasil dicatat!</div>";
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Penyewa</th>
                                <th>Bilik & Konsol</th>
                                <th>Jadwal Main</th>
                                <th>Total & Metode</th>
                                <th>Pembayaran</th>
                                <th>Status Main</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $nama_user = $_SESSION['name'];

                            if($_SESSION['role'] == "admin"){
                                $sql = "SELECT booking.*, bilik.nama_bilik, bilik.tipe_konsol 
                                        FROM booking 
                                        JOIN bilik ON booking.bilik_id = bilik.id 
                                        ORDER BY booking.id DESC";
                            }else{
                                $sql = "SELECT booking.*, bilik.nama_bilik, bilik.tipe_konsol 
                                        FROM booking 
                                        JOIN bilik ON booking.bilik_id = bilik.id 
                                        WHERE booking.nama_penyewa = '$nama_user'
                                        ORDER BY booking.id DESC";
                            }

                            $query = mysqli_query($connect, $sql);
                            while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><b><?= $data['nama_penyewa']; ?></b></td>
                                <td>
                                    <?= $data['nama_bilik']; ?><br>
                                    <small class="text-muted"><?= $data['tipe_konsol']; ?></small>
                                </td>
                                <td>
                                    <?= $data['tanggal']; ?><br>
                                    <small><?= $data['jam_mulai']; ?> - <?= $data['jam_selesai']; ?> (<?= $data['durasi']; ?> Jam)</small>
                                </td>
                                <td>
                                    <b>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></b><br>
                                    <small class="text-muted"><?= $data['metode_pembayaran']; ?></small>
                                </td>
                                <td>
                                    <?php if($data['status_pembayaran'] == "Lunas"){ ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php }else{ ?>
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($data['status_booking'] == "Selesai"){ ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php }elseif($data['status_booking'] == "Berlangsung"){ ?>
                                        <span class="badge bg-warning text-dark">Berlangsung</span>
                                    <?php }else{ ?>
                                        <span class="badge bg-primary">Menunggu</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($_SESSION['role'] == "admin"){ ?>
                                        <?php if($data['status_pembayaran'] == "Belum Lunas"){ ?>
                                            <a href="aksi_booking.php?id=<?= $data['id']; ?>&aksi=lunas" class="btn btn-success btn-sm">Konfirmasi Lunas</a>
                                        <?php } ?>

                                        <?php if($data['status_booking'] == "Menunggu"){ ?>
                                            <a href="aksi_booking.php?id=<?= $data['id']; ?>&bilik_id=<?= $data['bilik_id']; ?>&aksi=mulai" class="btn btn-primary btn-sm">Mulai Main</a>
                                        <?php }elseif($data['status_booking'] == "Berlangsung"){ ?>
                                            <a href="aksi_booking.php?id=<?= $data['id']; ?>&bilik_id=<?= $data['bilik_id']; ?>&aksi=selesai" class="btn btn-warning btn-sm">Selesai</a>
                                        <?php } ?>

                                        <a href="aksi_booking.php?id=<?= $data['id']; ?>&bilik_id=<?= $data['bilik_id']; ?>&aksi=hapus" class="btn btn-danger btn-sm" onclick="return konfirmasiHapus()">Hapus</a>
                                    <?php }else{ ?>
                                        <?php if($data['status_booking'] == "Menunggu"){ ?>
                                            <a href="aksi_booking.php?id=<?= $data['id']; ?>&bilik_id=<?= $data['bilik_id']; ?>&aksi=hapus" class="btn btn-danger btn-sm" onclick="return konfirmasiHapus()">Batalkan</a>
                                        <?php }else{ ?>
                                            <span class="text-muted">-</span>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>