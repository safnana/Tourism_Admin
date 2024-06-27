<?php
include 'koneksi.php';

$nama_wisata = $_POST['nama'];
$deskripsi_wisata = $_POST['deskripsi'];
$lokasi_wisata = $_POST['lokasi'];
$tautan_maps = $_POST['maps'];
$jam_buka = $_POST['jamBuka'];
$jam_tutup = $_POST['jamTutup'];
$tiket_dewasa = $_POST['tiketDewasa'];
$tiket_anak = $_POST['tiketAnak'];
$gambar_wisata = null;

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $namaGambar = $_FILES['gambar']['name'];
    $dirUpload = 'D:/xampp/htdocs/JJ-Admin/assets/Wisata/';
    $pathGambar = $dirUpload . basename($namaGambar);

    if (move_uploaded_file($gambarTmp, $pathGambar)) {
        $gambar_wisata = file_get_contents($pathGambar);
    } else {
        echo "Terjadi kesalahan saat mengunggah file gambar.";
        exit;
    }
}

$query_insert_wisata = "INSERT INTO wisata (nama_wisata, deskripsi_wisata, lokasi_wisata, tautan_maps, jam_buka, jam_tutup, gambar_wisata) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert_wisata = $conn->prepare($query_insert_wisata);
$stmt_insert_wisata->bind_param("sssssss", $nama_wisata, $deskripsi_wisata, $lokasi_wisata, $tautan_maps, $jam_buka, $jam_tutup, $gambar_wisata);
$stmt_insert_wisata->execute();
$id_wisata = $stmt_insert_wisata->insert_id; 

$query_insert_harga_dewasa = "INSERT INTO harga_tiket (id_wisata, jenis, harga) VALUES (?, 'Dewasa', ?)";
$query_insert_harga_anak = "INSERT INTO harga_tiket (id_wisata, jenis, harga) VALUES (?, 'Anak-anak', ?)";
$stmt_insert_harga_dewasa = $conn->prepare($query_insert_harga_dewasa);
$stmt_insert_harga_dewasa->bind_param("id", $id_wisata, $tiket_dewasa);
$stmt_insert_harga_dewasa->execute();
$stmt_insert_harga_anak = $conn->prepare($query_insert_harga_anak);
$stmt_insert_harga_anak->bind_param("id", $id_wisata, $tiket_anak);
$stmt_insert_harga_anak->execute();

header('Location: wisata.php');
exit;

$stmt_insert_wisata->close();
$stmt_insert_harga_dewasa->close();
$stmt_insert_harga_anak->close();
$conn->close();
?>
