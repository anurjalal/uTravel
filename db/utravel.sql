-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 10:38 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `almt_customer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_customer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_customer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota_customer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_customer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `almt_customer`, `telp_customer`, `fax_customer`, `kota_customer`, `cp_customer`, `status`) VALUES
(1, 'RUMAH TANGGA UNDIP', 'UNDIP', '', '', 'Semarang', '', '1'),
(2, 'LPPM', 'UNDIP', '', '', 'Semarang', '', '1'),
(3, 'FAKULTAS KEDOKTERAN', 'UNDIP', '', '', 'Semarang', '', '1'),
(4, 'FSM', 'UNDIP', '', '', 'Semarang', '', '1'),
(5, 'FAKULTAS PSIKOLOGI', 'UNDIP', '', '', 'Semarang', '', '1'),
(6, 'FAKULTAS HUKUM', 'UNDIP', '', '', 'Semarang', '', '1'),
(7, 'LP2MP', 'UNDIP', '', '', 'Semarang', '', '1'),
(8, 'BAPSI', 'UNDIP', '', '', 'Semarang', '', '1'),
(9, 'HASNA', '', '', '', 'Semarang', '', '1'),
(10, 'SPI ', 'UNDIP', '', '', 'Semarang', '', '1'),
(11, 'FPP', 'UNDIP', '', '', 'Semarang', '', '1'),
(12, 'ULP', 'UNDIP', '', '', 'Semarang', '', '1'),
(13, 'SA-MWA', 'UNDIP', '', '', 'Semarang', '', '1'),
(14, 'FEB TEMBALANG', 'UNDIP', '', '', 'Semarang', '', '1'),
(15, 'MM FEB ', 'UNDIP', '', '', 'Semarang', '', '1'),
(16, 'FKM', 'UNDIP', '', '', 'Semarang', '', '1'),
(17, 'WR 3', 'UNDIP', '', '', 'Semarang', 'Yolanda', '1'),
(18, 'FPIK', 'UNDIP', '', '', 'Semarang', '', '1'),
(19, 'KESMA DIAN BAK', 'UNDIP', '', '', 'Semarang', '', '1'),
(20, 'SEKERTARIS REKTOR', 'UNDIP', '', '', 'Semarang', '', '1'),
(22, 'BPSU', 'UNDIP', '', '', 'Semarang', '', '1'),
(23, 'UNDIP MAJU', 'UNDIP', '', '', 'Semarang', '', '1'),
(24, 'UMUM', '', '', '', 'Semarang', '', '1'),
(25, 'FAKULTAS TEKNIK', 'UNDIP', '', '', 'Semarang', '', '1'),
(26, 'RU', NULL, NULL, NULL, NULL, NULL, '1'),
(27, 'UFOOD', NULL, NULL, NULL, NULL, NULL, '1'),
(28, 'UNDIP', 'Jl. prof soedarto tembalang', '', '', 'Semarang', '', '1'),
(29, 'natalia', NULL, NULL, NULL, NULL, NULL, '1'),
(30, 'a', NULL, NULL, NULL, NULL, NULL, '1'),
(31, 'za', NULL, NULL, NULL, NULL, NULL, '1'),
(32, 'k', NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `groupbiaya`
--

CREATE TABLE `groupbiaya` (
  `KD_BEBAN` varchar(20) NOT NULL,
  `NM_BEBAN` varchar(255) NOT NULL,
  `KATEGORI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupbiaya`
--

INSERT INTO `groupbiaya` (`KD_BEBAN`, `NM_BEBAN`, `KATEGORI`) VALUES
('1', 'Kas', 'Aktiva Lancar'),
('100', 'Hutang Dagang', 'Hutang Lancar'),
('101', 'Hutang Pajak', 'Hutang Lancar'),
('102', 'Hutang Gaji dan Upah', 'Hutang Lancar'),
('103', 'Hutang Biaya', 'Hutang Lancar'),
('104', 'Pendapatan yang diterima di muka', 'Hutang Lancar'),
('105', 'Hutang BBN', 'Hutang Lancar'),
('120', 'Hutang Jangka Panjang - Bank', 'Hutang Jangka Panjang'),
('130', 'Pendapatan Penjualan', 'Modal'),
('140', 'HPP', 'HPP'),
('2', 'Bank', 'Aktiva Lancar'),
('200', 'Biaya Administrasi dan Umum', 'Biaya Administrasi dan Umum'),
('21', 'Tanah', 'Aktiva Tak Berwujud'),
('22', 'Gedung', 'Aktiva Tak Berwujud'),
('23', 'Akumulasi Depresiasi Gedung', 'Aktiva Tak Berwujud'),
('24', 'Mebel', 'Aktiva Tak Berwujud'),
('25', 'Akumulasi Depresiasi Mebel', 'Aktiva Tak Berwujud'),
('250', 'Biaya Promosi', 'Biaya Pemasaran'),
('26', 'Elektronik', 'Aktiva Tak Berwujud'),
('27', 'Akumulasi Depresiasi  Elektronik', 'Aktiva Tak Berwujud'),
('28', 'Aktiva Tetap Lain', 'Aktiva Tak Berwujud'),
('29', 'Akumulasi Depresiasi  Aktiva Tetap Lain', 'Aktiva Tak Berwujud'),
('3', 'Investasi', 'Aktiva Lancar'),
('300', 'Pendapatan Bunga', 'Penghasilan di luar usaha'),
('301', 'Pendapatan Denda', 'Penghasilan di luar usaha'),
('350', 'Biaya Bunga', 'Biaya di luar usaha'),
('351', 'Aktiva Tetap', 'Biaya di luar usaha'),
('4', 'Piutang', 'Aktiva Lancar'),
('400', 'Rugi-Laba', 'Rugi-Laba'),
('5', 'Cadangan kerugian piutang', 'Aktiva Lancar'),
('6', 'Persediaan', 'Aktiva Lancar');

-- --------------------------------------------------------

--
-- Table structure for table `hrgbeli`
--

CREATE TABLE `hrgbeli` (
  `kd_hrgbeli` int(11) NOT NULL,
  `kd_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipe_produk` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_awal` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `nama_produk` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hargabeli` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrgbeli`
--

INSERT INTO `hrgbeli` (`kd_hrgbeli`, `kd_produk`, `id_supplier`, `nama_supplier`, `tipe_produk`, `tgl_awal`, `tgl_akhir`, `nama_produk`, `hargabeli`) VALUES
(1, 1, 0, 'AYU ATIYOSO', 'hotel', '2018-08-04 00:00:00', '2018-12-31 00:00:00', '', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `hrgjual`
--

CREATE TABLE `hrgjual` (
  `kd_hrgjual` int(11) NOT NULL,
  `kd_produk` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipe_produk` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_awal` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `nama_produk` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hargajual` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrgjual`
--

INSERT INTO `hrgjual` (`kd_hrgjual`, `kd_produk`, `id_customer`, `nama_customer`, `tipe_produk`, `tgl_awal`, `tgl_akhir`, `nama_produk`, `hargajual`) VALUES
(1, 22, 1, 'RUMAH TANGGA UNDIP', 'hotel', '2018-09-16 00:00:00', '2018-12-31 00:00:00', '', '104000.00');

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `no_hutang` int(11) NOT NULL,
  `no_po` int(11) NOT NULL,
  `tgl_po` datetime NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `tgl_jatuh_tempo` datetime NOT NULL,
  `jml_hutang` decimal(20,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_lunas` datetime NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `kredit` decimal(20,2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang`
--

INSERT INTO `hutang` (`no_hutang`, `no_po`, `tgl_po`, `id_supplier`, `nama_supplier`, `tgl_jatuh_tempo`, `jml_hutang`, `status`, `tgl_lunas`, `debit`, `kredit`, `username`, `tgl_transaksi`) VALUES
(51, 3, '2018-09-16 00:00:00', 1, 'NUSANTARA TOUR', '2018-10-16 00:00:00', '100000.00', '', '0000-00-00 00:00:00', '0.00', '100000.00', 'yosua', '2018-09-17 00:02:25'),
(52, 8, '2018-09-16 00:00:00', 1, 'NUSANTARA TOUR', '2018-10-16 00:00:00', '10000.00', '', '0000-00-00 00:00:00', '0.00', '10000.00', 'yosua', '2018-09-17 00:05:59'),
(59, 7, '2018-09-16 00:00:00', 1, 'NUSANTARA TOUR', '2018-10-16 00:00:00', '40000.00', '', '0000-00-00 00:00:00', '0.00', '40000.00', 'yosua', '2018-09-17 01:05:28'),
(70, 12, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '100000.00', '', '0000-00-00 00:00:00', '0.00', '100000.00', 'yosua', '2018-09-17 01:47:50'),
(78, 13, '2018-09-17 00:00:00', 1, '', '2018-10-17 00:00:00', '50000.00', '', '0000-00-00 00:00:00', '0.00', '50000.00', 'yosua', '2018-09-17 08:32:26'),
(79, 2, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '80000.00', '', '0000-00-00 00:00:00', '0.00', '80000.00', 'yosua', '2018-09-18 12:08:59'),
(80, 11, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '100000.00', '', '0000-00-00 00:00:00', '0.00', '100000.00', 'yosua', '2018-09-18 15:47:32'),
(101, 10, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '2018-09-20 23:32:59'),
(102, 9, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '101100.00', '', '0000-00-00 00:00:00', '0.00', '101100.00', 'yosua', '2018-09-21 01:46:50'),
(103, 1, '2018-09-16 00:00:00', 1, '', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '2018-09-21 01:52:43'),
(104, 15, '2018-09-20 00:00:00', 0, '', '2018-10-20 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '2018-09-21 01:53:02'),
(113, 16, '2018-09-20 00:00:00', 1, 'NUSANTARA TOUR', '2018-10-20 00:00:00', '3000.00', '', '0000-00-00 00:00:00', '0.00', '3000.00', 'yosua', '2018-09-21 03:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `no_kas` int(11) NOT NULL,
  `no_po` int(11) NOT NULL,
  `no_penjualan` int(11) NOT NULL,
  `no_hutang` int(11) NOT NULL,
  `no_piutang` int(11) NOT NULL,
  `kd_beban` varchar(10) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_keluar` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `kredit` decimal(20,2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masterbandara`
--

CREATE TABLE `masterbandara` (
  `id_bandara` int(11) NOT NULL,
  `kode` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `nama` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kode_kota` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `nama_kota` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `nama_negara` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kode_negara` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `timezone` varchar(8) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lat` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lon` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL,
  `jumlah_bandara` int(11) DEFAULT NULL,
  `kota` enum('true','false') COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masterbandara`
--

INSERT INTO `masterbandara` (`id_bandara`, `kode`, `nama`, `kode_kota`, `nama_kota`, `nama_negara`, `kode_negara`, `timezone`, `lat`, `lon`, `jumlah_bandara`, `kota`) VALUES
(41, 'AHI', 'Amahai Airport', 'AHI', 'Amahai', 'INDONESIA', 'ID', '-100', '0', '0', 1, 'true'),
(42, 'AMI', 'Selaparang Airport', 'AMI', 'Mataram', 'INDONESIA', 'ID', '8', '-8.560708', '116.094656', 1, 'true'),
(43, 'AMQ', 'Pattimura Arpt', 'AMQ', 'Ambon', 'INDONESIA', 'ID', '9', '-3.710264', '128.089136', 1, 'true'),
(44, 'BDJ', 'Sjamsudin Noor Arpt', 'BDJ', 'Banjarmasin', 'INDONESIA', 'ID', '8', '-3.442356', '114.762553', 1, 'true'),
(45, 'BDO', 'Husein Sastranegara Arpt', 'BDO', 'Bandung', 'INDONESIA', 'ID', '7', '-6.900625', '107.576294', 1, 'true'),
(46, 'BIK', 'Mokmer Arpt', 'BIK', 'Biak', 'INDONESIA', 'ID', '9', '-1.190017', '136.107997', 1, 'true'),
(47, 'BKS', 'Padangkemiling Arpt', 'BKS', 'Bengkulu', 'INDONESIA', 'ID', '7', '-3.8637', '102.339036', 1, 'true'),
(48, 'BPN', 'Sepingan Arpt', 'BPN', 'Balikpapan', 'INDONESIA', 'ID', '8', '-1.268272', '116.894478', 1, 'true'),
(49, 'BTH', 'Hang Nadim Arpt', 'BTH', 'Batam', 'INDONESIA', 'ID', '7', '1.121028', '104.118753', 1, 'true'),
(50, 'BTJ', 'Blang Bintang Arpt', 'BTJ', 'Banda Aceh', 'INDONESIA', 'ID', '7', '5.523522', '95.420372', 1, 'true'),
(51, 'CBN', 'Penggung Arpt', 'CBN', 'Cirebon', 'INDONESIA', 'ID', '7', '-6.756144', '108.539672', 1, 'true'),
(52, 'CXP', 'Tunggul Wulung Arpt', 'CXP', 'Cilacap', 'INDONESIA', 'ID', '7', '-7.645056', '109.033911', 1, 'true'),
(53, 'DJB', 'Sultan Taha Syarifudin Arpt', 'DJB', 'Jambi', 'INDONESIA', 'ID', '7', '-1.638017', '103.644378', 1, 'true'),
(54, 'DJJ', 'Sentani Arpt', 'DJJ', 'Jayapura', 'INDONESIA', 'ID', '9', '-2.576953', '140.516372', 1, 'true'),
(55, 'DPS', 'Ngurah Rai Arpt', 'DPS', 'Denpasar Bali', 'INDONESIA', 'ID', '8', '-8.748169', '115.167172', 1, 'true'),
(56, 'GNS', 'Gunungsitoli Arpt', 'GNS', 'Gunungsitoli', 'INDONESIA', 'ID', '7', '1.166381', '97.704681', 1, 'true'),
(57, 'HLP', 'Halim Perdana Kusuma Arpt', 'JKT', 'Jakarta', 'INDONESIA', 'ID', '7', '-6.26661', '106.891', 2, ''),
(58, 'CGK', 'Soekarno Hatta Intl', 'JKT', 'Jakarta', 'INDONESIA', 'ID', '7', '-6.125567', '106.655897', 2, ''),
(59, 'JOG', 'Adisutjipto Arpt', 'JOG', 'Yogyakarta', 'INDONESIA', 'ID', '7', '-7.788181', '110.431758', 1, 'true'),
(60, 'MDC', 'Samratulang Arpt', 'MDC', 'Manado', 'INDONESIA', 'ID', '8', '1.549447', '124.925878', 1, 'true'),
(61, 'MES', 'Polonia Arpt', 'MES', 'Medan', 'INDONESIA', 'ID', '7', '3.558056', '98.671722', 1, 'true'),
(62, 'MJU', 'Mamuju Arpt', 'MJU', 'Mamuju', 'INDONESIA', 'ID', '9', '-2.5', '118.833336', 1, 'true'),
(63, 'MKW', 'Rendani Arpt', 'MKW', 'Manokwari', 'INDONESIA', 'ID', '9', '-0.891833', '134.049183', 1, 'true'),
(64, 'MLG', 'Malang Arpt', 'MLG', 'Malang', 'INDONESIA', 'ID', '7', '-7.926556', '112.714514', 1, 'true'),
(65, 'NAM', 'Namlea Arpt', 'NAM', 'Namlea', 'INDONESIA', 'ID', '-100', '0', '0', 1, 'true'),
(66, 'PDG', 'Tabing Arpt', 'PDG', 'Padang', 'INDONESIA', 'ID', '7', '-0.874989', '100.351881', 1, 'true'),
(67, 'PKN', 'Pangkalanbuun Arpt', 'PKN', 'Pangkalanbun', 'INDONESIA', 'ID', '7', '-2.705197', '111.673208', 1, 'true'),
(68, 'PKU', 'Simpang Tiga Arpt', 'PKU', 'Pekanbaru', 'INDONESIA', 'ID', '7', '0.460786', '101.444539', 1, 'true'),
(69, 'PLM', 'Mahmud Badaruddin Li Arpt', 'PLM', 'Palembang', 'INDONESIA', 'ID', '7', '-2.89825', '104.699903', 1, 'true'),
(70, 'PLW', 'Mutiara Arpt', 'PLW', 'Palu', 'INDONESIA', 'ID', '8', '-0.918542', '119.909642', 1, 'true'),
(71, 'PNK', 'Supadio International Arpt', 'PNK', 'Pontianak', 'INDONESIA', 'ID', '7', '-0.150711', '109.403892', 1, 'true'),
(72, 'SOC', 'Adi Sumarno Arpt', 'SOC', 'Solo', 'INDONESIA', 'ID', '7', '-7.516089', '110.756892', 1, 'true'),
(73, 'SOQ', 'Jefman Arpt', 'SOQ', 'Sorong', 'INDONESIA', 'ID', '9', '-0.926358', '131.121194', 1, 'true'),
(74, 'SRG', 'Ahmad Yani Arpt', 'SRG', 'Semarang', 'INDONESIA', 'ID', '7', '-6.971447', '110.374122', 1, 'true'),
(75, 'SUB', 'Juanda Arpt', 'SUB', 'Surabaya', 'INDONESIA', 'ID', '7', '-7.379831', '112.786858', 1, 'true'),
(76, 'TIM', 'Timika Arpt', 'TIM', 'Timika', 'INDONESIA', 'ID', '9', '-4.528275', '136.887375', 1, 'true'),
(77, 'TJQ', 'Bulutumbang Arpt', 'TJQ', 'Tanjung Pandan', 'INDONESIA', 'ID', '7', '-2.745722', '107.754917', 1, 'true'),
(78, 'TKG', 'Branti Arpt', 'TKG', 'Bandar Lampung', 'INDONESIA', 'ID', '7', '-5.242339', '105.178939', 1, 'true'),
(79, 'TRK', 'Tarakan Arpt', 'TRK', 'Tarakan', 'INDONESIA', 'ID', '8', '3.326694', '117.565569', 1, 'true'),
(80, 'UPG', 'Hasanudin Arpt', 'UPG', 'Ujung Pandang', 'INDONESIA', 'ID', '8', '-5.061631', '119.554042', 1, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `masterhotel`
--

CREATE TABLE `masterhotel` (
  `id_hotel` varchar(10) NOT NULL,
  `nama_hotel` varchar(15) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterhotel`
--

INSERT INTO `masterhotel` (`id_hotel`, `nama_hotel`, `nama_kota`) VALUES
('AST01', 'ASTON', ''),
('GU01', 'GUMAYA', '');

-- --------------------------------------------------------

--
-- Table structure for table `masterkereta`
--

CREATE TABLE `masterkereta` (
  `id_kereta` varchar(10) NOT NULL,
  `kode_kereta` varchar(10) NOT NULL,
  `nama_kereta` varchar(15) NOT NULL,
  `Kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterkereta`
--

INSERT INTO `masterkereta` (`id_kereta`, `kode_kereta`, `nama_kereta`, `Kelas`) VALUES
('1', 'SIN', 'ARGO SINDORO', '1,2,3'),
('2', 'GUM', 'GUMARANG', '1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `masterpesawat`
--

CREATE TABLE `masterpesawat` (
  `id_maskapai` int(10) NOT NULL,
  `kode_maskapai` varchar(10) NOT NULL,
  `nama_maskapai` varchar(25) NOT NULL,
  `kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterpesawat`
--

INSERT INTO `masterpesawat` (`id_maskapai`, `kode_maskapai`, `nama_maskapai`, `kelas`) VALUES
(1, 'GI', 'GARUDA INDONESIA', '1,2,3'),
(2, 'CA', 'CITILINK AIRLINES', '1,2,3'),
(3, 'AA', 'AIR ASIA', '1,2,3'),
(4, 'LA', 'LION AIR', '1,2,3'),
(5, 'BA', 'BATIK AIR', '1,2,3'),
(6, 'WA', 'WINGS AIR', '1,2,3'),
(7, 'TA', 'TIGER AIR', '1,2,3'),
(8, 'SA', 'SRIWIJAYA AIR', '1,2,3');

-- --------------------------------------------------------

--
-- Table structure for table `masterstasiun`
--

CREATE TABLE `masterstasiun` (
  `id_stasiun` int(11) NOT NULL,
  `nama_stasiun` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `daerah_operasi` varchar(300) NOT NULL,
  `kode_stasiun` varchar(5) NOT NULL,
  `ketinggian` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masterstasiun`
--

INSERT INTO `masterstasiun` (`id_stasiun`, `nama_stasiun`, `provinsi`, `daerah_operasi`, `kode_stasiun`, `ketinggian`) VALUES
(1, 'Aekloba', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'AKB', '-'),
(2, 'Airtuba', 'Sumatera Selatan', 'Divre III Palembang', 'AER', '+43 m'),
(3, 'Alastua', 'Jawa Tengah', 'Daop IV Semarang', 'ATA', '+6 m'),
(4, 'Ancol', 'DKI Jakarta', 'Daop I Jakarta', 'AC', '-'),
(5, 'Andir', 'Jawa Barat', 'Daop II Bandung', 'AND', '+730 m'),
(6, 'Angke', 'DKI Jakarta', 'Daop I Jakarta', 'AK', '-'),
(7, 'Araskabu', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'ARB', '+7 m'),
(8, 'Arjawinangun', 'Jawa Barat', 'Daop III Cirebon', 'AWN', '+8 m'),
(9, 'Arjasa', 'Jawa Timur', 'Daop IX Jember', 'AJ', '+141 m'),
(10, 'Babadan', 'Jawa Timur', 'Daop VII Madiun', 'BBD', '+63 m'),
(11, 'Babakan', 'Jawa Barat', 'Daop III Cirebon', 'BBK', '+12 m'),
(12, 'Babat', 'Jawa Timur', 'Daop VIII Surabaya', 'BBT', '+7 m'),
(13, 'Bagor', 'Jawa Timur', 'Daop VII Madiun', 'BGR', '+58 m'),
(14, 'Bajalinggei', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BJL', '-'),
(15, 'Bamban', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BMB', '-'),
(16, 'Bandar Khalipah', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BAP', '+16,13 m'),
(17, 'Bandar Tinggi', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BDT', '-'),
(18, 'Banjar', 'Jawa Barat', 'Daop II Bandung', 'BJR', '+32 m'),
(19, 'Banjarkemantren', 'Jawa Timur', 'Daop VIII Surabaya', 'BJK', '+5 m'),
(20, 'Banjarsari', 'Sumatera Selatan', 'Divre III Palembang', 'BJS', '-'),
(21, 'Bandung', 'Jawa Barat', 'Daop II Bandung', 'BD', '+709 m'),
(22, 'Bangil', 'Jawa Timur', 'Daop VIII Surabaya', 'BG', '+9 m'),
(23, 'Bangoduwa', 'Jawa Barat', 'Daop III Cirebon', 'BDW', '+8 m'),
(24, 'Bangsalsari', 'Jawa Timur', 'Daop IX Jember', 'BSS', '+49 m'),
(25, 'Banyuwangi Baru', 'Jawa Timur', 'Daop IX Jember', 'BW', '+7 m'),
(26, 'Barat', 'Jawa Timur', 'Daop VII Madiun', 'BAT', '+70 m'),
(27, 'Baron', 'Jawa Timur', 'Daop VII Madiun', 'BRN', '+46 m'),
(28, 'Batang', 'Jawa Tengah', 'Daop IV Semarang', 'BTG', '+6 m'),
(29, 'Batang Baru', 'Jawa Tengah', 'Daop IV Semarang', 'BTB', '+6 m'),
(30, 'Batang Kuis', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BTK', '-'),
(31, 'Batuceper', 'Banten', 'Daop I Jakarta', 'BPR', '-'),
(32, 'Baturaja', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'BTA', '-'),
(33, 'Batutabal', 'Sumatera Barat', 'Divre II Sumatera Barat', 'BTL', '+370 m'),
(34, 'Batutulis', 'Jawa Barat', 'Daop I Jakarta', 'BTT', '+299 m'),
(35, 'Bayeman', 'Jawa Timur', 'Daop IX Jember', 'BYM', '+6 m'),
(36, 'Bekasi', 'Jawa Barat', 'Daop I Jakarta', 'BKS', '+19 m'),
(37, 'Bekri', 'Lampung', 'Divre IV Tanjungkarang', 'BKI', '+48 m'),
(38, 'Belatung', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'BLT', '+38 m'),
(39, 'Belawan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BLW', '-'),
(40, 'Belimbingpendopo', 'Sumatera Selatan', 'Divre III Palembang', 'BIB', '+20 m'),
(41, 'Benowo', 'Jawa Timur', 'Daop VIII Surabaya', 'BNW', '+3 m'),
(42, 'Benteng', 'Jawa Timur', 'Daop VIII Surabaya', 'BET', '+4 m'),
(43, 'Binjai', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'BIJ', '-'),
(44, 'Blambangan Pagar', 'Lampung', 'Divre IV Tanjungkarang', 'BBA', '+44 m'),
(45, 'Blambangan Umpu', 'Lampung', 'Divre IV Tanjungkarang', 'BBU', '+51 m'),
(46, 'Blimbing', 'Jawa Timur', 'Daop VIII Surabaya', 'BMG', '+460 m'),
(47, 'Blimbing', 'Sumatera Selatan', 'Divre III Palembang', 'BIB', '-'),
(48, 'Blitar', 'Jawa Timur', 'Daop VII Madiun', 'BL', '+167 m'),
(49, 'Bojonegoro', 'Jawa Timur', 'VIII Surabaya', 'BJ', '+15 m'),
(50, 'Bojong', 'Jawa Barat', 'Daop II Bandung', 'BJG', '+124 m'),
(51, 'Bojonggede', 'Jawa Barat', 'Daop I Jakarta', 'BJD', '+140 m'),
(52, 'Bojong Indah', 'DKI Jakarta', 'Daop I Jakarta', 'BOI', '+16 m'),
(53, 'Bogor', 'Jawa Barat', 'Daop I Jakarta', 'BOO', '+246 m'),
(54, 'Boharan', 'Jawa Timur', 'Daop VIII Surabaya', 'BH', '+10 m'),
(55, 'Bowerno', 'Jawa Timur', 'Daop VIII Surabaya', 'BWO', '+21 m'),
(56, 'Branti', 'Lampung', 'Divre IV Tanjungkarang', 'BTI', '+87 m'),
(57, 'Brambanan', 'Jawa Tengah', 'Daop VI Yogyakarta', 'BBN', '+146 m'),
(58, 'Brebes', 'Jawa Tengah', 'Daop III Cirebon', 'BB', '+4 m'),
(59, 'Buaran', 'DKI Jakarta', 'Daop I Jakarta', 'BUA', '+15 m'),
(60, 'Buduran', 'Jawa Timur', 'Daop VIII Surabaya', 'BDU', '+5 m'),
(61, 'Bukit Putus', 'Sumatera Barat', 'Divre II Sumatera Barat', 'BKP', '+8 m'),
(62, 'Bumiayu', 'Jawa Tengah', 'Daop V Purwokerto', 'BMA', '+236 m'),
(63, 'Bumiwaluya', 'Jawa Barat', 'Daop II Bandung', 'BMW', '+541 m'),
(64, 'Bungamas', 'Sumatera Selatan', 'Divre III Palembang', 'BGM', '+82 m'),
(65, 'Butuh', 'Jawa Tengah', 'Daop V Purwokerto', 'BTH', '+10 m'),
(66, 'Cakung', 'DKI Jakarta', 'Daop I Jakarta', 'CUK', '+11 m'),
(67, 'Cangkring', 'Jawa Barat', 'Daop III Cirebon', 'CNK', '+7 m'),
(68, 'Caruban', 'Jawa Timur', 'Daop VII Madiun', 'CRB', '+74 m'),
(69, 'Catang', 'Banten', 'Daop I Jakarta', 'CT', '+17 m'),
(70, 'Cawang', 'DKI Jakarta', 'Daop I Jakarta', 'CWG', '+13 m'),
(71, 'Cempaka', 'Lampung', 'Divre IV Tanjungkarang', 'CEP', '+59 m'),
(72, 'Ceper', 'Jawa Tengah', 'Daop VI Yogyakarta', 'CE', '+133 m'),
(73, 'Cepu', 'Jawa Tengah', 'Daop IV Semarang', 'CU', '+28 m'),
(74, 'Cerme', 'Jawa Timur', 'Daop VIII Surabaya', 'CME', '+4 m'),
(75, 'Ciamis', 'Jawa Barat', 'Daop II Bandung', 'CI', '+199 m'),
(76, 'Cianjur', 'Jawa Barat', 'Daop II Bandung', 'CJ', '+439 m'),
(77, 'Ciawi', 'Jawa Barat', 'Daop II Bandung', 'CAW', '+510 m'),
(78, 'Cibadak', 'Jawa Barat', 'Daop I Jakarta', 'CBD', '+380 m'),
(79, 'Cibatu', 'Jawa Barat', 'Daop II Bandung', 'CB', '+612 m'),
(80, 'Cibeber', 'Jawa Barat', 'Daop II Bandung', 'CBB', '+456 m'),
(81, 'Cibinong', 'Jawa Barat', 'Daop I Jakarta', 'CBG', '+121 m'),
(82, 'Cibitung', 'Jawa Barat', 'Daop I Jakarta', 'CBT', '-'),
(83, 'Cibungur', 'Jawa Barat', 'Daop II Bandung', 'CBR', '+77 m'),
(84, 'Cicalengka', 'Jawa Barat', 'Daop II Bandung', 'CCL', '+689 m'),
(85, 'Cicayur', 'Banten', 'Daop I Jakarta', 'CCY', '-'),
(86, 'Cicurug', 'Jawa Barat', 'Daop I Jakarta', 'CCR', '+478 m'),
(87, 'Ciganea', 'Jawa Barat', 'Daop II Bandung', 'CA', '-'),
(88, 'Cigombong', 'Jawa Barat', 'Daop I Jakarta', 'CGB', '+499 m'),
(89, 'Cijambe', 'Jawa Barat', 'Daop I Jakarta', 'CJB', '+438 m'),
(90, 'Cikadongdong', 'Jawa Barat', 'Daop II Bandung', 'CD', '+408 m'),
(91, 'Cikampek', 'Jawa Barat', 'Daop I Jakarta', 'CKP', '+46 m'),
(92, 'Cikaum', 'Jawa Barat', 'Daop III Cirebon', 'CKM', '+35 m'),
(93, 'Cikarang', 'Jawa Barat', 'Daop I Jakarta', 'CKR', '+18 m'),
(94, 'Cikeusal', 'Banten', 'Daop I Jakarta', 'CKL', '+25 m'),
(95, 'Cikini', 'DKI Jakarta', 'Daop I Jakarta', 'CKI', '+20 m'),
(96, 'Cikoya', 'Banten', 'Daop I Jakarta', 'CKY', '+51 m'),
(97, 'Cikudapateuh', 'Jawa Barat', 'Daop II Bandung', 'CTH', '+691 m'),
(98, 'Cilaku', 'Jawa Barat', 'Daop II Bandung', 'CLK', '+457 m'),
(99, 'Cilame', 'Jawa Barat', 'Daop II Bandung', 'CLE', '+635 m'),
(100, 'Cilacap', 'Jawa Tengah', 'Daop V Purwokerto', 'CP', '+8 m'),
(101, 'Cilebut', 'Jawa Barat', 'Daop I Jakarta', 'CLT', '+169 m'),
(102, 'Ciledug', 'Jawa Barat', 'Daop III Cirebon', 'CLD', '+16 m'),
(103, 'Cilejit', 'Jawa Barat', 'Daop I Jakarta', 'CJT', '+53 m'),
(104, 'Cilegeh', 'Jawa Barat', 'Daop III Cirebon', 'CLH', '+18 m'),
(105, 'Cilegon', 'Banten', 'Daop I Jakarta', 'CLG', '+14 m'),
(106, 'Cimahi', 'Jawa Barat', 'Daop II Bandung', 'CMI', '+732 m'),
(107, 'Cimekar', 'Jawa Barat', 'Daop II Bandung', 'CMK', '+670 m'),
(108, 'Cimindi', 'Jawa Barat', 'Daop II Bandung', 'CMD', '+736 m'),
(109, 'Cipari', 'Jawa Tengah', 'Daop V Purwokerto', 'CPI', '+11 m'),
(110, 'Cipatat', 'Jawa Barat', 'Daop II Bandung', 'CPT', '+387 m'),
(111, 'Cipeuyeum', 'Jawa Barat', 'Daop II Bandung', 'CPY', '-'),
(112, 'Cipeundeuy', 'Jawa Barat', 'Daop II Bandung', 'CPD', '+772 m'),
(113, 'Cipinang', 'DKI Jakarta', 'Daop I Jakarta', 'CPN', '+16 m'),
(114, 'Cipunegara', 'Jawa Barat', 'Daop III Cirebon', 'CRA', '+21 m'),
(115, 'Cirahayu', 'Jawa Barat', 'Daop II Bandung', 'CAA', '+525 m'),
(116, 'Ciranjang', 'Jawa Barat', 'Daop II Bandung', 'CRJ', '+262 m'),
(117, 'Cirebon', 'Jawa Barat', 'Daop III Cirebon', 'CN', '+4 m'),
(118, 'Cirebon Prujakan', 'Jawa Barat', 'Daop III Cirebon', 'CNP', '+4 m'),
(119, 'Cireungas', 'Jawa Barat', 'Daop II Bandung', 'CRH', '+588 m'),
(120, 'Ciroyom', 'Jawa Barat', 'Daop II Bandung', 'CIR', '+709 m'),
(121, 'Cisaat', 'Jawa Barat', 'Daop I Jakarta', 'CSA', '+584 m'),
(122, 'Cisauk', 'Banten', 'Daop I Jakarta', 'CSK', '+33 m'),
(123, 'Cisomang', 'Jawa Barat', 'Daop II Bandung', 'CG', '+385 m'),
(124, 'Citayam', 'Jawa Barat', 'Daop I Jakarta', 'CTA', '-'),
(125, 'Citeras', 'Banten', 'Daop I Jakarta', 'CTR', '+48 m'),
(126, 'Comal', 'Jawa Tengah', 'Daop IV Semarang', 'CO', '-'),
(127, 'Curahmalang', 'Jawa Timur', 'Daop VII Madiun', 'CRM', '+25 m'),
(128, 'Daru', 'Banten', 'Daop I Jakarta', 'DAR', '+51 m'),
(129, 'Dawuan', 'Jawa Barat', 'Daop I Jakarta', 'DWN', '-'),
(130, 'Delanggu', 'Jawa Tengah', 'Daop VI Yogyakarta', 'DL', '+133 m'),
(131, 'Depok', 'Jawa Barat', 'Daop I Jakarta', 'DP', '+93 m'),
(132, 'Depok Baru', 'Jawa Barat', 'Daop I Jakarta', 'DPB', '+93 m'),
(133, 'Dolokmerangir', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'DMR', '-'),
(134, 'Doplang', 'Jawa Tengah', 'Daop IV Semarang', 'DPL', '-'),
(135, 'Duduk', 'Jawa Timur', 'Daop VIII Surabaya', 'DD', '+2 m'),
(136, 'Duren Kalibata', 'DKI Jakarta', 'Daop I Jakarta', 'DRN', '+26 m'),
(137, 'Duri', 'DKI Jakarta', 'Daop I Jakarta', 'DU', '+20 m'),
(138, 'Dusun', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'DSU', '-'),
(139, 'Gambir', 'DKI Jakarta', 'Daop I Jakarta', 'GMR', '+16 m'),
(140, 'Gambringan', 'Jawa Tengah', 'Daop IV Semarang', 'GBN', '+40 m'),
(141, 'Gandasoli', 'Jawa Barat', 'Daop II Bandung', 'GDS', '+580 m'),
(142, 'Gandrungmangun', 'Jawa Tengah', 'Daop V Purwokerto', 'GDM', '+15 m'),
(143, 'Gang Sentiong', 'DKI Jakarta', 'Daop I Jakarta', 'GST', '+5 m'),
(144, 'Garahan', 'Jawa Timur', 'Daop IX Jember', 'GN', '+589 m'),
(145, 'Garum', 'Jawa Timur', 'Daop VIII Surabaya', 'GRM', '+244 m'),
(146, 'Gawok', 'Jawa Tengah', 'Daop VI Yogyakarta', 'GW', '+118 m'),
(147, 'Gedangan', 'Jawa Timur', 'Daop VIII Surabaya', 'GDG', '+4 m'),
(148, 'Gedebage', 'Jawa Barat', 'Daop II Bandung', 'GDB', '+672 m'),
(149, 'Gedungratu', 'Lampung', 'Divre IV Tanjungkarang', 'GDR', '+117 m'),
(150, 'Gembong', 'Jawa Timur', 'Daop VIII Surabaya', 'GEB', '+6 m'),
(151, 'Geneng', 'Jawa Timur', 'Daop VII Madiun', 'GG', '+53 m'),
(152, 'Giham', 'Lampung', 'Divre IV Tanjungkarang', 'GHM', '-'),
(153, 'Gilas', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'GLS', '-'),
(154, 'Glenmore', 'Jawa Timur', 'Daop IX Jember', 'GLM', '+342 m'),
(155, 'Gombong', 'Jawa Tengah', 'Daop V Purwokerto', 'GB', '+18 m'),
(156, 'Gondangdia', 'DKI Jakarta', 'Daop I Jakarta', 'GDD', '+17 m'),
(157, 'Goprak', 'Jawa Tengah', 'Daop VI Yogyakarta', 'GPK', '+74 m'),
(158, 'Grati', 'Jawa Timur', 'Daop IX Jember', 'GI', '+16 m'),
(159, 'Gubug', 'Jawa Tengah', 'Daop IV Semarang', 'GUB', '-'),
(160, 'Gumilir', 'Jawa Tengah', 'Daop V Purwokerto', 'GM', '+7 m'),
(161, 'Gundih', 'Jawa Tengah', 'Daop IV Semarang', 'GD', '+54 m'),
(162, 'Gunungmegang', 'Sumatera Selatan', 'Divre III Palembang', 'GNM', '-'),
(163, 'Hajipemanggilan', 'Lampung', 'Divre IV Tanjungkarang', 'HJP', '-'),
(164, 'Haurgeulis', 'Jawa Barat', 'Daop III Cirebon', 'HGL', '+13 m'),
(165, 'Haurpugur', 'Jawa Barat', 'Daop II Bandung', 'HRP', '+689 m'),
(166, 'Hengelo', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'HL', '+27,38 m'),
(167, 'Ijo', 'Jawa Tengah', 'Daop V Purwokerto', 'IJ', '+25 m'),
(168, 'Indarung', 'Sumatera Barat', 'Divre II Sumatera Barat', 'IDA', '-'),
(169, 'Indihiang', 'Jawa Barat', 'Daop II Bandung', 'IH', '+384 m'),
(170, 'Indro', 'Jawa Timur', 'Daop VIII Surabaya', 'IDO', '+8 m'),
(171, 'Indralaya', 'Sumatera Selatan', 'Divre III Palembang', 'IDY', ''),
(172, 'Jakarta Gudang', 'DKI Jakarta', 'Daop I Jakarta', 'JAKG', '-'),
(173, 'Jakarta Kota', 'DKI Jakarta', 'Daop I Jakarta', 'JAKK', '+4 m'),
(174, 'Jambon', 'Jawa Tengah', 'Daop IV Semarang', 'JBN', '+42 m'),
(175, 'Jatibarang', 'Jawa Barat', 'Daop III Cirebon', 'JTB', '+8 m'),
(176, 'Jatinegara', 'DKI Jakarta', 'Daop I Jakarta', 'JNG', '+16 m'),
(177, 'Jatiroto', 'Jawa Timur', 'Daop IX Jember', 'JTR', '+29 m'),
(178, 'Jayakarta', 'DKI Jakarta', 'Daop I Jakarta', 'JYK', '-'),
(179, 'Jember', 'Jawa Timur', 'Daop IX Jember', 'JR', '+89 m'),
(180, 'Jemursari', 'Jawa Timur', 'Daop VIII Surabaya', 'JSR', '+5 m'),
(181, 'Jenar', 'Jawa Tengah', 'Daop VI Yogyakarta', 'JN', '+18 m'),
(182, 'Jerakah', 'Jawa Tengah', 'Daop IV Semarang', 'JRK', '+3 m'),
(183, 'Jeruklegi', 'Jawa Tengah', 'Daop V Purwokerto', 'JRL', '+10 m'),
(184, 'Jombang', 'Jawa Timur', 'Daop VII Madiun', 'JG', '+44 m'),
(185, 'Juanda', 'DKI Jakarta', 'Daop I Jakarta', 'JUA', '+16 m'),
(186, 'Jurangmangu', 'Banten', 'Daop I Jakarta', 'JMG', '+25 m'),
(187, 'Kacang', 'Sumatera Barat', 'Divre II Sumatera Barat', 'KCN', '+369 m'),
(188, 'Kadokangabus', 'Jawa Barat', 'Daop III Cirebon', 'KAB', '+15 m'),
(189, 'Kalibalangan', 'Lampung', 'Divre IV Tanjungkarang', 'KAG', '-'),
(190, 'Kalibaru', 'Jawa Timur', 'Daop IX Jember', 'KBR', '+428 m'),
(191, 'Kalibodri', 'Jawa Tengah', 'Daop IV Semarang', 'KBD', '+9 m'),
(192, 'Kalideres', 'DKI Jakarta', 'Daop I Jakarta', 'KDS', '+7 m'),
(193, 'Kalimas', 'Jawa Timur', 'Daop VIII Surabaya', 'KLM', '+4 m'),
(194, 'Kalioso', 'Jawa Tengah', 'Daop VI Yogyakarta', 'KO', '+117 m'),
(195, 'Kalisat', 'Jawa Timur', 'Daop IX Jember', 'KLT', '+265 m'),
(196, 'Kalisetail', 'Jawa Timur', 'Daop IX Jember', 'KLS', '+272 m'),
(197, 'Kalitidu', 'Jawa Timur', 'Daop VIII Surabaya', 'KIT', '+24 m'),
(198, 'Kaliwungu', 'Jawa Tengah', 'Daop IV Semarang', 'KLN', '+4 m'),
(199, 'Kampung Bandan', 'DKI Jakarta', 'Daop I Jakarta', 'Kpb', '+2 m'),
(200, 'Kandangampat', 'Sumatera Barat', 'Divre II Sumatera Barat', 'KDP', '-'),
(201, 'Kandangan', 'Jawa Timur', 'Daop VIII Surabaya', 'KDA', '+2 m'),
(202, 'Kapas', 'Jawa Timur', 'Daop VIII Surabaya', 'KPS', '+20 m'),
(203, 'Kapuan', 'Jawa Tengah', 'Daop IV Semarang', 'KPA', '+37 m'),
(204, 'Karangasem', 'Jawa Timur', 'Daop IX Jember', 'KNE', '+82 m'),
(205, 'Karanganyar', 'Jawa Tengah', 'Daop V Purwokerto', 'KA', '+14 m'),
(206, 'Karangantu', 'Banten', 'Daop I Jakarta', 'KRA', '+3 m'),
(207, 'Karangjati', 'Jawa Tengah', 'Daop IV Semarang', 'KGT', '+23 m'),
(208, 'Karanggandul', 'Jawa Tengah', 'Daop V Purwokerto', 'KGD', '+142 m'),
(209, 'Karangkandri', 'Jawa Tengah', 'Daop V Purwokerto', 'KKD', '+8 m'),
(210, 'Karangpucung', 'Jawa Barat', 'Daop II Bandun', 'KNP', '+45 m'),
(211, 'Karangsari', 'Jawa Barat', 'Daop II Bandun', 'KRAI', '+617 m'),
(212, 'Karangsari', 'Jawa Tengah', 'Daop V Purwokerto', 'KRR', '+233 m'),
(213, 'Karangsono', 'Jawa Tengah', 'Daop IV Semarang', 'KSO', '-'),
(214, 'Karangtalun II', 'Jawa Tengah', 'Daop V Purwokerto', 'KRL', '+6,75 m'),
(215, 'Karang Tengah', 'Jawa Barat', 'Daop I Jakarta', 'KE', '+477 m'),
(216, 'Karawang', 'Jawa Barat', 'Daop I Jakarta', 'KW', '+16 m'),
(217, 'Karet', 'DKI Jakarta', 'Daop I Jakarta', 'KAT', '+11 m'),
(218, 'Kasugihan', 'Jawa Tengah', 'Daop V Purwokerto', 'KH', '+9 m'),
(219, 'Kawunganten', 'Jawa Tengah', 'Daop V Purwokerto', 'KWG', '+11 m'),
(220, 'Kayutanam', 'Sumatera Barat', 'Divre II Sumatera Barat', 'KTN', '+144 m'),
(221, 'Kebayoran', 'DKI Jakarta', 'Daop I Jakarta', 'KBY', '+4 m'),
(222, 'Kebasen', 'Jawa Tengah', 'Daop V Purwokerto', 'KBS', '+16 m'),
(223, 'Kebonromo', 'Jawa Tengah', 'Daop VI Yogyakarta', 'KRO', '+86 m'),
(224, 'Kebumen', 'Jawa Tengah', 'Daop V Purwokerto', 'KM', '+21 m'),
(225, 'Kedinding', 'Jawa Timur', 'Daop VIII Surabaya', 'KDN', '+13 m'),
(226, 'Kediri', 'Jawa Timur', 'Daop VII Madiun', 'KD', '+68 m'),
(227, 'Kedungbanteng', 'Jawa Tengah', 'Daop VI Yogyakarta', 'KDB', '+85 m'),
(228, 'Kedungjati', 'Jawa Tengah', 'Daop IV Semarang', 'KEJ', '+36 m'),
(229, 'Kedunggalar', 'Jawa Timur', 'Daop VII Madiun', 'KG', '+75 m'),
(230, 'Kedunggedeh', 'Jawa Barat', 'Daop I Jakarta', 'KDH', '+14 m'),
(231, 'Kemayoran', 'DKI Jakarta', 'Daop I Jakarta', 'KMO', '+4 m'),
(232, 'Kemiri', 'Jawa Tengah', 'Daop VI Yogyakarta', 'KMR', '+98 m'),
(233, 'Kemranjen', 'Jawa Tengah', 'Daop V Purwokerto', 'KJ', '+7 m'),
(234, 'Kepanjen', 'Jawa Timur', 'Daop VIII Surabaya', 'KPN', '+355 m'),
(235, 'Kertapati', 'Sumatera Selatan', 'Divre III Palembang', 'KPT', '+2 m'),
(236, 'Kertasemaya', 'Jawa Barat', 'Daop III Cirebon', 'KTM', '+13 m'),
(237, 'Kertomenanggal', 'Jawa Timur', 'Daop VIII Surabaya', 'KOM', '+5 m'),
(238, 'Kertosono', 'Jawa Timur', 'Daop VII Madiun', 'KTS', '+43 m'),
(239, 'Kesamben', 'Jawa Timur', 'Daop VIII Surabaya', 'KSB', '+193 m'),
(240, 'Ketanggungan', 'Jawa Tengah', 'Daop III Cirebon', 'KGG', '+16 m'),
(241, 'Kiaracondong', 'Jawa Barat', 'Daop II Bandung', 'KAC', '+681 m'),
(242, 'Kisaran', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'KIS', '?'),
(243, 'Klakah', 'Jawa Timur', 'Daop IX Jember', 'KK', '+193 m'),
(244, 'Klari', 'Jawa Barat', 'Daop I Jakarta', 'KLI', '+15 m'),
(245, 'Klaten', 'Jawa Tengah', 'Daop VI Yogyakarta', 'KT', '+151 m'),
(246, 'Klender', 'DKI Jakarta', 'Daop I Jakarta', 'KLD', '+15 m'),
(247, 'Klender Baru', 'DKI Jakarta', 'Daop I Jakarta', 'KLDB', '+11 m'),
(248, 'Kosambi', 'Jawa Barat', 'Daop I Jakarta', 'KOS', '+25 m'),
(249, 'Kotabaru', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'KBU', '+43 m'),
(250, 'Kotabumi', 'Lampung', 'Divre IV Tanjungkarang', 'KB', '+28 m'),
(251, 'Kotapadang', 'Bengkulu', 'Divre III Palembang', 'KOP', '+107 m'),
(252, 'Kotok', 'Jawa Timur', 'Daop IX Jember', 'KTK', '+176 m'),
(253, 'Kradenan', 'Jawa Tengah', 'Daop IV Semarang', 'KNN', '+55 m'),
(254, 'Kramat', 'DKI Jakarta', 'Daop I Jakarta', 'KMT', '+15 m'),
(255, 'Kranji', 'Jawa Barat', 'Daop I Jakarta', 'KRI', '+? m'),
(256, 'Kras', 'Jawa Timur', 'Daop VII Madiun', 'KRS', '+79 m'),
(257, 'Krengseng', 'Jawa Tengah', 'Daop IV Semarang', 'KNS', '+9 m'),
(258, 'Krenceng', 'Banten', 'Daop I Jakarta', 'KEN', '+16 m'),
(259, 'Kretek', 'Jawa Tengah', 'Daop V Purwokerto', 'KRT', '+285 m'),
(260, 'Krian', 'Jawa Timur', 'Daop VIII Surabaya', 'KRN', '+12 m'),
(261, 'Krikilan', 'Jawa Timur', 'Daop IX Jember', 'KKL', '+361 m'),
(262, 'Kroya', 'Jawa Tengah', 'Daop V Purwokerto', 'KYA', '+11 m'),
(263, 'Kuala Namu', 'Sumatera Utara', 'Divre I Sumatera Utara dan Aceh', 'KNM', '+7 m'),
(264, 'Kubukrambil', 'Sumatera Barat', 'Divre II Sumatera Barat', 'KKR', '+647 m'),
(265, 'Kuraitaji', 'Sumatera Barat', 'Divre II Sumatera Barat', 'KI', '+? m'),
(266, 'Kuripan', 'Jawa Tengah', 'Daop IV Semarang', 'KRP', '+6 m'),
(267, 'Kutoarjo', 'Jawa Tengah', 'Daop V Purwokerto', 'KTA', '+16 m'),
(268, 'Kutowinangun', 'Jawa Tengah', 'Daop V Purwokerto', 'KWN', '+13 m'),
(269, 'Labuhan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'LBU', '+58 m'),
(270, 'Labuanratu', 'Lampung', 'Divre IV Tanjungkarang', 'LAR', '+108 m'),
(271, 'Lahat', 'Sumatera Selatan', 'Divre III Palembang', 'LT', '+112 m'),
(272, 'Lamongan', 'Jawa Timur', 'Daop VIII Surabaya', 'LMG', '+2 m'),
(273, 'Lampegan', 'Jawa Barat', 'Daop II Bandung', 'LP', '+652 m'),
(274, 'Langen', 'Jawa Barat', 'Daop V Purwokerto', 'LN', '+16 m'),
(275, 'Larangan', 'Jawa Tengah', 'Daop IV Semarang', 'LR', '+4 m'),
(276, 'Larangan', 'Jawa Tengah', 'Daop III Cirebon', 'LRA', '+21 m'),
(277, 'Laut Tador', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'LTD', '?'),
(278, 'Lawang', 'Jawa Timur', 'Daop VIII Surabaya', 'LW', '+491 m'),
(279, 'Lebak Jero', 'Jawa Barat', 'Daop II Bandung', 'LBJ', '+818 m'),
(280, 'Lebeng', 'Jawa Tengah', 'Daop V Purwokerto', 'LBG', '+11 m'),
(281, 'Leces', 'Jawa Timur', 'Daop IX Jember', 'LEC', '+48 m'),
(282, 'Ledokombo', 'Jawa Timur', 'Daop IX Jember', 'LDO', '+370 m'),
(283, 'Leles', 'Jawa Barat', 'Daop II Bandung', 'LE', '+697 m'),
(284, 'Lemahabang', 'Jawa Barat', 'Daop I Jakarta', 'LMB', '+16 m'),
(285, 'Lembak', 'Sumatera Selatan', 'Divre III Palembang', 'LEB', '+18 m'),
(286, 'Lempuyangan', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'LPN', '+114 m'),
(287, 'Lenteng Agung', 'DKI Jakarta', 'Daop I Jakarta', 'LTA', '?'),
(288, 'Lidahtanah', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'LDT', '?'),
(289, 'Limapuluh', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'LMP', '?'),
(290, 'Linggapura', 'Jawa Tengah', 'Daop V Purwokerto', 'LG', '+156 m'),
(291, 'Losari', 'Jawa Barat', 'Daop III Cirebon', 'LOS', '+3 m'),
(292, 'Lubuk Alung', 'Sumatera Barat', 'Divre II Sumatera Barat', 'LA', '?'),
(293, 'Lubuklinggau', 'Sumatera Selatan', 'Divre III Palembang', 'LLG', '+129 m'),
(294, 'Lubukpakam', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'LBP', '?'),
(295, 'Lubukrukam', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'LRM', '+38 m'),
(296, 'Madiun', 'Jawa Timur', 'Daop VII Madiun', 'MN', '+63 m'),
(297, 'Maja', 'Banten', 'Daop I Jakarta', 'MJ', '+40 m'),
(298, 'Maguwo', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'MGW', '+118 m'),
(299, 'Malang', 'Jawa Timur', 'Daop VIII Surabaya', 'ML', '+444 m'),
(300, 'Malang Kotalama', 'Jawa Timur', 'Daop VIII Surabaya', 'MLK', '+429 m'),
(301, 'Malasan', 'Jawa Timur', 'Daop IX Jember', 'MLS', '+138 m'),
(302, 'Manggarai', 'DKI Jakarta', 'Daop I Jakarta', 'MRI', '+13 m'),
(303, 'Manggabesar', 'DKI Jakarta', 'Daop I Jakarta', 'MGB', '?'),
(304, 'Mangkang', 'Jawa Tengah', 'Daop IV Semarang', 'MKG', '+5 m'),
(305, 'Mangli', 'Jawa Timur', 'Daop IX Jember', 'MI', '+62 m'),
(306, 'Manonjaya', 'Jawa Barat', 'Daop II Bandung', 'MNJ', '+292 m'),
(307, 'Maos', 'Jawa Tengah', 'Daop V Purwokerto', 'MA', '+8 m'),
(308, 'Marbau', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'MBU', '?'),
(309, 'Margorejo', 'Jawa Timur', 'Daop VIII Surabaya', 'MGJ', '+5 m'),
(310, 'Martapura', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'MP', '+91 m'),
(311, 'Masaran', 'Jawa Tengah', 'Daop VI Yogyakarta', 'MSR', '+93 m'),
(312, 'Maseng', 'Jawa Barat', 'Daop I Jakarta', 'MSG', '+425 m'),
(313, 'Maswati', 'Jawa Barat', 'Daop II Bandung', 'MSI', '+499 m'),
(314, 'Medan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'MDN', '+22 m'),
(315, 'Meluwung', 'Jawa Tengah', 'Daerah Operasi V Purwokerto', 'MLW', '+14 m'),
(316, 'Membang Muda', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'MBM', '?'),
(317, 'Merak', 'Banten', 'Daop I Jakarta', 'MER', '+3 m'),
(318, 'Minggiran', 'Jawa Timur', 'Daop VII Madiun', 'MGN', '+56 m'),
(319, 'Mojokerto', 'Jawa Timur', 'Daop VIII Surabaya', 'MR', '+22 m'),
(320, 'Mrawan', 'Jawa Timur', 'Daop IX Jember', 'MNW', '+524 m'),
(321, 'Muaraenim', 'Sumatera Selatan', 'Divre III Palembang', 'ME', '+37 m'),
(322, 'Muaragula', 'Sumatera Selatan', 'Divre III Palembang', 'MRL', '+33 m'),
(323, 'Muara Kalaban', 'Sumatera Barat', 'Divre II Sumatera Barat', 'MKB', '+223 m'),
(324, 'Muarasaling', 'Sumatera Selatan', 'Divre III Palembang', 'MSL', '?'),
(325, 'Nagreg', 'Jawa Barat', 'Daop II Bandung', 'NG', '+848 m'),
(326, 'Nambo', 'Jawa Barat', 'Daop I Jakarta', 'NMO', '+114 m'),
(327, 'Negararatu', 'Lampung', 'Divre IV Tanjungkarang', 'NRR', '+46 m'),
(328, 'Negeriagung', 'Lampung', 'Divre IV Tanjungkarang', 'NGN', '+46 m'),
(329, 'Ngadiluwih', 'Jawa Timur', 'Daop VII Madiun', 'NDL', '+83 m'),
(330, 'Ngagel', 'Jawa Timur', 'Daop VIII Surabaya', 'NGL', '+7 m'),
(331, 'Nganjuk', 'Jawa Timur', 'Daop VII Madiun', 'NJ', '+56 m'),
(332, 'Ngebruk', 'Jawa Timur', 'Daop VIII Surabaya', 'NB', '+319 m'),
(333, 'Ngrombo', 'Jawa Tengah', 'Daop IV Semarang', 'NBO', '+38 m'),
(334, 'Ngujang', 'Jawa Timur', 'Daop VII Madiun', 'NJG', '+87 m'),
(335, 'Ngunut', 'Jawa Timur', 'Daop VII Madiun', 'NT', '+104 m'),
(336, 'Niru', 'Sumatera Selatan', 'Divre III Palembang', 'NRU', '+19 m'),
(337, 'Notog', 'Jawa Tengah', 'Daop V Purwokerto', 'NTG', '+25 m'),
(338, 'Pabuaran', 'Jawa Barat', 'Daop III Cirebon', 'PAB', '+25 m'),
(339, 'Padalarang', 'Jawa Barat', 'Daop II Bandung', 'PDL', '+695 m'),
(340, 'Padang', 'Sumatera Barat', 'Divre II Sumatera Barat', 'PD', '+8 m'),
(341, 'Padanghalaban', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PHA', '?'),
(342, 'Padangpanjang', 'Sumatera Barat', 'Divre II Sumatera Barat', 'PP', '+773 m'),
(343, 'Padas', 'Jawa Tengah', 'Daop IV Semarang', 'PDS', '+42 m'),
(344, 'Pagargunung', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'PGG', '+26 m'),
(345, 'Pagerwojo', 'Jawa Timur', 'Daop VIII Surabaya', 'PWP', '+4 m'),
(346, 'Pakisaji', 'Jawa Timur', 'Daop VIII Surabaya', 'PSI', '+386 m'),
(347, 'Palmerah', 'DKI Jakarta', 'Daop I Jakarta', 'PLM', '+13 m'),
(348, 'Palur', 'Jawa Tengah', 'Daop VI Yogyakarta', 'PL', '+93 m'),
(349, 'Pamingke', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PME', '?'),
(350, 'Panunggalan', 'Jawa Tengah', 'Daop IV Semarang', 'PNL', '+46 m'),
(351, 'Papar', 'Jawa Timur', 'Daop VII Madiun', 'PPR', '+52 m'),
(352, 'Pariaman', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PMN', '+2 m'),
(353, 'Paritmalintang', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PRM', '?'),
(354, 'Paron', 'Jawa Timur', 'Daop VII Madiun', 'PA', '+56 m'),
(355, 'Parung Kuda', 'Jawa Barat', 'Daop I Jakarta', 'PRK', '+396 m'),
(356, 'Parung Panjang', 'Jawa Barat', 'Daop I Jakarta', 'PRP', '+54 m'),
(357, 'Pasar Minggu', 'DKI Jakarta', 'Daop I Jakarta', 'PSM', '?'),
(358, 'Pasar Minggu Baru', 'DKI Jakarta', 'Daop I Jakarta', 'PSMB', '+29 m'),
(359, 'Pasarnguter', 'Jawa Tengah', 'Daop VI Yogyakarta', 'PNT', '+105 m'),
(360, 'Pasar Senen', 'DKI Jakarta', 'Daop I Jakarta', 'PSE', '+4.7 m'),
(361, 'Pasar Usang', 'Sumatera Barat', 'Divre II Sumatera Barat', 'PRU', '+12 m'),
(362, 'Pasirbungur', 'Jawa Barat', 'Daop III Cirebon', 'PAS', '+33 m'),
(363, 'Pasuruan', 'Jawa Timur', 'Daop IX Jember', 'PS', '+3 m'),
(364, 'Patuguran', 'Jawa Tengah', 'Daerah Operasi V Purwokerto', 'PAT', '+328 m'),
(365, 'Patukan', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'PTN', '+88 m'),
(366, 'Pauhkambar', 'Sumatera Barat', 'Divre II Sumatera Barat', 'PAK', '?'),
(367, 'Payakabung', 'Sumatera Selatan', 'Divre III Palembang', 'PYK', '+16 m'),
(368, 'Pegadenbaru', 'Jawa Barat', 'Daop III Cirebon', 'PGB', '+27 m'),
(369, 'Pekalongan', 'Jawa Tengah', 'Daop IV Semarang', 'PK', '+4 m'),
(370, 'Pemalang', 'Jawa Tengah', 'Daop IV Semarang', 'PML', '+4 m'),
(371, 'Penimur', 'Sumatera Selatan', 'Divre III Palembang', 'PNM', '+46 m'),
(372, 'Peninjawan', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'PNW', '?'),
(373, 'Perbaungan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PBA', '?'),
(374, 'Perlanaan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PRA', '?'),
(375, 'Pesing', 'DKI Jakarta', 'Daop I Jakarta', 'PSG', '+5 m'),
(376, 'Petarukan', 'Jawa Tengah', 'Daop IV Semarang', 'PTA', '+10 m'),
(377, 'Peterongan', 'Jawa Timur', 'Daop VII Madiun', 'PTR', '+33 m'),
(378, 'Plabuan', 'Jawa Tengah', 'Daop IV Semarang', 'PLB', '+4 m'),
(379, 'Plered', 'Jawa Barat', 'Daop II Bandung', 'PLD', '+257 m'),
(380, 'Pohgajih', 'Jawa Timur', 'Daop VIII Surabaya', 'PGJ', '+205 m'),
(381, 'Pondok Cina', 'Jawa Barat', 'Daop I Jakarta', 'POC', '+74 m'),
(382, 'Pondok Jati', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'POK', '?'),
(383, 'Pondok Ranji', 'Banten', 'Daop I Jakarta', 'PDJ', '+24 m'),
(384, 'Porong', 'Jawa Timur', 'Daop VIII Madiun', 'PR', '+4 m'),
(385, 'Poris', 'Banten', 'Daop I Jakarta', 'PI', '?'),
(386, 'Prabumulih', 'Sumatera Selatan', 'Divre III Palembang', 'PBM', '+36 m'),
(387, 'Prembun', 'Jawa Tengah', 'Daop V Purwokerto', 'PRB', '+9 m'),
(388, 'Pringkasap', 'Jawa Barat', 'Daop III Cirebon', 'PRI', '+25 m'),
(389, 'Probolinggo', 'Jawa Timur', 'Daop IX Jember', 'PB', '+5 m'),
(390, 'Prupuk', 'Jawa Tengah', 'Daop V Purwokerto', 'PPK', '+36 m'),
(391, 'Pulu Brayan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PUB', '+15 m'),
(392, 'Purwakarta', 'Jawa Barat', 'Daop II Bandung', 'PWK', '+84 m'),
(393, 'Purwoasri', 'Jawa Timur', 'Daop VII Madiun', 'PWA', '+59 m'),
(394, 'Purwokerto', 'Jawa Tengah', 'Daop V Purwokerto', 'PWT', '+75 m'),
(395, 'Purwosari', 'Jawa Tengah', 'Daop VI Yogyakarta', 'PWS', '+98 m'),
(396, 'Pucuk', 'Jawa Timur', 'Daop VIII Surabaya', 'PC', '+6 m'),
(397, 'Puluraja', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'PUR', '?'),
(398, 'Rajamandala', 'Jawa Barat', 'Daop II Bandung', 'RM', '+319 m'),
(399, 'Rajapolah', 'Jawa Barat', 'DaopII Bandung', 'RJP', '+459 m'),
(400, 'Rajawali', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'RJW', '+5 m'),
(401, 'Rambipuji', 'Jawa Timur', 'Daerah Operasi IX Jember', 'RBP', '+52 m'),
(402, 'Rampah', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'RPH', '?'),
(403, 'Randegan', 'Jawa Tengah', 'Daop V Purwokerto', 'RDN', '+11 m'),
(404, 'Randuagung', 'Jawa Timur', 'Daerah Operasi IX Jember', 'RDA', '+58 m'),
(405, 'Randublatung', 'Jawa Tengah', 'Daop IV Semarang', 'RBG', '+53 m'),
(406, 'Rangkasbitung', 'Banten', 'Daerah Operasi I Jakarta', 'RK', '+22 m'),
(407, 'Rancaekek', 'Jawa Barat', 'Daop II Bandung', 'RCK', '+672 m'),
(408, 'Rantauprapat', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'RAP', '+27 m'),
(409, 'Ranuyoso', 'Jawa Timur', 'Daerah Operasi IX Jember', 'RN', '+248 m'),
(410, 'Rawabuntu', 'Banten', 'Daerah Operasi I Jakarta', 'RU', '?'),
(411, 'Rawabuaya', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'RW', '+6 m'),
(412, 'Rejosari', 'Lampung', 'Divre IV Tanjungkarang', 'RJS', '+104 m'),
(413, 'Rejoso', 'Jawa Timur', 'Daerah Operasi IX Jember', 'RO', '+6 m'),
(414, 'Rejotangan', 'Jawa Timur', 'Daop VII Madiun', 'RJ', '+116 m'),
(415, 'Rendeh', 'Jawa Barat', 'Daop II Bandung', 'RH', '+447 m'),
(416, 'Rewulu', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'RWL', '+88 m'),
(417, 'Sadang', 'Jawa Barat', 'Daop II Bandung', 'SAD', '+80 m'),
(418, 'Salem', 'Jawa Tengah', 'Daop VI Yogyakarta', 'Slm', '+146 m'),
(419, 'Saradan', 'Jawa Timur', 'Daop VII Madiun', 'SRD', '+107 m'),
(420, 'Sasaksaat', 'Jawa Barat', 'Daop II Bandung', 'SKT', '+595 m'),
(421, 'Sawahlunto', 'Sumatera Barat', 'Divre II Sumatera Barat', 'SWL', '+262 m'),
(422, 'Sawah Besar', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'SWB', '?'),
(423, 'Sawotratap', 'Jawa Timur', 'Daop VIII Surabaya', 'STP', '+5 m'),
(424, 'Saungnaga', 'Sumatera Selatan', 'Divre III Palembang', 'SNA', '+83 m'),
(425, 'Sedadi', 'Jawa Tengah', 'Daop IV Semarang', 'SDI', '+29 m'),
(426, 'Sei Bejangkar', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'SBJ', '?'),
(427, 'Selajambe', 'Jawa Barat', 'Daop II Bandung', 'SLJ', '+357 m'),
(428, 'Semarang Poncol', 'Jawa Tengah', 'Daop IV Semarang', 'SMC', '+2 m'),
(429, 'Semarang Tawang', 'Jawa Tengah', 'Daop IV Semarang', 'SMT', '+2 m'),
(430, 'Sembung', 'Jawa Timur', 'Daop VII Madiun', 'SMB', '+47 m'),
(431, 'Sempolan', 'Jawa Timur', 'Daerah Operasi IX Jember', 'SPL', '+469 m'),
(432, 'Sengon', 'Jawa Timur', 'Daop VIII Surabaya', 'SN', '?'),
(433, 'Sentolo', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'STL', '+54 m'),
(434, 'Sepancar', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'SPC', '+62 m'),
(435, 'Sepanjang', 'Jawa Timur', 'Daop VIII Surabaya', 'SPJ', '+7 m'),
(436, 'Serang', 'Banten', 'Daerah Operasi I Jakarta', 'SG', '+25.66 m'),
(437, 'Serdang', 'Sumatera Selatan', 'Divre III Palembang', 'SDN', '+21 m'),
(438, 'Serpong', 'Banten', 'Daerah Operasi I Jakarta', 'SRP', '+46 m'),
(439, 'Siantar', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'SIR', '+383 m'),
(440, 'Sidareja', 'Jawa Tengah', 'Daop V Purwokerto', 'SDR', '+5 m'),
(441, 'Sidoarjo', 'Jawa Timur', 'Daop VIII Surabaya', 'SDA', '+4 m'),
(442, 'Sidotopo', 'Jawa Timur', 'Daop VIII Surabaya', 'SDT', '+2.5 m'),
(443, 'Sikampuh', 'Jawa Tengah', 'Daop V Purwokerto', 'SKP', '+8 m'),
(444, 'Simpang', 'Sumatera Selatan', 'Divre III Palembang', 'SIG', '?'),
(445, 'Sindanglaut', 'Jawa Barat', 'Daop III Cirebon', 'SDU', '+14 m'),
(446, 'Singkarak', 'Sumatera Barat', 'Divre II Sumatera Barat', 'SKA', '?'),
(447, 'Singojuruh', 'Jawa Timur', 'Daerah Operasi IX Jember', 'SGJ', '+160 m'),
(448, 'Singosari', 'Jawa Timur', 'Daop VIII Surabaya', 'SGS', '+487 m'),
(449, 'Slawi', 'Jawa Tengah', 'Daop V Purwokerto', 'SLW', '+38 m'),
(450, 'Soka', 'Jawa Tengah', 'Daop V Purwokerto', 'SOA', '+22 m'),
(451, 'Solo Balapan', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SLO', '+93 m'),
(452, 'Solo Jebres', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SK', '+97 m'),
(453, 'Solo-Kota', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SKA', '+85 m'),
(454, 'Solok', 'Sumatera Barat', 'Divre II Sumatera Barat', 'SLK', '?'),
(455, 'Songgom', 'Jawa Tengah', 'Daop III Cirebon', 'SGG', '+23 m'),
(456, 'Sragen', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SRG', '+86 m'),
(457, 'Sragi', 'Jawa Tengah', 'Daop IV Semarang', 'SRI', '+7 m'),
(458, 'Srowot', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SWT', '+152 m'),
(459, 'Sruweng', 'Jawa Tengah', 'Daop V Purwokerto', 'SRW', '+14 m'),
(460, 'Sudimara', 'Banten', 'Daerah Operasi I Jakarta', 'SDM', '+26 m'),
(461, 'Sudirman', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'SDM', '+5.56 m'),
(462, 'Sukabumi', 'Jawa Barat', 'Daerah Operasi I Jakarta', 'SI', '+583 m'),
(463, 'Sukacinta', 'Sumatera Selatan', 'Divre III Palembang', 'SCT', '+78 m'),
(464, 'Sukamenanti', 'Lampung', 'Divre IV Tanjungkarang', 'SKN', '+6,5 m'),
(465, 'Sukaraja', 'Sumatera Selatan', 'Divre III Palembang', 'SUA', '+102 m'),
(466, 'Sukatani', 'Jawa Barat', 'Daop II Bandung', 'SUT', '+226 m'),
(467, 'Sukoharjo', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SKH', '+98 m'),
(468, 'Sukomoro', 'Jawa Timur', 'Daop VII Madiun', 'SKM', '+50 m'),
(469, 'Sukorejo', 'Jawa Timur', 'Daop VIII Surabaya', 'SKJ', '+238 m'),
(470, 'Sulur', 'Jawa Tengah', 'Daop IV Semarang', 'SL', '+76 m'),
(471, 'Sumbergempol', 'Jawa Timur', 'Daop VII Madiun', 'SBL', '+92 m'),
(472, 'Sumberlawang', 'Jawa Tengah', 'Daop VI Yogyakarta', 'SUM', '+126 m'),
(473, 'Sumberpucung', 'Jawa Timur', 'Daop VIII Surabaya', 'SBP', '+296 m'),
(474, 'Sumberrejo', 'Jawa Timur', 'Daop VIII Surabaya', 'SRJ', '+16 m'),
(475, 'Sumberwadung', 'Jawa Timur', 'Daerah Operasi IX Jember', 'SWD', '+312 m'),
(476, 'Sumlaran', 'Jawa Timur', 'Daop VIII Surabaya', 'SLR', '+5 m'),
(477, 'Sumobito', 'Jawa Timur', 'Daop VII Madiun', 'SBO', '+28 m'),
(478, 'Sungai Lassi', 'Sumatera Barat', 'Divre II Sumatera Barat', 'SNL', '?'),
(479, 'Sunggal', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'SUN', '?'),
(480, 'Surabaya Gubeng', 'Jawa Timur', 'Daop VIII Surabaya', 'SGU', '+5 m'),
(481, 'Surabaya Kota', 'Jawa Timur', 'Daop VIII Surabaya', 'SB', '+4 m'),
(482, 'Surabaya Pasarturi', 'Jawa Timur', 'Daop VIII Surabaya', 'SBI', '+1 m'),
(483, 'Suradadi', 'Jawa Tengah', 'Daop IV Semarang', 'SD', '+3 m'),
(484, 'Susuhan', 'Jawa Timur', 'Daop VII Madiun', 'SS', '+60 m'),
(485, 'Tabing', 'Sumatera Barat', 'Divre II Sumatera Barat', 'TAB', '+2 m'),
(486, 'Tagogapu', 'Jawa Barat', 'Daop II Bandung', 'TAU', '+595 m'),
(487, 'Talangpadang', 'Sumatera Selatan', 'Divre III Palembang', 'TLP', '+28 m'),
(488, 'Talun', 'Jawa Timur', 'Daop VIII Surabaya', 'TAL', '+244 m'),
(489, 'Taman Kota/Kembangan', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'TKO', '?'),
(490, 'Tambak', 'Jawa Tengah', 'Daop V Purwokerto', 'TBK', '+19 m'),
(491, 'Tambun', 'Jawa Barat', 'Daerah Operasi I Jakarta', 'TBN', '+19 m'),
(492, 'Tanahabang', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'THB', '+9 m'),
(493, 'Tandes', 'Jawa Timur', 'Daop VIII Surabaya', 'TES', '+2 m'),
(494, 'Tanjung', 'Jawa Tengah', 'Daop III Cirebon', 'TGN', '+3 m'),
(495, 'Tanjungbalai', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'TNB', '?'),
(496, 'Tanjung Barat', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'TNT', '+37 m'),
(497, 'Tanjungenim Baru', 'Sumatera Selatan', 'Divre III Palembang', 'TMB', '+35 m'),
(498, 'Tanjungkarang', 'Lampung', 'Divre IV Tanjungkarang', 'TNK', '+96 m'),
(499, 'Tanjungterang', 'Sumatera Selatan', 'Divre III Palembang', 'TGE', '+? m'),
(500, 'Tanjung Priok', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'TPK', '+1.5 m'),
(501, 'Tanjungrambang', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'TJR', '?'),
(502, 'Tanjungrasa', 'Jawa Barat', 'Daop III Cirebon', 'TJS', '+35 m'),
(503, 'Tangerang', 'Banten', 'Daerah Operasi I Jakarta', 'TNG', '+18 m'),
(504, 'Tanggul', 'Jawa Timur', 'Daerah Operasi IX Jember', 'TGL', '+30 m'),
(505, 'Tanggulangin', 'Jawa Timur', 'Daop VIII Surabaya', 'TGA', '+6 m'),
(506, 'Tanggung', 'Jawa Tengah', 'Daop IV Semarang', 'TGG', '+20 m'),
(507, 'Tarahan', 'Lampung', 'Divre IV Tanjungkarang', 'THN', '+20 m'),
(508, 'Tarik', 'Jawa Timur', 'Daop VIII Surabaya', 'TRK', '+16 m'),
(509, 'Tasikmalaya', 'Jawa Barat', 'Daop II Bandung', 'TSM', '+349 m'),
(510, 'Tebet', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'TEB', '+17 m'),
(511, 'Tebing Tinggi', 'Sumatera Selatan', 'Divre III Palembang', 'TI', '+105 m'),
(512, 'Tebing Tinggi', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'TBI', '?'),
(513, 'Tegal', 'Jawa Tengah', 'Daop IV Semarang', 'TG', '+4 m'),
(514, 'Tegineneng', 'Lampung', 'Divre IV Tanjungkarang', 'TGI', '+69 m'),
(515, 'Tegowanu', 'Jawa Tengah', 'Daop IV Semarang', 'TGW', '+13 m'),
(516, 'Telagasari', 'Jawa Barat', 'Daop III Cirebon', 'TLS', '+7 m'),
(517, 'Telawa', 'Jawa Tengah', 'Daop IV Semarang', 'TW', '+63 m'),
(518, 'Teluk Mengkudu', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'TKD', '?'),
(519, 'Temuguruh', 'Jawa Timur', 'Daerah Operasi IX Jember', 'TGR', '+196 m'),
(520, 'Tenjo', 'Jawa Barat', 'Daerah Operasi I Jakarta', 'TEJ', '+52 m'),
(521, 'Terisi', 'Jawa Barat', 'Daop III Cirebon', 'TIS', '+12 m'),
(522, 'Tigagajah', 'Sumatera Selatan', 'Divre IV Tanjungkarang', 'TJH', '+48 m'),
(523, 'Tigaraksa', 'Banten', 'Daerah Operasi I Jakarta', 'TGS', '+51 m'),
(524, 'Titi Papan', 'Sumatera Utara', 'Divre I Sumut dan Aceh', 'TPP', '?'),
(525, 'Tobo', 'Jawa Timur', 'Daop VIII Surabaya', 'TBO', '+28 m'),
(526, 'Tulangan', 'Jawa Timur', 'Daop VIII Surabaya', 'TLN', '+14 m'),
(527, 'Tulungagung', 'Jawa Timur', 'Daop VII Madiun', 'TA', '+85 m'),
(528, 'Tulungbuyut', 'Lampung', 'Divre IV Tanjungkarang', 'TLY', '+81 m'),
(529, 'Ujanmas', 'Sumatera Selatan', 'Divre III Palembang', 'UJM', '+36 m'),
(530, 'Ujungnegoro', 'Jawa Tengah', 'Daop IV Semarang', 'UJN', '+5 m'),
(531, 'Universitas Indonesia', 'Jawa Barat', 'Daerah Operasi I Jakarta', 'UI', '+69 m'),
(532, 'Universitas Pancasila', 'DKI Jakarta', 'Daerah Operasi I Jakarta', 'UP', '+57 m'),
(533, 'Wadu', 'Jawa Tengah', 'Daop IV Semarang', 'WDU', '?'),
(534, 'Walantaka', 'Banten', 'Daerah Operasi I Jakarta', 'WLT', '+25 m'),
(535, 'Walikukun', 'Jawa Timur', 'Daop VII Madiun', 'WK', '+75 m'),
(536, 'Waru', 'Jawa Timur', 'Daop VIII Surabaya', 'WR', '+5 m'),
(537, 'Waruduwur', 'Jawa Barat', 'Daop III Cirebon', 'WDW', '+4 m'),
(538, 'Warungbandrek', 'Jawa Barat', 'Daop II Bandung', 'WB', '+612 m'),
(539, 'Wates', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'WT', '+18 m'),
(540, 'Waytuba', 'Lampung', 'Divre IV Tanjungkarang', 'WAY', '+92 m'),
(541, 'Waypisang', 'Lampung', 'Divre IV Tanjungkarang', 'WAP', '+90 m'),
(542, 'Weleri', 'Jawa Tengah', 'Daop IV Semarang', 'WLR', '+12 m'),
(543, 'Wilangan', 'Jawa Timur', 'Daop VII Madiun', 'WLG', '+96 m'),
(544, 'Wlingi', 'Jawa Timur', 'Daop VIII Surabaya', 'WG', '+274 m'),
(545, 'Wojo', 'Jawa Tengah', 'Daop VI Yogyakarta', 'WJ', '+14 m'),
(546, 'Wonogiri', 'Jawa Tengah', 'Daop VI Yogyakarta', 'WNG', '+144 m'),
(547, 'Wonokerto', 'Jawa Timur', 'Daop VIII Surabaya', 'WN', '+90 m'),
(548, 'Wonokromo', 'Jawa Timur', 'Daop VIII Surabaya', 'WO', '+7 m'),
(549, 'Wonosari', 'Jawa Tengah', 'Daop V Purwokerto', 'WNS', '+15 m'),
(550, 'Yogyakarta', 'Daerah Istimewa Yogyakarta', 'Daop VI Yogyakarta', 'YK', '+113 m');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_po` int(11) NOT NULL,
  `no_penjualan` int(11) NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `tgl_invoice` datetime NOT NULL,
  `tgl_po` datetime NOT NULL,
  `tgl_jatuh_tempo` datetime NOT NULL,
  `hargabeli` decimal(20,2) NOT NULL,
  `hargaanak` decimal(20,2) NOT NULL,
  `hargabagasi` decimal(10,2) NOT NULL,
  `hargabelireturn` decimal(20,2) NOT NULL,
  `hargaanakreturn` decimal(20,2) NOT NULL,
  `hargabagasireturn` decimal(20,2) NOT NULL,
  `sudah_total` varchar(5) NOT NULL,
  `nama_hotel` varchar(255) NOT NULL,
  `hargahotel` decimal(20,2) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `nama_maskapai` varchar(255) NOT NULL,
  `hargabelitotal` decimal(20,2) NOT NULL,
  `statusdibayar` varchar(10) DEFAULT NULL,
  `tgl_dibayar` datetime DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_po`, `no_penjualan`, `no_invoice`, `tgl_invoice`, `tgl_po`, `tgl_jatuh_tempo`, `hargabeli`, `hargaanak`, `hargabagasi`, `hargabelireturn`, `hargaanakreturn`, `hargabagasireturn`, `sudah_total`, `nama_hotel`, `hargahotel`, `id_supplier`, `nama_supplier`, `nama_maskapai`, `hargabelitotal`, `statusdibayar`, `tgl_dibayar`, `username`, `tgl_transaksi`) VALUES
(1, 7, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '1.00', '100.00', '100.00', '100.00', '100.00', '100.00', '', '', '0.00', 1, 'NUSANTARA TOUR', 'CITILINK AIRLINES', '0.00', NULL, NULL, 'yosua', '2018-09-21 01:52:43'),
(2, 3, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', 'ASTON', '10000.00', 1, 'NUSANTARA TOUR', '', '80000.00', NULL, NULL, 'yosua', '2018-09-18 12:08:59'),
(3, 2, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', '', '0.00', 1, 'NUSANTARA TOUR', '', '100000.00', NULL, NULL, 'yosua', '2018-09-17 00:02:25'),
(7, 8, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', '', '10000.00', 1, 'NUSANTARA TOUR', '', '40000.00', NULL, NULL, 'yosua', '2018-09-17 01:05:28'),
(8, 9, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', '', '0.00', 1, 'NUSANTARA TOUR', '', '10000.00', NULL, NULL, 'yosua', '2018-09-17 00:05:59'),
(9, 10, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '100.00', '1000.00', '10000.00', '30000.00', '30000.00', '30000.00', '', '', '0.00', 1, 'NUSANTARA TOUR', 'AIR ASIA', '101100.00', NULL, NULL, 'yosua', '2018-09-21 01:46:50'),
(10, 11, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', '0.00', 1, 'NUSANTARA TOUR', '', '0.00', NULL, NULL, 'yosua', '2018-09-20 23:32:59'),
(11, 12, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', 'ASTON', '10000.00', 1, 'NUSANTARA TOUR', '', '100000.00', NULL, NULL, 'yosua', '2018-09-18 15:47:32'),
(12, 13, '', '2018-09-16 00:00:00', '2018-09-16 00:00:00', '2018-10-16 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'n', 'ASTON', '10000.00', 1, 'NUSANTARA TOUR', '', '100000.00', NULL, NULL, 'yosua', '2018-09-17 01:47:50'),
(13, 14, '', '2018-09-17 00:00:00', '2018-09-17 00:00:00', '2018-10-17 00:00:00', '10000.00', '10000.00', '10000.00', '20000.00', '20000.00', '20000.00', '', '', '0.00', 1, 'NUSANTARA TOUR', 'AIR ASIA', '50000.00', NULL, NULL, 'yosua', '2018-09-17 08:32:26'),
(14, 15, '', '2018-09-20 00:00:00', '2018-09-20 00:00:00', '2018-10-20 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', '0.00', 0, '', '', '0.00', NULL, NULL, 'yosua', '2018-09-20 20:07:32'),
(15, 16, '', '1970-01-01 01:00:00', '2018-09-20 00:00:00', '2018-10-20 00:00:00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '', '0.00', 0, '', 'GARUDA INDONESIA', '0.00', NULL, NULL, 'yosua', '2018-09-21 01:53:02'),
(16, 17, '', '1970-01-01 01:00:00', '2018-09-20 00:00:00', '2018-10-20 00:00:00', '1000.00', '1000.00', '1000.00', '0.00', '0.00', '0.00', 'n', '', '0.00', 1, 'NUSANTARA TOUR', 'GARUDA INDONESIA', '3000.00', NULL, NULL, 'yosua', '2018-09-21 03:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` int(11) NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `tgl_in` datetime NOT NULL,
  `tgl_out` datetime DEFAULT NULL,
  `jam_in` time NOT NULL,
  `jam_out` time NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlahanak` int(11) NOT NULL,
  `nama_maskapai` varchar(255) NOT NULL,
  `asal` varchar(25) NOT NULL,
  `tujuan` varchar(25) NOT NULL,
  `hotel` enum('Y','N','') NOT NULL,
  `nama_hotel` varchar(255) NOT NULL,
  `malam` int(5) NOT NULL,
  `jumlah_kamar` int(4) NOT NULL,
  `jenis_kamar` varchar(15) NOT NULL,
  `supplier` varchar(30) NOT NULL,
  `extra` enum('Y','N') NOT NULL,
  `kembali` varchar(1) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `hargabeli` decimal(20,2) NOT NULL,
  `hargaanak` decimal(20,2) NOT NULL,
  `sudah_total` varchar(5) NOT NULL,
  `hargahotel` decimal(20,2) NOT NULL,
  `hargabagasi` decimal(20,2) NOT NULL,
  `hargabelireturn` decimal(20,2) NOT NULL,
  `hargaanakreturn` decimal(20,2) NOT NULL,
  `hargabagasireturn` decimal(20,2) NOT NULL,
  `marginpersen` float NOT NULL,
  `hargajual` decimal(20,2) NOT NULL,
  `hargajualtotal` decimal(20,2) NOT NULL,
  `pajak` float NOT NULL,
  `hrgjualdgnpajak` decimal(20,2) NOT NULL,
  `hargabelitotal` decimal(20,2) NOT NULL,
  `margintotal` decimal(20,2) NOT NULL,
  `statusdibayar` varchar(10) DEFAULT NULL,
  `tgl_dibayar` datetime DEFAULT NULL,
  `tgl_jatuh_tempo` datetime NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `no_po` int(11) NOT NULL,
  `sistem_bayar` varchar(10) NOT NULL,
  `metode_bayar` varchar(10) NOT NULL,
  `tgl_invoice` datetime NOT NULL,
  `username` varchar(20) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `no_invoice`, `tgl_penjualan`, `id_customer`, `nama_customer`, `tgl_in`, `tgl_out`, `jam_in`, `jam_out`, `tipe`, `jumlah`, `jumlahanak`, `nama_maskapai`, `asal`, `tujuan`, `hotel`, `nama_hotel`, `malam`, `jumlah_kamar`, `jenis_kamar`, `supplier`, `extra`, `kembali`, `kelas`, `hargabeli`, `hargaanak`, `sudah_total`, `hargahotel`, `hargabagasi`, `hargabelireturn`, `hargaanakreturn`, `hargabagasireturn`, `marginpersen`, `hargajual`, `hargajualtotal`, `pajak`, `hrgjualdgnpajak`, `hargabelitotal`, `margintotal`, `statusdibayar`, `tgl_dibayar`, `tgl_jatuh_tempo`, `keterangan`, `no_po`, `sistem_bayar`, `metode_bayar`, `tgl_invoice`, `username`, `tgl_transaksi`) VALUES
(3, '', '2018-09-16 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-09-26 00:00:00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'hotel', 0, 0, '', '', '', 'Y', 'ASTON', 2, 1, '1', '', '', '', '', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', '', 2, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-18 12:08:59'),
(7, '', '2018-09-16 00:00:00', 3, 'FAKULTAS KEDOKTERAN', '2018-09-01 00:00:00', '2018-09-20 00:00:00', '18:45:00', '23:40:00', 'pesawat', 1, 1, 'CITILINK AIRLINES', 'Selaparang Airport', 'Alastua', '', '', 0, 0, '', '', 'Y', 'y', '2', '0.00', '0.00', '', '0.00', '0.00', '100.00', '100.00', '100.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'aaa', 1, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-21 01:52:43'),
(10, '', '2018-09-16 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-09-08 00:00:00', '2018-09-16 00:00:00', '00:00:00', '00:00:00', 'pesawat', 1, 1, 'AIR ASIA', 'Amahai Airport', 'Selaparang Airport', '', '', 0, 0, '', '', 'Y', 'y', '3', '0.00', '0.00', '', '0.00', '0.00', '30000.00', '30000.00', '30000.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'aaaa', 9, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-21 01:46:50'),
(11, '', '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-09-15 00:00:00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'kereta', 0, 0, '', '', '', '', '', 0, 0, '', '', 'N', 'n', '', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'qqq', 10, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-20 23:32:59'),
(12, '', '2018-09-16 00:00:00', 32, 'k', '1970-01-01 00:00:00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'hotel', 0, 0, '', '', '', 'Y', 'ASTON', 1, 1, '1', '', '', '', '', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'klmn', 11, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-18 15:47:32'),
(13, '', '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-09-01 00:00:00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'hotel', 0, 0, '', '', '', 'Y', 'ASTON', 1, 1, '1', '', '', '', '', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', '', 12, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-17 01:47:50'),
(14, '', '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-09-01 00:00:00', '2018-09-15 00:00:00', '00:00:00', '00:00:00', 'pesawat', 1, 1, 'AIR ASIA', 'Selaparang Airport', 'Selaparang Airport', '', '', 0, 0, '', '', 'Y', 'y', '1', '0.00', '0.00', '', '0.00', '0.00', '20000.00', '20000.00', '20000.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'aaaaa', 13, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-17 08:32:26'),
(15, '', '2018-09-20 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-08-16 00:00:00', '2018-10-12 00:00:00', '00:00:00', '00:00:00', 'kereta', 1, 1, 'GUMARANG', 'Airtuba', 'Alastua', 'N', '', 0, 0, '', '', 'N', 'n', '3', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'yes', 0, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-20 20:37:47'),
(16, '', '2018-09-20 00:00:00', 3, 'FAKULTAS KEDOKTERAN', '2018-09-14 00:00:00', '0000-00-00 00:00:00', '00:10:00', '00:00:00', 'pesawat', 2, 2, 'GARUDA INDONESIA', 'Selaparang Airport', 'Selaparang Airport', '', '', 0, 0, '', '', 'N', 'n', '1', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'yes', 15, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-21 01:53:02'),
(17, '1000', '2018-09-20 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-09-05 00:00:00', '0000-00-00 00:00:00', '01:00:00', '00:00:00', 'pesawat', 1, 1, 'GARUDA INDONESIA', 'Amahai Airport', 'Amahai Airport', '', '', 0, 0, '', '', 'Y', 'n', '1', '1000.00', '1000.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 200, '9000.00', '9000.00', 10, '9900.00', '3000.00', '6000.00', NULL, NULL, '2018-10-20 00:00:00', 'aaaa', 16, 'TEMPO', '', '2018-09-20 00:00:00', 'yosua', '2018-09-21 03:36:37'),
(18, '', '2018-09-20 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-09-01 00:00:00', '2018-09-20 00:00:00', '03:35:00', '15:45:00', 'pesawat', 1, 2, '', 'Selaparang Airport', 'Hang Nadim Arpt', 'N', '', 0, 0, '', '', 'Y', 'y', '2', '0.00', '0.00', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', 0, '0.00', '0.00', '0.00', NULL, NULL, '0000-00-00 00:00:00', 'aaaa', 0, '', '', '0000-00-00 00:00:00', 'yosua', '2018-09-20 20:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `no_piutang` int(11) NOT NULL,
  `no_penjualan` int(10) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `tgl_jatuh_tempo` datetime NOT NULL,
  `jml_piutang` decimal(20,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_lunas` datetime NOT NULL,
  `debit` decimal(20,2) NOT NULL,
  `kredit` decimal(20,2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`no_piutang`, `no_penjualan`, `tgl_penjualan`, `id_customer`, `nama_customer`, `tgl_jatuh_tempo`, `jml_piutang`, `status`, `tgl_lunas`, `debit`, `kredit`, `username`, `keterangan`, `tgl_transaksi`) VALUES
(1, 10, '2018-09-16 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '', '2018-09-17 00:08:11'),
(2, 11, '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '', '2018-09-17 00:08:24'),
(4, 11, '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '', '2018-09-17 00:40:08'),
(5, 11, '2018-09-16 00:00:00', 1, 'RUMAH TANGGA UNDIP', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '', '2018-09-17 01:07:57'),
(6, 12, '2018-09-16 00:00:00', 32, 'k', '2018-10-16 00:00:00', '0.00', '', '0000-00-00 00:00:00', '0.00', '0.00', 'yosua', '', '2018-09-17 01:09:10'),
(11, 7, '2018-09-16 00:00:00', 3, 'FAKULTAS KEDOKTERAN', '2018-10-20 00:00:00', '26434806.00', '', '0000-00-00 00:00:00', '26434806.00', '0.00', 'yosua', '', '2018-09-20 09:36:07'),
(18, 17, '2018-09-20 00:00:00', 5, 'FAKULTAS PSIKOLOGI', '2018-10-20 00:00:00', '9900.00', '', '0000-00-00 00:00:00', '9900.00', '0.00', 'yosua', '', '2018-09-21 03:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `subgroupbiaya`
--

CREATE TABLE `subgroupbiaya` (
  `KD_GABUNGAN` varchar(20) NOT NULL,
  `KD_BEBAN` varchar(20) NOT NULL,
  `KD_SUBBEBAN` varchar(20) NOT NULL,
  `NM_SUBBEBAN` varchar(255) NOT NULL,
  `KATEGORI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subgroupbiaya`
--

INSERT INTO `subgroupbiaya` (`KD_GABUNGAN`, `KD_BEBAN`, `KD_SUBBEBAN`, `NM_SUBBEBAN`, `KATEGORI`) VALUES
('200.1', '200', '1', 'Biaya Gaji', 'Biaya Administrasi dan Umum'),
('200.2', '200', '2', 'Biaya Transport', 'Biaya Administrasi dan Umum'),
('200.3', '200', '3', 'Biaya Stationary', 'Biaya Administrasi dan Umum'),
('200.4', '200', '4', 'Biaya Pulsa', 'Biaya Administrasi dan Umum'),
('200.5', '200', '5', 'Biaya Meterai', 'Biaya Administrasi dan Umum'),
('200.6', '200', '6', 'Biaya Listrik', 'Biaya Administrasi dan Umum'),
('200.7', '200', '7', 'Biaya Telepon', 'Biaya Administrasi dan Umum'),
('200.8', '200', '8', 'Biaya Umum - GA', 'Biaya Administrasi dan Umum'),
('250.1', '250', '1', 'Biaya Iklan', 'Biaya Pemasaran'),
('250.2', '250', '2', 'Biaya Jaket', 'Biaya Pemasaran'),
('250.3', '250', '3', 'Biaya Material Promosi', 'Biaya Pemasaran'),
('250.4', '250', '4', 'Biaya Spanduk', 'Biaya Pemasaran'),
('250.5', '250', '5', 'Biaya Pameran', 'Biaya Pemasaran');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `almt_supplier` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_supplier` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_supplier` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kota_supplier` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_supplier` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipe_supplier` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `almt_supplier`, `telp_supplier`, `fax_supplier`, `kota_supplier`, `cp_supplier`, `tipe_supplier`, `status`) VALUES
(1, 'NUSANTARA TOUR', 'Semarang', '', '', 'SEMARANG', '90080', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `KD_USER` int(10) NOT NULL,
  `NM_USER` varchar(20) DEFAULT NULL,
  `LOGIN_NAME` varchar(15) DEFAULT NULL,
  `PWD` varchar(32) DEFAULT NULL,
  `IDGROUP` varchar(20) DEFAULT NULL,
  `USER_STATUS` int(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`KD_USER`, `NM_USER`, `LOGIN_NAME`, `PWD`, `IDGROUP`, `USER_STATUS`) VALUES
(1, 'Ariawan Suwanto', 'ariawan', 'a98e5f44ec1bc79d9fc96877f5255917', 'Administrator', 1),
(2, 'Yosua Alvin', 'yosua', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1),
(3, 'Rena', 'rena', 'ëÞççÚÈØÄõû', 'Administrasi', 1),
(4, 'Ali', 'ali', 'Úåâ', 'Supervisor', 1),
(5, 'UNDIPMAJU', 'UFOOD', 'ccfdbba643873ae3872dd6429c04ec53', 'Administrator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `groupbiaya`
--
ALTER TABLE `groupbiaya`
  ADD PRIMARY KEY (`KD_BEBAN`);

--
-- Indexes for table `hrgbeli`
--
ALTER TABLE `hrgbeli`
  ADD PRIMARY KEY (`kd_hrgbeli`);

--
-- Indexes for table `hrgjual`
--
ALTER TABLE `hrgjual`
  ADD PRIMARY KEY (`kd_hrgjual`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`no_hutang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`no_kas`);

--
-- Indexes for table `masterbandara`
--
ALTER TABLE `masterbandara`
  ADD PRIMARY KEY (`id_bandara`);

--
-- Indexes for table `masterhotel`
--
ALTER TABLE `masterhotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `masterkereta`
--
ALTER TABLE `masterkereta`
  ADD PRIMARY KEY (`id_kereta`);

--
-- Indexes for table `masterpesawat`
--
ALTER TABLE `masterpesawat`
  ADD PRIMARY KEY (`id_maskapai`);

--
-- Indexes for table `masterstasiun`
--
ALTER TABLE `masterstasiun`
  ADD PRIMARY KEY (`id_stasiun`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_po`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`no_piutang`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `nama_supplier` (`nama_supplier`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`KD_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hrgbeli`
--
ALTER TABLE `hrgbeli`
  MODIFY `kd_hrgbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrgjual`
--
ALTER TABLE `hrgjual`
  MODIFY `kd_hrgjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `no_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `no_kas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masterbandara`
--
ALTER TABLE `masterbandara`
  MODIFY `id_bandara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `masterpesawat`
--
ALTER TABLE `masterpesawat`
  MODIFY `id_maskapai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `masterstasiun`
--
ALTER TABLE `masterstasiun`
  MODIFY `id_stasiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `no_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `no_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
