-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2023 at 04:54 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thefitk9_thefitcare_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Butt Increase', '2023-03-13 21:36:44', '2023-03-13 21:36:44'),
(10, 'Neck Workout', '2023-03-13 21:38:16', '2023-03-13 21:38:16'),
(11, 'Collar Bone Exercise', '2023-03-13 21:38:37', '2023-03-13 21:38:37'),
(12, 'Improved Forward Head Posture', '2023-03-13 21:39:10', '2023-03-13 21:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ex_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ex_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ex_duration` tinyint(4) NOT NULL,
  `ex_thumbnail_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ex_video_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `ex_name`, `ex_description`, `ex_duration`, `ex_thumbnail_url`, `ex_video_url`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Both Leg Stretch', 'NA', 30, '1678268185_SS_731082355.png', '1678268185_Both Leg Stretch.m4v', 0, '2023-03-08 21:36:25', '2023-03-13 19:07:17', '2023-03-13 19:07:17'),
(2, 'Butt Kickers', 'NA', 30, '1678268300_SS_731082355.png', '1678268300_Butt Kickers.m4v', 0, '2023-03-08 21:38:20', '2023-03-13 21:37:38', '2023-03-13 21:37:38'),
(3, 'Calm Shells (Left)', 'NA', 30, '1678268334_SS_731082355.png', '1678268334_Calm Shells (Left).m4v', 0, '2023-03-08 21:38:54', '2023-03-13 19:07:10', '2023-03-13 19:07:10'),
(4, 'Calm Shells (Right)', 'NA', 30, '1678268474_SS_731082355.png', '1678268474_Calm Shells (Right).m4v', 0, '2023-03-08 21:41:14', '2023-03-10 23:57:44', '2023-03-10 23:57:44'),
(10, 'Child Pose Angle Two', 'NA', 30, '1678359788_SS_731082355.png', '1678359788_Child Pose Angle Two.m4v', 0, '2023-03-09 23:03:08', '2023-03-13 19:07:04', '2023-03-13 19:07:04'),
(11, 'New Ex 1', 'NA', 22, '1678694163_Reduced Forehead stress line -Right.jpg', '1678694163_Butt (Right).m4v', 1, '2023-03-13 18:56:03', '2023-03-13 19:19:34', NULL),
(12, 'Neck 1', 'NA', 30, '1678704011_Straight-line-nose-to-eyebrows.jpg', '1678704011_Butt (Right).m4v', 1, '2023-03-13 21:40:11', '2023-03-13 21:40:11', NULL),
(13, 'Neck 2', 'NA', 30, '1678704069_O pose-bigger eye.jpg', '1678704069_Squeezereversehold.mp4', 1, '2023-03-13 21:41:09', '2023-03-13 21:41:09', NULL),
(14, 'Neck 3', 'NA', 30, '1678704123_Reduced Forehead stress line -Right.jpg', '1678704123_Butt (Right).m4v', 1, '2023-03-13 21:42:03', '2023-03-13 21:42:03', NULL),
(15, 'Neck 4', 'NA', 30, '1678704162_For Bigger eye\'s-exercise.jpg', '1678704162_Squeezereversehold.mp4', 1, '2023-03-13 21:42:42', '2023-03-13 21:43:02', NULL),
(16, 'Collar Bone 1', 'NA', 30, '1678704235_For Bigger eye\'s-exercise.jpg', '1678704235_Squeezereversehold.mp4', 1, '2023-03-13 21:43:55', '2023-03-13 21:43:55', NULL),
(17, 'Collar Bone 2', 'NA', 22, '1678704431_O pose-bigger eye.jpg', '1678704431_Squeezereversehold.mp4', 1, '2023-03-13 21:47:11', '2023-03-13 21:47:11', NULL),
(18, 'Forward Head 1', 'NA1', 30, '1678704557_For Bigger eye\'s-exercise.jpg', '1678704557_Squeezereversehold.mp4', 1, '2023-03-13 21:49:17', '2023-03-13 21:50:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exercise_relations`
--

CREATE TABLE `exercise_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ex_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_day` tinyint(4) DEFAULT NULL,
  `till_day` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercise_relations`
--

INSERT INTO `exercise_relations` (`id`, `ex_id`, `cat_id`, `level_id`, `program_id`, `from_day`, `till_day`, `created_at`, `updated_at`) VALUES
(20, 12, 10, NULL, 6, NULL, NULL, '2023-03-13 21:40:11', '2023-03-13 21:40:11'),
(21, 13, 10, NULL, 5, NULL, NULL, '2023-03-13 21:41:09', '2023-03-13 21:41:09'),
(22, 14, 10, NULL, 4, NULL, NULL, '2023-03-13 21:42:03', '2023-03-13 21:42:03'),
(23, 15, 10, NULL, 3, NULL, NULL, '2023-03-13 21:42:42', '2023-03-13 21:42:42'),
(24, 16, 11, NULL, 2, NULL, NULL, '2023-03-13 21:43:55', '2023-03-13 21:43:55'),
(25, 17, 11, NULL, 7, NULL, NULL, '2023-03-13 21:47:11', '2023-03-13 21:47:11'),
(26, 18, 12, NULL, 1, NULL, NULL, '2023-03-13 21:49:17', '2023-03-13 21:49:17');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Begginer', '2023-03-08 20:01:13', '2023-03-08 20:01:13'),
(2, 'Intermediate', '2023-03-08 20:01:36', '2023-03-08 20:01:36'),
(3, 'Expert', '2023-03-08 20:01:43', '2023-03-08 20:01:43');

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
(5, '2022_03_01_044515_create_categories_table', 1),
(6, '2022_03_01_110417_create_levels_table', 1),
(7, '2022_03_01_123432_create_exercises_table', 1),
(8, '2023_02_17_105103_create_users_categories_table', 1),
(9, '2023_02_17_111859_create_programs_table', 1),
(10, '2023_02_17_112158_create_exercise_relations_table', 1),
(11, '2023_03_01_051119_create_cache_table', 1);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Neck Workouts', '2023-03-13 21:32:43', '2023-03-13 21:32:43'),
(2, 'Make Your Beauty Bones Perfect', '2023-03-13 21:32:52', '2023-03-13 21:32:52'),
(3, 'Neck Strengthen Exercise', '2023-03-13 21:33:02', '2023-03-13 21:33:02'),
(4, 'Relief Neck Pain', '2023-03-13 21:33:09', '2023-03-13 21:33:09'),
(5, 'Neck Massage', '2023-03-13 21:33:16', '2023-03-13 21:33:16'),
(6, 'Neck Warm Up Exercises', '2023-03-13 21:33:23', '2023-03-13 21:33:23'),
(7, 'Collar Bone Warm Up Exercises ', '2023-03-13 21:46:22', '2023-03-13 21:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` enum('admin','emp') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'emp',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Misbah Waseem', 'misbah@gmail.com', '$2y$10$NXAZCJukHBy3UtDzO9CAyO4ICIUBER5yGKqlHiQWY8corqdge116u', 'emp', NULL, 'NgDIQ4FAUzpZLjBwKweBBUSCnSGRGAWobwqWkJNLKdNXQQrkmrz0volNNWkP', '2023-03-08 19:57:34', '2023-03-08 19:57:34'),
(2, 'Muhammad Abdullah Mirza', 'mirza@gmail.com', '$2y$10$UHozGfzkXwhGmBPgHbzfsujzeQZYBgILyBKNQ7Z5jH9AKvSsyWSBm', 'emp', NULL, 'V1hPpiTB89IBm7erMQXNtibx4MOj41WFYQpzTsp54iDndTVIiR1b0eNu6k6G', '2023-03-08 20:15:39', '2023-03-08 20:15:39'),
(3, 'Dummy1', 'dummy@gmail.com', '$2y$10$wjMOM4lC9Dzt7x6WAPPuUuQS7MLt/570TInCzxdxgp72HZjIBj20q', 'emp', NULL, NULL, '2023-03-11 00:30:57', '2023-03-11 00:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `users_categories`
--

CREATE TABLE `users_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise_relations`
--
ALTER TABLE `exercise_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercise_relations_ex_id_foreign` (`ex_id`),
  ADD KEY `exercise_relations_cat_id_foreign` (`cat_id`),
  ADD KEY `exercise_relations_level_id_foreign` (`level_id`),
  ADD KEY `exercise_relations_program_id_foreign` (`program_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_categories`
--
ALTER TABLE `users_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_categories_user_id_foreign` (`user_id`),
  ADD KEY `users_categories_cat_id_foreign` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exercise_relations`
--
ALTER TABLE `exercise_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_categories`
--
ALTER TABLE `users_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercise_relations`
--
ALTER TABLE `exercise_relations`
  ADD CONSTRAINT `exercise_relations_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_relations_ex_id_foreign` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_relations_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_relations_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_categories`
--
ALTER TABLE `users_categories`
  ADD CONSTRAINT `users_categories_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
