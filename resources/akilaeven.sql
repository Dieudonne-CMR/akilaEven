-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 avr. 2025 à 19:37
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `akilaeven`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_donalbayiha@manaschool.net|127.0.0.1', 'i:1;', 1743586683),
('laravel_cache_donalbayiha@manaschool.net|127.0.0.1:timer', 'i:1743586683;', 1743586683);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_halls`
--

CREATE TABLE `event_halls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `nom_salle` varchar(255) NOT NULL,
  `description_salle` text NOT NULL,
  `localisation` text NOT NULL,
  `capacite` int(11) NOT NULL,
  `prix` decimal(15,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_halls`
--

INSERT INTO `event_halls` (`id`, `hotel_id`, `nom_salle`, `description_salle`, `localisation`, `capacite`, `prix`, `photo`, `photo1`, `photo2`, `photo3`, `photo4`, `created_at`, `updated_at`, `ville_id`, `user_id`) VALUES
(1, 2, 'Makepe palace', 'llllllllllllllllllllllllllll', 'logpom', 145, 120000000.00, NULL, NULL, NULL, NULL, NULL, '2025-04-02 04:17:40', '2025-04-02 04:17:40', 1, 1),
(2, 2, 'logpom', 'je la', 'Ndokoti', 4580, 125000.00, 'event_halls/GQrWo82RPmoiF0dYdyjyzo9qk2t63IfC1YtctFJD.png', 'event_halls/HOoWWaa4pfeg7TBMhcjpwUQh9LaU7yhT3HkBfPur.png', NULL, NULL, NULL, '2025-04-02 05:01:17', '2025-04-02 05:01:17', 2, 1),
(3, 2, 'logpom', 'je la', 'Ndokoti', 4580, 125000.00, 'event_halls/iRz7qyP4a1DtscIytFjgAMILUz59xRaxvZvTnBnz.png', 'event_halls/pXWFH0GUwhi2i1F4rcGKfiHLywNwM1Im8YRP7NrM.png', NULL, NULL, NULL, '2025-04-02 05:01:53', '2025-04-02 05:01:53', 2, 1),
(4, 2, 'logpom', 'je suis la', 'Ndokoti', 150, 125000.00, 'event_halls/LcAYWUlcyX1YiD9DdlHLKD4vgoqLh5THPYOcFmFc.png', 'event_halls/U47az9s8zCB51iyang8dTZjNmB0pXqt8CS02b8nR.png', NULL, NULL, NULL, '2025-04-02 05:03:15', '2025-04-04 06:46:59', 1, 1),
(5, 2, 'logpom', 'log', 'Ndokoti', 4580, 125000.00, 'event_halls/WE6rLAmaUyoLHcHTRv0QWSvViztS7uelo4jkmhAD.png', NULL, NULL, NULL, NULL, '2025-04-02 05:05:23', '2025-04-02 05:05:23', 1, 1),
(6, 2, 'logpom', 'log', 'Ndokoti', 4580, 125000.00, 'event_halls/SV5DsFpQU4OmvB3BN7A72eP5VxIVUSOajcaJhlvl.png', NULL, NULL, NULL, NULL, '2025-04-02 05:15:34', '2025-04-02 05:15:34', 1, 1),
(7, 2, 'logpom', 'log', 'Ndokoti', 4580, 125000.00, 'event_halls/8FrKtAMCmiuCW84SCZkFfQpuJlhy4GU11V2e3DIZ.png', NULL, NULL, NULL, NULL, '2025-04-02 05:34:57', '2025-04-02 05:34:57', 1, 1),
(8, 1, 'Makepe palace', 'j  ddeee', 'Ndokoti', 145, 588888.00, 'event_halls/vnfnoWT3w93d7bIXCmiSyNDOt09QS1kd5bIqDN8w.png', NULL, NULL, NULL, NULL, '2025-04-02 07:38:17', '2025-04-02 07:38:17', 1, 1);

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
-- Structure de la table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_hotel` varchar(255) NOT NULL,
  `description_hotel` text NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bannier1` varchar(255) DEFAULT NULL,
  `bannier2` varchar(255) DEFAULT NULL,
  `bannier3` varchar(255) DEFAULT NULL,
  `matricule_hotel` varchar(255) NOT NULL,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mat_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `nom_hotel`, `description_hotel`, `logo`, `ville`, `localisation`, `telephone`, `email`, `bannier1`, `bannier2`, `bannier3`, `matricule_hotel`, `date_at`, `mat_user`, `created_at`, `updated_at`) VALUES
(1, 'Makepe palace', 'log hotel', 'logos/QG5yozvkawkWm3BqUVnznpGkhSXUS1DJzm9pXfoA.png', 'Douala', 'logpom', NULL, NULL, 'banners/yeyM657UEHKy6WO6Qr7VPw62WmV1J4UOIcc8veoj.jpg', 'banners/ZkF1KkjLtQTAkO9vBUQZLDT9DOaOAAxHm5DeH9eQ.jpg', NULL, 'HOTEL-NCRFEH250322', '2025-03-22 22:27:34', 1, '2025-03-22 21:27:34', '2025-03-22 21:27:34'),
(2, 'Makepe palace', 'je s', 'logos/YDh3Fz24rQ4gzSQ3rUIsJlXzPZ94jHwvsJ7OhWEx.png', 'Douala', 'logpom', '0620110831', 'bayihaFrank2022@gmail.com', 'banners/VfM0T06KuWUeST1V4EQGBh7n0nqsWEOdEzVNDCyH.png', 'banners/CVSlV08oTeltNgTVhHLtA6TXKE0dPRyFwbozdZGv.png', 'banners/a4SOFPFXVDSuIxrAddPm9vkgtoD4JQKYMOYGQusC.png', 'HOTEL-FOZWQL250401', '2025-04-01 21:58:51', 1, '2025-04-01 19:58:51', '2025-04-01 19:58:51');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_22_200211_create_hotels_table', 2),
(5, '2025_03_22_231628_add_phone_email_to_hotels_table', 3),
(6, '2025_03_23_233352_create_rooms_table', 4),
(7, '2025_03_23_233813_create_event_halls_table', 4),
(8, '2025_04_01_144123_create_villes_table', 5),
(9, '2025_04_01_144504_add_ville_id_to_event_halls', 5),
(10, '2025_04_01_163117_add_user_id_to_event_halls', 6);

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
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `nom_chambre` varchar(255) NOT NULL,
  `description_chambre` text NOT NULL,
  `localisation` text NOT NULL,
  `capacite` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Kjgidcv9D0A3fNXTxnrk5GMeUFM5C4KttQAXDeIy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkdwZ0tEM2h4MjJjMXZWTGFSOHpCTTZ3U3hTY1hFUHNUdExkNmkxViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXRlLWRldGFpbC1zYWxsZXNmZXRlcy0yP3BhZ2U9MiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744009016);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dony', 'donalbayiha@gmail.com', NULL, '$2y$12$E/MNr96PBpgHGixBnCJa7e75L1LqSKncBijiYz553IYDbIUMNEoqe', NULL, '2025-03-22 08:00:36', '2025-03-22 08:00:36');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Douala', NULL, NULL),
(2, 'Yaoundé', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `event_halls`
--
ALTER TABLE `event_halls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_halls_hotel_id_foreign` (`hotel_id`),
  ADD KEY `event_halls_ville_id_foreign` (`ville_id`),
  ADD KEY `event_halls_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hotels_matricule_hotel_unique` (`matricule_hotel`),
  ADD KEY `hotels_mat_user_foreign` (`mat_user`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_hotel_id_foreign` (`hotel_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `villes_nom_unique` (`nom`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `event_halls`
--
ALTER TABLE `event_halls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event_halls`
--
ALTER TABLE `event_halls`
  ADD CONSTRAINT `event_halls_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_halls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_halls_ville_id_foreign` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_mat_user_foreign` FOREIGN KEY (`mat_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
