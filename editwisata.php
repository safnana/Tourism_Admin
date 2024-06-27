<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wisata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 content">
                <div class="row" style="margin: 60px;">
                    <div style="display: flex; height:36px; margin-bottom:16px;">
                        <button type="button" class="btn btn-warning btnback" width="16px;">Kembali</button>
                        <h2 style="margin-left:12px;">Edit Wisata</h2>
                    </div>
                    <?php
                    include 'koneksi.php';

                    $id_wisata = $_POST['id_wisata'];
                    $gambar_wisata = base64_decode($_POST['gambar_wisata']);
                    $nama_wisata = $_POST['nama_wisata'];
                    $deskripsi_wisata = $_POST['deskripsi_wisata'];
                    $lokasi_wisata = $_POST['lokasi_wisata'];
                    $tautan_maps = $_POST['tautan_maps'];
                    $jam_buka = $_POST['jam_buka'];
                    $jam_tutup = $_POST['jam_tutup'];
                    $harga_dewasa = $_POST['harga_dewasa'];
                    $harga_anak = $_POST['harga_anak'];
                    ?>
                    <form action="simpanwisata.php" method="post" enctype="multipart/form-data" style="width:800px;">
                        <input type="hidden" name="id_wisata" value="<?php echo $id_wisata; ?>">
                        <div class="mb-3">
                            <label for="nama_wisata" class="form-label">Nama Wisata</label>
                            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="<?php echo $nama_wisata; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_wisata" class="form-label">Deskripsi Wisata</label>
                            <input type="textarea" class="form-control" id="deskripsi_wisata" name="deskripsi_wisata" value="<?php echo $deskripsi_wisata; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_wisata" class="form-label">Lokasi Wisata</label>
                            <input type="text" class="form-control" id="lokasi_wisata" name="lokasi_wisata" value="<?php echo $lokasi_wisata; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tautan_maps" class="form-label">Tautan Google Maps</label>
                            <input type="text" class="form-control" id="tautan_maps" name="tautan_maps" value="<?php echo $tautan_maps; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jam_buka" class="form-label">Jam Buka</label>
                            <input type="text" class="form-control" id="jam_buka" name="jam_buka" value="<?php echo $jam_buka; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jam_tutup" class="form-label">Jam Tutup</label>
                            <input type="text" class="form-control" id="jam_tutup" name="jam_tutup" value="<?php echo $jam_tutup; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_dewasa" class="form-label">Harga Tiket Dewasa</label>
                            <input type="text" class="form-control" id="harga_dewasa" name="harga_dewasa" value="<?php echo $harga_dewasa; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_anak" class="form-label">Harga Tiket Anak</label>
                            <input type="text" class="form-control" id="harga_anak" name="harga_anak" value="<?php echo $harga_anak; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gambar_wisata" class="form-label">Gambar Wisata</label><br>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($gambar_wisata); ?>" width="100" height="100"><br>
                            <input type="file" name="gambar_wisata" id="gambar_wisata" style="margin-top:12px">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(".btnback").on("click", function(e) {
            e.preventDefault();
            window.history.back();
        });
    </script>
</body>

</html>
