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
	('0001', 'guru 1'),
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_guru_mapel: 11 rows
/*!40000 ALTER TABLE `tbl_guru_mapel` DISABLE KEYS */;
INSERT INTO `tbl_guru_mapel` (`id`, `nip_guru`, `id_mapel`) VALUES
	(1, '0001', 1),
	(2, '0001', 2),
	(3, '0001', 3),
	(4, '0001', 4),
	(5, '0001', 5),
	(6, '0001', 6),
	(7, '0001', 7),
	(13, '0002', 4),
	(12, '0002', 3),
	(11, '0002', 1),
	(14, '0002', 5);
/*!40000 ALTER TABLE `tbl_guru_mapel` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_guru_tes
CREATE TABLE IF NOT EXISTS `tbl_guru_tes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_guru` varchar(10) NOT NULL,
  `id_mapel` int NOT NULL,
  `kelas` varchar(200) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_guru_tes: 3 rows
/*!40000 ALTER TABLE `tbl_guru_tes` DISABLE KEYS */;
INSERT INTO `tbl_guru_tes` (`id`, `id_guru`, `id_mapel`, `kelas`, `nama_ujian`, `jumlah_soal`, `kode_jurusan`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
	(1, '0001', 3, 'X', 'UAS', 4, 'IPS', 1, 'set', '2024-08-13 11:53:00', '2024-08-16 11:54:00', 'TIXMG'),
	(23, '0001', 5, 'X', 'UAS', 15, 'A001', 111, 'set', '2024-09-13 00:30:00', '2024-09-14 00:30:00', 'JKZAX'),
	(24, '0001', 5, 'X', 'buku tulis', 5, 'A001', 1, 'set', '2024-09-13 10:03:00', '2024-09-13 14:03:00', 'XJZNE');
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
  `status` enum('ujian','selesai') DEFAULT 'ujian',
  PRIMARY KEY (`id`),
  KEY `id_tes` (`id_tes`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_ikut_ujian: 1 rows
/*!40000 ALTER TABLE `tbl_ikut_ujian` DISABLE KEYS */;
INSERT INTO `tbl_ikut_ujian` (`id`, `id_tes`, `id_user`, `jml_benar`, `nilai`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
	(10, 23, '42421071', 5, 33.33, '2024-09-13 01:33:04', '2024-09-13 02:44:45', 'selesai');
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
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Dumping data for table db_cbt.tbl_jawaban: 15 rows
/*!40000 ALTER TABLE `tbl_jawaban` DISABLE KEYS */;
INSERT INTO `tbl_jawaban` (`id`, `id_tes`, `id_user`, `id_soal`, `jawaban`) VALUES
	(94, 23, 42421071, 4, 'A'),
	(93, 23, 42421071, 5, 'B'),
	(92, 23, 42421071, 6, 'A'),
	(91, 23, 42421071, 7, 'A'),
	(90, 23, 42421071, 8, 'A'),
	(89, 23, 42421071, 9, 'A'),
	(88, 23, 42421071, 10, 'A'),
	(87, 23, 42421071, 11, 'A'),
	(86, 23, 42421071, 12, 'A'),
	(85, 23, 42421071, 13, 'A'),
	(84, 23, 42421071, 14, 'A'),
	(83, 23, 42421071, 15, 'A'),
	(82, 23, 42421071, 3, 'B'),
	(81, 23, 42421071, 2, 'A'),
	(80, 23, 42421071, 1, 'A');
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_mapel: 7 rows
/*!40000 ALTER TABLE `tbl_mapel` DISABLE KEYS */;
INSERT INTO `tbl_mapel` (`id`, `nama`) VALUES
	(1, 'B indonesia'),
	(2, 'IPA'),
	(3, 'B Inggris'),
	(4, 'IPS'),
	(5, 'TKJ'),
	(6, 'TKR'),
	(7, 'TSM');
/*!40000 ALTER TABLE `tbl_mapel` ENABLE KEYS */;

-- Dumping structure for table db_cbt.tbl_paket_soal
CREATE TABLE IF NOT EXISTS `tbl_paket_soal` (
  `id_ujian` int DEFAULT NULL,
  `id_soal` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table db_cbt.tbl_paket_soal: ~19 rows (approximately)
INSERT INTO `tbl_paket_soal` (`id_ujian`, `id_soal`) VALUES
	(23, 1),
	(23, 2),
	(23, 3),
	(23, 4),
	(23, 5),
	(23, 6),
	(23, 7),
	(23, 8),
	(23, 9),
	(23, 10),
	(23, 11),
	(23, 12),
	(23, 13),
	(23, 14),
	(23, 15),
	(24, 1),
	(24, 2),
	(24, 3),
	(24, 4),
	(24, 5);

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
	('42421070', 'M. Yusuf Al Qaradlawi', 'X', 'A001', 'A'),
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
  PRIMARY KEY (`id`),
  KEY `id_guru` (`id_guru`),
  KEY `id_mapel` (`id_mapel`),
  KEY `kelas` (`kelas`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table db_cbt.tbl_soal: 67 rows
/*!40000 ALTER TABLE `tbl_soal` DISABLE KEYS */;
INSERT INTO `tbl_soal` (`id`, `id_guru`, `id_mapel`, `kelas`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`) VALUES
	(1, '0001', 5, 'X', '-', '-', '<p>Jenis kabel dibawah ini yang digunakan pada topologi bus adalah ……</p>', '<p>UTP</p>', '<p>Coaxial</p>', '<p>STP</p>', '<p>Kabel Data</p>', '<p>Fiber Optic</p>', 'B', '2024-09-12 22:19:05'),
	(2, '0001', 5, 'X', '-', '-', '<p>Permasalah yang timbul pada jalur utama topologi bus adalah ……</p>', '<p>Data tidak sampai tujuan</p>', '<p>Terjadi tabrakan data (Collision)</p>', '<p>Kecepatan transfer data rendah</p>', '<p>Terjadinya kerusakan pada hub</p>', '<p>Boros kabel</p>', 'B', '2024-09-12 22:19:05'),
	(3, '0001', 5, 'X', '-', '-', '<p>Bagaimana pengaruh terhadap computer lain apabila salah satu konektor BNC\nputus?</p>', '<p>Kecepatan transfer data meningkat</p>', '<p>Kecepatan transfer data menurun</p>', '<p>Tidak ada pengaruh</p>', '<p>Tidak dapat terkoneksi ke jaringan</p>', '<p>Terjadi kerusakan pada NIC</p>', 'E', '2024-09-12 22:19:05'),
	(4, '0001', 5, 'X', '-', '-', '<p>Besar hambatan terminator yang digunakan pada topologi bus adalah ….</p>', '<p>10 Ohm</p>', '<p>75 Ohm</p>', '<p>25 Ohm</p>', '<p>100 Ohm</p>', '<p>50 Ohm</p>', 'E', '2024-09-12 22:19:05'),
	(5, '0001', 5, 'X', '-', '-', '<p>Central node pada topologi star berupa …..</p>', '<p>Repeater</p>', '<p>Switch/hub</p>', '<p>Konektor</p>', '<p>Router</p>', '<p>Kabel</p>', 'B', '2024-09-12 22:19:05'),
	(6, '0001', 5, 'X', '-', '-', '<p>Kecepatan maksimum kartu jaringan jenis ISA pada topologi star adalah ……</p>', '<p>5 Mbps</p>', '<p>10 Mbps</p>', '<p>15 Mbps</p>', '<p>20 Mbps</p>', '<p>25 Mbps</p>', 'B', '2024-09-12 22:19:05'),
	(7, '0001', 5, 'X', '-', '-', '<p>Repeater dipasang jika jarak kabel UTP sudah lebih dari …..</p>', '<p>100 m</p>', '<p>200 m</p>', '<p>300 m</p>', '<p>400 m</p>', '<p>500 m</p>', 'A', '2024-09-12 22:19:05'),
	(8, '0001', 5, 'X', '-', '-', '<p>Fungsi dari tang Crimping pada pemasangan kabel UTP adalah ….</p>', '<p>Memotong kabel</p>', '<p>Mengelupas kabel</p>', '<p>Meratakan kabel</p>', '<p>Mengunci konektor</p>', '<p>Semua jawaban benar</p>', 'E', '2024-09-12 22:19:05'),
	(9, '0001', 5, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk mengirim (transferring)\ndata adalah …..</p>', '<p>1 dan 2</p>', '<p>6 dan 8</p>', '<p>4 dan 5</p>', '<p>3 dan 6</p>', '<p>3 dan 8</p>', 'A', '2024-09-12 22:19:05'),
	(10, '0001', 5, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk menerima (recieving)\ndata adalah …..</p>', '<p>1 dan 2</p>', '<p>6 dan 8</p>', '<p>4 dan 5</p>', '<p>3 dan 6</p>', '<p>3 dan 8</p>', 'D', '2024-09-12 22:19:05'),
	(11, '0001', 5, 'X', '-', '-', '<p>Pemasangan kabel secara straight pada kabel UTP digunakan untuk\nmenghubungkan …..</p>', '<p>Komputer dengan computer</p>', '<p>Komputer dengan hub/switch</p>', '<p>Switch dengan router</p>', '<p>Hub dengan Repeater</p>', '<p>Client dengan Server</p>', 'B', '2024-09-12 22:19:05'),
	(12, '0001', 5, 'X', '-', '-', '<p>Apabila NIC sudah terinsall dengan baik, maka dapat dilihat meelalui ….</p>', '<p>Device manager dan Add/remove hardware</p>', '<p>Control panel dan Add/remove windows component</p>', '<p>Windows explorer dan regedit</p>', '<p>Network connection dan device manager</p>', '<p>My network places dan dxdiag</p>', 'A', '2024-09-12 22:19:05'),
	(13, '0001', 5, 'X', '-', '-', '<p>Mengapa alamat IP dengan octet pertama 127 tidak digunakan di kelas A?</p>', '<p>Sebagai cadangan untuk penelitian</p>', '<p>Merupakan IP khusus yang hanya dimiliki oleh server</p>', '<p>Merupakan IP LoopBack untuk untuk setiap computer yang ada</p>', '<p>Merupakan IP yang digunakan untuk keperluan routing jaringan</p>', '<p>Merupakan IP yang bersifat public untuk jaringan internet</p>', 'C', '2024-09-12 22:19:05'),
	(14, '0001', 5, 'X', '-', '-', '<p>Sebuah jaringan computer dengan jumlah computer 43. Maka subnet mask yang\ndigunakan adalah …..</p>', '<p>255.255.255.0</p>', '<p>255.255.255.128</p>', '<p>255.255.255.192</p>', '<p>255.255.255.224</p>', '<p>255.255.255.240</p>', 'C', '2024-09-12 22:19:05'),
	(15, '0001', 5, 'X', '-', '-', '<p>Dalam pengalamatan IP Address, isian DNS berfungsi untuk …..</p>', '<p>Menerjemahkan alamat IP ke alamat domain</p>', '<p>Koneksi ke jaringan</p>', '<p>Menghubungkan dua workgroup</p>', '<p>Koneksi dengan jaringan Client Server</p>', '<p>Koneksi dengan /Hostpot</p>', 'A', '2024-09-12 22:19:05'),
	(16, '0001', 5, 'X', '-', '-', '<p>Dibawah ini merupakan contoh koneksitas jaringan yang paling bagus adalah ……</p>', '<p>Reply from 192.168.1.1: bytes=32 time=10ms TTL=64</p>', '<p>Reply from 192.168.1.2: bytes=32 time=15ms TTL=64</p>', '<p>Reply from 192.168.1.3: bytes=32 time=20ms TTL=64</p>', '<p>Reply from 192.168.1.4: bytes=32 time=25ms TTL=64</p>', '<p>Reply from 192.168.1.5: bytes=32 time=50ms TTL=64</p>', 'A', '2024-09-12 22:19:05'),
	(17, '0001', 5, 'X', '-', '-', '<p>Permasalahan yang mungkin terjadi pada software dalam koneksitas jaringan adalah\nberikut ini, kecuali…..</p>', '<p>Setting konfigurasi jaringan tidak benar</p>', '<p>Kesalahan nama Workgroup pada komputer</p>', '<p>Protokol yang tidak cocok</p>', '<p>Network Interface Card (NIC) rusak/mati</p>', '<p>Kesalahan service network</p>', 'D', '2024-09-12 22:19:05'),
	(18, '0001', 5, 'X', '-', '-', '<p>Untuk mengetahui koneksi komputer ke switch / hub, dapat dilakukan dengan\nmengecek suatu hal yang berikut ini, kecuali …Untuk mengetahui koneksi komputer ke switch / hub, dapat dilakukan dengan\nmengecek suatu hal yang berikut ini, kecuali …</p>', '<p>Lampu indikator switch / hub</p>', '<p>Kabel LAN</p>', '<p>Lampu indikator LAN Card</p>', '<p>IP Address</p>', '<p>Server</p>', 'E', '2024-09-12 22:19:05'),
	(19, '0001', 5, 'X', '-', '-', '<p>Untuk mengakses CDROM yang ada didrive E dengan Ip address 192.168.103.2 dari\nkomputer orang lain yang sudah disharing, contoh isian di baris Open yang benar\nadalah…</p>', '<p>\\192.168.103.2E</p>', '<p>\\ServerE</p>', '<p>//192.168.103.2/E</p>', '<p>D. //SMKN JMTN/E</p>', '<p>\\192.168.103.2/E</p>', 'A', '2024-09-12 22:19:05'),
	(20, '0001', 5, 'X', '-', '-', '<p>Di bawah ini yang termasuk system operasi berbasis GUI kecuali ……..</p>', '<p>Mickrotik</p>', '<p>Apple</p>', '<p>Macintosh</p>', '<p>Windows</p>', '<p>Ubuntu</p>', 'A', '2024-09-12 22:19:05'),
	(21, '0001', 5, 'X', '-', '-', '<p>Di bawah ini adalah jenis-jenis sistem operasi, kecuali…..</p>', '<p>Ubuntu</p>', '<p>Windows XP</p>', '<p>Mac OS</p>', '<p>Cytrix</p>', '<p>Red Hat</p>', 'D', '2024-09-12 22:19:05'),
	(22, '0001', 5, 'X', '-', '-', '<p>Sebuah jaringan computer dengan jumlah computer 43 maka memiliki subnet mask\nyang digunakan…</p>', '<p>255.255.255.0</p>', '<p>255.255.255.24</p>', '<p>255.255.255.192</p>', '<p>255.255.255.250</p>', '<p>255.255.255.254</p>', 'C', '2024-09-12 22:19:05'),
	(23, '0001', 5, 'X', '-', '-', '<p>Panjang Net id pada kelas A</p>', '<p>8 bit</p>', '<p>16 bit</p>', '<p>24 bit</p>', '<p>64 bit</p>', '<p>32 bit</p>', 'A', '2024-09-12 22:19:05'),
	(24, '0001', 5, 'X', '-', '-', '<p>Panjang Host ID pada kelas B</p>', '<p>8 bit</p>', '<p>16 bit</p>', '<p>24 bit</p>', '<p>64 bit</p>', '<p>32 bit</p>', 'B', '2024-09-12 22:19:05'),
	(25, '0001', 5, 'X', '-', '-', '<p>Perintah untuk mengetahui jalur / rute suatu domain komputer / website menggunakan pada system Linux adalah ………</p>', '<p>Ping</p>', '<p>Traceroute</p>', '<p>Tracert</p>', '<p>Ipconfig</p>', '<p>Ifconfig</p>', 'C', '2024-09-12 22:19:05'),
	(26, '0001', 5, 'X', '-', '-', '<p>Perangkat keras yang digunakan untuk menyatukan kabel-kabel network dari tiap-tiap\nworkstation atau perangkat lainnya dalam jaringan disebut..........</p>', '<p>Concentrator</p>', '<p>Lan Card</p>', '<p>Modem</p>', '<p>USB</p>', '<p>Wireless</p>', 'A', '2024-09-12 22:19:05'),
	(27, '0001', 5, 'X', '-', '-', '<p>Topologi jaringan komputer yang menggunakan BNC (T) sebagai konektornya\nadalah....</p>', '<p>Topologi Bus</p>', '<p>Topologi Coaxia</p>', '<p>Topologi Ring</p>', '<p>Topologi Star,</p>', '<p>Topologi Workstation</p>', 'A', '2024-09-12 22:19:05'),
	(28, '0001', 5, 'X', '-', '-', '<p>Dibawah ini salah satu protokol internet yang sering digunakan untuk mentranfer data atau file adalah…</p>', '<p>DNS</p>', '<p>Sosial Media</p>', '<p>FTP</p>', '<p>HTTP</p>', '<p>SMTP</p>', 'C', '2024-09-12 22:19:05'),
	(29, '0001', 5, 'X', '-', '-', '<p>Salah satu keuntungan jaringan komputer menggunakan topologi bus adalah ….</p>', '<p>Deteksi dan isolasi kesalahan sangat kecil</p>', '<p>Pengembangan jaringan atau penambahan workstation baru dapat dilakukan\ndengan mudah tanpa menggangu workstation lain.</p>', '<p>Kepadatan lalu lintas pada jalur utama</p>', '<p>Diperlukan repeater untuk jarak jauh</p>', '<p>Lay out kabel kompleks</p>', 'C', '2024-09-12 22:19:05'),
	(30, '0001', 5, 'X', '-', '-', '<p>Agar penggunaan kabel coaxial jenis thinnet optimal maka setiap ujung harus\nditerminasi dengan....</p>', '<p>Pembungkus kaber (isolator)</p>', '<p>T-Connector 0,5 meter</p>', '<p>Terminator 50-ohm</p>', '<p>Terminator 500-ohm</p>', '<p>Transceiver External</p>', 'C', '2024-09-12 22:19:05'),
	(31, '0001', 5, 'X', '-', '-', '<p>Perintah “PING” pada jaringan digunakan untuk hal-hal yang berikut ini, kecuali....</p>', '<p>Menguji fungsi kirim sebuah NIC</p>', '<p>Menguji fungsi terima sebuahNIC</p>', '<p>Menguji kesesuaian sebuah NIC</p>', '<p>Menguji konfigurasi TCP/IP</p>', '<p>Menguji koneksi jaringan</p>', 'C', '2024-09-12 22:19:05'),
	(32, '0001', 5, 'X', '-', '-', '<p>Untuk melihat konfigurasi alamat IP pada sebuah komputer digunakan perintah....</p>', '<p>Ip all</p>', '<p>Ipall</p>', '<p>p config</p>', '<p>Ipconfig</p>', '<p>Ipconfigurasi</p>', 'D', '2024-09-12 22:19:05'),
	(33, '0001', 5, 'X', '-', '-', '<p>Apakan kepanjangan dari DHCP…</p>', '<p>Dinamis Host Configurasi Protocol.</p>', '<p>Dinamis Host Configurasi Protocol.</p>', '<p>Dynamic Hosting Confidenci Protocol</p>', '<p>Dinamic Host Confidenci Protocol.</p>', '<p>Dynamic Host Configuration Protocol.</p>', 'E', '2024-09-12 22:19:05'),
	(34, '0001', 5, 'X', '-', '-', '<p> Dalam pengalamatan IP Address, Isian DNS berfungsi untuk…</p>', '<p>Koneksi ke jaringan internet</p>', '<p>Koneksi ke jaringan internet</p>', '<p>Menghubungkan 2 workgroup</p>', '<p>Koneksi dengan jaringan Client server</p>', '<p>Koneksi dengan Hotspot</p>', 'A', '2024-09-12 22:19:05'),
	(35, '0001', 5, 'X', '-', '-', '<p>Jenis IP address untuk jaringan berukuran kecil atau Local Area Network adalah....</p>', '<p>Kelas A</p>', '<p>Kelas B</p>', '<p>Kelas C</p>', '<p>Kelas A dan B</p>', '<p>Kelas B dan C</p>', 'C', '2024-09-12 22:19:05'),
	(36, '0001', 5, 'X', '-', '-', '<p>Tujuan dibentuknya workgroup</p>', '<p>Mempermudah pengalamatan IP</p>', '<p>Mempermudah transfer data</p>', '<p>Mempermudah sharing data</p>', '<p>Mempermudah koneksi internet</p>', '<p>Mempermudah pengelolaan jaringan</p>', 'C', '2024-09-12 22:19:05'),
	(37, '0001', 5, 'X', '-', '-', '<p>Dalam konfigurasi berbagi pakai koneksi internet (internet connection sharing),\nkomputer yang tersambung dengan internet akan berfungsi sebagai....</p>', '<p>client</p>', '<p>dump</p>', '<p>router</p>', '<p>switch</p>', '<p>server / gateway</p>', 'A', '2024-09-12 22:19:05'),
	(38, '0001', 5, 'X', '-', '-', '<p>Pemasangan NIC pada computer tidak plug and play disebabkan…</p>', '<p>Belum ada driver NIC pada OS</p>', '<p>NIC bertipe ISA</p>', '<p>NIC bertipe PCI</p>', '<p>NIC rusak</p>', '<p>NIC bertipe AGP</p>', 'A', '2024-09-12 22:19:05'),
	(39, '0001', 5, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk mengirim (transmit) data\nadalah..</p>', '<p>1 dan 2</p>', '<p>4 dan 5</p>', '<p>3 dan 8</p>', '<p>7 dan 6</p>', '<p>3 dan 6</p>', 'E', '2024-09-12 22:19:05'),
	(40, '0001', 5, 'X', '-', '-', '<p>Kombinasi pengkabelan straight pada jaringan komputer yang sesuai dengan\nstandart internasional adalah....</p>', '<p>White orange – orange - white green – blue - white blue - green – white\nbrown - brown</p>', '<p>White orange – orange - white green – green - white blue - blue – white brown -\nbrown</p>', '<p>White green – green - white orange – blue - white blue - orange – white brown - brown</p>', '<p>White orange – orange - white green - green - white blue - blue – white brown - brown</p>', '<p>Orange – white orange – green – white green - white blue - blue – white brown – brown</p>', 'A', '2024-09-12 22:19:05'),
	(41, '0001', 5, 'X', '-', '-', '<p>PING merupakan perintah yang digunakan untuk…</p>', '<p>Menguji koneksi jaringan</p>', '<p>Melihat Mac Address</p>', '<p>Menghapus history Browser</p>', '<p>Menstransfer file antara jaringan</p>', '<p>Melihat komputer terinfeksi virus atau tidak</p>', 'A', '2024-09-12 22:19:05'),
	(42, '0001', 5, 'X', '-', '-', '<p>Bagian Komputer terbagi menjadi 3 yaitu…</p>', '<p>Software -  Hardware -  Output</p>', '<p>Hardware - Software - Brainware</p>', '<p>Harddisk - Monitor -  VGA</p>', '<p>Input - Proses - Output</p>', '<p>Input - Komputer -  Output</p>', 'B', '2024-09-12 22:19:05'),
	(43, '0001', 5, 'X', '-', '-', '<p>Setiap komputer yang terhubung ke jaringan dapat bertindak baik sebagai workstation maupun server disebut jaringan …</p>', '<p>Peer to peer</p>', '<p>Client and server</p>', '<p>Local Area Network</p>', '<p>Bus</p>', '<p>Tree</p>', 'E', '2024-09-12 22:19:05'),
	(44, '0001', 5, 'X', '-', '-', '<p>Salah satu tipe jaringan komputer yang umum dijumpai adalah….</p>', '<p>Star</p>', '<p>Bus</p>', '<p>WAN</p>', '<p>Wireless</p>', '<p>Client-server</p>', 'E', '2024-09-12 22:19:05'),
	(45, '0001', 5, 'X', '-', '-', '<p>Setelah kita menginstall sistem operasi Windows, hal yang harus dilakukan berikutnya adalah</p>', '<p>Menginstall driver</p>', '<p>Menginstall photoshop</p>', '<p>Menginstall VirtualBox</p>', '<p>Mengubah Wallpaper</p>', '<p>Merakit Komputer</p>', 'A', '2024-09-12 22:19:05'),
	(46, '0001', 5, 'X', '-', '-', '<p>Satuan informasi terkecil yang dikenal dalam komunikasi data dibawah ini adalah…</p>', '<p>Bit</p>', '<p> Byte</p>', '<p>Mbps</p>', '<p>GB</p>', '<p>Segment</p>', 'A', '2024-09-12 22:19:05'),
	(47, '0001', 5, 'X', '-', '-', '<p>1 Terabyte sama dengan…</p>', '<p>1000 Gigabyte</p>', '<p>1200 Gigabyte</p>', '<p>4000 Gigabyte</p>', '<p>2300 Gigabyte</p>', '<p>500 Gigabyte</p>', 'A', '2024-09-12 22:19:05'),
	(48, '0001', 5, 'X', '-', '-', '<p>Mail Transfer Protocol (SMTP) adalah protokol pada jaringan internet yang berfungsi untuk..</p>', '<p>Menerima email</p>', '<p>Menambahkan IP Address</p>', '<p>Membuat database email</p>', '<p>Mengirimkan pesan email agar tepat waktu dan efisien kepada penerima</p>', '<p>Mengumpulkan email yang masuk</p>', 'D', '2024-09-12 22:19:05'),
	(49, '0001', 5, 'X', '-', '-', '<p>Suatu sistem yang memungkinkan nama suatu host pada jaringan komputer atau internet ditranslasikan menjadi IP address disebut ….</p>', '<p>DNS</p>', '<p>Gateway</p>', '<p>Protokol</p>', '<p>DHCP</p>', '<p>Ipconfig</p>', 'A', '2024-09-12 22:19:05'),
	(50, '0001', 5, 'X', '-', '-', '<p>Yang bukan merupakan varian sistem operasi jaringan berbasis GUI yang menggunakan basis Linux adalah…..</p>', '<p>Redhat</p>', '<p>Mandrake</p>', '<p>Caldera</p>', '<p>Debian</p>', '<p>Fortran</p>', 'E', '2024-09-12 22:19:05'),
	(51, '0001', 5, 'X', '-', '-', '<p>Soal 1</p>', '<p>1.Jawaban A</p>', '<p>1.Jawaban B</p>', '<p>1.Jawaban C</p>', '<p>1.Jawaban D</p>', '<p>1.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(52, '0001', 5, 'X', '-', '-', '<p>soal 2</p>', '<p>2.Jawaban A</p>', '<p>2.Jawaban B</p>', '<p>2.Jawaban C</p>', '<p>2.Jawaban D</p>', '<p>2.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(53, '0001', 5, 'X', '-', '-', '<p>Soal 3</p>', '<p>3Jawaban A</p>', '<p>3Jawaban B</p>', '<p>3Jawaban C</p>', '<p>3Jawaban D</p>', '<p>3Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(54, '0001', 5, 'X', '-', '-', '<p>Soal 4</p>', '<p>4.Jawaban A</p>', '<p>4.Jawaban B</p>', '<p>4.Jawaban C</p>', '<p>4.Jawaban D</p>', '<p>4.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(55, '0001', 5, 'X', '-', '-', '<p>Soal 5</p>', '<p>5.Jawaban A</p>', '<p>5.Jawaban B</p>', '<p>5.Jawaban C</p>', '<p>5.Jawaban D</p>', '<p>5.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(56, '0001', 5, 'X', '-', '-', '<p>Soal 6</p>', '<p>6.Jawaban A</p>', '<p>6.Jawaban B</p>', '<p>6.Jawaban C</p>', '<p>6.Jawaban D</p>', '<p>6.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(57, '0001', 5, 'X', '-', '-', '<p>Soal 7</p>', '<p>7.Jawaban A</p>', '<p>7.Jawaban B</p>', '<p>7.Jawaban C</p>', '<p>7.Jawaban D</p>', '<p>7.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(58, '0001', 5, 'X', '-', '-', '<p>Soal 8</p>', '<p>8.Jawaban A</p>', '<p>8.Jawaban B</p>', '<p>8.Jawaban C</p>', '<p>8.Jawaban D</p>', '<p>8.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(59, '0001', 5, 'X', '-', '-', '<p>Soal 9</p>', '<p>9.Jawaban A</p>', '<p>9.Jawaban B</p>', '<p>9.Jawaban C</p>', '<p>9.Jawaban D</p>', '<p>9.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(60, '0001', 5, 'X', '-', '-', '<p>Soal 10</p>', '<p>10.Jawaban A</p>', '<p>10.Jawaban B</p>', '<p>10.Jawaban C</p>', '<p>10.Jawaban D</p>', '<p>10.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(61, '0001', 5, 'X', '-', '-', '<p>Soal 11</p>', '<p>11.Jawaban A</p>', '<p>11.Jawaban B</p>', '<p>11.Jawaban C</p>', '<p>11.Jawaban D</p>', '<p>11.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(62, '0001', 5, 'X', '-', '-', '<p>Soal 12</p>', '<p>12.Jawaban A</p>', '<p>12.Jawaban B</p>', '<p>12.Jawaban C</p>', '<p>12.Jawaban D</p>', '<p>12.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(63, '0001', 5, 'X', '-', '-', '<p>Soal 13</p>', '<p>13.Jawaban A</p>', '<p>13.Jawaban B</p>', '<p>13.Jawaban C</p>', '<p>13.Jawaban D</p>', '<p>13.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(64, '0001', 5, 'X', '-', '-', '<p>Soal 14</p>', '<p>14.Jawaban A</p>', '<p>14.Jawaban B</p>', '<p>14.Jawaban C</p>', '<p>14.Jawaban D</p>', '<p>14.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(65, '0001', 5, 'X', '-', '-', '<p>Soal 15</p>', '<p>15.Jawaban A</p>', '<p>15.Jawaban B</p>', '<p>15.Jawaban C</p>', '<p>15.Jawaban D</p>', '<p>15.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(66, '0001', 5, 'X', '-', '-', '<p>Soal 16</p>', '<p>16.Jawaban A</p>', '<p>16.Jawaban B</p>', '<p>16.Jawaban C</p>', '<p>16.Jawaban D</p>', '<p>16.Jawaban E</p>', 'A', '2024-09-12 23:00:07'),
	(67, '0001', 5, 'X', '-', '-', '<p>Soal 17</p>', '<p>17.Jawaban A</p>', '<p>17.Jawaban B</p>', '<p>17.Jawaban C</p>', '<p>17.Jawaban D</p>', '<p>17.Jawaban E</p>', 'A', '2024-09-12 23:00:07');
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
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=latin1;

-- Dumping data for table db_cbt.tbl_user: 32 rows
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id`, `username`, `password`, `peran`, `nama`, `aktivasi`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', 'A'),
	(3, 'tien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'tien', 'A'),
	(226, '42421070', '3b504e4ec694a6dfc6398f882e5add6c', 'siswa', 'M. Yusuf Al Qaradlawi', 'A'),
	(227, '42421071', 'e81c3882d9ca22944a793c61dcbbe897', 'siswa', 'Matien Hakim Falahudin Bachtiar', 'A'),
	(225, '42421069', 'd6764c8d9c6d2c4c23e7aee9f4cdddc8', 'siswa', 'M. Noval Najib', 'A'),
	(224, '42421068', '75c1f590552b4b663c71d22e876d06df', 'siswa', 'Lilis Suryani', 'A'),
	(223, '42421067', '8e892c5b79e5d5af43f313cdd265f6ad', 'siswa', 'Krisdianto', 'A'),
	(222, '42421066', '9562e2397bbeca59a4db74ae799a990f', 'siswa', 'Khaqi Noer Oktavian Majid', 'A'),
	(221, '42421065', 'df3f00f5779fce667287437ad4f501c8', 'siswa', 'Irbah Izazi', 'A'),
	(220, '42421064', '20e59015d7ca918564b6c828b10c68b8', 'siswa', 'Ihzamulloh', 'A'),
	(219, '42421063', 'eca6a6051b31ef9d82d86fab1ec6fae5', 'siswa', 'Hadi Saputra Arifin', 'A'),
	(139, '0007', '6950aac2d7932e1f1a4c3cf6ada1316e', 'guru', 'guru 7', 'A'),
	(218, '42421088', '1af6c762d9574b96e0f4859f7dacbe7c', 'siswa', 'Ikrimatul A\'la', 'A'),
	(138, '0006', '7f8bb0fe8b33780a08fe6b60ced14529', 'guru', 'guru 6', 'A'),
	(137, '0005', 'd39934ce111a864abf40391f3da9cdf5', 'guru', 'guru 5', 'A'),
	(136, '0004', '95b09698fda1f64af16708ffb859eab9', 'guru', 'guru 4', 'A'),
	(135, '0003', '7cd86ecb09aa48c6e620b340f6a74592', 'guru', 'guru 3', 'A'),
	(134, '0002', 'fcd04e26e900e94b9ed6dd604fed2b64', 'guru', 'guru 2', 'A'),
	(133, '0001', '25bbdcd06c32d477f7fa1c3e4a91b032', 'guru', 'guru 1', 'A'),
	(62, 'tienn', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', 'matienn', 'A'),
	(63, 'matien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'Matiennn', 'A'),
	(217, '42421061', 'f212edd7717f6d58756dc1968c869ec9', 'siswa', 'Femulia Arifka Nanda', 'A'),
	(216, '42421060', '03a23fdb7f8d63ef96959b6fa4103de1', 'siswa', 'Fatkhan Rizqi Amrulloh', 'A'),
	(215, '42421059', '4da872dc27d16a2e1288eb75c5db3c5f', 'siswa', 'Farchanul Umam', 'A'),
	(127, 'syifa', 'e71a0095d4403a91b782a61c7c358d3c50b6d169', 'admin', 'Syifa', 'A'),
	(213, '42421056', '07008204b59be899249e5b83ab461c04', 'siswa', 'Candrasa Asmaradanta', 'A'),
	(214, '42421057', '001342bff0dc6cabd1bec4b4c0a2a93d', 'siswa', 'Eko Gunawan', 'A'),
	(212, '42421055', 'dd1cdecfc1aca098db49f4a3a4aee60e', 'siswa', 'Bayu Aji Assidiq', 'A'),
	(211, '42421054', '34975a3c2cebe4caa8b1aa565be97720', 'siswa', 'Auliya Fitra Sabila', 'A'),
	(157, '2231', '2a8a812400df8963b2e2ac0ed01b07b8', 'guru', 'aaa', 'A'),
	(158, '002', '93dd4de5cddba2c733c65f233097f05a', 'guru', 'guru 2', 'A'),
	(159, '0002', 'fcd04e26e900e94b9ed6dd604fed2b64', 'guru', 'guru 2', 'A');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
