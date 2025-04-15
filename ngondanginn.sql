-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Apr 2025 pada 15.18
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
(2, 1, 'uploads/galeri/67fa431863569.jpg', '2025-04-12 03:40:24', '2025-04-12 03:40:24');

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
(1, 1, 'Norbert Langworth PhD', 'Aut eius voluptatem laudantium voluptas fugit corporis aut laboriosam dolor sed.', '2025-04-12 03:10:51', '2025-04-12 03:10:51'),
(2, 1, 'Mrs. Erika Wehner', 'Doloribus dolorem aspernatur nihil beatae inventore natus nemo voluptatibus qui sunt incidunt atque.', '2025-04-12 03:10:51', '2025-04-12 03:10:51'),
(3, 1, 'Brett Oberbrunner', 'Ex perspiciatis necessitatibus eaque ut beatae beatae saepe sit amet.', '2025-04-12 03:10:51', '2025-04-12 03:10:51'),
(4, 1, 'Jewel Greenfelder MD', 'Sint dicta est magni quos officiis omnis molestiae accusamus error ut ipsum laudantium.', '2025-04-12 03:10:51', '2025-04-12 03:10:51'),
(5, 1, 'Glennie Towne DVM', 'Fuga ipsa dicta nobis illo blanditiis ut eum iure non nihil.', '2025-04-12 03:10:51', '2025-04-12 03:10:51');

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
(16, '2025_04_07_150000_create_weddings_table', 8),
(20, '2025_04_13_122214_create_orders_table', 9);

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
(2, 'Menikah Denganku', 'By The Hundreds', 'uploads/musik/67fe3c275c2dd.mp3', '2025-04-15 03:59:51', '2025-04-15 03:59:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `music_id` bigint UNSIGNED DEFAULT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `groom_name` varchar(255) NOT NULL,
  `bride_parents_info` varchar(255) DEFAULT NULL,
  `groom_parents_info` varchar(255) DEFAULT NULL,
  `akad_date` datetime DEFAULT NULL,
  `reception_date` datetime DEFAULT NULL,
  `place_name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `description` text,
  `phone_number` varchar(255) NOT NULL,
  `payment_total` bigint UNSIGNED NOT NULL DEFAULT '0',
  `payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','waiting_verify','paid','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `music_id`, `template_id`, `kode_transaksi`, `bride_name`, `groom_name`, `bride_parents_info`, `groom_parents_info`, `akad_date`, `reception_date`, `place_name`, `location`, `description`, `phone_number`, `payment_total`, `payment_proof`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 6, 'WD_ORDER_A121C9FC-DD20-437B-B309-22C1B7400613', 'asd', 'asd', 'asd', 'asd', '2025-04-20 22:00:00', '2025-04-20 23:00:00', 'sss', 'ss', NULL, '082215148544', 110000, NULL, 'pending', '2025-04-15 15:00:46', '2025-04-15 15:00:46');

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
  `email` varchar(255) DEFAULT NULL,
  `attendance` enum('yes','no','maybe') NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `rsvps`
--

INSERT INTO `rsvps` (`id`, `wedding_id`, `name`, `email`, `attendance`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Magali Dach', 'wmcglynn@example.com', 'no', 'Velit ut soluta sed unde.', '2025-04-12 02:09:39', '2025-04-12 02:09:39'),
(2, 1, 'Scottie Grady', 'botsford.maida@example.com', 'yes', 'Quae dicta non doloremque impedit harum.', '2025-04-12 02:09:40', '2025-04-12 02:09:40'),
(3, 1, 'Shyanne VonRueden', 'prosacco.milford@example.com', 'maybe', 'Fugiat ut mollitia totam sapiente.', '2025-04-12 02:09:40', '2025-04-12 02:09:40'),
(4, 1, 'Mr. Mathias Leffler DDS', 'clair18@example.net', 'no', NULL, '2025-04-12 02:09:40', '2025-04-12 02:09:40'),
(5, 1, 'Mr. Orlando Harris II', 'lorenzo54@example.org', 'maybe', NULL, '2025-04-12 02:09:40', '2025-04-12 02:09:40');

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
('6xsLDSKD75sMeL63oW3gCVuourHPJBai9KSjUqL8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm1JQUIyMHIwc3F0YmxOblU0b2p2M1pabTF2Y2dZUnhBMmFLdTdWUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9uZ29uZGFuZ2lubi50ZXN0L2xvZ2luIjt9fQ==', 1744730199);

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
(1, 'Agung Soetedjo', 'agungsoetedjo@gmail.com', NULL, '$2y$12$2Hr3GawDJJr7XSOKcUssv.qCFA95fgm5yqm/FH6Yb0OKcnOmcEugi', NULL, '2025-04-07 09:03:13', '2025-04-07 09:03:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `weddings`
--

CREATE TABLE `weddings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `weddings`
--

INSERT INTO `weddings` (`id`, `user_id`, `slug`, `bride_name`, `groom_name`, `bride_parents_info`, `groom_parents_info`, `akad_date`, `reception_date`, `location`, `place_name`, `description`, `template_id`, `music_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'diana-permata-hadi-santoso-1744728814', 'Diana Permata', 'Hadi Santoso', 'Putri ke-1 dari Bpk Andi Setiawan dan Ibu Tiara', 'Putra ke-2 dari Bpk Wawan dan Ibu Sutianingsih', '2025-05-18 09:00:00', '2025-05-18 11:00:00', 'Jln. Jakarta No. 444 Bandung', 'GSG Mandiri Sejati Bandung', '-', 5, 2, '2025-04-14 06:01:51', '2025-04-15 14:53:34');

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
  ADD UNIQUE KEY `orders_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_music_id_foreign` (`music_id`),
  ADD KEY `orders_template_id_foreign` (`template_id`);

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
  ADD KEY `weddings_music_id_foreign` (`music_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `guest_books`
--
ALTER TABLE `guest_books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `musics`
--
ALTER TABLE `musics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `weddings`
--
ALTER TABLE `weddings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `weddings_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `weddings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
