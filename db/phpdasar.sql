-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2021 pada 13.17
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `pdam` (
  'id' int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`bulan`, `uraian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

-- Mengisi data untuk tabel `pdam`
INSERT INTO `pdam` (`uraian`, `bulan`, `jumlah`) VALUES
('Kubikasi Meter Pelanggan', 'Januari', 4075346),
('Kubikasi Meter Pelanggan', 'Februari', 4075346),
('Kubikasi Meter Pelanggan', 'Maret', 3834532),
('Kubikasi Meter Pelanggan', 'April', 4698524),
('Kubikasi Meter Pelanggan', 'Mei', 4078453),
('Kubikasi Meter Pelanggan', 'Juni', 4118795),
('Kubikasi Meter Pelanggan', 'Juli', 4112752),
('Kubikasi Meter Pelanggan', 'Agustus', 4305457),
('Kubikasi Meter Pelanggan', 'September', 4070285),
('Kubikasi Meter Pelanggan', 'Oktober', 3688611),
('Kubikasi Meter Pelanggan', 'November', 3589677 ),
('Kubikasi Meter Pelanggan', 'Desember', 3980635),
('Tangki TNI/POLRI', 'Januari', 10),
('Tangki TNI/POLRI', 'Februari', 103),
('Tangki TNI/POLRI', 'Maret', 57),
('Tangki TNI/POLRI', 'April', 13),
('Tangki TNI/POLRI', 'Mei', 866),
('Tangki TNI/POLRI', 'Juni', 518),
('Tangki TNI/POLRI', 'Juli', 28),
('Tangki TNI/POLRI', 'Agustus', 391),
('Tangki TNI/POLRI', 'September', 756),
('Tangki TNI/POLRI', 'Oktober', 744),
('Tangki TNI/POLRI', 'November', 693),
('Tangki TNI/POLRI', 'Desember', 168),

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(2, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `pdam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
