-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 août 2024 à 19:37
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `legislative`
--

-- --------------------------------------------------------

--
-- Structure de la table `cartes`
--

CREATE TABLE `cartes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datenaiss` date NOT NULL,
  `lieunaiss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numelec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `region_id`, `created_at`, `updated_at`, `nb`) VALUES
(1, 'THIES', 3, '2024-08-01 11:44:09', '2024-08-12 18:52:35', 4),
(2, 'FATICK', 12, '2024-08-01 11:44:09', '2024-08-12 18:43:40', 2),
(3, 'KAOLACK', 13, '2024-08-01 11:44:09', '2024-08-12 18:44:53', 2),
(4, 'LINGUERE', 2, '2024-08-01 11:44:09', '2024-08-12 18:48:10', 2),
(5, 'DAKAR', 9, '2024-08-01 11:44:09', '2024-08-12 18:40:59', 7),
(6, 'GUEDIAWAYE', 9, '2024-08-01 11:44:09', '2024-08-12 18:42:05', 2),
(7, 'NIORO DU RIP', 13, '2024-08-01 11:44:09', '2024-08-12 18:56:56', 2),
(8, 'PIKINE', 9, '2024-08-01 11:44:09', '2024-08-12 18:56:19', 5),
(9, 'TIVAOUANE', 3, '2024-08-01 11:44:09', '2024-08-12 18:52:51', 2),
(10, 'KAFFRINE', 14, '2024-08-01 11:44:09', '2024-08-12 18:44:02', 2),
(11, 'OUSSOUYE', 15, '2024-08-01 11:44:09', '2024-08-12 18:53:27', 1),
(12, 'BAMBEY', 11, '2024-08-01 11:44:09', '2024-08-12 18:43:11', 2),
(13, 'GUINGUINEO', 13, '2024-08-01 11:44:09', '2024-08-12 18:57:14', 1),
(14, 'MBOUR', 3, '2024-08-01 11:44:09', '2024-08-12 18:52:13', 4),
(15, 'ZIGUINCHOR', 15, '2024-08-01 11:44:09', '2024-08-12 18:53:47', 2),
(16, 'KEUR MASSAR', 9, '2024-08-01 11:44:09', '2024-08-12 18:42:29', 2),
(17, 'RUFISQUE', 9, '2024-08-01 11:44:09', '2024-08-12 18:42:54', 2),
(18, 'BIGNONA', 15, '2024-08-01 11:44:09', '2024-08-12 18:53:11', 2),
(19, 'SAINT LOUIS', 10, '2024-08-01 11:44:09', '2024-08-12 18:49:52', 2),
(20, 'KANEL', 4, '2024-08-01 11:44:09', '2024-08-12 18:57:41', 2),
(21, 'VELINGARA', 7, '2024-08-01 11:44:09', '2024-08-12 18:47:45', 2),
(22, 'GOUDIRY', 5, '2024-08-01 11:44:09', '2024-08-12 18:51:02', 1),
(23, 'KOUMPENTOUM', 5, '2024-08-01 11:44:09', '2024-08-12 18:58:18', 2),
(24, 'FOUNDIOUGNE', 12, '2024-08-01 11:44:09', '2024-08-12 18:58:48', 2),
(25, 'KOLDA', 7, '2024-08-01 11:44:09', '2024-08-12 18:47:25', 2),
(26, 'MATAM', 4, '2024-08-01 11:44:09', '2024-08-12 18:48:49', 2),
(27, 'TAMBACOUNDA', 5, '2024-08-01 11:44:09', '2024-08-12 18:51:56', 2),
(28, 'MBACKE', 11, '2024-08-01 11:44:09', '2024-08-12 19:00:00', 5),
(29, 'BIRKILANE', 14, '2024-08-01 11:44:09', '2024-08-12 19:00:24', 1),
(30, 'MEDINA YORO FOULAH', 7, '2024-08-01 11:44:09', '2024-08-12 19:00:52', 2),
(31, 'KEBEMER', 2, '2024-08-01 11:44:09', '2024-08-12 22:44:01', 2),
(32, 'KOUNGHEUL', 14, '2024-08-01 11:44:09', '2024-08-12 18:44:28', 2),
(33, 'LOUGA', 2, '2024-08-01 11:44:09', '2024-08-12 18:48:28', 2),
(34, 'SEDHIOU', 8, '2024-08-01 11:44:09', '2024-08-12 18:50:41', 2),
(35, 'KEDOUGOU', 6, '2024-08-01 11:44:09', '2024-08-12 18:46:40', 1),
(36, 'GOSSAS', 12, '2024-08-01 11:44:09', '2024-08-12 22:44:43', 1),
(37, 'PODOR', 10, '2024-08-01 11:44:09', '2024-08-12 22:45:03', 2),
(38, 'DAGANA', 10, '2024-08-01 11:44:09', '2024-08-12 18:49:30', 2),
(39, 'BAKEL', 5, '2024-08-01 11:44:09', '2024-08-12 19:02:23', 2),
(40, 'SALEMATA', 6, '2024-08-01 11:44:09', '2024-08-12 19:02:50', 1),
(41, 'RANEROU FERLO', 4, '2024-08-01 11:44:09', '2024-08-12 18:49:09', 1),
(42, 'DIOURBEL', 11, '2024-08-01 11:44:09', '2024-08-12 19:03:17', 2),
(43, 'BOUNKILING', 8, '2024-08-01 11:44:09', '2024-08-12 19:03:59', 2),
(44, 'SARAYA', 6, '2024-08-01 11:44:09', '2024-08-12 19:04:24', 1),
(45, 'GOUDOMP', 8, '2024-08-01 11:44:09', '2024-08-12 18:50:15', 2),
(46, 'MALEM HODAR', 14, '2024-08-01 11:44:09', '2024-08-12 19:04:58', 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `listes`
--

CREATE TABLE `listes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `listes`
--

INSERT INTO `listes` (`id`, `nom`, `created_at`, `updated_at`, `type`) VALUES
(1, 'COALITION   : YEWWI ASKAN WI', '2024-07-29 22:37:35', '2024-08-11 12:37:47', 'partie_ou_coalition'),
(2, 'Benno BOKK YAKAR', '2024-08-06 00:12:43', '2024-08-11 12:38:00', 'independant');

-- --------------------------------------------------------

--
-- Structure de la table `liste_departementals`
--

CREATE TABLE `liste_departementals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numelecteur` int(11) NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datenaiss` date NOT NULL,
  `lieunaiss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numcni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `liste_id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extrait_ou_cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `ordre` int(11) DEFAULT NULL,
  `erreur` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `erreurdge` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `liste_departementals`
--

INSERT INTO `liste_departementals` (`id`, `nom`, `prenom`, `numelecteur`, `sexe`, `profession`, `datenaiss`, `lieunaiss`, `numcni`, `type`, `liste_id`, `departement_id`, `created_at`, `updated_at`, `extrait_ou_cni`, `casier`, `etat`, `ordre`, `erreur`, `erreurdge`, `domicile`, `se`) VALUES
(1, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 5, '2024-08-13 15:12:04', '2024-08-13 15:12:04', NULL, NULL, 0, 1, '', '', NULL, NULL),
(2, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 5, '2024-08-13 15:12:47', '2024-08-13 15:12:47', NULL, NULL, 0, 2, ' Partite non respecter Doublon interne', 'Partite non respecter Doublon externe ou interne Doublon interne ', NULL, NULL),
(3, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'supleant', 1, 5, '2024-08-13 15:13:19', '2024-08-13 15:13:19', NULL, NULL, 0, 1, ' Doublon interne', ' Doublon externe ou interne Doublon interne ', NULL, NULL),
(4, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 35, '2024-08-13 17:22:27', '2024-08-13 17:22:27', NULL, NULL, 0, 1, ' Doublon interne', ' Doublon externe ou interne Doublon interne ', NULL, NULL),
(5, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'supleant', 1, 35, '2024-08-13 17:23:45', '2024-08-13 17:23:45', NULL, NULL, 0, 1, ' Parite non respecter Doublon interne', 'Partite non respecter  Doublon externe ou interne Doublon interne ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `liste_nationals`
--

CREATE TABLE `liste_nationals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numelecteur` int(11) NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datenaiss` date NOT NULL,
  `lieunaiss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numcni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `liste_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extrait_ou_cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `casier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `ordre` int(11) DEFAULT NULL,
  `erreur` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `erreurdge` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `se` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `liste_nationals`
--

INSERT INTO `liste_nationals` (`id`, `nom`, `prenom`, `numelecteur`, `sexe`, `profession`, `datenaiss`, `lieunaiss`, `numcni`, `type`, `liste_id`, `created_at`, `updated_at`, `extrait_ou_cni`, `casier`, `etat`, `ordre`, `erreur`, `erreurdge`, `domicile`, `se`) VALUES
(3, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, '2024-08-13 15:26:26', '2024-08-13 15:26:26', NULL, NULL, 0, 1, 'Doublon interne', 'Doublon externe ou interneDoublon interne ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_09_102736_create_regions_table', 1),
(6, '2023_09_09_102903_create_departements_table', 1),
(7, '2024_07_29_222353_create_listes_table', 2),
(8, '2024_07_30_123336_create_liste_nationals_table', 3),
(9, '2024_07_30_123419_create_liste_departementals_table', 3),
(11, '2024_07_31_165131_add_column_file_to_liste_nationals_table', 4),
(12, '2024_07_31_165204_add_column_file_to_liste_departementals_table', 4),
(13, '2024_08_02_100007_add_column_etat_to_liste_nationals_table', 5),
(14, '2024_08_02_100019_add_column_file_to_etat_departementals_table', 6),
(15, '2024_08_02_102920_add_column_ordre_to_liste_nationals_table', 7),
(16, '2024_08_02_102936_add_column_ordre_to_liste_departementals_table', 7),
(17, '2024_08_02_154643_update_table_add_column_liste_id_to_users_table', 8),
(18, '2024_08_02_164517_update_table_add_column_role_to_users_table', 9),
(19, '2024_08_10_161647_add_column_erreur_to_liste_nationals_table', 10),
(20, '2024_08_10_161719_add_column_erreur_to_liste_departementals_table', 10),
(21, '2024_08_10_171314_add_column_erreudger_to_liste_departementals_table', 11),
(22, '2024_08_10_171324_add_column_erreurdge_to_liste_nationals_table', 11),
(23, '2024_08_11_003552_add_column_domicile_and_se_to_liste_nationals_table', 12),
(24, '2024_08_11_003616_add_column_domicile_and_se_to_liste_departementals_table', 12),
(25, '2024_08_11_121535_add_column_type_to_listes_table', 13),
(26, '2024_08_12_182152_add_colum_nb_to_departements_table', 14);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
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
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(2, 'LOUGA', NULL, NULL),
(3, 'THIES', NULL, NULL),
(4, 'MATAM', NULL, NULL),
(5, 'TAMBACOUNDA', NULL, NULL),
(6, 'KEDOUGOU', NULL, NULL),
(7, 'KOLDA', NULL, NULL),
(8, 'SEDHIOU', NULL, NULL),
(9, 'DAKAR', NULL, NULL),
(10, 'SAINT LOUIS', NULL, NULL),
(11, 'DIOURBEL', NULL, NULL),
(12, 'FATICK', NULL, NULL),
(13, 'KAOLACK', NULL, NULL),
(14, 'KAFFRINE', NULL, NULL),
(15, 'ZIGUINCHOR', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
  `liste_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `liste_id`, `role`) VALUES
(3, 'Ibra Ndiaye', 'ibra789ndiaye@gmail.com', NULL, '$2y$12$LAIX36c1eylUbeXfiQNWEuN0UEEeTlET5DMv/RfDzQzRaAHkvwNEW', NULL, '2024-08-05 09:40:06', '2024-08-05 09:40:06', NULL, 'admin'),
(4, 'Ibra Ndiaye', 'ibra8580@hotmail.com', NULL, '$2y$12$uXjgQqtIg6L8kHF2vCyjY.kl7A4ut5LKqEL4mYNa3AThNh/74f5D.', NULL, '2024-08-05 09:42:33', '2024-08-05 09:42:33', 1, 'candidats'),
(5, 'Djiby cisse', 'ibra93_3@live.com', NULL, '$2y$12$fcV70PCJiqqHuVE77uMbgO6ve638QT2S4NmAxwOJfD.fd86uIHW.e', NULL, '2024-08-06 00:13:31', '2024-08-06 00:14:12', 2, 'candidats');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cartes`
--
ALTER TABLE `cartes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartes_commune_id_foreign` (`commune_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departements_region_id_foreign` (`region_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `listes`
--
ALTER TABLE `listes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_departementals`
--
ALTER TABLE `liste_departementals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liste_departementals_liste_id_foreign` (`liste_id`),
  ADD KEY `liste_departementals_departement_id_foreign` (`departement_id`),
  ADD KEY `numelecteur` (`numelecteur`),
  ADD KEY `numcni` (`numcni`);

--
-- Index pour la table `liste_nationals`
--
ALTER TABLE `liste_nationals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liste_nationals_liste_id_foreign` (`liste_id`),
  ADD KEY `numcni` (`numcni`),
  ADD KEY `numelecteur` (`numelecteur`);

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
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_liste_id_foreign` (`liste_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cartes`
--
ALTER TABLE `cartes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6787785;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `listes`
--
ALTER TABLE `listes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `liste_departementals`
--
ALTER TABLE `liste_departementals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `liste_nationals`
--
ALTER TABLE `liste_nationals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cartes`
--
ALTER TABLE `cartes`
  ADD CONSTRAINT `cartes_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`);

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Contraintes pour la table `liste_departementals`
--
ALTER TABLE `liste_departementals`
  ADD CONSTRAINT `liste_departementals_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `liste_departementals_liste_id_foreign` FOREIGN KEY (`liste_id`) REFERENCES `listes` (`id`);

--
-- Contraintes pour la table `liste_nationals`
--
ALTER TABLE `liste_nationals`
  ADD CONSTRAINT `liste_nationals_liste_id_foreign` FOREIGN KEY (`liste_id`) REFERENCES `listes` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_liste_id_foreign` FOREIGN KEY (`liste_id`) REFERENCES `listes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
