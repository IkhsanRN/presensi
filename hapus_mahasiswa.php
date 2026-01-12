<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM mahasiswa WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>