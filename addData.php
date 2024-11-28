<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

if (isset($_POST['simpan'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'masterData.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data | CRUD PDAM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/sidebar.css">
</head>

<body>
<div class="main-wrapper">
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="container mt-4">
            <h3 class="fw-bold text-uppercase"><i class="bi bi-person-plus-fill"></i> Tambah Data</h3>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="uraian" class="form-label">Uraian</label>
                    <input type="text" class="form-control w-50" id="uraian" name="uraian" placeholder="Masukkan Uraian" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control w-50" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="bulan" class="form-label">Pilih Bulan</label>
                    <select class="form-select w-50" id="bulan" name="bulan" required>
                        <option disabled selected value>Pilih Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>
                <hr>
                <a href="masterData.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');

        // Simpan status sidebar ke LocalStorage
        if (sidebar.classList.contains('collapsed')) {
            localStorage.setItem('sidebarStatus', 'collapsed');
        } else {
            localStorage.setItem('sidebarStatus', 'expanded');
        }
    }

    // Saat halaman dimuat, cek status sidebar di LocalStorage
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
