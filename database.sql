-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk audit_database
CREATE DATABASE IF NOT EXISTS `audit_database` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `audit_database`;

-- membuang struktur untuk table audit_database.bagian
CREATE TABLE IF NOT EXISTS `bagian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel audit_database.bagian: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;
INSERT INTO `bagian` (`id`, `nama`, `description`) VALUES
	(3, 'Vendor Development', '-'),
	(4, 'Development Quality Assurance', '-'),
	(5, 'Field Quality Assurance 2W', '-'),
	(6, 'Field Quality Assurance 4W', '-');
/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.document
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL DEFAULT '',
  `file_url` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `created_at` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel audit_database.document: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
/*!40000 ALTER TABLE `document` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.document_audit
CREATE TABLE IF NOT EXISTS `document_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) DEFAULT NULL,
  `audit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel audit_database.document_audit: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `document_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_audit` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel audit_database.groups: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(2, 'admin', 'Team Audit Internal'),
	(3, 'auditor', 'si tukang audit'),
	(4, 'auditee', 'yang diaudite');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `mulai` datetime DEFAULT NULL,
  `selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel audit_database.jadwal: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel audit_database.login_attempts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
	(1, '::1', 'agung', 1664371704);
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.proses_audit
CREATE TABLE IF NOT EXISTS `proses_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bagian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `status` enum('finish check document','check document','close','on progress','reject','menunggu balasan kesalahan','menunggu auditor untuk di close','menunggu kisi-kisi') NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `kisi_kisi` text,
  `document_kesalahan_id` int(11) DEFAULT NULL,
  `pesan_kesalahan` text,
  `balasan_kesalahan` text,
  `tahapan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel audit_database.proses_audit: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `proses_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `proses_audit` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bagian_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_email` (`email`) USING BTREE,
  UNIQUE KEY `uc_activation_selector` (`activation_selector`) USING BTREE,
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`) USING BTREE,
  UNIQUE KEY `uc_remember_selector` (`remember_selector`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel audit_database.users: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `bagian_id`) VALUES
	(5, '::1', 'nuindah', '$2y$10$63Tlks6TjrtquNs6wlt0X.ktzaDlz7AriAB.vL6U0osH9B4oN5F52', 'nuindah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1662832857, 1664168636, 1, 'Nurindah', 'Samsita', NULL, '62895378889471', NULL),
	(8, '::1', 'erna', '$2y$10$vtcSXGulkbJzc/LJAqJbp.8wzzXxtCjJj7ssOJKW4rBmDa3zo1UyG', 'erna@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1662833135, 1664371223, 1, 'erna', 'mafuatun', NULL, '62895378889471', 4),
	(9, '::1', 'Ririen Hardijanti', '$2y$10$tsrHvGdZcyiSA/0WLxhDNeZYo2YC39uFjwKLZUPPug.h/yaHGnTYm', 'cecep@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1663004887, 1663133707, 1, 'Ririen', 'Hardijanti', NULL, '62895378889471', NULL),
	(11, '::1', 'vidya', '$2y$10$YdzotOXUYxUiNWkG9KA8gOphKpK9wfZuWT1.yuhVG29YeUGHk3HLi', 'vidya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1664165593, 1664370949, 1, 'Vidya', 'Thika P', NULL, '6281317620132', NULL),
	(12, '::1', 'aris', '$2y$10$dvmx9nCB7VqHzlKytSBATeNixrbURn2/Uf.Tz5kPIrX4tYp8/.1VO', 'aris@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1664165832, 1664434755, 1, 'Aris', 'Agung W', NULL, '62895378889471', NULL),
	(13, '::1', 'maryati', '$2y$10$/VgHPfMQw4tCtvIq8KuKcOO.lp47EzasqHtvNak0PIKFeEf9M.AV.', 'maryati@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1664165890, NULL, 1, 'Maryanti', 'Yusuf', NULL, '62895378889471', NULL),
	(14, '::1', 'annisa', '$2y$10$5ThX2MukE4UvnOYTFsOJbuAgm36bc2WCn1zez8ObHltGd9RF2GLu6', 'annisa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1664165952, 1664199162, 1, 'Annisa', 'Alfani B', NULL, '62895378889471', NULL),
	(23, '::1', 'fajar', '$2y$10$yJlo5fXMrSmkCwWlltO6cer44uVLcK.8fJCOPzbG70RW6QF.PBY7K', 'fajarcahyadiputra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1664371935, 1664371947, 1, 'fajar', 'cahyadi putra', NULL, 'aris', 3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- membuang struktur untuk table audit_database.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE,
  CONSTRAINT `FK_users_groups_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_users_groups_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel audit_database.users_groups: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(21, 5, 3),
	(13, 8, 4),
	(14, 9, 3),
	(16, 11, 3),
	(17, 12, 2),
	(18, 13, 2),
	(20, 14, 3),
	(30, 23, 4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
