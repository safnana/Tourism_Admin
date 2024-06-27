<?php
include 'koneksi.php';

$id = $_POST['id_kuliner'];
$nama = $_POST['nama_kuliner'];
$deskripsi = $_POST['deskripsi_kuliner'];
$lokasi = $_POST['lokasi_kuliner'];
$maps = $_POST['maps_kuliner'];
$gambar = null;

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $namaGambar = $_FILES['gambar']['name'];
    $dirUpload = 'D:/xampp/htdocs/JJ-Admin/assets/Kuliner/';
    $pathGambar = $dirUpload . basename($namaGambar);

    if (move_uploaded_file($gambarTmp, $pathGambar)) {
        $gambar = file_get_contents($pathGambar);
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
        exit;
    }
}

if ($gambar !== null) {
    $query = "UPDATE kuliner SET nama_kuliner=?, deskripsi_kuliner=?, lokasi_kuliner=?, maps_kuliner=?, gambar_kuliner=? WHERE id_kuliner=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $nama, $deskripsi, $lokasi, $maps, $gambar, $id);
} else {
    $query = "UPDATE kuliner SET nama_kuliner=?, deskripsi_kuliner=?, lokasi_kuliner=?, maps_kuliner=? WHERE id_kuliner=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nama, $deskripsi, $lokasi, $maps, $id);
}

if ($stmt->execute()) {
    echo "Pembaharuan berhasil!";
    header('Location: kuliner.php');
    exit;
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
