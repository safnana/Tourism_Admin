<?php
include 'ceksession.php';
include 'koneksi.php';

$sql = "SELECT w.id_wisata, w.nama_wisata, w.deskripsi_wisata, w.lokasi_wisata, w.tautan_maps, w.jam_buka, w.jam_tutup, w.gambar_wisata, 
               h_dewasa.harga as harga_dewasa, h_anak.harga as harga_anak 
        FROM wisata w
        LEFT JOIN harga_tiket h_dewasa ON w.id_wisata = h_dewasa.id_wisata AND h_dewasa.jenis = 'Dewasa'
        LEFT JOIN harga_tiket h_anak ON w.id_wisata = h_anak.id_wisata AND h_anak.jenis = 'Anak-anak'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Wisata</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 sidebar bg-light shadow">
                <div class="logo text-center">
                    <img src="assets/icon/logo-JJ.png" alt="Logo" class="logo-img w-50">
                </div>
                <div class="nav-items">
                    <a href="home.php" class="nav-item">
                        <img src="assets/icon/home-white.png" alt="Home" class="nav-icon">
                        <span class="nav-text">Beranda</span>
                    </a>
                    <a href="wisata.php" class="nav-item active">
                        <img src="assets/icon/wisata-green.png" alt="Travel" class="nav-icon">
                        <span class="nav-text">Wisata</span>
                    </a>
                    <a href="kuliner.php" class="nav-item">
                        <img src="assets/icon/kuliner-white.png" alt="Culinary" class="nav-icon">
                        <span class="nav-text">Kuliner</span>
                    </a>
                    <a href="pemesanan.php" class="nav-item">
                        <img src="assets/icon/order-white.png" alt="Order" class="nav-icon">
                        <span class="nav-text">Pesanan</span>
                    </a>
                    <a href="profile.php" class="nav-item">
                        <img src="assets/icon/user-white.png" alt="Profile" class="nav-icon">
                        <span class="nav-text">Profile</span>
                    </a>
                </div>
                <div class="logout-btn">
                    <button id="logoutButton" class="btn btn-danger">Logout</button>
                </div>
            </div>
            <div class="col-10 content mt-4" id="dashboardContainer">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="input-group w-75">
                                <h4> List Wisata </h4>
                            </div>
                            <button class="btn btn-primary" id="addButton" data-toggle="modal" data-target="#TambahWisataModal">Tambah</button>
                        </div>
                        <div class="modal fade" id="TambahWisataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Wisata</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="tambahwisata.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="namaWisata">Nama Wisata</label>
                                                <input type="text" class="form-control" name="nama" id="namaWisata" placeholder="Masukkan nama wisata" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsiWisata">Deskripsi Wisata</label>
                                                <input type="text" class="form-control" name="deskripsi" id="deskripsiWisata" placeholder="Masukkan deskripsi wisata" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasiWisata">Lokasi Wisata</label>
                                                <input type="text" class="form-control" name="lokasi" id="lokasiWisata" placeholder="Masukkan lokasi wisata" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="maps">Tautan Maps</label>
                                                <input type="text" class="form-control" name="maps" id="maps" placeholder="Masukkan tautan maps" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jamBuka">Jam Buka</label>
                                                <input type="time" class="form-control" name="jamBuka" id="jamBuka" placeholder="Masukkan jam buka" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jamTutup">Jam Tutup</label>
                                                <input type="time" class="form-control" name="jamTutup" id="jamTutup" placeholder="Masukkan jam tutup" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tiket">Harga Tiket</label>
                                                <input type="number" class="form-control" name="tiketDewasa" id="tiketDewasa" placeholder="Tiket untuk dewasa" required>
                                                <input type="number" class="form-control" name="tiketAnak" id="tiketAnak" placeholder="Tiket untuk anak-anak" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gambarWisata">Gambar Wisata</label>
                                                <input type="file" class="form-control" name="gambar" id="gambarWisata" accept=".jpg, .jpeg, .png" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Gambar Wisata</th>
                                        <th scope="col">Nama Wisata</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Maps</th>
                                        <th scope="col">Jam Buka</th>
                                        <th scope="col">Jam Tutup</th>
                                        <th scope="col">Tiket Dewasa</th>
                                        <th scope="col">Tiket Anak-anak</th>
                                        <th scope="col">Ubah</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<th scope="row">' . $i . '</th>';
    echo '<td>' . $row['id_wisata'] . '</td>';
    
    // Tampilkan gambar
    echo '<td>';
    if (!empty($row['gambar_wisata'])) {
        $base64_image = base64_encode($row['gambar_wisata']);
        echo "<img src='data:image/jpeg;base64,$base64_image' width='80' height='80'>";
    } else {
        echo "Tidak ada gambar";
    }
    echo '</td>';
    
    echo '<td>' . $row['nama_wisata'] . '</td>';
    echo '<td>' . $row['deskripsi_wisata'] . '</td>';
    echo '<td>' . $row['lokasi_wisata'] . '</td>';
    echo '<td><a href="' . $row['tautan_maps'] . '" target="_blank">Link</a></td>';
    echo '<td>' . $row['jam_buka'] . '</td>';
    echo '<td>' . $row['jam_tutup'] . '</td>';
    echo '<td>Rp ' . number_format($row['harga_dewasa'], 0, ',', '.') . '</td>';
    echo '<td>Rp ' . number_format($row['harga_anak'], 0, ',', '.') . '</td>';
    
    echo '<td>';
    echo '<form action="editwisata.php" method="POST">';
    echo '<input type="hidden" name="id_wisata" value="' . $row['id_wisata'] . '">';
    echo '<input type="hidden" name="gambar_wisata" value="' . base64_encode($row['gambar_wisata']) . '">';
    echo '<input type="hidden" name="nama_wisata" value="' . $row['nama_wisata'] . '">';
    echo '<input type="hidden" name="deskripsi_wisata" value="' . $row['deskripsi_wisata'] . '">';
    echo '<input type="hidden" name="lokasi_wisata" value="' . $row['lokasi_wisata'] . '">';
    echo '<input type="hidden" name="tautan_maps" value="' . $row['tautan_maps'] . '">';
    echo '<input type="hidden" name="jam_buka" value="' . $row['jam_buka'] . '">';
    echo '<input type="hidden" name="jam_tutup" value="' . $row['jam_tutup'] . '">';
    echo '<input type="hidden" name="harga_dewasa" value="' . $row['harga_dewasa'] . '">';
    echo '<input type="hidden" name="harga_anak" value="' . $row['harga_anak'] . '">';
    echo '<button type="submit" class="btn btn-sm btn-warning">Ubah</button>';
    echo '</form>';
    echo '</td>';
    
    echo '<td>';
    echo '<form action="hapuswisata.php" method="GET">';
    echo '<input type="hidden" name="id_wisata" value="' . $row['id_wisata'] . '">';
    echo '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda yakin ingin menghapus data ini?\')">Hapus</button>';
    echo '</form>';
    echo '</td>';
    
    echo '</tr>';
    $i++;
}
?>
 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-MNpN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src= "script.js"></script>
    <script>
         document.getElementById("addButton").addEventListener("click", function() {
            $("#TambahWisataModal").modal("show");
        });

        const closeBtn = document.querySelector('#TambahWisataModal .btn-close');
        closeBtn.addEventListener('click', () => {
            $('#TambahWisataModal').modal('hide');
        });
        $(document).ready(function(){
        $("#logoutButton").click(function(e){
            e.preventDefault();
            $.ajax({
                url: 'logout.php',
                type: 'POST',
                success: function(response) {
                    window.location.href = 'login.php';
                }
            });
        });
    });
    </script>
</body>

</html>
