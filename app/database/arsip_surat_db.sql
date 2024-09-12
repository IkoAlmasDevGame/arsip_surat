-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 04:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_input` date NOT NULL,
  `jam` text NOT NULL,
  `jam2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `id_arsip` int(11) NOT NULL,
  `nomer_surat` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_surat` enum('masuk','keluar') DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jam_masuk`
--

CREATE TABLE `jam_masuk` (
  `id_jam` int(11) NOT NULL,
  `jam_masuk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(255) NOT NULL,
  `role` enum('pengguna') NOT NULL,
  `foto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE `sistem` (
  `id_sistem` int(11) NOT NULL,
  `developer` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `jenis_surat` enum('masuk','keluar') DEFAULT 'keluar',
  `perihal` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('belum_dibaca','sudah_dibaca') DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `jenis_surat` enum('masuk','keluar') DEFAULT 'masuk',
  `perihal` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('belum_dibaca','sudah_dibaca') DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') NOT NULL,
  `foto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id_akun`, `username`, `email`, `nama`, `password`, `repassword`, `role`, `foto`) VALUES
(1, 'superadmin', 'superadmin@mailing.com', 'super admin', '0192023a7bbd73250516f069df18b500', '0192023a7bbd73250516f069df18b500', 'superadmin', 'flora_shafiq.jpg'),
(2, 'indahjkt48', 'indahjkt48@mailing.com', 'indah cahya nabila', 'b8b329e55e63d2a9ab9b856bb794988d', 'b8b329e55e63d2a9ab9b856bb794988d', 'admin', 'indah_cahya.jpg'),
(3, 'aurhel_alana', 'aurheljkt@mailing.com', 'aurhel alana', 'def99441381edc85fc0875a915c6f390', 'def99441381edc85fc0875a915c6f390', 'admin', 'aurhel_alana.jpg');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_ibfk_1` (`id_surat_masuk`),
  ADD KEY `notifikasi_ibfk_2` (`id_surat_keluar`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `sistem`
--
ALTER TABLE `sistem`
  ADD PRIMARY KEY (`id_sistem`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistem`
--
ALTER TABLE `sistem`
  MODIFY `id_sistem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifikasi_ibfk_2` FOREIGN KEY (`id_surat_keluar`) REFERENCES `surat_keluar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
