-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 août 2024 à 16:10
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'THIES', 3, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(2, 'FATICK', 12, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(3, 'KAOLACK', 13, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(4, 'LINGUERE', 2, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(5, 'DAKAR', 9, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(6, 'GUEDIAWAYE', 9, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(7, 'NIORO DU RIP', 13, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(8, 'PIKINE', 9, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(9, 'TIVAOUANE', 3, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(10, 'KAFFRINE', 14, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(11, 'OUSSOUYE', 15, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(12, 'BAMBEY', 11, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(13, 'GUINGUINEO', 13, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(14, 'MBOUR', 3, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(15, 'ZIGUINCHOR', 15, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(16, 'KEUR MASSAR', 9, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(17, 'RUFISQUE', 9, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(18, 'BIGNONA', 15, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(19, 'SAINT LOUIS', 10, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(20, 'KANEL', 4, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(21, 'VELINGARA', 7, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(22, 'GOUDIRY', 5, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(23, 'KOUMPENTOUM', 5, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(24, 'FOUNDIOUGNE', 12, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(25, 'KOLDA', 7, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(26, 'MATAM', 4, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(27, 'TAMBACOUNDA', 5, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(28, 'MBACKE', 11, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(29, 'BIRKILANE', 14, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(30, 'MEDINA YORO FOULAH', 7, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(31, 'KEBEMER', 2, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(32, 'KOUNGHEUL', 14, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(33, 'LOUGA', 2, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(34, 'SEDHIOU', 8, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(35, 'KEDOUGOU', 6, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(36, 'GOSSAS', 12, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(37, 'PODOR', 10, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(38, 'DAGANA', 10, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(39, 'BAKEL', 5, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(40, 'SALEMATA', 6, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(41, 'RANEROU FERLO', 4, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(42, 'DIOURBEL', 11, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(43, 'BOUNKILING', 8, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(44, 'SARAYA', 6, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(45, 'GOUDOMP', 8, '2024-08-01 11:44:09', '2024-08-01 11:44:09'),
(46, 'MALEM HODAR', 14, '2024-08-01 11:44:09', '2024-08-01 11:44:09');

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
(1, 'Ndiaye', 'Ibra', 145623587, 'M', 'Informaticien', '1997-01-02', 'Dakar', '1496200400459', 'titulaire', 1, 1, '2024-08-01 11:45:32', '2024-08-01 11:45:32', '66ab755c57e1d.pdf', '66ab755c57e1d.pdf', 0, NULL, NULL, NULL, NULL, NULL),
(2, 'DIAS', 'BARTHELEMY TOYE', 100090791, 'M', NULL, '1975-09-23', 'DAKAR', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL),
(3, 'BA', 'FATOU', 120328401, 'F', NULL, '1980-05-06', 'FOROU PEULH', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 2, NULL, NULL, NULL, NULL),
(4, 'MBENGUE', 'BABACAR', 100031010, 'M', NULL, '1969-12-22', 'DAKAR', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 3, NULL, NULL, NULL, NULL),
(5, 'BATHILY', 'NDIALOU', 105890118, 'F', NULL, '1978-07-14', 'DAKAR', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 4, NULL, NULL, NULL, NULL),
(6, 'FALL', 'ABASS', 100147309, 'M', NULL, '1966-11-11', 'DAKAR', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 5, NULL, NULL, NULL, NULL),
(7, 'SARR', 'JOSEPH', 100088775, 'M', NULL, '1955-06-24', 'KHAOULTOC NGHOL', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 6, NULL, NULL, NULL, NULL),
(8, 'SAMBA', 'PALLA', 100542867, 'M', NULL, '1962-08-11', 'DAKAR', NULL, 'titulaire', 1, 1, '2024-08-02 11:20:12', '2024-08-02 11:20:12', NULL, NULL, 0, 7, NULL, NULL, NULL, NULL),
(9, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'supleant', 1, 1, '2024-08-05 22:33:26', '2024-08-05 22:33:26', '66b1533638898.pdf', '66b1533638898.pdf', 0, NULL, NULL, NULL, NULL, NULL),
(10, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'supleant', 2, 1, '2024-08-06 00:15:53', '2024-08-06 12:27:51', '66b16b3920a0b.pdf', '66b16b3920a0b.pdf', 0, -3, NULL, NULL, NULL, NULL),
(11, 'NDIAYE', 'MOUSSA', 106723795, 'F', 'Informaticien', '1983-02-04', 'Dakar', '1751198300440', 'supleant', 1, 6, '2024-08-07 00:17:56', '2024-08-07 00:17:56', NULL, NULL, 0, 7, NULL, NULL, NULL, NULL),
(12, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 1, '2024-08-10 17:58:58', '2024-08-10 17:58:58', NULL, NULL, 0, 17, 'Partite non respecter', 'Partite non respecterDoublon externe ou interneDoublon interne', NULL, NULL),
(13, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 1, '2024-08-10 18:12:05', '2024-08-10 18:12:05', NULL, NULL, 0, 19, 'Partite non respecter', 'Partite non respecterDoublon externe ou interneDoublon interne', NULL, NULL),
(14, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 1, '2024-08-10 18:14:31', '2024-08-10 18:14:31', NULL, NULL, 0, 20, 'Partite non respecterDoublon interne', 'Partite non respecterDoublon externe ou interneDoublon interne ', NULL, NULL),
(15, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '2000-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 4, '2024-08-11 21:58:05', '2024-08-11 21:58:05', NULL, NULL, 0, 1, ' Doublon interne', ' Doublon externe ou interne Doublon interne ', NULL, NULL),
(16, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '2000-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 4, '2024-08-11 21:59:56', '2024-08-11 21:59:56', NULL, NULL, 0, 1, ' Doublon interne', ' Doublon externe ou interne Doublon interne ', NULL, NULL),
(17, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '2000-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 4, '2024-08-11 22:01:05', '2024-08-11 22:01:05', NULL, NULL, 0, 1, ' Doublon interne', 'age minimun non ateint. age : 24 ans Doublon externe ou interne Doublon interne ', NULL, NULL),
(18, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '2000-03-02', 'Dakar', '1496200400459', 'titulaire', 1, 2, '2024-08-12 13:40:58', '2024-08-12 13:40:58', NULL, NULL, 0, 22, ' Doublon interne', 'age minimun non ateint. age : 24 ans Doublon externe ou interne Doublon interne ', NULL, NULL);

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
(1, 'Ndiaye', 'Ibra', 123658954, 'M', 'Informaticien', '1996-01-01', 'Dakar', '12478564523', 'titulaire', 1, '2024-08-01 11:31:34', '2024-08-01 11:31:34', '66ab72160a1b3.pdf', '66ab72160a1b3.pdf', 0, NULL, NULL, NULL, NULL, NULL),
(2, 'DIAS', 'BARTHELEMY TOYE', 100090791, 'M', NULL, '1975-09-23', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL),
(3, 'BA', 'FATOU', 120328401, 'F', NULL, '1980-05-06', 'FOROU PEULH', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 2, NULL, NULL, NULL, NULL),
(4, 'MBENGUE', 'BABACAR', 100031010, 'M', NULL, '1969-12-22', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 3, NULL, NULL, NULL, NULL),
(5, 'BATHILY', 'NDIALOU', 105890118, 'F', NULL, '1978-07-14', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 4, NULL, NULL, NULL, NULL),
(6, 'FALL', 'ABASS', 100147309, 'M', NULL, '1966-11-11', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 5, NULL, NULL, NULL, NULL),
(7, 'SARR', 'JOSEPH', 100088775, 'M', NULL, '1955-06-24', 'KHAOULTOC NGHOL', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 6, NULL, NULL, NULL, NULL),
(8, 'SAMBA', 'PALLA', 100542867, 'M', NULL, '1962-08-11', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:13:01', '2024-08-02 11:13:01', NULL, NULL, 0, 7, NULL, NULL, NULL, NULL),
(9, 'DIAS', 'BARTHELEMY TOYE', 100090791, 'M', NULL, '1975-09-23', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-06 12:46:22', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL),
(10, 'BA', 'FATOU', 120328401, 'F', NULL, '1980-05-06', 'FOROU PEULH', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 2, NULL, NULL, NULL, NULL),
(11, 'MBENGUE', 'BABACAR', 100031010, 'M', NULL, '1969-12-22', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 3, NULL, NULL, NULL, NULL),
(12, 'BATHILY', 'NDIALOU', 105890118, 'F', NULL, '1978-07-14', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 4, NULL, NULL, NULL, NULL),
(13, 'FALL', 'ABASS', 100147309, 'M', NULL, '1966-11-11', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 5, NULL, NULL, NULL, NULL),
(14, 'SARR', 'JOSEPH', 100088775, 'M', NULL, '1955-06-24', 'KHAOULTOC NGHOL', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 6, NULL, NULL, NULL, NULL),
(15, 'SAMBA', 'PALLA', 100542867, 'M', NULL, '1962-08-11', 'DAKAR', NULL, 'titulaire', 1, '2024-08-02 11:31:03', '2024-08-02 11:31:03', NULL, NULL, 0, 7, NULL, NULL, NULL, NULL),
(16, 'NDIAYE', 'IBRA', 106587571, 'M', 'Informaticien', '1994-03-02', 'Dakar', '1496200400459', 'titulaire', 1, '2024-08-05 22:33:48', '2024-08-06 12:47:33', '66b1534c312f6.pdf', '66b1534c312f6.pdf', 1, NULL, NULL, NULL, NULL, NULL),
(17, 'TOURE', 'ABABA', 106407634, 'F', 'Informaticien', '1953-07-05', 'Dakar', '1751195305994', 'titulaire', 1, '2024-08-09 00:43:13', '2024-08-09 00:43:13', NULL, NULL, 0, 15, NULL, NULL, NULL, NULL),
(18, 'CAMARA', 'ABABACAR', 105510075, 'M', 'Informaticien', '1980-09-20', 'Dakar', '1757198001670', 'titulaire', 1, '2024-08-09 23:03:40', '2024-08-09 23:03:40', NULL, NULL, 0, -4, NULL, NULL, NULL, NULL);

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
(25, '2024_08_11_121535_add_column_type_to_listes_table', 13);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `liste_nationals`
--
ALTER TABLE `liste_nationals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
