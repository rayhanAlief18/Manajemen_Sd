-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 12:44 PM
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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` enum('hadir','tidak hadir','izin','sakit') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `foto_surat_izin` varchar(255) DEFAULT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_siswa`, `id_kelas`, `date`, `status`, `catatan`, `foto_surat_izin`, `nama_guru`, `created_at`, `updated_at`) VALUES
(1, 26, 5, 'sabtu 2024-06-22', 'hadir', NULL, NULL, 'Santo', '2024-06-22 05:53:10', '2024-06-22 05:53:10'),
(2, 27, 5, 'sabtu 2024-06-22', 'izin', NULL, NULL, 'Santo', '2024-06-22 05:53:13', '2024-06-22 05:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `barang_baik` int(11) DEFAULT NULL,
  `barang_rusak` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `barang_baik`, `barang_rusak`, `deskripsi`, `ruangan_id`) VALUES
(1, 'Kursi Siswa', 18, 2, 'Kaki Bangku Patah', 1);

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
  `no_kk` varchar(16) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nomor_npwp` varchar(255) DEFAULT NULL,
  `kelas_id` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT 'guru',
  `role` varchar(255) DEFAULT '''orang tua''',
  `status` varchar(255) DEFAULT '''non aktif''',
  `level` enum('tata usaha','kepala sekolah','wali kelas','guru mapel') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `no_kk`, `nik`, `nomor_npwp`, `kelas_id`, `nama_guru`, `email`, `password`, `foto`, `agama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `gelar_depan`, `gelar_belakang`, `nomor_telepon`, `nomor_hp`, `jenjang`, `tahun_lulus`, `jurusan`, `jabatan`, `role`, `status`, `level`, `created_at`, `updated_at`) VALUES
(22, NULL, NULL, NULL, '1', 'Siti Nur S.Pd', '', '', '2024-06-21Screenshot (84).png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'guru', 'orang tua', 'non aktif', 'tata usaha', '2024-06-21 05:32:03', '2024-06-21 05:37:43'),
(23, NULL, NULL, NULL, '4', 'Hendro, S.Kom', '', '', '2024-06-21Screenshot (84).png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'guru', 'orang tua', 'non aktif', 'tata usaha', '2024-06-21 05:38:15', '2024-06-21 05:38:15'),
(24, '53545112312', '21331435345', '1221212', '5', 'Santo', 'santo@s.s', '$2y$12$HGNFsRhNuwGiJPKz0hBpJOwsNMxeKHb9.W.Iw53VMEocO8y/B157e', '2024-06-21Screenshot (11).png', 'islam', 'laki laki', 'Surabaya', '2024-06-21', 'S.pd', 'S.Kom', '76546234', '423325', 'S1', '2003', 'sasa', 'guru wali kelas', 'guru wali kelas', 'aktif', 'tata usaha', '2024-06-21 07:46:04', '2024-06-21 07:46:04'),
(25, '345345345', '535345345', '3456345345', '10', 'guru mapel', 'guru@g.g', '$2y$12$HGNFsRhNuwGiJPKz0hBpJOwsNMxeKHb9.W.Iw53VMEocO8y/B157e', '2024-06-23Screenshot (42).png', 'kristen', 'laki laki', 'Surabaya', '2024-06-23', 'S.pd', 'S.Kom', '65465466', '45645645645', 'S1', '2008', 'sdasas', 'kepala sekolah', 'guru wali kelas', 'aktif', 'guru mapel', '2024-06-22 23:13:36', '2024-06-22 23:13:36'),
(26, '234234234', '4234234234', '2342423432', '6', 'Wali Kelas', 'wali@w.w', '$2y$12$skNiYeo4A8F0tejJtn1RnOjemMyZPzu7UNe3Gq13WALMojQtESMtm', '2024-06-23UBUNTU KU.PNG', 'kristen', 'laki laki', 'Surabaya', '2024-06-23', 'S.pd', 'S.Kom', '23423424', '4234324324', 'S1', '2009', 'Dasas', 'guru wali kelas', 'guru wali kelas', 'aktif', 'wali kelas', '2024-06-22 23:59:19', '2024-06-23 00:09:50'),
(27, '23423423', '42424234', '2132423', 'Masukkan kelas...', 'Guru 2', 'guru2@g.g', '$2y$12$8z4p106pERiCzcUHzMZlcOhT6juijFybzWzdxuk36ofmiGobQDrY.', '2024-06-23UBUNTU KU.PNG', 'Budha', 'laki laki', 'Surabaya', '2024-06-23', '42342', '424234', '214434', '3424234', '423424', '2008', '423424', 'Masukkan Jabatan / peran...', 'Masukkan Peran Pengguna...', 'aktif', 'guru mapel', '2024-06-23 00:19:03', '2024-06-23 00:19:03'),
(30, '1212121212', '3504131910030001', '12121212', '8', 'Cobaann', 'jamal@gmail.com', '$2y$12$95jR1Eg85/9ibR4hfN38BOP5irfLqCWhZGO4rdB4djz7yJw5hP22m', '2024-06-23WhatsApp Image 2024-06-12 at 17.56.39_24f48af5.jpg', 'islam', 'laki laki', 'Tulungagung', '2024-06-23', 'Spd', 'S.Pd', '888888888', '88888888', 'S1', '2004', 'Tata Boga', 'guru wali kelas', 'guru wali kelas', 'aktif', 'wali kelas', '2024-06-23 03:15:11', '2024-06-23 03:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `jam_mulai` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `jumlah_sesi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `id_mapel`, `id_guru`, `id_kelas`, `jam_mulai`, `jam_selesai`, `jumlah_sesi`, `created_at`, `updated_at`, `hari`) VALUES
(1, 2, 22, 1, '13.00', '16.00', '1', '2024-06-21 14:19:34', '2024-06-21 14:19:34', 'senin'),
(2, 2, 24, 5, '01:28', '02:00', '2', '2024-06-21 07:47:03', '2024-06-21 07:47:03', 'senin'),
(3, 1, 24, 4, '10:00', '11:00', '2', '2024-06-22 05:54:20', '2024-06-22 05:54:20', 'rabu');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `angka_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `angka_kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelas 1', '2024-04-14 02:02:53', '2024-04-14 02:02:53'),
(4, 2, 'Kelas 2', '2024-04-14 02:23:45', '2024-04-14 02:23:45'),
(5, 3, 'Kelas 3', '2024-04-14 03:21:40', '2024-04-14 03:21:40'),
(6, 4, 'Kelas 4', '2024-04-14 03:23:41', '2024-04-14 03:23:41'),
(7, 5, 'Kelas 5', '2024-04-14 03:27:11', '2024-04-14 03:27:11'),
(8, 6, 'Kelas 6', '2024-04-14 03:29:01', '2024-04-14 03:29:01'),
(10, 7, 'Alumni', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_pelajaran` varchar(255) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `kd_pelajaran`, `nama_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'IPS', 'Ilmu Pengetahuan Sosial', '2024-06-21 17:13:52', '2024-06-21 17:13:52'),
(2, 'BIND', 'Bahasa Indonesia', '2024-06-21 06:49:14', '2024-06-21 06:49:14'),
(3, 'MTK', 'Matematika', '2024-06-21 06:57:03', '2024-06-21 06:57:03');

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
(12, '2024_05_18_164315_create_nilai_siswas_table', 7),
(13, '2024_05_29_065511_create_prestasis_table', 8),
(14, '2024_05_29_065923_create_ruangans_table', 9),
(16, '2024_05_29_070219_create_barangs_table', 10),
(17, '2024_06_21_073029_create_absensi_table', 11);

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
  `KI1_1` int(11) NOT NULL DEFAULT 0,
  `KI1_2` int(11) NOT NULL DEFAULT 0,
  `KI1_3` int(11) NOT NULL DEFAULT 0,
  `KI1_4` int(11) NOT NULL DEFAULT 0,
  `KI1_5` int(11) NOT NULL DEFAULT 0,
  `KI1_6` int(11) NOT NULL DEFAULT 0,
  `KI2_1` int(11) NOT NULL DEFAULT 0,
  `KI2_2` int(11) NOT NULL DEFAULT 0,
  `KI2_3` int(11) NOT NULL DEFAULT 0,
  `KI2_4` int(11) NOT NULL DEFAULT 0,
  `KI2_5` int(11) NOT NULL DEFAULT 0,
  `KI2_6` int(11) NOT NULL DEFAULT 0,
  `KI3_1` int(11) NOT NULL DEFAULT 0,
  `KI3_2` int(11) NOT NULL DEFAULT 0,
  `KI3_3` int(11) NOT NULL DEFAULT 0,
  `KI3_4` int(11) NOT NULL DEFAULT 0,
  `KI3_5` int(11) NOT NULL DEFAULT 0,
  `KI3_6` int(11) NOT NULL DEFAULT 0,
  `KI4_1` int(11) NOT NULL DEFAULT 0,
  `KI4_2` int(11) NOT NULL DEFAULT 0,
  `KI4_3` int(11) NOT NULL DEFAULT 0,
  `KI4_4` int(11) NOT NULL DEFAULT 0,
  `KI4_5` int(11) NOT NULL DEFAULT 0,
  `KI4_6` int(11) NOT NULL DEFAULT 0,
  `UAS` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_siswas`
--

INSERT INTO `nilai_siswas` (`id`, `siswa_id`, `pelajaran_id`, `semester`, `tahun_ajaran`, `KI1_1`, `KI1_2`, `KI1_3`, `KI1_4`, `KI1_5`, `KI1_6`, `KI2_1`, `KI2_2`, `KI2_3`, `KI2_4`, `KI2_5`, `KI2_6`, `KI3_1`, `KI3_2`, `KI3_3`, `KI3_4`, `KI3_5`, `KI3_6`, `KI4_1`, `KI4_2`, `KI4_3`, `KI4_4`, `KI4_5`, `KI4_6`, `UAS`, `created_at`, `updated_at`) VALUES
(1, 27, 2, 'Semester 1', '2023 / 2024', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-21 17:23:34', '2024-06-21 17:23:34'),
(2, 37, 1, 'Semester 1', '2023 / 2024', 90, 0, 0, 0, 0, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-06-21 10:24:14', '2024-06-21 10:24:32');

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
(8, 3321, 36, 'Januari', '2024', 200000.00, '1716276450.png', 'Lunas', NULL, '2024-05-21 00:27:30', '2024-05-21 00:27:30'),
(9, 124545, 37, 'Maret', '2024', 200000.00, '1718988838.png', 'Lunas', NULL, '2024-06-21 09:53:58', '2024-06-21 09:53:58');

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
-- Table structure for table `prestasis`
--

CREATE TABLE `prestasis` (
  `id` int(11) NOT NULL,
  `gambar_thumbnail` varchar(255) NOT NULL,
  `gambar_prestasi` varchar(255) DEFAULT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `anggota` varchar(255) NOT NULL,
  `tingkat` varchar(255) NOT NULL,
  `tgl_prestasi` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `dokumentasi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dokumentasi`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prestasis`
--

INSERT INTO `prestasis` (`id`, `gambar_thumbnail`, `gambar_prestasi`, `nama_prestasi`, `anggota`, `tingkat`, `tgl_prestasi`, `deskripsi`, `dokumentasi`) VALUES
(1, '1716967119_IMG-20220216-WA0035.jpg', '1716967119_uSER.jpg', 'Juara 1 Web', 'Sandi, Ridho', 'Nasional', '2024-05-01', 'Menang Yeayy', '[\"1716967119_hand-painted-watercolor-background-with-sky-clouds-shape.jpg\"]'),
(2, '1718972824_UBUNTU KU.PNG', '1718972825_UBUNTU KU.PNG', 'Juara 1 Mewarnai', 'Sandi, Ridho', 'Provinsi', '2024-05-09', 'Menang Juara 1 Mewarnai Tingkat nasional', '[\"1718972825_UBUNTU KU.PNG\"]');

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lantai` enum('Lantai 1','Lantai 2','Lantai 3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `nama`, `deskripsi`, `lantai`) VALUES
(1, 'Ruang Kelas 1', 'Ruangan Kelas 1', 'Lantai 1'),
(3, 'Ruang Kelas 2', 'Ruangan Kelas 2', 'Lantai 1');

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
  `nama_siswa` varchar(255) NOT NULL,
  `foto_siswa` varchar(255) NOT NULL,
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

INSERT INTO `siswas` (`id`, `NISN`, `NIK`, `NO_KK`, `NIS`, `nama_siswa`, `foto_siswa`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `tempat`, `anak_ke`, `kelas_id`, `wali_siswa`, `semester`, `created_at`, `updated_at`) VALUES
(26, 111, 1234567890123456, 1234567890123456, 1234, 'Nur Azizah Rosidah', '1715702407.png', '2004-05-21', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 5, 'TITA AYU ROSPRICILIA', 'Semester 1', '2024-05-12 21:54:38', '2024-06-21 07:52:20'),
(27, 333, 1234567890123457, 1234567890123456, 1234, 'Riky Adam', '1715576613.png', '2024-05-13', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 5, 'Anita Hakim Nasution', 'Semester 1', '2024-05-12 22:03:33', '2024-06-21 07:52:26'),
(28, 222, NULL, NULL, NULL, 'Junada Deyastusesa', '1715939377.png', '2003-06-20', 'Laki', NULL, NULL, NULL, 10, 'Anita Hakim Nasution', 'Semester 1', '2024-05-12 22:04:50', '2024-06-21 06:47:38'),
(29, 444, NULL, NULL, NULL, 'Rayhan Alief', '1715837718.png', '2004-01-10', 'Laki', 'Islam', 'Surabaya', 1, 10, 'Samsul', 'Semester 1', '2024-05-15 22:35:18', '2024-06-21 06:47:38'),
(30, 555, NULL, NULL, NULL, 'Sandy', '1716138554.png', '2024-05-20', 'Laki', NULL, NULL, NULL, 10, 'Anita Hakim Nasution', 'Semester 1', '2024-05-19 10:09:15', '2024-06-21 06:47:38'),
(36, 3123123, 23123, 312313, 1234, 'Randi', '1718972944.PNG', '2024-05-21', 'Laki', 'Islam', 'Surabaya', 2, 10, 'Radianto', 'Semester 1', '2024-05-21 00:24:13', '2024-06-21 06:47:38'),
(37, 3123123123, 12321312312, 3212121212122, 1312312312, 'Saldo', '1718978757.png', '2024-06-21', 'Laki', 'islam', 'Surabaya', 2, 4, 'sdad', 'Semester 1', '2024-06-21 07:05:58', '2024-06-21 07:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ad@ad.ad', '2024-06-22 13:36:46', '1234', NULL, '', '2024-06-22 13:36:46', '2024-06-22 13:36:46'),
(2, 'Admin', 'admin@admin.com', '2024-06-22 13:47:46', '$2y$12$HGNFsRhNuwGiJPKz0hBpJOwsNMxeKHb9.W.Iw53VMEocO8y/B157e', NULL, 'admin', '2024-06-22 06:44:24', '2024-06-22 06:44:24'),
(3, 'Guru', 'guru@guru.com', NULL, '$2y$12$aGFZ1G/TfyV76K6hv9UxbemswTYH.UUX9Br8v8kpfkR8yfasEl2pi', NULL, 'guru', '2024-06-22 06:44:25', '2024-06-22 06:44:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_id_siswa_foreign` (`id_siswa`),
  ADD KEY `absensi_id_kelas_foreign` (`id_kelas`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_ruangan_id_foreign` (`ruangan_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `gurus_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_id_mapel_foreign` (`id_mapel`),
  ADD KEY `jadwal_id_guru_foreign` (`id_guru`),
  ADD KEY `jadwal_id_kelas_foreign` (`id_kelas`);

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
  ADD UNIQUE KEY `mata_pelajarans_kd_pelajaran_unique` (`kd_pelajaran`);

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
-- Indexes for table `prestasis`
--
ALTER TABLE `prestasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`NISN`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajarans_siswa_id_foreign` (`siswa_id`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestasis`
--
ALTER TABLE `prestasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwal_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `gurus` (`id`),
  ADD CONSTRAINT `jadwal_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`);

--
-- Constraints for table `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD CONSTRAINT `nilai_siswas_pelajaran_id_foreign` FOREIGN KEY (`pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
