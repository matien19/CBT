-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2024 at 06:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`nip`, `nama`) VALUES
('0001', 'Arain dirgantara,s.Kom'),
('0002', 'Anis Alwi Mubarok,S,Kom'),
('0003', 'Lutfi Sakti M, S.Kom');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru_mapel`
--

CREATE TABLE `tbl_guru_mapel` (
  `id` int NOT NULL,
  `nip_guru` varchar(10) NOT NULL,
  `id_mapel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru_mapel`
--

INSERT INTO `tbl_guru_mapel` (`id`, `nip_guru`, `id_mapel`) VALUES
(1, '0001', 1),
(2, '0002', 1),
(3, '0002', 2),
(4, '0002', 3),
(5, '0003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru_tes`
--

CREATE TABLE `tbl_guru_tes` (
  `id` int NOT NULL,
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
  `token` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru_tes`
--

INSERT INTO `tbl_guru_tes` (`id`, `id_guru`, `id_mapel`, `kelas`, `nama_ujian`, `jumlah_soal`, `kode_jurusan`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
(1, '0001', 1, 'X', 'UAS', 10, 'A1', 10, 'set', '2024-12-06 00:01:00', '2024-12-06 00:01:00', 'ZRGJB'),
(2, '0001', 1, 'X', 'UAS', 16, 'A1', 100, 'set', '2024-12-31 08:14:00', '2025-02-08 08:14:00', 'FVOMH'),
(3, '0001', 1, 'X', 'UAS', 20, 'A1', 100, 'set', '2024-12-06 00:15:00', '2024-12-31 00:15:00', 'RVECZ'),
(4, '0002', 3, 'X', 'UAS', 1, 'A3', 10, 'set', '2024-12-06 01:23:00', '2024-12-10 01:23:00', 'SVCPR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ikut_ujian`
--

CREATE TABLE `tbl_ikut_ujian` (
  `id` int NOT NULL,
  `id_tes` int NOT NULL,
  `id_user` varchar(50) NOT NULL DEFAULT '',
  `jml_benar` int DEFAULT '0',
  `nilai` decimal(10,2) DEFAULT '0.00',
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `status` enum('ujian','selesai','terlambat') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'ujian'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ikut_ujian`
--

INSERT INTO `tbl_ikut_ujian` (`id`, `id_tes`, `id_user`, `jml_benar`, `nilai`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(1, 1, '5280', 0, '0.00', '2024-12-06 00:13:39', NULL, 'terlambat'),
(2, 3, '5280', 5, '25.00', '2024-12-06 00:18:07', '2024-12-06 00:18:53', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jawaban`
--

CREATE TABLE `tbl_jawaban` (
  `id` int NOT NULL,
  `id_tes` int NOT NULL,
  `id_user` varchar(50) NOT NULL DEFAULT '',
  `id_soal` int NOT NULL,
  `jawaban` varchar(2) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tbl_jawaban`
--

INSERT INTO `tbl_jawaban` (`id`, `id_tes`, `id_user`, `id_soal`, `jawaban`) VALUES
(1, 3, '5280', 1, 'A'),
(2, 3, '5280', 2, 'A'),
(3, 3, '5280', 3, 'A'),
(4, 3, '5280', 4, 'A'),
(5, 3, '5280', 5, 'A'),
(6, 3, '5280', 6, 'A'),
(7, 3, '5280', 7, 'B'),
(8, 3, '5280', 8, 'B'),
(9, 3, '5280', 9, 'A'),
(10, 3, '5280', 10, 'A'),
(11, 3, '5280', 11, 'A'),
(12, 3, '5280', 20, 'A'),
(13, 3, '5280', 19, 'A'),
(14, 3, '5280', 18, 'A'),
(15, 3, '5280', 17, 'A'),
(16, 3, '5280', 16, 'A'),
(17, 3, '5280', 15, 'B'),
(18, 3, '5280', 14, 'B'),
(19, 3, '5280', 13, 'A'),
(20, 3, '5280', 12, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama`) VALUES
('A1', 'TKJ'),
('A2', 'TKR'),
('A3', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id` int NOT NULL,
  `kelas` varchar(4) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`id`, `nama`) VALUES
(1, 'tkj'),
(2, 'B..inggris'),
(3, 'B. Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket_soal`
--

CREATE TABLE `tbl_paket_soal` (
  `id_ujian` int DEFAULT NULL,
  `id_soal` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_paket_soal`
--

INSERT INTO `tbl_paket_soal` (`id_ujian`, `id_soal`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(4, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kode_jurusan` varchar(100) NOT NULL,
  `stat` enum('A','T') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama`, `kelas`, `kode_jurusan`, `stat`) VALUES
('5280', 'ALIFIA TAZKIA', 'X', 'A1', 'A'),
('5282', 'ARJUWAN AREVI', 'X', 'A1', 'A'),
('5281', 'AURALIA ZAHRA GLADI', 'X', 'A1', 'A'),
('5283', 'DESWITA DIANTI N ', 'X', 'A1', 'A'),
('5284', 'DEVA MAULANA', 'X', 'A1', 'A'),
('5285', 'DIKI AFANDI', 'X', 'A1', 'A'),
('5286', 'DINA LUTFIYANI ', 'X', 'A1', 'A'),
('5287', 'ERINA RIZKA FITRIANI', 'X', 'A1', 'A'),
('5288', 'EVELLYN AURA MAULIDA', 'X', 'A1', 'A'),
('5289', 'FAIQHUBBAFI AHMAD', 'X', 'A1', 'A'),
('5290', 'FANDILI SETIA DWI YANTO', 'X', 'A1', 'A'),
('5291', 'FAREL DWI AVANDI', 'X', 'A1', 'A'),
('5292', 'GAURI YANITA ALMAISYAH', 'X', 'A1', 'A'),
('5293', 'HAZBULLAH AZEEM', 'X', 'A1', 'A'),
('5294', 'HERLINA TRI AMPERA', 'X', 'A1', 'A'),
('5296', 'ISNAENI LINDA AOLIA', 'X', 'A1', 'A'),
('5297', 'MAYZA ZAKIA RAKHMA ', 'X', 'A1', 'A'),
('5298', 'MEISA NUR KHOLIFAH', 'X', 'A1', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` int NOT NULL,
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
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `id_guru`, `id_mapel`, `kelas`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`) VALUES
(1, '0001', 1, 'X', '-', '-', '<p>Jenis kabel dibawah ini yang digunakan pada topologi bus adalah ……</p>', '<p>UTP</p>', '<p>Coaxial</p>', '<p>STP</p>', '<p>Kabel Data</p>', '<p>Fiber Optic</p>', 'B', '2024-12-06 00:00:52'),
(2, '0001', 1, 'X', '-', '-', '<p>Permasalah yang timbul pada jalur utama topologi bus adalah ……</p>', '<p>Data tidak sampai tujuan</p>', '<p>Terjadi tabrakan data (Collision)</p>', '<p>Kecepatan transfer data rendah</p>', '<p>Terjadinya kerusakan pada hub</p>', '<p>Boros kabel</p>', 'B', '2024-12-06 00:00:52'),
(3, '0001', 1, 'X', '-', '-', '<p>Bagaimana pengaruh terhadap computer lain apabila salah satu konektor BNC\nputus?</p>', '<p>Kecepatan transfer data meningkat</p>', '<p>Kecepatan transfer data menurun</p>', '<p>Tidak ada pengaruh</p>', '<p>Tidak dapat terkoneksi ke jaringan</p>', '<p>Terjadi kerusakan pada NIC</p>', 'E', '2024-12-06 00:00:52'),
(4, '0001', 1, 'X', '-', '-', '<p>Besar hambatan terminator yang digunakan pada topologi bus adalah ….</p>', '<p>10 Ohm</p>', '<p>75 Ohm</p>', '<p>25 Ohm</p>', '<p>100 Ohm</p>', '<p>50 Ohm</p>', 'E', '2024-12-06 00:00:52'),
(5, '0001', 1, 'X', '-', '-', '<p>Central node pada topologi star berupa …..</p>', '<p>Repeater</p>', '<p>Switch/hub</p>', '<p>Konektor</p>', '<p>Router</p>', '<p>Kabel</p>', 'B', '2024-12-06 00:00:52'),
(6, '0001', 1, 'X', '-', '-', '<p>Kecepatan maksimum kartu jaringan jenis ISA pada topologi star adalah ……</p>', '<p>5 Mbps</p>', '<p>10 Mbps</p>', '<p>15 Mbps</p>', '<p>20 Mbps</p>', '<p>25 Mbps</p>', 'B', '2024-12-06 00:00:52'),
(7, '0001', 1, 'X', '-', '-', '<p>Repeater dipasang jika jarak kabel UTP sudah lebih dari …..</p>', '<p>100 m</p>', '<p>200 m</p>', '<p>300 m</p>', '<p>400 m</p>', '<p>500 m</p>', 'A', '2024-12-06 00:00:52'),
(8, '0001', 1, 'X', '-', '-', '<p>Fungsi dari tang Crimping pada pemasangan kabel UTP adalah ….</p>', '<p>Memotong kabel</p>', '<p>Mengelupas kabel</p>', '<p>Meratakan kabel</p>', '<p>Mengunci konektor</p>', '<p>Semua jawaban benar</p>', 'E', '2024-12-06 00:00:52'),
(9, '0001', 1, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk mengirim (transferring)\ndata adalah …..</p>', '<p>1 dan 2</p>', '<p>6 dan 8</p>', '<p>4 dan 5</p>', '<p>3 dan 6</p>', '<p>3 dan 8</p>', 'A', '2024-12-06 00:00:52'),
(10, '0001', 1, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk menerima (recieving)\ndata adalah …..</p>', '<p>1 dan 2</p>', '<p>6 dan 8</p>', '<p>4 dan 5</p>', '<p>3 dan 6</p>', '<p>3 dan 8</p>', 'D', '2024-12-06 00:00:52'),
(11, '0001', 1, 'X', '-', '-', '<p>Pemasangan kabel secara straight pada kabel UTP digunakan untuk\nmenghubungkan …..</p>', '<p>Komputer dengan computer</p>', '<p>Komputer dengan hub/switch</p>', '<p>Switch dengan router</p>', '<p>Hub dengan Repeater</p>', '<p>Client dengan Server</p>', 'B', '2024-12-06 00:00:52'),
(12, '0001', 1, 'X', '-', '-', '<p>Apabila NIC sudah terinsall dengan baik, maka dapat dilihat meelalui ….</p>', '<p>Device manager dan Add/remove hardware</p>', '<p>Control panel dan Add/remove windows component</p>', '<p>Windows explorer dan regedit</p>', '<p>Network connection dan device manager</p>', '<p>My network places dan dxdiag</p>', 'A', '2024-12-06 00:00:52'),
(13, '0001', 1, 'X', '-', '-', '<p>Mengapa alamat IP dengan octet pertama 127 tidak digunakan di kelas A?</p>', '<p>Sebagai cadangan untuk penelitian</p>', '<p>Merupakan IP khusus yang hanya dimiliki oleh server</p>', '<p>Merupakan IP LoopBack untuk untuk setiap computer yang ada</p>', '<p>Merupakan IP yang digunakan untuk keperluan routing jaringan</p>', '<p>Merupakan IP yang bersifat public untuk jaringan internet</p>', 'C', '2024-12-06 00:00:52'),
(14, '0001', 1, 'X', '-', '-', '<p>Sebuah jaringan computer dengan jumlah computer 43. Maka subnet mask yang\ndigunakan adalah …..</p>', '<p>255.255.255.0</p>', '<p>255.255.255.128</p>', '<p>255.255.255.192</p>', '<p>255.255.255.224</p>', '<p>255.255.255.240</p>', 'C', '2024-12-06 00:00:52'),
(15, '0001', 1, 'X', '-', '-', '<p>Dalam pengalamatan IP Address, isian DNS berfungsi untuk …..</p>', '<p>Menerjemahkan alamat IP ke alamat domain</p>', '<p>Koneksi ke jaringan</p>', '<p>Menghubungkan dua workgroup</p>', '<p>Koneksi dengan jaringan Client Server</p>', '<p>Koneksi dengan /Hostpot</p>', 'A', '2024-12-06 00:00:52'),
(16, '0001', 1, 'X', '-', '-', '<p>Dibawah ini merupakan contoh koneksitas jaringan yang paling bagus adalah ……</p>', '<p>Reply from 192.168.1.1: bytes=32 time=10ms TTL=64</p>', '<p>Reply from 192.168.1.2: bytes=32 time=15ms TTL=64</p>', '<p>Reply from 192.168.1.3: bytes=32 time=20ms TTL=64</p>', '<p>Reply from 192.168.1.4: bytes=32 time=25ms TTL=64</p>', '<p>Reply from 192.168.1.5: bytes=32 time=50ms TTL=64</p>', 'A', '2024-12-06 00:00:52'),
(17, '0001', 1, 'X', '-', '-', '<p>Permasalahan yang mungkin terjadi pada software dalam koneksitas jaringan adalah\nberikut ini, kecuali…..</p>', '<p>Setting konfigurasi jaringan tidak benar</p>', '<p>Kesalahan nama Workgroup pada komputer</p>', '<p>Protokol yang tidak cocok</p>', '<p>Network Interface Card (NIC) rusak/mati</p>', '<p>Kesalahan service network</p>', 'D', '2024-12-06 00:00:52'),
(18, '0001', 1, 'X', '-', '-', '<p>Untuk mengetahui koneksi komputer ke switch / hub, dapat dilakukan dengan\nmengecek suatu hal yang berikut ini, kecuali …Untuk mengetahui koneksi komputer ke switch / hub, dapat dilakukan dengan\nmengecek suatu hal yang berikut ini, kecuali …</p>', '<p>Lampu indikator switch / hub</p>', '<p>Kabel LAN</p>', '<p>Lampu indikator LAN Card</p>', '<p>IP Address</p>', '<p>Server</p>', 'E', '2024-12-06 00:00:52'),
(19, '0001', 1, 'X', '-', '-', '<p>Untuk mengakses CDROM yang ada didrive E dengan Ip address 192.168.103.2 dari\nkomputer orang lain yang sudah disharing, contoh isian di baris Open yang benar\nadalah…</p>', '<p>\\192.168.103.2E</p>', '<p>\\ServerE</p>', '<p>//192.168.103.2/E</p>', '<p>D. //SMKN JMTN/E</p>', '<p>\\192.168.103.2/E</p>', 'A', '2024-12-06 00:00:52'),
(20, '0001', 1, 'X', '-', '-', '<p>Di bawah ini yang termasuk system operasi berbasis GUI kecuali ……..</p>', '<p>Mickrotik</p>', '<p>Apple</p>', '<p>Macintosh</p>', '<p>Windows</p>', '<p>Ubuntu</p>', 'A', '2024-12-06 00:00:52'),
(21, '0001', 1, 'X', '-', '-', '<p>Di bawah ini adalah jenis-jenis sistem operasi, kecuali…..</p>', '<p>Ubuntu</p>', '<p>Windows XP</p>', '<p>Mac OS</p>', '<p>Cytrix</p>', '<p>Red Hat</p>', 'D', '2024-12-06 00:00:52'),
(22, '0001', 1, 'X', '-', '-', '<p>Sebuah jaringan computer dengan jumlah computer 43 maka memiliki subnet mask\nyang digunakan…</p>', '<p>255.255.255.0</p>', '<p>255.255.255.24</p>', '<p>255.255.255.192</p>', '<p>255.255.255.250</p>', '<p>255.255.255.254</p>', 'C', '2024-12-06 00:00:52'),
(23, '0001', 1, 'X', '-', '-', '<p>Panjang Net id pada kelas A</p>', '<p>8 bit</p>', '<p>16 bit</p>', '<p>24 bit</p>', '<p>64 bit</p>', '<p>32 bit</p>', 'A', '2024-12-06 00:00:52'),
(24, '0001', 1, 'X', '-', '-', '<p>Panjang Host ID pada kelas B</p>', '<p>8 bit</p>', '<p>16 bit</p>', '<p>24 bit</p>', '<p>64 bit</p>', '<p>32 bit</p>', 'B', '2024-12-06 00:00:52'),
(25, '0001', 1, 'X', '-', '-', '<p>Perintah untuk mengetahui jalur / rute suatu domain komputer / website menggunakan pada system Linux adalah ………</p>', '<p>Ping</p>', '<p>Traceroute</p>', '<p>Tracert</p>', '<p>Ipconfig</p>', '<p>Ifconfig</p>', 'C', '2024-12-06 00:00:52'),
(26, '0001', 1, 'X', '-', '-', '<p>Perangkat keras yang digunakan untuk menyatukan kabel-kabel network dari tiap-tiap\nworkstation atau perangkat lainnya dalam jaringan disebut..........</p>', '<p>Concentrator</p>', '<p>Lan Card</p>', '<p>Modem</p>', '<p>USB</p>', '<p>Wireless</p>', 'A', '2024-12-06 00:00:52'),
(27, '0001', 1, 'X', '-', '-', '<p>Topologi jaringan komputer yang menggunakan BNC (T) sebagai konektornya\nadalah....</p>', '<p>Topologi Bus</p>', '<p>Topologi Coaxia</p>', '<p>Topologi Ring</p>', '<p>Topologi Star,</p>', '<p>Topologi Workstation</p>', 'A', '2024-12-06 00:00:52'),
(28, '0001', 1, 'X', '-', '-', '<p>Dibawah ini salah satu protokol internet yang sering digunakan untuk mentranfer data atau file adalah…</p>', '<p>DNS</p>', '<p>Sosial Media</p>', '<p>FTP</p>', '<p>HTTP</p>', '<p>SMTP</p>', 'C', '2024-12-06 00:00:52'),
(29, '0001', 1, 'X', '-', '-', '<p>Salah satu keuntungan jaringan komputer menggunakan topologi bus adalah ….</p>', '<p>Deteksi dan isolasi kesalahan sangat kecil</p>', '<p>Pengembangan jaringan atau penambahan workstation baru dapat dilakukan\ndengan mudah tanpa menggangu workstation lain.</p>', '<p>Kepadatan lalu lintas pada jalur utama</p>', '<p>Diperlukan repeater untuk jarak jauh</p>', '<p>Lay out kabel kompleks</p>', 'C', '2024-12-06 00:00:52'),
(30, '0001', 1, 'X', '-', '-', '<p>Agar penggunaan kabel coaxial jenis thinnet optimal maka setiap ujung harus\nditerminasi dengan....</p>', '<p>Pembungkus kaber (isolator)</p>', '<p>T-Connector 0,5 meter</p>', '<p>Terminator 50-ohm</p>', '<p>Terminator 500-ohm</p>', '<p>Transceiver External</p>', 'C', '2024-12-06 00:00:52'),
(31, '0001', 1, 'X', '-', '-', '<p>Perintah “PING” pada jaringan digunakan untuk hal-hal yang berikut ini, kecuali....</p>', '<p>Menguji fungsi kirim sebuah NIC</p>', '<p>Menguji fungsi terima sebuahNIC</p>', '<p>Menguji kesesuaian sebuah NIC</p>', '<p>Menguji konfigurasi TCP/IP</p>', '<p>Menguji koneksi jaringan</p>', 'C', '2024-12-06 00:00:52'),
(32, '0001', 1, 'X', '-', '-', '<p>Untuk melihat konfigurasi alamat IP pada sebuah komputer digunakan perintah....</p>', '<p>Ip all</p>', '<p>Ipall</p>', '<p>p config</p>', '<p>Ipconfig</p>', '<p>Ipconfigurasi</p>', 'D', '2024-12-06 00:00:52'),
(33, '0001', 1, 'X', '-', '-', '<p>Apakan kepanjangan dari DHCP…</p>', '<p>Dinamis Host Configurasi Protocol.</p>', '<p>Dinamis Host Configurasi Protocol.</p>', '<p>Dynamic Hosting Confidenci Protocol</p>', '<p>Dinamic Host Confidenci Protocol.</p>', '<p>Dynamic Host Configuration Protocol.</p>', 'E', '2024-12-06 00:00:52'),
(34, '0001', 1, 'X', '-', '-', '<p> Dalam pengalamatan IP Address, Isian DNS berfungsi untuk…</p>', '<p>Koneksi ke jaringan internet</p>', '<p>Koneksi ke jaringan internet</p>', '<p>Menghubungkan 2 workgroup</p>', '<p>Koneksi dengan jaringan Client server</p>', '<p>Koneksi dengan Hotspot</p>', 'A', '2024-12-06 00:00:52'),
(35, '0001', 1, 'X', '-', '-', '<p>Jenis IP address untuk jaringan berukuran kecil atau Local Area Network adalah....</p>', '<p>Kelas A</p>', '<p>Kelas B</p>', '<p>Kelas C</p>', '<p>Kelas A dan B</p>', '<p>Kelas B dan C</p>', 'C', '2024-12-06 00:00:52'),
(36, '0001', 1, 'X', '-', '-', '<p>Tujuan dibentuknya workgroup</p>', '<p>Mempermudah pengalamatan IP</p>', '<p>Mempermudah transfer data</p>', '<p>Mempermudah sharing data</p>', '<p>Mempermudah koneksi internet</p>', '<p>Mempermudah pengelolaan jaringan</p>', 'C', '2024-12-06 00:00:52'),
(37, '0001', 1, 'X', '-', '-', '<p>Dalam konfigurasi berbagi pakai koneksi internet (internet connection sharing),\nkomputer yang tersambung dengan internet akan berfungsi sebagai....</p>', '<p>client</p>', '<p>dump</p>', '<p>router</p>', '<p>switch</p>', '<p>server / gateway</p>', 'A', '2024-12-06 00:00:52'),
(38, '0001', 1, 'X', '-', '-', '<p>Pemasangan NIC pada computer tidak plug and play disebabkan…</p>', '<p>Belum ada driver NIC pada OS</p>', '<p>NIC bertipe ISA</p>', '<p>NIC bertipe PCI</p>', '<p>NIC rusak</p>', '<p>NIC bertipe AGP</p>', 'A', '2024-12-06 00:00:52'),
(39, '0001', 1, 'X', '-', '-', '<p>Pada pemasangan kabel straight, pin yang digunakan untuk mengirim (transmit) data\nadalah..</p>', '<p>1 dan 2</p>', '<p>4 dan 5</p>', '<p>3 dan 8</p>', '<p>7 dan 6</p>', '<p>3 dan 6</p>', 'E', '2024-12-06 00:00:52'),
(40, '0001', 1, 'X', '-', '-', '<p>Kombinasi pengkabelan straight pada jaringan komputer yang sesuai dengan\nstandart internasional adalah....</p>', '<p>White orange – orange - white green – blue - white blue - green – white\nbrown - brown</p>', '<p>White orange – orange - white green – green - white blue - blue – white brown -\nbrown</p>', '<p>White green – green - white orange – blue - white blue - orange – white brown - brown</p>', '<p>White orange – orange - white green - green - white blue - blue – white brown - brown</p>', '<p>Orange – white orange – green – white green - white blue - blue – white brown – brown</p>', 'A', '2024-12-06 00:00:52'),
(41, '0001', 1, 'X', '-', '-', '<p>PING merupakan perintah yang digunakan untuk…</p>', '<p>Menguji koneksi jaringan</p>', '<p>Melihat Mac Address</p>', '<p>Menghapus history Browser</p>', '<p>Menstransfer file antara jaringan</p>', '<p>Melihat komputer terinfeksi virus atau tidak</p>', 'A', '2024-12-06 00:00:52'),
(42, '0001', 1, 'X', '-', '-', '<p>Bagian Komputer terbagi menjadi 3 yaitu…</p>', '<p>Software -  Hardware -  Output</p>', '<p>Hardware - Software - Brainware</p>', '<p>Harddisk - Monitor -  VGA</p>', '<p>Input - Proses - Output</p>', '<p>Input - Komputer -  Output</p>', 'B', '2024-12-06 00:00:52'),
(43, '0001', 1, 'X', '-', '-', '<p>Setiap komputer yang terhubung ke jaringan dapat bertindak baik sebagai workstation maupun server disebut jaringan …</p>', '<p>Peer to peer</p>', '<p>Client and server</p>', '<p>Local Area Network</p>', '<p>Bus</p>', '<p>Tree</p>', 'E', '2024-12-06 00:00:52'),
(44, '0001', 1, 'X', '-', '-', '<p>Salah satu tipe jaringan komputer yang umum dijumpai adalah….</p>', '<p>Star</p>', '<p>Bus</p>', '<p>WAN</p>', '<p>Wireless</p>', '<p>Client-server</p>', 'E', '2024-12-06 00:00:52'),
(45, '0001', 1, 'X', '-', '-', '<p>Setelah kita menginstall sistem operasi Windows, hal yang harus dilakukan berikutnya adalah</p>', '<p>Menginstall driver</p>', '<p>Menginstall photoshop</p>', '<p>Menginstall VirtualBox</p>', '<p>Mengubah Wallpaper</p>', '<p>Merakit Komputer</p>', 'A', '2024-12-06 00:00:52'),
(46, '0001', 1, 'X', '-', '-', '<p>Satuan informasi terkecil yang dikenal dalam komunikasi data dibawah ini adalah…</p>', '<p>Bit</p>', '<p> Byte</p>', '<p>Mbps</p>', '<p>GB</p>', '<p>Segment</p>', 'A', '2024-12-06 00:00:52'),
(47, '0001', 1, 'X', '-', '-', '<p>1 Terabyte sama dengan…</p>', '<p>1000 Gigabyte</p>', '<p>1200 Gigabyte</p>', '<p>4000 Gigabyte</p>', '<p>2300 Gigabyte</p>', '<p>500 Gigabyte</p>', 'A', '2024-12-06 00:00:52'),
(48, '0001', 1, 'X', '-', '-', '<p>Mail Transfer Protocol (SMTP) adalah protokol pada jaringan internet yang berfungsi untuk..</p>', '<p>Menerima email</p>', '<p>Menambahkan IP Address</p>', '<p>Membuat database email</p>', '<p>Mengirimkan pesan email agar tepat waktu dan efisien kepada penerima</p>', '<p>Mengumpulkan email yang masuk</p>', 'D', '2024-12-06 00:00:52'),
(49, '0001', 1, 'X', '-', '-', '<p>Suatu sistem yang memungkinkan nama suatu host pada jaringan komputer atau internet ditranslasikan menjadi IP address disebut ….</p>', '<p>DNS</p>', '<p>Gateway</p>', '<p>Protokol</p>', '<p>DHCP</p>', '<p>Ipconfig</p>', 'A', '2024-12-06 00:00:52'),
(50, '0001', 1, 'X', '-', '-', '<p>Yang bukan merupakan varian sistem operasi jaringan berbasis GUI yang menggunakan basis Linux adalah…..</p>', '<p>Redhat</p>', '<p>Mandrake</p>', '<p>Caldera</p>', '<p>Debian</p>', '<p>Fortran</p>', 'E', '2024-12-06 00:00:52'),
(51, '0002', 3, 'X', '-', '-', '<p>soal <strong>Indoneisa</strong></p>', '<p>Indonesia A</p>', '<p>Indonesia B</p>', '<p>Indonesia C</p>', '<p>Indonesia D</p>', '<p>Indonesia E</p>', 'B', '2024-12-06 00:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `peran` enum('admin','guru','siswa') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktivasi` enum('A','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `peran`, `nama`, `aktivasi`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'admin', 'A'),
(2, 'matien', 'c93ccd78b2076528346216b3b2f701e6', 'admin', 'matien', 'A'),
(21, '001', 'dc5c7986daef50c1e02ab09b442ee34f', 'guru', 'Arain dirgantara,s.Kom', 'A'),
(22, '0002', 'fcd04e26e900e94b9ed6dd604fed2b64', 'guru', 'Anis Alwi Mubarok,S,Kom', 'A'),
(23, '0001', '25bbdcd06c32d477f7fa1c3e4a91b032', 'guru', 'Arain dirgantara,s.Kom', 'A'),
(24, '0002', 'fcd04e26e900e94b9ed6dd604fed2b64', 'guru', 'Anis Alwi Mubarok,S,Kom', 'A'),
(25, '0003', '7cd86ecb09aa48c6e620b340f6a74592', 'guru', 'Lutfi Sakti M, S.Kom', 'A'),
(26, '5280', '5b658d2a925565f0755e035597f8d22f', 'siswa', 'ALIFIA TAZKIA', 'A'),
(27, '5282', '91e82999cf7e45da1070ebd673690716', 'siswa', 'ARJUWAN AREVI', 'A'),
(28, '5281', '980b2e71a187f092466c13bf42cd6413', 'siswa', 'AURALIA ZAHRA GLADI', 'A'),
(29, '5283', '5ca359ab1e9e3b9c478459944a2d9ca5', 'siswa', 'DESWITA DIANTI N ', 'A'),
(30, '5284', '0b9e57c46de934cee33b0e8d1839bfc2', 'siswa', 'DEVA MAULANA', 'A'),
(31, '5285', '151de84cca69258b17375e2f44239191', 'siswa', 'DIKI AFANDI', 'A'),
(32, '5286', '48237d9f2dea8c74c2a72126cf63d933', 'siswa', 'DINA LUTFIYANI ', 'A'),
(33, '5287', 'b937176da86d4bb5f0ac63aaecf540ea', 'siswa', 'ERINA RIZKA FITRIANI', 'A'),
(34, '5288', '8859a81bd114df94d9f432350c934f4a', 'siswa', 'EVELLYN AURA MAULIDA', 'A'),
(35, '5289', 'f2925f97bc13ad2852a7a551802feea0', 'siswa', 'FAIQHUBBAFI AHMAD', 'A'),
(36, '5290', '6e7d5d259be7bf56ed79029c4e621f44', 'siswa', 'FANDILI SETIA DWI YANTO', 'A'),
(37, '5291', 'be3087e74e9100d4bc4c6268cdbe8456', 'siswa', 'FAREL DWI AVANDI', 'A'),
(38, '5292', '7e8750d4a701596732953c160d2ae096', 'siswa', 'GAURI YANITA ALMAISYAH', 'A'),
(39, '5293', '7967cc8e3ab559e68cc944c44b1cf3e8', 'siswa', 'HAZBULLAH AZEEM', 'A'),
(40, '5294', 'f1e5284674fd1e360873c29337ebe2d7', 'siswa', 'HERLINA TRI AMPERA', 'A'),
(41, '5296', 'fd9dd764a6f1d73f4340d570804eacc4', 'siswa', 'ISNAENI LINDA AOLIA', 'A'),
(42, '5297', 'bf5a1d9043100645b2067fa70d7a1ea6', 'siswa', 'MAYZA ZAKIA RAKHMA ', 'A'),
(43, '5298', '70821a40b06f8751781d5a895357da67', 'siswa', 'MEISA NUR KHOLIFAH', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_guru_mapel`
--
ALTER TABLE `tbl_guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`nip_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `tbl_guru_tes`
--
ALTER TABLE `tbl_guru_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_tes` (`id_tes`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_paket_soal`
--
ALTER TABLE `tbl_paket_soal`
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_guru_mapel`
--
ALTER TABLE `tbl_guru_mapel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_guru_tes`
--
ALTER TABLE `tbl_guru_tes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
