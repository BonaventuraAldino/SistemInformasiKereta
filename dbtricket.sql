-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 05:43 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` char(12) CHARACTER SET latin1 NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 NOT NULL,
  `address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `phone_number` varchar(20) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `username`, `password`, `type`, `nama`, `address`, `phone_number`, `gender`) VALUES
('AC001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Bonaventura Admin', 'Jl. Tubagus Ismail Dalam', '082219545838', 'Laki-laki'),
('AC002', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'Bonaventura User', 'Jl. Tubagus Ismail Dalam No.19C, Sekeloa', '082211192345', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_schedule` char(8) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `initial_kode` char(8) NOT NULL,
  `final_kode` char(8) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `train_kode` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_schedule`, `hari`, `initial_kode`, `final_kode`, `departure_time`, `arrival_time`, `train_kode`) VALUES
('SC001', 'Selasa', 'ST01', 'ST05', '09:05:00', '10:05:00', 'TRT03'),
('SC002', 'Sabtu', 'ST01', 'ST01', '09:05:00', '10:05:00', 'TRT04'),
('SC003', 'Senin', 'ST01', 'ST06', '09:05:00', '13:05:00', 'TRT01');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_class` char(8) NOT NULL,
  `class_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_class`, `class_name`) VALUES
('CS01', 'Ekonomi'),
('CS02', 'Eksekutif'),
('CS03', 'Bisnis'),
('CS04', 'Premium');

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `train_kode` char(8) NOT NULL,
  `train_name` varchar(50) NOT NULL,
  `carriages_number` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`train_kode`, `train_name`, `carriages_number`) VALUES
('TRT01', 'Gunung Putri', 5),
('TRT02', 'Lodaya', 5),
('TRT03', 'Ciremai', 5),
('TRT04', 'Malabar', 5),
('TRT05', 'Mutiara Selatan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `payment_code` char(8) NOT NULL,
  `receipt_payment` char(8) NOT NULL,
  `payer_name` varchar(50) NOT NULL,
  `date_payment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `order_number` varchar(8) NOT NULL,
  `order_date` date NOT NULL,
  `id_account` char(8) NOT NULL,
  `id_schedule` char(8) NOT NULL,
  `payment_code` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`order_number`, `order_date`, `id_account`, `id_schedule`, `payment_code`) VALUES
('OR002', '2022-06-03', 'AC001', 'SC002', 'PY001'),
('OR005', '2022-06-04', 'AC001', 'SC001', 'PY001'),
('OR006', '2022-06-04', 'AC002', 'SC002', 'PY001');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun_akhir`
--

CREATE TABLE `stasiun_akhir` (
  `final_kode` char(8) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stasiun_akhir`
--

INSERT INTO `stasiun_akhir` (`final_kode`, `station_name`, `address`, `city_name`) VALUES
('ST01', 'Stasiun Cikudapateuh', 'Jalan Kembang Sepatu, Kelurahan Samoja, Batununggal, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST02', 'Stasiun Kiaracondong', 'Kelurahan Babakansari, Kiaracondong, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST03', 'Stasiun Gedebage', 'Jl. Gedebage, Gedebage, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST04', 'Stasiun Cimekar', 'Desa Cimekar, Cileunyi, Kab. Bandung', 'Kabupaten Bandung, Jawa Barat, Indonesia'),
('ST05', 'Stasiun Rancaekek', 'Desa Rancaekek Wetan, Rancaekek, Kab. Bandung', 'Kabupaten Bandung, Jawa Barat, Indonesia'),
('ST06', 'Stasiun Gambir', 'Jl. Medan Merdeka Tim. No.1, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', 'DKI Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun_awal`
--

CREATE TABLE `stasiun_awal` (
  `initial_kode` char(8) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stasiun_awal`
--

INSERT INTO `stasiun_awal` (`initial_kode`, `station_name`, `address`, `city_name`) VALUES
('ST01', 'Stasiun Bandung ', 'Jalan Stasiun Timur 1 dan Jalan Kebon Kawung 43 Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST02', 'Stasiun Ciroyom', 'Perbatasan Kelurahan Ciroyom, Andir dengan Arjuna, Cicendo, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST03', 'Stasiun Andir', 'Jalan Ciroyom No.1, Ciroyom, Andir, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST04', 'Stasiun Cimindi', 'Kelurahan Campaka, Andir, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST05', 'Stasiun Cikudapateuh', 'Jalan Kembang Sepatu, Kelurahan Samoja, Batununggal, Kota Bandung', 'Kota Bandung, Jawa Barat, Indonesia'),
('ST06', 'Stasiun Gambir', 'Jl. Medan Merdeka Tim. No.1, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', 'DKI Jakarta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD UNIQUE KEY `id` (`id_account`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD UNIQUE KEY `id_schedule` (`id_schedule`),
  ADD KEY `train_kode` (`train_kode`),
  ADD KEY `initial_kode` (`initial_kode`),
  ADD KEY `final_kode` (`final_kode`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD UNIQUE KEY `id_class` (`id_class`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD UNIQUE KEY `train_kode` (`train_kode`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD UNIQUE KEY `payment_code` (`payment_code`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `id_customer` (`id_account`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Indexes for table `stasiun_akhir`
--
ALTER TABLE `stasiun_akhir`
  ADD UNIQUE KEY `station_kode` (`final_kode`);

--
-- Indexes for table `stasiun_awal`
--
ALTER TABLE `stasiun_awal`
  ADD UNIQUE KEY `station_kode` (`initial_kode`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`train_kode`) REFERENCES `kereta` (`train_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`initial_kode`) REFERENCES `stasiun_awal` (`initial_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`final_kode`) REFERENCES `stasiun_akhir` (`final_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk1` FOREIGN KEY (`id_schedule`) REFERENCES `jadwal` (`id_schedule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
