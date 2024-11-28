<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php'; // Koneksi ke database dan fungsi query
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
    <link rel="stylesheet" href="css/sidebar.css"> <!-- Sidebar CSS -->

    <title>Master Data | PHP Native</title>

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
        <!-- Header -->
        <div class="header">
            Master Data
        </div>

        <!-- Konten -->
        <div class="content">
            <div class="container mt-4">
                <h3 class="text-center fw-bold text-uppercase">Master Data PDAM</h3>
                <hr>
                <div class="my-2">
                    <a href="addData.php" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Data</a>
                    <a href="export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Ekspor ke Excel</a>
                </div>

                <!-- Tabel Data -->
                <div class="my-3">
                    <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Uraian</th>
                                <th>Bulan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pdam as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['uraian']); ?></td>
                                    <td><?= htmlspecialchars($row['bulan']); ?></td>
                                    <td><?= htmlspecialchars($row['jumlah']); ?></td>
                                    <td>
                                        <a href="ubah.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= $row['uraian']; ?>?');"><i class="bi bi-trash-fill"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
        if (sidebarStatus === 'collapsed') {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }
    });
</script>

</body>
</html>
