<?php
session_start();
include 'koneksi.php';

$username = $_POST['username']; // Bisa berupa Nama atau NIM, tergantung input user
$password = $_POST['password'];

// Kita cek berdasarkan NAMA (sesuai form login Anda)
$sql = "SELECT * FROM mahasiswa WHERE nama = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verifikasi password yang di-hash
    if (password_verify($password, $row['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['nim'] = $row['nim'];
        $_SESSION['status'] = "login";

        header("Location: dashboard.php");
    } else {
        echo "<script>
                alert('Password salah!');
                window.location.href='login.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Username tidak ditemukan!');
            window.location.href='login.php';
          </script>";
}

$conn->close();
?>