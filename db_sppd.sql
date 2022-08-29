-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 09:29 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `level`) VALUES
(3, 'admin', 'rijalul.arif@gmail.com', 'admin', 'operator'),
(4, 'kadiskominfo', 'kadiskominfo@gmail.com', 'kadiskominfo', 'kadis');

-- --------------------------------------------------------

--
-- Table structure for table `biaya`
--

CREATE TABLE `biaya` (
  `id_biaya` int(5) NOT NULL,
  `id_tujuan` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `id_pangkat` int(5) NOT NULL,
  `harian` double NOT NULL,
  `penginapan` double NOT NULL,
  `transportasi` double NOT NULL,
  `lumpsum` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biaya`
--

INSERT INTO `biaya` (`id_biaya`, `id_tujuan`, `id_jabatan`, `id_pangkat`, `harian`, `penginapan`, `transportasi`, `lumpsum`) VALUES
(1, 2, 6, 3, 500000, 300000, 200000, 90000),
(2, 0, 0, 0, 23, 33, 33, 33),
(3, 1, 1, 1, 100000, 100000, 100000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_nppt`
--

CREATE TABLE `detail_nppt` (
  `id_detail` int(5) NOT NULL,
  `id_nppt` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `status_perintah` enum('Perintah','Pengikut') NOT NULL DEFAULT 'Pengikut'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_nppt`
--

INSERT INTO `detail_nppt` (`id_detail`, `id_nppt`, `id_pegawai`, `status_perintah`) VALUES
(9, 5, 3, 'Perintah');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Kepala Dinas Komunikasi dan Informatika'),
(2, 'Kasubbag Keuangan, Evaluasi dan Pelaporan'),
(3, 'Sekretaris Dinas Komunikasi dan Informatika'),
(4, 'Kasubag Umum dan Kepegawaian'),
(5, 'SKJ Kepala Dinas Komunikasi dan Informatika'),
(6, 'Kabid Hubungan Masyarakat'),
(7, 'Kabid Teknologi Informasi dan Penyelenggaraan E-Government'),
(8, 'Kasi Persandian, Analisis Berita dan Dokumentasi'),
(9, 'Kasi Pengelolaan Infrastruktur TIK'),
(10, 'Kasi Statistik dan Managemen Data'),
(11, 'Kasi Pendayagunaan Sarana TIK'),
(12, 'Kasi Pengembangan dan Pengelolaan Aplikasi'),
(13, 'Kasi Pengelolaan Informasi Publik'),
(14, 'Kasi Persandian, Analisis Berita dan Dokumentasi'),
(15, 'Staf'),
(16, 'Pengemudi'),
(17, 'Technical Support'),
(18, 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE `kwitansi` (
  `id_kwitansi` int(5) NOT NULL,
  `id_sppd` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `dari` text NOT NULL,
  `untuk` text NOT NULL,
  `lama` double NOT NULL,
  `lumpsum` double NOT NULL,
  `harian` double NOT NULL,
  `penginapan` double NOT NULL,
  `transportasi` double NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`id_kwitansi`, `id_sppd`, `id_pegawai`, `dari`, `untuk`, `lama`, `lumpsum`, `harian`, `penginapan`, `transportasi`, `tujuan`) VALUES
(2, 3, 3, 'BENDAHARA PENGELUARAN DISKOMINFO KABUPATEN PASAMAN', '', 1, 90000, 500000, 0, 200000, 'Bukittinggi'),
(4, 4, 3, 'BENDAHARA PENGELUARAN DISKOMINFO KABUPATEN PASAMAN', 'Keseluruhan', 1, 90000, 500000, 0, 200000, 'Bukittinggi');

-- --------------------------------------------------------

--
-- Table structure for table `lpd`
--

CREATE TABLE `lpd` (
  `id_lpd` int(5) NOT NULL,
  `id_spt` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `id_pangkat` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `hasil` text NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lpd`
--

INSERT INTO `lpd` (`id_lpd`, `id_spt`, `id_pegawai`, `id_pangkat`, `id_jabatan`, `hasil`, `kepada`, `hari`, `tanggal`) VALUES
(1, 1, 3, 0, 0, '		Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\n		', '', 'Sabtu', '2021-04-17'),
(2, 5, 3, 0, 0, '					Adapun hasil perjalanan dinas tersebut adalah sebagai berikut : \r\n					', '', 'Senin', '2021-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `nppt`
--

CREATE TABLE `nppt` (
  `id_nppt` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `id_tujuan` int(5) NOT NULL,
  `id_transportasi` int(5) NOT NULL,
  `id_pegawai_perintah` int(5) NOT NULL,
  `maksud` text NOT NULL,
  `lama` varchar(20) NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nppt`
--

INSERT INTO `nppt` (`id_nppt`, `id_pegawai`, `id_tujuan`, `id_transportasi`, `id_pegawai_perintah`, `maksud`, `lama`, `tgl_pergi`, `tgl_kembali`, `tgl_dibuat`, `status`) VALUES
(5, 3, 2, 3, 3, 'Hubungan Masyarakat', '1', '2021-04-19', '2021-04-19', '2021-04-19', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id_pangkat` int(5) NOT NULL,
  `pangkat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `pangkat`) VALUES
(1, 'Pembina Utama Muda/(IVc)'),
(2, 'Pembina Tk.I/(IV/b)'),
(3, 'Pembina/(IV/a)'),
(4, 'Penata Tk.I/(III/d)'),
(5, 'Penata/(III/c)'),
(6, 'Penata Muda Tk.I/(III/b)'),
(7, 'Penata Muda Tk.I/(III/a)'),
(8, 'Penata Muda/(III/a)'),
(9, 'Pengatur Tk.I/(II/d)'),
(10, 'Pengatur Muda Tk.I/(II/b)'),
(11, 'Pengatur/(II/c)'),
(12, 'Pengatur Muda Tk.I/(II/b)'),
(13, 'Penata Muda Tk.I/(III/d)'),
(14, 'Non PNS');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `id_pangkat` int(5) NOT NULL,
  `id_jabatan` int(5) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `unitkerja` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_pangkat`, `id_jabatan`, `nip`, `nama`, `unitkerja`, `username`, `password`) VALUES
(1, 2, 1, '197111181997011001', 'WILLIYAM HUTABARAT, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197111181997011001', '197111181997011001'),
(3, 3, 6, '197004231992021001', 'APRIALDI SAID, SH', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197004231992021001', '197004231992021001'),
(5, 3, 15, '197209291992021001', 'ASNIL SY, SH', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197209291992021001', '197209291992021001'),
(6, 3, 7, '197410182005011004', 'NURHAQQI, ST. M. Eng', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197410182005011004', '197410182005011004'),
(8, 4, 9, '197908112006042007', 'IRMAWATI, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197908112006042007', '197908112006042007'),
(9, 5, 15, '196807031989032009', 'KARTINA', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '196807031989032009', '196807031989032009'),
(10, 5, 10, '196904221990031005', 'ANNA HANAFIAH', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '196904221990031005', '196904221990031005'),
(11, 5, 4, '196608302007011006', 'AGUSMAN, SH', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '196608302007011006', '196608302007011006'),
(12, 5, 11, '198601182011012010', 'LOLY FARISYA YULGA, ST', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198601182011012010', '198601182011012010'),
(13, 6, 12, '198511092014031002', 'RIZKI RAHMADI, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198511092014031002', '198511092014031002'),
(14, 14, 16, '-', 'ANTHONY', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '-', '-'),
(15, 8, 15, '199109292019021002', 'IKHWAN ARIEF, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '199109292019021002', '199109292019021002'),
(16, 11, 16, '197808062010011014', 'AGUSTIAN', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197808062010011014', '197808062010011014'),
(17, 2, 13, '197111161990031001', 'BUDHI HERMAWAN, SH', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197111161990031001', '197111161990031001'),
(18, 7, 15, '198409052010011011', 'VIRGO ERICK CANDRA. P.A.Md', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198409052010011011', '198409052010011011'),
(19, 4, 15, '196603251989031004', 'ZULASMAR', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '196603251989031004', '196603251989031004'),
(20, 3, 14, '197303301998031003', 'DIKCY SYAPUTRA, S.Sos, MM', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197303301998031003', '197303301998031003'),
(21, 8, 15, '197609052007012005', 'NUKE MAYA SHAPIRA, SE', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197609052007012005', '197609052007012005'),
(22, 8, 15, '199005282019022002', 'WIWI SILVIANITA, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '199005282019022002', '199005282019022002'),
(23, 7, 15, '197602262007012003', 'FAUZA ARIYANI, A.Md', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '197602262007012003', '197602262007012003'),
(24, 9, 15, '198006012007012002', 'WELINA', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198006012007012002', '198006012007012002'),
(25, 9, 15, '198807202011012008', 'YULFITA FITRIANI, A.Md', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198807202011012008', '198807202011012008'),
(26, 11, 15, '199108232019021001', 'GANI AGUSTIAWAN, A.Md.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '199108232019021001', '199108232019021001'),
(27, 9, 15, '198309052010012025', 'ELFI NASTIA, ST', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '198309052010012025', '198309052010012025'),
(28, 7, 15, '196504151986031002', 'PAIZAL', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '196504151986031002', '196504151986031002'),
(29, 14, 17, '-', 'AHMAD ROYFAL, S.Kom', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '-', '-'),
(30, 14, 17, '-', 'RESTU HUSNI, S.S', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '-', '-'),
(31, 14, 17, '-', 'INDRA BUANA, A.Ma', 'Dinas Komunikasi dan Informatika Kabupaten Pasaman', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `sppd`
--

CREATE TABLE `sppd` (
  `id_sppd` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `id_nppt` int(5) NOT NULL,
  `no_sppd` varchar(50) NOT NULL,
  `pemberi_perintah` varchar(100) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `mata_anggaran` text NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_sppd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sppd`
--

INSERT INTO `sppd` (`id_sppd`, `id_pegawai`, `id_nppt`, `no_sppd`, `pemberi_perintah`, `instansi`, `mata_anggaran`, `keterangan`, `tgl_sppd`) VALUES
(2, 31, 3, '1', 'Kepala Dinas Komunikasi dan Informatika', '', '2.16.2.20.2.21.01.00.02.2.01.02.5.1.02.04.01.0001', 'lihat sebelah', '0000-00-00'),
(4, 3, 5, '123', 'Kepala Dinas Komunikasi dan Informatika', '', '2.16.2.20.2.21.01.00.02.2.01.02.5.1.02.04.01.0001', 'cxecded', '0000-00-00'),
(5, 29, 6, '1', 'Kepala Dinas Komunikasi dan Informatika', '', '2.16.2.20.2.21.01.00.02.2.01.02.5.1.02.04.01.0001', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `spt`
--

CREATE TABLE `spt` (
  `id_spt` int(5) NOT NULL,
  `id_nppt` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `no_spt` varchar(50) NOT NULL,
  `pejabat_perintah` varchar(100) NOT NULL,
  `tugas` text NOT NULL,
  `tgl_spt` date NOT NULL,
  `dasar_hukum` text NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `pembebanan_anggaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spt`
--

INSERT INTO `spt` (`id_spt`, `id_nppt`, `id_pegawai`, `no_spt`, `pejabat_perintah`, `tugas`, `tgl_spt`, `dasar_hukum`, `tempat`, `pembebanan_anggaran`) VALUES
(5, 5, 3, '001/SPT/Dis-Kominfo-2021', 'Kepala Dinas Komunikasi dan Informatika', 'Hubungan Masyarakat', '0000-00-00', '...', 'Bukittinggi', '...');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `id_transportasi` int(5) NOT NULL,
  `transportasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id_transportasi`, `transportasi`) VALUES
(1, 'Pesawat'),
(2, 'Kendaraan Umum'),
(3, 'Kendaraan Dinas'),
(4, 'Menumpang Pada Kendaraan Lain'),
(5, 'Kendaraan Dinas Lainya'),
(6, 'Kendaraan Dinas/ SPT Pengemudi'),
(7, '-');

-- --------------------------------------------------------

--
-- Table structure for table `ttdkwitansi`
--

CREATE TABLE `ttdkwitansi` (
  `id` int(5) NOT NULL,
  `kadis` varchar(100) NOT NULL,
  `nip_kadis` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `nip_bendahara` varchar(100) NOT NULL,
  `pptk` varchar(100) NOT NULL,
  `nip_pptk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttdkwitansi`
--

INSERT INTO `ttdkwitansi` (`id`, `kadis`, `nip_kadis`, `bendahara`, `nip_bendahara`, `pptk`, `nip_pptk`) VALUES
(1, 'WILLIYAM HUTABARAT, S.Kom.', '197111181997011001', '-', '-', 'AGUSMAN, SH', '196608302007011006');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id_tujuan` int(5) NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id_tujuan`, `tujuan`) VALUES
(1, 'Surabaya'),
(2, 'Bukittinggi'),
(3, 'Batam'),
(4, 'Bandung'),
(5, 'Jakarta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biaya`
--
ALTER TABLE `biaya`
  ADD PRIMARY KEY (`id_biaya`),
  ADD KEY `id_tujuan` (`id_tujuan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_pangkat` (`id_pangkat`);

--
-- Indexes for table `detail_nppt`
--
ALTER TABLE `detail_nppt`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_nppt` (`id_nppt`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kwitansi`
--
ALTER TABLE `kwitansi`
  ADD PRIMARY KEY (`id_kwitansi`),
  ADD KEY `id_sppd` (`id_sppd`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `lpd`
--
ALTER TABLE `lpd`
  ADD PRIMARY KEY (`id_lpd`),
  ADD KEY `id_spt` (`id_spt`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `nppt`
--
ALTER TABLE `nppt`
  ADD PRIMARY KEY (`id_nppt`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_tujuan` (`id_tujuan`),
  ADD KEY `id_transportasi` (`id_transportasi`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`id_sppd`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_nppt` (`id_nppt`);

--
-- Indexes for table `spt`
--
ALTER TABLE `spt`
  ADD PRIMARY KEY (`id_spt`),
  ADD KEY `id_nppt` (`id_nppt`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id_transportasi`);

--
-- Indexes for table `ttdkwitansi`
--
ALTER TABLE `ttdkwitansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id_tujuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `biaya`
--
ALTER TABLE `biaya`
  MODIFY `id_biaya` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_nppt`
--
ALTER TABLE `detail_nppt`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kwitansi`
--
ALTER TABLE `kwitansi`
  MODIFY `id_kwitansi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lpd`
--
ALTER TABLE `lpd`
  MODIFY `id_lpd` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nppt`
--
ALTER TABLE `nppt`
  MODIFY `id_nppt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id_pangkat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sppd`
--
ALTER TABLE `sppd`
  MODIFY `id_sppd` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spt`
--
ALTER TABLE `spt`
  MODIFY `id_spt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id_transportasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ttdkwitansi`
--
ALTER TABLE `ttdkwitansi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id_tujuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
