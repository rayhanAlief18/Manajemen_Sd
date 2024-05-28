-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 06:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sd_bhayangkari`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL DEFAULT 'guru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `foto`, `nama_guru`, `kelas`, `jabatan`, `created_at`, `updated_at`) VALUES
(17, '2024-04-22WhatsApp Image 2024-03-14 at 12.13.35.jpeg', 'Gojo Satoru', '8', 'guru', '2024-04-22 00:35:42', '2024-04-22 00:35:42'),
(18, '2024-04-22IMG_6920.JPG', 'Rayhan Alief F', '5', 'guru', '2024-04-22 04:30:11', '2024-04-22 04:30:11'),
(19, '2024-05-06icons8-shopee-50.png', 'Junanda Deyastusesasdsa', '1', 'guru', '2024-05-05 20:06:18', '2024-05-05 20:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `wali_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `wali_kelas`, `created_at`, `updated_at`) VALUES
(1, 'I', 'Kartini Retno Sari', '2024-04-14 02:02:53', '2024-04-14 02:02:53'),
(4, 'II', 'Budi Susilo', '2024-04-14 02:23:45', '2024-04-14 02:23:45'),
(5, 'III', 'Yono Triono', '2024-04-14 03:21:40', '2024-04-14 03:21:40'),
(6, 'IV', 'Markus Setiawan', '2024-04-14 03:23:41', '2024-04-14 03:23:41'),
(7, 'V', 'Alexander Stewongso', '2024-04-14 03:27:11', '2024-04-14 03:27:11'),
(8, 'VI', 'Endang Soekamti', '2024-04-14 03:29:01', '2024-04-14 03:29:01'),
(10, 'LULUS', '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `kd_pelajaran` varchar(255) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `guru_id`, `kd_pelajaran`, `nama_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 18, 'MTK', 'Matematika', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_14_053457_create_gurus_table', 1),
(6, '2024_04_14_061056_add_level_to_positions_table', 2),
(7, '2024_04_14_083000_create_kelas_table', 3),
(8, '2024_05_05_192339_cretae_siswa_table', 4),
(9, '2024_05_14_182554_create_pembayaran_spps_table', 5),
(10, '2024_05_18_164521_create_mata_pelajarans_table', 6),
(12, '2024_05_18_164315_create_nilai_siswas_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswas`
--

CREATE TABLE `nilai_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `pelajaran_id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `KI1_1` int(11) DEFAULT 0,
  `KI1_2` int(11) DEFAULT 0,
  `KI1_3` int(11) DEFAULT 0,
  `KI1_4` int(11) DEFAULT 0,
  `KI1_5` int(11) DEFAULT 0,
  `KI1_6` int(11) DEFAULT 0,
  `KI2_1` int(11) DEFAULT 0,
  `KI2_2` int(11) DEFAULT 0,
  `KI2_3` int(11) DEFAULT 0,
  `KI2_4` int(11) DEFAULT 0,
  `KI2_5` int(11) DEFAULT 0,
  `KI2_6` int(11) DEFAULT 0,
  `KI3_1` int(11) DEFAULT 0,
  `KI3_2` int(11) DEFAULT 0,
  `KI3_3` int(11) DEFAULT 0,
  `KI3_4` int(11) DEFAULT 0,
  `KI3_5` int(11) DEFAULT 0,
  `KI3_6` int(11) DEFAULT 0,
  `KI4_1` int(11) DEFAULT 0,
  `KI4_2` int(11) DEFAULT 0,
  `KI4_3` int(11) DEFAULT 0,
  `KI4_4` int(11) DEFAULT 0,
  `KI4_5` int(11) DEFAULT 0,
  `KI4_6` int(11) DEFAULT 0,
  `UAS` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_siswas`
--

INSERT INTO `nilai_siswas` (`id`, `siswa_id`, `pelajaran_id`, `semester`, `tahun_ajaran`, `KI1_1`, `KI1_2`, `KI1_3`, `KI1_4`, `KI1_5`, `KI1_6`, `KI2_1`, `KI2_2`, `KI2_3`, `KI2_4`, `KI2_5`, `KI2_6`, `KI3_1`, `KI3_2`, `KI3_3`, `KI3_4`, `KI3_5`, `KI3_6`, `KI4_1`, `KI4_2`, `KI4_3`, `KI4_4`, `KI4_5`, `KI4_6`, `UAS`, `created_at`, `updated_at`) VALUES
(18, 36, 1, 'Semester 2', '2023 / 2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-24 09:01:17', '2024-05-24 09:01:17'),
(27, 26, 1, 'Semester 2', '2023 / 2024', 88, 99, 43, 0, 0, 0, 40, 80, 0, 0, 0, 0, 0, 97, 0, 0, 54, 76, 88, 0, 0, 0, 56, 0, 0, '2024-05-24 12:06:32', '2024-05-24 12:08:03'),
(28, 27, 1, 'Semester 2', '2022 / 2023', 0, 76, 0, 0, 0, 0, 67, 88, 0, 0, 0, 0, 0, 54, 90, 0, 0, 0, 64, 70, 0, 0, 0, 0, 0, '2024-05-24 12:13:59', '2024-05-24 13:18:36'),
(29, 27, 1, 'Semester 2', '2023 / 2024', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-05-24 13:18:08', '2024-05-24 13:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_spps`
--

CREATE TABLE `pembayaran_spps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_bayar` int(11) NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_pembayaran` decimal(10,2) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Lunas',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_spps`
--

INSERT INTO `pembayaran_spps` (`id`, `kd_bayar`, `siswa_id`, `bulan`, `tahun`, `jumlah_pembayaran`, `bukti_pembayaran`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 222, 28, 'Juni', '2009', 265000.00, '1715834132.jpeg', 'belum lunas', NULL, '2024-05-15 21:35:32', '2024-05-15 21:35:32'),
(4, 31, 28, '02', '2024', 200000.00, '1715837374.png', 'belum lunas', NULL, '2024-05-15 22:29:34', '2024-05-15 22:29:34'),
(5, 10031, 28, 'Januari', '2024', 200000.00, '1715837500.png', 'belum lunas', NULL, '2024-05-15 22:31:40', '2024-05-15 22:31:40'),
(6, 10032, 28, 'Februari', '2024', 200000.00, '1715838009.png', 'Lunas', NULL, '2024-05-15 22:40:09', '2024-05-15 22:40:09'),
(7, 888, 26, 'Januari', '2024', 200000.00, '1715882229.jpg', 'Lunas', NULL, '2024-05-16 10:57:09', '2024-05-16 10:57:09'),
(8, 3321, 36, 'Januari', '2024', 200000.00, '1716276450.png', 'Lunas', NULL, '2024-05-21 00:27:30', '2024-05-21 00:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NISN` bigint(16) DEFAULT NULL,
  `NIK` bigint(16) DEFAULT NULL,
  `NO_KK` bigint(16) DEFAULT NULL,
  `NIS` int(4) DEFAULT NULL,
  `foto_siswa` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki','Perempuan') NOT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `anak_ke` int(16) DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `wali_siswa` varchar(255) NOT NULL,
  `semester` enum('Semester 1','Semester 2','','') NOT NULL DEFAULT 'Semester 1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `NISN`, `NIK`, `NO_KK`, `NIS`, `foto_siswa`, `nama_siswa`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `tempat`, `anak_ke`, `kelas_id`, `wali_siswa`, `semester`, `created_at`, `updated_at`) VALUES
(26, 111, 1234567890123456, 1234567890123456, 1234, '1715702407.png', 'Nur Azizah Rosidah', '2004-05-21', 'Laki', 'Islam', 'Surabaya', 1, 7, 'TITA AYU ROSPRICILIA', 'Semester 2', '2024-05-12 21:54:38', '2024-05-22 06:42:17'),
(27, 333, 1234567890123457, 1234567890123456, 1234, '1715576613.png', 'Riky Adam', '2024-05-13', 'Laki', 'Islam', 'Surabaya', 1, 6, 'Anita Hakim Nasution', 'Semester 2', '2024-05-12 22:03:33', '2024-05-22 06:42:17'),
(28, 222, NULL, NULL, NULL, '1715939377.png', 'Junada Deyastusesa', '2003-06-20', 'Laki', NULL, NULL, NULL, 10, 'Anita Hakim Nasution', 'Semester 2', '2024-05-12 22:04:50', '2024-05-22 06:42:17'),
(29, 444, NULL, NULL, NULL, '1715837718.png', 'Rayhan Alief', '2004-01-10', 'Laki', 'Islam', 'Surabaya', 1, 10, 'Samsul', 'Semester 2', '2024-05-15 22:35:18', '2024-05-22 06:42:17'),
(30, 555, NULL, NULL, NULL, '1716138554.png', 'Sandy', '2024-05-20', 'Laki', NULL, NULL, NULL, 10, 'Anita Hakim Nasution', 'Semester 2', '2024-05-19 10:09:15', '2024-05-22 06:42:17'),
(36, 3123123, 23123, 312313, 1234, '1716276253.png', 'Randi', '2024-05-21', 'Laki', 'Islam', 'Surabaya', 2, 7, 'Radianto', 'Semester 2', '2024-05-21 00:24:13', '2024-05-22 06:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_pelajarans_kd_pelajaran_unique` (`kd_pelajaran`),
  ADD KEY `mata_pelajarans_guru_id_foreign` (`guru_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_siswas_siswa_id_foreign` (`siswa_id`),
  ADD KEY `nilai_siswas_pelajaran_id_foreign` (`pelajaran_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayaran_spps_kd_bayar_unique` (`kd_bayar`),
  ADD KEY `pembayaran_spps_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`NISN`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD CONSTRAINT `mata_pelajarans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD CONSTRAINT `nilai_siswas_pelajaran_id_foreign` FOREIGN KEY (`pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  ADD CONSTRAINT `pembayaran_spps_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
