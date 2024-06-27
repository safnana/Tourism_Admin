<?php
include 'ceksession.php';
include 'koneksi.php';

$sql = "SELECT * FROM pemesanan";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pesanan</title>
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
                    <a href="kuliner.php" class="nav-item">
                        <img src="assets/icon/kuliner-white.png" alt="Culinary" class="nav-icon">
                        <span class="nav-text">Kuliner</span>
                    </a>
                    <a href="pemesanan.php" class="nav-item active">
                        <img src="assets/icon/order-green.png" alt="Order" class="nav-icon">
                        <span class="nav-text">Pemesanan</span>
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
                                        <th scope="col">ID Pesanan</th>
                                        <th scope="col">ID User</th>
                                        <th scope="col">Total harga</th>
                                        <th scope="col">Bukti</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        // Memuat data pemesanan ke dalam tabel
                                        while ($Row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $Row['id_pemesanan']; ?></td>
                                                <td><?php echo $Row['tanggal']; ?></td>
                                                <td><?php echo $Row['id_user']; ?></td>
                                                <td><?php echo $Row['total_harga']; ?></td>
                                                <td>
                                                <?php
                                                    if (!empty($Row['bukti_pemesanan'])) {
                                                        $base64_image = $Row['bukti_pemesanan'];
                                                        echo "<img src='data:image/jpeg;base64,$base64_image' class='img-fluid rounded' alt='Bukti Pemesanan' width='80'>";
                                                    } else {
                                                        echo "Gambar tidak tersedia";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <form method="post" action="editorder.php">
                                                        <input type="hidden" name="id" value="<?php echo $Row['id_pemesanan']; ?>">
                                                        <select class="form-select" name="status">
                                                            <?php
                                                            $status_options = ['menunggu', 'berhasil', 'gagal'];
                                                            foreach ($status_options as $status_option) {
                                                                $selected = ($status_option == $Row['status']) ? 'selected' : '';
                                                                echo "<option value='$status_option' $selected>$status_option</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="submit" class="btn-ubah" style="margin-top:12px;">Ubah</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Tidak ada data yang dibutuhkan.</td></tr>";
                                    }
                                    mysqli_close($conn);
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
    <script src="script.js"></script>
    <script>
        document.getElementById("addButton").addEventListener("click", function() {
            $("#TambahKulinerModal").modal("show");
        });

        const closeBtn = document.querySelector('#TambahKulinerModal .btn-close');
        closeBtn.addEventListener('click', () => {
            $('#TambahKulinerModal').modal('hide');
        });
        $(document).ready(function() {
            $("#logoutButton").click(function(e) {
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