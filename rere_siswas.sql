-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2024 pada 15.48
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

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`NISN`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD KEY `siswa_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswa_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
