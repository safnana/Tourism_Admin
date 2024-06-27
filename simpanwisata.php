<?php
include 'koneksi.php';

$id_wisata = $_POST['id_wisata'];
$nama_wisata = $_POST['nama_wisata'];
$deskripsi_wisata = $_POST['deskripsi_wisata'];
$lokasi_wisata = $_POST['lokasi_wisata'];
$tautan_maps = $_POST['tautan_maps'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$gambar_wisata = null;

// Check for uploaded image
if (isset($_FILES['gambar_wisata']) && $_FILES['gambar_wisata']['error'] == UPLOAD_ERR_OK) {
    $gambarTmp = $_FILES['gambar_wisata']['tmp_name'];
    $namaGambar = $_FILES['gambar_wisata']['name'];
    $dirUpload = 'D:/xampp/htdocs/JJ-Admin/assets/Wisata/';
    $pathGambar = $dirUpload . basename($namaGambar);

    if (move_uploaded_file($gambarTmp, $pathGambar)) {
        $gambar_wisata = file_get_contents($pathGambar);
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
        exit;
    }
}

if ($gambar_wisata !== null) {
    $query = "UPDATE wisata SET nama_wisata=?, deskripsi_wisata=?, lokasi_wisata=?, tautan_maps=?, jam_buka=?, jam_tutup=?, gambar_wisata=? WHERE id_wisata=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $nama_wisata, $deskripsi_wisata, $lokasi_wisata, $tautan_maps, $jam_buka, $jam_tutup, $gambar_wisata, $id_wisata);
} else {
    $query = "UPDATE wisata SET nama_wisata=?, deskripsi_wisata=?, lokasi_wisata=?, tautan_maps=?, jam_buka=?, jam_tutup=? WHERE id_wisata=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $nama_wisata, $deskripsi_wisata, $lokasi_wisata, $tautan_maps, $jam_buka, $jam_tutup, $id_wisata);
}

if (!$stmt->execute()) {
    echo "Terjadi kesalahan saat memperbarui data wisata: " . $stmt->error;
    exit;
}

$stmt->close();

$harga_dewasa = $_POST['harga_dewasa'];
$harga_anak = $_POST['harga_anak'];

$query_update_dewasa = "UPDATE harga_tiket SET harga=? WHERE id_wisata=? AND jenis='Dewasa'";
$stmt_update_dewasa = $conn->prepare($query_update_dewasa);
$stmt_update_dewasa->bind_param("di", $harga_dewasa, $id_wisata);
if (!$stmt_update_dewasa->execute()) {
    echo "Terjadi kesalahan saat memperbarui harga tiket Dewasa: " . $stmt_update_dewasa->error;
    exit;
}
$stmt_update_dewasa->close();

$query_update_anak = "UPDATE harga_tiket SET harga=? WHERE id_wisata=? AND jenis='Anak-anak'";
$stmt_update_anak = $conn->prepare($query_update_anak);
$stmt_update_anak->bind_param("di", $harga_anak, $id_wisata);
if (!$stmt_update_anak->execute()) {
    echo "Terjadi kesalahan saat memperbarui harga tiket Anak-anak: " . $stmt_update_anak->error;
    exit;
}
$stmt_update_anak->close();

echo "Data wisata dan harga tiket berhasil diperbarui!";
header('Location: wisata.php');
exit;

$conn->close();

?>
