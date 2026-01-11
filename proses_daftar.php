<?php
// Koneksi database
include 'koneksi.php'; // Atau copy script koneksi dari simpan data.php

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$ttl = $_POST['ttl'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

// Query Simpan
$sql = "INSERT INTO mahasiswa (nama, nim, ttl, jurusan, email, password) 
        VALUES ('$nama', '$nim', '$ttl', '$jurusan', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pendaftaran Berhasil! Silakan lapor admin untuk rekam sidik jari.'); window.location.href='login.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>