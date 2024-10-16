<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Membuat fungsi query dalam bentuk array
function query($query)
{
    global $koneksi;

    // Optional: If you always want to order by id in descending order:
    if (strpos($query, 'SELECT * FROM pdam') !== false) {
        $query = "SELECT * FROM pdam ORDER BY id ASC";
    }

    $result = mysqli_query($koneksi, $query);

    // Fetch all rows into an array
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// Membuat fungsi tambah
function tambah($data) {
    global $koneksi;

    // Menangkap data dari form
    $uraian = htmlspecialchars($data["Uraian"]);
    $jumlah = $data["Jumlah"]; // Tidak perlu htmlspecialchars
    $bulan = htmlspecialchars($data["bulan"]);

    // Validasi input jumlah: harus angka (integer atau float)
    if (!is_numeric($jumlah)) {
        return 0; // Jika bukan angka, gagal menyimpan data
    }

    // Query untuk menambahkan data
    $query = "INSERT INTO pdam (Uraian, Jumlah, Bulan)
              VALUES ('$uraian', '$jumlah', '$bulan')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi); // Mengembalikan jumlah baris yang terpengaruh
}

// Membuat fungsi hapus
function hapus($id)
{
    global $koneksi;

    // Bersihkan input untuk menghindari SQL Injection
    $id = (int) $id; // Konversi ke integer untuk keamanan

    // Menghapus data berdasarkan id
    mysqli_query($koneksi, "DELETE FROM pdam WHERE id = $id");
    return mysqli_affected_rows($koneksi); // Mengembalikan jumlah baris yang terpengaruh
}

function ubah($data) {
    global $koneksi;

    $id = $data["id"];
    $uraian = htmlspecialchars($data["Uraian"]);
    $jumlah = htmlspecialchars($data["Jumlah"]);
    $bulan = htmlspecialchars($data["bulan"]);

    // Query untuk update data
    $query = "UPDATE pdam SET
                Uraian = '$uraian',
                Jumlah = '$jumlah',
                Bulan = '$bulan',
                tanggal_input = CURRENT_TIMESTAMP
               
              WHERE id = $id";

if (!filter_var($jumlah, FILTER_VALIDATE_FLOAT) !== false) {
    return 0; // Jika bukan angka, gagal menyimpan data
}

    // Jalankan query
    mysqli_query($koneksi, $query);

    // Cek apakah ada perubahan
    return mysqli_affected_rows($koneksi);
}

?>
