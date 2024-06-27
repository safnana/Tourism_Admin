<?php
include 'ceksession.php';
include 'koneksi.php';

$id_admin = $_SESSION['id_admin'];
$nama_admin = $_POST['nama'];
$username_admin = $_POST['username'];
$email_admin = $_POST['email'];
$query = "UPDATE admin SET nama_admin=?, usn_admin=?, email_admin=? WHERE id_admin=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssi", $nama_admin, $username_admin, $email_admin, $id_admin);

if ($stmt->execute()) {
    $_SESSION['nama_admin'] = $nama_admin;
    $_SESSION['usn_admin'] = $username_admin;
    $_SESSION['email_admin'] = $email_admin;
    echo "Profil berhasil diperbarui!";
} else {
    echo "Terjadi kesalahan saat memperbarui profil: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
