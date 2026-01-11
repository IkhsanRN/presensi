<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding: 20px; background-color: #f4f4f9; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Log Data Absensi Real-time</h2>
        <p class="text-center">Halaman ini akan refresh otomatis setiap 10 detik.</p>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No. Log</th>
                    <th>ID Sidik Jari</th>
                    <th>Waktu Scan (Timestamp)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // --- Konfigurasi Database ---
                $servername = "localhost"; $username = "root"; $password = ""; $dbname = "absensi_db";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) { die("Koneksi gagal: " . $conn->connect_error); }

                // Ambil data dari tabel, urutkan dari yang terbaru
                $sql = "SELECT * FROM data_absen ORDER BY waktu DESC LIMIT 50";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data setiap baris
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        // Nanti Anda bisa mengganti ID ini dengan nama pegawai menggunakan JOIN tabel lain
                        echo "<td><strong>Pegawai ID #" . $row["fingerprint_id"] . "</strong></td>"; 
                        echo "<td>" . $row["waktu"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Belum ada data absensi masuk.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <meta http-equiv="refresh" content="10">
</body>
</html>