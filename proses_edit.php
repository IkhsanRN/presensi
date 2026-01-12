<?php
include 'koneksi.php';

$id = $_POST['id'];
$fingerprint_id = $_POST['fingerprint_id'];

// Update hanya fingerprint_id
$sql = "UPDATE mahasiswa SET fingerprint_id='$fingerprint_id' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Sukses! ID Fingerprint berhasil di-update.');
            window.location.href='admin_dashboard.php';
          </script>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>