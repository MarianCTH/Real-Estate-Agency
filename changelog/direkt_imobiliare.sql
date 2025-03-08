-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mart. 08, 2025 la 11:57 PM
-- Versiune server: 10.4.24-MariaDB
-- Versiune PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `direkt_imobiliare`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `leader_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `companies`
--

INSERT INTO `companies` (`id`, `name`, `image`, `address`, `email`, `mobile_phone`, `cui`, `created_at`, `updated_at`, `leader_id`) VALUES
(3, 'Direkt Imobiliare', 'img/companies/1740067310.png', 'Aleea Soimilor nr 1', 'asdaf@yahoo.com', '0755560779', '123456', '2025-02-20 13:32:20', '2025-02-20 14:01:50', 23);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `failed_jobs`
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
-- Structură tabel pentru tabel `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(67, 23, 3, '2025-03-07 10:50:52', '2025-03-07 10:50:52'),
(68, 23, 5, '2025-03-08 14:39:00', '2025-03-08 14:39:00'),
(81, 29, 6, '2025-03-08 16:07:47', '2025-03-08 16:07:47'),
(82, 29, 2, '2025-03-08 16:18:06', '2025-03-08 16:18:06'),
(84, 29, 3, '2025-03-08 16:18:33', '2025-03-08 16:18:33'),
(85, 29, 5, '2025-03-08 16:19:58', '2025-03-08 16:19:58');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `join_requests`
--

CREATE TABLE `join_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `join_requests`
--

INSERT INTO `join_requests` (`id`, `company_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 3, 28, 'approved', '2025-02-20 15:12:23', '2025-02-20 15:12:34');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Big', '2024-07-16 08:58:55', '2024-07-16 08:58:55'),
(2, 'Centru', '2024-07-16 08:58:55', '2024-07-16 08:58:55'),
(3, 'Decebal', '2024-07-16 08:58:55', '2024-07-16 08:58:55'),
(4, 'Mall', '2024-07-16 08:58:55', '2024-07-16 08:58:55'),
(5, 'Ștefan', '2024-07-16 08:58:55', '2024-07-16 08:58:55');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `messages`
--

INSERT INTO `messages` (`id`, `ticket_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'asdfasdfafasdfasdfafasdfasdfafasdfasdfafasdfasdfaf', '2024-07-13 12:08:45', '2024-07-13 12:08:45'),
(2, 2, 'adhadhahdahdadhadhahdahdadhadhahdahdadhadhahdahd', '2024-07-13 12:10:33', '2024-07-13 12:10:33');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(39, '2019_08_19_000000_create_failed_jobs_table', 1),
(40, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(41, '2024_07_12_103206_create_properties_table', 1),
(42, '2024_07_13_121815_add_user_id_to_properties_table', 1),
(43, '2024_07_13_134756_create_subscriptions_table', 1),
(44, '2024_07_13_143358_create_tickets_table', 2),
(45, '2024_07_13_143358_create_1tickets_table', 3),
(46, '2024_07_13_143358_create_messages_table', 3),
(47, '2024_07_13_231755_add_type_to_users_table', 4),
(48, '2024_07_13_232341_create_property_images_table', 5),
(49, '2024_07_13_235738_create_property_types_table', 6),
(50, '2024_07_13_235911_add_type_id_to_properties_table', 6),
(51, '2024_07_14_000327_add_coordinates_to_properties_table', 7),
(52, '2024_07_14_005320_create_user_details_table', 8),
(53, '2024_07_16_115127_create_locations_table', 9),
(54, '2024_07_16_120009_create_property_options_table', 10),
(55, '2024_09_16_224125_add_icon_to_property_types_table', 11),
(56, '2024_09_17_113057_add_views_to_properties_table', 12),
(57, '2024_10_17_103923_create_favorites_table', 13),
(58, '2025_02_19_153222_add_company_id_to_users_table', 14),
(59, '2025_02_19_154121_add_image_address_cui_to_companies_table', 15),
(60, '2025_02_19_161721_add_leader_id_to_companies', 16),
(61, '2025_02_20_153605_add_email_and_phone_to_companies', 17),
(62, '2025_02_20_160410_create_join_requests_table', 18),
(63, '2025_03_07_121940_create_property_statuses_table', 19);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `personal_access_tokens`
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
-- Structură tabel pentru tabel `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `garages` int(11) NOT NULL,
  `size` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `properties`
--

INSERT INTO `properties` (`id`, `title`, `description`, `price`, `location`, `bedrooms`, `bathrooms`, `garages`, `size`, `image`, `featured`, `status_id`, `type_id`, `latitude`, `longitude`, `created_at`, `updated_at`, `user_id`, `location_id`, `views`) VALUES
(2, 'Apartament 3 camere , zona Imparatul Traian', 'Agentia Direkt Imobiliare propune spre vanzare apartament decomodat situat in zona Imparatul Traian . Imobilul este pozitionat la etajul 3  , are o suprafata utila de 71 mp , si este compus din : bucatarie separata , 3 camere din care 2 cu balcon, 1 baie . Necesita renovare ! Dispune de geam termopan , centrala pe gaz .', '68.000', 'Strada Împăratul Traian, Independenței, Bistrița, Bistrița-Năsăud, 420220, România', 3, 1, 0, 150.00, 'PHOTO-2024-08-22-13-54-38.jpg', 0, 1, 1, '47.1282933', '24.4807795', '2024-09-20 08:05:05', '2025-03-08 14:54:48', 23, NULL, 103),
(3, 'Apartament spatios , zona Liceul Liviu Rebreanu !', 'Agentia Direkt Imobiliare propune spre vanzare apartament spatios situat in zona Liceul Liviu Rebreanu . Imobilul este pozitionat la etajul 4 din 5 intr- un imobil tip bloc nou , are o suprafata de 80 mp, compus din living cu bucatarie , zona dinning, 1 dormitor , baie , balcon spatios . Dispune de garaj subteran si boxa in beci .\r\n\r\nSe vinde mobilat si utilat in totalitate .', '98.000', 'Strada Zimbrului, Decebal, Bistrița, Bistrița-Năsăud, 420126, România', 5, 1, 0, 150.00, 'PHOTO-2024-07-03-15-33-33.jpg', 1, 1, 2, '47.1352602', '24.4926158', '2024-09-20 08:10:08', '2025-03-08 14:59:11', 23, NULL, 49),
(5, 'Spatiu comercial , situat langa Primaria Bistrita !', 'Agentia Direkt Imobiliare propune spre inchiriere spatiu comercial stradal situat vis-a-vis de Primaria Bistrita finisat in suprafata de 150 mp utili , pozitionat la parter , compus din 1 sala vanzare , baie , birou si depozit.', '500.000', 'Strada Gheorghe Șincai, Bistrița, Bistrița-Năsăud, 420041, România', 1, 0, 0, 55.00, 'spatiu-orange-scaled.jpg', 0, 1, 2, '47.1313440', '24.4928849', '2025-03-08 14:05:44', '2025-03-08 15:56:10', 23, NULL, 8),
(6, 'Casa individuala , zona Dedeman', 'Agentia Direkt Imobiliare propune spre vanzare casa individuala pe un nivel , situata in zona Dedeman . Imobilul are o suprafata de 110 mp , compusa din buctarie , living , 2 dormitoare , 2 bai , terasa .\r\n\r\nSe vinde mobilata si utilata partial .', '130.000', 'Compozitorilor, Dedeman', 4, 2, 0, 110.00, 'IMG_7132.jpg', 0, 1, 1, '47.1242260', '24.4687650', '2025-03-08 14:38:23', '2025-03-08 16:20:15', 23, NULL, 6);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `property_options`
--

CREATE TABLE `property_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `property_options`
--

INSERT INTO `property_options` (`id`, `name`, `created_at`, `updated_at`) VALUES
(15, 'Aer condiționat', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(16, 'Piscină', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(17, 'Încălzire centrală', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(18, 'Cameră de spălătorie', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(19, 'Sală de sport', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(20, 'Alarmă', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(21, 'Acoperire pentru ferestre', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(22, 'WiFi', '2024-07-16 09:21:03', '2024-07-16 09:21:03'),
(23, 'Cablu TV', '2024-07-16 09:21:04', '2024-07-16 09:21:04'),
(24, 'Uscător', '2024-07-16 09:21:04', '2024-07-16 09:21:04'),
(25, 'Cuptor cu microunde', '2024-07-16 09:21:04', '2024-07-16 09:21:04'),
(26, 'Mașină de spălat', '2024-07-16 09:21:04', '2024-07-16 09:21:04'),
(27, 'Frigider', '2024-07-16 09:21:04', '2024-07-16 09:21:04'),
(28, 'Duș exterior', '2024-07-16 09:21:04', '2024-07-16 09:21:04');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `property_statuses`
--

CREATE TABLE `property_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `property_statuses`
--

INSERT INTO `property_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vânzare', '2025-03-07 10:23:43', '2025-03-07 10:23:43'),
(2, 'Închiriere', '2025-03-07 10:23:43', '2025-03-07 10:23:43'),
(3, 'Vândut', '2025-03-07 10:23:44', '2025-03-07 10:23:44');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Casă', '2024-07-13 21:01:26', '2024-07-13 21:01:26', 'marker-icon-house.png'),
(2, 'Apartament', '2024-07-13 21:01:26', '2024-07-13 21:01:26', 'marker-icon-apartment.png'),
(3, 'Hală', '2024-07-13 21:01:26', '2024-07-13 21:01:26', 'marker-icon-hall.png');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'adgag@yahoo.com', '2024-07-13 13:14:15', '2024-07-13 13:14:15'),
(2, 'gasgd@yahoo.com', '2024-07-18 06:28:01', '2024-07-18 06:28:01'),
(3, 'asdfga@yahoo.com', '2024-07-18 06:28:04', '2024-07-18 06:28:04'),
(4, 'ASD@YAHOO.COM', '2024-09-17 09:51:10', '2024-09-17 09:51:10');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `lastname`, `email`, `created_at`, `updated_at`) VALUES
(1, 'adgagd', 'adgag', 'cth.marian@gmail.com', '2024-07-13 12:08:45', '2024-07-13 12:08:45'),
(2, 'asgasdg', 'asdgasgd', 'asdgag@yahoo.com', '2024-07-13 12:10:33', '2024-07-13 12:10:33');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `type` set('Persoană fizică','Agent imobiliar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Persoană fizică',
  `company_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image`, `type`, `company_id`) VALUES
(1, 'Andrei Popescu', 'andrei.popescu@example.com', NULL, '$2y$12$KN/ptjWkHErQhKtfIG3kNeNPTNlMVQS7/bdapI31ZgmcdRiWdEobq', NULL, '2024-07-13 11:46:49', '2024-07-13 11:46:49', 'default.png', 'Persoană fizică', NULL),
(2, 'Bogdan Ionescu', 'bogdan.ionescu@example.com', NULL, '$2y$12$AnhDI0bQ84MBr7sZbfn9k.q6RlDQgcdRn0NlwY/Cx5o7Yy5s6NeMS', NULL, '2024-07-13 11:46:49', '2024-07-13 11:46:49', 'default.png', 'Persoană fizică', NULL),
(3, 'Cristian Dumitru', 'cristian.dumitru@example.com', NULL, '$2y$12$8fkBxQ/E0sWRsEV98l92LetRDGdJ3HUrriXzfdODjqPPIknhSnxZK', NULL, '2024-07-13 11:46:49', '2024-07-13 11:46:49', 'default.png', 'Persoană fizică', NULL),
(4, 'Daniel Marin', 'daniel.marin@example.com', NULL, '$2y$12$7MnpW4SRobfln.go7qE7duQBDvCWoq6aY229G13qKmEZ5plSz4.iq', NULL, '2024-07-13 11:46:49', '2024-07-13 11:46:49', 'default.png', 'Persoană fizică', NULL),
(5, 'Ion Georgescu', 'ion.georgescu@example.com', NULL, '$2y$12$reOfwp3Ye0vbKIHBAgrnxerLt0TuoBDsoBMp0teB.4w9q72SD/wtS', NULL, '2024-07-13 11:46:50', '2024-07-13 11:46:50', 'default.png', 'Persoană fizică', NULL),
(6, 'Mihai Stanescu', 'mihai.stanescu@example.com', NULL, '$2y$12$Y96Y.CtTClhJg8bogJBFheyifhYgrKpCH7pEkM3WnrQsw0hUZ.tJO', NULL, '2024-07-13 11:46:50', '2024-07-13 11:46:50', 'default.png', 'Persoană fizică', NULL),
(7, 'Radu Alexandru', 'radu.alexandru@example.com', NULL, '$2y$12$DRO6bNkPNwLyYK80Eow.iuxH4VBzUwXWOldCoqItlJgF09e5a7CF2', NULL, '2024-07-13 11:46:50', '2024-07-13 11:46:50', 'default.png', 'Persoană fizică', NULL),
(8, 'Sorin Enescu', 'sorin.enescu@example.com', NULL, '$2y$12$LpNMr3pkf6DqtHWRfBp10.zX3X1mI4sjz96w32XDynN870xT.wBHi', NULL, '2024-07-13 11:46:50', '2024-07-13 11:46:50', 'default.png', 'Persoană fizică', NULL),
(9, 'Valentin Vancea', 'valentin.vancea@example.com', NULL, '$2y$12$MjJBiIlyEdrw2YCD.VqdyuHLtxyb7NXcMpaMc9WhAh81UbPJ4mVpO', NULL, '2024-07-13 11:46:51', '2024-07-13 11:46:51', 'default.png', 'Persoană fizică', NULL),
(10, 'Vlad Sava', 'vlad.sava@example.com', NULL, '$2y$12$1OOekiYPnUAqRf9bAFTTyejZ07eqAxP50wt20jsN4OhL9GQZ4oyoC', NULL, '2024-07-13 11:46:51', '2024-07-13 11:46:51', 'default.png', 'Persoană fizică', NULL),
(11, 'Ana Iancu', 'ana.iancu@example.com', NULL, '$2y$12$ev2VVJ5DFJkcTEZRGNIVBumQ9z..QqpOAgO2Igx.DUzE013q0WeDe', NULL, '2024-07-13 11:46:51', '2024-07-13 11:46:51', 'default.png', 'Persoană fizică', NULL),
(12, 'Elena Popa', 'elena.popa@example.com', NULL, '$2y$12$GHrKG813I8IH25NjytwbwufS07Ax2rcWSuAuVKvV.qTWTAOrvozra', NULL, '2024-07-13 11:46:51', '2024-07-13 11:46:51', 'default.png', 'Persoană fizică', NULL),
(13, 'Ioana Nicolae', 'ioana.nicolae@example.com', NULL, '$2y$12$fh8uZ3lK/38lwvPUAR3Uw.j2PXoQ1tQzpDeUyjmc9CAcm3pDFhWCC', NULL, '2024-07-13 11:46:51', '2024-07-13 11:46:51', 'default.png', 'Persoană fizică', NULL),
(14, 'Maria Costea', 'maria.costea@example.com', NULL, '$2y$12$89L6BONIcBa2LClJlO5CF.Rq.DWBXyDnI1NIMA3/447xOd0qu/TD.', NULL, '2024-07-13 11:46:52', '2024-07-13 11:46:52', 'default.png', 'Persoană fizică', NULL),
(15, 'Roxana Marinescu', 'roxana.marinescu@example.com', NULL, '$2y$12$6VFflnNkJJQeaTH0SvqLk.ccxtNCPCk1bBY2/ZUkBZPHEXKpJ5opC', NULL, '2024-07-13 11:46:52', '2024-07-13 11:46:52', 'default.png', 'Persoană fizică', NULL),
(16, 'Sofia Dragoescu', 'sofia.dragoescu@example.com', NULL, '$2y$12$fhpY.hEa.MnYVybE9Q4AB./4XTbT66pEUnb1pGrkGsXhA.IVNtLOS', NULL, '2024-07-13 11:46:52', '2024-07-13 11:46:52', 'default.png', 'Persoană fizică', NULL),
(17, 'Adriana Tudor', 'adriana.tudor@example.com', NULL, '$2y$12$ogpNLlTm5wbDiNcmLm/8Bu7xLvrD0i.JjSCOQCgwRyHnhF1xYXrIG', NULL, '2024-07-13 11:46:52', '2024-07-13 11:46:52', 'default.png', 'Persoană fizică', NULL),
(18, 'Camelia Radu', 'camelia.radu@example.com', NULL, '$2y$12$kX92XzxCG0DL2COicDx37.QRD6yrqHMg2uMtF6ZNbQjkSNs/oN7Xy', NULL, '2024-07-13 11:46:53', '2024-07-13 11:46:53', 'default.png', 'Persoană fizică', NULL),
(19, 'Larisa Fanea', 'larisa.fanea@example.com', NULL, '$2y$12$yn8MWEouHQ90CnsJ4ExX7uunAWVzA9nSIeGgR9hOXceS0gMQOBIru', NULL, '2024-07-13 11:46:53', '2024-07-13 11:46:53', 'default.png', 'Persoană fizică', NULL),
(20, 'Gabriela Toma', 'gabriela.toma@example.com', NULL, '$2y$12$i5y1JrwB3YnZKVW51ynyVOpjC4PD5eM.BY4R/KP9QCH/W.JisepaC', NULL, '2024-07-13 11:46:53', '2024-07-13 11:46:53', 'default.png', 'Persoană fizică', NULL),
(21, 'Chiticariu Cezar-Marian', 'cth.marian@gmail.com', NULL, '$2y$12$vMlHLxxSQZ9AOoapPraGNuE8WDwAJZnRDeWhaX89hGMtMCtsBSwNK', NULL, '2024-07-13 11:46:53', '2024-07-13 11:46:53', 'default.png', 'Persoană fizică', NULL),
(23, 'Chiticariu Cezar-Marian', 'marianczr7@gmail.com', NULL, '$2y$12$vMlHLxxSQZ9AOoapPraGNuE8WDwAJZnRDeWhaX89hGMtMCtsBSwNK', 'kcrQAsgodx0kY4NvA7MzIkrMDOYJkEQw0Q8IjpmDqyEnrx0CH3vO1jpVK1cm', '2024-07-15 09:59:11', '2025-02-20 13:32:20', 'chiticariu-cezar-marian.jpg', 'Agent imobiliar', 3),
(25, 'Cezar-Marian Chiticariu', 'marianczr71@gmail.com', NULL, '$2y$12$uySM4q5bsJwxVTV64S.b2ucfCy5DUwTU6idg/tykTGlpdL5MTggI6', NULL, '2024-08-08 06:30:22', '2024-08-08 06:30:22', 'default.png', 'Persoană fizică', NULL),
(26, 'asdfadf', 'test1234@yahoo.com', NULL, '$2y$12$PzcPQPfQbxgpYjCrDAc8eOMcUPt6nPsTj6wBW0.W.351INjSUDSfq', NULL, '2025-02-19 11:52:15', '2025-02-19 11:52:15', 'default.png', 'Persoană fizică', NULL),
(27, 'Cezar-Marian Chiticariu', 'cth.maria1n@gmail.com', NULL, '$2y$12$ixl2emxPdihHV.LtxBrpaue2g8tY8DAKJInvhPXVQRJ2VBeTjDYSe', NULL, '2025-02-19 11:56:33', '2025-02-19 11:56:33', 'default.png', 'Agent imobiliar', NULL),
(28, 'Johny', 'johny124@yahoo.com', NULL, '$2y$12$NUGOxY1vMDlEVgsVt2ysHegk.sAyNDMdR1IC27m43SkKoIWaJQoES', NULL, '2025-02-20 12:58:13', '2025-02-20 15:12:34', 'default.png', 'Agent imobiliar', 3),
(29, 'Cezar', 'cezarchiticariu@gmail.com', NULL, '$2y$12$qx0vcSjhl0jVKie3/znL9.HmFKsnNTW0Drc43VV40ii7kGsUa4pxC', NULL, '2025-03-08 15:22:43', '2025-03-08 15:22:43', 'default.png', 'Persoană fizică', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Eliminarea datelor din tabel `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 21, 'Aleea Soimilor nr.1', '+40 755 560 779', '2024-07-13 22:07:07', '2024-07-13 22:07:07');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`),
  ADD UNIQUE KEY `companies_email_unique` (`email`),
  ADD KEY `companies_leader_id_foreign` (`leader_id`);

--
-- Indexuri pentru tabele `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexuri pentru tabele `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_property_id_unique` (`user_id`,`property_id`),
  ADD KEY `favorites_property_id_foreign` (`property_id`);

--
-- Indexuri pentru tabele `join_requests`
--
ALTER TABLE `join_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `join_requests_company_id_foreign` (`company_id`),
  ADD KEY `join_requests_user_id_foreign` (`user_id`);

--
-- Indexuri pentru tabele `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_name_unique` (`name`);

--
-- Indexuri pentru tabele `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ticket_id_foreign` (`ticket_id`);

--
-- Indexuri pentru tabele `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexuri pentru tabele `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexuri pentru tabele `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`),
  ADD KEY `properties_type_id_foreign` (`type_id`),
  ADD KEY `properties_location_id_foreign` (`location_id`),
  ADD KEY `properties_status_id_foreign` (`status_id`);

--
-- Indexuri pentru tabele `property_options`
--
ALTER TABLE `property_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `property_statuses`
--
ALTER TABLE `property_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_statuses_name_unique` (`name`);

--
-- Indexuri pentru tabele `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_types_name_unique` (`name`);

--
-- Indexuri pentru tabele `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_email_unique` (`email`);

--
-- Indexuri pentru tabele `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- Indexuri pentru tabele `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pentru tabele `join_requests`
--
ALTER TABLE `join_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pentru tabele `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pentru tabele `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `property_options`
--
ALTER TABLE `property_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pentru tabele `property_statuses`
--
ALTER TABLE `property_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pentru tabele `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_leader_id_foreign` FOREIGN KEY (`leader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constrângeri pentru tabele `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `join_requests`
--
ALTER TABLE `join_requests`
  ADD CONSTRAINT `join_requests_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `join_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `property_statuses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `property_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;

--
-- Constrângeri pentru tabele `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
