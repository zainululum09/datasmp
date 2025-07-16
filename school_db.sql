-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2025 pada 15.12
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
-- Database: `school_db`
--
CREATE DATABASE IF NOT EXISTS `school_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `school_db`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tingkat` enum('7','8','9') NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `tahun_ajaran_id`, `created_at`, `updated_at`) VALUES
(1, '7 B', '7', 1, '2025-06-23 18:13:31', '2025-07-04 21:47:45'),
(2, '8 C', '8', 1, '2025-06-23 18:13:31', '2025-07-05 22:28:01'),
(11, '9 D', '9', 1, '2025-07-09 17:11:30', '2025-07-13 00:46:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `status` enum('aktif','keluar','lulus') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `siswa_id`, `kelas_id`, `tahun_ajaran_id`, `status`, `created_at`, `updated_at`) VALUES
(169, 27, 1, 1, 'aktif', '2025-07-09 17:10:28', '2025-07-09 17:10:28'),
(170, 40, 1, 1, 'aktif', '2025-07-09 17:10:28', '2025-07-09 17:10:28'),
(173, 38, 1, 1, 'aktif', '2025-07-09 17:10:29', '2025-07-09 17:10:29'),
(174, 26, 1, 1, 'aktif', '2025-07-09 17:10:30', '2025-07-09 17:10:30'),
(177, 42, 1, 1, 'aktif', '2025-07-09 17:10:31', '2025-07-09 17:10:31'),
(178, 31, 1, 1, 'aktif', '2025-07-09 17:10:31', '2025-07-09 17:10:31'),
(179, 43, 1, 1, 'aktif', '2025-07-09 17:10:31', '2025-07-09 17:10:31'),
(180, 60, 1, 1, 'aktif', '2025-07-09 17:10:32', '2025-07-09 17:10:32'),
(181, 48, 1, 1, 'aktif', '2025-07-09 17:10:44', '2025-07-09 17:10:44'),
(182, 50, 1, 1, 'aktif', '2025-07-09 17:10:44', '2025-07-09 17:10:44'),
(191, 45, 11, 1, 'aktif', '2025-07-13 00:45:32', '2025-07-13 00:45:32'),
(192, 34, 11, 1, 'aktif', '2025-07-13 00:45:32', '2025-07-13 00:45:32'),
(193, 35, 11, 1, 'aktif', '2025-07-13 00:45:33', '2025-07-13 00:45:33'),
(194, 36, 11, 1, 'aktif', '2025-07-13 00:45:33', '2025-07-13 00:45:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orangtua`
--

CREATE TABLE `orangtua` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orangtua`
--

INSERT INTO `orangtua` (`id`, `siswa_id`, `nama_ayah`, `pekerjaan_ayah`, `pendidikan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `pendidikan_ibu`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 26, 'Bapak Ahmad', 'Guru', 'S1', 'Ibu Aisyah', 'Ibu Rumah Tangga', 'SMA', '081234567001', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(2, 27, 'Bapak Bagas', 'Karyawan', 'SMA', 'Ibu Bella', 'Pedagang', 'SMA', '081234567002', 'Depok', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(4, 29, 'Bapak Dian', 'Karyawan Swasta', 'SMA', 'Ibu Diah', 'Penjahit', 'SMP', '081234567004', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(5, 30, 'Bapak Eko', 'Tukang Las', 'SMA', 'Ibu Erna', 'Ibu Rumah Tangga', 'SMP', '081234567005', 'Depok', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(6, 31, 'Bapak Farhan', 'Petani', 'SMP', 'Ibu Fitri', 'Ibu Rumah Tangga', 'SMA', '081234567006', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(7, 32, 'Bapak Gilang', 'Satpam', 'SMA', 'Ibu Gita', 'Guru PAUD', 'S1', '081234567007', 'Cibinong', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(9, 34, 'Bapak Iqbal', 'Wiraswasta', 'D3', 'Ibu Intan', 'Ibu Rumah Tangga', 'SMA', '081234567009', 'Depok', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(10, 35, 'Bapak Johan', 'Polisi', 'SMA', 'Ibu Jihan', 'Perawat', 'D3', '081234567010', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(11, 36, 'Bapak Kevin', 'Karyawan', 'SMA', 'Ibu Kirana', 'Bidang Kesehatan', 'S1', '081234567011', 'Cibinong', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(13, 38, 'Bapak Lestari', 'Peternak', 'SMP', 'Ibu Laila', 'Ibu Rumah Tangga', 'SMP', '081234567013', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(15, 40, 'Bapak Mawar', 'PNS', 'S1', 'Ibu Mulyani', 'Ibu Rumah Tangga', 'SMA', '081234567015', 'Bekasi', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(16, 41, 'Bapak Sartika', 'Pedagang', 'SMP', 'Ibu Sari', 'Penjahit', 'SMP', '081234567016', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(17, 42, 'Bapak Putri', 'Wiraswasta', 'D3', 'Ibu Purnama', 'Perawat', 'SMA', '081234567017', 'Depok', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(18, 43, 'Bapak Amelia', 'Karyawan', 'SMA', 'Ibu Ayu', 'Guru SD', 'S1', '081234567018', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(19, 44, 'Bapak Larasati', 'Tukang Kayu', 'SMA', 'Ibu Linda', 'Ibu Rumah Tangga', 'SMP', '081234567019', 'Cibinong', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(20, 45, 'Bapak Salma', 'Sopir', 'SMA', 'Ibu Silvia', 'PNS', 'S1', '081234567020', 'Bekasi', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(23, 48, 'Bapak Nabil', 'PNS', 'S1', 'Ibu Nabila', 'PNS', 'S1', '081234567023', 'Cibinong', '2025-06-23 18:40:33', '2025-06-23 18:40:33'),
(25, 50, 'Bapak Puspita', 'Pedagang', 'SMP', 'Ibu Purni', 'Ibu Rumah Tangga', 'SMA', '081234567025', 'Bogor', '2025-06-23 18:40:33', '2025-06-23 18:40:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(24) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(128) NOT NULL,
  `rw` varchar(128) NOT NULL,
  `desa` varchar(128) NOT NULL,
  `kecamatan` varchar(128) NOT NULL,
  `kabupaten` varchar(128) NOT NULL,
  `propinsi` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nisn`, `nama`, `nik`, `jenis_kelamin`, `tempat_lahir`, `no_hp`, `tanggal_lahir`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `kabupaten`, `propinsi`, `created_at`, `updated_at`) VALUES
(26, '1001', '3210000001', 'Ahmad Ramadhan', '', 'L', 'Bogor', NULL, '2012-03-10', 'Jl. Melati No.1', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(27, '1002', '3210000002', 'Bagas Pratama', '', 'L', 'Depok', NULL, '2012-07-14', 'Jl. Kenanga No.5', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(29, '1004', '3210000004', 'Dian Kurniawan', '', 'L', 'Bandung', NULL, '2012-05-21', 'Jl. Merpati No.9', '002', '005', '32.01.29.2010', '32.01.29', '32.01', '32', '2025-06-23 18:17:02', '2025-07-13 10:57:27'),
(30, '1005', '3210000005', 'Eko Saputra', '', 'L', 'Depok', NULL, '2011-08-18', 'Jl. Teratai No.2', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(31, '1006', '3210000006', 'Farhan Akbar', '', 'L', 'Bogor', NULL, '2012-09-25', 'Jl. Anggrek No.7', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(32, '1007', '3210000007', 'Gilang Septian', '', 'L', 'Cibinong', NULL, '2012-04-30', 'Jl. Kamboja No.8', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(34, '1009', '3210000009', 'Iqbal Hasan', '', 'L', 'Depok', NULL, '2012-10-05', 'Jl. Cempaka No.6', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(35, '1010', '3210000010', 'Johan Ridwan', '', 'L', 'Bogor', NULL, '2012-01-19', 'Jl. Mawar No.10', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(36, '1011', '3210000011', 'Kevin Alfarizi', '', 'L', 'cimahi', NULL, '2011-06-15', 'Jl. Bougenville No.12', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-07-06 19:06:20'),
(38, '1013', '3210000013', 'Ayu Lestari', '', 'P', 'Bogor', NULL, '2011-03-05', 'Jl. Melati No.15', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(40, '1015', '3210000015', 'Citra Mawar', '', 'P', 'Bekasi', NULL, '2012-10-11', 'Jl. Flamboyan No.17', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(41, '1016', '3210000016', 'Dewi Sartika', '', 'P', 'Bogor', NULL, '2012-01-08', 'Jl. Merpati No.18', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(42, '1017', '3210000017', 'Elisa Putri', '', 'P', 'Depok', NULL, '2011-05-13', 'Jl. Teratai No.19', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(43, '1018', '3210000018', 'Fika Amelia', '', 'P', 'Bogor', NULL, '2012-02-26', 'Jl. Anggrek No.20', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(44, '1019', '3210000019', 'Gita Larasati', '', 'P', 'Cibinong', NULL, '2011-09-17', 'Jl. Kamboja No.21', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(45, '1020', '3210000020', 'Hilda Salma', '', 'P', 'Bekasi', NULL, '2012-04-30', 'Jl. Sakura No.22', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(48, '1023', '3210000023', 'Kirana Nabila', '', 'P', 'Cibinong', NULL, '2012-06-18', 'Jl. Bougenville No.25', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-23 18:17:02'),
(50, '1025', '3210000025', 'Melati Esalia', '', 'P', 'Bogor', NULL, '2012-08-09', 'Jl. Cemara No.27', '', '', '', '', '', '', '2025-06-23 18:17:02', '2025-06-28 01:46:31'),
(60, '1012', '3210000012', 'Fika Aulia Seftiana', '', 'P', 'Bogor', NULL, '2012-09-28', NULL, '', '', '', '', '', '', '2025-07-06 19:02:48', '2025-07-06 19:02:48'),
(61, '1014', '3210000014', 'Daffa Prasetyo hafiludin ', '', 'L', 'jakarta', NULL, '2013-12-03', NULL, '', '', '', '', '', '', '2025-07-06 19:07:22', '2025-07-06 19:07:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktif` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `nama`, `aktif`, `created_at`, `updated_at`) VALUES
(1, '2025/2026 Ganjil', 1, '2025-06-23 18:13:31', '2025-06-23 18:13:31'),
(3, '2024/2025 Genap', 0, '2025-07-05 21:18:49', '2025-07-05 21:18:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `role` varchar(24) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `images`, `role`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '$2y$10$2j2DhJutKWYnpw6x2jx1buGo1ebDhXXPkrRIx5RZtFWe91EKXl3xi', 'Administrator', 'default.jpg', 'admin', '2025-06-23 20:40:06', '2025-06-27 17:46:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `orangtua`
--
ALTER TABLE `orangtua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT untuk tabel `orangtua`
--
ALTER TABLE `orangtua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_siswa_ibfk_3` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orangtua`
--
ALTER TABLE `orangtua`
  ADD CONSTRAINT `orangtua_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
