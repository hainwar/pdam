<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari id dengan fungsi GET
$id = $_GET['id'];

// Jika fungsi hapus lebih dari 0/data terhapus, maka munculkan alert
if (hapus($id) > 0) {
    echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
} else {
    // Jika data gagal dihapus
    echo "<script>
            alert('Data gagal dihapus!');
        </script>";
}
?>
