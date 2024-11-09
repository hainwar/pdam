<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['theme'] = $_POST['theme']; // Menyimpan tema
    $_SESSION['color_schema'] = $_POST['color_schema']; // Menyimpan skema warna
    $_SESSION['sidebar_color'] = $_POST['sidebar_color']; // Menyimpan warna sidebar
    $_SESSION['background_color'] = $_POST['background_color']; // Menyimpan warna latar belakang
    $_SESSION['font_family'] = $_POST['font_family']; // Menyimpan font keluarga
    $_SESSION['font_size'] = $_POST['font_size']; // Menyimpan ukuran font

    header('Location: index.php'); // Kembali ke halaman index setelah menyimpan pengaturan
    exit;
}
?>
