<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Query untuk mengambil semua data dari tabel pdam
$pdam = query("SELECT * FROM pdam ORDER BY created_at DESC");

// Membuat nama file untuk download
$filename = "data_pdam_" . date('Ymd') . ".xls";

// Header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

// Memeriksa apakah data ditemukan
if (empty($pdam)) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data PDAM</title>
    <style>
        /* Styling untuk tampilan tabel di Excel */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th>Bulan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($pdam as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['Uraian']); ?></td>
                    <td><?= htmlspecialchars($row['Bulan']); ?></td>
                    <td><?= htmlspecialchars($row['Jumlah']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
