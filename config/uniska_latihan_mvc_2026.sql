-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2026 at 10:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniska_latihan_mvc_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 1,
  `npm` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `jurusan` enum('Teknik Informatika','Sistem Informasi') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `created_at`, `updated_at`, `status_id`, `npm`, `nama_lengkap`, `fakultas`, `jurusan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`) VALUES
(1, '2026-04-30 08:00:34', '2026-04-30 08:00:34', 1, '2300101001', 'Ahmad Fauzi', 'Fakultas Teknologi Informasi', 'Teknik Informatika', 'Banjarmasin', '2003-05-12', 'Laki-laki'),
(2, '2026-04-30 08:00:34', '2026-04-30 08:00:34', 1, '2300101002', 'Siti Rahayu', 'Fakultas Teknologi Informasi', 'Sistem Informasi', 'Banjarbaru', '2003-08-20', 'Perempuan'),
(3, '2026-04-30 08:00:34', '2026-04-30 08:00:34', 1, '2300101003', 'Muhammad Rizky', 'Fakultas Teknologi Informasi', 'Teknik Informatika', 'Martapura', '2002-11-03', 'Laki-laki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
