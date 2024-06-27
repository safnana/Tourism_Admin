<?php
include 'koneksi.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';

$query = "SELECT * FROM kuliner WHERE nama_kuliner LIKE ? OR deskripsi_kuliner LIKE ? OR lokasi_kuliner LIKE ?";
$stmt = $conn->prepare($query);
$search = "%" . $q . "%";
$stmt->bind_param("sss", $search, $search, $search);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    $output = "<table border='1' class='table-container'>
                <tr>
                    <th style='width:40px;'>ID</th>
                    <th style='width:100px;'>Gambar Kuliner</th>
                    <th style='width:180px;'>Nama Kuliner</th>
                    <th>Deskripsi Kuliner</th>
                    <th>Lokasi</th>
                    <th style='width:80px;'>Ubah / Hapus</th>
                </tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>" . htmlspecialchars($row['id_kuliner']) . "</td>
                            <td>";
            if (!empty($row['gambar_kuliner'])) {
                $base64_image = base64_encode($row['gambar_kuliner']);
                $output .= "<img src='data:image/jpeg;base64,$base64_image' width='80' height='80'>";
            } else {
                $output .= "Tidak ada gambar";
            }
            $output .= "</td>
                            <td>" . htmlspecialchars($row['nama_kuliner']) . "</td>
                            <td>" . htmlspecialchars($row['deskripsi_kuliner']) . "</td>
                            <td>" . htmlspecialchars($row['lokasi_kuliner']) . "</td>
                            <td>
                                <form action='editkuliner.php' method='POST'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id_kuliner']) . "'>
                                    <input type='hidden' name='gambar' value='" . base64_encode($row['gambar_kuliner']) . "'>
                                    <input type='hidden' name='nama' value='" . htmlspecialchars($row['nama_kuliner']) . "'>
                                    <input type='hidden' name='deskripsi' value='" . htmlspecialchars($row['deskripsi_kuliner']) . "'>
                                    <input type='hidden' name='lokasi' value='" . htmlspecialchars($row['lokasi_kuliner']) . "'>
                                    <button type='submit' class='btn-ubah'>Ubah</button>
                                </form>
                                <form action='hapuskuliner.php' method='get'>
                                    <input type='hidden' name='id_kuliner' value='" . htmlspecialchars($row['id_kuliner']) . "'>
                                    <button type='submit' class='btn-hapus'>Hapus</button>
                                </form>
                            </td>
                        </tr>";
        }
    } else {
        $output .= "<tr><td colspan='6'>Tidak ada hasil ditemukan.</td></tr>";
    }

    $output .= "</table>";
    echo $output;
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
