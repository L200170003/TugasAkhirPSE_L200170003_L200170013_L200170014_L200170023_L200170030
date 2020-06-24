-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 04:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enterprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(20) NOT NULL,
  `account_username` varchar(12) NOT NULL,
  `account_password` varchar(250) NOT NULL,
  `account_lastpassword` varchar(250) NOT NULL,
  `account_isactive` enum('true','false') NOT NULL,
  `account_createat` timestamp NULL DEFAULT NULL,
  `account_modifyat` timestamp NULL DEFAULT NULL,
  `account_level` enum('root','admin','user','') NOT NULL,
  `account_image` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_password`, `account_lastpassword`, `account_isactive`, `account_createat`, `account_modifyat`, `account_level`, `account_image`) VALUES
(1, 'Super User', 'root', '$2y$08$kRQEMVMk9B1jp25Q9HUCs.k3wpO95IVOiHXsezjPMJYy3O0QCkm/i', '$2y$08$plSNCSRiwH.ZjLvPWexqQ.ZsGo896W7kox7v/eFzN8pUo.mfkfaMu', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'root', 'default.png'),
(2, 'Admin', 'admin', '$2y$08$qkWbNrRZhQTpF1mq0wpmEOtKKVdb/ElU6B.kLneoHoJqMxIrn1.1O', '$2y$08$imtrmNQYKRmee67/9k5quehniKdNB9DRvtDESVixxcnkGsBj7XS2y', 'false', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'admin', 'default.png'),
(3, 'User', 'user', '$2y$08$HVoMt5jaJNtqbuTyz0R63.3JBSmyypnpGJFoQmj2a5j/zulUwqNeK', '$2y$08$mepQyFyHK.W9AaUqxnnareyvF7SlHCozU5Q09VploXDPDkBWWIszC', 'false', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'user', 'default.png'),
(7, 'Astrin', 'inventory', '$2y$08$tL0jSIIywL9hyrul/3CLyeCoqXvdUT1ECwHnN9jG1/VPYvD/XUpN2', '$2y$08$gPEwCN8ohd9OoN7Nn0P.7eW2DjEUvsFrXG/YE5yG4xflSG.iS00Yu', 'true', '2020-06-23 14:26:04', '2020-06-23 14:26:04', 'root', '055c36c52a537c04ffaa01e6b3c13e44.jpg'),
(6, 'Fajar Nur', 'documment', '$2y$08$n7kHNvbOKTabjqjGxwzDJu7cw6utxHDnBwGWUUM4cZHD45U4eh2F6', '$2y$08$5TWMVpOz9NnwbTBWZf0nZetQ420zamDT.6VPPR2mESUQL5pi3xUcG', 'true', '2020-06-23 14:25:27', '2020-06-23 14:25:27', 'root', '7dc91e73f2ef3ac06e6b4f804ed61bf2.jpg'),
(8, 'Arlin', 'accounting', '$2y$08$trw9D2qK4uiOMGzMDYeUb.lSPWIubXu4lbOTGzxWga.b2Tr2iPw6y', '$2y$08$54r1DvHUSBCCOnAP6X1cVuOOIRzl/3xRaIkgqn2/BwJHYOO/DDLK.', 'true', '2020-06-23 14:26:52', '2020-06-23 14:26:52', 'root', 'b46c0a5e39e5e43acbac39a70add7aa9.jpg'),
(9, 'Dicky', 'payroll', '$2y$08$Urb0bHAB0yIcx9l4b9v48.i7bJflNK81HsHCUT8tlU4IO0SLP82t.', '$2y$08$CeftKqjV.ZlCS6IAx05hwegRzmYcdwWu2P70uy2RLo0qix7qyHqdu', 'true', '2020-06-23 14:27:26', '2020-06-23 14:27:26', 'root', '0d40a803e5d5b5004b65ce412d67e803.png'),
(10, 'Ilham', 'marketing', '$2y$08$N0MQP4ZgFst6TbxO44QLnOlRov0V2d6KiiJK4IpWgYJ6GtwXFjqPS', '$2y$08$gnqAF1RNlnopJnjn.e7fkOXlSulsv8MOUfitjB5kxBSCRpo2IRdm6', 'true', '2020-06-23 14:27:55', '2020-06-23 14:27:55', 'root', '4317005eb3e4ccd9aea1d8d5f1a1d036.png');

-- --------------------------------------------------------

--
-- Table structure for table `accounting`
--

CREATE TABLE `accounting` (
  `id_accounting` varchar(10) NOT NULL,
  `tanggal_accounting` date DEFAULT NULL,
  `pemasukan` bigint(10) DEFAULT NULL,
  `pengeluaran` bigint(10) DEFAULT NULL,
  `laba_rugi` bigint(10) DEFAULT NULL,
  `saldo` bigint(10) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `marketing_kode_marketing` varchar(10) NOT NULL,
  `sales_kode_penjualan` varchar(10) NOT NULL,
  `production_kode_produksi` varchar(10) NOT NULL,
  `purchasing_id_vendor` int(11) NOT NULL,
  `payroll_kode_payroll` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`id_accounting`, `tanggal_accounting`, `pemasukan`, `pengeluaran`, `laba_rugi`, `saldo`, `keterangan`, `marketing_kode_marketing`, `sales_kode_penjualan`, `production_kode_produksi`, `purchasing_id_vendor`, `payroll_kode_payroll`) VALUES
('Acc0120', '2020-04-21', NULL, NULL, NULL, NULL, 'Laporan', 'Market111', 'Sales01', 'Produksi01', 1001, 'Pay013'),
('Acc0121', '2020-05-21', NULL, NULL, NULL, NULL, 'Laporan', 'Market 212', 'Sales02', 'Produksi02', 1002, 'Pay30'),
('Acc0123', '2020-06-21', NULL, NULL, NULL, NULL, 'Laporan', 'Market313', 'Sales03', 'Produksi03', 333, 'Pay03');

-- --------------------------------------------------------

--
-- Table structure for table `commodity`
--

CREATE TABLE `commodity` (
  `commodity_id` int(11) NOT NULL,
  `commodity_name` varchar(50) NOT NULL,
  `commodity_type` varchar(50) NOT NULL,
  `commodity_price` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commodity`
--

INSERT INTO `commodity` (`commodity_id`, `commodity_name`, `commodity_type`, `commodity_price`) VALUES
(1, 'Major Pharmaceuticals', 'Agricultural', 976029),
(2, 'Automotive Aftermarket', 'Metals', 1779194),
(3, 'Major Banks', 'Energy', 7527323),
(4, 'Building operators', 'Metals', 2942597),
(5, 'Oil & Gas Production', 'Agricultural', 7032724),
(6, 'Aerospace', 'Agricultural', 4268245),
(9, 'Real Estate Investment Trusts', 'Agricultural', 3055439),
(10, 'Major Pharmaceuticals', 'Agricultural', 4004279),
(11, 'n/a', 'Agricultural', 1192862),
(12, 'Major Banks', 'Agricultural', 1847284),
(13, 'Natural Gas Distribution', 'Metals', 5076171),
(14, 'Natural Gas Distribution', 'Agricultural', 360726),
(15, 'Telecommunications Equipment', 'Metals', 9560611),
(16, 'Fluid Controls', 'Energy', 4015332),
(17, 'n/a', 'Agricultural', 5849366),
(18, 'n/a', 'Agricultural', 5326895),
(19, 'Major Pharmaceuticals', 'Metals', 8494094),
(20, 'Farming/Seeds/Milling', 'Agricultural', 4601766),
(21, 'Semiconductors', 'Agricultural', 6059008),
(22, 'Electronic Components', 'Energy', 3765790),
(23, 'Industrial Machinery/Components', 'Metals', 9527735),
(24, 'Services-Misc. Amusement & Recreation', 'Agricultural', 6987822),
(25, 'Commercial Banks', 'Agricultural', 735019),
(26, 'Marine Transportation', 'Agricultural', 2037950),
(27, 'Business Services', 'Agricultural', 3965177),
(28, 'n/a', 'Metals', 8631863),
(29, 'Metal Fabrications', 'Energy', 3920327),
(30, 'Oil & Gas Production', 'Energy', 1125947);

-- --------------------------------------------------------

--
-- Table structure for table `document_management`
--

CREATE TABLE `document_management` (
  `no_surat` varchar(10) NOT NULL,
  `jenis_surat` varchar(45) DEFAULT NULL,
  `pengirim_surat` varchar(45) DEFAULT NULL,
  `tujuan_surat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_management`
--

INSERT INTO `document_management` (`no_surat`, `jenis_surat`, `pengirim_surat`, `tujuan_surat`) VALUES
('101', 'Dokumen A', 'PT Andhika', 'PT Raya Jasa'),
('102', 'Dokumen A', 'PT Jaya Karya', 'PT Putra Karya'),
('202', 'Dokumen B', 'PT Jaya Karya', 'PT Sejarah Arya');

-- --------------------------------------------------------

--
-- Table structure for table `human`
--

CREATE TABLE `human` (
  `id_pegawai` varchar(15) NOT NULL,
  `nama_pegawai` varchar(45) DEFAULT NULL,
  `alamat_pegawai` varchar(45) DEFAULT NULL,
  `telp_pegawai` varchar(15) DEFAULT NULL,
  `divisi_pegawai` varchar(45) DEFAULT NULL,
  `jabatan_pegawai` varchar(45) DEFAULT NULL,
  `jam_kerja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `human`
--

INSERT INTO `human` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `telp_pegawai`, `divisi_pegawai`, `jabatan_pegawai`, `jam_kerja`) VALUES
('L200170003', 'Fajar Nur H', 'Sukoharjo', '08276545678', 'Documment', 'Kepala', 8),
('L200170013', 'Astrin Indah M', 'Sukoharjo', '08225678923', 'Inventory', 'Kepala', 8),
('L200170014', 'Arlin Widya R', 'Boyolali', '089675467823', 'Accounting', 'Kepala', 8),
('L200170023', 'Ilham Arthur', 'Ngawi', '08654345678', 'Marketing', 'Kepala', 8),
('L200170030', 'Dicky Febrian S', 'Klaten', '086543456721', 'Payroll', 'Kepala', 8),
('L200180013', 'Astrin Indah', 'Solo', '087765467821', 'purchasing', 'Kepala', 8),
('L200180014', 'Arlin Widya', 'Boyolali', '08654345673', 'Production', 'Kepala', 8),
('l200180023', 'Ilham Arthur', 'Ngawi', '08234567876', 'Sales', 'Kepala', 8),
('L200180030', 'Dicky Febrian', 'Klaten', '087654345672', 'Human', 'Kepala', 8);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `kode_bahan` varchar(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_bahan` varchar(45) DEFAULT NULL,
  `stok_masuk` int(11) DEFAULT NULL,
  `stok_keluar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`kode_bahan`, `tanggal`, `nama_bahan`, `stok_masuk`, `stok_keluar`) VALUES
('A01', '2020-04-15', 'Benang Sutra', 50, 25),
('A02', '2020-05-12', 'Benang Jahit', 70, 37),
('B01', '2020-04-20', 'Kain Woolpeach', 100, 80),
('B02', '2020-05-20', 'Kain Spandex', 150, 100),
('B03', '2020-06-16', 'Benang Bordir', 60, 55),
('B04', '2020-06-18', 'Benang Wol', 20, 5),
('G01', '2020-04-09', 'Gunting Kain', 50, 42),
('G02', '2020-04-09', 'Gunting Benang', 50, 25),
('J01', '2020-04-13', 'Jarum Jahit', 50, 37),
('J02', '2020-05-11', 'Jarum Renda', 50, 25);

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE `marketing` (
  `kode_marketing` varchar(10) NOT NULL,
  `nama_marketing` varchar(45) DEFAULT NULL,
  `target_marketing` varchar(45) DEFAULT NULL,
  `biaya_marketing` varchar(45) DEFAULT NULL,
  `production_kode_produksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marketing`
--

INSERT INTO `marketing` (`kode_marketing`, `nama_marketing`, `target_marketing`, `biaya_marketing`, `production_kode_produksi`) VALUES
('Market 212', 'Daily Wear', 'Mahasiswa', '55000000', 'Produksi01'),
('Market111', 'Sweater', 'Mahasiswa', '200000000', 'Produksi02'),
('Market313', 'Kemeja', 'Pekerja Kantor', '45000000', 'Produksi03');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `kode_payroll` varchar(10) NOT NULL,
  `bulan` varchar(45) DEFAULT NULL,
  `tahun` varchar(45) DEFAULT NULL,
  `gaji_perjam` bigint(10) DEFAULT NULL,
  `gaji_perbulan` bigint(10) DEFAULT NULL,
  `human_id_pegawai` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`kode_payroll`, `bulan`, `tahun`, `gaji_perjam`, `gaji_perbulan`, `human_id_pegawai`) VALUES
('Pay013', 'Mei', '2020', 30000, NULL, 'L200180013'),
('Pay014', 'Mei', '2020', 25000, NULL, 'L200180014'),
('Pay03', 'Mei', '2020', 25000, 4160000, 'L200170003'),
('Pay13', 'Mei', '2020', 25000, 5200000, 'L200170013'),
('Pay14', 'Mei', '2020', 30000, NULL, 'L200170014'),
('Pay30', 'Mei', '2020', 20000, NULL, 'L200170030');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `kode_produksi` varchar(10) NOT NULL,
  `tanggal_produksi` date DEFAULT NULL,
  `nama_produk` varchar(45) DEFAULT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `biaya_produksi` bigint(10) DEFAULT NULL,
  `gambar_produksi` varchar(45) DEFAULT NULL,
  `inventory_kode_bahan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`kode_produksi`, `tanggal_produksi`, `nama_produk`, `jumlah_produksi`, `biaya_produksi`, `gambar_produksi`, `inventory_kode_bahan`) VALUES
('Produksi01', '2020-05-22', 'Rok Semi Span', 50, 500000, '1268248098b8d968b84f61fd64e11bbc.jpg', 'A01'),
('Produksi02', '2020-05-23', 'Sweater', 50, 450000, '3a961ce33642aeec8f1a2aa2b176bbb5.jpg', 'A02'),
('Produksi03', '2020-06-23', 'Kemeja', 150, 4000000, 'cf9d316c3a3e360836cf801e6814bf8d.jpg', 'B02');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(45) DEFAULT NULL,
  `alamat_vendor` varchar(45) DEFAULT NULL,
  `tanggal_beli` date DEFAULT NULL,
  `harga_satuan` varchar(10) DEFAULT NULL,
  `jumlah_bahan` varchar(10) DEFAULT NULL,
  `total_harga` bigint(10) DEFAULT NULL,
  `inventory_kode_bahan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id_vendor`, `nama_vendor`, `alamat_vendor`, `tanggal_beli`, `harga_satuan`, `jumlah_bahan`, `total_harga`, `inventory_kode_bahan`) VALUES
(333, 'PT Santosa', 'Yogyakarta', '2020-06-23', '20000', '70', NULL, 'G01'),
(1001, 'PT Kain Adi Jaya', 'Jakarta', '2020-04-06', '30000', '120', 3600000, 'B02'),
(1002, 'PT Alat Jahit', 'Solo', '2020-04-06', '10000', '80', 800000, 'G01');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `kode_penjualan` varchar(10) NOT NULL,
  `ppn` int(11) DEFAULT NULL,
  `harga_jual` bigint(10) DEFAULT NULL,
  `jumlah_produkterjual` int(11) DEFAULT NULL,
  `kode_distributor` varchar(10) DEFAULT NULL,
  `nama_distributor` varchar(45) DEFAULT NULL,
  `alamat_distributor` varchar(45) DEFAULT NULL,
  `marketing_kode_marketing` varchar(10) NOT NULL,
  `production_kode_produksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`kode_penjualan`, `ppn`, `harga_jual`, `jumlah_produkterjual`, `kode_distributor`, `nama_distributor`, `alamat_distributor`, `marketing_kode_marketing`, `production_kode_produksi`) VALUES
('Sales01', 1500000, 200000, 45, 'Dis01', 'PT Distributor Jaya', 'Solo', 'Market 212', 'Produksi01'),
('Sales02', 2500000, 200000, 30, 'Dis02', 'PT Distributor Karya', 'Jakarta', 'Market 212', 'Produksi02'),
('Sales03', 200000, 300000, 175, 'Dis03', 'PT Karya Distributor', 'Malang', 'Market313', 'Produksi03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id_accounting`),
  ADD KEY `fk_accounting_marketing1_idx` (`marketing_kode_marketing`),
  ADD KEY `fk_accounting_sales1_idx` (`sales_kode_penjualan`),
  ADD KEY `fk_accounting_production1_idx` (`production_kode_produksi`),
  ADD KEY `fk_accounting_purchasing1_idx` (`purchasing_id_vendor`),
  ADD KEY `fk_accounting_payroll1_idx` (`payroll_kode_payroll`);

--
-- Indexes for table `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`commodity_id`);

--
-- Indexes for table `document_management`
--
ALTER TABLE `document_management`
  ADD PRIMARY KEY (`no_surat`);

--
-- Indexes for table `human`
--
ALTER TABLE `human`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`kode_bahan`);

--
-- Indexes for table `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`kode_marketing`),
  ADD KEY `fk_marketing_production_idx` (`production_kode_produksi`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`kode_payroll`),
  ADD KEY `fk_payroll_human1_idx` (`human_id_pegawai`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`kode_produksi`),
  ADD KEY `fk_production_inventory1_idx` (`inventory_kode_bahan`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id_vendor`),
  ADD KEY `fk_purchasing_inventory1_idx` (`inventory_kode_bahan`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`kode_penjualan`),
  ADD KEY `fk_sales_marketing1_idx` (`marketing_kode_marketing`),
  ADD KEY `fk_sales_production1_idx` (`production_kode_produksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `commodity`
--
ALTER TABLE `commodity`
  MODIFY `commodity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2013;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounting`
--
ALTER TABLE `accounting`
  ADD CONSTRAINT `fk_accounting_marketing1` FOREIGN KEY (`marketing_kode_marketing`) REFERENCES `marketing` (`kode_marketing`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accounting_payroll1` FOREIGN KEY (`payroll_kode_payroll`) REFERENCES `payroll` (`kode_payroll`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accounting_production1` FOREIGN KEY (`production_kode_produksi`) REFERENCES `production` (`kode_produksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accounting_purchasing1` FOREIGN KEY (`purchasing_id_vendor`) REFERENCES `purchasing` (`id_vendor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accounting_sales1` FOREIGN KEY (`sales_kode_penjualan`) REFERENCES `sales` (`kode_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketing`
--
ALTER TABLE `marketing`
  ADD CONSTRAINT `fk_marketing_production` FOREIGN KEY (`production_kode_produksi`) REFERENCES `production` (`kode_produksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_human1` FOREIGN KEY (`human_id_pegawai`) REFERENCES `human` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `fk_production_inventory1` FOREIGN KEY (`inventory_kode_bahan`) REFERENCES `inventory` (`kode_bahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD CONSTRAINT `fk_purchasing_inventory1` FOREIGN KEY (`inventory_kode_bahan`) REFERENCES `inventory` (`kode_bahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_marketing1` FOREIGN KEY (`marketing_kode_marketing`) REFERENCES `marketing` (`kode_marketing`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sales_production1` FOREIGN KEY (`production_kode_produksi`) REFERENCES `production` (`kode_produksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
