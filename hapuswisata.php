<?php
include 'koneksi.php';

if (isset($_GET['id_wisata'])) {
    $id_wisata = $_GET['id_wisata'];

    $query_delete_wisata = "DELETE FROM wisata WHERE id_wisata = ?";
    $query_delete_harga_tiket = "DELETE FROM harga_tiket WHERE id_wisata = ?";

    $stmt_delete_wisata = $conn->prepare($query_delete_wisata);
    $stmt_delete_wisata->bind_param("i", $id_wisata);
    $stmt_delete_wisata->execute();
    
    $stmt_delete_harga_tiket = $conn->prepare($query_delete_harga_tiket);
    $stmt_delete_harga_tiket->bind_param("i", $id_wisata);
    $stmt_delete_harga_tiket->execute();

    header('Location: wisata.php');
    exit;
} else {
    echo "ID wisata tidak ditemukan.";
}

$stmt_delete_wisata->close();
$stmt_delete_harga_tiket->close();
$conn->close();
?>
