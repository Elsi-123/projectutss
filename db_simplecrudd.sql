/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - db_simplecrud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_simplecrud`;

-- Dumping structure for table db_simplecrud.tb_selebriti
CREATE TABLE IF NOT EXISTS `tb_selebriti` (
  `id_slb` int(11) NOT NULL AUTO_INCREMENT,
  `kode_slb` char(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_slb` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `profesi_slb` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` mediumint(3) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medsos` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_mhs` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_slb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_selebriti: ~0 rows (approximately)

-- Dumping structure for table db_simplecrud.tb_profesi
CREATE TABLE IF NOT EXISTS `tb_profesi` (
  `kode_profesi` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_profesi` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_profesi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_profesi: ~9 rows (approximately)
INSERT INTO `tb_profesi` (`kode_profesi`, `nama_profesi`) VALUES
	('AKT', 'Aktor'),
	('ATR', 'Aktris'),
	('PYI', 'Penyanyi'),
	('PSTR', 'Presenter'),
	('MD', 'Model'),
	('KMK', 'Komika'),
	('SRD', 'Sutradara');

-- Dumping structure for table db_simplecrud.tb_provinsi
CREATE TABLE IF NOT EXISTS `tb_provinsi` (
  `id_provinsi` smallint(3) NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_provinsi: ~6 rows (approximately)
INSERT INTO `tb_provinsi` (`id_provinsi`, `nama_provinsi`) VALUES
	(1, 'Bali'),
	(2, 'Nusa Tenggara Timur'),
	(3, 'Medan'),
	(4, 'Jakarta'),
	(5, 'Jawa Tengah'),
	(6, 'Jawa Barat');

/*Table structure for table `tb_selebriti` */

DROP TABLE IF EXISTS `tb_selebriti`;

CREATE TABLE `tb_selebriti` (
  `id_slb` int NOT NULL AUTO_INCREMENT,
  `kode_slb` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_slb` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `profesi_slb` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` mediumint NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medsos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_slb` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_slb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_selebriti` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
