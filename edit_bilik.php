<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['role'] != "admin"){
    header("Location: login.php?pesan=belum");
}
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM bilik WHERE id = $id"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bilik - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" id="card-form">
            <div class="card-body p-4">
                <h3 class="card-title mb-3">Edit Data Bilik & Konsol</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Bilik</label>
                        <input type="text" name="nama_bilik" class="form-control" value="<?= $query['nama_bilik']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Konsol PS</label>
                        <input type="text" name="tipe_konsol" class="form-control" value="<?= $query['tipe_konsol']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fasilitas</label>
                        <input type="text" name="fasilitas" class="form-control" value="<?= $query['fasilitas']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tarif per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" class="form-control" value="<?= $query['harga_per_jam']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Kondisi</label>
                        <select name="status" class="form-select">
                            <option value="Tersedia" <?= ($query['status'] == "Tersedia") ? "selected" : ""; ?>>Tersedia</option>
                            <option value="Digunakan" <?= ($query['status'] == "Digunakan") ? "selected" : ""; ?>>Digunakan</option>
                            <option value="Perbaikan" <?= ($query['status'] == "Perbaikan") ? "selected" : ""; ?>>Perbaikan</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="submit" name="simpan" value="Update Data" class="btn btn-primary">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['simpan'])){
    $nama_bilik    = $_POST['nama_bilik'];
    $tipe_konsol   = $_POST['tipe_konsol'];
    $fasilitas     = $_POST['fasilitas'];
    $harga_per_jam = $_POST['harga_per_jam'];
    $status        = $_POST['status'];

    mysqli_query($connect, "UPDATE bilik SET 
        nama_bilik = '$nama_bilik', 
        tipe_konsol = '$tipe_konsol', 
        fasilitas = '$fasilitas', 
        harga_per_jam = '$harga_per_jam', 
        status = '$status' 
        WHERE id = $id");

    header("Location: index.php");
}
?>