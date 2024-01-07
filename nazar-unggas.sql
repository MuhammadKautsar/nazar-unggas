-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Jan 2024 pada 10.39
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nazar-unggas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_operasional`
--

CREATE TABLE `biaya_operasional` (
  `idbiaya` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kebutuhan_id` int(2) NOT NULL,
  `harga` int(11) NOT NULL,
  `periode_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biaya_operasional`
--

INSERT INTO `biaya_operasional` (`idbiaya`, `tanggal`, `kebutuhan_id`, `harga`, `periode_id`) VALUES
(3, '2023-04-24', 1, 250000, 1),
(4, '2023-04-25', 2, 150000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_harian`
--

CREATE TABLE `data_harian` (
  `iddata` int(11) NOT NULL,
  `minggu_ke` int(1) NOT NULL,
  `tanggal` date NOT NULL,
  `umur` int(2) NOT NULL,
  `ayam_mati` int(3) NOT NULL,
  `afkir` int(3) NOT NULL,
  `pakan` int(3) NOT NULL,
  `berat_ayam` int(4) NOT NULL,
  `periode_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_harian`
--

INSERT INTO `data_harian` (`iddata`, `minggu_ke`, `tanggal`, `umur`, `ayam_mati`, `afkir`, `pakan`, `berat_ayam`, `periode_id`) VALUES
(3, 1, '2023-04-24', 12, 3, 1, 150, 20, 2),
(4, 2, '2022-04-28', 24, 3, 1, 150, 250, 1),
(5, 1, '2023-04-28', 20, 30, 15, 125, 275, 2),
(6, 3, '2023-05-05', 24, 15, 10, 100, 300, 2),
(7, 4, '2023-05-12', 18, 5, 3, 50, 200, 2),
(8, 5, '2023-05-19', 45, 8, 7, 76, 345, 2),
(9, 6, '2023-05-26', 12, 4, 5, 80, 456, 2),
(10, 7, '2023-06-02', 36, 9, 12, 125, 350, 2),
(11, 9, '2023-06-09', 45, 23, 34, 789, 876, 2),
(12, 4, '2023-05-18', 34, 21, 12, 123, 564, 2),
(13, 3, '2023-05-24', 23, 34, 32, 656, 133, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `iddokumentasi` int(11) NOT NULL,
  `jumlah_panen` int(5) NOT NULL,
  `tgl_panen` date NOT NULL,
  `sisa_pakan` int(4) NOT NULL,
  `berat_ayam` int(8) NOT NULL,
  `jumlah_biaya` int(10) NOT NULL,
  `periode_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokumentasi`
--

INSERT INTO `dokumentasi` (`iddokumentasi`, `jumlah_panen`, `tgl_panen`, `sisa_pakan`, `berat_ayam`, `jumlah_biaya`, `periode_id`) VALUES
(2, 500, '2022-04-12', 15, 275, 1750000, 1),
(3, 800, '2023-04-25', 100, 300, 1250000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan`
--

CREATE TABLE `kebutuhan` (
  `idkebutuhan` int(2) NOT NULL,
  `nama_kebutuhan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kebutuhan`
--

INSERT INTO `kebutuhan` (`idkebutuhan`, `nama_kebutuhan`) VALUES
(1, 'konsumsi'),
(2, 'peralatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `idperiode` int(4) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `jumlah_doc` int(5) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`idperiode`, `tanggal_mulai`, `jumlah_doc`, `status`) VALUES
(1, '2023-04-04', 3, 'Selesai'),
(2, '2023-04-05', 24000, 'Aktif'),
(8, '2023-04-25', 36264, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `nama` varchar(25) DEFAULT NULL,
  `phone` int(12) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userId`, `password`, `nama`, `phone`, `username`, `level`) VALUES
(1, '$2y$10$uy7ZUVIFc3NU.hiTQxDB0.KlsW6X0uucBpGXZhRvLPY1EAMRxBCi.', 'System Admin', 2147483647, 'admin123', 1),
(2, '$2y$10$NWT3Az9pnYosxzgsJ4.6lOhrNj2SzJk5xXtRe2MQnMtaYE8eRRIjK', 'Manager', 21479214, 'manager123', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  ADD PRIMARY KEY (`idbiaya`),
  ADD KEY `periode_id` (`periode_id`),
  ADD KEY `kebutuhan_id` (`kebutuhan_id`);

--
-- Indeks untuk tabel `data_harian`
--
ALTER TABLE `data_harian`
  ADD PRIMARY KEY (`iddata`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`iddokumentasi`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `kebutuhan`
--
ALTER TABLE `kebutuhan`
  ADD PRIMARY KEY (`idkebutuhan`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`idperiode`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  MODIFY `idbiaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_harian`
--
ALTER TABLE `data_harian`
  MODIFY `iddata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `iddokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan`
--
ALTER TABLE `kebutuhan`
  MODIFY `idkebutuhan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `idperiode` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  ADD CONSTRAINT `biaya_operasional_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`idperiode`),
  ADD CONSTRAINT `biaya_operasional_ibfk_2` FOREIGN KEY (`kebutuhan_id`) REFERENCES `kebutuhan` (`idkebutuhan`);

--
-- Ketidakleluasaan untuk tabel `data_harian`
--
ALTER TABLE `data_harian`
  ADD CONSTRAINT `data_harian_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`idperiode`);

--
-- Ketidakleluasaan untuk tabel `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `dokumentasi_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`idperiode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
