<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM mahasiswa WHERE id=$id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit / Set ID Fingerprint</h4>
            </div>
            <div class="card-body">
                <form action="proses_edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" value="<?php echo $data['nim']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-danger">ID Fingerprint (Dari Alat)</label>
                        <input type="number" name="fingerprint_id" class="form-control" value="<?php echo $data['fingerprint_id']; ?>" required>
                        <small class="form-text text-muted">Masukkan nomor ID (1-127) sesuai yang tersimpan di sensor AS608.</small>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Simpan Perubahan</button>
                    <a href="admin_dashboard.php" class="btn btn-secondary btn-block">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>