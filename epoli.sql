-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 02:08 AM
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
-- Database: `epoli`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `namadkt` varchar(30) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `jmpraktek` varchar(30) NOT NULL,
  `tarif` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `namadkt`, `jk`, `alamat`, `telepon`, `jmpraktek`, `tarif`, `id_poli`) VALUES
(5, 'Syarif Hidayatullah', 'Laki-Laki', 'Gubeng, Gubeng, Surabaya', '085600929282', 'Senin-Kamis(08.00-15.00)', 150000, 7),
(6, 'Rudy Ardiansyah', 'Laki-Laki', 'Gading, Jatirejo, Mojokerto', '081326530217', 'Senin-Kamis(14.00-21.00)', 175000, 9),
(7, 'Heri Purwanto', 'Laki-Laki', 'Sumberejo, Grogol, Kediri', '087889997654', 'Kamis-Senin(08.00-15.00)', 240000, 8),
(8, 'Arini Al Hikmah', 'Perempuan', 'Banyu Urip, Sawahan, Surabaya', '086778987654', 'Kamis-Senin(14.00-21.00)', 210000, 10),
(9, 'Wilson Kurniawan', 'Laki-Laki', 'Cideng, Gambir, Jakarta', '087654345678', 'Sabtu-Rabu(08.00-15.00)', 230000, 11),
(10, 'Nada Asmara', 'Perempuan', 'Karang, Gandus, Palembang', '089998765678', 'Minggu-Rabu(08.00-15.00)', 340000, 12),
(11, 'Puput Paramita', 'Perempuan', 'Ganting, Gedangan, Sidoarjo', '086554345678', 'Sabtu-Rabu(14.00-21.00)', 240000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(15) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga_obat` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `kode_obat`, `nama_obat`, `jenis_obat`, `stok`, `harga_obat`) VALUES
(1, '   OBT-001320', 'Paramex', 'generik', 19, 10000),
(2, '  OBT-001516', 'Demacolin', 'non-generik', 19, 5000),
(3, '  OBT-001546', 'Paracetamol', 'generik', 19, 8000),
(6, 'OBT-003249', 'Antangin', 'generik', 19, 4000),
(7, 'OBT-003430', 'Promag', 'generik', 19, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `namapsn` varchar(50) NOT NULL,
  `alamatpsn` text NOT NULL,
  `genderpsn` varchar(1) NOT NULL,
  `umurpsn` int(11) NOT NULL,
  `teleponpsn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `namapsn`, `alamatpsn`, `genderpsn`, `umurpsn`, `teleponpsn`) VALUES
(2, 'Steven  wiliam', 'Airlangga, Gubeng, Surabaya', 'L', 12, '089765145267'),
(3, 'Alamul Huda', 'Sukodono, Sukodono, Sidoarjo', 'L', 19, '08876538893'),
(4, 'Putri Kharisma', 'Tambak, Gunung Anyar, Surabaya', 'P', 19, '086778996554'),
(5, 'Ahmad Afandi', 'Ngumpul, Jogoroto, Jombang', 'L', 19, '087889887665'),
(6, 'Salsa Syafira', 'Bringin Canggu, Badas, Kediri', 'P', 17, '089889998765'),
(7, 'Priyo Utomo', 'Mlancu, Kandangan, Kediri', 'L', 25, '089998765677'),
(8, 'Syakira Azzahra', 'Mejoyo, Bangsal, Mojokerto', 'P', 27, '087654321234'),
(9, 'Indri Adelia', 'Claket, Pacet, Mojokerto', 'P', 24, '089765456789'),
(10, 'Budi Santoso', 'Kedungpari, Mojowarno, Jombang', 'L', 23, '082121212111');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(20) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `jenis_poli` varchar(20) NOT NULL,
  `tarif_dokter` int(100) NOT NULL,
  `tagihan_obat` int(30) NOT NULL,
  `total_pembayaran` int(100) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nama_pasien`, `jenis_poli`, `tarif_dokter`, `tagihan_obat`, `total_pembayaran`, `tanggal_pembayaran`) VALUES
(24, 'jono', 'Mata', 210000, 10000, 220000, '2023-12-15 12:17:55'),
(25, 'putri', 'Gigi', 100000, 10000, 110000, '2023-12-15 12:18:30'),
(26, 'tono', 'Jantung', 120000, 16000, 136000, '2023-12-15 12:22:15'),
(27, 'adinda', 'Mata', 210000, 16000, 226000, '2023-12-15 12:23:17'),
(28, 'adinda', 'Kulit', 175000, 15000, 190000, '2023-12-15 12:24:04'),
(29, 'adinda', 'Jantung', 150000, 23000, 173000, '2023-12-15 12:24:43'),
(30, 'adinda', 'Kulit', 175000, 10000, 185000, '2023-12-15 12:27:36'),
(31, 'adinda', 'Gigi', 240000, 10000, 250000, '2023-12-15 12:28:09'),
(32, 'adinda', 'Mata', 210000, 10000, 220000, '2023-12-15 12:28:43'),
(33, 'adinda', 'Kulit', 175000, 10000, 185000, '2023-12-15 12:28:56'),
(34, 'adinda', 'Jantung', 150000, 17000, 167000, '2023-12-15 12:36:15'),
(35, 'adinda', 'Mata', 210000, 15000, 225000, '2023-12-16 03:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dokter` varchar(20) NOT NULL,
  `pasien` varchar(20) NOT NULL,
  `poli` varchar(20) NOT NULL,
  `tarif` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `tanggal_daftar`, `dokter`, `pasien`, `poli`, `tarif`) VALUES
(19, '2023-12-09 02:50:37', 'yanto pelet', 'salsa', 'Kulit', 175000),
(30, '2023-12-17 15:36:43', 'Syarif Hidayatullah', 'jodi', 'Jantung', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `poli` varchar(20) NOT NULL,
  `kodeplk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`id_poli`, `poli`, `kodeplk`) VALUES
(7, 'Jantung', 'PLK-001539'),
(8, 'Gigi', 'PLK-001546'),
(9, 'Kulit', 'PLK-001550'),
(10, 'Mata', 'PLK-001553'),
(11, 'Tht', 'PLK-004404'),
(12, 'Saraf', 'PLK-004420');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(4, 'operator', '4b583376b2767b923c3e1da60d10de59', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_dokter` (`dokter`),
  ADD KEY `id_pasien` (`pasien`),
  ADD KEY `id_poli` (`poli`),
  ADD KEY `tarif` (`tarif`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
