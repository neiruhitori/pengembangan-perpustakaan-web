-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Apr 2024 pada 14.52
-- Versi server: 8.0.30
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_16_073851_create_peminjaman_table', 1),
(6, '2024_04_21_075607_add_kodebuku_to_peminjaman_table', 2),
(7, '2024_04_21_085212_create_peminjamantahunan_table', 3),
(8, '2024_04_21_091436_modify_jam_to_peminjamantahunan_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pinjam` datetime NOT NULL,
  `jam_kembali` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kodebuku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `name`, `kelas`, `buku`, `jml_buku`, `jam_pinjam`, `jam_kembali`, `description`, `status`, `created_at`, `updated_at`, `kodebuku`) VALUES
(1, 'Si A', '8 A', 'IPA', '20', '2024-03-24 04:07:00', '2024-03-24 07:07:00', NULL, 0, '2024-03-23 14:07:28', '2024-03-23 14:08:38', NULL),
(2, 'Si B', '8 B', 'IPS', '20', '2024-03-24 07:07:00', '2024-03-24 10:07:00', NULL, 0, '2024-03-23 14:07:53', '2024-03-24 01:22:53', NULL),
(3, 'Si C', '8 C', 'Bahasa Indonesia', '21', '2024-03-24 15:55:00', '2024-03-24 18:55:00', NULL, 0, '2024-03-24 01:55:38', '2024-03-25 04:10:49', NULL),
(4, 'Si D', '8 D', 'Matematika', '14', '2024-03-24 15:56:00', '2024-03-24 19:56:00', NULL, 0, '2024-03-24 01:56:05', '2024-03-25 21:05:46', NULL),
(5, 'Si E', '8 E', 'IPA', '20', '2024-03-24 16:01:00', '2024-03-24 19:01:00', NULL, 0, '2024-03-24 02:01:37', '2024-03-25 21:22:10', NULL),
(6, 'Si F', '8 F', 'IPS', '14', '2024-03-24 16:02:00', '2024-03-24 20:02:00', NULL, 0, '2024-03-24 02:02:15', '2024-03-26 03:54:43', NULL),
(7, 'Si G', '8 G', 'Bahasa Indonesia', '20', '2024-03-24 16:02:00', '2024-03-24 19:02:00', NULL, 0, '2024-03-24 02:02:54', '2024-03-26 03:54:58', NULL),
(11, 'Anak A', '9 A', 'Matematika', '21', '2024-03-26 18:08:00', '2024-03-26 20:08:00', 'asjfvjkasbvfuysdbfjh', 1, '2024-03-26 04:08:58', '2024-03-26 04:09:36', NULL),
(13, 'Ahmed', '9 C', 'Matematika', '20', '2024-04-21 15:23:00', '2024-04-21 19:28:00', 'Baru', 1, '2024-04-21 01:23:26', '2024-04-21 01:24:06', 'hcbfvkjhdsg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamantahunan`
--

CREATE TABLE `peminjamantahunan` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pinjam` date NOT NULL,
  `jam_kembali` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kodebuku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjamantahunan`
--

INSERT INTO `peminjamantahunan` (`id`, `name`, `kelas`, `buku`, `jml_buku`, `jam_pinjam`, `jam_kembali`, `description`, `status`, `created_at`, `updated_at`, `kodebuku`) VALUES
(1, 'Nailul Maqsudi', 'Teknologi Informasi', 'Basis Data', '1', '2024-04-21', '2025-04-21', 'Yaa', 0, '2024-04-21 02:52:38', '2024-04-21 04:07:45', 'jkshdbfahsf'),
(3, 'Sayyuf', 'Teknologi Informasi', 'Basis Data', '1', '2024-04-21', '2025-04-21', 'p', 1, '2024-04-21 04:37:52', '2024-04-21 04:37:52', 'kajshdfbvkahj');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photoProfile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nis`, `name`, `email`, `password`, `photoProfile`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2131740037, 'Admin', 'admin@gmail.com', '$2y$10$U7tZhsKI4cr6hisTiFAoLO3T.c8ftQxMke3pjSndPPOTsLgD/U792', '1711426902.png', NULL, '2024-03-23 14:06:42', '2024-03-26 04:07:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjamantahunan`
--
ALTER TABLE `peminjamantahunan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nis_unique` (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `peminjamantahunan`
--
ALTER TABLE `peminjamantahunan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
