-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 08:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(225) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `level` enum('admin','bendahara') DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `email`, `no_hp`, `level`, `id`) VALUES
('admin', '$2y$10$TdswzLbNdl0LIQKDnVVjQ.VuVLMQIIp2mJuMmYZqiSjgTj3a4Buz2', 'Mimin', 'admin@admin.com', '0876626265', 'admin', 1),
('bendahara', '$2y$10$FoIEjegkwl7buic5z9b92eI9SWhmMEPIrjuYXoFRo6c2MLwYrMl4y', 'Lina', 'lina@gmail.com', '085733336683', 'bendahara', 4),
('loket', '$2y$10$Ywj33XWd0A5.p484VjKwWu8dZaW5Rl0aR2b/VA7DBUafNk26HHu/S', 'loket', 'loket@gmail.com', '08', 'bendahara', 5),
('pil', '$2y$10$UMIcd6Xrhtn5bZUfnGw56.jl1njDEKx0sdnznE8Ulpji3gzsVnLVW', 'Putri Indah Lestari', 'pilreand27@gmail.com', '087772727272', 'bendahara', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(56, 'X MIPA 1'),
(57, 'X MIPA 2');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `multi_bebas`
--

CREATE TABLE `multi_bebas` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `harus_dibayar` float DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kd_tagihan` varchar(100) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tanggungan` float DEFAULT NULL,
  `sudah_dibayar` float DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `multi_bulanan`
--

CREATE TABLE `multi_bulanan` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `harus_dibayar` float DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kd_tagihan` varchar(100) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tanggungan` float DEFAULT NULL,
  `sudah_dibayar` float DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nama_pembayaran` varchar(200) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `tipe_pembayaran` enum('bebas','bulanan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `total_pengeluaran` float DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `bendahara` varchar(100) DEFAULT NULL,
  `logo_kanan` varchar(200) DEFAULT NULL,
  `logo_kiri` varchar(200) DEFAULT NULL,
  `sid_twilo` varchar(100) DEFAULT NULL,
  `token_twilo` varchar(100) DEFAULT NULL,
  `number_twilo` varchar(100) DEFAULT NULL,
  `visi` mediumtext DEFAULT NULL,
  `misi` mediumtext DEFAULT NULL,
  `kepsek` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_sekolah`, `alamat`, `bendahara`, `logo_kanan`, `logo_kiri`, `sid_twilo`, `token_twilo`, `number_twilo`, `visi`, `misi`, `kepsek`) VALUES
(1, 'SMK PERCOBAAN', 'ln. Pawiyatan No 06, Kecamatan Gudo, Gudo, Kec. Gudo, Kabupten Jombang', 'Mimin', 'kanan_1.png', 'kiri_1.jpg', 'ACe305503a269b6d184ddfcee6c934f9ed', '337bb30ef5490cce7f413afb923e0f1f', '+15109440228', '<i>Profesional , Mandiri, Berwawasan Kebangsaan, Beriman dan taqwa.</i>', '1. Membentuk tamatan yang berakhlak mulia, beriman dan bertaqwa kepadaTuhan Yang Maha Esa<br>\r\n2. Menanamkan dan menciptakan kultur sekolah yang berwawasan kebangsaan<br>\r\n3. Mencetak tamatan yang profesional di bidangnya sehingga mampu bersaing di dunia kerja<br>\r\n4. Mampu menciptakan lapangan pekerjaan sesuai dengan kompetensinya<br>', 'Drs. Alfian Renaldi');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(100) NOT NULL,
  `nisn` varchar(100) DEFAULT NULL,
  `nama_siswa` varchar(200) DEFAULT NULL,
  `agama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `nama_ortu` varchar(100) DEFAULT NULL,
  `status` enum('L','T','P') DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nisn`, `nama_siswa`, `agama`, `alamat`, `password`, `nama_ortu`, `status`, `id_kelas`, `jenis_kelamin`, `no_hp`) VALUES
('5190411312', '100', 'Ardhika Restu Yoviyanto', 'Islam', 'Bondalem, RT 02/RW 05 Jumapolo, Karanganyar', '$2y$10$bfbPx6WwmdgD0Recgom5t.tvBo8yqJW0/77vphAsgCcb3jYhJRYf6', 'Saidi', 'T', 56, 'L', '082313104589');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_bebas`
--

CREATE TABLE `tagihan_bebas` (
  `id_tagihan` int(11) NOT NULL,
  `nis` varchar(200) DEFAULT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `total_tagihan` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_bulanan`
--

CREATE TABLE `tagihan_bulanan` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `tag_jan` float DEFAULT NULL,
  `tag_feb` float DEFAULT NULL,
  `tag_mar` float DEFAULT NULL,
  `tag_apr` float DEFAULT NULL,
  `tag_mei` float DEFAULT NULL,
  `tag_jun` float DEFAULT NULL,
  `tag_jul` float DEFAULT NULL,
  `tag_agu` float DEFAULT NULL,
  `tag_sep` float DEFAULT NULL,
  `tag_okt` float DEFAULT NULL,
  `tag_nov` float DEFAULT NULL,
  `tag_des` float DEFAULT NULL,
  `sta_jan` enum('Y','N') DEFAULT NULL,
  `sta_feb` enum('Y','N') DEFAULT NULL,
  `sta_mar` enum('Y','N') DEFAULT NULL,
  `sta_apr` enum('Y','N') DEFAULT NULL,
  `sta_mei` enum('Y','N') DEFAULT NULL,
  `sta_jun` enum('Y','N') DEFAULT NULL,
  `sta_jul` enum('Y','N') DEFAULT NULL,
  `sta_agu` enum('Y','N') DEFAULT NULL,
  `sta_sep` enum('Y','N') DEFAULT NULL,
  `sta_okt` enum('Y','N') DEFAULT NULL,
  `sta_nov` enum('Y','N') DEFAULT NULL,
  `sta_des` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `status_tahunajar` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`tahun_ajaran`, `id`, `status_tahunajar`) VALUES
('2020/2021', 2, 'Y'),
('2021/2022', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bebas`
--

CREATE TABLE `transaksi_bebas` (
  `id_transaksi` int(11) NOT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status_bayar` enum('lunas','angsuran 1','angsuran 2','angsuran 3','angsuran 4','angsuran 5') DEFAULT NULL,
  `total_bayar` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bulanan`
--

CREATE TABLE `transaksi_bulanan` (
  `id_transaksi` int(11) NOT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `total_bayar` float DEFAULT NULL,
  `bulan` enum('jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multi_bebas`
--
ALTER TABLE `multi_bebas`
  ADD KEY `MultiBebas` (`id_tagihan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `multi_bulanan`
--
ALTER TABLE `multi_bulanan`
  ADD KEY `MultiBulanan` (`id_tagihan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `idpembayaran` (`id_pembayaran`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `KelasId` (`id_kelas`);

--
-- Indexes for table `tagihan_bebas`
--
ALTER TABLE `tagihan_bebas`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `PembayaranId` (`id_pembayaran`),
  ADD KEY `Nis` (`nis`);

--
-- Indexes for table `tagihan_bulanan`
--
ALTER TABLE `tagihan_bulanan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `NiSsiswa` (`nis`),
  ADD KEY `TagihanSISWA` (`id_pembayaran`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_bebas`
--
ALTER TABLE `transaksi_bebas`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `TagihanId` (`id_tagihan`);

--
-- Indexes for table `transaksi_bulanan`
--
ALTER TABLE `transaksi_bulanan`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `Id_Tagihan` (`id_tagihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multi_bebas`
--
ALTER TABLE `multi_bebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multi_bulanan`
--
ALTER TABLE `multi_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tagihan_bebas`
--
ALTER TABLE `tagihan_bebas`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=925;

--
-- AUTO_INCREMENT for table `tagihan_bulanan`
--
ALTER TABLE `tagihan_bulanan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=967;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_bebas`
--
ALTER TABLE `transaksi_bebas`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_bulanan`
--
ALTER TABLE `transaksi_bulanan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `multi_bebas`
--
ALTER TABLE `multi_bebas`
  ADD CONSTRAINT `MultiBebas` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bebas` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multi_bulanan`
--
ALTER TABLE `multi_bulanan`
  ADD CONSTRAINT `MultiBulanan` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bulanan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `idpembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `KelasId` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagihan_bebas`
--
ALTER TABLE `tagihan_bebas`
  ADD CONSTRAINT `Nis` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PembayaranId` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagihan_bulanan`
--
ALTER TABLE `tagihan_bulanan`
  ADD CONSTRAINT `NiSsiswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TagihanSISWA` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_bebas`
--
ALTER TABLE `transaksi_bebas`
  ADD CONSTRAINT `TagihanId` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bebas` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_bulanan`
--
ALTER TABLE `transaksi_bulanan`
  ADD CONSTRAINT `Id_Tagihan` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bulanan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
