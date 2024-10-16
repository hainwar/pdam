<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require 'function.php';

$id = $_GET["id"];

// Ambil data berdasarkan id untuk ditampilkan di form
$data = query("SELECT * FROM pdam WHERE id = '$id'"); // Pastikan Anda memiliki fungsi query yang sesuai

// Cek apakah data ada
if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            document.location.href = 'index.php';
          </script>";
    exit;
} else {
    // Ambil data pertama (karena query mengembalikan array)
    $data = $data[0];
}

// Proses update data
if (isset($_POST["simpan"])) {
    // Ambil data dari form
    $uraian = $_POST["Uraian"];
    $jumlah = $_POST["Jumlah"];
    $bulan = $_POST["bulan"];

    // Query untuk mengupdate data
    $query = "UPDATE pdam SET Uraian='$uraian', Jumlah='$jumlah', Bulan='$bulan' WHERE id='$id'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Cek apakah data berhasil diubah
        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php'; // Ganti dengan halaman yang sesuai
                  </script>";
        } else {
            echo "<script>
                    alert('Tidak ada data yang diubah! Mungkin data yang sama.');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Data gagal diubah!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Ubah Data | PHP Native | CRUD</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">PHP Native | CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-person-fill"></i>&nbsp;Ubah Data</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : ''; ?>">
                    <div class="mb-3">
                        <label for="uraian" class="form-label">Uraian</label>
                        <input type="text" class="form-control form-control-md w-50" id="Uraian" name="Uraian" value="<?= isset($data['Uraian']) ? $data['Uraian'] : ''; ?>" placeholder="Masukkan Uraian" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control w-50" id="Jumlah" name="Jumlah" value="<?= isset($data['Jumlah']) ? $data['Jumlah'] : ''; ?>" placeholder="Masukkan Jumlah " required>
                    </div>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Masukkan Bulan</label>
                        <select class="form-select w-50" id="bulan" name="bulan" required>
                            <option value="<?= isset($data['Bulan']) ? $data['Bulan'] : ''; ?>" selected><?= isset($data['Bulan']) ? $data['Bulan'] : 'Pilih Bulan'; ?></option>
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
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white">
            <div class="col-md-6 my-2" id="about">
                <h4 class="fw-bold text-uppercase">About PDAM Makassar</h4>
                <p><strong>Kantor Pusat</strong><br>
                    Melayani Anda Lebih Baik</p>
                <p><strong>Lokasi</strong><br>
                    Jl. Dr. Ratulangi No. 3</p>
                <p><strong>Telepon:</strong><br>
                    (0411) 876777</p>
                <p><strong>Alamat Email:</strong><br>
                    pusat.pdammks@gmail.com</p>
            </div>
            <div class="col-md-6 my-2 text-center link">
                <h4 class="fw-bold text-uppercase">Account Links</h4>
                <a href="https://www.facebook.com/pdammks/?locale=id_ID" target="_blank"><i class="bi bi-facebook fs-3"></i></a>
                <a href="https://www.instagram.com/perumdairminum.kotamakassar" target="_blank"><i class="bi bi-instagram fs-3"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="bi bi-twitter fs-3"></i></a>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p>Created with <i class="bi bi-suit-heart-fill" style="color: red;"></i> by <a href="https://www.instagram.com/perumdairminum.kotamakassar/" target="_blank" style="color: #fff;">Pdam Makassar</a></p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
