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
CREATE DATABASE IF NOT EXISTS `posyandu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `posyandu`;

-- Dumping structure for table posyandu.data_bayi
CREATE TABLE IF NOT EXISTS `data_bayi` (
  `id_bayi` int NOT NULL AUTO_INCREMENT,
  `id_warga` int DEFAULT NULL,
  `nama_bayi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `umur` float DEFAULT NULL,
  `linkar_kepala` float DEFAULT NULL,
  `bb` float DEFAULT NULL,
  `kondisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_bayi`),
  KEY `id_user` (`id_warga`),
  CONSTRAINT `FK_data_bayi_data_warga` FOREIGN KEY (`id_warga`) REFERENCES `data_warga` (`id_warga`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_bayi: ~1 rows (approximately)
REPLACE INTO `data_bayi` (`id_bayi`, `id_warga`, `nama_bayi`, `umur`, `linkar_kepala`, `bb`, `kondisi`) VALUES
	(1, 2, 'Saeful', 0.3, 37, 3.64, '1');

-- Dumping structure for table posyandu.data_ibu_hamil
CREATE TABLE IF NOT EXISTS `data_ibu_hamil` (
  `id_ibu_hamil` int NOT NULL AUTO_INCREMENT,
  `id_warga` int DEFAULT NULL,
  `usia_kehamilan` int DEFAULT NULL,
  `kondisi_janin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_ibu_hamil`),
  KEY `id_warga` (`id_warga`),
  CONSTRAINT `FK_data_ibu_hamil_data_warga` FOREIGN KEY (`id_warga`) REFERENCES `data_warga` (`id_warga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_ibu_hamil: ~0 rows (approximately)

-- Dumping structure for table posyandu.data_kader
CREATE TABLE IF NOT EXISTS `data_kader` (
  `id_kader` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `umur` int NOT NULL DEFAULT (0),
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kader`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_data_kader_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_kader: ~0 rows (approximately)

-- Dumping structure for table posyandu.data_warga
CREATE TABLE IF NOT EXISTS `data_warga` (
  `id_warga` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_tlp` bigint DEFAULT NULL,
  `bb` float DEFAULT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_warga`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_data_warga_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_warga: ~1 rows (approximately)
REPLACE INTO `data_warga` (`id_warga`, `id_user`, `nama`, `alamat`, `no_tlp`, `bb`, `kondisi`) VALUES
	(2, 4, 'Nisa', 'Jl. Jl.', 81234567890, 50, '1');

-- Dumping structure for table posyandu.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.user: ~4 rows (approximately)
REPLACE INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
	(1, 'admin@gmail.com', 'admin1#', 'admin'),
	(2, 'miranti@gmail.com', '1234#', 'kader'),
	(3, 'bobon@gmail.com', 'bobon1234#', 'warga'),
	(4, 'nisa@gmail.com', 'nisa1234#', 'warga');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
