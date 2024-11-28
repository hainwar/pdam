<?php
// Koneksi Database
require 'function.php';
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data jumlah berdasarkan bulan untuk Diagram Pie
$bulanData = [
    'Januari' => 0, 'Februari' => 0, 'Maret' => 0, 'April' => 0, 'Mei' => 0,
    'Juni' => 0, 'Juli' => 0, 'Agustus' => 0, 'September' => 0, 'Oktober' => 0,
    'November' => 0, 'Desember' => 0
];

$query = "SELECT SUM(Jumlah) AS total, Bulan FROM pdam GROUP BY Bulan";
$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $bulanData[$row['Bulan']] = $row['total'];
}

// Mengambil data terbanyak untuk Diagram Bar
$queryMax = "SELECT Uraian, SUM(Jumlah) AS total FROM pdam GROUP BY Uraian ORDER BY total DESC LIMIT 5";
$resultMax = mysqli_query($koneksi, $queryMax);

$uraian = [];
$total = [];

while ($row = mysqli_fetch_assoc($resultMax)) {
    $uraian[] = $row['Uraian'];
    $total[] = $row['total'];
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | CRUD PDAM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/sidebar.css">
    <style>
        /* Mengatur ukuran canvas diagram */
        #pieChart, #barChart {
            max-width: 100%;
            height: 300px;
            padding-bottom: 40px;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        /* Flexbox container untuk memastikan footer berada di bawah */
        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        body {
            font-family: <?= $fontFamily; ?>, sans-serif;
            font-size: <?= $fontSize; ?>;
        }

        .btn-primary {
            background-color: <?= $colorScheme; ?>;
            border-color: <?= $colorScheme; ?>;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Konten Utama -->
        <div class="main-content">
            <div class="container mt-4 text-center">
                <!-- Judul Dashboard -->
                <h3 class="fw-bold text-uppercase">Dashboard</h3>
                <hr>

                <!-- Diagram Pie dan Diagram Bar dalam satu baris -->
                <div class="chart-container">
                    <div style="flex: 1;">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div style="flex: 1;">E
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>

    <!-- Script JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Diagram Pie (Distribusi Jumlah per Bulan)
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah per Bulan',
                    data: <?php echo json_encode(array_values($bulanData)); ?>,
                    backgroundColor: ['#FF5733', '#FFBD33', '#FFDA33', '#75FF33', '#33FF57', '#33FFBD', '#33DAFF', '#3357FF', '#5733FF', '#BD33FF', '#FF33DA', '#FF3357'],
                    borderColor: ['#FF5733', '#FFBD33', '#FFDA33', '#75FF33', '#33FF57', '#33FFBD', '#33DAFF', '#3357FF', '#5733FF', '#BD33FF', '#FF33DA', '#FF3357'],
                    borderWidth: 1
                }]
            }
        });

        // Diagram Bar (Jumlah Terbanyak)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($uraian); ?>,
                datasets: [{
                    label: 'Jumlah Terbanyak',
                    data: <?php echo json_encode($total); ?>,
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
