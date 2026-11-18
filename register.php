<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PlayZone Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" id="card-auth">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-1">Daftar Akun</h3>
                <p class="text-muted text-center mb-4">Buat akun pelanggan baru</p>

                <form action="proses_register.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Sesuai nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="usn" class="form-control" placeholder="Buat username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pwd" class="form-control" placeholder="Buat password" required>
                    </div>
                    <input type="submit" value="Daftar Sekarang" class="btn btn-primary w-100">
                </form>

                <p class="text-center mt-3 mb-0">
                    Sudah punya akun? <a href="login.php">Kembali ke Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>