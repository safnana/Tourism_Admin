<?php
include 'koneksi.php';
if (isset($_GET['id_kuliner'])) {
    $id_kuliner = $_GET['id_kuliner'];

    $q = "DELETE FROM kuliner WHERE id_kuliner = ?";
    $stmt = $conn->prepare($q);
    $stmt->bind_param("i", $id_kuliner);  

    if ($stmt->execute()) {
        echo "Data berhasil dihapus!";
        header('Location: kuliner.php');  
        exit;
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID kuliner tidak ditemukan.";
}

$conn->close();
?>

?>