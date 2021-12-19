/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.21-MariaDB : Database - db_spp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_spp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_spp`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(225) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `level` enum('admin','bendahara') DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `multi_bebas` */

DROP TABLE IF EXISTS `multi_bebas`;

CREATE TABLE `multi_bebas` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `harus_dibayar` float DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kd_tagihan` varchar(100) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tanggungan` float DEFAULT NULL,
  `sudah_dibayar` float DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `MultiBebas` (`id_tagihan`),
  KEY `id` (`id`),
  CONSTRAINT `MultiBebas` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bebas` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `multi_bulanan` */

DROP TABLE IF EXISTS `multi_bulanan`;

CREATE TABLE `multi_bulanan` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `harus_dibayar` float DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `kd_tagihan` varchar(100) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tanggungan` float DEFAULT NULL,
  `sudah_dibayar` float DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `MultiBulanan` (`id_tagihan`),
  KEY `id` (`id`),
  CONSTRAINT `MultiBulanan` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bulanan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pembayaran` varchar(200) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `tipe_pembayaran` enum('bebas','bulanan') DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembayaran` int(11) DEFAULT NULL,
  `total_pengeluaran` float DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`),
  KEY `idpembayaran` (`id_pembayaran`),
  CONSTRAINT `idpembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `kepsek` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

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
  `no_hp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nis`),
  KEY `KelasId` (`id_kelas`),
  CONSTRAINT `KelasId` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tagihan_bebas` */

DROP TABLE IF EXISTS `tagihan_bebas`;

CREATE TABLE `tagihan_bebas` (
  `id_tagihan` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(200) DEFAULT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `total_tagihan` float DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `PembayaranId` (`id_pembayaran`),
  KEY `Nis` (`nis`),
  CONSTRAINT `Nis` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PembayaranId` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=925 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tagihan_bulanan` */

DROP TABLE IF EXISTS `tagihan_bulanan`;

CREATE TABLE `tagihan_bulanan` (
  `nis` varchar(100) DEFAULT NULL,
  `id_tagihan` int(11) NOT NULL AUTO_INCREMENT,
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
  `sta_des` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `NiSsiswa` (`nis`),
  KEY `TagihanSISWA` (`id_pembayaran`),
  CONSTRAINT `NiSsiswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TagihanSISWA` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=967 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tahun_ajaran` */

DROP TABLE IF EXISTS `tahun_ajaran`;

CREATE TABLE `tahun_ajaran` (
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_tahunajar` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `transaksi_bebas` */

DROP TABLE IF EXISTS `transaksi_bebas`;

CREATE TABLE `transaksi_bebas` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_tagihan` int(11) DEFAULT NULL,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status_bayar` enum('lunas','angsuran 1','angsuran 2','angsuran 3','angsuran 4','angsuran 5') DEFAULT NULL,
  `total_bayar` float DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `TagihanId` (`id_tagihan`),
  CONSTRAINT `TagihanId` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bebas` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `transaksi_bulanan` */

DROP TABLE IF EXISTS `transaksi_bulanan`;

CREATE TABLE `transaksi_bulanan` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_pembayaran` enum('transfer','tunai') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `total_bayar` float DEFAULT NULL,
  `bulan` enum('jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des') DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `Id_Tagihan` (`id_tagihan`),
  CONSTRAINT `Id_Tagihan` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan_bulanan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
