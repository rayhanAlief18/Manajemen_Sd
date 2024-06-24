-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2024 pada 16.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clone_new_bhayangkari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('hadir','tidak hadir','izin','sakit') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan` varchar(255) NOT NULL DEFAULT 'guru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `no_kk` varchar(16) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `nomor_npwp` varchar(255) DEFAULT NULL,
  `gelar_depan` varchar(255) DEFAULT NULL,
  `gelar_belakang` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'orang tua',
  `status` varchar(255) DEFAULT 'non aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gurus`
--

INSERT INTO `gurus` (`id`, `foto`, `nama_guru`, `kelas_id`, `jabatan`, `created_at`, `updated_at`, `tempat_lahir`, `tanggal_lahir`, `nik`, `no_kk`, `agama`, `jenis_kelamin`, `nomor_npwp`, `gelar_depan`, `gelar_belakang`, `nomor_telepon`, `nomor_hp`, `jenjang`, `tahun_lulus`, `jurusan`, `role`, `status`) VALUES
(23, '2024-05-29WhatsApp Image 2024-05-07 at 11.58.15.jpeg', 'El Rere Alief', 1, 'guru wali kelas', '2024-05-28 23:04:41', '2024-05-29 07:36:39', 'Sidoarjo', '2003-02-18', '1234567890987654', '1234567890987654', 'islam', 'laki laki', '1234567890987654', 'Dr', 'S.kom', '1234567890987654', '1234567890987654', 'Sarjana', '2010', 'Sistem Informasi', 'guru wali kelas', 'aktif'),
(24, '2024-05-29albert-einstein-sticks-out-his-tongue-when-asked-by-news-photo-1681316749.jpg', 'Albert Eindank', 4, 'guru wali kelas', '2024-05-29 07:50:27', '2024-05-29 07:50:27', 'Ulm', '1879-03-14', '1234567890987654', '1234567890987654', 'islam', 'laki laki', '1234567890987654', 'Dr', 'M.a', '08216381291', '08216381291', 'Doctor', '2010', 'Peternakan', 'guru wali kelas', 'aktif'),
(25, '2024-05-29WhatsApp Image 2022-12-28 at 14.49.20.jpeg', 'Farhan Meilano', 5, 'guru wali kelas', '2024-05-29 07:59:00', '2024-05-29 07:59:00', 'Malang', '2003-01-18', '1234567890987654', '1234567890987654', 'islam', 'laki laki', '1234567890987654', '-', 'S.kom', '0823402221029', '08223271821', 'Sarjana (S1)', '2012', 'Sistem Informasi', 'guru wali kelas', 'aktif'),
(26, '2024-05-29tatiana-pavlova-per9OnmAp-I-unsplash.jpg', 'Robert Kamsari', 6, 'guru wali kelas', '2024-05-29 08:02:47', '2024-05-29 08:02:47', 'London', '2001-12-21', '1234567890987654', '1234567890987654', 'kristen', 'laki laki', '1234567890987654', '-', 'S.pd', '1234567890987654', '1234567890987654', 'Sarjana (S1)', '2012', 'Ilmu Pendidikan', 'guru wali kelas', 'aktif'),
(27, '2024-05-29yoshikage.png', 'Kira Queen', 7, 'guru wali kelas', '2024-05-29 08:04:37', '2024-05-29 08:04:37', 'Morioo', '1990-02-21', '1234567890987654', '1234567890987654', 'hindu', 'laki laki', '1234567890987654', '-', 'M.pd', '1234567890987654', '1234567890987654', 'Magister (S2)', '2011', 'Ilmu Pendidikan', 'guru wali kelas', 'aktif'),
(28, '2024-05-29download.jfif', 'Emi Fatima', 8, 'guru wali kelas', '2024-05-29 08:31:51', '2024-05-29 08:31:51', 'Surabaya', '2001-02-18', '1234567890987654', '1234567890987654', 'islam', 'perempuan', '1234567890987654', '-', 'S.pd', '1234567890987654', '1234567890987654', 'Sarjana (S1)', '2011', 'Ilmu Pendidikan', 'guru wali kelas', 'aktif'),
(29, '2024-05-29gojo.jpg', 'Gojo Satoruu', 11, 'kepala sekolah', '2024-05-29 08:44:27', '2024-05-29 08:44:27', 'Tokyo', '2001-02-12', '1234567890987654', '1234567890987654', 'islam', 'laki laki', '1234567890987654', 'Doctor', 'M.pd', '1234567890987654', '1234567890987654', 'Doctor (S3)', '2012', 'Ilmu Pendidikan', 'kepala sekolah', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwals`
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
-- Dumping data untuk tabel `jadwals`
--

INSERT INTO `jadwals` (`id`, `id_mapel`, `id_guru`, `id_kelas`, `jam_mulai`, `jam_selesai`, `jumlah_sesi`, `created_at`, `updated_at`, `hari`) VALUES
(13, 2, 23, 1, '06:45', '07:55', '2', '2024-05-30 10:42:26', '2024-06-03 09:19:32', 'senin'),
(15, 4, 23, 1, '06:45', '07:25', '1', '2024-05-30 11:08:26', '2024-05-30 11:08:26', 'jumat'),
(16, 4, 23, 1, '06:45', '07:25', '1', '2024-05-30 11:09:09', '2024-05-30 11:09:09', 'kamis'),
(17, 4, 23, 1, '06:45', '07:20', '1', '2024-06-03 09:13:34', '2024-06-03 09:13:34', 'selasa'),
(18, 3, 23, 1, '07:55', '08:30', '1', '2024-06-03 09:22:53', '2024-06-03 09:22:53', 'senin'),
(19, 3, 23, 1, '08:00', '08:25', '1', '2024-06-21 00:03:00', '2024-06-21 00:03:00', 'jumat'),
(20, 2, 24, 4, '07:00', '07:25', '1', '2024-06-21 03:09:49', '2024-06-21 03:09:49', 'jumat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `angka_kelas` int(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `angka_kelas`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-04-14 02:02:53', '2024-04-14 02:02:53'),
(4, 2, '2024-04-14 02:23:45', '2024-04-14 02:23:45'),
(5, 3, '2024-04-14 03:21:40', '2024-04-14 03:21:40'),
(6, 4, '2024-04-14 03:23:41', '2024-04-14 03:23:41'),
(7, 5, '2024-04-14 03:27:11', '2024-04-14 03:27:11'),
(8, 6, '2024-04-14 03:29:01', '2024-04-14 03:29:01'),
(10, 7, '2024-05-01 07:41:04', '2024-05-02 07:41:20'),
(11, 8, '2024-05-29 00:00:28', '2024-05-29 00:00:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_pelajaran` varchar(255) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `kd_pelajaran`, `nama_pelajaran`, `created_at`, `updated_at`) VALUES
(2, 'MP01', 'Bahasa Indonesia', '2024-05-29 11:13:00', '2024-05-29 11:13:00'),
(3, 'MP02', 'Matematika', '2024-05-29 11:23:09', '2024-05-29 11:23:09'),
(4, 'MP03', 'Kewarga negaraan (PKN)', '2024-05-29 11:26:06', '2024-05-29 11:26:06'),
(5, 'MP04', 'Ilmu Pengetahuan Alam', '2024-05-29 11:33:31', '2024-05-29 11:33:31'),
(6, 'MP05', 'Ilmu Pengetahuan Sosial (IPS)', '2024-05-29 11:36:00', '2024-05-29 11:36:00'),
(7, 'MP06', 'Agama dan Budi Pekerti', '2024-05-29 11:42:30', '2024-05-29 11:42:30'),
(8, 'MP07', 'Seni Budaya', '2024-05-29 11:42:50', '2024-05-29 11:42:50'),
(9, 'MP08', 'Pendidikan Jasmani dan Kesehatan', '2024-05-29 11:43:23', '2024-05-29 11:43:23'),
(10, 'MP09', 'Bahasa Inggris', '2024-05-29 11:43:34', '2024-05-29 11:43:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(13, '2024_05_21_164008_create_tahun_ajarans_table', 8),
(14, '2024_05_29_035501_add_many_column_to_guru_table', 9),
(16, '2024_06_21_073029_create_absensi_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_siswas`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_spps`
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
-- Dumping data untuk tabel `pembayaran_spps`
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
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `siswas`
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
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `NISN`, `NIK`, `NO_KK`, `NIS`, `foto_siswa`, `nama_siswa`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `tempat`, `anak_ke`, `kelas_id`, `wali_siswa`, `semester`, `created_at`, `updated_at`) VALUES
(26, 111, 1234567890123456, 1234567890123456, 1234, '1715702407.png', 'Nur Azizah Rosidah', '2004-05-21', 'Perempuan', 'Masukkan Data Agama...', 'Surabaya', 1, 1, 'TITA AYU ROSPRICILIA', 'Semester 2', '2024-05-12 21:54:38', '2024-05-29 09:11:50'),
(27, 333, 1234567890123457, 1234567890123456, 1234, '1715576613.png', 'Riky Adam', '2024-05-13', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 4, 'Anita Hakim Nasution', 'Semester 2', '2024-05-12 22:03:33', '2024-05-29 09:09:33'),
(28, 222, 123456789098765, 123456789098765, 1234, '1716998695.png', 'Junada Deyastusesa', '2003-06-20', 'Laki', 'islam', 'Ngawieh', 1, 5, 'Anita Hakim Nasution', 'Semester 2', '2024-05-12 22:04:50', '2024-05-29 09:09:38'),
(29, 444, 12345678909812332, 1234567890987112, 1255, '1715837718.png', 'Rayhan Alief', '2004-01-10', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 6, 'Samsul', 'Semester 2', '2024-05-15 22:35:18', '2024-05-29 09:10:52'),
(30, 555, 1234567890987122, 123456789098765, 2312, '1716999102.png', 'Sandy', '2024-05-20', 'Laki', 'Masukkan Data Agama...', 'Gresik', 1, 7, 'Anita Hakim Nasution', 'Semester 2', '2024-05-19 10:09:15', '2024-05-29 09:11:42'),
(36, 3123123, 23123, 312313, 1234, '1716999072.jpg', 'Randi', '2024-05-21', 'Laki', 'islam', 'Surabaya', 2, 8, 'Radianto', 'Semester 2', '2024-05-21 00:24:13', '2024-05-29 09:11:12'),
(37, 2839, 1234567890927384, 1234567890927384, 9348, '1718964394.png', 'Rey Situ', '2024-06-06', 'Laki', 'islam', 'Gubeng', 1, 1, 'Wina', 'Semester 1', '2024-06-21 03:06:34', '2024-06-21 03:06:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajarans`
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
-- Struktur dari tabel `users`
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
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_id_siswa_foreign` (`id_siswa`),
  ADD KEY `absensi_id_kelas_foreign` (`id_kelas`),
  ADD KEY `absensi_id_guru_foreign` (`id_guru`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gurus_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_id_mapel_foreign` (`id_mapel`),
  ADD KEY `jadwal_id_guru_foreign` (`id_guru`),
  ADD KEY `jadwal_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_siswas_siswa_id_foreign` (`siswa_id`),
  ADD KEY `nilai_siswas_pelajaran_id_foreign` (`pelajaran_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayaran_spps_kd_bayar_unique` (`kd_bayar`),
  ADD KEY `pembayaran_spps_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`NISN`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajarans_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwal_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `gurus` (`id`),
  ADD CONSTRAINT `jadwal_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD CONSTRAINT `mata_pelajarans_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD CONSTRAINT `nilai_siswas_pelajaran_id_foreign` FOREIGN KEY (`pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  ADD CONSTRAINT `pembayaran_spps_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Ketidakleluasaan untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD CONSTRAINT `tahun_ajarans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
