<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['role'] != "admin"){
    header("Location: login.php?pesan=belum");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bilik - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" id="card-form">
            <div class="card-body p-4">
                <h3 class="card-title mb-3">Tambah Data Bilik & Konsol</h3>
                <form action="proses_tambah_bilik.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Bilik</label>
                        <input type="text" name="nama_bilik" class="form-control" placeholder="Contoh: Bilik Reguler 03" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Konsol PS</label>
                        <input type="text" name="tipe_konsol" class="form-control" placeholder="Contoh: PlayStation 5 Digital" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fasilitas Pendukung</label>
                        <input type="text" name="fasilitas" class="form-control" placeholder="Contoh: TV 4K 50 Inch, 2 Stik, AC, Sofa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tarif per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" class="form-control" placeholder="20000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Awal</label>
                        <select name="status" class="form-select">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Perbaikan">Perbaikan</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="submit" value="Simpan Data" class="btn btn-primary">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>