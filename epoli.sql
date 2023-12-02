-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2023 pada 11.52
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
-- Database: `epoli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `kodedkt` varchar(15) NOT NULL,
  `namadkt` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `tarif` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `kodedkt`, `namadkt`, `alamat`, `telepon`, `tarif`, `id_poli`) VALUES
(5, 'DKT-101906', 'hari haru', 'surakarta', '085600929282', 150000, 7),
(6, 'DKT-101933', 'yanto pelet', 'sukoharjo', '081326530217', 175000, 9),
(7, 'DKT-125100', 'adi', 'jakarta', '087889997654', 240000, 8),
(8, 'DKT-125124', 'desi', 'palembang', '086778987654', 210000, 10),
(9, 'DKT-100555', 'latief', 'jakarta', '087654345678', 230000, 11),
(10, 'DKT-100623', 'nada asmara', 'palembang', '089998765678', 340000, 12),
(11, 'DKT-101846', 'rahmayani', 'surabaya', '086554345678', 240000, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
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
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `kode_obat`, `nama_obat`, `jenis_obat`, `stok`, `harga_obat`) VALUES
(1, ' OBT-001320', 'paramex', 'generik', 5, 10000),
(2, ' OBT-001516', 'dextro', 'non-generik', 8, 5000),
(3, ' OBT-001546', 'paracetamol', 'generik', 10, 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `kodepsn` varchar(15) NOT NULL,
  `namapsn` varchar(50) NOT NULL,
  `alamatpsn` text NOT NULL,
  `genderpsn` varchar(1) NOT NULL,
  `umurpsn` int(11) NOT NULL,
  `teleponpsn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kodepsn`, `namapsn`, `alamatpsn`, `genderpsn`, `umurpsn`, `teleponpsn`) VALUES
(2, 'PSN-294034', 'jono', 'surakarta', 'L', 12, '089765145267'),
(3, 'PSN-294058', 'hadi', 'jakarta', 'L', 19, '08876538893'),
(4, 'PSN-302445', 'putri', 'palembang', 'P', 19, '086778996554'),
(5, 'PSN-303749', 'jodi', 'solo', 'L', 19, '087889887665'),
(6, 'PSN-050106', 'salsa', 'karangasem', 'P', 17, '089889998765'),
(7, 'PSN-120436', 'tono', 'sukoharjo', 'L', 25, '089998765677'),
(8, 'PSN-120517', 'adinda', 'surakarta', 'P', 27, '087654321234'),
(9, 'PSN-120554', 'heni', 'boyolali', 'P', 24, '089765456789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nama_pasien`, `jenis_poli`, `tarif_dokter`, `tagihan_obat`, `total_pembayaran`, `tanggal_pembayaran`) VALUES
(13, 'adinda', 'Jantung', 150000, 15000, 165000, '2023-12-02 06:55:37'),
(14, 'putri', 'Gigi', 100000, 8000, 108000, '2023-12-02 06:25:42'),
(16, 'jono', 'Mata', 0, 8000, 8000, '2023-12-02 06:12:45'),
(17, 'jono', 'Mata', 0, 8000, 8000, '2023-12-02 06:12:45'),
(18, 'tono', 'Jantung', 120000, 8000, 128000, '2023-12-02 06:25:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
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
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `tanggal_daftar`, `dokter`, `pasien`, `poli`, `tarif`) VALUES
(5, '2023-12-01 23:19:46', 'hari haru', 'adinda', 'Jantung', 150000),
(6, '2017-12-16 01:01:25', 'desi', 'jono', 'Mata', 0),
(7, '2017-12-16 01:18:17', 'adi', 'jodi', 'Gigi', 0),
(8, '2023-12-02 06:15:26', 'adi', 'putri', 'Gigi', 100000),
(9, '2017-12-16 01:37:53', 'latief', 'heni', 'Tht', 0),
(10, '2023-12-02 06:15:38', 'rahmayani', 'tono', 'Jantung', 120000),
(11, '2017-12-16 01:38:05', 'adi', 'hadi', 'Gigi', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id_poli` int(11) NOT NULL,
  `poli` varchar(20) NOT NULL,
  `kodeplk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `poliklinik`
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(4, 'operator', '4b583376b2767b923c3e1da60d10de59', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_dokter` (`dokter`),
  ADD KEY `id_pasien` (`pasien`),
  ADD KEY `id_poli` (`poli`);

--
-- Indeks untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id_poli`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id_poli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
