-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 03:43 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_aras`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kodeAlternatif` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kodeAlternatif`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`) VALUES
(1, 1, 0.30416),
(2, 2, 0.77084),
(3, 3, 0.51667),
(4, 4, 0.475),
(5, 5, 0.41249);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kode_kriteria` varchar(100) CHARACTER SET latin1 NOT NULL,
  `bobot` varchar(100) CHARACTER SET latin1 NOT NULL,
  `sifat` enum('Benefit','Cost','','') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `keterangan`, `kode_kriteria`, `bobot`, `sifat`) VALUES
(1, 'Umur', 'C1', '0.1', 'Benefit'),
(2, 'Pendidikan', 'C2', '0.15', 'Benefit'),
(3, 'Pekerjaan', 'C3', '0.2', 'Benefit'),
(4, 'Status Pernikahan', 'C4', '0.2', 'Benefit'),
(5, 'Penghasilan Perbulan', 'C5', '0.1', 'Benefit'),
(6, 'Jumlah Tanggungan', 'C6', '0.15', 'Cost'),
(7, 'Penghasilan Perbulan', 'C7', '0.1', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(3) NOT NULL,
  `id_alternatif` int(3) NOT NULL,
  `id_kriteria` int(3) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 7),
(3, 1, 3, 12),
(4, 1, 4, 15),
(5, 1, 5, 20),
(6, 1, 6, 23),
(7, 1, 7, 29),
(8, 2, 1, 4),
(9, 2, 2, 6),
(10, 2, 3, 13),
(11, 2, 4, 16),
(12, 2, 5, 19),
(13, 2, 6, 26),
(14, 2, 7, 30),
(15, 3, 1, 3),
(16, 3, 2, 9),
(17, 3, 3, 14),
(18, 3, 4, 15),
(19, 3, 5, 21),
(20, 3, 6, 22),
(21, 3, 7, 28),
(22, 4, 1, 4),
(23, 4, 2, 5),
(24, 4, 3, 11),
(25, 4, 4, 16),
(26, 4, 5, 17),
(27, 4, 6, 24),
(28, 4, 7, 30),
(29, 5, 1, 2),
(30, 5, 2, 8),
(31, 5, 3, 12),
(32, 5, 4, 15),
(33, 5, 5, 20),
(34, 5, 6, 24),
(35, 5, 7, 29);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(3) NOT NULL,
  `id_kriteria` int(3) NOT NULL,
  `nilai` float NOT NULL,
  `deskripsi` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nilai`, `deskripsi`) VALUES
(1, 1, 1, '>46 Tahun'),
(2, 1, 2, '41-45 Tahun'),
(3, 1, 3, '31-40 Tahun'),
(4, 1, 4, '20-30 Tahun'),
(5, 2, 1, 'SMA/SMK'),
(6, 2, 2, 'D3'),
(7, 2, 3, 'S1'),
(8, 2, 4, 'S2'),
(9, 2, 5, 'S3'),
(10, 3, 1, 'Pengangguran'),
(11, 3, 2, 'Freelance'),
(12, 3, 3, 'PNS'),
(13, 3, 4, 'Wiraswasta'),
(14, 3, 5, 'Professional'),
(15, 4, 1, 'Menikah'),
(16, 4, 2, 'Belum Menikah'),
(17, 5, 1, 'Rp.3.000.000 - Rp.4.500.000'),
(18, 5, 2, 'Rp.5.000.000 - Rp.10.000.000'),
(19, 5, 3, 'Rp.10.000.000 - Rp.20.000.000'),
(20, 5, 4, 'Rp.20.000.000 - Rp.30.000.000'),
(21, 5, 5, '> Rp.30.000.000'),
(22, 6, 1, '>4'),
(23, 6, 2, '3'),
(24, 6, 3, '2'),
(25, 6, 4, '1'),
(26, 6, 5, '0'),
(27, 7, 1, '20% - 30%'),
(28, 7, 2, '30% - 40%'),
(29, 7, 3, '40% - 50%'),
(30, 7, 4, '> 50%');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `nama` varchar(200) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_nilaikriteria` (`nilai`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
