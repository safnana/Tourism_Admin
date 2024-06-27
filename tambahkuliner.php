<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$tautan_maps = $_POST['maps'];

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $namaGambar = $_FILES['gambar']['name'];
    $dirUpload = 'D:/xampp/htdocs/JJ-Admin/assets/Kuliner/'; 
    $pathGambar = $dirUpload . $namaGambar;

    if (move_uploaded_file($gambarTmp, $pathGambar)) {
        $gambar = file_get_contents($pathGambar);
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
        exit;
    }
} else {
    echo "Tidak ada file gambar yang diunggah.";
    exit;
}

$q = "INSERT INTO kuliner (nama_kuliner, deskripsi_kuliner, lokasi_kuliner, maps_kuliner, gambar_kuliner) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($q);
$stmt->bind_param("sssss", $nama, $deskripsi, $lokasi, $tautan_maps, $gambar);

if ($stmt->execute()) {
    echo "Penambahan berhasil!";
    header('location:kuliner.php');
    exit;
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>