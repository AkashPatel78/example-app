-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 03:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Akash', 'akash@gmail.com', NULL, '$2y$10$z2.n.y2Hb1TB6GwY8L7kKu4ANcfjXA7acQb9ZvaidiSdflmYshTDi', NULL, '2023-01-11 05:39:03', '2023-01-11 05:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jams', '1', '2023-01-16 00:55:47', '2023-01-18 08:31:20', NULL),
(2, 'Alexander', '1', '2023-01-16 04:44:59', '2023-01-18 05:24:28', '2023-01-18 10:54:28'),
(4, 'Akash Patel', '1', '2023-01-18 04:47:40', '2023-01-18 05:24:02', '2023-01-18 10:54:02'),
(5, 'pivs', '0', '2023-01-18 06:09:29', '2023-01-18 06:12:24', '2023-01-18 11:42:24'),
(6, 'Alexander', '0', '2023-01-18 06:29:21', '2023-01-18 08:28:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` int(255) NOT NULL,
  `auther_id` int(255) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `cat_id`, `auther_id`, `avatar`, `pdf`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CCWT', 1, 2, '1673850223.jpg', '1673850223.pdf', '2023-01-16 00:53:43', '2023-01-18 02:52:12', NULL),
(2, 'Network Programing', 1, 2, '1673857137.jpg', '1673857137.pdf', '2023-01-16 02:48:57', '2023-01-18 02:52:07', NULL),
(3, 'C+', 2, 2, '1674035952.jpg', '1673857694.pdf', '2023-01-16 02:58:14', '2023-01-18 04:29:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Computer Science', '1', '2023-01-16 00:55:27', '2023-01-18 08:32:26', NULL),
(2, 'IT Sector', '0', '2023-01-16 01:38:48', '2023-01-18 04:32:36', NULL),
(3, 'Science Field', '0', '2023-01-16 04:28:20', '2023-01-18 06:17:12', '2023-01-18 11:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_11_074720_create_admins_table', 2),
(6, '2023_01_13_125149_books', 3),
(7, '2023_01_13_130743_books', 4),
(8, '2023_01_14_033843_cats', 5),
(9, '2023_01_15_120659_create_authors_table', 6),
(10, '2023_01_17_063031_create_orders_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `book_id`, `leave_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '2023/01/17', 1, '2023-01-17 05:46:26', '2023-01-17 05:46:26'),
(2, '1', '2', '2023/01/17', 1, '2023-01-17 05:47:44', '2023-01-17 05:47:44'),
(4, '2', '1', '2023/01/17', 1, '2023-01-17 07:11:28', '2023-01-17 07:11:28'),
(6, '2', '1', '2023/01/17', 1, '2023-01-17 07:12:11', '2023-01-17 07:12:11'),
(7, '2', '1', '2023/01/17', 1, '2023-01-17 11:03:08', '2023-01-17 11:03:08'),
(8, '2', '2', '2023/01/17', 1, '2023-01-17 11:11:56', '2023-01-17 11:11:56'),
(9, '2', '1', '2023/01/18', 1, '2023-01-17 23:12:26', '2023-01-17 23:12:26'),
(10, '2', '2', '2023/01/18', 1, '2023-01-17 23:12:44', '2023-01-17 23:12:44'),
(11, '2', '1', '2023/01/18', 1, '2023-01-17 23:13:00', '2023-01-17 23:13:00'),
(12, '2', '1', '2023/01/18', 1, '2023-01-17 23:22:04', '2023-01-17 23:22:04'),
(13, '2', '3', '2023/01/18', 1, '2023-01-17 23:23:07', '2023-01-17 23:23:07'),
(14, '2', '3', '2023/01/18', 1, '2023-01-17 23:23:39', '2023-01-17 23:23:39'),
(15, '1', '2', '2023/01/18', 1, '2023-01-17 23:41:09', '2023-01-17 23:41:09'),
(16, '1', '1', '2023/01/18', 1, '2023-01-17 23:41:12', '2023-01-17 23:41:12'),
(17, '1', '1', NULL, 0, '2023-01-17 23:41:24', '2023-01-17 23:41:24'),
(18, '1', '2', NULL, 0, '2023-01-17 23:41:28', '2023-01-17 23:41:28'),
(19, '2', '2', '2023/01/18', 1, '2023-01-17 23:58:29', '2023-01-17 23:58:29'),
(20, '2', '3', '2023/01/18', 1, '2023-01-18 00:00:46', '2023-01-18 00:00:46'),
(21, '2', '2', '2023/01/18', 1, '2023-01-18 00:08:40', '2023-01-18 00:08:40'),
(22, '2', '1', '2023/01/18', 1, '2023-01-18 00:17:53', '2023-01-18 00:17:53'),
(23, '2', '2', '2023/01/18', 1, '2023-01-18 00:18:09', '2023-01-18 00:18:09'),
(24, '2', '1', '2023/01/18', 1, '2023-01-18 00:27:33', '2023-01-18 00:27:33'),
(25, '2', '3', '2023/01/18', 1, '2023-01-18 00:31:59', '2023-01-18 00:31:59'),
(26, '2', '1', '2023/01/18', 1, '2023-01-18 01:46:13', '2023-01-18 01:46:13'),
(27, '3', '1', '2023/01/18', 1, '2023-01-18 01:48:04', '2023-01-18 01:48:04'),
(28, '3', '3', NULL, 0, '2023-01-18 01:48:31', '2023-01-18 01:48:31'),
(29, '3', '2', '2023/01/18', 1, '2023-01-18 01:48:37', '2023-01-18 01:48:37'),
(30, '3', '2', NULL, 0, '2023-01-18 01:49:05', '2023-01-18 01:49:05'),
(31, '2', '3', '2023/01/18', 1, '2023-01-18 04:35:43', '2023-01-18 04:35:43'),
(32, '2', '2', '2023/01/18', 1, '2023-01-18 06:42:32', '2023-01-18 06:42:32'),
(33, '2', '1', '2023/01/18', 1, '2023-01-18 06:53:46', '2023-01-18 06:53:46'),
(34, '2', '3', NULL, 0, '2023-01-18 06:56:52', '2023-01-18 06:56:52'),
(35, '2', '2', NULL, 0, '2023-01-18 07:37:35', '2023-01-18 07:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test@gmail.com', NULL, '$2y$10$Wf8dBnQnRtGfni23MSa9yOWjFXu3HqkAnYE0FJ.3FyHTITvEZO2C6', NULL, '2023-01-11 01:44:30', '2023-01-11 01:44:30'),
(2, 'Akash Patel', 'akash@gmail.com', NULL, '$2y$10$z2.n.y2Hb1TB6GwY8L7kKu4ANcfjXA7acQb9ZvaidiSdflmYshTDi', 'lIeESAEqAc74S0pq6pge1cT1PkiSVpKaiP5or9RVMnk6V5lXYoPTj3AI49Yi', '2023-01-11 02:11:26', '2023-01-11 02:11:26'),
(3, 'Chandrakar Bhagat', 'chandrakar@gmail.com', NULL, '$2y$10$dGIpM3XfuQyaKKg85BjY5OEr93MEZlF0OOUYuAPnsV.CwfNPEujzW', NULL, '2023-01-18 01:47:48', '2023-01-18 01:47:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
