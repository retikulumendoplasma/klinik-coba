-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2025 at 03:14 AM
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
-- Database: `klinik_testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_user`
--

CREATE TABLE `akun_user` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email/nomor_hp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun_user`
--

INSERT INTO `akun_user` (`id`, `username`, `email/nomor_hp`, `nik`, `password`, `is_admin`, `email_verified_at`) VALUES
(1, 'GezR', 'asdasd', '1271080706010010', '$2y$10$uTguhQknI6XBx.95tvDFnOK0oTuezaHpBSTwXYqylk7wa.RlJ5izm', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_report`
--

CREATE TABLE `billing_report` (
  `id_billing` bigint NOT NULL,
  `mr` varchar(225) NOT NULL,
  `id_dokter` bigint NOT NULL,
  `obat` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `dokter_view`
-- (See below for the actual view)
--
CREATE TABLE `dokter_view` (
`id_dokter` bigint
,`dokter_display` varchar(278)
);

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` bigint NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `harga_jasa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_reports`
--

CREATE TABLE `medical_reports` (
  `id_rekam_medis` bigint NOT NULL,
  `nomor_rekam_medis` varchar(225) NOT NULL,
  `id_dokter` bigint NOT NULL,
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_berobat` timestamp NOT NULL,
  `diagnosa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `terapi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `catatan_dokter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medical_reports`
--

INSERT INTO `medical_reports` (`id_rekam_medis`, `nomor_rekam_medis`, `id_dokter`, `keluhan`, `tanggal_berobat`, `diagnosa`, `terapi`, `catatan_dokter`) VALUES
(1, '2025_0003', 1, 'kaki nyeri', '2025-01-08 18:32:10', 'patah tulang', 'dukun patah', 'istirahat'),
(2, '2025_0003', 1, 'pusing', '2025-01-11 18:32:25', 'migran', 'bodrex', 'jangan main hp'),
(3, '2025_0003', 6, 'mual', '2025-01-13 18:32:49', 'masuk angin', 'minum tolak angin', 'jangan main air'),
(4, '2025_0001', 1, 'pilek', '2025-01-13 18:33:55', 'alergi', 'operasi', 'jangan main kucing'),
(5, '2025_0002', 1, 'kaki nyeri', '2025-01-14 14:41:54', 'patah tulang', 'dukun patah', 'jangan loncat loncat'),
(6, '2025_0002', 6, 'mencret', '2025-01-16 10:48:53', 'masuk angin', 'minum tolak angin', 'jangan main air'),
(7, '2025_0004', 6, 'pusing', '2025-01-16 10:50:07', 'alergi', 'minum tolak angin', 'jangan main hp'),
(8, '2025_0004', 5, 'kaki nyeri', '2025-01-16 10:50:28', 'patah tulang', 'dukun patah', 'jangan loncat loncat'),
(9, '2025_0003', 6, 'pusing\r\npuyeng\r\nmual', '2025-01-16 18:35:27', 'masuk angin\r\nenter wind', 'minum tolak angin \r\natau obat cyna', 'jagan minum es\r\njangan makan gorengan');

-- --------------------------------------------------------

--
-- Table structure for table `medical_staff`
--

CREATE TABLE `medical_staff` (
  `id_dokter` bigint NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `role` enum('Dokter','Perawat') NOT NULL,
  `telp_hp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medical_staff`
--

INSERT INTO `medical_staff` (`id_dokter`, `nama`, `alamat`, `nik`, `tanggal_lahir`, `role`, `telp_hp`, `created_at`, `updated_at`) VALUES
(1, 'Darma Malem', 'Binjai', '1271082509950010', '2025-01-03', 'Dokter', '082184661236', '2025-01-10 14:54:10', '2025-01-10 17:05:53'),
(3, 'Darto', 'bumi', '1271080710690022', '2025-01-03', 'Perawat', '082184661236', '2025-01-10 17:44:24', '2025-01-10 17:44:24'),
(5, 'Pranata', 'Medan', '1100229933884477', '2001-06-07', 'Dokter', '082184661236', '2025-01-10 18:59:13', '2025-01-13 06:22:01'),
(6, 'Afnz', 'Binjai', '1271082509950010', '1994-06-01', 'Dokter', '082304654465', '2025-01-12 16:55:07', '2025-01-12 16:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id_obat` bigint NOT NULL,
  `nama_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_obat` varchar(225) NOT NULL,
  `supplier` varchar(225) NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id_obat`, `nama_obat`, `jenis_obat`, `supplier`, `harga_beli`, `harga_jual`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Amocilin', 'Antibiotik', 'kimia', 2000, 3000, 100, 'gaada', '2025-01-13 08:12:01', '2025-01-13 08:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_07_140910_create_patients_table', 1),
(5, '2025_01_08_050209_create_medical_reports_table', 1),
(6, '2025_01_08_050613_create_billing_reports_table', 1),
(7, '2025_01_08_050911_create_medicines_table', 1),
(8, '2025_01_08_051052_create_medical_staff_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `nomor_rekam_medis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `status_perkawinan` enum('Belum Menikah','Menikah') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `riwayat_penyakit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`nomor_rekam_medis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `status_perkawinan`, `alamat`, `nomor_hp`, `riwayat_penyakit`, `created_at`, `updated_at`) VALUES
('2025_0001', 'Sudarianto', 'Pria', 'goa', '2025-01-01', 'Tani', 'Belum Menikah', 'bumi', '098123098123', 'gula', '2025-01-13 17:40:10', '2025-01-13 17:40:10'),
('2025_0002', 'Defz', 'Wanita', 'Pabrik', '2025-01-02', 'Pelajar', 'Belum Menikah', 'Jatirejo', '12325123123', 'tbc', '2025-01-13 17:55:28', '2025-01-13 17:55:28'),
('2025_0003', 'Pranata', 'Pria', 'jakarta', '2001-06-07', 'Mahasiswa', 'Belum Menikah', 'Medan', '098123098123', 'tbc', '2025-01-13 18:22:08', '2025-01-13 18:22:08'),
('2025_0004', 'Darto', 'Pria', 'Selokan', '2024-01-16', 'Tani', 'Menikah', 'bumi', '098123098123', 'tumor', '2025-01-16 10:49:47', '2025-01-16 10:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` bigint NOT NULL,
  `mr` varchar(225) NOT NULL,
  `id_obat` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_stok_obat`
--

CREATE TABLE `transaksi_stok_obat` (
  `id_transaksi_obat` bigint NOT NULL,
  `id_obat` bigint NOT NULL,
  `jenis_transaksi` enum('masuk','keluar') NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure for view `dokter_view`
--
DROP TABLE IF EXISTS `dokter_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dokter_view`  AS SELECT `medical_staff`.`id_dokter` AS `id_dokter`, concat(`medical_staff`.`id_dokter`,' - ',`medical_staff`.`nama`) AS `dokter_display` FROM `medical_staff` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_user`
--
ALTER TABLE `akun_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `billing_report`
--
ALTER TABLE `billing_report`
  ADD PRIMARY KEY (`id_billing`),
  ADD KEY `FK_id_dokter_BR` (`id_dokter`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `medical_reports`
--
ALTER TABLE `medical_reports`
  ADD PRIMARY KEY (`id_rekam_medis`),
  ADD KEY `FK_id_dokter_MR` (`id_dokter`),
  ADD KEY `FK_nomor_rekam_medis_MR` (`nomor_rekam_medis`);

--
-- Indexes for table `medical_staff`
--
ALTER TABLE `medical_staff`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`nomor_rekam_medis`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `transaksi_stok_obat`
--
ALTER TABLE `transaksi_stok_obat`
  ADD PRIMARY KEY (`id_transaksi_obat`),
  ADD KEY `FK_id_obat_TSO` (`id_obat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_user`
--
ALTER TABLE `akun_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `billing_report`
--
ALTER TABLE `billing_report`
  MODIFY `id_billing` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_reports`
--
ALTER TABLE `medical_reports`
  MODIFY `id_rekam_medis` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_staff`
--
ALTER TABLE `medical_staff`
  MODIFY `id_dokter` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id_obat` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id_resep` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_report`
--
ALTER TABLE `billing_report`
  ADD CONSTRAINT `FK_id_dokter_BR` FOREIGN KEY (`id_dokter`) REFERENCES `medical_staff` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_reports`
--
ALTER TABLE `medical_reports`
  ADD CONSTRAINT `FK_id_dokter_MR` FOREIGN KEY (`id_dokter`) REFERENCES `medical_staff` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_nomor_rekam_medis_MR` FOREIGN KEY (`nomor_rekam_medis`) REFERENCES `patients` (`nomor_rekam_medis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_stok_obat`
--
ALTER TABLE `transaksi_stok_obat`
  ADD CONSTRAINT `FK_id_obat_TSO` FOREIGN KEY (`id_obat`) REFERENCES `medicines` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
