<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';
$pdam = query("SELECT * FROM pdam ORDER BY created_at ASC");

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css"> <!-- File CSS Eksternal -->

    <title>PHP Native | CRUD PDAM</title>

    <style>
        body {
            font-family: <?= $fontFamily; ?>, sans-serif;
            font-size: <?= $fontSize; ?>;
        }

        .header {
            background-color: <?= $colorScheme; ?>;
        }

        .btn-primary {
            background-color: <?= $colorScheme; ?>;
            border-color: <?= $colorScheme; ?>;
        }

        .welcome-section {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>

<body>

<div class="main-wrapper">
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Konten Utama -->
    <div class="main-content">
        <!-- Header dalam Konten Utama -->
        <div class="header">
            PHP Native | CRUD PDAM
        </div>

        <!-- Selamat Datang Section -->
        <div class="welcome-section text-white">
            <!-- Carousel -->
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/bg/pdam.jpg" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Pertama</h5>
                            <p>Keterangan untuk slide pertama.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/bg/pdam.jpg" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Kedua</h5>
                            <p>Keterangan untuk slide kedua.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/bg/pdam.jpg" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Ketiga</h5>
                            <p>Keterangan untuk slide ketiga.</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Selanjutnya</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#data').DataTable(); // Inisialisasi DataTables
    });

    document.addEventListener('DOMContentLoaded', function () {
        const texts = ['Selamat Datang', 'PDAM Makassar'];
        let index = 0;

        const animatedText = document.getElementById('animated-text');
        function changeText() {
            animatedText.textContent = texts[index];
            index = (index + 1) % texts.length;
        }

        // Jalankan perubahan teks setiap 3 detik
        changeText();
        setInterval(changeText, 3000);
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

</body>
</html>
