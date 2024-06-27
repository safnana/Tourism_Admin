<?php
include 'ceksession.php';
include 'koneksi.php';

$sql = "SELECT * FROM kuliner";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Kuliner</title>
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
                    <a href="wisata.php" class="nav-item">
                        <img src="assets/icon/wisata-white.png" alt="Travel" class="nav-icon">
                        <span class="nav-text">Wisata</span>
                    </a>
                    <a href="kuliner.php" class="nav-item active">
                        <img src="assets/icon/kuliner-green.png" alt="Culinary" class="nav-icon">
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
                                <h4> List Kuliner </h4>
                            </div>
                            <button class="btn btn-primary" id="addButton" data-toggle="modal" data-target="#TambahKulinerModal">Tambah</button>
                        </div>
                        <div class="modal fade" id="TambahKulinerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kuliner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="tambahkuliner.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group" style="padding:12px;">
                                          <label for="namaKuliner">Nama Kuliner</label>
                                          <input type="text" class="form-control" name="nama" id="namaKuliner" placeholder="Masukkan nama kuliner" required>
                                        </div>
                                        <div class="form-group" style="padding:12px;">
                                            <label for="deskripsiKuliner">Deskripsi Kuliner</label>
                                            <input type="text" class="form-control" name="deskripsi" id="deskripsiKuliner" placeholder="Masukkan deskripsi kuliner" required>
                                        </div>
                                        <div class="form-group" style="padding:12px;">
                                            <label for="lokasiKuliner">Lokasi Kuliner</label>
                                            <input type="text" class="form-control" name="lokasi" id="lokasiKuliner" placeholder="Masukkan lokasi kuliner" required>
                                        </div>
                                        <div class="form-group" style="padding:12px;">
                                            <label for="maps">Tautan Maps</label>
                                            <input type="text" class="form-control" name="maps" id="maps" placeholder="Masukkan tautan maps" required>
                                        </div>
                                        <div class="form-group" style="padding:12px;">
                                            <label for="gambarKuliner">Gambar Kuliner</label>
                                            <input type="file" class="form-control" name="gambar" id="gambarKuliner" accept=".jpg, .jpeg, .png" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin:12px;">Submit</button>
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
                                        <th scope="col">Gambar Kuliner</th>
                                        <th scope="col">Nama Kuliner</th>
                                        <th scope="col">Deskripsi Kuliner</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Maps</th>
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
    echo '<td>' . $row['id_kuliner'] . '</td>';
    
    // Tampilkan gambar
    echo '<td>';
    if (!empty($row['gambar_kuliner'])) {
        $base64_image = base64_encode($row['gambar_kuliner']);
        echo "<img src='data:image/jpeg;base64,$base64_image' width='80' height='80'>";
    } else {
        echo "Tidak ada gambar";
    }
    echo '</td>';
    
    echo '<td>' . $row['nama_kuliner'] . '</td>';
    echo '<td>' . $row['deskripsi_kuliner'] . '</td>';
    echo '<td>' . $row['lokasi_kuliner'] . '</td>';
    echo '<td><a href="' . $row['maps_kuliner'] . '" target="_blank">Link</a></td>';
    
    echo '<td>';
    echo '<form action="editkuliner.php" method="POST">';
    echo '<input type="hidden" name="id_kuliner" value="' . $row['id_kuliner'] . '">';
    echo '<input type="hidden" name="gambar_kuliner" value="' . base64_encode($row['gambar_kuliner']) . '">';
    echo '<input type="hidden" name="nama_kuliner" value="' . $row['nama_kuliner'] . '">';
    echo '<input type="hidden" name="deskripsi_kuliner" value="' . $row['deskripsi_kuliner'] . '">';
    echo '<input type="hidden" name="lokasi_kuliner" value="' . $row['lokasi_kuliner'] . '">';
    echo '<input type="hidden" name="maps_kuliner" value="' . $row['maps_kuliner'] . '">';
    echo '<button type="submit" class="btn btn-sm btn-warning">Ubah</button>';
    echo '</form>';
    echo '</td>';
    
    echo '<td>';
    echo '<form action="hapuskuliner.php" method="GET">';
    echo '<input type="hidden" name="id_kuliner" value="' . $row['id_kuliner'] . '">';
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
            $("#TambahKulinerModal").modal("show");
        });

        const closeBtn = document.querySelector('#TambahKulinerModal .btn-close');
        closeBtn.addEventListener('click', () => {
            $('#TambahKulinerModal').modal('hide');
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
