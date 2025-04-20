-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Apr 2025 pada 12.42
-- Versi server: 8.0.30
-- Versi PHP: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngondanginn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 'Maaf Min, kalau nggak punya foto, apakah masih bisa buat undangan digital Ngondang-In?', 'Tentu saja bisa Kak :) Kalau nggak ada foto, kita bisa tetap bikin undangan digital yang keren untuk Kakak. Kita bisa pakai karakter animasi dan inisial nama Kakak dan pasangan biar undangannya tetap tampil istimewa dan personal!', '2025-02-19 04:28:44', '2025-02-19 04:28:44'),
(2, 'Min, mau tanya nih, berapa lama masa aktif undangan digitalnya?', 'Untuk masa aktif undangan digitalnya selama 1 tahun ya Kak, jadi Kakak punya banyak waktu untuk menyebarkannya ke semua tamu undangan. ', '2025-02-19 04:28:44', '2025-02-19 04:28:44'),
(3, 'Min, untuk fitur yang tidak digunakan, apakah bisa dihapus dari undangannya?', 'Bisa banget Kak! 😊 Nanti tinggal dinote fitur apa yang ingin dihapus dari undangannya, dan kami akan sesuaikan sesuai dengan permintaan Kakak.', '2025-02-19 04:28:44', '2025-02-19 04:28:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `galleries`
--

INSERT INTO `galleries` (`id`, `wedding_id`, `image`, `created_at`, `updated_at`) VALUES
(6, 9, 'uploads/galeri/6804e3acdc87c.jpg', '2025-04-20 12:08:12', '2025-04-20 12:08:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guest_books`
--

CREATE TABLE `guest_books` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `guest_books`
--

INSERT INTO `guest_books` (`id`, `wedding_id`, `name`, `message`, `created_at`, `updated_at`) VALUES
(31, 9, 'yuni widya', 'ciieeee selamat yach gaesss...sing samawa yach', '2025-04-20 12:08:57', '2025-04-20 12:08:57'),
(32, 9, 'boedi x', 'sukses selalu menempuh keluarga baru, gassssss', '2025-04-20 12:10:20', '2025-04-20 12:10:20'),
(33, 9, 'iepinnxxx', 'samawa bosssquuu, sing langgeng yach gaeessss', '2025-04-20 12:12:28', '2025-04-20 12:12:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(7, '2025_04_07_150209_create_rsvps_table', 1),
(8, '2025_04_07_150311_create_guest_books_table', 1),
(9, '2025_04_07_150356_create_galleries_table', 1),
(10, '2025_04_12_115028_create_faqs_table', 2),
(12, '2025_04_07_140453_create_templates_table', 4),
(15, '2025_04_07_140534_create_musics_table', 7),
(23, '2025_04_07_140535_create_orders_table', 9),
(24, '2025_04_07_150000_create_weddings_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `musics`
--

CREATE TABLE `musics` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `musics`
--

INSERT INTO `musics` (`id`, `title`, `artist`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Make it Right', 'Peraukertas', 'uploads/musik/67fd037c15a15.mp3', '2025-04-14 05:45:48', '2025-04-14 05:45:48'),
(2, 'Menikah Denganku', 'By The Hundreds', 'uploads/musik/67fe3c275c2dd.mp3', '2025-04-15 03:59:51', '2025-04-15 03:59:51'),
(3, 'Wanitaku', 'NOAH', 'uploads/musik/68047bc8eba1c.mp3', '2025-04-20 04:44:56', '2025-04-20 04:44:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `payment_total` bigint UNSIGNED NOT NULL DEFAULT '0',
  `payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','waiting_verify','paid','processed','published','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `kode_transaksi`, `nama_pemesan`, `phone_number`, `payment_total`, `payment_proof`, `status`, `created_at`, `updated_at`) VALUES
(10, 'WD_ORDER_6804E2622F972', 'Ananda Rizky MM', '082215148544', 110000, 'uploads/payment_proof/6804e31f0b1d7.jpeg', 'completed', '2025-04-20 12:02:42', '2025-04-20 12:13:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rsvps`
--

CREATE TABLE `rsvps` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `attendance` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `rsvps`
--

INSERT INTO `rsvps` (`id`, `wedding_id`, `name`, `attendance`, `reason`, `created_at`, `updated_at`) VALUES
(31, 9, 'yuni widya', 'yes', NULL, '2025-04-20 12:08:57', '2025-04-20 12:08:57'),
(32, 9, 'boedi x', 'no', 'maaf saya belum bisa hadir karena ada proyek cinta gaess. yang penting do\'a nya perfect ya, nuhun', '2025-04-20 12:10:20', '2025-04-20 12:10:20'),
(33, 9, 'iepinnxxx', 'yes', NULL, '2025-04-20 12:12:28', '2025-04-20 12:12:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LZIdbjHmU0CoAwCztJ40jIyWdJ5opQ0PuB5ps7mO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkc2NFlDMDFoQlhmb3JLNkVLTUlxalpTMGhQM3pMV09HZFVoajliWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9uZ29uZGFuZ2lubi50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1745144530),
('NJhTDhwYy1tUjB1bASkuRuvdIkvcAWjSY2ifAj3z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFRKaVY3cFZrMFZOc01kUW1PdDJSNXZnQm43UmNGU2V5Q3p2MW9mbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9uZ29uZGFuZ2lubi50ZXN0L2xvZ2luIjt9fQ==', 1745152570),
('nyKWKNGmTWYDwHDoQJwTtKA2GbdXciGAvmAa2Pfx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkMyWlV6a3VCTnhuR1hPMENrS01sSnNOTG1GNVJ0T2Y0T2lPaTJVNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9uZ29uZGFuZ2lubi50ZXN0L2Nlay1wZXNhbmFuL1dEX09SREVSXzY4MDRFMjYyMkY5NzIvcmVzdWx0Ijt9fQ==', 1745151214);

-- --------------------------------------------------------

--
-- Struktur dari tabel `templates`
--

CREATE TABLE `templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `preview_image` varchar(255) NOT NULL,
  `view_path` varchar(255) NOT NULL,
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `templates`
--

INSERT INTO `templates` (`id`, `name`, `preview_image`, `view_path`, `price`, `created_at`, `updated_at`) VALUES
(5, 'Spesial 01', 'bc93a010-8be7-4d27-bb18-449fad70b1f7.jpg', 'template_packs.pre_design.spesial-01', 150000, '2025-04-15 14:51:40', '2025-04-15 14:52:05'),
(6, 'Spesial 02', '00d2c7aa-b720-429b-818d-117082bbcb4d.jpg', 'template_packs.pre_design.spesial-02', 110000, '2025-04-15 14:52:28', '2025-04-15 14:52:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Agung Soetedjo', 'agungsoetedjo@gmail.com', NULL, '$2y$12$2Hr3GawDJJr7XSOKcUssv.qCFA95fgm5yqm/FH6Yb0OKcnOmcEugi', NULL, '2025-04-07 09:03:13', '2025-04-07 09:03:13'),
(4, 'Rafi Fauzi', 'rafifauzi@gmail.com', NULL, '$2y$12$z2ONIowo9fN2Ju817mokC.nRLKJbeqgeqN43WEvGEJ6MsQpHKKxZK', NULL, '2025-04-16 10:54:34', '2025-04-16 10:54:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `weddings`
--

CREATE TABLE `weddings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `groom_name` varchar(255) NOT NULL,
  `bride_parents_info` varchar(255) DEFAULT NULL,
  `groom_parents_info` varchar(255) DEFAULT NULL,
  `akad_date` datetime DEFAULT NULL,
  `reception_date` datetime DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `place_name` varchar(255) DEFAULT NULL,
  `description` text,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `music_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `weddings`
--

INSERT INTO `weddings` (`id`, `user_id`, `slug`, `bride_name`, `groom_name`, `bride_parents_info`, `groom_parents_info`, `akad_date`, `reception_date`, `location`, `place_name`, `description`, `template_id`, `music_id`, `order_id`, `created_at`, `updated_at`) VALUES
(9, 4, 'adinda-syafitri-ananda-rizky-mm-jhxak', 'Adinda Syafitri', 'Ananda Rizky MM', 'Putri pertama dari Bpk. Wawan dan Ibu. Irma', 'Putra pertama dari Bpk. Rizal dan Ibu Mimin', '2025-04-27 09:00:00', '2025-04-27 11:00:00', 'Jln. Sukamiskin No. 555 Bandung', 'Gedung Serba Guna Mandiri Sejahtera', 'Kisah cinta kami berawal sejak masih di bangku kuliah dan pertamakali saya bertemu sudah seperti jodoh sejak kecil hihi. Dan akhirnya kami berdua memutuskan untuk lanjut menikah tanpa proses lamaran dulu karena kita berdua sudah saling mencintai ihiiwww.', 6, 2, 10, '2025-04-20 12:02:42', '2025-04-20 12:05:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_wedding_id_foreign` (`wedding_id`);

--
-- Indeks untuk tabel `guest_books`
--
ALTER TABLE `guest_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guest_books_wedding_id_foreign` (`wedding_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rsvps_wedding_id_foreign` (`wedding_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `weddings`
--
ALTER TABLE `weddings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `weddings_slug_unique` (`slug`),
  ADD KEY `weddings_user_id_foreign` (`user_id`),
  ADD KEY `weddings_template_id_foreign` (`template_id`),
  ADD KEY `weddings_music_id_foreign` (`music_id`),
  ADD KEY `weddings_order_id_foreign` (`order_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `guest_books`
--
ALTER TABLE `guest_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `musics`
--
ALTER TABLE `musics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `weddings`
--
ALTER TABLE `weddings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_wedding_id_foreign` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `guest_books`
--
ALTER TABLE `guest_books`
  ADD CONSTRAINT `guest_books_wedding_id_foreign` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  ADD CONSTRAINT `rsvps_wedding_id_foreign` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `weddings`
--
ALTER TABLE `weddings`
  ADD CONSTRAINT `weddings_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `weddings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `weddings_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `weddings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
