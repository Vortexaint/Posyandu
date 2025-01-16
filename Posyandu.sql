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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_bayi: ~1 rows (approximately)
REPLACE INTO `data_bayi` (`id_bayi`, `id_warga`, `nama_bayi`, `umur`, `linkar_kepala`, `bb`, `kondisi`) VALUES
	(1, 2, 'Saeful', 0.3, 37, 3.64, '1'),
  (2, NULL, 'Bayu', 1.5, 40, 10.2, 'Sehat'),
  (3, NULL, 'Siti', 2, 42, 11.3, 'Sehat'),
  (4, NULL, 'Rina', 1.8, 39.5, 10.0, 'Sehat'),
  (5, NULL, 'Doni', 1.2, 38, 9.8, 'Kurang Gizi'),
  (6, NULL, 'Lia', 0.9, 37, 8.5, 'Sehat'),
  (7, NULL, 'Andi', 1.1, 39, 9.6, 'Sehat'),
  (8, NULL, 'Putri', 1.7, 40.5, 10.4, 'Sehat'),
  (9, NULL, 'Rama', 2.1, 41, 11.0, 'Sehat'),
  (10, NULL, 'Dewi', 1.4, 39.8, 10.1, 'Sehat'),
  (11, NULL, 'Nisa', 1.3, 39.2, 9.9, 'Sehat'),
  (12, NULL, 'Ahmad', 1.6, 40.7, 10.8, 'Sehat'),
  (13, NULL, 'Rini', 1.9, 41.2, 11.2, 'Sehat'),
  (14, NULL, 'Citra', 1.0, 38.5, 9.4, 'Sehat'),
  (15, NULL, 'Budi', 2.3, 41.8, 11.5, 'Sehat'),
  (16, NULL, 'Dina', 2.0, 41.0, 11.1, 'Sehat'),
  (17, NULL, 'Fikri', 0.8, 37.8, 8.9, 'Sehat'),
  (18, NULL, 'Mila', 1.2, 38.9, 9.7, 'Sehat'),
  (19, NULL, 'Sandi', 1.7, 40.3, 10.5, 'Sehat'),
  (20, NULL, 'Rosa', 1.5, 39.7, 10.0, 'Sehat');

-- Dumping structure for table posyandu.data_ibu_hamil
CREATE TABLE IF NOT EXISTS `data_ibu_hamil` (
  `id_ibu_hamil` int NOT NULL AUTO_INCREMENT,
  `id_warga` int DEFAULT NULL,
  `usia_kehamilan` float DEFAULT NULL,
  `kondisi_janin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_ibu_hamil`),
  KEY `id_warga` (`id_warga`),
  CONSTRAINT `FK_data_ibu_hamil_data_warga` FOREIGN KEY (`id_warga`) REFERENCES `data_warga` (`id_warga`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_ibu_hamil: ~1 rows (approximately)
REPLACE INTO `data_ibu_hamil` (`id_ibu_hamil`, `id_warga`, `usia_kehamilan`, `kondisi_janin`) VALUES
	(1, 11, 4, 'Chill');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_kader: ~1 rows (approximately)
REPLACE INTO `data_kader` (`id_kader`, `id_user`, `nama`, `umur`, `alamat`) VALUES
	(1, NULL, 'Julian', 18, 'Jl. Jl.'),
  (2, NULL, 'Miranti', 30, 'Jl. Mawar No. 1'),
  (3, NULL, 'Budi Santoso', 29, 'Jl. Melati No. 2'),
  (4, NULL, 'Citra Dewi', 35, 'Jl. Anggrek No. 3'),
  (5, NULL, 'Doni Wijaya', 28, 'Jl. Kenanga No. 4'),
  (6, NULL, 'Eka Pratama', 32, 'Jl. Flamboyan No. 5'),
  (7, NULL, 'Fajar', 33, 'Jl. Kamboja No. 6'),
  (8, NULL, 'Gita', 27, 'Jl. Dahlia No. 7'),
  (9, NULL, 'Hendra', 36, 'Jl. Cempaka No. 8'),
  (10, NULL, 'Intan', 26, 'Jl. Teratai No. 9'),
  (11, NULL, 'Joko', 31, 'Jl. Bougenville No. 10'),
  (12, NULL, 'Kirana', 30, 'Jl. Mawar No. 11'),
  (13, NULL, 'Lutfi', 29, 'Jl. Melati No. 12'),
  (14, NULL, 'Mira', 35, 'Jl. Anggrek No. 13'),
  (15, NULL, 'Nina', 28, 'Jl. Kenanga No. 14'),
  (16, NULL, 'Oka', 32, 'Jl. Flamboyan No. 15'),
  (17, NULL, 'Putra', 33, 'Jl. Kamboja No. 16'),
  (18, NULL, 'Qori', 27, 'Jl. Dahlia No. 17'),
  (19, NULL, 'Rizki', 36, 'Jl. Cempaka No. 18'),
  (20, NULL, 'Siska', 26, 'Jl. Teratai No. 19');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.data_warga: ~18 rows (approximately)
REPLACE INTO `data_warga` (`id_warga`, `id_user`, `nama`, `alamat`, `no_tlp`, `bb`, `kondisi`) VALUES
	(1, NULL, 'Vorty', 'Jl. Jl.', 12346789, 32, 'Sehat'),
	(2, 4, 'Nisa', 'Jl. Jl.', 81234567890, 50, 'Sehat'),
	(5, NULL, 'Bayu Pratama', 'Jl. Mangga No. 10', 82123456789, 65.5, 'Sehat'),
	(6, NULL, 'Siti Aminah', 'Jl. Rambutan No. 12', 81234567890, 55, 'Sehat'),
	(7, NULL, 'Rina Kurnia', 'Jl. Durian No. 14', 81345678901, 60, 'Sehat'),
	(8, NULL, 'Doni Maulana', 'Jl. Apel No. 16', 81456789012, 70, 'Sehat'),
	(9, NULL, 'Lia Kartika', 'Jl. Pisang No. 18', 81567890123, 50, 'Sehat'),
	(10, NULL, 'Andi Nugroho', 'Jl. Pepaya No. 20', 81678901234, 62, 'Sehat'),
	(11, NULL, 'Putri Ayu', 'Jl. Kelapa No. 22', 81789012345, 48, 'Sehat'),
	(12, NULL, 'Rama Putra', 'Jl. Semangka No. 24', 81890123456, 80, 'Sehat'),
	(13, NULL, 'Dewi Lestari', 'Jl. Nanas No. 26', 81901234567, 58, 'Sehat'),
	(14, NULL, 'Nisa Rahma', 'Jl. Salak No. 28', 82012345678, 52, 'Sehat'),
	(15, NULL, 'Ahmad Fauzi', 'Jl. Manggis No. 30', 82123456789, 68, 'Sehat'),
	(16, NULL, 'Rini', 'Jl. Rambutan No. 32', 81234567890, 54, 'Sehat'),
	(17, NULL, 'Citra Indah', 'Jl. Durian No. 34', 81345678901, 59, 'Sehat'),
	(18, NULL, 'Budi', 'Jl. Apel No. 36', 81456789012, 72, 'Sehat'),
	(19, NULL, 'Dina Kusuma', 'Jl. Pisang No. 38', 81567890123, 47, 'Sehat'),
	(20, NULL, 'Fikri Wahyu', 'Jl. Pepaya No. 40', 81678901234, 61, 'Sehat');

-- Dumping structure for table posyandu.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table posyandu.user: ~5 rows (approximately)
REPLACE INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
	(1, 'admin@gmail.com', 'admin1#', 'admin'),
	(2, 'miranti@gmail.com', '1234#', 'kader'),
	(3, 'bobon@gmail.com', 'bobon1234#', 'warga'),
	(4, 'nisa@gmail.com', 'nisa1234#', 'warga'),
	(5, 'vortex@gmail.com', 'REEYHAN1a#', 'warga');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
