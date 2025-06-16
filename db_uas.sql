-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2025 pada 13.32
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
-- Database: `db_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `harga_produk` decimal(10,2) DEFAULT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `stok_produk`, `gambar_produk`) VALUES
(4, 'Carhartt', 'anjsac', 99999999.99, 3, 'Carhartt 4.png'),
(5, 'polo', 'like new', 1783173.00, 1, 'Polo 2.png'),
(6, 'stussy', 'like new', 1783173.00, 1, 'Stussy 4.png'),
(7, 'tnf', 'like new', 1783173.00, 1, 'Tnf 1.png'),
(8, 'stussy', 'kad', 124124.00, 3, 'Stussy 1.png'),
(9, 'polo', 'fyt', 99999999.99, 4, 'Polo 4.png'),
(14, 'polo', 'aldmad', 17631711.00, 3, 'Polo 3.png'),
(17, 'stussy', 'nsada', 12371623.00, 3, 'Stussy 3.png'),
(19, 'tnf', 'cfyt', 1200000.00, 1, 'Tnf 3.png'),
(20, 'Carhartt', 'afad', 12445.00, 1, 'Polo 1.png'),
(21, 'polo', 'asdg', 23413123.00, 2, 'Polo 4.png'),
(22, 'stussy', 'asdg', 23413123.00, 2, 'Stussy 1.png'),
(23, 'Carhartt', 'sdtui', 12346.00, 12, 'Carhartt 4.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
