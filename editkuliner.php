<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kuliner</title>
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
                        <h2 style="margin-left:12px;">Edit Kuliner</h2>
                    </div>
                    <?php
                    include 'koneksi.php';

                    $id_kuliner = $_POST['id_kuliner'];
                    $gambar_kuliner = base64_decode($_POST['gambar_kuliner']);
                    $nama_kuliner = $_POST['nama_kuliner'];
                    $deskripsi_kuliner = $_POST['deskripsi_kuliner'];
                    $lokasi_kuliner = $_POST['lokasi_kuliner'];
                    $maps_kuliner = $_POST['maps_kuliner'];
                    ?>

                    <form action="simpankuliner.php" method="post" enctype="multipart/form-data" style="width:800px;">
                        <input type="hidden" name="id_kuliner" value="<?php echo $id_kuliner; ?>">
                        <div class="mb-3">
                            <label for="nama_kuliner" class="form-label">Nama Kuliner</label>
                            <input type="text" class="form-control" id="nama" name="nama_kuliner" value="<?php echo $nama_kuliner; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_kuliner" class="form-label">Deskripsi Kuliner</label>
                            <textarea class="form-control" id="deskripsi_kuliner" name="deskripsi_kuliner" style="height:max-content"><?php echo $deskripsi_kuliner; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_kuliner" class="form-label">Lokasi Kuliner</label>
                            <input type="text" class="form-control" id="lokasi_kuliner" name="lokasi_kuliner" value="<?php echo $lokasi_kuliner; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="maps_kuliner" class="form-label">Tautan Maps</label>
                            <input type="text" class="form-control" id="maps_kuliner" name="maps_kuliner" value="<?php echo $maps_kuliner; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gambar_kuliner" class="form-label">Gambar Kuliner</label><br>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($gambar_kuliner); ?>" width="100" height="100"><br>
                            <input type="file" name="gambar" id="gambar_kuliner" style="margin-top:12px">
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
                    window.history.back();});
    </script>
</body>

</html>