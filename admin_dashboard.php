<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin - Kelola Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Halaman Admin - Binding Data Sidik Jari</h2>
        <div class="alert alert-warning">
            <strong>Cara Kerja:</strong> <br>
            1. Minta mahasiswa scan jari di alat untuk perekaman (Enroll). <br>
            2. Lihat ID berapa yang muncul di layar alat/serial monitor (Misal: ID 5). <br>
            3. Klik tombol "Edit" pada nama mahasiswa di bawah, lalu masukkan angka 5.
        </div>
        
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>ID Fingerprint (Di Alat)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php'; // Pastikan file koneksi.php ada
                $no = 1;
                $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        
                        // Highlight jika belum ada ID fingerprint
                        if($row['fingerprint_id'] == 0 || $row['fingerprint_id'] == NULL) {
                            echo "<td class='text-danger font-weight-bold'>Belum Diset (0)</td>";
                        } else {
                            echo "<td class='text-success font-weight-bold'>ID " . $row['fingerprint_id'] . "</td>";
                        }

                        echo "<td>
                                <a href='edit_mahasiswa.php?id=".$row['id']."' class='btn btn-sm btn-primary'>Edit / Set ID</a>
                                <a href='hapus_mahasiswa.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin hapus data ini?')\">Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Belum ada data mahasiswa.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Monitoring</a>
    </div>
</body>
</html>