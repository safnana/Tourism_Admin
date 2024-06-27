<?php
include 'koneksi.php';

$id = $_POST['id'];
$status = $_POST['status'];

$q = "UPDATE pemesanan SET status='$status' WHERE id_pemesanan=$id";

if (mysqli_query($conn, $q)) {
    echo "Data berhasil diperbarui.";
} else {
    echo "Error: " . $q . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('Location: pemesanan.php');
exit;
?>
