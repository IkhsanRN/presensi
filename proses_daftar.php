<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$ttl = $_POST['ttl'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$password = $_POST['password'];

// Enkripsi password sebelum disimpan (PENTING untuk keamanan)
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Default fingerprint_id adalah 0 (belum rekam sidik jari)
$fingerprint_id = 0;

// Cek apakah NIM sudah terdaftar
$cek_nim = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
$result = $conn->query($cek_nim);

if ($result->num_rows > 0) {
    echo "<script>
            alert('NIM sudah terdaftar! Silakan login atau gunakan NIM lain.');
            window.location.href='formulir.php';
          </script>";
} else {
    // Query simpan data
    $sql = "INSERT INTO mahasiswa (nama, nim, ttl, jurusan, email, password, fingerprint_id) 
            VALUES ('$nama', '$nim', '$ttl', '$jurusan', '$email', '$password_hashed', '$fingerprint_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Pendaftaran Berhasil! Silakan lapor admin untuk perekaman sidik jari.');
                window.location.href='login.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>