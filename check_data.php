<?php
// Diagnostic page to check database contents
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Database Contents</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding: 20px; background-color: #f4f4f9; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa (Master Data)</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Fingerprint ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM mahasiswa";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["nim"] . "</td>";
                        echo "<td>" . $row["fingerprint_id"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Tidak ada data mahasiswa</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <p class="text-muted">Total: <?php echo $result->num_rows; ?> mahasiswa</p>
    </div>

    <div class="container">
        <h2>Data Absen (Attendance Logs)</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Fingerprint ID</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM data_absen ORDER BY waktu DESC LIMIT 50";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["fingerprint_id"] . "</td>";
                        echo "<td>" . $row["waktu"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center text-danger'><strong>Tidak ada data absensi - Table kosong!</strong></td></tr>";
                }
                ?>
            </tbody>
        </table>
        <p class="text-muted">Total: <?php echo $result->num_rows; ?> record absensi</p>
    </div>

    <div class="alert alert-info">
        <strong>Cara menambah data absensi:</strong>
        <ol>
            <li>Scan fingerprint menggunakan ESP32 (akan otomatis masuk via POST ke koneksi.php)</li>
            <li>Atau manual insert data: <code>INSERT INTO data_absen (fingerprint_id) VALUES (1)</code></li>
        </ol>
    </div>

    <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>

<?php
$conn->close();
?>
</body>
</html>
