-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 06 jan. 2025 à 16:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `slug`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test category 1', 'test description category 1', NULL, 'test-category-1', NULL, '2025-01-03 08:22:39', '2025-01-03 08:22:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `path`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'images/products/gJn05dU52ZN5k0R3BEKEgarKkna2gdFfIJ7XQYqY.jpg', 1, '2025-01-03 08:33:23', '2025-01-03 08:33:23', NULL),
(6, 'images/products/vE2H1ekcOdeuGXAbvTpJ6a6BV7iqoZ5GSqX7QmXG.jpg', 1, '2025-01-03 08:33:23', '2025-01-03 08:33:23', NULL),
(7, 'images/products/bWLCluk2RniFbnZbYoo4bf5CY01fXVxyeg1cPapU.jpg', 1, '2025-01-03 08:33:23', '2025-01-03 08:33:23', NULL),
(8, 'images/products/TgPHRrYQnRGydFYZ9evPwuBd4o4Wqh1BCPRohB67.jpg', 1, '2025-01-03 08:33:23', '2025-01-03 08:33:23', NULL),
(9, 'images/products/5H6bqOpRXlCjoCGB2GuSK99md1yFmAQExGseuPSV.jpg', 2, '2025-01-06 08:30:00', '2025-01-06 08:30:00', NULL),
(10, 'images/products/5OPzR7dXdFk0WN4w1WpsNALlHE5k0IpoyYSxlvNU.jpg', 3, '2025-01-06 08:30:32', '2025-01-06 08:30:32', NULL),
(11, 'images/products/Pf3R1oU5JayyzbIgj4elSIJYq1AerwASAkSEeTCv.jpg', 3, '2025-01-06 08:30:32', '2025-01-06 08:30:32', NULL),
(12, 'images/products/MAUTCVyZLNthguVQSb6QR600dqtmOgrEaMIaElq2.jpg', 3, '2025-01-06 08:30:32', '2025-01-06 08:30:32', NULL),
(13, 'images/products/xXQwwnx6fmb6XSWj49aEPA3ThQUuOF5y9RAJJs7x.jpg', 3, '2025-01-06 08:30:32', '2025-01-06 08:30:32', NULL),
(14, 'images/products/7llZMxhxuA9g1HkKBiL7Xg4RffbRa4OQWvH0DQkp.jpg', 4, '2025-01-06 08:30:52', '2025-01-06 08:30:52', NULL),
(15, 'images/products/iITgD6LrIVNJj9rE8V1cVlKlLIf7dRDF611kdtZt.jpg', 4, '2025-01-06 08:30:52', '2025-01-06 08:30:52', NULL),
(16, 'images/products/2HIVNiBxovb6SW24HrGzqhWQenhMEBWa254eHtjB.jpg', 4, '2025-01-06 08:30:52', '2025-01-06 08:30:52', NULL),
(17, 'images/products/L5afYGE18N8xhwkx40HjwABNhdwyzJ2ez7sK0XJA.jpg', 4, '2025-01-06 08:30:52', '2025-01-06 08:30:52', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_16_083828_create_create_products_tables_table', 1),
(7, '2024_10_16_084040_create_create_images_tables_table', 1),
(8, '2024_10_16_090051_create_categories_table', 1),
(9, '2024_10_25_093450_create_orders_table', 1),
(10, '2024_10_25_111337_create_order_items_table', 1),
(12, '2025_01_03_090310_create_units_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'InProgress',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'InProgress', 2400.00, '2025-01-03 08:37:02', '2025-01-03 08:37:02', NULL),
(2, 1, 'InProgress', 3200.00, '2025-01-03 08:55:25', '2025-01-03 08:55:25', NULL),
(3, 1, 'InProgress', 1600.00, '2025-01-03 08:59:50', '2025-01-03 08:59:50', NULL),
(4, 1, 'InProgress', 1600.00, '2025-01-03 09:01:12', '2025-01-03 09:01:12', NULL),
(5, 1, 'InProgress', 2400.00, '2025-01-03 09:06:24', '2025-01-03 09:06:24', NULL),
(6, 1, 'InProgress', 2400.00, '2025-01-03 09:48:25', '2025-01-03 09:48:25', NULL),
(7, 1, 'InProgress', 2400.00, '2025-01-03 09:49:14', '2025-01-03 09:49:14', NULL),
(8, 1, 'InProgress', 1600.00, '2025-01-03 09:52:13', '2025-01-03 09:52:13', NULL),
(9, 1, 'InProgress', 2400.00, '2025-01-03 09:55:33', '2025-01-03 09:55:33', NULL),
(10, 1, 'InProgress', 2400.00, '2025-01-03 09:55:36', '2025-01-03 09:55:36', NULL),
(11, 1, 'InProgress', 2400.00, '2025-01-03 09:55:40', '2025-01-03 09:55:40', NULL),
(12, 1, 'InProgress', 2400.00, '2025-01-03 09:55:42', '2025-01-03 09:55:42', NULL),
(13, 1, 'InProgress', 2400.00, '2025-01-03 09:59:05', '2025-01-03 09:59:05', NULL),
(14, 1, 'InProgress', 1600.00, '2025-01-03 13:33:05', '2025-01-03 13:33:05', NULL),
(15, 1, 'InProgress', 800.00, '2025-01-03 13:36:12', '2025-01-03 13:36:12', NULL),
(16, 1, 'InProgress', 1600.00, '2025-01-03 13:39:50', '2025-01-03 13:39:50', NULL),
(17, 1, 'InProgress', 800.00, '2025-01-03 13:59:34', '2025-01-03 13:59:34', NULL),
(18, 4, 'InProgress', 2400.00, '2025-01-06 08:12:31', '2025-01-06 08:12:31', NULL),
(19, 4, 'InProgress', 1600.00, '2025-01-06 08:15:57', '2025-01-06 08:15:57', NULL),
(20, 4, 'InProgress', 2400.00, '2025-01-06 08:19:38', '2025-01-06 08:19:38', NULL),
(21, 4, 'InProgress', 800.00, '2025-01-06 08:25:17', '2025-01-06 08:25:17', NULL),
(22, 4, 'InProgress', 800.00, '2025-01-06 08:27:51', '2025-01-06 08:27:51', NULL),
(23, 4, 'InProgress', 1000.00, '2025-01-06 08:43:45', '2025-01-06 08:43:45', NULL),
(24, 4, 'InProgress', 2600.00, '2025-01-06 08:48:23', '2025-01-06 08:48:23', NULL),
(25, 4, 'InProgress', 1600.00, '2025-01-06 09:52:19', '2025-01-06 09:52:19', NULL),
(26, 4, 'InProgress', 1600.00, '2025-01-06 09:52:45', '2025-01-06 09:52:45', NULL),
(27, 4, 'InProgress', 1600.00, '2025-01-06 09:54:06', '2025-01-06 09:54:06', NULL),
(28, 4, 'InProgress', 1400.00, '2025-01-06 09:57:48', '2025-01-06 09:57:48', NULL),
(29, 5, 'InProgress', 2200.00, '2025-01-06 14:13:22', '2025-01-06 14:13:22', NULL),
(30, 4, 'InProgress', 4000.00, '2025-01-06 14:22:46', '2025-01-06 14:22:46', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `user_id`, `product_id`, `quantity`, `size`, `order_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 'size_made', 1, '2025-01-03 08:37:02', '2025-01-03 08:37:02', NULL),
(2, 1, 1, 4, 'size_made', 2, '2025-01-03 08:55:25', '2025-01-03 08:55:25', NULL),
(3, 1, 1, 2, 'size_made', 3, '2025-01-03 08:59:50', '2025-01-03 08:59:50', NULL),
(4, 1, 1, 2, 'size_made', 4, '2025-01-03 09:01:12', '2025-01-03 09:01:12', NULL),
(5, 1, 1, 3, 'size_made', 5, '2025-01-03 09:06:24', '2025-01-03 09:06:24', NULL),
(6, 1, 1, 3, 'size_made', 6, '2025-01-03 09:48:25', '2025-01-03 09:48:25', NULL),
(7, 1, 1, 3, 'size_made', 7, '2025-01-03 09:49:14', '2025-01-03 09:49:14', NULL),
(8, 1, 1, 2, 'size_made', 8, '2025-01-03 09:52:13', '2025-01-03 09:52:13', NULL),
(9, 1, 1, 3, 'size_made', 9, '2025-01-03 09:55:33', '2025-01-03 09:55:33', NULL),
(10, 1, 1, 3, 'size_made', 10, '2025-01-03 09:55:36', '2025-01-03 09:55:36', NULL),
(11, 1, 1, 3, 'size_made', 11, '2025-01-03 09:55:40', '2025-01-03 09:55:40', NULL),
(12, 1, 1, 3, 'size_made', 12, '2025-01-03 09:55:42', '2025-01-03 09:55:42', NULL),
(13, 1, 1, 3, 'size_made', 13, '2025-01-03 09:59:05', '2025-01-03 09:59:05', NULL),
(14, 1, 1, 2, 'size_made', 14, '2025-01-03 13:33:05', '2025-01-03 13:33:05', NULL),
(15, 1, 1, 1, 'size_made', 15, '2025-01-03 13:36:12', '2025-01-03 13:36:12', NULL),
(16, 1, 1, 2, 'size_made', 16, '2025-01-03 13:39:50', '2025-01-03 13:39:50', NULL),
(17, 1, 1, 1, 'size_made', 17, '2025-01-03 13:59:34', '2025-01-03 13:59:34', NULL),
(18, 4, 1, 3, 'size_made', 18, '2025-01-06 08:12:31', '2025-01-06 08:12:31', NULL),
(19, 4, 1, 2, 'size_made', 19, '2025-01-06 08:15:57', '2025-01-06 08:15:57', NULL),
(20, 4, 1, 3, 'size_made', 20, '2025-01-06 08:19:38', '2025-01-06 08:19:38', NULL),
(21, 4, 1, 1, 'size_made', 21, '2025-01-06 08:25:17', '2025-01-06 08:25:17', NULL),
(22, 4, 1, 1, 'size_made', 22, '2025-01-06 08:27:51', '2025-01-06 08:27:51', NULL),
(23, 4, 4, 2, 'size_made', 23, '2025-01-06 08:43:45', '2025-01-06 08:43:45', NULL),
(24, 4, 3, 2, 'size_made', 24, '2025-01-06 08:48:23', '2025-01-06 08:48:23', NULL),
(25, 4, 4, 2, 'size_made', 24, '2025-01-06 08:48:23', '2025-01-06 08:48:23', NULL),
(26, 4, 1, 2, 'size_made', 25, '2025-01-06 09:52:19', '2025-01-06 09:52:19', NULL),
(27, 4, 1, 2, 'size_made', 26, '2025-01-06 09:52:45', '2025-01-06 09:52:45', NULL),
(28, 4, 1, 2, 'size_made', 27, '2025-01-06 09:54:06', '2025-01-06 09:54:06', NULL),
(29, 4, 1, 1, 'size_made', 28, '2025-01-06 09:57:48', '2025-01-06 09:57:48', NULL),
(30, 4, 2, 1, 'size_made', 28, '2025-01-06 09:57:48', '2025-01-06 09:57:48', NULL),
(31, 5, 1, 1, 'size_made', 29, '2025-01-06 14:13:22', '2025-01-06 14:13:22', NULL),
(32, 5, 2, 1, 'size_made', 29, '2025-01-06 14:13:22', '2025-01-06 14:13:22', NULL),
(33, 5, 3, 1, 'size_made', 29, '2025-01-06 14:13:22', '2025-01-06 14:13:22', NULL),
(34, 4, 1, 2, 'size_made', 30, '2025-01-06 14:22:46', '2025-01-06 14:22:46', NULL),
(35, 4, 3, 3, 'size_made', 30, '2025-01-06 14:22:46', '2025-01-06 14:22:46', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
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
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sizes` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `stock`, `sizes`, `image`, `category_id`, `unit_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'product 1', 'product-1', 'test description 1', 800.00, NULL, NULL, 'images/products/4uPFaDmTGMbJwfkk2FRGOBsDnma13WJ85BVKzw9d.jpg', '1', 1, '2025-01-03 08:24:05', '2025-01-06 07:37:59', NULL),
(2, 'product 2', 'product-2', 'Description Description', 600.00, NULL, NULL, 'images/products/sF8Z9bfegAD9pdBDTS83rji7aR4LdlBSQEFrLNpZ.jpg', '1', 1, '2025-01-06 08:30:00', '2025-01-06 08:30:00', NULL),
(3, 'product 3', 'product-3', 'Description Description', 800.00, NULL, NULL, 'images/products/rcynF8Ujy6AUmuoQDvusd3fJ7GdS5vGDMeLeh4j8.jpg', '1', 1, '2025-01-06 08:30:32', '2025-01-06 08:30:32', NULL),
(4, 'product 4', 'product-4', 'Description Description', 500.00, NULL, NULL, 'images/products/Wq4bo48JuqHxgLX9IPGYrvZ59rdLTxCOWD0WLJ4F.jpg', '1', 1, '2025-01-06 08:30:52', '2025-01-06 08:30:52', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `units`
--

INSERT INTO `units` (`id`, `name`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test units 1', '10', '2025-01-03 08:17:34', '2025-01-03 08:17:47', NULL),
(2, 'aa', '3', '2025-01-03 08:18:01', '2025-01-03 08:18:07', '2025-01-03 08:18:07');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdelilah ezzyraouy', 'abdelilahezzyraouy@gmail.com', '060609109706', 'casablanca', NULL, '$2y$12$1L1xxCfE777sEqCrsgvpzeRn5yVuHS5yWQm0FI36onSm62KP7oCSC', 'admin', NULL, '2025-01-03 08:36:59', '2025-01-03 08:36:59'),
(4, 'saad elgh', 'saad@gnail.com', '0609106603', 'saad@gnail.com', NULL, '$2y$12$pdbrOPHiQrfOwx14V4QmG.zKLtPkiGJjoSdXJSbHNJuop3KwY8jwC', 'user', NULL, '2025-01-06 08:02:44', '2025-01-06 08:02:44'),
(5, 'saad elgh', 'saad2@gnail.com', '0609106603', 'casablanca , maroc', NULL, '$2y$12$Xmubt0AUzyVOJhBJFjxf9uVZEtqz0xOgvYu3MEoRwTY5WCRShb2zm', 'user', NULL, '2025-01-06 14:13:17', '2025-01-06 14:13:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
