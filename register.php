<?php
include 'koneksi.php';

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO admin (nama_admin, usn_admin, email_admin, pass_admin) VALUES ('$name', '$username', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
exit;
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$conn->close();
?>