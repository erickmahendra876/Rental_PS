<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" id="card-auth">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-1">PlayZone Rental PS</h3>
                <p class="text-muted text-center mb-4">Masuk untuk memesan atau mengelola bilik</p>

                <?php
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "belum"){
                        echo "<div class='alert alert-danger'>KAMU BELUM LOGIN!</div>";
                    }elseif($_GET['pesan'] == "logout"){
                        echo "<div class='alert alert-success'>KAMU BERHASIL LOGOUT!</div>";
                    }elseif($_GET['pesan'] == "gagal"){
                        echo "<div class='alert alert-danger'>USERNAME ATAU PASSWORD SALAH!</div>";
                    }elseif($_GET['pesan'] == "daftar_sukses"){
                        echo "<div class='alert alert-success'>PENDAFTARAN BERHASIL! SILAKAN LOGIN.</div>";
                    }
                }
                ?>

                <form action="aksesLogin.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="usn" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pwd" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <input type="submit" value="Login" class="btn btn-primary w-100">
                </form>

                <p class="text-center mt-3 mb-2">
                    Belum punya akun? <a href="register.php">Daftar Akun Pelanggan</a>
                </p>
                <div class="kotak-info">
                    <small><b>Akun Demo:</b><br>
                    Admin: <code>admin</code> / <code>123</code><br>
                    Pelanggan: <code>budi</code> / <code>123</code></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>