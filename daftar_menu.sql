-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql110.infinityfree.com
-- Waktu pembuatan: 22 Agu 2024 pada 09.00
-- Versi server: 10.6.19-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37095148_menu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cemilan`
--

CREATE TABLE `cemilan` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cemilan`
--

INSERT INTO `cemilan` (`id`, `nama`, `harga`, `stok`) VALUES
(1, 'Kentang Goreng', 8000, 1),
(4, 'Sosis', 8000, 1),
(5, 'Kentang Mix', 12000, 1),
(6, 'Tahu Cabe Garam', 12000, 1),
(7, 'Rujak Cireng', 12000, 1),
(8, 'Cireng isi', 10000, 1),
(9, 'Risol Mayo', 8000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kopi`
--

CREATE TABLE `kopi` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kopi`
--

INSERT INTO `kopi` (`id`, `nama`, `harga`, `stok`) VALUES
(4, 'Kopi Susu Creamy', 15000, 1),
(5, 'Kopi Susu Gula Aren', 15000, 1),
(6, 'V60 (Arabica)', 10000, 1),
(7, 'Japanese', 15000, 1),
(8, 'Americano', 13000, 1),
(9, 'Espresso', 10000, 1),
(10, 'Capucino', 13000, 1),
(11, 'Kopi Tubruk (Arabica)', 8000, 1),
(12, 'Kopi Tubruk + Susu', 9000, 1),
(13, 'Kopi Tubruk + Gula', 9000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`id`, `nama`, `harga`, `stok`) VALUES
(1, 'Mie Kireen Dia (1-5)', 12000, 1),
(2, 'Mie Kireen Kamu (1-5)', 12000, 1),
(4, 'Mie Seblak Tulang', 8000, 1),
(5, 'Nasi Goreng Ayam', 18000, 1),
(6, 'Nasi Goreng Seafood', 22000, 1),
(7, 'Nasi Goreng Biasa', 15000, 1),
(8, 'Mie Hotplate Biasa', 16000, 1),
(9, 'Mie Hotplate Telur', 20000, 1),
(10, 'Mie Hotplate Ceker', 20000, 1),
(11, 'Mie Hotplate Baso', 20000, 1),
(12, 'Mie Hotplate Tulang Iga', 22000, 1),
(13, 'Rice Bowl Beef Sambal Matah', 30000, 1),
(14, 'Rice Bowl Beef Teriyaki', 30000, 1),
(15, 'Rice Bowl Beef Yakiniku', 30000, 1),
(16, 'Rice Bowl Chiken Katsu', 27000, 1),
(17, 'Rice Bowl Chiken Teriyaki', 27000, 1),
(18, 'Sate Maranggi', 30000, 1),
(19, 'Sop Iga', 25000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `minuman`
--

CREATE TABLE `minuman` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `minuman`
--

INSERT INTO `minuman` (`id`, `nama`, `harga`, `stok`) VALUES
(1, 'Sweat Tea', 5000, 1),
(4, 'Orange Jus', 5000, 1),
(5, 'Teh Tarik', 8000, 1),
(6, 'Chocolate', 8000, 1),
(7, 'Matcha', 8000, 1),
(8, 'Thai Tea', 8000, 1),
(9, 'Jus Alpukat', 10000, 1),
(10, 'Jus Melon', 10000, 1),
(11, 'Jus Tomat', 10000, 1),
(12, 'Jus Mangga', 10000, 1),
(13, 'Jeruk Peras', 10000, 1),
(14, 'Lemon Tea', 10000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tenant`
--

INSERT INTO `tenant` (`id`, `nama`, `harga`, `stok`) VALUES
(1, 'Dimsum', 10000, 1),
(2, 'Taichan', 20000, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cemilan`
--
ALTER TABLE `cemilan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kopi`
--
ALTER TABLE `kopi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cemilan`
--
ALTER TABLE `cemilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kopi`
--
ALTER TABLE `kopi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `minuman`
--
ALTER TABLE `minuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
