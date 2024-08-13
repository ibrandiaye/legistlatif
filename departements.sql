-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 août 2024 à 19:28
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

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departements_region_id_foreign` (`region_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
