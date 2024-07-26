-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2024 pada 06.04
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

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
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_guru`
--

INSERT INTO `tbl_guru` (`nip`, `nama`) VALUES
('0001', 'Matien Hakim Falahudin Bachtiar'),
('0002', 'guru 2'),
('0003', 'guru 3'),
('0004', 'guru 4'),
('0005', 'guru 5'),
('0006', 'guru 6'),
('0007', 'guru 7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru_mapel`
--

CREATE TABLE `tbl_guru_mapel` (
  `id` int(6) NOT NULL,
  `nip_guru` varchar(10) NOT NULL,
  `id_mapel` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_guru_mapel`
--

INSERT INTO `tbl_guru_mapel` (`id`, `nip_guru`, `id_mapel`) VALUES
(23, '0001', 7),
(22, '0001', 6),
(7, '0003', 4),
(9, '0005', 4),
(10, '0005', 8),
(21, '0001', 5),
(20, '0001', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru_tes`
--

CREATE TABLE `tbl_guru_tes` (
  `id` int(6) NOT NULL,
  `id_guru` varchar(10) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `nama_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int(6) NOT NULL,
  `kelas` varchar(200) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `waktu` int(6) NOT NULL,
  `jenis` enum('acak','set') NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `terlambat` datetime NOT NULL,
  `token` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_guru_tes`
--

INSERT INTO `tbl_guru_tes` (`id`, `id_guru`, `id_mapel`, `nama_ujian`, `jumlah_soal`, `kelas`, `jurusan`, `waktu`, `jenis`, `tgl_mulai`, `terlambat`, `token`) VALUES
(13, '0001', 3, 'UAS', 1, 'X', 'IPA', 20, 'set', '2024-07-07 11:55:00', '2024-07-07 17:00:00', 'LHQZA'),
(17, '0001', 6, 'UTS', 1, 'XI', 'IPA', 2, 'set', '2024-07-23 12:15:00', '2024-07-23 12:15:00', 'DKGHN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ikut_ujian`
--

CREATE TABLE `tbl_ikut_ujian` (
  `id` int(6) NOT NULL,
  `id_tes` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(6) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `nilai_bobot` decimal(10,2) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama`) VALUES
('A003', 'Bahasa Inggris'),
('A001', 'IPA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`id`, `nama`) VALUES
(1, 'B indonesia'),
(2, 'IPA'),
(3, 'B Inggris'),
(4, 'IPS'),
(5, 'TKJ'),
(6, 'TKR'),
(7, 'TSM'),
(8, 'misalakan bnyak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `kode_jurusan` varchar(100) NOT NULL,
  `stat` enum('A','T') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_siswa`
--

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `bobot` int(2) NOT NULL,
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
  `jml_benar` int(6) NOT NULL,
  `jml_salah` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `id_guru`, `id_mapel`, `bobot`, `file`, `tipe_file`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`, `jml_benar`, `jml_salah`) VALUES
(6, 3, 25, 2, '', '', '<p>soal</p>\r\n', '#####<p>a</p>\r\n', '#####<p>b</p>\r\n', '#####<p>c</p>\r\n', '#####<p>d</p>\r\n', '#####<p>e</p>\r\n', 'A', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(6) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `peran` enum('admin','guru','siswa') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktivasi` enum('A','T') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `peran`, `nama`, `aktivasi`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin', 'A'),
(2, 'matien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'matien', 'A'),
(3, 'tien', '8cb2237d0679ca88db6464eac60da96345513964', 'admin', 'tien', 'A'),
(54, '42421071', 'e81c3882d9ca22944a793c61dcbbe897', 'siswa', 'Matien Hakim Falahudin Bachtiar', 'A'),
(53, '42421070', '3b504e4ec694a6dfc6398f882e5add6c', 'siswa', 'M. Yusuf Al Qaradlawi', 'A'),
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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tbl_guru_mapel`
--
ALTER TABLE `tbl_guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`nip_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `tbl_guru_tes`
--
ALTER TABLE `tbl_guru_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tes` (`id_tes`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_guru_mapel`
--
ALTER TABLE `tbl_guru_mapel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_guru_tes`
--
ALTER TABLE `tbl_guru_tes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_ikut_ujian`
--
ALTER TABLE `tbl_ikut_ujian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
