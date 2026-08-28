-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2026 at 02:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gula_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan_jatah_gula`
--

CREATE TABLE `aturan_jatah_gula` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_gula` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aturan_jatah_gula`
--

INSERT INTO `aturan_jatah_gula` (`id`, `status`, `jumlah_gula`, `created_at`, `updated_at`) VALUES
(1, 'HONORER', 5, '2026-08-18 21:36:42', '2026-08-18 23:15:40'),
(2, 'KAMPANYE', 0, '2026-08-18 21:36:42', '2026-08-18 21:36:42'),
(3, 'KARPEL', 5, '2026-08-18 21:36:42', '2026-08-18 23:16:36'),
(4, 'KARPIM', 10, '2026-08-18 21:36:42', '2026-08-18 23:16:25'),
(5, 'OS DMG', 0, '2026-08-18 21:36:42', '2026-08-18 21:36:42'),
(6, 'OS LMG-DMG', 0, '2026-08-18 21:36:42', '2026-08-18 21:36:42'),
(7, 'PKWT', 0, '2026-08-18 21:36:42', '2026-08-18 21:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jatah_gula`
--

CREATE TABLE `jatah_gula` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_gula` int UNSIGNED NOT NULL DEFAULT '0',
  `aktif` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jatah_gula`
--

INSERT INTO `jatah_gula` (`id`, `status`, `jumlah_gula`, `aktif`, `created_at`, `updated_at`) VALUES
(2, 'KAMPANYE', 5, 1, '2026-08-18 20:23:34', '2026-08-18 20:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int UNSIGNED NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bagian` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'KARPIM, KARPEL, PKWT, dll',
  `kategori` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tetap / KAMP-PKWT / OS',
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengambilan` enum('belum','sudah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `tanggal_pengambilan` timestamp NULL DEFAULT NULL,
  `discan_oleh` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `password`, `nama`, `jabatan`, `bagian`, `status`, `kategori`, `keterangan`, `status_pengambilan`, `tanggal_pengambilan`, `discan_oleh`, `created_at`, `updated_at`) VALUES
(1, '11000297', '$2y$12$re475t3gmN5Bk87dix3x4OWgE6QGBnWBXncSmAUmpVUBcAz9r/Ora', 'SUBHAAN SUFMILANSYAH, ST', 'ASISTEN MANAJER ST. LISTRIK & INSTRUMENT', 'Listrik dan Instrument PG Gending', 'KARPIM', 'Tetap', NULL, 'sudah', '2026-08-07 21:18:22', 2, '2026-08-07 03:30:44', '2026-08-26 18:23:01'),
(2, '11001269', '$2y$12$yFZ2z72U8knJncntlgOYWOYt.lsMFGBdubM9xupHtBWnTKbn427.K', 'DIDIK SETIAWAN, ST', 'ASISTEN MANAJER ST. GILINGAN', 'Gilingan PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:13'),
(3, '11002515', '$2y$12$LZGxD7ApSyU.cc2nLqJjY.1SDqHRLn9O2.K03EyysFQ5.Rdp5anHq', 'BAMBANG PURNOMO, SE', 'MANAJER KEUANGAN & UMUM PG GENDING', 'Adm & Umum AKU PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:13'),
(4, '11005258', '$2y$12$kCXl1MFJqUzEymAnI8Qz2uGZdX.pk5AXsjMPWNcxdK7fSKNTgiMn2', 'NURMAN FITRIANTO ROSYADI,SP', 'MANAJER TANAMAN', 'Adm & Umum Tanaman PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:13'),
(5, '11005746', '$2y$12$B5xLCI.G2/EnSC4TLhwtVeOkH6Y47lDDxueVlwbCjs3f4DquacRgi', 'SIGIT WAHYUDI', 'ASISTEN MANAJER ST. PENGUAPAN & LIMBAH', 'Penguapan PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:14'),
(6, '11008318', '$2y$12$iHwwHyBpczfpG/6ac/WdpeD86ztkMWk/xYUWEl.qHh4Sgist2eS9K', 'AGUS SETYA WAHYUDI, ST', 'MANAJER INSTALASI PGGENDING', 'Adm & Umum Pabrik PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:14'),
(7, '11008641', '$2y$12$dgk9p7PDOEHE87gOJRJLvuHnfjWiMw56FIR/Bs9Jm7vIwhwKxjjGm', 'TOTOK SETIAWANTO', 'ASISTEN MANAJER ST. PEMURNIAN', 'Pemurnian PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:14'),
(8, '11009135', '$2y$12$770eSH9v9gznsJjaiJsBCeVBUBI3H2z5ZuRoihDQsal8Ojgmb4nkO', 'ABDULLAH KAMIL, SP', 'ASISTEN MANAJER TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:14'),
(9, '11009151', '$2y$12$fSZCo4s7nCTelox/WlasEeBAnlg1Lv.Npis1hxStmFy7D/Kvnpmh2', 'HASAN AJRON, ST', 'MANAJER PENGOLAHAN & QA', 'Adm & Umum Pabrik PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:15'),
(10, '11009809', '$2y$12$mrKT6nX44mF8//yuAjB/ge3FZ5IG4bgi3jykzrsytCs96KpHRXjve', 'SUGENG HARIADI', 'ASISTEN MANAJER ST. BOILER', 'Ketel PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:15'),
(11, '18003527', '$2y$12$bhB75wiDtsUfq6OP1aLuieU1KlG0Ek0haRhr0AgB77URelNfhr8xS', 'WAKHYU PRIYADI SISWOSUMARTO', 'GENERAL MANAGER PG GENDING', 'Adm & Umum AKU PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:15'),
(12, '18004945', '$2y$12$eSMlxGxADQw65TJmRlvJjO7GnmSf1sxE65OC5IXCatsYadVvfYXRS', 'HILMY NAUFAL HUMAM', 'ASISTEN MANAJER QA', 'Adm & Umum QC PG Gending', 'KARPIM', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:15'),
(13, '11004604', '$2y$12$wWdnDntz6YmyNGZlSzKmy.g0EZrSY5mHufkcacBx9sbQ.ZHgEOxl.', 'MUHTANTO DIANTOTO', 'C', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:16'),
(14, '11004605', '$2y$12$Pu4ou5U10aV16Zz8fx24X.YwIXe3SmaHK2ee2OKlCTOUejcE7HrF.', 'ABU BASHORI', 'SUPERVISOR ADMIN HASIL', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:16'),
(15, '11004606', '$2y$12$U7vxKh8H1OHdSMh4a/hYI.RWrpCQ6hTkd4vQMMUCcMrdCJlWsBqKK', 'APUNG SOFYAN HADI', 'PETUGAS ANALISANIRA ARI', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:16'),
(16, '11004607', '$2y$12$UkFYNAWVV4M/CLQ9QlJZU.uadErtt/qX9wTXAYiWGJUPFy6UNguNm', 'DHOFIR', NULL, 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', 'PENSIUN 01/07/2026', 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:16'),
(17, '11004615', '$2y$12$Tas9HkRAq9mXVS1QMQWD6.7kyVMwGp/SzLMk3BhPHYwAMtYSFDR1e', 'KHOSIN YANI', 'DANTON', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:16'),
(18, '11004616', '$2y$12$tsNwwXXeZxLURD8912ppB.rcQZP7fUBipSvEPeIPJTztlIEUw44om', 'SAMSUL ARIFIN', 'SATPAM', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:17'),
(19, '11004618', '$2y$12$8oiqFcaiwXNkniYS/bJpjeZFUUVIk3O0qP/oc3./AVfOmIaR0BoOm', 'SAHERI', 'SATPAM', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:17'),
(20, '11004628', '$2y$12$QWeMFN/HeP8jqaMoc37KG.w068j3zsfExZgeWbFgK7Du3ndhw909.', 'ASTIMAN', 'MANDOR WILAYAH KEBUN', 'Tebu Rakyat PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:17'),
(21, '11004631', '$2y$12$HV3bp7J2vUKJ4hl69gwWZu.8SVru7cDvy7oL9vMjnkYBmBqKXbgaK', 'ARIF AFFANDI', 'ADMIN KEBUN', 'Tebu Rakyat PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:17'),
(22, '11004642', '$2y$12$UpuaizGbIe5dOH179b9pyOrZKlFBs9wKhePRwhISfqKqv.1qtF9F6', 'SUHERNO', 'MEKANIK LOKO (ST. GILINGAN/ ST. BESALI)', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:18'),
(23, '11004662', '$2y$12$mlz/D5NpO1IcaFMWsXvGrOvrSmDKGD/j/5UHJ1CoDghOxMWK0RQ5u', 'DIAN EKO KRISTIAN', 'MEKANIK ST. BESAII MESIN BUBUT', 'Besali PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:18'),
(24, '11004665', '$2y$12$MJER8t4VzsSJVTH96ZPh5u3mKty4uCGtL/5TRmu97qqIssf/inB/C', 'SLAMET ABDULLAH', 'MANDOR SHIFT MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:18'),
(25, '11004666', '$2y$12$Cy5E8FTBQcVuQPg406HnKOACZ.y67oxoNbjVDpqaKg2LD5ohsctrK', 'SUGIHARTONO', 'MANDOR SHIFT ST. GLLINGAN', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:18'),
(26, '11004667', '$2y$12$znU3AjUQynsAUB/ymmmxOOxJq5uyKTXQhKd8e25pQK.hVXcixMEW.', 'MOCH RUSLI', 'MANDOR SHIFT ST. LISTRIK & INSTRUMEN', 'Listrik dan Instrument PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:19'),
(27, '11004669', '$2y$12$5QaH65HfRBrmiscYTPUQ2OPg2UR/DcmZSXoM1tJN53lNgToOgXFtG', 'SU\'EB EFFENDI', 'MANDOR SHIFT MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:19'),
(28, '11004679', '$2y$12$mDrPXiCbpKlRoHUzhNPQoOO/OWSqE/c2XhHcTMv.iTxPjfUbtwLUC', 'ASHARI', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:19'),
(29, '11004680', '$2y$12$VsabMi8Y1zIam87BM/LpbeQhqP3JwzclLZioVeI7eui6LVKfV4fzm', 'WAHYUDI', 'OP. ST. GIL CONTR. ROOM GIL & CC I&II', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:19'),
(30, '11004681', '$2y$12$iqzajVHq2AAFRHuFeX7xVu5FeFXjjaFjYQ5oQISqJftfmNLeNPRAi', 'MOCHAMMAD ARIFIN', 'OPERATOR ST. GILINGAN MEJA TEBU', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:20'),
(31, '11004682', '$2y$12$K2SwBamrIv222zWoT.oWmu/GZMsD9XM/qugrnzK.oYNils0ayxrtq', 'ARIEF DEDY MAULANA', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:20'),
(32, '11004684', '$2y$12$w.RwnCweNPXA.AlgcdJjFO4qj5YxNl2TSIHm/gMq1DO6e/fB5Qjia', 'DJUHAERI', 'MANDOR SHIFT ST. BOILER', 'Ketel PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:20'),
(33, '11004685', '$2y$12$8SiXdJ.VMnmAGAoT47EDoevDunMLyJ409BS6kwqjJ80SaL76pcsXe', 'AHMAD HARIYADI', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:20'),
(34, '11004686', '$2y$12$m228luAY3j.JMmQ9ajhGtudcrjbmday4tr/VpvuK.w.CvAz4z0PXe', 'SUGENG HARTONO', 'MEKANIK ST. BESAII MESIN BUBUT', 'Besali PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:21'),
(35, '11004691', '$2y$12$jhS2hC/jXJmU83R16cBzFO8T2I6RDdAbMTLWYZ3ANDKwVOnjxBGrK', 'SALIM', 'OP. ST. GIL CONTROL ROOM DIFFUSER', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:21'),
(36, '11004700', '$2y$12$NBKHuhQmn7Uq4r4.6MpVjeM7wHYyiy/TD7A.SLYDBxx46APrWDnIm', 'SLAMET', 'ADMIN KANTOR PENGOLAHAN (ST. PEMURNIAN)', 'Pemurnian PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:21'),
(37, '11004705', '$2y$12$CCNogAVccb388ehYeE.lVeY3LsVu9wPrQm16h0/vbrXko5350kYuu', 'ADNADI', 'SOPIR', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:21'),
(38, '11004780', '$2y$12$SUQG9sXosPHA0mLYVrWtTeo1hy5pvn8cMJB7i6hGbGioE.U1HVh8i', 'ARSIATI', 'ADMIN AKUNTANSI', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:21'),
(39, '11004962', '$2y$12$QIMNVHPqSVUq9Z0zrThz9ugze/F.L3UCJmZytsljdLn/uJod3jxA2', 'MOCHAMAD NUR SYAMSU', 'SUPERVISOR SDM', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:22'),
(40, '11004963', '$2y$12$Dn18iPN5xbPVT/z/zFyW5OstEADvml/cHTfmJn9yiXRMnx6rfO9Au', 'MARIA ULFA', 'KASIR', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:22'),
(41, '11004964', '$2y$12$ZBBA9BlMK1OptgLbeQFaP.OSTikH5Hg4JjmvbBRu06Nt0dcisDjmG', 'ZAINUDDIN', 'ADMIN PAJAK', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:22'),
(42, '11004965', '$2y$12$i2F6/QXqCFvudFKfkCQJS.l4kCSFk2g1Ov2SFC7Sr25QhlYw0DIs6', 'FERDY DJATMIKO', 'ADMIN GUDANG MATERIAL', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:22'),
(43, '11004968', '$2y$12$0KSpHNrD73PqSzer0IDYleGWK2AKGIyUgzj1FZGj/MEFzwF6ilZTu', 'HARIADI', 'SUPERVISOR GUDANG MATERIAL', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:23'),
(44, '11004970', '$2y$12$2n5mls.iZNSBuR6EBDZuzOU48pyLp3iVHGoEMqfj/Na9isJPNXg1.', 'MUSTAMIN', 'PETUGAS GUDANG GULA', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:23'),
(45, '11004971', '$2y$12$bP/z6TZt5HLAETCTJS9zY.B8FAZkRBUS5T6gzVY3nPRznqDUmUl3O', 'BAMBANG WINANTO', 'OP. ST. GIL TURBINE CC-I&II/UNIGR/HDHS', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:23'),
(46, '11004973', '$2y$12$bO3DCaq61K4cPBVMUR/fhOfppguUMaLI3U.na3aPPhyEjtF4OEMgK', 'ABDURROHIM', 'MANDOR WILAYAH KEBUN', 'Tebu Rakyat PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:23'),
(47, '11004982', '$2y$12$o6.OYzxiVTmPAXBS.NHTKeyZGaIkGcy.48QAmyhpHZDFyvMF9SJV2', 'MUHAMMAD', 'MANDOR WILAYAH KEBUN', 'Tebu Rakyat PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:24'),
(48, '11004984', '$2y$12$hNjSefE9gv/9zxVq8r/yS.ba273XXNYGJ.ESyber02n37wHbqp4Me', 'SUDIRMAN', 'MEKANIK PELAYANAN TEKNIK', 'Listrik dan Instrument PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:24'),
(49, '11004985', '$2y$12$y3INjKJaKIeMT6YWP3yUW.haT4id2kAV8ujz8Q5UvmwOUB6OMyf4m', 'SOLIHIN', 'MEKANIK PELAYANAN TEKNIK', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:24'),
(50, '11004987', '$2y$12$79fOq0KampwBtRDVjiJyJuXSsMVyv1RogHWd7ZAxlkNviofMtoDK2', 'SHOLEHUDIN', 'SOPIR', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:24'),
(51, '11004991', '$2y$12$5acgMe.4XajUYDJ3MgQ6ZelHU7z2RkqxmC.WYk8zYnqQQQMrrSviS', 'ALI CHASIM', 'OP.BOILER TEK. 45 KG/CM2-PIN HOLE GRADE', 'Ketel PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:25'),
(52, '11004993', '$2y$12$caqBDuRKW7EP.ptIqQ3fl.cQfJAhSQNOW.qFUOYrowhxzxK17Zaf6', 'FERI NANANG GIANTORO', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:25'),
(53, '11004994', '$2y$12$paej1cxtE/sqSW4KD781KOL.bQtE1Q3QEmh9dxHcbXn/ie8PQtgiW', 'SUPRIADI', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:25'),
(54, '11004998', '$2y$12$/vnRoF/9ys4KrhHCz1c.LOhvvJhQG503RWTDzMQ6A3tM6Mcj17yKe', 'DEDHY TRISTANTO', 'OP. ST. GIL CONTROL ROOM DIFFUSER', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:25'),
(55, '11004999', '$2y$12$YcVmamCIMv78FmdpgLIsVO74EwXGT7CBWIKfSNtfOs/L3BfQ99Qk6', 'IPUNG PURWADI', 'OP. ST. GIL TURBINE CC-I&II/UNIGR/HDHS', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:26'),
(56, '11005002', '$2y$12$hemBJocuMcskBSoEcL01.uTqaP1vaIRAL9FbtmRZhEgKNwpqAcwxi', 'MUHAMMAD JUNAIDI', 'OPERATOR ST. GILINGAN MEJA TEBU', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:26'),
(57, '11005004', '$2y$12$1hZPD.p4MIJ30aH3J2AK5uKCvSOxWEhDUciQswN5YJQLqP7T0oCiC', 'SAMIN HADI', 'OP. ST. GIL CONTROL ROOM DIFFUSER', 'Gilingan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:26'),
(58, '11005009', '$2y$12$YXQIx2gbAKXWYERmLQYlhe/6FMTaQkMtu5CzWgWsdcNFUm5cFO30q', 'GATOT HERMANTO', 'MANDORTMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:26'),
(59, '11005013', '$2y$12$AmKlMha5WWHUHNeUYxQh8uDoJvBvldjacNUBrPZ14HMSvbvbelwEK', 'AHMAD WAHYUDI', 'SATPAM', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:27'),
(60, '11005015', '$2y$12$9s15lF9oG2LBtbApENu8QemVFLaNbrKa.4mwJHg/2JZkms2HbdOZq', 'NUZULUL LAILI', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:27'),
(61, '11005016', '$2y$12$MkVUKnsqvSGVF41gz4vM.Oj/lKamMfZBJOIgwp.Bq3aD2VvddDsk6', 'JUNAEDI', 'MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:27'),
(62, '11005018', '$2y$12$WJFxVQA3wWQ4N2RRzabGhOSUf/w7GCEMRAg1RiwP08TrVcFXK7ON6', 'PRIMA DWI KURNIAWAN', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:27'),
(63, '11005020', '$2y$12$.N55g96zgmTXepTt6NLGLOLPfoe3pIzsxDUcIYn4KKQytMgvo.Rs2', 'HENRY YUNIARDI', NULL, 'Puteran PG Gending', 'KARPEL', 'Tetap', 'PENSIUN 01/07/2026', 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:28'),
(64, '11005021', '$2y$12$5poxL950fymfkfJl5zipY.Q7iNz4tT/pw6ueWcqOB0zbb1MqBLtQS', 'SAYFUL HADI', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:28'),
(65, '11005022', '$2y$12$4nnQVxywd2SrpN4r6yf5Du3OicUb4zr9Ib7T2RaXDOaPUgLSDDyg6', 'ROMLAN', 'MEKANIK PELAYANAN TEKNIK', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:28'),
(66, '11005028', '$2y$12$jsshgeaHyCFv4jjRW6ldJur4DknfdFfjICInqc1fR07YBwtXnz5Ja', 'SUPARMAN', 'PETUGAS MONITORING BUDIDAYA', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:28'),
(67, '11005030', '$2y$12$pzTDdmdbdHJvMft7OZ1KaOx4L12FHY1EPj.BCQh9id/izNaKUUwa.', 'EDI KUSWANTO', 'MEKANIK PELAYANAN TEKNIK', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:28'),
(68, '11005031', '$2y$12$kFrVAiTQ4guRyFeC7rlrYOT1.CL3yHOMsKA/3HpUcuI4C5MXZrs/G', 'SLAMET KANDI IRAWAN', 'MEKANIK PELAYANAN TEKNIK', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:29'),
(69, '11005032', '$2y$12$hEp8kDv9hJVEtFcAiT4jpeOf/gHa3hT8hB1e7L7j7KLEQd6w.f9Ra', 'EDI SUBANDRIO', 'MEKANIK PELAYANAN TEKNIK', 'Dok Loko PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:29'),
(70, '11005037', '$2y$12$0HWMb.dqdOODIIi24GpKIOtXNGtHSC8YtzUF/pIrJLBMo4qbj2u5K', 'YULI PURNOMO', 'OP. ST. LISTRIK ELMO/PANEL/TRANSFORMATOR', 'Listrik dan Instrument PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:29'),
(71, '11005038', '$2y$12$zQaz1bbnWqENILzeZhs5ceHKtqxk7Vh3a5Sw.eQu4pBrRsjgeKkIG', 'MOH. YUSUF', 'MANDOR SHIFT ST. LISTRIK & INSTRUMEN', 'Listrik dan Instrument PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:30'),
(72, '11005040', '$2y$12$6YtB/qYR7O0tvpTMj62f1e/qJbccptUX4wAGJ3mug8zhDiGBdQVRS', 'EDDY HARIYONO', 'MANDOR LOKO & DOK (ST.GI/ ST.BESALI)', 'Besali PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:30'),
(73, '11005042', '$2y$12$D.5oIUls4MvTcr/63qAJOeeEE2b8Gl0uHtQYBzqFes44Itm2UJyW.', 'ILHAM OLII', 'ADMIN KANTOR LNSTALASI', 'Adm & Umum Pabrik PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:30'),
(74, '11005045', '$2y$12$A9ueJvObFPgjrGOK6HsXL.mrJ/rcvihuCmoT3ffItHkJQU../1Bkm', 'HASAN HEJI', 'ADMIN ON FARM', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:30'),
(75, '11005047', '$2y$12$dhbqgzYV/t7WxDV/fPY3B.ZY1oJbJXaOR85sl7bHF7ueEshMiyLjm', 'SUPRIANTO', 'PTGS. LAB HAMA, PU2K&TANAH,KULTUR JAR', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:30'),
(76, '11005048', '$2y$12$lMZqEW/f/q.JcVa0kejDzOiNrZGzJ8x8qUkQLPqPno4dP2AvYgWDC', 'HAIRUDIN', 'SUPERVISOR UMUM', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:31'),
(77, '11005050', '$2y$12$wY9sh/tHNXKDQEaCW9Ve8eCYjyNw10Ooqj9BYziXB2bx9cuorMNMy', 'SUKIRMAN', 'SOPIR', 'Adm & Umum AKU PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:31'),
(78, '11005052', '$2y$12$zXMw/ynyZsZ.itEJdk/S4OG0ZsrehmVQOoAFnZ1OWoQdXi2Qp2Nrq', 'INDAH RAHMAWATI', 'ADMIN KEBUN', 'Tebu Rakyat PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:31'),
(79, '11005053', '$2y$12$sUWzVUhSoEGo1hZLLAWTZ.v2Al/UdloI2Y2uZyA7aKhOfeyZvMy4.', 'ABDULLAH HASIN', 'ADMIN SAP MODUL QA', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:31'),
(80, '11005054', '$2y$12$yRLgpWbePLb1aPR.RtoqJO8NcQVoJcyb8tXuVmP33eWse.OGnlQka', 'JUMADI', 'PETUGAS MONITORING BUDIDAYA', 'Adm & Umum QC PG Gending', 'KARPEL', 'Tetap', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:32'),
(81, '11004722', '$2y$12$.bGxVuSm0IMH6AFE81WQ5OJ7.17ZtV97rx0SWbBcctukqOoawt/im', 'FAISOL HAK', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'KAMPANYE', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:32'),
(82, '11004729', '$2y$12$Or6g.sJt05.4j6Ypc/d0n.h0eCECt.FL2aKiT/ibBbj2cByjtUorm', 'KUSNANDAR', 'MANDOR SHIFT OPERATOR ST. PUTARAN', 'Puteran PG Gending', 'KAMPANYE', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:32'),
(83, '11004745', '$2y$12$wACLpcRvFUHeiDnPX1uMau7lp1E2joaU7ecQyuzLrs83zCtDsp/Yy', 'HUSIN', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'KAMPANYE', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:32'),
(84, '11004749', '$2y$12$hb33Elij2P6GK12pNQhz4ujdRPP000VhDZIlKbh6SDH7cwwYyXErG', 'JUNAIDI ARSAM', 'MANDOR SHIFT OPERATOR ST. PEMURNIAN', 'Pemurnian PG Gending', 'KAMPANYE', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:33'),
(85, '11004746', '$2y$12$Tx9ohhhj.YeqDxkotPVXXuaaUfcGOtFIOlFxNMtb29tEXtJ4FGqiu', 'AHMAD SAYEDI', 'OPERATOR ST. MASAKAN C', 'Masakan PG Gending', 'KAMPANYE', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:33'),
(86, '11004748', '$2y$12$WzVRkAYftmS49ADK72EOTu6KFrtSfZwvI8CufNzSnRya/OMSVsvdS', 'YOPI PURNA IRAWAN', 'ADMIN KANTOR PENGOLAHAN (ST. PEMURNIAN)', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:33'),
(87, '11004779', '$2y$12$ICC0t1t5KUQQuEGIVW9Aa.OtqJyxJ2kuFNzb4LofmD7eK3DT6OUym', 'ISMA HERJAYATI', 'ADMIN HASIL & DO', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:33'),
(88, '11004781', '$2y$12$0Klvb0P9fzIqSJLOOkS5a.DtlXwkX4pCD.e4uajwcfsUTdjbrEp4S', 'YULIADI', 'PTGS. PEMELIHARAAN FASILITAS UMUM&MESS', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:34'),
(89, '11004782', '$2y$12$Tz96JJAQXiE87YgfD8NNIeCznfLa8ma2U0v8Aw3wog1piX/eDWbjS', 'ACH.SAMBAS', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:34'),
(90, '11004783', '$2y$12$PcpSwmdQXdNUvAx/ZK1DIezMLT9/Q2cvyMsBY0H7/6swLgtlYHOM.', 'SIGIT PUTRO WICAKSONO', 'PETUGAS GUDANG MATERIAL', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:34'),
(91, '11004786', '$2y$12$jv5ZfKvRd88JKXFGGnwl2ectS0f1odSs/iMfHJXlkISRAvxaeB5Nq', 'AL FADLU', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:35'),
(92, '11004787', '$2y$12$mvPxM87YL18csixYx4aS8.Pal6XJC9RWCOJ6eF1Mb/M2bkALZke5e', 'JULIANTO', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:35'),
(93, '11004788', '$2y$12$x3Vqe3YGwFBY3y5IuqthE.YiIh.qv3V.qla0CDzMy4Sd1LFBNdafW', 'KAMSU', 'PETUGAS GUDANG GULA', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:35'),
(94, '11004789', '$2y$12$qaFMEAPNdOIY31pPXitSHerIfp4.E94Chw8tfdsEQurx.PyX7nUdK', 'MISDIYANTO', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:36'),
(95, '11004790', '$2y$12$Em3/X4KoLm1SU9dFx.FqN.NdQ5H0naj9BgtVaZzXbmPRzPgSxIAIe', 'SANEWI', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:36'),
(96, '11004792', '$2y$12$ulJOEcvXfq00hyn6cp3RG.s9RmaGrZrIJZcuzaN/I6jbVOlSydj5K', 'MOH. NUR HAMID', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:36'),
(97, '11004793', '$2y$12$W.T9T0Kg6VNbamKThOUqf.PgAFSGPTkupLHaCWPkAUKhDrZ0Fy.ym', 'SUGIONO', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:36'),
(98, '11004795', '$2y$12$sKPrQmPgapvyq/imR/iRUed4Ef2Fj5i38RMOPVuoVL7WP4L14PZuq', 'MAT BASITANTO', 'JURU TIMBANG', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:37'),
(99, '11004797', '$2y$12$wuTSL1OCXbEgkQ/zgHBu4e.f0aFbxXiPjUgZ5.CvN6Wz0i1X20bgy', 'ANWAR', 'JURU TIMBANG', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:37'),
(100, '11004799', '$2y$12$r20VTgQ/42kJE7oWw5tR1eOoHofA5HMYryJ1RS0.8Q53.DVAhus02', 'ALIM MULYADI', 'JURU TIMBANG', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:37'),
(101, '11004805', '$2y$12$z8csbjlSapnMVkh6Z.vK/uFA4duldjmsA2tlV94lzQnj.7FDP1DmO', 'MOHAMMAD MAHFUD LATIF', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:37'),
(102, '11004811', '$2y$12$nXpeDsPvH2TdtYOyw.5RrObgvO7m1DAcid8EjEarG0km3Vs8PV6xW', 'SAHERI', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:37'),
(103, '11004814', '$2y$12$KPeiLo24libw1CQ/LX4xXef722jSDjDUw1ObPCsFD61FDfEK/pnr2', 'SYAMSUL ARIFIN', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:38'),
(104, '11004815', '$2y$12$WHVGLXzagQXPpAhXn4D1z.37sBfpQJn.clN8.ZKZ4S3J3MZ2cnpjm', 'MARZUKI', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:38'),
(105, '11004816', '$2y$12$oCm1PthuJW.XegZiAnzjvO4iTUoPkjvvkvD7fqdEibYiF/dwNm8M2', 'BURHANUDDIN', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:38'),
(106, '11004817', '$2y$12$95Qnl5GOMBv63RUyIT5HWu21HPx9EW17zxt9ArmVyCYFAYPx0c8zO', 'MOH HASAN', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:38'),
(107, '11004824', '$2y$12$0Z2AkhFWZVdcD5LoIQ5ghuBJWfqZLzmKNzOFIdxufLE9RbQ3ljmna', 'KUSNUL WAHYUDI', 'ADMIN GIS/MAPPER', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:39'),
(108, '11004825', '$2y$12$6n2iXbSF2k4BNZz0as5eEO0M5BM9rU1jPPmv1pqajcqlO/oGpWFAi', 'AGUS RIYANTO', 'OPERATOR ST.LIMBAH IPAL', 'Limbah PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:39'),
(109, '11004826', '$2y$12$Vs/9x8kdL.hWJVvs7Ljeg.qREjh/s/oJ8QMgmSv6g75BHGUG.xnSW', 'BAMBANG', 'PETUGAS CEK LORI/TRUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:39'),
(110, '11004828', '$2y$12$XMutDO6JXrlrshKAwF3MOOXRQzHItb.kI88r/i0Ia26krasnKoxIq', 'DAVID PRASETYO', 'PETUGAS ANALISA AIR KONDEN & APK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:40'),
(111, '11004829', '$2y$12$UYtCNbMFjV/pjpQdmeHNTu1L8m2ghiF1cgMReE8IZDEMyk3IPWary', 'IBRAHIM', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:40'),
(112, '11004831', '$2y$12$/zlgMiiSqXCjU1kzSJ4Ikey0vrqke8iWJdITgLVPS3fDg0zKZUonK', 'KUSSAIRI', 'PETUGAS ANALISABRIX PINTU MASUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:40'),
(113, '11004835', '$2y$12$eyaRckLubLMc5yZZJX1eq.VFEBu73IZcYkO5oQXbOMioSG4miF2Ra', 'YUNIARTO TRI NUGROHO', 'KOORDINATOROFF FARM/ARI/CORE SAMPLER', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:41'),
(114, '11004837', '$2y$12$5b1xmI/00IL04yZqeq/0gu86N4IaBYAkLxBJyG47y/2hUG.bpdWZa', 'ABDUL ROHIM', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:41'),
(115, '11004838', '$2y$12$6ABtXUagteEGDakRmTS6Pup/lDxTxvjFpfetL.IYk.eYttPTWIfnW', 'RACHMAD SUGIARTO', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:41'),
(116, '11004839', '$2y$12$X3vMabOXp/RFM/E/b1CIbOqS1sb/usR6UON8zB79iS.pGCEVvF2kS', 'RUDI ANTORO', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:41'),
(117, '11004840', '$2y$12$O7ZD0fSVk3Y8G/T17ylm9umKnm7snfZHWKRVX2R7WSEqV0wmbDIra', 'DJOKO SUSILO', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:41'),
(118, '11004841', '$2y$12$IwalEkStERHjaI2VePVytOc0XEnnNwG6lIjUUJf/EA6LIiTxwPvkC', 'YULIONO', 'OP. ST. GIL CRANE TRANSLOADING', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:42'),
(119, '11004842', '$2y$12$5PXvEEgxtBW9wbDMLT8S3eWKMXmLqojt5UuRY46zuCi8K3d7bV7Yy', 'YUDI HARMANSYAH', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:42'),
(120, '11004843', '$2y$12$bwlZF1ENyyeQX0d6KEYkq.L6bUHZH/V5HEhvFFyXhybrZZDowoMrm', 'MOH. MAHFUD', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:42'),
(121, '11004844', '$2y$12$5mhlA2c2zNnY5JF67of2M.gbI3.qkltNZJvlqQAck8j38WmLYPXaW', 'DENNI MARDI WIDODO', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:43'),
(122, '11004846', '$2y$12$bAwejNtJ88iNTPPsNIyRr.QfKxN8tZe24rYv.uhzRMEfi3BbvDDvK', 'RACHMAD HIDAYAT', 'MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:43'),
(123, '11004847', '$2y$12$YqcyBGuq8XlYqB/JmcCx3OTCXYvOAIXvspwmNRGEaoMSLsdEAC7cC', 'MOH. SALIM', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:43'),
(124, '11004849', '$2y$12$kRRHinAPof9jO8OcrlAmQuNcJNxhhsKKEpeZj5/XU1BpWbqntKPrC', 'HERU MUJIANTO', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:43'),
(125, '11004850', '$2y$12$.rV.Wc90MVfX.t8RAQ5QTeM8I5ZrsYUfZnkaXDIow/a5LDyHViiOW', 'DODY SETIYO LAKSONO', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:44'),
(126, '11004854', '$2y$12$vTamfv.6munDHoOvq.z6P.pggmxeUscmp6Lci.aAhPCpsLBFWBpKG', 'CUNG MUHYI', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:44'),
(127, '11004856', '$2y$12$.HvKdVTBtWmzYyyg4GxMXO8XKdvgV0zqoev5nvSdcJQywLdsUX6Ui', 'ANTON BENTAR WIDARSONO', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:44'),
(128, '11004857', '$2y$12$6yxh2/WXEk7fFiys4J8pSujH7UxztAoz0qrkHkzPu4qSjo8kBeL4a', 'HELMI IRAWAN', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:44'),
(129, '11004858', '$2y$12$7n4Id8qUbLvncU1KLbSpgeVw8Y18.GdbzoRZVovNw5ugxwAl8kR06', 'YUGO IRAWAN', 'ADMIN KANTOR LNSTALASI', 'Adm & Umum Pabrik PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:45'),
(130, '11004861', '$2y$12$usHuoDugkQ1C5o28M.6Z/.Rb0aJYZYjbzPL7JP5dQIm8os1bQgQTi', 'ABD.BASID', 'OP. ST. GIL CONTR. ROOM GIL & CC I&II', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:45'),
(131, '11004868', '$2y$12$DCqcdcivDYbHNivcBEGPY.pbGGoguIDIy5NaTAbBR7vfjz30QigsC', 'SAFIKIN HOLIS', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:45'),
(132, '11004869', '$2y$12$G88zNb8sm9tC/sgX0PhSg.3oTyQ1DgVtOMcH16MPjb9RJa0IigTmC', 'JURI', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:45'),
(133, '11004870', '$2y$12$i/7lYxTE5n7KAAEBjuuTDOWy7GgeGEP35pWN0cC0vLx6bwPj5nMN2', 'MARSUS', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:46'),
(134, '11004872', '$2y$12$GC5lce5Gx4177nmzceOf0.oMqb5XHzup6Y1mo2QPowkumqXppuJCi', 'SOLIHIN', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:46'),
(135, '11004874', '$2y$12$lZUL4dyEILdGRL9nzz0.WuFl009V2WgzslbVi8DRdzLjtKadDkPbO', 'SUPRIADI', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:46'),
(136, '11004875', '$2y$12$8QHUfc/7Ri4X.qMjmHjv/uNficfYJvtjkIzFTTQ/kAiIAKk5p1nNm', 'SURYADI', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:46'),
(137, '11004878', '$2y$12$aOGqvHLdZu5PGWze8Pf74OGH0XvH7GhBQkqQn.tX/OCRccUk3Ot4y', 'FENDIK SANTOSO', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:46'),
(138, '11004879', '$2y$12$9HYwGqYHHvzSUNTLSdZc7O3Ad3HiPnV4v0V2C4/3C4ni8pFB3lUcu', 'JEKSEN EFENDI', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:47'),
(139, '11004880', '$2y$12$vayA0/kMVH/wnDRfWjidRO91JaEVJJ7xGAHBeQHu33jGRACi2F2kC', 'NUR KHOLISH', 'OPERATOR ST. GILINGAN CRANE LIFTER', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:47'),
(140, '11004881', '$2y$12$IpbEHvmENrqMAMb1e4mn9.XOuwXJITyoUucYK17eHlMt8cUVrMP2C', 'SURYADI', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:47'),
(141, '11004884', '$2y$12$eEDyzk1vJyeI3FGedmuWG..5BpqKhrNX0dEK4wDWBom1yGpg8CXOK', 'SUPA\'AT', 'MANDOR SHIFT OPERATOR ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:47'),
(142, '11004885', '$2y$12$c2TdeKUBugy2dark5Ts2qeplcuOFMQyMrcoaOZkJipEE2TdAlbeyq', 'ABD.ROSYID', 'MANDOR SHIT PENGEPAKAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:48'),
(143, '11004887', '$2y$12$j7Kl5c1noxy29j6Y1J9J3.JLFmdosCjrKhpbAcXK6OA0tpdb89EtG', 'AGUS SALIM', 'OPERATOR ST. PUTARAN SUGAR DRYSEED', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:48'),
(144, '11004888', '$2y$12$pUQxHXd0cxWWvM0OnY0J8O5uk/rM8uEqknv665WYUrqChL2JCKZLi', 'AHMAD NIZAR', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:48'),
(145, '11004889', '$2y$12$qAs1OLREOTJ1A5WzwRi96.FZR8DL8edHAXD/yZntusw27t08GOrwi', 'ANGGA HERMANTO', 'MANDOR SHIFT OPERATOR ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:48'),
(146, '11004894', '$2y$12$Qm8mVcFCCSIWXJdPz3V7I.m9Nn67ZPp/rVAEfPAIhDt/iJpARjnma', 'DEDY WIJAYA', 'OPERATOR ST. MASAKAN D', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:49'),
(147, '11004895', '$2y$12$qE1tbnkZ90UIsFXKASg6UOYK6FTGizHYCrFkeaFAY5ax4OD5JLgBq', 'DIDIN MAHCRUFI', 'OPERATOR ST. PUTARAN PALUNG A', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:49'),
(148, '11004903', '$2y$12$/8AXpW01/HvqBRXNrdjaHueJGFBKrZSmZEiDxatlkwGEpgEP81WUy', 'MOH.ASYARI', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:49'),
(149, '11004904', '$2y$12$3bKJgryKI3eo3FymzzTOO.vAMpY4YTCnb3WEpz6VemumLPTia30xq', 'MUHAMMAD NASIB', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:49'),
(150, '11004906', '$2y$12$VIeX37gzRtceEwsKToXolOlCecPOWyDBgzWdZDTkmC24mwJXcyw4G', 'MISDI', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:50'),
(151, '11004907', '$2y$12$a2AJR0tD0UkvyTvecZfMxueKXat9vXnEUunN67FncD2JAQWMwbCla', 'MOCH.SANUSI', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:50'),
(152, '11004911', '$2y$12$nqJOKpePWZBU2SLR6YYO/.zz5d4OOh671Z9CnOW03hkJmOBt6aVEq', 'NUR HUDA', 'MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:50'),
(153, '11004916', '$2y$12$RtnopxG1RloNoNxXjUXMwOuVoExoTLykgaVxT4R0upPWWWs8WqFMG', 'SAMI\'AN', 'OPERATOR ST. PUTARAN SUGAR DRYSEED', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:51'),
(154, '11004917', '$2y$12$HQdTpsZ15UMzzyGy6bVx9O4Z9c45NfCQpnMssUugIsCweQL9ajnnK', 'SAMSU', 'MANDOR SHIFTOPERATOR PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:51'),
(155, '11004918', '$2y$12$ztN9a9IzVQCWiq/6ysgLcOXr1Q64dXEYdqiVYHk23rHyKG6O3PIyu', 'SAMSUL ARIFIN', 'OPERATOR ST. PUTARAN SUGAR DRYSEED', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:52'),
(156, '11004923', '$2y$12$guCEtgm4Y1xoSf7C6Y3wUOzmvyvKjTEbYBPZzq1Llbn/H/EnZuEna', 'SLAMET HOLIL Q', 'OPERATOR ST. PUTARAN PALUNG C & D', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:52'),
(157, '11004927', '$2y$12$ti9kO21bVFCRNkLGNOsjZeZkbG2sgdsFJNMp/DfIBbtY3.UDzsD56', 'SUNARTO', 'MANDOR SHIT PENGEPAKAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:53'),
(158, '11004936', '$2y$12$2fBvttNUIuU2M2CliYLzVOueQGP7G8aA6SNUveXXeGZasfruchMTq', 'ABDUL LATIP', 'MANDORTMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:54'),
(159, '11005078', '$2y$12$Q/hQD3PeR7JX8ToSQPgkzuWJJsaXsw.XeaMj5XheagVNHbri0/K16', 'NANANG KURNIAWAN', 'ADMIN SAP MODUL QA', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:54'),
(160, '11005080', '$2y$12$2.1p0oot4z6h8tS55vJpAuBrQXnOM8sl18fMvdPOmaR7/8uJfGGTa', 'TAUFIQ HIDAYAT', 'ADMIN KEBUN', 'Tebu Rakyat PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:55'),
(161, '11005082', '$2y$12$g.u98wuV8Ucjab7hadwKlehhysUbs.UNq8r9tOzlgMqmD79wg0.va', 'BAGUS CHANDRA YUDHISTIRA', 'ADMIN GUDANG MATERIAL', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:55'),
(162, '11005087', '$2y$12$pUwoU2OiNYkxxs18sZtEZuuGklfB25pRDnXXihiqYtScKXRDocUhy', 'ARIF WIDODO', 'ADMIN KEBUN', 'Tebu Rakyat PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:56'),
(163, '11005094', '$2y$12$VQXiqMfoX3Nkl1Ic3.AcFuAEt4ULfU6jAFMPbllAz1pgDeb17hD1O', 'HASIM', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:57'),
(164, '11005214', '$2y$12$dOLcMRYx219QlvUyV096Jet2a8o25cAvejQEjt.v6z6TGZJPa9U1u', 'LUTFITRA BUDIANTO', 'ADMIN ON FARM', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:57'),
(165, '11010420', '$2y$12$bivjSvlc9gyA1FDjBH0Pb.nvULIm2RLExOP/naex.S6MfIYpYDU/K', 'MANSUR', 'MANDOR WILAYAH KEBUN', 'Tebu Rakyat PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:57'),
(166, '11010438', '$2y$12$Q247ZQO310GanNs6CYZPIeIbRt2zz8DRc10kOHYqplgotzPacyKsC', 'FANDI AHMAD', 'OPERATOR ST. GILINGAN TALANG NIRA', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:58'),
(167, '11010439', '$2y$12$0o2z3o09Cqskk6OLz/k.7egLVu0vlwT8xx0pJfBokahIY/10cG0uO', 'AGUS TRIAWAN', 'MEKANIK ST. BESAII MESIN BUBUT', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:58'),
(168, '11010440', '$2y$12$akoJ5VG10dYVjW6caKYvxOaMEEVNkz3dAIIIM7EhQzMIUDhNnqlsy', 'NOVAN ANGREYANTO', 'MEKANIK ST. BESAII MESIN BUBUT', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:58'),
(169, '11010441', '$2y$12$UJAy4wHghMMCSZwQvoFquOX9EdKHfu85jPiEqMPV5nGBh9h3Uy6KK', 'SUGIK WIDARTO', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:58'),
(170, '11010485', '$2y$12$UbRXbL9Ovb/n9iYgzzfQj.H1gSv60prYvFhj71JRZSq.0ujweTbzS', 'AHSAN AL ANSORI', 'JURU TIMBANG', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:59'),
(171, '11010486', '$2y$12$/Kp.sJWwnQehEJMDsPoT0uNyCDmpGffES6rLZ7qnr4MBb1vcNhcRa', 'ELFIER AGUS FAUZI ANGGARIAWAN', 'KOORDINATOROFF FARM/ARI/CORE SAMPLER', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:59'),
(172, '11010488', '$2y$12$zFH4PzSHMZjJaX9j1s4CR.N2lPx6DbSGXDbM0VAHPkMbzF99JcJ0e', 'JAVA FEBRIANTO', 'ADMIN PENGADAAN', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:59'),
(173, '11010492', '$2y$12$U4l2efqDfZv.RzzCQgtepuT7M0RkB0mV8B1v1iX5MEyOhLpo3a0Rq', 'MUHAMMAD', 'PETUGAS ANALISABRIX PINTU MASUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:59'),
(174, '11010494', '$2y$12$ABpBPmrOxFFYZ.N3xGaOT.sACT7Ff79II7TpjAskWxscccEYK2pHS', 'MOH SAIFULLAH', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:00'),
(175, '11010495', '$2y$12$ll2gv9KS3A.PGd.LptRcRONCEmQcm2emnME3NhvkyMYrjMe3m1j4e', 'IMAM GHOZALI', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:00'),
(176, '11010496', '$2y$12$ekVk8PDBfoR5ekm15pPGEuAYJ6Z2T04QO05MUFxQMvUG3SF4Le6zy', 'AGUNG PRASTYO WIBOWO', 'PETUGAS PENILAIAN MUTU TEBU', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:00'),
(177, '11010497', '$2y$12$kRIEgOlfranc0BLCSab4SuZk8Y/m0tU8N6GpZy9VItCWirUrpUt7m', 'INDRA RIFA\'I', 'OP. ST. GIL PENGGERAK MESIN UAP', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:00'),
(178, '11010498', '$2y$12$5/5bQCC1FlQGuAWy6X1alO/WmxCbvIox3e7yNEVt6iTToI4eMz4oS', 'YAYAK HADIYATULLAH', 'MEKANIK LOKO (ST. GILINGAN/ ST. BESALI)', 'Dok Loko PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:01'),
(179, '11010499', '$2y$12$EsF4MzPb2eXQr0jOX4Cyl.9PAu6GDA4EFLAaszzm7ieMnkuKTx4CS', 'KARDIYANTO', 'OPERATOR ST.LIMBAH IPAL', 'Limbah PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:01'),
(180, '11010500', '$2y$12$k2R.JsSbRpcL5yiyqwWTYuX17aPRoe4ynKdCiJ9cHrmRteYhixRom', 'SAMSUL ARIFIN', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:01'),
(181, '11010560', '$2y$12$vn.xhiLYGcMwnUJyBhHj6uBMAt4o7Lt3waBvUJGVKVoXOxXNEjS.S', 'SUPRIADI', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:01'),
(182, '11010563', '$2y$12$LZYa1UDuddk.U3aYOVR/Dees4rFHWtB6KFZETaHO7jHulVQKcMgke', 'FATHURROZIM', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:02'),
(183, '11010564', '$2y$12$EHyXMwKsMXUg2GIHop.PDuh0tt9dLwxanveUPqXezyzPBQbehJ.26', 'TOYIMAN', 'OP.INSTRUMENT AREAL BOILING HOUSE', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:02'),
(184, '11010565', '$2y$12$wD.PnDF33tV7LxfVPS2.gOJfSmI84VYOonf0e9gO6q2yWWdbH7mhS', 'NASRULLAH HUDA', 'MANDOR SHIFTOPERATOR PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:02'),
(185, '18012684', '$2y$12$I/RhuN5cIybNJ91WcbK2de3tz98N.7oQGkGzG3Er0vCakFKrgcFk2', 'HERU SISWANDI', 'PERWIRA KEAMANAN', 'Adm & Umum AKU PG Gending', 'HONORER', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:02'),
(186, '18012932', '$2y$12$nG4hsBI7UiBDKf1hyVulKep.8N4XaCuvCLq0adbDuHfGpRlI51Vd2', 'MASRURO', 'ADMIN KANTOR LNSTALASI', 'Adm & Umum Pabrik PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:03'),
(187, '18012933', '$2y$12$lp2c.FGeCWYxvO/vCzt/sumV76M/ta.5SIArHas42nhZYP9sV8fJO', 'MIA SUSANTI', 'ADMIN SDM & PAYROLL', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:04'),
(188, '18012934', '$2y$12$FtcfXm8whFDa50EgUSYl2ulFmXUTimFFwh35vQ3EJ0SZ8cwvH2z4.', 'REZKY RAHMAT PURWANTONO', 'ADMIN HASIL & DO', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:04'),
(189, '18012935', '$2y$12$n5FXXKxDAuZ0IAirNdiLCuy5LqMfe35/XW06j8yl9vEPnhnkW3vQC', 'M. ARIFIN', 'ADMIN KEBUN', 'Tebu Rakyat PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:05'),
(190, '18012936', '$2y$12$otpknUMVnfPgVL756RXqxOrO04sAN6Ziqa15T8rZkxJAs5as10auq', 'SANTY UMAYE', 'ADMIN SEKRETARIAT', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:05'),
(191, '18012937', '$2y$12$2uLfkkYth7MiaQL7ivUDQOCXRKsb7tgRisBcNkHv34tR90pNEQSJW', 'HENDRA EKA CAHYA DEWA', 'OP.INSTRUMENT AREAL BOILER', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:06'),
(192, '18012938', '$2y$12$TCavbbLjyX8NoMKJc9qnwOfynQ9Khy438Cs1kqnlS9Qn2L2wMDNgG', 'CAHYONO NUIS', 'OPERATOR ST. GILINGAN TALANG NIRA', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:07'),
(193, '18012939', '$2y$12$L81T6T0p/DloOZARdiX7venLWUwi6y2zx1/a4WERjeLNGn8QhmyA.', 'ILHAM HIDAYATULLAH', 'MANDOR WILAYAH KEBUN', 'Tebu Rakyat PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:07'),
(194, '18012940', '$2y$12$VoZ5/3KrLArPz01TN533le.jv0ziSTM/3CNJ5PMzmwr0jfwD9SZXu', 'MUHAMMAD NUR WAHYUDI', 'SOPIR', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:08'),
(195, '18012941', '$2y$12$rlOaraAMeFsW0Ibh3OKIL.S5SidLG4Rv8DNeCIvxy6KpuYUQxwGOG', 'ACHMAD KHOMARUDIN', 'TUKANG BANGUNAN (ST. BESALI)', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:08'),
(196, '18012942', '$2y$12$BYAac5ljwRjn8VvmqUACqe3Rws9CoQkXFEdKB0yf673.uo5BFlN/i', 'SUNAWI WIDODO', 'TUKANG BANGUNAN (ST. BESALI)', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:09'),
(197, '18012943', '$2y$12$Tv0MM7qmzIy8L2Y6hbh0d.F4HO4.gQRNaFDhUaLVWalI3XKO9EkNK', 'MOH. ANDRI', 'PTGS. PEMELIHARAAN FASILITAS UMUM&MESS', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:10'),
(198, '18012944', '$2y$12$4KVL1qeIM.xex3RuXIcq6eUZ4fEkXQWMUmuWvKtZTNteqFQJdPfPm', 'EDY SISWANTO', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:10'),
(199, '18012945', '$2y$12$6TLVUvkLM113/UfrQHibHeB4.gErgwjemi/fBWiYUh55IMky6fV46', 'SUPARDI', 'PTGS. PEMELIHARAAN FASILITAS UMUM&MESS', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:11'),
(200, '18012946', '$2y$12$e.OpKjYr8i4bVR44oK50aeO2a.QMR6bzvSAXHRk0qioVppUxW5NuS', 'FARIDIK SINGGIH STOMATIS', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:11'),
(201, '18012947', '$2y$12$nKDn0l2Ivtt.oigR27mEq.Bm6YwtyHZbP6RBbIrUSHzbjpjMmHFC2', 'SETIAWAN TRI PRASETYO', 'SATPAM', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:11'),
(202, '18015397', '$2y$12$mNEh854mkJaBzgUkWoN8DOOKJdV/iYoIMQIHpht4iMQlfeNPzvHR.', 'MOH HADI', 'SUPERVISOR ADMIN PEMBUKUAN/AKUNTANSI', 'Adm & Umum AKU PG Gending', 'HONORER', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:11'),
(203, '18018135', '$2y$12$MpODLQmjhskrXh6rn4Ptie27x9OCoaqJX1ICMG4VLDj4ABOayaepS', 'DIDIK WAHYUDI', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:12');
INSERT INTO `karyawan` (`id`, `nik`, `password`, `nama`, `jabatan`, `bagian`, `status`, `kategori`, `keterangan`, `status_pengambilan`, `tanggal_pengambilan`, `discan_oleh`, `created_at`, `updated_at`) VALUES
(204, '18018136', '$2y$12$do2H3tQ21EwYC9IUY7cIr.9FdxxO4agC1GyLL3HcmFk8jRylL9YEq', 'ANDRI YULIANTO', 'OP. ST.GIL KONTROL&PELUMAS MESIN I S.D 4', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:12'),
(205, '18018138', '$2y$12$py/SzLZ1BH5p6zE8dcP8puGx5IX/8cxqoYWFCQahC1OLfxPVpxihq', 'INDRA KURNIAWAN', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:12'),
(206, '18018203', '$2y$12$AT9Edaq7.NC4a/mtUC.PuOEbuCrQ8dtBHCu3dUyzLlO5ypHP3oace', 'ASPIANTO', 'OP.BOILER RECKLAIMER&RAKE DISTRAMPAS', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:13'),
(207, '18018212', '$2y$12$7R3VRBbIRYwjgipwdZY6oef9rckR3g7cAnq8mYdJ8JUxSAWJtHHY2', 'RISKA FIRDIANA', 'ADMIN BAHAN OLAHAN', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:06:13'),
(208, '18018213', '$2y$12$sgiBomVp6DomqwnmraTG7uZiPaGWqMgfFcdcc4FwMfS4xFcnJdEe.', 'DECKY ADITYA LESMANA', 'PETUGAS ANALISANIRA ARI', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:04'),
(209, '18018214', '$2y$12$7sv6JZ3Fe8bKKi.KKTW/OepBkukKU5hxEs6snK/L9Hg.hoyr903KC', 'HARI SUSANTO', 'PETUGAS ANALISABRIX PINTU MASUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:04'),
(210, '18018224', '$2y$12$RiGl60BfhzDumIdhcyRgN.HiHpLNEPYbC0qg4L4i2ArXtNf7SC5ye', 'MOH. AFNAN ABRORI', 'PETUGAS ANALISANIRA ARI', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:04'),
(211, '18018231', '$2y$12$Kb6B9fzEgZfUz.4bTH/YqeIfMY/DbfOF/HmMJ97BKhHQExANPAg9K', 'EKO MISNARYANTO', 'PETUGAS ANALISA AIR KONDEN & APK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:04'),
(212, '18018238', '$2y$12$4GJ4FNVS2LtkTbfwWn92B.v5eWPmEyw9qf1iqsMycegWw30/xOIcW', 'FEBRIANSYA', 'PETUGAS ANALISANIRA ARI', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:05'),
(213, '18018239', '$2y$12$8wnKiNm8R8eoFCLcT65cmeE.Z.xplnBzxF3U50MQrpAhmhzu.s.6e', 'MUNERI', 'ADMIN PENCATATAN KELILING', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:05'),
(214, '18018240', '$2y$12$Sd9n6FJrvRTvC.8KRJQkC.odlZz.cE26KlUFk0d76mmiGIEGe.yeC', 'YAFI FIRDIANSAH', 'PETUGAS ANALISAMASCUITTE/MASAKAN', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:05'),
(215, '18018241', '$2y$12$HRMVMuDN1ZUyA08OudKKJ..thZv/XrquleJoWe/XBLIX5UUw98JRe', 'RUBI SASANTO', 'PETUGAS ANALISAMASCUITTE/MASAKAN', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:05'),
(216, '18018242', '$2y$12$P..qhViSUQhSm3Q8e/5Die6dfFTTKQOUFiOrKmNXpXjWYAj1uRBBe', 'AKBAR AFANDI', 'PETUGAS ANALISAMASCUITTE/MASAKAN', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:06'),
(217, '18018243', '$2y$12$8k8pNDg1Jg6KKXH04WOJ/OjRB8yI/8tjubC/cORe2FabmEyhFo9B.', 'WIDYANTO KUSUMA LUGHI', 'ADMIN PENCATATAN KELILING', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:06'),
(218, '18018244', '$2y$12$nQr4cYLD64CF.paqBJdvZekZo0TmEh8yN17NZ5kXSh4jpRS66S6U.', 'MOCH.  MA\'RUF SYARIFULLAH', 'PETUGAS ANALISA NIRA (NPP)', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:06'),
(219, '18018245', '$2y$12$h5V3GCLkoJSrw.0xMQQZVOyJAzxH9McH9o56flc0GtDwk0Yw51zgW', 'SADDAM HUSEN', 'PETUGAS ANALISA AIR KONDEN & APK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:06'),
(220, '18018246', '$2y$12$5lqEtV2BVz/51AXSgjiK4uKLprBJuuu3KAL1QKnVK9nhc10EQh/F.', 'TOYO', 'PETUGAS CEK LORI/TRUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:07'),
(221, '18018247', '$2y$12$PzdpN38M7Cm5bi3fl70YauE5/KZjqA18mBq34j2VxZC9voeYcdxse', 'WIRA AJI KAMISWARA', 'PETUGAS CEK LORI/TRUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:07'),
(222, '18018248', '$2y$12$KCqN6woO7GB8oKVGiohQmuKQHDXgN/bOWlR5z.H3vGGXNOGc00gtK', 'ARIF SAIFULLAH', 'ADMIN PENCATATAN KELILING', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:07'),
(223, '18018249', '$2y$12$UnbRRr1U/pX.5w1f.Sq/1OzDPnAw8Qc6sqYmNbhLHtX4NFh0exsca', 'LUTFI AFFANDI', 'PETUGAS PENILAIAN MUTU TEBU', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:07'),
(224, '18018250', '$2y$12$dT/yDB3KfOv9k6ZMmWrWiu3ZXOAcflVQx.iUrfnAKY7lm.jFWTS9y', 'BUYADI', 'PETUGAS ANALISABRIX PINTU MASUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:08'),
(225, '18018251', '$2y$12$1EhidY93BohQB2ocjSRr0uEEp9FuTMYfF2AIIL1XQIRZZRX6TUsem', 'OKKY INDRA NURYANTO', 'PETUGAS ANALISABRIX PINTU MASUK', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:08'),
(226, '18018252', '$2y$12$1eCBfRD7diKv3Bi9NIpKi.jrIxOpBDi2eLUcwfL87.czvfcRzKOY2', 'SOVI MARZUKI', 'PETUGAS PENILAIAN MUTU TEBU', 'Adm & Umum QC PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:08'),
(227, '18018260', '$2y$12$TkFG89G597KJ/0.sqb1ipOKPO8Yk1Uo85v5iL9xRrBSWIL2yp1s.y', 'ALI MUSTAR ASHARI', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:08'),
(228, '18018261', '$2y$12$jkhbKHfTg2GjbdIBuTDp3u5CGH2ONTTy12ZrLpyzgfOBcMlLcF17C', 'ZAINAL ARIF', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:09'),
(229, '18018262', '$2y$12$rdcAoLTU7ZCG285dGGJ42.TbbbLZhytjIdZMdewCpnvQK53H0IgDW', 'SADI', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:09'),
(230, '18018263', '$2y$12$9/q/MrjlQmuOIm/QOZJvhuMe66QtC.s0BdkbC7yAPEt/8RQqSijJO', 'PUJI HERMAWAN', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:09'),
(231, '18018264', '$2y$12$EHj6ZENJUF02byYKElrZ3OXzVyqQ4Z9dgRy6eaToUD0niE4IcsWiy', 'HERMANTO', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:09'),
(232, '18018265', '$2y$12$/AG4MTVf57ZrzJGMP9A17u7cojzV8wUV/W8PtzSGm6Ms3RFSgBNcO', 'MOHAMMAD ALI', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:09'),
(233, '18018266', '$2y$12$IX8DsPkNPYtPvrAdi9GhZOcNNe2pNC0n1bGF9j7.SVayq3F70MnVm', 'SUGIONO HERMANTO', 'PETUGAS TMA', 'Pendukung Opr. & Kantor TMA PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-26 18:05:10'),
(234, '18018267', NULL, 'AHMAD ZAINULLAH', 'JURU TIMBANG', 'Adm & Umum AKU PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(235, '18018291', NULL, 'SALMAN ALFARISI', 'OP. LOKO (ST. GILINGAN/ ST. BESALI)', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(236, '18018292', NULL, 'JUNAIDI', 'MEKANIK LOKO (ST. GILINGAN/ ST. BESALI)', 'Dok Loko PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(237, '18018297', NULL, 'DANY NUR MUHAMMAD', 'OP. ST.GIL KONTROL&PELUMAS MESIN I S.D 4', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(238, '18018300', NULL, 'SIFA\'UDDIN', 'OP.BOILER RECKLAIMER&RAKE DISTRAMPAS', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(239, '18018302', NULL, 'MUHAMMAD FAISOL', 'OPERATOR ST. GILINGAN TALANG NIRA', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(240, '18018304', NULL, 'BUDIYANTO', 'OP. ST. GIL CONTR. ROOM GIL & CC I&II', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(241, '18018311', NULL, 'AGUS WIJAYA', 'OP.BOILER RECKLAIMER&RAKE DISTRAMPAS', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(242, '18018314', NULL, 'NUR MAJID ROMADONI', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(243, '18018316', NULL, 'NANANG HERMANTO', 'OP. ST. GIL CONTR. ROOM GIL & CC I&II', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(244, '18018319', NULL, 'IMAM SHOLIHIN', 'OP.BOILER RECKLAIMER&RAKE DISTRAMPAS', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(245, '18018321', NULL, 'RUDI ANTONO', 'OP.BOILER CONTR.ALAT LNSPEK&MAINTENANCE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(246, '18018323', NULL, 'WAHYUDI', 'OP.BOILER CONTR.ALAT LNSPEK&MAINTENANCE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(247, '18018325', NULL, 'SYAIFUL ARIFIN', 'OP.BOILER CONTR.ALAT LNSPEK&MAINTENANCE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(248, '18018326', NULL, 'SAIFUL ANAM', 'OP.BOILER CONTR.ALAT LNSPEK&MAINTENANCE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(249, '18018327', NULL, 'AINUR ROFIQ', 'OPERATOR ST. BOILER LOADER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(250, '18018329', NULL, 'EKO ADIYANTO', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(251, '18018332', NULL, 'ZAINUL ARIFIN', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(252, '18018334', NULL, 'ABDUR RAHMAN', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(253, '18018344', NULL, 'SATUKI', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(254, '18018346', NULL, 'ACHMAD ROWI', 'OPERATOR ST. BOILER BAGASSE FEEDER/PLOUG', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(255, '18018347', NULL, 'ANDRI DOLOG', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(256, '18018348', NULL, 'SAIFUL ANWAR', 'OP.BOILER TEK.20&45 KG/CM2-DUMPING GRADE', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(257, '18018349', NULL, 'SUGIONO', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(258, '18018350', NULL, 'DIMAS WICAKSONO', 'OPERATOR ST. BOILER BAGASSE FEEDER/PLOUG', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(259, '18018351', NULL, 'NURUL HUDA', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(260, '18018352', NULL, 'MUCHAMMAD ARJUN', 'OPERATOR ST. GILINGAN CRANE LIFTER', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(261, '18018353', NULL, 'EKKY PUTRA WIJAYA', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(262, '18018354', NULL, 'HERI SYA\'RONI', 'OP. ST. GIL CONTR. ROOM GIL & CC I&II', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(263, '18018355', NULL, 'ABDUR RAHMAN', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(264, '18018356', NULL, 'MUHAMMAD PUJI ISMANTO', 'OP. ST.GIL KONTROL&PELUMAS MESIN I S.D 4', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(265, '18018357', NULL, 'YUDI HARTONO', 'OPERATOR ST. GIL TURBINE GILINGAN I-IV.', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(266, '18018358', NULL, 'DIAN TOMI', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(267, '18018359', NULL, 'RIFAN ALIF UTAMA', 'OP. ST. GIL LNSPEKSI/PELUMASAN', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(268, '18018360', NULL, 'MUHAMMAD TAUHID', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(269, '18018361', NULL, 'SAPI\'UDIN', 'OP.INSTRUMENT AREAL BOILER', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(270, '18018362', NULL, 'EKO HANDOKO', 'OP.INSTRUMENT AREAL BOILING HOUSE', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(271, '18018363', NULL, 'MUHAMMAD BAHRUL ULUM', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(272, '18018364', NULL, 'CHOIRUL IMAM', 'OP.TURBIN ALTENATOR & SENTRAL A/C', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(273, '18018365', NULL, 'IRWAN RUSDIYANTO', 'OP.INSTRUMENT AREAL BOILING HOUSE', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(274, '18018366', NULL, 'ARIP ROHMAN SOLEH', 'OPERATOR ST. BOILER LOADER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(275, '18018367', NULL, 'AGUNG YANUAR PRADIPTA TISWARA', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(276, '18018368', NULL, 'AHMAD', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(277, '18018369', NULL, 'MOH. WAHYONO', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(278, '18018370', NULL, 'MOH SHODIK', 'OP.BOILER RECKLAIMER&RAKE DISTRAMPAS', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(279, '18018371', NULL, 'ABIMANYU DEWA PAMUNGKAS', 'OPERATOR ST. GILINGAN CRANE LIFTER', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(280, '18018372', NULL, 'M. DLOHIKI', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(281, '18018373', NULL, 'SAMSUL HADI', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(282, '18018374', NULL, 'AHMAD ZAINI', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(283, '18018375', NULL, 'DAVID APRILIYANTO', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(284, '18018376', NULL, 'M. ALAIKA ILHAM', 'OPERATOR ST. GILINGAN LIER TEBU', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(285, '18018377', NULL, 'MUHAMMAD ALEX KHOIRON', 'OP. ST.GIL KONTROL&PELUMAS MESIN I S.D 4', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(286, '18018378', NULL, 'ABDUR RAHMAT HIDAYAT', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(287, '18018382', NULL, 'M. ADIT SAPUTRA', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(288, '18018384', NULL, 'DANIAR EFFENDI', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(289, '18018385', NULL, 'ROHMAN', 'OPERATOR ST. PEMURNIAN RVF ( I/II)', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(290, '18018386', NULL, 'EGO PRAYUGO', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(291, '18018387', NULL, 'ARIF RAHMAN', 'OP.ST.PEMURNIAN DORR CLARIFIER&FLOCULANT', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(292, '18018388', NULL, 'ZAINUL HAQ', 'OPERATOR ST. PEMURNIAN DAPURBELERANG', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(293, '18018389', NULL, 'ERIK KURNIA BRATA', 'MANDOR SHIFT OPERATOR ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(294, '18018390', NULL, 'RAHMAT IRFAN', 'OPERATOR ST. PEMURNIAN KAPURAN 1 & 2', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(295, '18018391', NULL, 'ANDIK HARYANTO', 'OPERATOR ST. PEMURNIAN PH NIRA', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(296, '18018392', NULL, 'YOGA ADI SETIAWAN', 'OP.ST.MASAKAN BUKA TUTUP PETI BAHAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(297, '18018393', NULL, 'RUDIYANTO', 'OPERATOR ST. PEMURNIAN KAPURAN 1 & 2', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(298, '18018394', NULL, 'JONI ARIFIN', 'OPERATOR ST. PEMURNIAN PH NIRA', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(299, '18018395', NULL, 'RONI HERI PRASETIYO', 'OPERATOR ST. PEMURNIAN DAPURBELERANG', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(300, '18018396', NULL, 'MOH. EKSAN', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(301, '18018397', NULL, 'M. IRFAN', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(302, '18018398', NULL, 'SABARUDIN', 'MEKANIK ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(303, '18018399', NULL, 'SYAFI\'UDIN', 'MANDOR SHIFTOPERATOR PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(304, '18018400', NULL, 'ZAINAL BASHOR', 'OPERATORST. PENGUAPAN BA& EVAPORATOR', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(305, '18018401', NULL, 'ENDRIYONO', 'OPERATORST. PENGUAPAN BA& EVAPORATOR', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(306, '18018402', NULL, 'JUNAEDI', 'MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(307, '18018403', NULL, 'YUNUS SETIYO PAMUNGKAS', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(308, '18018404', NULL, 'RAHMAT HIDAYAT', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(309, '18018405', NULL, 'KIFRON', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(310, '18018406', NULL, 'MUHAMMAD RONI', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(311, '18018407', NULL, 'NUR AHMAD NOVI HANANTO', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(312, '18018408', NULL, 'ARIS ARIYANTO', 'MANDOR SHIFT MEKANIK ST. MASAKAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(313, '18018409', NULL, 'MUHAMMAD FAISAL', 'OPERATOR ST. MASAKAN C', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(314, '18018410', NULL, 'M. SOLEH', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(315, '18018411', NULL, 'BADRI DUJA', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(316, '18018412', NULL, 'BUDI HARTONO', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(317, '18018413', NULL, 'DODIK ZAINAL FATA', 'OPERATOR ST. MASAKAN D', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(318, '18018414', NULL, 'DEDY SUBAGYO', 'OPERATOR ST. MASAKAN C', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(319, '18018415', NULL, 'GITA ILHAM ZAINULLAH', 'MEKANIK ST. PENGUAPAN', 'Penguapan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(320, '18018416', NULL, 'SULTON HADI WIJAYA', 'OPERATOR ST. MASAKAN C', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(321, '18018417', NULL, 'MUHLISIN', 'OPERATOR ST. MASAKAN A', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(322, '18018418', NULL, 'FAISAL M. RIZQI', 'OP.ST.MASAKAN BUKA TUTUP PETI BAHAN', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(323, '18018419', NULL, 'WASIL NURI', 'MANDOR SHIFT OPERATOR ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(324, '18018420', NULL, 'KHOIRUL ANAM', 'OPERATOR ST. PUTARAN LGF D1&D2', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(325, '18018421', NULL, 'JUHANAN', 'OP. ST.PUTARAN MINGLERD1 & D2', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(326, '18018422', NULL, 'EDI KUSWANTO', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(327, '18018423', NULL, 'JOKO PURNOMO ADI WIJAYA', 'OP. ST.PUTARAN MINGLERD1 & D2', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(328, '18018424', NULL, 'ZAHRONI HIDAYATULLAH', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(329, '18018425', NULL, 'MOCH. RAIS', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(330, '18018426', NULL, 'HENDRA ARI SAPUTRA', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(331, '18018427', NULL, 'AHMAD MAULID', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(332, '18018428', NULL, 'SUPANDI', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(333, '18018429', NULL, 'ZAINAL ABIDIN', 'OPERATOR ST. PUTARAN LGF D1&D2', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(334, '18018430', NULL, 'ALI ADING', 'MANDOR SHIFT OPERATOR ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(335, '18018431', NULL, 'SAFIUDDIN', 'OPERATOR ST. PUTARAN HGF A/R', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(336, '18018432', NULL, 'SLAMET UNTUNG', 'OPERATOR ST. PUTARAN MINGLER RAW A', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(337, '18018433', NULL, 'MOH. ZHAENAL ABIDIN', 'OPERATOR ST. PUTARAN PALUNG A', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(338, '18018434', NULL, 'ALIM PERMANA', 'MEKANIK ST. PUTARAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(339, '18018435', NULL, 'AFIF SIDQON', 'OPERATOR ST. PUTARAN MINGLER RAW A', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(340, '18018436', NULL, 'IRVANI AGUS WIRA KUSUMA', 'MANDOR SHIT PENGEPAKAN', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(341, '18018437', NULL, 'AHMAD WAHYUDI', 'OP.ST.PENGEPAKAN SUGARBIN & CONV.GULA', 'Pengemasan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(342, '18018438', NULL, 'YUNUS BAISANDI', 'OPERATOR ST. MASAKAN SEED VESSEL', 'Masakan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(343, '18018439', NULL, 'RONI SUSANTO', 'OPERATOR ST. PUTARAN MINGLER RAW A', 'Puteran PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(344, '18018440', NULL, 'EMBI', 'OPERATOR ST.LIMBAH IPAL', 'Limbah PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(345, '18018441', NULL, 'SAMSUL ARIFIN', 'MANDOR SHIFT OPERATOR ST. PEMURNIAN', 'Pemurnian PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(346, '18018442', NULL, 'RIZZAL IMANSYAH', 'OP. LOKO (ST. GILINGAN/ ST. BESALI)', 'Besali PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(347, '18018443', NULL, 'MOCHAMAD ARIFIN', 'OP.INSTRUMENT GILINGAN (ST. LISTRIK)', 'Listrik dan Instrument PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(348, '18018444', NULL, 'AHMAD SUPRIYANTO', 'OP.BOILER GOREK,SHOUT BLOW&BAGASSEFEEDER', 'Ketel PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(349, '18018445', NULL, 'RUDI KISTOWO', 'ASISTEN MANAJER ST. PENGUAPAN & LIMBAH', 'Penguapan PG Gending', 'HONORER', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(350, '18018824', NULL, 'SYAMSUL RIZAL', 'Operator St. Gilingan lier Tebu', 'Gilingan PG Gending', 'PKWT', 'KAMP-PKWT', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(375, '250013', NULL, 'AFAN SAMRONI', 'Security/Timbangan', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(376, '250155', NULL, 'JULIEO BACHTIAR RIZAL', 'Operator Recklaimer dan Conveyor/Rake Distribusi Ampas', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(377, '250156', NULL, 'ARIFIANSYAH ADITYA', 'Inspeksi di stasiun tengah (timbangan)', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(378, '250008', NULL, 'MOH. SAIFUL RIZAL', 'Security', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(379, '250150', NULL, 'SAIFUL ANWAR SUPRIHADI', 'Security', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(380, '250010', NULL, 'MUHAMMAD YAZID FAHREZY', 'Security', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(381, '250247', NULL, 'MOH. IQBAL SAIFUL DENI', 'Security', 'AKU', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(382, '250159', NULL, 'ABDUL HALIM', '\"Railban, jln & Jembtn On Farm Gending\"', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(383, '250160', NULL, 'RUDI HARTONO', '\"Railban, jln & Jembtn On Farm Gending\"', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(384, '250161', NULL, 'RONI WIJAYA', '\"Railban, jln & Jembtn On Farm Gending\"', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(385, '250162', NULL, 'MUHAMMAD ISMAIL', 'PELAYAN KANTOR TMA', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(386, '250163', NULL, 'ALDI PRATAMA', '\"Railban, jln & Jembtn On Farm Gending\"', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(387, '250164', NULL, 'MUHAMMAD SYAFARIL HIDAYAH', '\"Railban, jln & Jembtn On Farm Gending\"', 'TANAMAN', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(388, '250165', NULL, 'DIMAS SANI WIJAYA PUTRA', 'CS', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(389, '250166', NULL, 'MOHAMMAD ABDUL HARIS', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(390, '250167', NULL, 'ANDREY APRILIAN FIRMANSYAH', 'Op. St.Gil kontrol&Pelumas Mesin I s.d 4', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(391, '250168', NULL, 'ACHMAD NASHIRUDDIN', 'CS', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(392, '250169', NULL, 'MOCH HAMZAH ALIF SAGITA PUTRA', 'Operator Pelayanan  Teknik', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(393, '250170', NULL, 'GUGUM GUMILAR', 'Op. St. Gil Crane Transloading', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(394, '250171', NULL, 'MUHAMMAD JIHAM', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(395, '250172', NULL, 'WASILUL HAQ AL AQIL', 'Op. St. Gil Crane Transloading', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(396, '250173', NULL, 'ADITYA ROMADHON', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(397, '250174', NULL, 'ARIF RAHMAN HAKIM', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(398, '250175', NULL, 'HOSEN', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(399, '250176', NULL, 'MOH. ARIFIN', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(400, '250177', NULL, 'INDRA ZAINAL HUSEN', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(401, '250178', NULL, 'RONI WIJAYA', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(402, '250179', NULL, 'M. SHOLEH', 'Operator St. Gilingan lier Tebu', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(403, '250248', NULL, 'FAJARIDHO DWI HARTONO', 'Operator Pelayanan  Teknik', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(404, '250181', NULL, 'ZAINAL ABIDIN', 'Operator St. Gilingan lier Tebu', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(405, '250182', NULL, 'ANDIK SUGIONO', 'Operator St. Gilingan lier Tebu', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(406, '250183', NULL, 'AKBAR ZHAWA HAIRUDIN', 'Op.Instrument Gilingan (St. Listrik)', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(407, '250184', NULL, 'MOCH.HAFID', 'Operator ST.Listrik & Instrumen Turbin Altenator dan Sentral Listrik A/C', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(408, '250185', NULL, 'M. TAUFIK HIDAYAT', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(409, '250186', NULL, 'SHOHIL HIDAYAH', 'Op.Boiler Recklaimer&Rake DistrAmpas', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(410, '250187', NULL, 'ZERIL OKTAVIANO', 'Driver', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(411, '250188', NULL, 'UMAR FAROQ', 'Operator Pelayanan  Teknik', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(412, '250190', NULL, 'AHMAD GHOZALI HADIWINARTO', 'Driver', 'TEKNIK', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(413, '250191', NULL, 'MUHAMMAD SYAIFUL ALI', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(414, '250192', NULL, 'FAREL DWI RAMADHAN', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(415, '250193', NULL, 'EKO YULIANTO', 'Penguapan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(416, '250194', NULL, 'YUSRIL ILHAM RAMADHAN, S.SI', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(417, '250195', NULL, 'AHMAD HIDAYATUT TAUFIK', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(418, '250196', NULL, 'ALVIN SUPRIYANTO', 'Adm & Umum Pengolahan', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(419, '250197', NULL, 'DWI ADI WIBISONO', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(420, '250198', NULL, 'MUHAMMAD HAKIM', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(421, '250199', NULL, 'MOCHAMMAD DHOFIR', 'Masakan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(422, '250200', NULL, 'ABDUR ROHMAN FIRDAUS', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(423, '250201', NULL, 'FATHUL ULUM', 'Masakan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(424, '250202', NULL, 'DEKY WAHYU PURNOMO', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(425, '250203', NULL, 'AKBAR WAHYU NUGROHO', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(426, '250204', NULL, 'RUDI IRAWAN', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(427, '250205', NULL, 'EKO YUNIANTO', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(428, '250206', NULL, 'MUHAMMAD SHOHIB', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(429, '250207', NULL, 'MUHAMMAD ALMADANI', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(430, '250208', NULL, 'REYVALDY TRIAS NASSRUL HAKIM', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(431, '250209', NULL, 'MOH. RIZAL FAHRIZI', 'Masakan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(432, '250210', NULL, 'YUDI ANDIKA SAFITTRO', 'Adm & Umum Pengolahan', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(433, '250211', NULL, 'EDI DARIYANTO', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(434, '250212', NULL, 'RACHMAD HAKKIKI', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(435, '250213', NULL, 'INNOE BAKTI SUMONO', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(436, '250214', NULL, 'HAFIDH AMINULLOH FIRDAUS', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(437, '250215', NULL, 'AHMAD YANI', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(438, '250216', NULL, 'SYAIFUL HAQ', 'Pemurnian PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(439, '250217', NULL, 'MISBAHUDDIN SAIFUR RIZAL', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(440, '250218', NULL, 'KHOIRUL AFIN', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(441, '250219', NULL, 'MOH. IFAN FATHUR ROZI', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(442, '250220', NULL, 'EKO WAHYUDI', 'Masakan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(443, '250221', NULL, 'MUHAMMAD NIDHOMUL ISLAM', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(444, '250222', NULL, 'RICO AFANDI', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(445, '250223', NULL, 'ANDI TRI CAHYONO', 'Masakan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(446, '250224', NULL, 'AJI AL MUHAMMAD AKBAR', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(447, '250225', NULL, 'NUR MUHAMMAD PUJI SAMPURNO', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(448, '250226', NULL, 'M. AGUS SHOLEH', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(449, '250227', NULL, 'ABEL ARYA SABILAH', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(450, '250228', NULL, 'FARUQ ANNABIL', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(451, '250229', NULL, 'ARIFIN', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(452, '250230', NULL, 'ADHAR ROHMAN', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(453, '250231', NULL, 'FATHUR ROZI', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(454, '250232', NULL, 'RICO WIBOWO', 'Puteran PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(455, '250233', NULL, 'BOSTAMI MARSUKI', 'Adm & Umum Pengolahan', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(456, '250234', NULL, 'ALDI ARDIANSYAH PUTRA', 'Pengemasan PG Gending', 'PLH', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(457, '250235', NULL, 'DENY HARDIYANTO', 'Cek Lori/Truck Total Tebu tergiling', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(458, '250236', NULL, 'AGUS MULYONO', 'Anl. Brix dan Ph', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(459, '250237', NULL, 'FARID MAULANA AMINULLAH', 'Anl. Ampas - Blotong - Tetes', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(460, '250238', NULL, 'MOH. ALVIN FIKI NUR AGUS', 'PETUGAS ANALISA  NIRA ARI', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(461, '250239', NULL, 'MUHAMMAD IRHAS ALWAN', 'Anl. Ampas - Blotong - Tetes', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(462, '250240', NULL, 'DANDI PRAYOGO', 'PETUGAS ANALISA  NIRA ARI', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(463, '250241', NULL, 'MUHAMMAD AMINULLAH', 'Cek Lori/Truck Total Tebu tergiling', 'QC', 'OS DMG', 'OS', NULL, 'belum', NULL, NULL, '2026-08-07 03:30:44', '2026-08-07 03:30:44'),
(489, '250001', NULL, 'ZAIFUL RAHMAN', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(490, '250002', NULL, 'FENDIK KURNIAWAN', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(491, '250003', NULL, 'EDI KUSWANTO', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(492, '250004', NULL, 'MOH. RIYANTO', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(493, '250005', NULL, 'FAHMI NAUFAL NURI', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(494, '250007', NULL, 'ZUL QIFLI', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(495, '250006', NULL, 'M. FIQI NUR SIDDIQ', 'Security', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(496, '250047', NULL, 'ABDUL ARIFIN', 'Cleaning Service', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(497, '250046', NULL, 'AFRILIYANTO ISNAN', 'Driver', 'AKU', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(498, '250242', NULL, 'NUR ANDY PRADANA', 'Asmud TR Wilayah', 'TANAMAN', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(499, '250243', NULL, 'NANANG FERIAN AKBAR', 'Asmud TR Wilayah', 'TANAMAN', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(500, '250081', NULL, 'EDY WAHYUDI', 'PMP dan Keliling', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(501, '250044', NULL, 'ABD. RAHMAN', 'Operator Conveyor/Rake/Pembuangan Abu', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(502, '250158', NULL, 'ABD. ROZAQ', 'Mandor shift ST. ketel', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(503, '250045', NULL, 'DWI BUDI SETIAWAN', 'Inspeksi di stasiun puteran', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(504, '250246', NULL, 'ANUGRAH PUTRA FAHREZA', 'Mandor shift ST. Besali', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(505, '250027', NULL, 'FENDIK AGUSTINUS', 'Operator Conveyor/Rake/Pembuangan Abu', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(506, '250028', NULL, 'KHOIRUL WIDANTO', 'Inspeksi di stasiun puteran', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(507, '250029', NULL, 'AHMAD FAUZI', 'Tukang Bangunan', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(508, '250030', NULL, 'ABDUL ROHIM', 'Tukang Bangunan', 'TENIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(509, '250145', NULL, 'RIFKY ACHMAD MUZZAQI', 'Driver', 'TEKNIK', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(510, '250023', NULL, 'ANANG SHOLEH', 'Mekanik ST. Masakan', 'PLH', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(511, '250024', NULL, 'DIDIK DWI PRAMONO', 'Mekanik ST. Penguapan', 'PLH', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43'),
(512, '250025', NULL, 'SONY WIDJIANTO', 'Mekanik ST. Pemurnian', 'PLH', 'OS LMG-DMG', NULL, NULL, 'belum', NULL, NULL, '2026-08-19 00:44:43', '2026-08-19 00:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_07_030056_add_role_to_users_table', 2),
(5, '2026_08_08_004049_add_status_pengambilan_to_karyawan_table', 3),
(6, '2026_08_08_015551_create_pengambilan_gula_table', 4),
(7, '2026_08_13_061436_add_jumlah_gula_to_pengambilan_gula_table', 5),
(8, '2026_08_19_024042_create_jatah_gula_table', 6),
(9, '2026_08_19_030314_rename_kategori_to_status_in_jatah_gula_table', 7),
(10, '2026_08_19_042758_create_aturan_jatah_gula_table', 8),
(11, '2026_08_27_002929_add_foto_to_users_table', 9),
(12, '2026_08_27_004936_add_password_to_karyawan_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_gula`
--

CREATE TABLE `pengambilan_gula` (
  `id` bigint UNSIGNED NOT NULL,
  `karyawan_id` int UNSIGNED NOT NULL,
  `tanggal_ambil` date NOT NULL,
  `jumlah_gula` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengambilan_gula`
--

INSERT INTO `pengambilan_gula` (`id`, `karyawan_id`, `tanggal_ambil`, `jumlah_gula`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-08-10', NULL, '2026-08-09 18:06:29', '2026-08-09 18:06:29'),
(2, 2, '2026-08-10', NULL, '2026-08-09 18:55:51', '2026-08-09 18:55:51'),
(3, 5, '2026-08-11', NULL, '2026-08-10 23:30:34', '2026-08-10 23:30:34'),
(4, 10, '2026-08-13', 10, '2026-08-12 23:56:06', '2026-08-12 23:56:06'),
(5, 8, '2026-08-18', 10, '2026-08-17 17:27:08', '2026-08-17 17:27:08'),
(6, 6, '2026-08-18', 10, '2026-08-17 17:27:46', '2026-08-17 17:27:46'),
(7, 9, '2026-08-18', 10, '2026-08-17 17:28:48', '2026-08-17 17:28:48'),
(8, 12, '2026-08-18', 10, '2026-08-17 17:30:39', '2026-08-17 17:30:39'),
(9, 349, '2026-08-19', 5, '2026-08-18 23:18:24', '2026-08-18 23:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Vl4sEd2ukFa2C9PGNvbv2RHUcwKIqyFFuH6eAFeB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR1FvUFRZeTVmN2N2Rlh2M2dkYzVSYlVVNlJkVUtMN1BBYkNXVm5mayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTU6ImxvZ2luX2thcnlhd2FuXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6NjoiMjUwMDQ0IjtzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fX0=', 1787730285);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Disarankan di-hash dengan password_hash()',
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','operator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operator',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `role`, `foto`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$L9k4KBiXm6ngXB4mB/ZzwOlpIQ5rXceBUuFAjObt9PV9CdFIbz0bS', 'Muhammad Nasih', 'admin@pggending.local', 'admin', 'foto-profil/VehfILGI7huM3oJ03wI3uGKhGxBGMxn6drK2T4Ad.jpg', 'aktif', NULL, '2026-08-07 03:30:44', '2026-08-26 17:35:14'),
(2, 'operator1', '$2y$12$kae8g7XFtijoaqGFkgDKB.ZKBkAyrCbAO6Yr9xkJJcVPnORyIxWvm', 'M RUDI', 'operator1@pggending.local', 'operator', NULL, 'aktif', NULL, '2026-08-07 03:30:44', '2026-08-10 23:28:30'),
(3, 'operator2', 'operator123', 'AYU', 'operator2@pggending.local', 'operator', NULL, 'aktif', NULL, '2026-08-07 03:30:44', '2026-08-10 23:28:42'),
(5, 'operator 3', '$2y$12$xAErb8CRni9mPFbUHQayNuABB5IJfwDoIVuRjkNmZACJIc8HQTk5C', 'Muhammad Nasih', 'muhnasih06@gmail.com', 'operator', NULL, 'aktif', NULL, '2026-08-10 23:28:10', '2026-08-10 23:28:10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_karyawan_kamp_pkwt`
-- (See below for the actual view)
--
CREATE TABLE `v_karyawan_kamp_pkwt` (
`bagian` varchar(150)
,`created_at` timestamp
,`id` int unsigned
,`jabatan` varchar(200)
,`kategori` varchar(20)
,`keterangan` varchar(100)
,`nama` varchar(150)
,`nik` varchar(20)
,`status` varchar(30)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_karyawan_os`
-- (See below for the actual view)
--
CREATE TABLE `v_karyawan_os` (
`bagian` varchar(150)
,`created_at` timestamp
,`id` int unsigned
,`jabatan` varchar(200)
,`kategori` varchar(20)
,`keterangan` varchar(100)
,`nama` varchar(150)
,`nik` varchar(20)
,`status` varchar(30)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_karyawan_tetap`
-- (See below for the actual view)
--
CREATE TABLE `v_karyawan_tetap` (
`bagian` varchar(150)
,`created_at` timestamp
,`id` int unsigned
,`jabatan` varchar(200)
,`kategori` varchar(20)
,`keterangan` varchar(100)
,`nama` varchar(150)
,`nik` varchar(20)
,`status` varchar(30)
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ringkasan`
-- (See below for the actual view)
--
CREATE TABLE `v_ringkasan` (
`jumlah` bigint
,`kategori` varchar(20)
,`status` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan_kamp_pkwt`
--
DROP TABLE IF EXISTS `v_karyawan_kamp_pkwt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan_kamp_pkwt`  AS SELECT `karyawan`.`id` AS `id`, `karyawan`.`nik` AS `nik`, `karyawan`.`nama` AS `nama`, `karyawan`.`jabatan` AS `jabatan`, `karyawan`.`bagian` AS `bagian`, `karyawan`.`status` AS `status`, `karyawan`.`kategori` AS `kategori`, `karyawan`.`keterangan` AS `keterangan`, `karyawan`.`created_at` AS `created_at`, `karyawan`.`updated_at` AS `updated_at` FROM `karyawan` WHERE (`karyawan`.`kategori` = 'KAMP-PKWT')  ;

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan_os`
--
DROP TABLE IF EXISTS `v_karyawan_os`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan_os`  AS SELECT `karyawan`.`id` AS `id`, `karyawan`.`nik` AS `nik`, `karyawan`.`nama` AS `nama`, `karyawan`.`jabatan` AS `jabatan`, `karyawan`.`bagian` AS `bagian`, `karyawan`.`status` AS `status`, `karyawan`.`kategori` AS `kategori`, `karyawan`.`keterangan` AS `keterangan`, `karyawan`.`created_at` AS `created_at`, `karyawan`.`updated_at` AS `updated_at` FROM `karyawan` WHERE (`karyawan`.`kategori` = 'OS')  ;

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan_tetap`
--
DROP TABLE IF EXISTS `v_karyawan_tetap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan_tetap`  AS SELECT `karyawan`.`id` AS `id`, `karyawan`.`nik` AS `nik`, `karyawan`.`nama` AS `nama`, `karyawan`.`jabatan` AS `jabatan`, `karyawan`.`bagian` AS `bagian`, `karyawan`.`status` AS `status`, `karyawan`.`kategori` AS `kategori`, `karyawan`.`keterangan` AS `keterangan`, `karyawan`.`created_at` AS `created_at`, `karyawan`.`updated_at` AS `updated_at` FROM `karyawan` WHERE (`karyawan`.`kategori` = 'Tetap')  ;

-- --------------------------------------------------------

--
-- Structure for view `v_ringkasan`
--
DROP TABLE IF EXISTS `v_ringkasan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ringkasan`  AS SELECT `karyawan`.`kategori` AS `kategori`, `karyawan`.`status` AS `status`, count(0) AS `jumlah` FROM `karyawan` GROUP BY `karyawan`.`kategori`, `karyawan`.`status` ORDER BY `karyawan`.`kategori` ASC, `karyawan`.`status` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan_jatah_gula`
--
ALTER TABLE `aturan_jatah_gula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aturan_jatah_gula_status_unique` (`status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jatah_gula`
--
ALTER TABLE `jatah_gula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jatah_gula_kategori_unique` (`status`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_nik` (`nik`),
  ADD KEY `idx_nama` (`nama`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_kategori` (`kategori`),
  ADD KEY `idx_bagian` (`bagian`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengambilan_gula`
--
ALTER TABLE `pengambilan_gula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengambilan_gula_karyawan_id_tanggal_ambil_unique` (`karyawan_id`,`tanggal_ambil`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aturan_jatah_gula`
--
ALTER TABLE `aturan_jatah_gula`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jatah_gula`
--
ALTER TABLE `jatah_gula`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengambilan_gula`
--
ALTER TABLE `pengambilan_gula`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengambilan_gula`
--
ALTER TABLE `pengambilan_gula`
  ADD CONSTRAINT `pengambilan_gula_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
