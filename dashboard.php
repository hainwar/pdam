<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';

// Default values
$colorScheme = isset($_SESSION['colorScheme']) ? $_SESSION['colorScheme'] : '#007bff';
$sidebarColor = isset($_SESSION['sidebarColor']) ? $_SESSION['sidebarColor'] : 'dark';
$fontFamily = isset($_SESSION['fontFamily']) ? $_SESSION['fontFamily'] : 'Open Sans';
$fontSize = isset($_SESSION['fontSize']) ? $_SESSION['fontSize'] : '14px';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/sidebar.css"> <!-- File CSS Eksternal -->

    <title>Dashboard</title>

    <style>
        body {
            font-family: <?= $fontFamily; ?>, sans-serif;
            font-size: <?= $fontSize; ?>;
        }

        .sidebar {
            background-color: <?= $sidebarColor == 'dark' ? '#333' : '#f8f9fa'; ?>;
            color: <?= $sidebarColor == 'dark' ? '#ffffff' : '#212529'; ?>;
        }

        .header {
            background-color: <?= $colorScheme; ?>;
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
        <div class="header">
            Dashboard
        </div>

        <div class="content">
            <div class="container">
                <!-- Ringkasan -->
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-primary">100</h5>
                                <p>Total Leads</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-danger">80</h5>
                                <p>Total Called Leads</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Costs</h5>
                                <div class="chart-container">
                                    <canvas id="costPieChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Leads</h5>
                                <div class="chart-container">
                                    <canvas id="leadsBarChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- JavaScript untuk Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart for Costs
    new Chart(document.getElementById('costPieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Cost in time frame', 'Cost per application', 'Cost per sale'],
            datasets: [{
                data: [41017.77, 57907.44, 21715.29],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Menonaktifkan rasio aspek agar sesuai kontainer
        }
    });

    // Bar Chart for Leads
    new Chart(document.getElementById('leadsBarChart'), {
        type: 'bar',
        data: {
            labels: ['Abstergo', 'Acme Co.', 'Barone'],
            datasets: [{
                label: 'Total Leads',
                data: [600, 400, 300],
                backgroundColor: '#4e73df',
            }, {
                label: 'Bad Leads',
                data: [200, 150, 100],
                backgroundColor: '#e74a3b',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Menonaktifkan rasio aspek agar sesuai kontainer
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fungsi untuk toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');

        // Simpan status sidebar ke localStorage
        if (sidebar.classList.contains('collapsed')) {
            localStorage.setItem('sidebarStatus', 'collapsed');
        } else {
            localStorage.setItem('sidebarStatus', 'expanded');
        }
    }

    // Saat halaman dimuat, cek status sidebar di localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarStatus = localStorage.getItem('sidebarStatus');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');

        sidebar.classList.add('no-transition');
        mainContent.classList.add('no-transition');

        if (sidebarStatus === 'collapsed') {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('collapsed');
        }

        setTimeout(() => {
            sidebar.classList.remove('no-transition');
            mainContent.classList.remove('no-transition');
        }, 100);
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
