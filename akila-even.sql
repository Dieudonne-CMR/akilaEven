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
)

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
)

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
)

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
)

CREATE TABLE `villes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
)