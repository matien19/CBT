-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_cbt.tbl_guru
CREATE TABLE IF NOT EXISTS `tbl_guru` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_guru: 7 rows
/*!40000 ALTER TABLE `tbl_guru` DISABLE KEYS */;
INSERT INTO `tbl_guru` (`nip`, `nama`) VALUES
	('0001', 'Matien Hakim Falahudin Bachtiar'),
	('0002', 'guru 2'),
	('0003', 'guru 3'),
	('0004', 'guru 4'),
	('0005', 'guru 5'),
	('0006', 'guru 6'),
	('0007', 'guru 7');
/*!40000 ALTER TABLE `tbl_guru` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_guru_mapel
CREATE TABLE IF NOT EXISTS `tbl_guru_mapel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nip_guru` varchar(10) NOT NULL,
  `id_mapel` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_guru` (`nip_guru`),
  KEY `id_mapel` (`id_mapel`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_guru_mapel: 11 rows
/*!40000 ALTER TABLE `tbl_guru_mapel` DISABLE KEYS */;
INSERT INTO `tbl_guru_mapel` (`id`, `nip_guru`, `id_mapel`) VALUES
	(27, '0001', 4),
	(26, '0001', 3),
	(7, '0003', 4),
	(9, '0005', 4),
	(10, '0005', 8),
	(25, '0001', 2),
	(24, '0001', 1),
	(28, '0001', 5),
	(29, '0001', 6),
	(30, '0001', 7),
	(31, '0001', 8);
/*!40000 ALTER TABLE `tbl_guru_mapel` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_guru_tes
CREATE TABLE IF NOT EXISTS `tbl_guru_tes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_guru` varchar(10) NOT NULL,
  `id_mapel` int NOT NULL,
  `kelas` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int NOT NULL,
  `kode_jurusan` varchar(20) NOT NULL,
  `waktu` int NOT NULL,
  `jenis` enum('acak','set') NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `terlambat` datetime NOT NULL,
  `token` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_guru` (`id_guru`),
  KEY `id_mapel` (`id_mapel`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_guru_tes: 5 rows
/*!40000 ALTER TABLE `tbl_guru_tes` DISABLE KEYS */;
INSERT INTO `tbl_guru_tes` (`id`, `id_guru`, `id_mapel`, `kelas`, `nama_ujian`, `jumlah_soal`, `kode_jurusan`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
	(13, '0001', 1, 'XII', 'UASsss', 11, 'A003', 21, 'set', '2024-08-01 17:55:00', '2024-08-01 23:00:00', 'TFZNH'),
	(17, '0001', 6, 'XI', 'UTS', 1, 'A001', 2, 'set', '2024-07-23 12:15:00', '2024-07-23 12:15:00', 'DKGHN'),
	(20, '0001', 3, 'X', 'TESS', 1, 'A001', 2, 'set', '2024-08-22 19:57:00', '2024-08-30 19:57:00', 'JRYKC'),
	(21, '0001', 1, 'X', 'UAS', 2, 'A001', 20, 'set', '2024-08-06 10:13:00', '2024-08-31 10:13:00', 'WBVSX'),
	(22, '0001', 3, 'X', 'UAS', 10, 'A003', 20, 'set', '2024-08-08 19:53:00', '2024-08-10 19:53:00', 'VUOAB');
/*!40000 ALTER TABLE `tbl_guru_tes` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_ikut_ujian
CREATE TABLE IF NOT EXISTS `tbl_ikut_ujian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tes` int NOT NULL,
  `id_user` varchar(50) NOT NULL DEFAULT '',
  `jml_benar` int DEFAULT '0',
  `nilai` decimal(10,2) DEFAULT '0.00',
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `status` enum('ujian','selesai') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'ujian',
  PRIMARY KEY (`id`),
  KEY `id_tes` (`id_tes`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_ikut_ujian: 0 rows
/*!40000 ALTER TABLE `tbl_ikut_ujian` DISABLE KEYS */;
INSERT INTO `tbl_ikut_ujian` (`id`, `id_tes`, `id_user`, `jml_benar`, `nilai`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
	(11, 21, '42421054', 0, 0.00, '2024-08-09 10:25:28', '2024-08-09 10:27:36', 'selesai');
/*!40000 ALTER TABLE `tbl_ikut_ujian` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_jawaban
CREATE TABLE IF NOT EXISTS `tbl_jawaban` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tes` int NOT NULL,
  `id_user` int NOT NULL,
  `id_soal` int NOT NULL,
  `jawaban` varchar(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_tes` (`id_tes`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Dumping data for table db_cbt.tbl_jawaban: 3 rows
/*!40000 ALTER TABLE `tbl_jawaban` DISABLE KEYS */;
INSERT INTO `tbl_jawaban` (`id`, `id_tes`, `id_user`, `id_soal`, `jawaban`) VALUES
	(15, 21, 42421054, 12, 'A'),
	(14, 21, 42421054, 11, 'B'),
	(13, 21, 42421054, 9, 'B');
/*!40000 ALTER TABLE `tbl_jawaban` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_jurusan
CREATE TABLE IF NOT EXISTS `tbl_jurusan` (
  `kode_jurusan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_cbt.tbl_jurusan: ~2 rows (approximately)
INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama`) VALUES
	('A003', 'IPS'),
	('A001', 'IPA');

-- Dumping structure for table db_cbt.tbl_kelas
CREATE TABLE IF NOT EXISTS `tbl_kelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_cbt.tbl_kelas: ~3 rows (approximately)
INSERT INTO `tbl_kelas` (`id`, `kelas`) VALUES
	(1, 'X'),
	(2, 'XI'),
	(3, 'XII');

-- Dumping structure for table db_cbt.tbl_mapel
CREATE TABLE IF NOT EXISTS `tbl_mapel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_mapel: 8 rows
/*!40000 ALTER TABLE `tbl_mapel` DISABLE KEYS */;
INSERT INTO `tbl_mapel` (`id`, `nama`) VALUES
	(1, 'B indonesia'),
	(2, 'IPA'),
	(3, 'B Inggris'),
	(4, 'IPS'),
	(5, 'TKJ'),
	(6, 'TKR'),
	(7, 'TSM'),
	(8, 'misalakan bnyak');
/*!40000 ALTER TABLE `tbl_mapel` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_siswa
CREATE TABLE IF NOT EXISTS `tbl_siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kode_jurusan` varchar(100) NOT NULL,
  `stat` enum('A','T') NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_siswa: 17 rows
/*!40000 ALTER TABLE `tbl_siswa` DISABLE KEYS */;
INSERT INTO `tbl_siswa` (`nis`, `nama`, `kelas`, `kode_jurusan`, `stat`) VALUES
	('42421054', 'Auliya Fitra Sabila', 'X', 'A001', 'A'),
	('42421055', 'Bayu Aji Assidiq', 'X', 'A001', 'A'),
	('42421056', 'Candrasa Asmaradanta', 'X', 'A001', 'A'),
	('42421057', 'Eko Gunawan', 'X', 'A001', 'A'),
	('42421059', 'Farchanul Umam', 'X', 'A001', 'A'),
	('42421060', 'Fatkhan Rizqi Amrulloh', 'X', 'A001', 'A'),
	('42421061', 'Femulia Arifka Nanda', 'X', 'A001', 'A'),
	('42421088', 'Ikrimatul A\'la', 'X', 'A001', 'A'),
	('42421063', 'Hadi Saputra Arifin', 'X', 'A001', 'A'),
	('42421064', 'Ihzamulloh', 'X', 'A001', 'A'),
	('42421065', 'Irbah Izazi', 'X', 'A001', 'A'),
	('42421066', 'Khaqi Noer Oktavian Majid', 'X', 'A001', 'A'),
	('42421067', 'Krisdianto', 'X', 'A001', 'A'),
	('42421068', 'Lilis Suryani', 'X', 'A001', 'A'),
	('42421069', 'M. Noval Najib', 'X', 'A001', 'A'),
	('42421070', 'M. Yusuf Al Qaradlawi', 'X', 'A001', 'T'),
	('42421071', 'Matien Hakim Falahudin Bachtiar', 'X', 'A001', 'A');
/*!40000 ALTER TABLE `tbl_siswa` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_soal
CREATE TABLE IF NOT EXISTS `tbl_soal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_guru` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_mapel` int NOT NULL,
  `kelas` varchar(5) COLLATE utf8mb3_unicode_ci NOT NULL,
  `file` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe_file` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `soal` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_a` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_b` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_c` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_d` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_e` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jawaban` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_input` datetime NOT NULL,
  `jml_benar` int NOT NULL,
  `jml_salah` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_guru` (`id_guru`),
  KEY `id_mapel` (`id_mapel`),
  KEY `kelas` (`kelas`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table db_cbt.tbl_soal: 6 rows
/*!40000 ALTER TABLE `tbl_soal` DISABLE KEYS */;
INSERT INTO `tbl_soal` (`id`, `id_guru`, `id_mapel`, `kelas`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`, `jml_benar`, `jml_salah`) VALUES
	(10, '0001', 1, 'XI', '-', '-', '<p>SOAL</p>', '<p>A</p>', '<p>B</p>', '<p>C</p>', '<p>D</p>', '<p>E</p>', 'D', '2024-08-03 18:10:05', 0, 0),
	(9, '0001', 1, 'X', '-', '-', '<p>soal</p>', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', 'E', '2024-08-03 18:06:28', 0, 0),
	(5, '0001', 7, 'XII', '-', '-', '<p>ini soal <strong>bahasa </strong><i><strong>inggris </strong></i><span style="color:hsl(30, 75%, 60%);"><i><strong>??</strong></i></span>&nbsp;</p>', '<p>jawabann <span class="text-tiny" style="font-family:\'Trebuchet MS\', Helvetica, sans-serif;">A</span></p>', '<p>jawabann <span class="text-small" style="font-family:Verdana, Geneva, sans-serif;">A</span></p>', '<p>jawabann <span class="text-big" style="font-family:Arial, Helvetica, sans-serif;">A</span></p>', '<p>jawabann <span class="text-huge" style="font-family:Verdana, Geneva, sans-serif;">A</span></p>', '<p>jawabann E</p>', 'C', '2024-08-02 21:28:21', 0, 0),
	(6, '0001', 6, 'XI', '-', '-', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'B', '2024-08-02 22:42:40', 0, 0),
	(7, '0001', 5, 'X', '-', '-', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'E', '2024-08-02 22:44:51', 0, 0),
	(8, '0001', 6, 'XI', '-', '-', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'E', '2024-08-02 22:46:48', 0, 0),
	(11, '0001', 1, 'X', '-', '-', 'Soal Percobaan 01', 'aef', 'sf', 'rag', 'rsgg', 'dsg', 'D', '2024-08-08 20:44:29', 0, 0),
	(12, '0001', 1, 'X', '-', '-', 'Soal Percobaan 02', 'aef', 'sf', 'rag', 'rsgg', 'dsg', 'D', '2024-08-08 20:44:29', 0, 0);
/*!40000 ALTER TABLE `tbl_soal` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `peran` enum('admin','guru','siswa') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktivasi` enum('A','T') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_user: 27 rows
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id`, `username`, `password`, `peran`, `nama`, `aktivasi`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', 'A'),
	(2, 'matien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'matien', 'A'),
	(3, 'tien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'tien', 'A'),
	(54, '42421071', 'e81c3882d9ca22944a793c61dcbbe897', 'siswa', 'Matien Hakim Falahudin Bachtiar', 'A'),
	(53, '42421070', '3b504e4ec694a6dfc6398f882e5add6c', 'siswa', 'M. Yusuf Al Qaradlawi', 'T'),
	(52, '42421069', 'd6764c8d9c6d2c4c23e7aee9f4cdddc8', 'siswa', 'M. Noval Najib', 'A'),
	(51, '42421068', '75c1f590552b4b663c71d22e876d06df', 'siswa', 'Lilis Suryani', 'A'),
	(50, '42421067', '8e892c5b79e5d5af43f313cdd265f6ad', 'siswa', 'Krisdianto', 'A'),
	(48, '42421065', 'df3f00f5779fce667287437ad4f501c8', 'siswa', 'Irbah Izazi', 'A'),
	(49, '42421066', '9562e2397bbeca59a4db74ae799a990f', 'siswa', 'Khaqi Noer Oktavian Majid', 'A'),
	(47, '42421064', '20e59015d7ca918564b6c828b10c68b8', 'siswa', 'Ihzamulloh', 'A'),
	(46, '42421063', 'eca6a6051b31ef9d82d86fab1ec6fae5', 'siswa', 'Hadi Saputra Arifin', 'A'),
	(45, '42421088', '1af6c762d9574b96e0f4859f7dacbe7c', 'siswa', 'Ikrimatul A\'la', 'A'),
	(43, '42421060', '03a23fdb7f8d63ef96959b6fa4103de1', 'siswa', 'Fatkhan Rizqi Amrulloh', 'A'),
	(44, '42421061', 'f212edd7717f6d58756dc1968c869ec9', 'siswa', 'Femulia Arifka Nanda', 'A'),
	(42, '42421059', '4da872dc27d16a2e1288eb75c5db3c5f', 'siswa', 'Farchanul Umam', 'A'),
	(41, '42421057', '001342bff0dc6cabd1bec4b4c0a2a93d', 'siswa', 'Eko Gunawan', 'A'),
	(40, '42421056', '07008204b59be899249e5b83ab461c04', 'siswa', 'Candrasa Asmaradanta', 'A'),
	(39, '42421055', 'dd1cdecfc1aca098db49f4a3a4aee60e', 'siswa', 'Bayu Aji Assidiq', 'A'),
	(38, '42421054', '34975a3c2cebe4caa8b1aa565be97720', 'siswa', 'Auliya Fitra Sabila', 'A'),
	(55, '0001', '25bbdcd06c32d477f7fa1c3e4a91b032', 'guru', 'Matien Hakim Falahudin Bachtiar', 'A'),
	(56, '0002', 'fcd04e26e900e94b9ed6dd604fed2b64', 'guru', 'guru 2', 'A'),
	(57, '0003', '7cd86ecb09aa48c6e620b340f6a74592', 'guru', 'guru 3', 'A'),
	(58, '0004', '95b09698fda1f64af16708ffb859eab9', 'guru', 'guru 4', 'A'),
	(59, '0005', 'd39934ce111a864abf40391f3da9cdf5', 'guru', 'guru 5', 'A'),
	(60, '0006', '7f8bb0fe8b33780a08fe6b60ced14529', 'guru', 'guru 6', 'A'),
	(61, '0007', '6950aac2d7932e1f1a4c3cf6ada1316e', 'guru', 'guru 7', 'A');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
