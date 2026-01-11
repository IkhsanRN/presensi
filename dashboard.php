<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: login.php?pesan=belum_login");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background: #f4f4f9; padding-top: 50px; }
        .card { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h4>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h4>
                    </div>
                    <div class="card-body">
                        <p>Anda berhasil login ke sistem presensi.</p>
                        <hr>
                        <h5>Data Anda:</h5>
                        <ul>
                            <li><strong>Nama:</strong> <?php echo $_SESSION['nama']; ?></li>
                            <li><strong>NIM:</strong> <?php echo $_SESSION['nim']; ?></li>
                        </ul>
                        <br>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        <a href="index.php" class="btn btn-primary">Lihat Log Absensi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>