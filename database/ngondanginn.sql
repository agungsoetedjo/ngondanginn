-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Bulan Mei 2025 pada 04.09
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('dengan_foto','tanpa_foto') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Spesial', 'dengan_foto', '2025-05-03 10:14:57', '2025-05-03 11:42:30'),
(2, 'Spesial', 'tanpa_foto', '2025-05-03 10:15:23', '2025-05-03 11:41:50'),
(4, 'Minimalist Luxury', 'dengan_foto', '2025-05-03 12:01:24', '2025-05-03 12:01:24'),
(7, 'Minimalist Luxury', 'tanpa_foto', '2025-05-03 14:11:00', '2025-05-03 14:11:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 'Maaf Min, kalau nggak punya foto, apakah masih bisa buat undangan digital Ngondang-In?', 'Tentu saja bisa Kak :) Kalau nggak ada foto, kita bisa tetap bikin undangan digital yang keren untuk Kakak. Kita bisa pakai karakter animasi dan inisial nama Kakak dan pasangan biar undangannya tetap tampil istimewa dan personal!', '2025-02-18 21:28:44', '2025-02-18 21:28:44'),
(2, 'Min, mau tanya nih, berapa lama masa aktif undangan digitalnya?', 'Untuk masa aktif undangan digitalnya selama 1 tahun ya Kak, jadi Kakak punya banyak waktu untuk menyebarkannya ke semua tamu undangan. ', '2025-02-18 21:28:44', '2025-02-18 21:28:44'),
(3, 'Min, untuk fitur yang tidak digunakan, apakah bisa dihapus dari undangannya?', 'Bisa banget Kak! 😊 Nanti tinggal dinote fitur apa yang ingin dihapus dari undangannya, dan kami akan sesuaikan sesuai dengan permintaan Kakak.', '2025-02-18 21:28:44', '2025-02-18 21:28:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galleries`
--

INSERT INTO `galleries` (`id`, `wedding_id`, `image`, `image_desc`, `created_at`, `updated_at`) VALUES
(2, 9, 'uploads/galeri/6816e08c04d57.jpg', '0', '2025-05-04 03:35:40', '2025-05-04 03:35:40'),
(3, 10, 'uploads/galeri/6816e30f32d58.jpg', '1', '2025-05-04 03:46:23', '2025-05-04 03:46:23'),
(4, 10, 'uploads/galeri/6816e39f71c72.jpg', '2', '2025-05-04 03:48:47', '2025-05-04 03:48:47'),
(5, 10, 'uploads/galeri/6816e3ad716d9.jpeg', '3', '2025-05-04 03:49:01', '2025-05-04 03:49:01'),
(6, 10, 'uploads/galeri/6816e3b85718e.jpg', '0', '2025-05-04 03:49:12', '2025-05-04 03:49:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guest_books`
--

CREATE TABLE `guest_books` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guest_books`
--

INSERT INTO `guest_books` (`id`, `wedding_id`, `name`, `message`, `created_at`, `updated_at`) VALUES
(4, 9, 'namates', 'tes ucap', '2025-05-04 04:04:04', '2025-05-04 04:04:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000001_create_users_table', 1),
(3, '0001_01_01_000002_create_cache_table', 1),
(4, '0001_01_01_000003_create_jobs_table', 1),
(6, '2025_04_07_140534_create_musics_table', 1),
(8, '2025_04_07_150000_create_weddings_table', 1),
(9, '2025_04_07_150209_create_rsvps_table', 1),
(10, '2025_04_07_150311_create_guest_books_table', 1),
(11, '2025_04_07_150356_create_galleries_table', 1),
(12, '2025_04_12_115028_create_faqs_table', 1),
(13, '2025_04_25_161128_create_payment_dests_table', 1),
(15, '2025_04_07_140535_create_orders_table', 2),
(16, '2025_04_25_161243_create_payments_table', 2),
(22, '2025_04_07_140452_create_categories_table', 3),
(23, '2025_04_07_140453_create_templates_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `musics`
--

CREATE TABLE `musics` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `musics`
--

INSERT INTO `musics` (`id`, `title`, `artist`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Make it Right', 'Peraukertas', 'uploads/musik/67fd037c15a15.mp3', '2025-04-13 22:45:48', '2025-04-13 22:45:48'),
(2, 'Menikah Denganku', 'By The Hundreds', 'uploads/musik/67fe3c275c2dd.mp3', '2025-04-14 20:59:51', '2025-04-14 20:59:51'),
(3, 'Wanitaku', 'NOAH', 'uploads/musik/68047bc8eba1c.mp3', '2025-04-19 21:44:56', '2025-04-19 21:44:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('created','processed','published','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `kode_transaksi`, `nama_pemesan`, `email_pemesan`, `phone_number`, `status`, `created_at`, `updated_at`) VALUES
(11, 'WD_ORDER_6811E25B7D14D', 'M Rafi S Fauzi', 'agungsoetedjo@gmail.com', '085795851996', 'processed', '2025-04-30 08:42:03', '2025-05-03 05:28:48'),
(12, 'WD_ORDER_6816E0E8BB71B', 'nama pemesan', 'agungsoetedjo@gmail.com', '082215148544', 'published', '2025-05-04 03:37:12', '2025-05-04 04:04:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `payment_total` bigint UNSIGNED DEFAULT '0',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('pending','rejected','waiting_verify','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_dests_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_total`, `payment_proof`, `payment_desc`, `payment_status`, `payment_dests_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 11, 110000, 'uploads/payment_proof/6812204243766.jpeg', '-', 'paid', 3, 2, '2025-04-30 10:50:31', '2025-05-03 05:25:49'),
(2, 12, 200000, 'uploads/payment_proof/6816e1a24ad0f.jpeg', '-', 'paid', 4, 2, '2025-05-04 03:40:18', '2025-05-04 03:41:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_dests`
--

CREATE TABLE `payment_dests` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_dests`
--

INSERT INTO `payment_dests` (`id`, `bank_name`, `account_number`, `account_name`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '1234567890', 'Bambang Cahya Andriana', '2025-04-25 09:34:26', '2025-04-28 09:09:45'),
(2, 'BNI', '1234567890', 'Bella Nisya Indriana', '2025-04-25 09:35:09', '2025-04-25 09:35:09'),
(3, 'Mandiri', '1234567890', 'Manda Dini Riandani', '2025-04-25 09:35:46', '2025-04-25 09:35:46'),
(4, 'BRI', '1234567890', 'Budi Rizky Indriana', '2025-04-28 09:15:15', '2025-04-28 09:15:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pengelola', '2025-04-22 04:19:04', '2025-04-22 04:19:04'),
(2, 'bendahara', '2025-04-22 04:19:27', '2025-04-22 04:19:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rsvps`
--

CREATE TABLE `rsvps` (
  `id` bigint UNSIGNED NOT NULL,
  `wedding_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rsvps`
--

INSERT INTO `rsvps` (`id`, `wedding_id`, `name`, `attendance`, `reason`, `created_at`, `updated_at`) VALUES
(4, 9, 'namates', 'yes', NULL, '2025-05-04 04:04:04', '2025-05-04 04:04:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PWPLD3TGT0pqTuAz56FF7tlGvkCoG7qzMMxiQkqT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWt6bnF5WW9aMGJwcXg4YU5zcVUxNmpVQnp6YVJOREhXbkZMUEFxNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9uZ29uZGFuZ2luLnRlc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1746331711);

-- --------------------------------------------------------

--
-- Struktur dari tabel `templates`
--

CREATE TABLE `templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `templates`
--

INSERT INTO `templates` (`id`, `name`, `preview_image`, `view_path`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Spesial 01', 'bc93a010-8be7-4d27-bb18-449fad70b1f7.jpg', 'template_packs.spesial_dengan_foto.spesial-01', 150000, 1, '2025-04-15 00:51:40', '2025-05-03 14:02:47'),
(2, 'Spesial 02', '00d2c7aa-b720-429b-818d-117082bbcb4d.jpg', 'template_packs.spesial_tanpa_foto.spesial-02', 110000, 2, '2025-04-15 00:52:28', '2025-05-04 03:24:40'),
(3, 'Minimalist Luxury 01', 'f937b432-4cd6-40cb-86ee-544374489ecd.jpg', 'template_packs.minimalist_luxury_dengan_foto.minimalist-luxury-01', 200000, 4, '2025-05-03 13:58:11', '2025-05-03 14:32:25'),
(4, 'Minimalist Luxury 02', 'a97ea049-6a62-428c-973e-6e985c869e84.jpg', 'template_packs.minimalist_luxury_dengan_foto.minimalist-luxury-02', 150000, 4, '2025-05-03 14:07:45', '2025-05-03 16:35:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `otp_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `email_verified_at`, `password`, `role_id`, `otp_code`, `otp_expires_at`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Agung Soetedjo', 'agungsoetedjo@gmail.com', 'assets_be/img/avatars/user_1_1745920564.jpg', NULL, '$2y$12$Dje0O.jvMzV/LS2aRjA/duaG/zz.XMIsbDdC59xBu566Li5UkouPC', 1, NULL, NULL, 1, 'AagEE3lKn1Letoq6wjUqyr4dv4eRujziq9dkno67sewpJluG5XNNNl3tVSBv', '2025-04-07 02:03:13', '2025-05-01 03:16:34'),
(2, 'M Rafi S Fauzi', 'mrafi.sfauzi@gmail.com', 'assets_be/img/avatars/user_2_1745921457.jpg', NULL, '$2y$12$z2ONIowo9fN2Ju817mokC.nRLKJbeqgeqN43WEvGEJ6MsQpHKKxZK', 2, NULL, NULL, 1, NULL, '2025-04-16 03:54:34', '2025-04-30 02:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `weddings`
--

CREATE TABLE `weddings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bride_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bride_parents_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groom_parents_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akad_date` datetime DEFAULT NULL,
  `reception_date` datetime DEFAULT NULL,
  `akad_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akad_place_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reception_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reception_place_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `music_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `weddings`
--

INSERT INTO `weddings` (`id`, `user_id`, `slug`, `bride_name`, `groom_name`, `bride_parents_info`, `groom_parents_info`, `akad_date`, `reception_date`, `akad_location`, `akad_place_name`, `reception_location`, `reception_place_name`, `description`, `template_id`, `music_id`, `order_id`, `created_at`, `updated_at`) VALUES
(9, 1, 'm-rafi-s-fauzi-yuni-widyaningsih-dnl9k', 'Yuni Widyaningsih', 'M Rafi S Fauzi', 'Putri Pertama dari Bpk. X dan Ibu. Y', 'Putra Pertama dari Bpk. X dan Ibu. Y', '2025-05-04 09:00:00', '2025-05-04 11:00:00', 'Jln. Sukahaji Atas No. 11 Jaksel', 'Gedung Rajawali X', 'Jln. Sukahaji Atas No. 12 Jaksel', 'Gedung Rajawali XI', 'Kau bagai langit bagiku, ku bagai lautan bagimu, cinta kita luas tak terbatas....ihiiiwwww', 2, 2, 11, '2025-04-30 08:42:03', '2025-05-03 05:35:51'),
(10, 1, 'nama-pria-nama-wanita-wsirb', 'nama wanita', 'nama pria', 'ortu wanita', 'ortu pria', '2025-05-11 09:00:00', '2025-05-11 11:00:00', 'alamat akad', 'tempat akad', 'alamat resepsi', 'tempat resepsi', 'kisah cinta', 3, 2, 12, '2025-05-04 03:37:12', '2025-05-04 03:43:08');

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
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_payment_dests_id_foreign` (`payment_dests_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `payment_dests`
--
ALTER TABLE `payment_dests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `templates_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `musics`
--
ALTER TABLE `musics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `payment_dests`
--
ALTER TABLE `payment_dests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `weddings`
--
ALTER TABLE `weddings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_payment_dests_id_foreign` FOREIGN KEY (`payment_dests_id`) REFERENCES `payment_dests` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `rsvps`
--
ALTER TABLE `rsvps`
  ADD CONSTRAINT `rsvps_wedding_id_foreign` FOREIGN KEY (`wedding_id`) REFERENCES `weddings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
