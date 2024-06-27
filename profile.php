<?php
include 'ceksession.php';
$nama_admin = $_SESSION['nama_admin'];
$username_admin = $_SESSION['usn_admin'];
$email_admin = $_SESSION['email_admin'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                    <a href="pemesanan.php" class="nav-item">
                        <img src="assets/icon/order-white.png" alt="Order" class="nav-icon">
                        <span class="nav-text">Pesanan</span>
                    </a>
                    <a href="profile.php" class="nav-item active">
                        <img src="assets/icon/user-green.png" alt="Profile" class="nav-icon">
                        <span class="nav-text">Profile</span>
                    </a>
                </div>
                <div class="logout-btn">
                    <button id="logoutButton" class="btn btn-danger">Logout</button>
                </div>
            </div>
            <div class="col-10 content mt-4" id="dashboardContainer">
                <div class="row">
                    <h2>Profil Saya</h2>
                    <form id="profileForm" method="post" action="editprofile.php">
                        <fieldset disabled id="profileFieldset">
                            <div class="mb-3">
                                <label for="namaAdmin" class="form-label">Nama</label>
                                <input type="text" id="namaAdmin" name="nama" class="form-control" value="<?php echo $nama_admin; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="usernameAdmin" class="form-label">Username</label>
                                <input type="text" id="usernameAdmin" name="username" class="form-control" value="<?php echo $username_admin; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="emailAdmin" class="form-label">Email</label>
                                <input type="email" id="emailAdmin" name="email" class="form-control" value="<?php echo $email_admin; ?>" required>
                            </div>
                        </fieldset>
                        <button type="button" id="editButton" class="btn btn-primary" style="margin:12px;">Ubah</button>
                        <button type="submit" id="saveButton" class="btn btn-success" style="margin:12px; display:none;">Simpan</button>
                    </form>

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
        $(document).ready(function() {
            $("#editButton").click(function() {
                $("#profileFieldset").prop("disabled", false);
                $("#editButton").hide();
                $("#saveButton").show();
            });
            $("#profileForm").submit(function(e) {
                e.preventDefault();
                var data = {
                    nama: $("#namaAdmin").val(),
                    username: $("#usernameAdmin").val(),
                    email: $("#emailAdmin").val(),
                };
                $.ajax({
                    url: 'editprofile.php',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        alert(response);
                        $("#profileFieldset").prop("disabled", true);
                        $("#editButton").show();
                        $("#saveButton").hide();
                        location.reload();
                    }
                });
            });
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