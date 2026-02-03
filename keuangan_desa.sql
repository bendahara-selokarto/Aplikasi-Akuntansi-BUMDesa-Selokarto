-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2026 pada 17.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan_desa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@selokarto', '$2y$10$cIHcou8.SsHpc9srvIpyhubGJCrySCzNhhHzkFS5QKhwMML4Nfe.G');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `id` int(10) NOT NULL,
  `kode` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis` enum('aset','kewajiban','modal','pendapatan','beban') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `coa`
--

INSERT INTO `coa` (`id`, `kode`, `nama`, `jenis`) VALUES
(12, '1.1.01.01', 'Kas Tunai', 'aset'),
(13, '6.1.01.01', 'Beban Gaji dan Tunjangan Bag. Adum', 'beban'),
(14, '4.1.07.01', 'Pendapatan Parkir Mobil', 'pendapatan'),
(15, '4.1.01.01', 'Pendapatan Tiket', 'pendapatan'),
(16, '1.3.03.01', 'Peralatan dan Mesin', 'aset'),
(17, '4.2.01.06', 'Pendapatan Penjualan Bensin', 'pendapatan'),
(18, '1.1.01.02', 'Kas di Bank BSI', 'aset');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `tanggal`, `keterangan`) VALUES
(12, '2022-01-02', 'Menerima pendapatan tiket'),
(13, '2022-01-02', 'Menerima pendapatan parkir mobil'),
(14, '2022-09-11', 'Membayar beban gaji'),
(15, '2022-01-01', 'Saldo awal'),
(16, '2022-10-07', 'Mencatat harga pokok penjualan bensin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_detail`
--

CREATE TABLE `jurnal_detail` (
  `id` int(10) NOT NULL,
  `jurnal_id` int(10) DEFAULT NULL,
  `coa_id` int(10) DEFAULT NULL,
  `debit` decimal(15,2) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurnal_detail`
--

INSERT INTO `jurnal_detail` (`id`, `jurnal_id`, `coa_id`, `debit`, `kredit`) VALUES
(22, 12, 15, 0.00, 50000000.00),
(23, 12, 12, 50000000.00, 0.00),
(24, 13, 14, 0.00, 20000000.00),
(25, 13, 12, 20000000.00, 0.00),
(26, 14, 13, 4500000.00, 0.00),
(27, 14, 12, 0.00, 4500000.00),
(28, 15, 16, 25000000.00, 0.00),
(29, 15, 12, 0.00, 25000000.00),
(30, 16, 17, 0.00, 1000000.00),
(31, 16, 12, 1000000.00, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `coa`
--
ALTER TABLE `coa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
