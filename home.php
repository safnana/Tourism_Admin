<?php
include 'ceksession.php';
include 'koneksi.php';

$query_years = "SELECT DISTINCT YEAR(tanggal) AS year FROM pemesanan";
$result_years = $conn->query($query_years);
$years = [];
while ($row = $result_years->fetch_assoc()) {
    $years[] = $row['year'];
}
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$query_pemesanan = "SELECT MONTH(tanggal) AS month, COUNT(*) AS total 
                    FROM pemesanan 
                    WHERE YEAR(tanggal) = $tahun AND status = 'berhasil' 
                    GROUP BY MONTH(tanggal)";
$result_pemesanan = $conn->query($query_pemesanan);
$data_pemesanan = array_fill(1, 12, 0); //seharusnya array_fill bukan array
while ($row = $result_pemesanan->fetch_assoc()) {
    $data_pemesanan[intval($row['month'])] = intval($row['total']);
}

$query_pendapatan = "SELECT MONTH(tanggal) AS month, SUM(total_harga) AS total 
                     FROM pemesanan 
                     WHERE YEAR(tanggal) = $tahun AND status = 'berhasil' 
                     GROUP BY MONTH(tanggal)";
$result_pendapatan = $conn->query($query_pendapatan);
$data_pendapatan = array_fill(1, 12, 0); //seharusnya array_fill bukan array
while ($row = $result_pendapatan->fetch_assoc()) {
    $data_pendapatan[intval($row['month'])] = intval($row['total']);
} //error pada penulisan int seharusnya intval

$labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

$query_users = "SELECT COUNT(*) AS total FROM user";
$result_users = $conn->query($query_users);
$total_users = $result_users->fetch_assoc()['total'];

$query_wisata = "SELECT COUNT(*) AS total FROM wisata";
$result_wisata = $conn->query($query_wisata);
$total_wisata = $result_wisata->fetch_assoc()['total'];

$query_kuliner = "SELECT COUNT(*) AS total FROM kuliner";
$result_kuliner = $conn->query($query_kuliner);
$total_kuliner = $result_kuliner->fetch_assoc()['total'];

$query_berhasil = "SELECT COUNT(*) AS total FROM pemesanan WHERE status = 'berhasil'";
$result_berhasil = $conn->query($query_berhasil);
$total_berhasil = $result_berhasil->fetch_assoc()['total'];

$query_pending = "SELECT COUNT(*) AS total FROM pemesanan WHERE status = 'menunggu'";
$result_pending = $conn->query($query_pending);
$total_pending = $result_pending->fetch_assoc()['total'];
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 sidebar bg-light shadow">
                <div class="logo text-center">
                    <img src="assets/icon/logo-JJ.png" alt="Logo" class="logo-img w-50">
                </div>
                <div class="nav-items">
                    <a href="home.php" class="nav-item active">
                        <img src="assets/icon/home-green.png" alt="Home" class="nav-icon">
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
                    <a href="profile.php" class="nav-item">
                        <img src="assets/icon/user-white.png" alt="Profile" class="nav-icon">
                        <span class="nav-text">Profile</span>
                    </a>
                </div>
                <div class="logout-btn">
                    <button id="logoutButton" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10 content" id="dashboardContainer">
        <div class="row" style="display:flex">
            <div class="col-xl-4 col-md-6 mb-2 mt-4 p-2">
                <div class="card border-left-primary shadow h-100 py-2 bg-danger">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center ml-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Pengguna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-2 mt-4 p-2">
                <div class="card border-left-primary shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center ml-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Wisata</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_wisata; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-2 mt-4 p-2">
                <div class="card border-left-primary shadow h-100 py-2 bg-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center ml-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Kuliner</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_kuliner; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="display:flex">
            <div class="col-xl-6 col-md-6 mb-4 mt-4 p-2">
                <div class="card border-left-primary shadow h-100 py-2 bg-secondary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center ml-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Pemesanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_berhasil; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4 mt-4 p-2">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center ml-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_pending; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="display: flex;">
            <div class="col-xl-12 col-lg-6 p-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">Overview Pemesanan</h6>
                        <div>
                            <select id="tahunPemesanan" name="tahunPemesanan" class="form-control mt-2">
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?php echo $year; ?>" <?php if ($year == $tahun) echo 'selected'; ?>><?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChartPemesanan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="display: flex;">
            <div class="col-xl-12 col-lg-6 p-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-black">Overview Pendapatan</h6>
                        <div>
                            <select id="tahunPendapatan" name="tahunPendapatan" class="form-control mt-2">
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?php echo $year; ?>" <?php if ($year == $tahun) echo 'selected'; ?>><?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChartPendapatan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctxPemesanan = document.getElementById('myAreaChartPemesanan').getContext('2d');
        var myAreaChartPemesanan = new Chart(ctxPemesanan, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: <?php echo json_encode(array_values($data_pemesanan)); ?>,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 10,
                            maxTicksLimit: 5,
                            padding: 10, //ini error kurang koma setelah 10
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2], //ini error kurang koma
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleFontColor: '#6e707e',
                    titleMarginBottom: 10,
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                }
            }
        });

        var ctxPendapatan = document.getElementById('myAreaChartPendapatan').getContext('2d');
        var myAreaChartPendapatan = new Chart(ctxPendapatan, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Pendapatan',
                    data: <?php echo json_encode(array_values($data_pendapatan)); ?>,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 100000,
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return 'Rp' + value.toLocaleString();
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleFontColor: '#6e707e',
                    titleMarginBottom: 10,
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10
                }
            }
        });

        $('#tahunPemesanan').change(function() {
            var tahun = $(this).val();
            $.ajax({
                url: 'home.php',
                type: 'GET',
                data: {
                    tahun: tahun
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    myAreaChartPemesanan.data.labels = result.labels;
                    myAreaChartPemesanan.data.datasets[0].data = result.data_pemesanan;
                    myAreaChartPemesanan.update();
                }
            });
        });

        $('#tahunPendapatan').change(function() {
            var tahun = $(this).val();
            $.ajax({
                url: 'home.php',
                type: 'GET',
                data: {
                    tahun: tahun
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    myAreaChartPendapatan.data.labels = result.labels;
                    myAreaChartPendapatan.data.datasets[0].data = result.data_pendapatan;
                    myAreaChartPendapatan.update()
                }
            });
        });

        $(document).ready(function() {
            $("#logoutButton").click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'logout.php',
                    type: 'POST',
                    success: function(response) {
                        window.location.href = 'login.php'
                    }
                });
            });
        });
    </script>
</body>

</html>