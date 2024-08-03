-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Agu 2024 pada 18.14
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
-- Database: `10-07-2024`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
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
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `id_siswa`, `id_kelas`, `date`, `status`, `catatan`, `foto_surat_izin`, `nama_guru`, `created_at`, `updated_at`) VALUES
(1, 26, 5, 'sabtu 2024-06-22', 'hadir', NULL, NULL, 'Santo', '2024-06-22 05:53:10', '2024-06-22 05:53:10'),
(2, 27, 5, 'sabtu 2024-06-22', 'izin', 'aaa', 'Riky Adam2024-08-01istockphoto-1348024232-612x612.jpg', 'Santo', '2024-06-22 05:53:13', '2024-08-01 09:45:02'),
(3, 36, 8, 'rabu 2024-07-03', 'izin', NULL, NULL, 'Cobaann', '2024-07-02 21:12:47', '2024-07-02 21:12:47'),
(4, 26, 5, 'rabu 2024-07-03', 'hadir', NULL, NULL, 'Santo', '2024-07-03 00:08:23', '2024-07-03 00:08:23'),
(7, 37, 4, 'jumat 2024-07-26', 'izin', NULL, NULL, 'Nami', '2024-07-26 07:07:43', '2024-07-26 07:07:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
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
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `barang_baik`, `barang_rusak`, `deskripsi`, `ruangan_id`) VALUES
(1, 'Kursi Siswa', 18, 2, 'Kaki Bangku Patah', 1);

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
-- Dumping data untuk tabel `gurus`
--

INSERT INTO `gurus` (`id`, `no_kk`, `nik`, `nomor_npwp`, `kelas_id`, `nama_guru`, `email`, `password`, `foto`, `agama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `gelar_depan`, `gelar_belakang`, `nomor_telepon`, `nomor_hp`, `jenjang`, `tahun_lulus`, `jurusan`, `jabatan`, `role`, `status`, `level`, `created_at`, `updated_at`) VALUES
(24, '1234567890987654', '1234567890987654', '1234567890987654', '13', 'Santo', 'santo@s.s', '$2y$12$Cfwa9Jg.zAA7CltjUK7ZveRODzJB1vKq.Cw88VVwiOFbhPJ0ovC46', '2024-07-16illustration-1.png', 'islam', 'laki laki', 'Surabaya', '2024-06-21', 'S.pd', 'S.Kom', '31293819238291', '31293819238291', 'S1', '2003', 'sasa}}', NULL, NULL, 'aktif', 'tata usaha', '2024-06-21 07:46:04', '2024-07-31 08:01:29'),
(25, '345345345', '535345345', '3456345345', '10', 'guru walikelas', 'guru@g.g', '$2y$12$rQ9aUaL2nF80.4bf0gFfTeRxC7lJfNh9rzoIe1m4bW3vey6sonX5yA', '2024-06-23Screenshot (42).png', 'kristen', 'laki laki', 'Surabaya', '2024-06-23', 'S.pd', 'S.Kom', '65465466', '45645645645', 'S1', '2008', 'sdasas', 'guru wali kelas', 'guru wali kelas', 'aktif', 'wali kelas', '2024-06-22 23:13:36', '2024-06-24 02:39:38'),
(27, '23423423', '42424234', '2132423', 'Masukkan kelas...', 'Guru 2', 'guru2@g.g', '$2y$12$8z4p106pERiCzcUHzMZlcOhT6juijFybzWzdxuk36ofmiGobQDrY.', '2024-06-23UBUNTU KU.PNG', 'Budha', 'laki laki', 'Surabaya', '2024-06-23', '42342', '424234', '214434', '3424234', '423424', '2008', '423424', 'Masukkan Jabatan / peran...', 'Masukkan Peran Pengguna...', 'aktif', 'guru mapel', '2024-06-23 00:19:03', '2024-06-23 00:19:03'),
(32, '1234567890987654', '1234567890987654', '1234567890987654', '4', 'Nami', 'nami@gmail.com', '$2y$12$rQ9aUaL2nF80.4bf0gFfTeRxC7lJfNh9rzoIe1m4bW3vey6sonX5y', '2024-07-14167f520c3390e5d57894a9bc098d5715.jpg', 'islam', 'laki laki', 'Sidoarjo', '1995-03-14', NULL, 'S.pd', '084564423236633', '084564423236633', 'Sarjana (S1)', '2011', 'Ilmu Pendidikan}}', 'guru', '\'orang tua\'', 'aktif', 'wali kelas', '2024-07-14 02:06:31', '2024-07-23 06:34:23'),
(33, '1234567890987654', '1234567890987654', '1234567890987654', '1', 'Tempe', 'tempe@gmail.com', '$2y$12$u0Bi6ZCMmPGGLlu5P8rGWOXd10ZG2Uu5UjI5W7dnLvUfAnph9FPq2', '2024-07-31af0ddaee-0b01-410c-8b78-72bd386cd6c6.png', 'kristen', 'perempuan', 'Sidoarjo', '2024-07-27', 'Spd', 'Ma', '3192381991', '291393891023', 'Magister (S2)', '2011', 'Ilmu Pendidikan}', 'guru', '\'orang tua\'', 'non aktif', 'wali kelas', '2024-07-31 01:05:11', '2024-07-31 04:37:08'),
(34, '1234567890987654', '1234567890987654', '1234567890987654', '5', 'yi', 'o@gmail.com', '$2y$12$5Pc5/DbJmf/6SkSaEZzuRuvBhN9UIXMjbh1efZmBq9DyEr40UKD2i', '2024-07-31FIX BACKGROUND (1).png', 'islam', 'laki laki', 'o', '2024-07-29', 'Spd', 'Ma', '02838192382', '27381923291', 'Sarjana (S1)', '2011', 'Ilmu Pendidikan', 'guru', '\'orang tua\'', 'aktif', 'tata usaha', '2024-07-31 01:11:00', '2024-07-31 01:11:00'),
(35, '1234567890987654', '1234567890987654', '1234567890987654', '7', 's', 's@s', '$2y$12$i1WoQweUYVXvYvF4Su/C4eEeZmTcDuashWblscV8Aak4uf0FAFrza', '2024-07-3169e6524209c437c07d7470a797f4360f67680a57181d1bf6c58cd0dc85f6c8cf.png', 'islam', 'perempuan', 'Surabaya', '2024-07-02', 'Dr', 'Ma', '083293971231', '083293971231', 'Magister (S2)', '2121', 'j', 'guru', '\'orang tua\'', 'aktif', 'wali kelas', '2024-07-31 07:27:09', '2024-07-31 07:27:09'),
(36, '1234567890987654', '1234567890987654', '1234567890987654', '6', 'kam', 'kam@gmail.com', '$2y$12$Cfwa9Jg.zAA7CltjUK7ZveRODzJB1vKq.Cw88VVwiOFbhPJ0ovC46', '2024-07-31LOGO UTAMA HMSI.png', 'islam', 'laki laki', '12', '2024-07-04', 'Dr', 'S.kom', '0821903812909', '0821903812909', '2ok', '2001', 'Pendidikan', 'guru', '\'orang tua\'', 'aktif', 'wali kelas', '2024-07-31 07:50:56', '2024-07-31 07:50:56'),
(37, '1234567890987368', '1234567890987368', '1234567890987368', '5', 's', 'ko@ks', '$2y$12$5TYcouBy.2tEeWCeBkiPDufLYYxdvEVaZrCjJ4eGUQiIU8V2ZS5rK', '2024-07-31—Pngtree—music player png overlay_7552664.png', 'islam', 'laki laki', 's', '2024-07-08', '1234567890987368', '1234567890987368', '123213213211', '123213213211', '1234567890987368', '2009', 'ss', 'guru', '\'orang tua\'', 'aktif', 'wali kelas', '2024-07-31 08:16:20', '2024-07-31 08:16:20'),
(38, '2', '1', '1', '5', 'a', '3@3', '$2y$12$kg08FvppROZpZECSpH/Ry.1IcbciJXT15FN8C5JcP2gKmf/I1mft2', '2024-08-01white-oversize-t-shirt-mockup-realistic-tshirt_34168-3440.avif', 'islam', 'laki laki', 'a', '2024-07-30', '3', '1', '2132131321', '2', '2', '2001', '2', 'guru', '\'orang tua\'', 'aktif', 'wali kelas', '2024-08-01 01:09:50', '2024-08-01 01:09:50');

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
(23, 2, 32, 1, '07:00', '07:30', '1', '2024-07-23 02:43:24', '2024-07-23 02:43:24', 'selasa'),
(25, 20, 33, 1, '07:00', '08:01', '1', '2024-07-31 03:28:09', '2024-07-31 03:28:09', 'selasa'),
(26, 3, 32, 4, '07:30', '08:00', '5', '2024-07-31 04:51:13', '2024-07-31 04:51:13', 'sabtu'),
(27, 3, 33, 1, '10:01', '16:00', '13', '2024-08-01 09:41:20', '2024-08-01 09:41:31', 'sabtu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `angka_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `angka_kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelas 1', '2024-04-14 02:02:53', '2024-04-14 02:02:53'),
(4, 2, 'Kelas 2', '2024-04-14 02:23:45', '2024-04-14 02:23:45'),
(5, 3, 'Kelas 3', '2024-04-14 03:21:40', '2024-04-14 03:21:40'),
(6, 4, 'Kelas 4', '2024-04-14 03:23:41', '2024-04-14 03:23:41'),
(7, 5, 'Kelas 5', '2024-04-14 03:27:11', '2024-04-14 03:27:11'),
(8, 6, 'Kelas 6', '2024-04-14 03:29:01', '2024-04-14 03:29:01'),
(10, 7, 'Alumni', NULL, NULL),
(12, 8, 'Untuk Guru Mapel', '2024-07-14 09:08:25', '2024-07-14 09:08:25'),
(13, 9, 'Untuk Kepala Sekolah', '2024-07-14 09:08:25', '2024-07-14 09:08:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `landing__pages`
--

CREATE TABLE `landing__pages` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `landing__pages`
--

INSERT INTO `landing__pages` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'daftar_button', 'on', '2024-07-31', '2024-07-31');

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
(1, 'IPS', 'Ilmu Pengetahuan Sosial', '2024-06-21 17:13:52', '2024-06-21 17:13:52'),
(2, 'BIND', 'Bahasa Indonesia', '2024-06-21 06:49:14', '2024-06-21 06:49:14'),
(3, 'MTK', 'Matematika', '2024-06-21 06:57:03', '2024-06-21 06:57:03'),
(20, 'MP02', 'Seni Budaya Alam', '2024-07-23 06:03:38', '2024-07-23 06:03:38'),
(21, '2w', 'tesw', '2024-07-31 03:00:15', '2024-07-31 03:00:21');

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
(13, '2024_05_29_065511_create_prestasis_table', 8),
(14, '2024_05_29_065923_create_ruangans_table', 9),
(16, '2024_05_29_070219_create_barangs_table', 10),
(17, '2024_06_21_073029_create_absensi_table', 11);

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
  `kategori` enum('uts','uas') DEFAULT NULL,
  `nilai` int(11) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT 'Tidak ada catatan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_siswas`
--

INSERT INTO `nilai_siswas` (`id`, `siswa_id`, `pelajaran_id`, `semester`, `tahun_ajaran`, `kategori`, `nilai`, `catatan`, `created_at`, `updated_at`) VALUES
(32, 26, 1, 'Semester 1', '2023 / 2024', 'uas', 55, 'Tidak ada catatan', '2024-06-30 01:02:15', '2024-07-31 02:51:02'),
(33, 26, 1, 'Semester 1', '2023 / 2024', 'uts', 86, 'Tidak ada catatan', '2024-06-30 01:04:13', '2024-06-30 01:04:13'),
(35, 26, 1, 'Semester 2', '2023 / 2024', 'uts', 88, 'Tidak ada catatan', '2024-06-30 01:40:53', '2024-06-30 01:40:53'),
(36, 26, 2, 'Semester 2', '2023 / 2024', 'uts', 98, 'Tidak ada catatan', '2024-07-01 22:58:53', '2024-07-01 22:58:53'),
(37, 26, 3, 'Semester 2', '2023 / 2024', 'uts', 89, 'Tidak ada catatan', '2024-07-01 22:59:09', '2024-07-01 22:59:09'),
(38, 36, 1, 'Semester 2', '2023 / 2024', 'uts', 88, 'Sudah Baik', '2024-07-02 07:35:56', '2024-07-02 22:16:08'),
(39, 36, 2, 'Semester 2', '2023 / 2024', 'uts', 80, 'Berkembang Cukup Baik', '2024-07-02 07:36:05', '2024-07-02 22:16:20'),
(40, 36, 3, 'Semester 2', '2023 / 2024', 'uts', 94, 'Tidak ada catatan', '2024-07-02 07:36:18', '2024-07-02 07:36:18'),
(41, 26, 1, 'Semester 2', '2015 / 2016', 'uts', 90, 'Tidak ada catatan', '2024-07-03 00:06:29', '2024-07-31 02:56:25'),
(42, 27, 1, 'Semester 2', '2023 / 2024', 'uts', 77, 'Tidak ada catatan', '2024-07-03 23:30:17', '2024-07-03 23:30:17'),
(43, 36, 3, 'Semester 2', '2022 / 2023', 'uts', 80, 'Tidak ada catatan', '2024-07-04 00:18:37', '2024-07-04 00:18:37'),
(44, 27, 2, 'Semester 2', '2023 / 2024', 'uts', 80, 'Tidak ada catatan', '2024-07-04 06:28:50', '2024-07-04 06:28:50');

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
(8, 3321, 36, 'Januari', '2024', 200000.00, '1716276450.png', 'Lunas', NULL, '2024-05-21 00:27:30', '2024-05-21 00:27:30'),
(9, 124545, 37, 'Maret', '2024', 200000.00, '1718988838.png', 'Lunas', NULL, '2024-06-21 09:53:58', '2024-06-21 09:53:58'),
(10, 112, 29, 'Januari', '2010', 250.00, '1722416189.png', 'Lunas', NULL, '2024-07-31 01:56:29', '2024-07-31 01:56:29'),
(11, 445, 26, 'Januari', '2010', 265.00, '1722530024.png', 'Lunas', NULL, '2024-08-01 09:33:44', '2024-08-01 09:33:44');

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
-- Struktur dari tabel `prestasis`
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
  `dokumentasi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dokumentasi`)),
  `status` varchar(25) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasis`
--

INSERT INTO `prestasis` (`id`, `gambar_thumbnail`, `gambar_prestasi`, `nama_prestasi`, `anggota`, `tingkat`, `tgl_prestasi`, `deskripsi`, `dokumentasi`, `status`) VALUES
(1, '1716967119_IMG-20220216-WA0035.jpg', '1716967119_uSER.jpg', 'Juara 1 Web', 'Sandi, Ridho', 'Nasional', '2024-05-01', 'Menang Yeayy', '[\"1716967119_hand-painted-watercolor-background-with-sky-clouds-shape.jpg\"]', 'on'),
(3, '1722417096_—Pngtree—music player png overlay_7552664.png', '1722417096_167f520c3390e5d57894a9bc098d5715.jpg', 'Lomba Mukbang', 'Agus, Narni, Kamsul', 'Kabupaten/Kota', '2024-07-10', 'GG', '[\"1722417096_2d24e681965acef858f7b89db68bbfa30b866147ca089a5406284ddcfd68aab3.png\",\"1722417096_69e6524209c437c07d7470a797f4360f67680a57181d1bf6c58cd0dc85f6c8cf.png\",\"1722417096_\\u2014Pngtree\\u2014music player png overlay_7552664.png\"]', 'on'),
(4, '1722503768_—Pngtree—music player png overlay_7552664.png', '1722503768_istockphoto-1429527285-170667a.jpg', 'Lomb Em Els', 'Ripki, Riski,s', 'Provinsi', '2024-01-01', 'Lomba Emels', '[\"1722530206_2d24e681965acef858f7b89db68bbfa30b866147ca089a5406284ddcfd68aab3.png\",\"1722530206_69e6524209c437c07d7470a797f4360f67680a57181d1bf6c58cd0dc85f6c8cf.png\"]', 'on');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lantai` enum('Lantai 1','Lantai 2','Lantai 3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangans`
--

INSERT INTO `ruangans` (`id`, `nama`, `deskripsi`, `lantai`) VALUES
(1, 'Ruang Kelas 111', 'Ruangan Kelas 1', 'Lantai 1'),
(3, 'Ruang Kelas 2', 'Ruangan Kelas 2', 'Lantai 1');

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
  `nama_siswa` varchar(255) NOT NULL,
  `foto_siswa` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki','Perempuan') NOT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `anak_ke` int(16) DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `wali_siswa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `semester` enum('Semester 1','Semester 2','','') NOT NULL DEFAULT 'Semester 1',
  `level` varchar(255) NOT NULL DEFAULT 'wali murid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `NISN`, `NIK`, `NO_KK`, `NIS`, `nama_siswa`, `foto_siswa`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `tempat`, `anak_ke`, `kelas_id`, `wali_siswa`, `email`, `password`, `semester`, `level`, `created_at`, `updated_at`) VALUES
(26, 111, 1234567890123456, 1234567890123456, 1234, 'Nur Azizah Rosidah', '1715702407.png', '2004-05-21', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 4, 'TITA AYU ROSPRICILIA', '', '', 'Semester 1', 'wali murid', '2024-05-12 21:54:38', '2024-08-01 09:22:47'),
(27, 333, 1234567890123457, 1234567890123456, 1234, 'Riky Adam', '1715576613.png', '2024-05-13', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 1, 4, 'Anita Hakim Nasution', '', '', 'Semester 1', 'wali murid', '2024-05-12 22:03:33', '2024-08-01 09:22:47'),
(30, NULL, NULL, NULL, NULL, 'Sandy', '1716138554.png', '2024-05-20', 'Laki', NULL, NULL, NULL, 10, 'Anita Hakim Nasution', '', '', 'Semester 1', 'wali murid', '2024-05-19 10:09:15', '2024-08-01 09:22:47'),
(36, 3123123, 23123, 312313, 1234, 'Randi', '1718972944.PNG', '2024-05-21', 'Laki', 'Masukkan Data Agama...', 'Surabaya', 2, 10, 'Radianto', '', '', 'Semester 1', 'wali murid', '2024-05-21 00:24:13', '2024-08-01 09:22:47'),
(37, 3123123123, 12321312312, 3212121212122, 1312312312, 'Saldo', '1718978757.png', '2024-06-21', 'Laki', 'islam', 'Surabaya', 2, 5, 'sdad', 'aku@aku', 'password', 'Semester 1', 'wali murid', '2024-06-21 07:05:58', '2024-08-01 09:22:47'),
(52, NULL, 28, 289, NULL, '11', 'none', '2024-01-01', 'Laki', 'islam', 'q', 1, 12, 'angkel mutu', '4@4', '$2y$12$3kcQQd3Agq35KF5Vk9wVPO3juk.OLrB/y8p3pP9HVhehRMCHHT28e', 'Semester 2', 'wali murid', '2024-08-01 01:36:23', '2024-08-01 09:22:47'),
(53, NULL, 2132193, 213, NULL, 'hh', 'none', '2024-01-01', 'Laki', 'islam', '1', 1, 12, 'q', '5@5', '$2y$12$0lSPqoG4nS3j4ET36.3q7O3DA0VYrRM1sGaHT336VTPLdJcPsYzou', 'Semester 2', 'wali murid', '2024-08-01 02:09:57', '2024-08-01 09:22:47'),
(57, NULL, 8219, 3291, NULL, 'GG', 'none', '2024-01-01', 'Laki', 'islam', 'q', 1, 12, 'q', 'a@a', '$2y$12$xjCFsbbjutoYJV1p5Jseeevkn5AaU5zAM5yTrIAxSlBiFJJdONFX.', 'Semester 1', 'wali murid', '2024-08-01 09:52:22', '2024-08-01 09:52:22');

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
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ad@ad.ad', '2024-06-22 13:36:46', '1234', NULL, '', '2024-06-22 13:36:46', '2024-06-22 13:36:46'),
(2, 'Admin', 'admin@admin.com', '2024-06-22 13:47:46', '$2y$12$HGNFsRhNuwGiJPKz0hBpJOwsNMxeKHb9.W.Iw53VMEocO8y/B157e', NULL, 'admin', '2024-06-22 06:44:24', '2024-06-22 06:44:24'),
(3, 'Guru', 'guru@guru.com', NULL, '$2y$12$aGFZ1G/TfyV76K6hv9UxbemswTYH.UUX9Br8v8kpfkR8yfasEl2pi', NULL, 'guru', '2024-06-22 06:44:25', '2024-06-22 06:44:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_id_siswa_foreign` (`id_siswa`),
  ADD KEY `absensi_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_ruangan_id_foreign` (`ruangan_id`);

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
-- Indeks untuk tabel `landing__pages`
--
ALTER TABLE `landing__pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_pelajarans_kd_pelajaran_unique` (`kd_pelajaran`);

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
-- Indeks untuk tabel `prestasis`
--
ALTER TABLE `prestasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `landing__pages`
--
ALTER TABLE `landing__pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_spps`
--
ALTER TABLE `pembayaran_spps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasis`
--
ALTER TABLE `prestasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwal_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `gurus` (`id`),
  ADD CONSTRAINT `jadwal_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajarans` (`id`);

--
-- Ketidakleluasaan untuk tabel `nilai_siswas`
--
ALTER TABLE `nilai_siswas`
  ADD CONSTRAINT `nilai_siswas_pelajaran_id_foreign` FOREIGN KEY (`pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
