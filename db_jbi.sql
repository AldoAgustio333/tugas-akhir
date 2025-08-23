-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 06:26 AM
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
-- Database: `db_jbi`
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
-- Table structure for table `jbis`
--

CREATE TABLE `jbis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keahlian` varchar(255) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `ketersediaan` varchar(255) NOT NULL,
  `jadwal` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `layanan` enum('Gratis','Berbayar') NOT NULL DEFAULT 'Gratis',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jbis`
--

INSERT INTO `jbis` (`id`, `nama`, `keahlian`, `jk`, `no_hp`, `ketersediaan`, `jadwal`, `alamat`, `foto`, `layanan`, `created_at`, `updated_at`) VALUES
(1, 'Aulia Azzahra', 'JBI Dengar', 'Perempuan', '081234567890', 'Tersedia', 'Senin - Jumat', 'Indo', '1750139997_jbi1.jpg', 'Berbayar', '2025-05-16 10:48:39', '2025-06-16 22:59:57'),
(2, 'Fadillah Riski Amelia', 'JBI Dengar', 'Perempuan', '082112345678', 'Tersedia', 'Setiap Hari', 'Indo', '1750140026_jbi2.jpg', 'Gratis', '2025-05-16 10:48:39', '2025-06-16 23:00:26'),
(3, 'Farin Alfarizi Hasbi', 'JBI Dengar', 'Laki-laki', '083812341234', 'Tersedia', 'Selasa & Kamis', 'Indo', '1750140049_jbi3.jpg', 'Gratis', '2025-05-16 10:48:39', '2025-06-16 23:00:49'),
(4, 'Meisi Maulida R.G, S.IP', 'JBI Dengar', 'Perempuan', '085766321321', 'Tersedia', 'Jumat - Minggu', 'Indo', '1750140091_jbi5.jpg', 'Gratis', '2025-05-16 10:48:39', '2025-06-16 23:01:31'),
(5, 'Rizki Geo Rivanda', 'JBI Dengar', 'Laki-laki', '081598765432', 'Tersedia', 'Senin - Kamis', 'Indo', '1750140112_jbi4.jpg', 'Gratis', '2025-05-16 10:48:39', '2025-06-16 23:01:52');

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
(5, '2025_05_16_071140_add_jk_hp_status_to_users_table', 2),
(6, '2025_05_16_090145_create_jbis_table', 3),
(7, '2025_05_16_174552_create_pemesanans_table', 4),
(8, '2025_05_17_024800_add_pembayaran_fields_to_pemesanans_table', 5),
(9, '2025_05_19_044112_update_pemesanans_add_jam_status', 6),
(10, '2025_06_03_032853_add_fields_to_users_table', 7),
(11, '2025_06_14_105530_create_testimoni_table', 8),
(12, '2025_06_14_123337_add_fakultas_prodi_kelas_to_users_table', 9),
(13, '2025_06_14_150008_add_foto_to_users_table', 10),
(14, '2025_06_15_073222_add_layanan_to_jbis_table', 11),
(15, '2025_06_17_083934_add_email_nohp_to_pemesanans_table', 12),
(16, '2025_06_17_084622_add_email_nohp_to_pemesanans_table', 13);

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
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jbi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `jenis_pembayaran` varchar(255) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `jam_awal` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `durasi_jam` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `jbi_id`, `nama_pemesan`, `email`, `no_hp`, `tanggal`, `deskripsi`, `created_at`, `updated_at`, `metode_pembayaran`, `jenis_pembayaran`, `bukti_pembayaran`, `jam_awal`, `jam_akhir`, `durasi_jam`, `biaya`, `status`) VALUES
(40, 1, 'Test User', 'user@gmail.com', '123123', '2025-06-17', 'asdasd', '2025-06-17 01:48:15', '2025-06-17 01:48:37', 'dana', 'e_wallet', '1750150117_7ed5954b9c730edb37bd463f044ddb2f.jpg', '15:42:00', '16:42:00', 1, 150000, 'pending'),
(41, 2, 'Test User', 'user@gmail.com', '123', '2025-06-17', 'asdasd', '2025-06-17 02:14:30', '2025-06-17 02:14:46', 'dana', 'e_wallet', '1750151686_7ed5954b9c730edb37bd463f044ddb2f.jpg', '16:14:00', '18:14:00', 2, 0, 'pending'),
(42, 3, 'Test User', 'admin@example.com', '123123123123', '2025-07-27', 'asdasd', '2025-07-26 21:28:42', '2025-07-26 21:28:42', NULL, NULL, NULL, '11:28:00', '13:28:00', 2, 0, 'pending');

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
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jbi_id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `review` text NOT NULL,
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
  `jk` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `npm` varchar(255) DEFAULT NULL,
  `fakultas` varchar(255) DEFAULT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `jk`, `no_hp`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `npm`, `fakultas`, `program_studi`, `kelas`, `foto`) VALUES
(1, 'Test User', 'test@example.com', 'laki laki', '08998778998723', 'Mahasiswa', '2025-05-13 18:51:44', '$2y$12$RVpGq65MR.WDW8Tue3vpDeoWLdoFSZKP/dgNaxga5beAlCJviUah.', 'w0IdFHQErtyQZLhmI0K54SYtYbZlNd5c8fgdKClwWQa3VVGC2Axf1xcCCMmk', '2025-05-13 18:51:45', '2025-06-14 08:10:44', 'user', '123456', 'teknik', 'SI', 'A', '1749913844_522e44b7a0fc0fa79c4bdae5092fd7382b74418c.jpg'),
(2, 'Admin', 'admin@example.com', 'Laki-laki', '12312321', 'Admin', '2025-05-19 01:59:13', '$2y$12$RVpGq65MR.WDW8Tue3vpDeoWLdoFSZKP/dgNaxga5beAlCJviUah.', NULL, '2025-05-13 18:51:45', '2025-06-14 21:51:01', 'admin', NULL, NULL, NULL, NULL, NULL),
(3, 'Ketua ULD', 'ketua@example.com', 'laki laki', '089987789987', 'Ketua ULD', '2025-05-19 01:59:18', '$2y$12$RVpGq65MR.WDW8Tue3vpDeoWLdoFSZKP/dgNaxga5beAlCJviUah.', NULL, '2025-05-13 18:51:45', '2025-05-13 18:51:45', 'ketua_uld', NULL, NULL, NULL, NULL, NULL),
(31, 'Tes Umum', 'tesumum@gmail.com', 'Laki-laki', '123123', 'umum', NULL, '$2y$12$RVpGq65MR.WDW8Tue3vpDeoWLdoFSZKP/dgNaxga5beAlCJviUah.', NULL, '2025-06-15 21:49:22', '2025-06-15 21:49:22', 'user', NULL, NULL, NULL, NULL, NULL),
(32, 'ndevss', 'ndev@gmail.com', 'Laki-laki', '123123', 'Mahasiswa', NULL, '$2y$12$gHFWtbfO3R5QlGa4CKYWx.SLDKEanIhiszz8p9.85aZHYFAhcLZIi', NULL, '2025-07-26 18:34:20', '2025-07-26 18:34:20', 'user', '12634126', 'stmik', 'ti', 'a', NULL);

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
-- Indexes for table `jbis`
--
ALTER TABLE `jbis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanans_jbi_id_foreign` (`jbi_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimoni_user_id_foreign` (`user_id`),
  ADD KEY `testimoni_jbi_id_foreign` (`jbi_id`),
  ADD KEY `testimoni_pemesanan_id_foreign` (`pemesanan_id`);

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
-- AUTO_INCREMENT for table `jbis`
--
ALTER TABLE `jbis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_jbi_id_foreign` FOREIGN KEY (`jbi_id`) REFERENCES `jbis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_jbi_id_foreign` FOREIGN KEY (`jbi_id`) REFERENCES `jbis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `testimoni_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `testimoni_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
