<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Absensi Real-time</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding: 20px; background-color: #f4f4f9; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .unknown { color: red; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Log Data Absensi Real-time</h2>
            <div>
                <a href="login.php" class="btn btn-outline-primary">Login Mahasiswa</a>
            </div>
        </div>
        
        <div class="alert alert-info">
            Halaman ini me-refresh otomatis setiap 5 detik.
        </div>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No. Log</th>
                    <th>Nama Mahasiswa</th>
                    <th>ID Jari</th>
                    <th>Waktu Scan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                // Query dengan LEFT JOIN agar data tetap muncul meski ID belum terdaftar di tabel mahasiswa
                $sql = "SELECT data_absen.id, data_absen.fingerprint_id, data_absen.waktu, mahasiswa.nama, mahasiswa.nim 
                        FROM data_absen 
                        LEFT JOIN mahasiswa ON data_absen.fingerprint_id = mahasiswa.fingerprint_id 
                        ORDER BY data_absen.waktu DESC LIMIT 50";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        
                        // Logika Tampilan Nama
                        if ($row["nama"]) {
                            echo "<td><strong>" . $row["nama"] . "</strong> <br><small>(" . $row["nim"] . ")</small></td>";
                        } else {
                            echo "<td class='unknown'>Belum Terdaftar (Silakan Update ID Jari)</td>";
                        }

                        echo "<td>" . $row["fingerprint_id"] . "</td>";
                        echo "<td>" . $row["waktu"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada data absensi.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Auto Refresh setiap 5 detik -->
    <meta http-equiv="refresh" content="5">
</body>
</html>