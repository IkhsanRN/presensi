<?php
// --- Konfigurasi Database ---
// Sesuaikan dengan settingan XAMPP/Hosting Anda
$servername = "localhost";
$username = "root";      // Default XAMPP user
$password = "";          // Default XAMPP password kosong
$dbname = "absensi_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Memeriksa apakah ada data POST yang dikirim oleh ESP32
// Kita akan menggunakan nama parameter 'tempel_id'
if (isset($_POST['tempel_id'])) {
    $fid = $_POST['tempel_id'];

    // Validasi sederhana agar yang masuk hanya angka
    if (is_numeric($fid)) {
        // Query untuk memasukkan data
        $sql = "INSERT INTO data_absen (fingerprint_id) VALUES ('$fid')";

        if ($conn->query($sql) === TRUE) {
            echo "Sukses: Data berhasil disimpan ke database";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Data ID tidak valid";
    }
} else {
    echo "Menunggu data POST...";
}

// Note: Connection is left open for other scripts that include this file
// Make sure to close $conn in the main script after use
?>