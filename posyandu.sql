-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for posyandu
DROP DATABASE IF EXISTS `posyandu`;
CREATE DATABASE IF NOT EXISTS `posyandu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `posyandu`;

-- Dumping structure for table posyandu.data_bayi
DROP TABLE IF EXISTS `data_bayi`;
CREATE TABLE IF NOT EXISTS `data_bayi` (
  `id_bayi` int NOT NULL AUTO_INCREMENT,
  `id_warga` int DEFAULT NULL,
  `nama_bayi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `umur` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkar_kepala` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bb` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_bayi`),
  KEY `id_user` (`id_warga`),
  CONSTRAINT `FK_data_bayi_data_warga` FOREIGN KEY (`id_warga`) REFERENCES `data_warga` (`id_warga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_bayi: ~0 rows (approximately)

-- Dumping structure for table posyandu.data_ibu_hamil
DROP TABLE IF EXISTS `data_ibu_hamil`;
CREATE TABLE IF NOT EXISTS `data_ibu_hamil` (
  `id_ibu_hamil` int NOT NULL AUTO_INCREMENT,
  `id_warga` int DEFAULT NULL,
  `usia_kehamilan` int DEFAULT NULL,
  `kondisi_janin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_ibu_hamil`),
  KEY `id_warga` (`id_warga`),
  CONSTRAINT `FK_data_ibu_hamil_data_warga` FOREIGN KEY (`id_warga`) REFERENCES `data_warga` (`id_warga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_ibu_hamil: ~0 rows (approximately)

-- Dumping structure for table posyandu.data_kader
DROP TABLE IF EXISTS `data_kader`;
CREATE TABLE IF NOT EXISTS `data_kader` (
  `id_kader` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `umur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `alamat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kader`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_data_kader_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_kader: ~0 rows (approximately)

-- Dumping structure for table posyandu.data_warga
DROP TABLE IF EXISTS `data_warga`;
CREATE TABLE IF NOT EXISTS `data_warga` (
  `id_warga` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_tlp` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bb` int DEFAULT NULL,
  `kondisi` int DEFAULT NULL,
  PRIMARY KEY (`id_warga`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_data_warga_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_warga: ~0 rows (approximately)

-- Dumping structure for table posyandu.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.user: ~3 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
	(1, 'admin', 'admin', 'admin'),
	(2, 'miranti', '1234', 'kader'),
	(3, 'bobon', 'bobon1234', 'warga'),
	(4, 'nisa ', 'nisa1234', 'warga');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
