-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 mai 2023 à 12:55
-- Version du serveur : 10.3.38-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sim_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `boncommandes`
--

CREATE TABLE `boncommandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `fournisseur_id` varchar(255) NOT NULL,
  `entreprise_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `devise` varchar(255) NOT NULL DEFAULT 'TND',
  `commande_ht` double NOT NULL DEFAULT 0,
  `commande_tva` double NOT NULL DEFAULT 0,
  `commande_ttc` double NOT NULL DEFAULT 0,
  `commande_remise` double NOT NULL DEFAULT 0,
  `condition` longtext DEFAULT NULL,
  `footer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boncommandes`
--

INSERT INTO `boncommandes` (`id`, `numero`, `type`, `date`, `fournisseur_id`, `entreprise_id`, `status`, `devise`, `commande_ht`, `commande_tva`, `commande_ttc`, `commande_remise`, `condition`, `footer`, `created_at`, `updated_at`) VALUES
(3, 'BN20230001', NULL, '2023-03-13', '18', '1', 'en cours', 'TND', 0, 0, 0, 0, NULL, NULL, '2023-03-13 10:31:21', '2023-03-13 10:31:21'),
(5, 'BN20230003', NULL, '2023-03-28', '12', '1', 'en cours', 'TND', 2560, 179.2, 2739.2, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-28 11:45:17', '2023-03-28 12:00:06'),
(6, 'BN20230004', NULL, '2023-03-28', '12', '1', 'en cours', 'TND', 390, 74.1, 464.1, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-28 11:51:02', '2023-03-28 11:57:34'),
(7, 'BN20230005', NULL, '2023-05-02', '29', '1', 'en cours', 'TND', 1466.5, 278.635, 1745.135, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-02 15:44:15', '2023-05-03 07:45:08');

-- --------------------------------------------------------

--
-- Structure de la table `bonlivraisons`
--

CREATE TABLE `bonlivraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `entreprise_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `devis_id` varchar(255) DEFAULT NULL,
  `condition` longtext DEFAULT NULL,
  `footer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bonlivraisons`
--

INSERT INTO `bonlivraisons` (`id`, `numero`, `date`, `client_id`, `entreprise_id`, `status`, `devis_id`, `condition`, `footer`, `created_at`, `updated_at`) VALUES
(3, 'BL20230001', '2023-03-16', '139', '1', 'en cours', NULL, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 12:59:15', '2023-03-15 13:03:56'),
(4, 'BL20230002', '2023-04-27', '147', '1', 'en cours', NULL, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-25 10:32:01', '2023-04-25 10:38:48'),
(5, 'BL20230003', '2023-04-27', '147', '1', 'en cours', NULL, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-25 10:56:34', '2023-04-25 10:57:40'),
(6, 'BL20230004', '2023-04-27', '109', '1', 'en cours', '117', NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-27 12:18:14', '2023-04-27 12:18:24'),
(7, 'BL20230005', '2023-05-05', '153', '1', 'en cours', '120', NULL, NULL, '2023-05-05 07:52:08', '2023-05-05 07:52:08');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues`
--

CREATE TABLE `catalogues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `prix_ht` varchar(255) NOT NULL,
  `prix_achat` varchar(255) DEFAULT NULL,
  `tva` varchar(255) NOT NULL,
  `type_remise` varchar(255) DEFAULT NULL,
  `remise` varchar(255) DEFAULT NULL,
  `total_ht` varchar(255) NOT NULL DEFAULT '0',
  `total_remise` varchar(255) NOT NULL DEFAULT '0',
  `total_tva` varchar(255) NOT NULL DEFAULT '0',
  `total_ttc` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fournisseur_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `nb_jours` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `montant`, `nb_jours`, `couleur`, `created_at`, `updated_at`) VALUES
(1, 'Catégorie 1', '10000000', '0', '#21b093', '2023-01-04 08:15:38', '2023-01-04 13:09:39');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mf` varchar(255) DEFAULT NULL,
  `rne` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `raison_social` varchar(255) DEFAULT NULL,
  `categorie_id` varchar(255) DEFAULT NULL,
  `categorie_text` varchar(255) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `solde` double NOT NULL DEFAULT 0,
  `paye_total` double NOT NULL DEFAULT 0,
  `paye_factures` double NOT NULL DEFAULT 0,
  `paye_avance` double NOT NULL DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL,
  `adresse` longtext DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `status_date` varchar(255) DEFAULT NULL,
  `status_montant` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `numero`, `nom`, `email`, `telephone`, `mobile`, `mf`, `rne`, `type`, `raison_social`, `categorie_id`, `categorie_text`, `total`, `solde`, `paye_total`, `paye_factures`, `paye_avance`, `photo`, `adresse`, `code_postal`, `fax`, `web`, `status_date`, `status_montant`, `created_at`, `updated_at`) VALUES
(1, 'CLT20230001', 'PERFORMER TUNISIE', 'marfaoui@haas-sudfrance.com', '21679408148', NULL, '1496476P', '1496476P', 'avec_taxe', 'PERFORMER TUNISIE', '1', NULL, 5511.2, 4197.6, 1313.6, 1313.6, 0, NULL, 'Zone Industrielle Mghira 2, Avenue de Tunis A11, 2032 Fouchana', '2032', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 09:15:02'),
(2, 'CLT20230002', 'PHARMADIAL', 'soumaya.chaker@pharmadial.pro', '21671216022', NULL, '0741085V', '0741085V', 'avec_taxe', NULL, '1', NULL, 4770.5, 0, 4770.5, 4770.5, 0, NULL, 'RUE MAHMOUD BAYREM BP 17 BOUMHAL EL BASSATINE \r\n 2097', '2097', '21671216422', 'Zone Industrielle Mghira 2, Avenue de Tunis A11, 2032 Fouchana', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-03 12:35:40'),
(3, 'CLT20230003', 'MLM', 'l.nasrallah@mlm-sa.com', '21671449430', NULL, '0943760E', '0943760EAM000', 'avec_taxe', NULL, '1', NULL, 7974.05, 1131.5, 6842.55, 6842.55, 0, NULL, '35 Avenue Hedi NOUIRA Route du Lac, 2040 Rades', '2040', '21679457277', 'Zone Industrielle Mghira 2, Avenue de Tunis A11, 2032 Fouchana', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-08 08:29:19'),
(4, 'CLT20230004', 'MOALLA CONSULTING TUNISIE', 'n.moalla@mconsulting.tn', '21697588193', NULL, '1626308C', '1626308C', 'avec_taxe', NULL, '1', NULL, 2382.602, 1572.83, 809.772, 809.772, 0, NULL, '39 Rue 8301 Espace SAFSAF Bloc B Montplaisir 1073 Tunis', '1073', NULL, 'Zone Industrielle Mghira 2, Avenue de Tunis A11, 2032 Fouchana', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 12:39:24'),
(5, 'CLT20230005', 'DISTRICOSM', 'Hanen.Driss@labo-svr.com', '58513304', NULL, '1019648P', '1019648P', 'avec_taxe', NULL, '1', NULL, 32465.33, 8706.25, 23759.08, 23759.08, 0, NULL, 'Rue de la Bourse Imm Lahmar LAC2', '1053', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-09 17:34:09'),
(6, 'CLT20230006', 'INSTEAD', NULL, '21628172363', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '15 Rue Amilcar Rades 2040', '2040', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(7, 'CLT20230007', 'ACIER MECANIQUE TUNISIE \'AMT\'', 'fatma.elfarji@amt.tn', '79408148', NULL, '894688P', '894688P', 'avec_taxe', 'AMT', '1', NULL, 12376.265, 4397.61, 7978.655, 7978.655, 0, NULL, 'Z.I Mghira 2, Avenue de Tunis A11', '2083', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 09:24:11'),
(8, 'CLT20230008', 'SITES', 'Lamouchisami@89913.com', NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(9, 'CLT20230009', 'ALL DW', 'jerome.bedel@daddyweb.fr', NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '32 Avenue Habib\nBourguiba, BARDO', '2000', NULL, 'www.daddyweb.fr', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(10, 'CLT20230010', 'BSK PHARMA', 'azza.chettaoui@bsk-pharma.com', '31573540', '58 141 999', '1574261R', '1574261R', 'avec_taxe', NULL, '1', NULL, 3765.4, 0, 3765.4, 3765.4, 0, NULL, 'R�sidence GREEN PARK - Appt. 68 - 9�me �tages, Les Jardins de Carthage', '1090', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-08 08:26:14'),
(11, 'CLT20230011', 'Paymee', 'contact@paymee.tn', '+216 56 809 929', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'R�sidence Fell et Yasmine, Le Bardo', '2000', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(12, 'CLT20230012', 'seif', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(13, 'CLT20230013', 'srts', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Avenue Habib Bourguiba 6100 Siliana , Tunisie', '6100', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(14, 'CLT20230014', 'BSK PHARM', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(15, 'CLT20230015', 'MALGA', 'mohamedali.mouelhi@malga.com.tn', NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'BP 192 (101,05 km)', '2013', '71 381 262', 'BP 192 (101,05 km)', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(16, 'CLT20230016', 'LIDIAL PHARMA', 'lidialpharma@gmail.com', '79212777', NULL, '1614139P', '1614139P', 'avec_taxe', 'LIDIALPHARMA', '1', NULL, 2537.75, 2537.75, 0, 0, 0, NULL, 'BOUMHELL, Bou Mhel El Bassatine', '2097', '+216 79 212 777', NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 12:07:51'),
(17, 'CLT20230017', 'BULLA REGIA', 'SALES@BULLAREGIA.COM', '71 381 262', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z.I. BEN AROUS BP192 2013 BEN AROUS TUNISIE', NULL, '71 384 077', 'WWW.BULLAREGIA.COM', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(18, 'CLT20230018', 'LES PEPINIERES DE CARTHAGE', NULL, '+216 71 275 572', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'rte de M�alga 2078 Marsa Safsaf, Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(19, 'CLT20230019', 'BIOSCA TAMARA', NULL, '+216  76 430 233', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z. I. 2240, P3, Tozeur', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(20, 'CLT20230020', 'SENTOLIA', 'contact@sentolia.com', '(+216) 71 381 262', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z.I Ben Arous BP 192\n2013 Ben Arous � Tunisia', NULL, '(+216) 71 384 077', NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(21, 'CLT20230021', 'SCPCI', NULL, '71 381 262', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue de Cuivre Z I Ben Arous BP 192, Rades, Ben Arous, None Tunisie', NULL, '71 381 262', NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(22, 'CLT20230022', 'LES VERGERS DE TUNISE', NULL, '+216 71 381 262', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '1 rue du Cuivre? Z.I. Ben Arous? Ben Arous 2013', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(23, 'CLT20230023', 'FINANCIERE MALGA', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'BP 192, Ben Arous, Ben Arous, None Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(24, 'CLT20230024', 'ROYAL TYRE', NULL, '71 346 075 / 71 341 095', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '25 Avenue de Carthage', '1000', '71 346 074', NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(25, 'CLT20230025', 'SMIRI Engineering', 's.wissem@smiri.com.tn', '(+216) 70 690 776', '(+216) 99 228 679', '1182431MAM000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Avenue Fattouma Bourguiba, Lotissement KOBBI, Lot N�34, Imm. LaSoukra GARDEN Appartement 5-6', '2036', '(+216) 70 690 775', 'www.smiriengineering.com/', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(26, 'CLT20230026', 'T2S', 'it@t2s-tn.com', NULL, '21 628 119 033', '1556636B', NULL, 'avec_taxe', NULL, '1', NULL, 12220.921, 5921.787, 6299.134, 6299.134, 0, NULL, 'BUREAU 4.6 4 �ME �TAGE, R�SIDENCE ALEXANDRIN', '2014', NULL, 'www.t2s-tn.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-04-13 07:34:31'),
(27, 'CLT20230027', 'WABAG', 'Jaidi.Karim@wabag.com', NULL, '00216 25 417 355', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(28, 'CLT20230028', 'CAVEO Automotive Tunisia', 'i.massoussi@caveoautomotive.com', '71430662', NULL, '12628X', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z.I Borj Cedria B.P 912', '2050', '71430277', 'www.caveoautomotive.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-13 09:21:39'),
(29, 'CLT20230029', 'SGMEDTECH', 'a.gharsallah@sgmedtech.com', '21671409838', '21658666573', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '62, Rue Medenine', '2082', '21671409849', 'www.sgmedtech.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(30, 'CLT20230030', 'SME', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Borj Amri , Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(31, 'CLT20230031', 'Ooredoo', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(32, 'CLT20230032', 'SOTREGAMES', 'sotregames@planet.tn', '75 272 300', NULL, '003645XAM 000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'AVE ABOU KACEM ECHEBBI - 6000 - GABES', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(33, 'CLT20230033', 'TOOFAST', 'contact@toofast.com.tn', '26860228', NULL, '1634268J', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, '71428142', 'www.toofast.com.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(34, 'CLT20230034', 'MAE', 'yazid.euchi@moderne.tn', '25079094', '25 079 094', '1339356k', '1339356k/A/M/000', 'avec_taxe', 'MAE', '1', NULL, 2310.346, 2310.346, 0, 0, 0, NULL, 'Rue Sidi Abd El Jelil \r\nImmeuble N�9', '1008', NULL, 'www.moderne.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 09:18:01'),
(35, 'CLT20230035', 'Le Royal Hammamet', 'info-ham@leroyal.com', '+216 72 244 999', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'BP 237', '8050', '+216 72 244 315', 'https://www.leroyal.com/fr/nos-h%C3%B4tels/hammamet-tunisia', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(36, 'CLT20230036', 'LE JOINT TECHNIQUE', 'MDARMOUL@lejointtechnique.com', '71915606', '00 216 58 444 780', '984223J', '984223J', 'avec_taxe', NULL, '1', NULL, 8591.5, 3897.25, 4694.25, 4694.25, 0, NULL, 'Z.I de Gammarth � Route de Raoued � BP 80', '1057', '00 216 71 915 797', 'www.lejointtechnique.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-09 07:51:08'),
(37, 'CLT20230037', 'CCI TUNISIE', 'cci.tunisie@ccitunisie.com', '71245549', '21363310', '879367K/A/M/0000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '70 , rue18 janvier 1952 , 2�me �tage B3 -', '1001', '71245548', 'www.ccitunisie.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(38, 'CLT20230038', 'AMGP', 'ziedhajji30@gmail.com', '24 207 670', NULL, '1695107 DAM000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'BOUMHELL, Bou Mhel El Bassatine', '2097', NULL, 'BOUMHELL, Bou Mhel El Bassatine', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(39, 'CLT20230039', 'Azur Conseil', 'contact@azur-conseil.fr', '23120359', '23 120 359', '1701543/L', '1701543/L', 'avec_taxe', NULL, '1', NULL, 358, 358, 0, 0, 0, NULL, '75 Avenue Kheireddin pacha Immeuble Ennassim Montplaisir', '1008', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-03-07 07:53:43'),
(40, 'CLT20230040', 'telesys', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(41, 'CLT20230041', 'CODIS', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:01:10'),
(42, 'CLT20230042', 'ARABOSAI', 'contact@arabosai.org', '71949915', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Centre Urbain Nord, Rue Ahmed Al Snoussi, Batiment B4-2eme �tage', '1080', '71949914', 'www.arabosai.org', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(43, 'CLT20230043', 'CTI-NETWORK', 'commercial@cti-network.com', NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(44, 'CLT20230044', 'WKW', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(45, 'CLT20230045', 'BORGES', 'koueslati@borges-baieo.com', '21 671 875 866', NULL, '587554NN', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'COLISEE SOULA, ESCALIER C, 4 �me ETAGE', '2092', NULL, 'https://comprometidospornaturaleza.com/fr/', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(46, 'CLT20230046', 'TIC INSPECTION GROUP', 'mohamed.zouaidi@tic-inspectiongroup.com', '+216 71 180 140', '25 987 010', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Lot 1-1-18 Zone Industrielle Kheireddine,', '2015', '+216 71 180 141', 'www.tic-inspectiongroup.com.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(47, 'CLT20230047', 'BFS', 'bfs@topnet.tn', '71265433', NULL, '1141498GAM000', '1141498GAM000', 'avec_taxe', 'BFS', '1', NULL, 4018.25, 1339.75, 2678.5, 2678.5, 0, NULL, 'Immeuble Carthagene, 2iéme Etage, Bureau N°13. Les Jardins de Carthage.', '10000', NULL, 'www.bfs.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-08 12:32:46'),
(48, 'CLT20230048', 'Les Fortunes Du Rempart', 'Khalil.gorbel@gmail.com', NULL, '98 943 508', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'r�sidence les jasmin E3-3 nouvelle medina 3 Ben Arous', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(50, 'CLT20230050', 'FEEDCOM', 'finance2@feedcom-tn.com', '71197373', NULL, '1239622C', '1239622C', 'avec_taxe', NULL, '1', NULL, 12415.09, 1905, 10510.09, 10510.09, 0, NULL, 'R�sidence equinoxe les berges du lac 2 1053 la marsa', '1053', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-10 09:44:56'),
(51, 'CLT20230051', 'COMEM', 'a.maalej@comem.tn', '98775234', '71 383 300', '1130354F', '1130354F', 'avec_taxe', NULL, '1', NULL, 94.772, 94.772, 0, 0, 0, 'RNE Public 27-01-2023.pdf.pdf', '4, Rue de Gab�s, Ben Arous 2013\r\nTUNISIE', '2013', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-04-06 11:09:25'),
(52, 'CLT20230052', 'Hyphen', NULL, '22 22 22 22', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Immeuble Ennesrine , App N�9 2eme �tage 1100, Zaghouan 1100', NULL, NULL, 'www.hyphen.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(53, 'CLT20230053', 'ACADEMIE KARATE', 'academiekarate@gmail.com', '51 853 908', NULL, '1535868/B', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '004 , Beji Massaoudi , Ariana 2080', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(54, 'CLT20230054', 'Rosa Luxemburg Stiftung', 'infotunis@rosalux.org', '71846346', NULL, '1346281A', '1346281A', 'avec_taxe', NULL, '1', NULL, 9120.4, 1905, 7215.4, 7215.4, 0, NULL, 'Rue 1er juin', '1082', '+216 71 846 346', 'https://rosaluxna.org/', 'valide', 'valide', '2023-01-04 12:55:37', '2023-05-02 14:29:42'),
(55, 'CLT20230055', 'LODGE ME', 'contact@lodgeme.fr', '33780945186', '21653227922', 'Paris B 903 952 364', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '66, avenue des Champs-�lys�es', '75008', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(56, 'CLT20230056', 'UNITECH', 'production@unitech-one.com', '71386536', '96708261', '1206996/C', '1206996/C', 'avec_taxe', NULL, '1', NULL, 340.15, 0, 340.15, 340.15, 0, NULL, '10, rue de la physique 10 Z.I Ben Arous 2013 Tunis', '2082', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-03-24 11:52:14'),
(57, 'CLT20230057', 'ISCANATURE', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(58, 'CLT20230058', 'Polyclinique Les Jasmins', 'contact@cliniquelesjasmins.com.tn', '+216 36 089 000', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Lot E 18 Centre Urbain Nord � 1003 Tunis', NULL, '+216 36 087 000', NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(59, 'CLT20230059', 'LMT', 'elyes@lmt.tn', '73 308 088', '98368707', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Route de Tunis Z.I. Akouda', '4022', NULL, 'http://www.lmt.tn/', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(60, 'CLT20230060', 'MORNING LEAD', NULL, NULL, '22 336 331', '1727091QAM000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'LES BERGES DU LAC', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(61, 'CLT20230061', 'St� VENETIAN', NULL, NULL, '93541237', '1546749E/A/M/000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue du lac Victoria \nLes Berges du lac 1053-Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(62, 'CLT20230062', 'P�le de Comp�titivit� de Bizerte', 'taleb.lotfi@polebizerte.com.tn', '+216 72 570 895 || +216 72 572 443', '+216 22 844 443 ���|| +216 98 766 103', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Boulevard de l\'Union du Grand Maghreb Arabe', '7080', '+216 72 572 458', 'www.pole-competitivite-bizerte.com.tn', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(63, 'CLT20230063', 'BFLUIDE', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(64, 'CLT20230064', 'LMCOD', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(65, 'CLT20230065', 'VMDSOLUTIONS', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(66, 'CLT20230066', 'Avocats Sans Fronti�res � Tunisie', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(67, 'CLT20230067', 'Volunt?s', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(68, 'CLT20230068', 'BH Bank', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(69, 'CLT20230069', 'Jasmine Holding', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(70, 'CLT20230070', 'FLUIDE', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(71, 'CLT20230071', 'INFOTECH CONSULTING SERVICES', 'contact@ics-tunisie.com', NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '053 , IMM LINA , 5ET ,SFAX', '3000', NULL, '053 , IMM LINA , 5ET ,SFAX', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(72, 'CLT20230072', 'INFOTECH CONSULTING SERVICES', 'contact@ics-tunisie.com', NULL, NULL, '1499150/L', NULL, 'avec_taxe', NULL, '1', NULL, 2857, 0, 2857, 2857, 0, NULL, '053 , IMM LINA , 5ET ,SFAX', '3000', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-04-11 07:21:50'),
(73, 'CLT20230073', 'NOVAPHARM', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(74, 'CLT20230074', 'ANOUER', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(75, 'CLT20230075', 'Silvatrim Tunisia', NULL, '72 494 033', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(76, 'CLT20230076', 'COMNET', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(77, 'CLT20230077', 'Vitalya Pharma', NULL, NULL, NULL, '1772540A/A/M/000', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(78, 'CLT20230078', 'Heetch', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(79, 'CLT20230079', 'M3S', NULL, NULL, NULL, '918005EAM000', NULL, 'avec_taxe', NULL, '1', NULL, 15358.261, 0, 15358.261, 15358.261, 0, NULL, 'Zone Industrielle M\'ghira II P57J+M7', '2082', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-04-25 09:36:21'),
(80, 'CLT20230080', 'MHAYRAS HAY', NULL, NULL, NULL, '1780515/W', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '010 Rue Khadouja Thamri , El manar 1', '2092', NULL, 'www.health-serv.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(81, 'CLT20230081', 'PMT', 'ogouraud.pmt@hpm-groupe.fr', '21698743709', '21698743709', NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z.I Sidi ABDELHAMID', '4061', NULL, 'www.hpm-groupe.fr', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(82, 'CLT20230082', 'HERMESS COMPOUND', 'nasr-it@hermess-compounds.com', NULL, '98112423', '1092182N', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue Gafsa ZI Mghira3', '2082', NULL, 'www.hermess-compounds.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(83, 'CLT20230083', 'ENTREPRISE PERFORMANCE & STRATEGY MANAGEMENT COMPANY', 'rbenahmed@strategya2ai.com', '21627377091', '21627377091', 'B24109152012', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'A4 r�sedance Kenza', '1053', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(84, 'CLT20230084', 'ELOQUENCE', 'ghassensouissi0607@gmail.com', '50503296', '50503296', '1690524/W', NULL, 'avec_taxe', NULL, '1', NULL, 2690.972, 1143, 1547.972, 1547.972, 0, NULL, '1. Rue , Sidi Ghalleb', '8011', NULL, 'https://eloquence-content.com', 'valide', 'valide', '2023-01-04 12:55:37', '2023-04-19 07:22:13'),
(85, 'CLT20230085', 'ALAFCO', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-04 12:55:37'),
(86, 'CLT20230086', 'Association Didon de Carthage', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:37', '2023-01-05 15:00:41'),
(87, 'CLT20230087', 'EXPRESS TRANSIT', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(88, 'CLT20230088', 'BHBANK', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(89, 'CLT20230089', 'CRK Maroquinerie', 'mahmoud.kharouf@crk.com.tn', '29330658', '29 330 658', '1389883G', '1389883G', 'avec_taxe', NULL, '1', NULL, 5807.415, 2862.65, 2944.765, 2944.765, 0, NULL, '27 Rue 62128', '2062', NULL, 'https://www.crk.tn/', 'valide', 'valide', '2023-01-04 12:55:38', '2023-05-02 14:28:56'),
(90, 'CLT20230090', 'AVOCARBON', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(91, 'CLT20230091', 'LOUGHA', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(92, 'CLT20230092', 'AFC LOGISTIQUE', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(93, 'CLT20230093', 'OUTIKA', NULL, NULL, NULL, '1664867R', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'R�sidence Equinoxe les berges du lac 2', '1053', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(94, 'CLT20230094', 'ALLIE RH', 'allierh.tn@gmail.com', '29991127', '98509833', '1608548Q', '1608548Q', 'avec_taxe', NULL, '1', NULL, 806.752, 806.752, 0, 0, 0, NULL, '312 app R�sidence Moutawassit Narjess 3', '2065', NULL, 'www.allierh.net', 'valide', 'valide', '2023-01-04 12:55:38', '2023-04-26 15:15:35'),
(96, 'CLT20230096', 'Générale d\'équipement Industriel \'GEI\'', 'atef.abid@gei.tn', '98780221', '98 780 221', '0048054X', '0048054X', 'avec_taxe', NULL, '1', NULL, 20712, 12354, 8358, 8358, 0, NULL, '54 rue du mercure, 2013 ZI Ben Arous', '2013', '71 384 885', NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-05-02 16:28:12'),
(97, 'CLT20230097', 'REACTIV', 'walid.bensalem@lmcod.com', '72 670 930 / 72 670 895', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Z.I. 1140 - EL FAHS,', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(98, 'CLT20230098', 'Proculogy', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(99, 'CLT20230099', 'REACTIV', 'walid.bensalem@lmcod.com', '72 670 930 / 72 670 895', NULL, '1100896R', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Zone Industrielle ,Fahs  Zaghouan , Tunisie', '1140', '72 670 534', NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(100, 'CLT20230100', 'SAPHIR CONSEIL', 'slama.kal@gmail.com', NULL, NULL, '901519314', NULL, 'avec_taxe', NULL, '1', NULL, 1077, 804, 273, 273, 0, NULL, '455 Promenade des Anglais ,Immeuble Nice Premier A', '6200', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-05-08 15:46:05'),
(101, 'CLT20230101', 'COSEM', NULL, '71 607 117', '22 643 404', '0014477J', NULL, 'avec_taxe', NULL, '1', NULL, 2751.35, 2751.35, 0, 0, 0, NULL, 'Rue Chaghalin A46 , Manouba', '2011', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-05-08 12:05:30'),
(103, 'CLT20230103', 'dasristerile', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(105, 'CLT20230105', 'CITET en faveur de Lamia Hamrouni (LAMI MODE)', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(106, 'CLT20230106', 'ALSahl Group Holding', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-05 15:00:41'),
(107, 'CLT20230107', 'Green Alfco', 'intertraders@live.com', '+216 24 624 310', NULL, '1462985C', NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '87, Route Chinoise, \n                                                                                                                                              El Bassatine 3,', '2094', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(109, 'CLT20230109', 'CHADWELL TUNISIA', 'bechir@chadwellinternational.com', '58211221', '70294133', '1707406D', '1707406D', 'avec_taxe', NULL, '1', NULL, 6090.49, 2868.6, 3221.89, 3221.89, 0, NULL, 'Les Berges du Lac, Immeuble Sarray bloc B bureau 5 Marsa 1053 Tunisie', '1053', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-04-27 16:19:03'),
(110, 'CLT20230110', 'VICTOR HUGO', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '4 Rue Victor Hugo, Marsa 2070', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(111, 'CLT20230111', 'STE GLOBAL SERVICES TRANSPORT \"GST\"', 'Mehdi@gst.tn', '95929618', '72 413 035', '0496110G', '0496110G', 'avec_taxe', NULL, '1', NULL, 17.66, 17.66, 0, 0, 0, NULL, 'Rue Abderrahmane dakhel , Cit� Bougattfa , Avenue El Amir Abdelkader Bizerte -nord', '7000', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-04-06 11:23:37'),
(112, 'CLT20230112', 'SOFEMED', NULL, NULL, NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Km6 route de Tunis, Soliman', NULL, NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(113, 'CLT20230113', 'Createam', NULL, '71 900 602 - 71 900 632', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue 8300 - Immeuble LUXOR I ,App B 3.5 - Montplaisir, Tunis,', '1002', NULL, NULL, 'valide', 'valide', '2023-01-04 12:55:38', '2023-01-04 12:55:38'),
(118, 'CLT20230114', 'client test', 'client@yahoo.fr', '2365444', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'adresss testt', NULL, NULL, NULL, 'valide', 'valide', '2023-01-05 16:16:54', '2023-01-06 08:43:36'),
(119, 'CLT20230115', 'BTK LEASING', 'contact.commercial@btkleasing.tn', '70241417', NULL, '0578857a', 'B1118201996', 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, 'Logo BTK LEASING.jfif.jfif', '11, Rue hédi Nouira -1001 Tunis', '1001', NULL, NULL, 'valide', 'valide', '2023-01-11 12:33:19', '2023-01-12 14:12:14'),
(120, 'CLT20230116', 'Société Sami Cherif', 'samicherif@gmail.com', '50272018', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '11 rue ferhi, 1001 Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-01-13 08:59:22', '2023-01-13 08:59:22'),
(121, 'CLT20230117', 'SRTS | Société Rapide Transport de Sud', 'srtsud@topnet.tn', '71 904 089', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 6665, 6665, 0, 0, 0, NULL, '19 R 8300 IMB luxor v1 B1 1ET Montplaisir 1002.', NULL, NULL, NULL, 'valide', 'valide', '2023-01-23 13:59:29', '2023-04-27 10:47:17'),
(122, 'CLT20230118', 'ECOPSIS', 'mc@ecopsis.com', '12345678', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Marion Cherrak ', NULL, NULL, NULL, 'valide', 'valide', '2023-01-30 09:32:56', '2023-01-30 09:32:56'),
(123, 'CLT20230119', 'المركب الفلاحي الرملية', 'rmila.siliana@gmail.com', '78 871 133', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Siliana, Tunisia', NULL, NULL, NULL, 'valide', 'valide', '2023-02-01 14:43:00', '2023-02-01 14:43:00'),
(124, 'CLT20230120', 'KEEPSYS', 'zoghlami.sami@hotmail.fr', '71343076', NULL, '1771984X', '1771984X/A/M/000', 'avec_taxe', 'KEEPSYS', '1', NULL, 1964.5, 964.5, 1000, 1000, 0, NULL, '25 lotissement Aouina Mnihla - 2094 Ariana', '2094', NULL, NULL, 'valide', 'valide', '2023-02-13 10:11:26', '2023-03-27 12:40:29'),
(126, 'CLT20230121	', 'HANDICAP INTERNATIONAL', 'Hi@gmail.vcom', '71 892 289', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '10 Rue du Brésil 1002 Tunis Belvédère, Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-02-20 15:45:28', '2023-02-20 15:45:28'),
(127, 'CLT20230122	', 'Phenomenes Joyeux', 'phen.joyeux@gmail.com', '71458963', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'R6PW+8JG, Rue du Lac Biwa, Tunis\n', NULL, NULL, NULL, 'valide', 'valide', '2023-02-23 14:05:52', '2023-02-23 14:05:52'),
(133, 'CLT20230123', 'Scout Tunisien ', ' contact@scouts.tn', '+216 71 790 501', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Avenue Jugurtha, Tunis, Tunisie ', NULL, NULL, NULL, 'valide', 'valide', '2023-03-08 09:59:25', '2023-03-08 09:59:25'),
(134, 'CLT20230124', 'Fondation Heinrich Boell Tunisie', 'info@tn.boell.org', '71 322 345', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '5 Rue Jamel Abdenasser, Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-03-10 12:57:41', '2023-03-10 12:57:41'),
(135, 'CLT20230125', 'Sofiene Ben Abid - CSBA', 's.benabid@gnet.tn', '71963492', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue Lac Tchad, Imm. Kanzet Abis1, Berges du Lac, 1053 Tunis ', NULL, NULL, NULL, 'valide', 'valide', '2023-03-10 15:33:33', '2023-03-10 15:33:33'),
(136, 'CLT20230126', 'Amine', 'amine.damak@kdamak.com.tn', '26450545', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '34,Rue Hédi Nouira Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-03-13 08:45:28', '2023-03-13 08:45:28'),
(137, 'CLT20230127', 'Digital Rogue Wave', 'hamza.chaouachi@digitalroguewave.com', '25369195', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'adr A11 ,3 éme étage , immeible 8 , rue mohamed badra montplaisir tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-03-13 10:38:22', '2023-03-13 10:38:22'),
(139, 'CLT20230128', 'Hopital Mahrès', 'contact@next.tn', '74466188', '74 466 188', '43735V', '43735V/A/M/0000', 'avec_taxe', NULL, '1', NULL, 2189.6, 0, 2189.6, 2189.6, 0, NULL, 'mahrès sfax', '3060', NULL, NULL, 'valide', 'valide', '2023-03-15 12:58:45', '2023-05-09 15:38:52'),
(140, 'CLT20230129', 'OUTIKA INTERNATIONAL SERVICES AND GENERAL CONSULTANCY', 'walid@outikaintl.com', '53431798', NULL, '1664687R', 'B01102052020', 'avec_taxe', NULL, '1', NULL, 1607.5, 1607.5, 0, 0, 0, NULL, 'Residence equinoxe les berges du lac 2 1053 la marsa', '1053', NULL, NULL, 'valide', 'valide', '2023-03-15 14:39:44', '2023-04-17 13:35:53'),
(141, 'CLT20230130', 'CLOUD TEMPLE', 'tunisie@cloud-temple.com', '(+216) 71 13 45 73  |   71 13 45 75', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Immeuble Khairi New Tower lot B17\n6ème étage, CUN, 1080 Tunis.', NULL, NULL, NULL, 'valide', 'valide', '2023-03-21 12:48:47', '2023-03-21 12:48:47'),
(142, 'CLT20230131', 'ASSAFINAH TOURISM', 'contact@assafinah-tourism.com', '98166301', NULL, '1580270F', 'B01177682018', 'avec_taxe', NULL, '1', NULL, 666.74, 0, 666.74, 666.74, 0, NULL, '22 Rue d\'Espagne Immeuble Ben Yaghlen - 1er Étage - Bureau N°6 (au-dessus du Grand Bazar Tunis, 1000', '1000', NULL, NULL, 'valide', 'valide', '2023-03-22 14:33:10', '2023-04-11 07:16:38'),
(143, 'CLT20230132', 'MKG Concept         ', 'safa.fathalli@mkgconcept.net ', '29951595', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, ' Rue Lac Turkana, Les berges du lac 1', NULL, NULL, NULL, 'valide', 'valide', '2023-03-24 11:25:46', '2023-03-24 11:25:46'),
(144, 'CLT20230133', 'ProcuLogy', 'Info@proculogy.com', '+216 28 99 77 00', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '4 ALSIDYA STREER -TRIPOLI', NULL, NULL, NULL, 'valide', 'valide', '2023-03-28 11:33:44', '2023-03-28 11:33:44'),
(145, 'CLT20230134', 'Mkg concept', 'mailto:mkg@mkgconcept.net', '29951595', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Imm Nour, Rue du Lac Turkana 1053 Les Berges du Lac – Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-03-31 13:20:05', '2023-03-31 13:20:05'),
(146, 'CLT20230135', 'CANADIAN SYSTEM TECHNOLOGY', 'info@cst.tn', '71 905 101', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Espace Tunis, bloc E, Bureau 4.3, Tunis 1073 Montplaisir, Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-04-03 09:05:44', '2023-04-03 09:05:44'),
(147, 'CLT20230136', 'OTD Ramlia', 'OTD@gmail.com', '78 87 20 44', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 6017.45, 6017.45, 0, 0, 0, NULL, 'Siliana ', NULL, NULL, NULL, 'valide', 'valide', '2023-04-03 12:15:31', '2023-04-27 13:50:37'),
(148, 'CLT20230137', 'Cabinet d’avocat Tarek Alaimi ', 'hammarnouha1@gmail.com', '50011583', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Tunis belvédère', NULL, NULL, NULL, 'valide', 'valide', '2023-04-06 09:04:14', '2023-04-06 09:04:14'),
(149, 'CLT20230138', 'NADEC', 'contact@nadec.tn', '71 426 826', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '2 Rue du plastique ZI Sidi Rezig 2033 Megrine, TUNISIE', NULL, NULL, NULL, 'valide', 'valide', '2023-04-07 08:01:45', '2023-04-07 08:01:45'),
(150, 'CLT20230139', 'My Home', 'commercial.gabes@cuisina.com', '74562314', NULL, '1471588T', '1471588T', 'avec_taxe', NULL, '1', NULL, 771.4, 0, 771.4, 771.4, 0, NULL, 'Djerba, Tunisia · El Hamma, Tunisia · Métouia, Tunisie · Tunis, Tunisie · Gabès, Tunisie · Mareth, Tunisia · Ghannush, Tunisia · Médenine, Tunisie · Tataouine, Tunisie · Douz, Tunisie', '8000', NULL, NULL, 'valide', 'valide', '2023-04-10 12:15:50', '2023-04-19 07:21:00'),
(151, 'CLT20230140', 'Createam', 'i.bouden@createam.tn', '(+216) 71 900 602 ', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '45, Avenue du Japon – Immeuble « le 45 »\nBureau A.3.1 - 1073 - Montplaisir - Tunis - Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-04-13 07:23:27', '2023-04-13 07:23:27'),
(152, 'CLT20230141', 'TIS Tunisie Informatique Services', 'contact@tis.com.tn', '71458200', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '6 place Mohamed Kurd Ali\n1005 Omrane, Tunis TUNISIE', NULL, NULL, NULL, 'valide', 'valide', '2023-04-13 11:44:08', '2023-04-13 12:20:19'),
(153, 'CLT20230142', 'AVENIR SERVICE TRANSPORT \"AST\"', 'n.arfaoui@ast.com.tn', '98109397', NULL, '433123R', '433123R/A/M/000', 'avec_taxe', NULL, '1', NULL, 10498.8, 10498.8, 0, 0, 0, NULL, 'ZI Municipale II 2040 rades - ben arous -tunisie', '2040', NULL, NULL, 'valide', 'valide', '2023-04-27 10:28:31', '2023-05-05 07:51:51'),
(154, 'CLT20230143', 'Dance Beauty (École de danse)', 'J\'attendl\'email', '22129670', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Rue mohamed bairem 5 marsa les pins, La Marsa, Tunisia', NULL, NULL, NULL, 'valide', 'valide', '2023-05-04 14:23:21', '2023-05-04 14:23:21'),
(155, 'CLT20230144', 'Centre de dialyse à La Manouba', 'dialysemanouba@gmail.com', '70 604 194', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Manouba, Tunis', NULL, NULL, NULL, 'valide', 'valide', '2023-05-05 13:23:08', '2023-05-05 13:23:08'),
(156, 'CLT20230145', 'Centre intermédiaire oued ellil', 'CI@gmail.com', '70 604 194', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Oued Ellil, Manouba', NULL, NULL, NULL, 'valide', 'valide', '2023-05-05 13:29:28', '2023-05-05 13:29:28'),
(157, 'CLT20230146', 'Cuisina Gabes ', 'Cuisina.gabes@cuisina.com', '75 212 830', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, 'Gabes, Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-05-08 12:34:22', '2023-05-08 12:34:22'),
(158, 'CLT20230147', 'K.DAMAK Shipping Company SA.', 'amine.damak@kdamak.com.tn', '71 331 151', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '34, Rue Hédi Nouira - 1001 Tunis - Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-05-08 14:15:45', '2023-05-08 14:15:45'),
(159, 'CLT20230148', 'K.DAMAK Shipping Company SA.', 'amine.damak@kdamak.com.tn', '71 331 151', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '34, Rue Hédi Bouira -1001 Tunis - Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-05-08 14:29:28', '2023-05-08 14:29:28'),
(160, 'CLT20230149', 'K.DAMAK Shipping Company SA.', 'amine.damak@kdamak.com.tn', '71 331 151', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '34, Rue Hédi Nouira - 1001 Tunis - Tunisie ', NULL, NULL, NULL, 'valide', 'valide', '2023-05-08 14:32:14', '2023-05-08 14:32:14'),
(161, 'CLT20230150', 'K.DAMAK Shipping Company SA.', 'amine.damak@kdamak.com.tn', '71 331 151', NULL, NULL, NULL, 'avec_taxe', NULL, '1', NULL, 0, 0, 0, 0, 0, NULL, '34, Rue Hédi Nouira - 1001 Tunis - Tunisie', NULL, NULL, NULL, 'valide', 'valide', '2023-05-08 15:49:22', '2023-05-08 15:49:22'),
(162, 'CLT20230151', 'STE LE PLUS', 'j.souli@irctunisia.com', '29929520', NULL, '0840779X/A/M/000', 'B019072008', 'avec_taxe', NULL, '1', NULL, 596, 596, 0, 0, 0, NULL, '07 , rue Abou Boulbabba Anssari , Menzah 6 Ariana Tunisie', '2080', NULL, NULL, 'valide', 'valide', '2023-05-11 09:15:03', '2023-05-11 09:19:55');

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `dure` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_jour` varchar(255) DEFAULT NULL,
  `date_debut` varchar(255) DEFAULT NULL,
  `date_fin` varchar(255) DEFAULT NULL,
  `nb_heures` varchar(255) DEFAULT NULL,
  `nb_jours` varchar(255) DEFAULT NULL,
  `raison` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `fixe` varchar(255) DEFAULT NULL,
  `poste` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `email`, `telephone`, `fixe`, `poste`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 'cccccc', 'cccc@yahoo.fr', '223655', '555555', 'postee', '114', '2023-01-04 14:35:39', '2023-01-04 14:35:39');

-- --------------------------------------------------------

--
-- Structure de la table `contactscrm`
--

CREATE TABLE `contactscrm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mf` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `adresse` longtext DEFAULT NULL,
  `web` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contactscrm`
--

INSERT INTO `contactscrm` (`id`, `nom`, `email`, `telephone`, `mf`, `categorie`, `photo`, `adresse`, `web`, `created_at`, `updated_at`, `fax`, `code_postal`, `numero`) VALUES
(10, 'Amine', 'amine.damak@kdamak.com.tn', '26450545', NULL, 'shipping', NULL, '34,Rue Hédi Nouira Tunis', NULL, '2023-03-02 14:59:49', '2023-03-02 14:59:49', NULL, '1001', 'CON0001'),
(11, 'ALLIANCE PHARMA ', 'info@alliance-pharma.net.', '71854752', NULL, 'pharmaceutique', NULL, 'Zone industrielle KONDAR BP 49 4020 , Kondar Tunisie ', NULL, '2023-03-10 09:23:53', '2023-03-10 09:48:54', NULL, '4020', 'CON0002'),
(12, 'BERG LIFE SCIENCES ', 'contact@berg-life.tn', '72677271', NULL, 'pharmaceutique', NULL, 'Z.I DE HAMMAM ZRIBA 1152 ZAGHOUAN TUNISIE ', NULL, '2023-03-10 09:25:22', '2023-03-10 09:43:02', NULL, '1152', 'CON0003'),
(13, 'CYTOPHARMA ', 'Cytopharma@cytopharma.tn', '72668444', NULL, 'pharmaceutique', NULL, 'Zone industrielle Hammam Zriba4 1152 Zaghouan -Tunisie ', NULL, '2023-03-10 09:27:46', '2023-03-10 10:06:34', NULL, '1152', 'CON0004'),
(14, 'IBN AL BAYTAR ', 'ibn.albaytar@planet.tn', '71799731', NULL, 'pharmaceutique', NULL, '11 RUE 8610 ZI LA CHARGUIA I 2035 TUNIS CARTHAGE TUNISIE ', NULL, '2023-03-10 09:29:30', '2023-03-10 10:06:22', '71797677', '2035', 'CON0005'),
(15, 'INFOMED Pharma ', 'contact@infomedpharma.tn', '71863450', NULL, 'pharmaceutique', NULL, 'Route de Gammarth Km 3 BP 739 2078 la MARSA ', NULL, '2023-03-10 09:47:17', '2023-03-10 10:05:57', '71863474', '2078', 'CON0006'),
(16, 'IPS (Industrie Pharmaceutique Said) ', 'wissem.bensaid@group-ips.com', '71942058', NULL, 'pharmaceutique', NULL, 'ZONE INDUSTRIELLE DJEBEL OUEST CHEYLUS 1111, BIR MCHERGA TUNISIE ', NULL, '2023-03-10 10:04:58', '2023-03-10 10:04:58', NULL, '1111', 'CON0007'),
(17, 'MEDICEF ', 'laboratoirespharmaceutiques@hotmail.com', '71552252', NULL, 'pharmaceutique', NULL, 'Avenue Habib Bourguiba 2020 Sidi Thabet Tunisie ', NULL, '2023-03-10 10:12:29', '2023-03-10 10:12:29', '71552442', '2020', 'CON0008'),
(18, 'OPALIA PHARMA ', 'contact@opaliarecordati.tn', '70559064', NULL, 'pharmaceutique', NULL, 'Zone Industrielle Kalaat El Andalous 2022 Ariana - Tunisie ', NULL, '2023-03-10 10:16:42', '2023-03-10 10:16:42', '70559061', '2022', 'CON0009'),
(19, 'PHARMADERM ', 'contact@pharmaderm.net', '70661519', NULL, 'pharmaceutique', NULL, 'Résidence Yousr Immobilière des Merveilles App A 6-3 ENNASR II 2037 El Menzah 8 Tunis TUNISIE ', NULL, '2023-03-10 10:22:27', '2023-03-10 10:22:27', '71827146', '2037', 'CON0010'),
(21, 'PHARMAGHREB ', 'pharmaghreb@planet.tn', '71940300', NULL, 'pharmaceutique', NULL, '39 Rue des entrepreneurs BP 7 - 1080 CEDEX -TUNIS TUNISIE ', NULL, '2023-03-10 10:30:45', '2023-03-10 10:30:45', '71940309', '1080', 'CON0012'),
(22, 'SIPHAT ', 'samir.joudi@rns.tn', '21698751943', NULL, 'pharmaceutique', NULL, 'FOUNDOUK CHOUCHA 2013 BEN AROUS TUNISIE ', NULL, '2023-03-10 10:35:34', '2023-03-10 10:35:34', '71382768', '2013', 'CON0013'),
(23, 'SISORA ', 'contact@sisora.com', '21671182670', NULL, 'pharmaceutique', NULL, 'SOCIETE ISOTOPE RADIOACTIF 43 Rue Sokrate, Zone Industrielle Khaireddine El Kram, 2089 - Tunisie ', NULL, '2023-03-10 10:37:19', '2023-03-10 10:37:19', NULL, '2089', 'CON0014'),
(24, 'TAHA PHARMA ', 'info@tahapharma.com', '71711780', NULL, 'pharmaceutique', NULL, 'Résidence Tunis Carthage, Bloc C-Appt 5 Borj El Baccouche Ariana 2027 Tunis ', NULL, '2023-03-10 10:38:46', '2023-03-10 10:38:46', '71711781', '2027', 'CON0015'),
(25, 'TERIAK ', 'assistantedg@teriak.com', '72640600', NULL, 'pharmaceutique', NULL, 'ZONE INDUSTRIELLE JEBEL OUST CHEYLUS 1111 ZAGHOUAN TUNISIE ', NULL, '2023-03-10 10:40:44', '2023-03-10 10:40:44', '71781767', '1111', 'CON0016'),
(26, 'THERA ', 'adel.bouazizi@thera.tn', '36000680', NULL, 'pharmaceutique', NULL, 'Lot N°20 Z.I. EL Agba- EL Hrairia. 2051 Tunis ', NULL, '2023-03-10 10:42:40', '2023-03-10 10:42:40', '36000687', '2051', 'CON0017'),
(27, 'WINTHROP PHARMA TUNISIE ', 'anis.benabderrazik@sanofi.com', '71433800', NULL, 'pharmaceutique', NULL, '34 AVENUE DE PARIS 2033 MEGRINE TUNISIE ', NULL, '2023-03-10 10:45:08', '2023-03-10 10:45:08', '71433300', '2033', 'CON0018'),
(28, 'Sofiene Ben Abid', 's.benabid@gnet.tn', '71963492', NULL, 'Expert Comptable', NULL, 'Rue Lac Tchad, imm, kanzat abis1, berges du lac, 1053 Tunis', NULL, '2023-03-10 15:14:43', '2023-03-10 15:14:43', NULL, NULL, 'CON0019'),
(29, 'Net Voyages', 'nett.voyages@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0020'),
(30, 'Tra Team', 'travel.team@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0021'),
(31, 'Asw Tunisyria-Travel1', 'aswan-tunisyria-travel1@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0022'),
(32, 'Par Hotmail', 'paradisvoyages@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0023'),
(33, 'Eur Topnet', 'eurekavoyages@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0024'),
(34, 'Asw Tunisyria-Travel1', 'aswan-tunisyria-travel1@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0025'),
(35, 'Asf Gmail', 'asfartunisia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0026'),
(36, 'Nar Voyages', 'narcisse.voyages@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0027'),
(37, 'Com Tatouvoyages', 'commercial.tatouvoyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0028'),
(38, 'Tgv Planet', 'tgv@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0029'),
(39, 'Inf Tahavoyages', 'info@tahavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0030'),
(40, 'Awa Zribi', 'awatef.zribi@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0031'),
(41, 'Ag_ Novatours', 'ag_novatours@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0032'),
(42, 'Boo Flower', 'booking.flower@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0033'),
(43, 'Com Datravel', 'commercial@datravel.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0034'),
(44, 'One Ariana', 'onet.ariana@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0035'),
(45, 'Web Tunisie', 'webmaster@tunisie-voyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0036'),
(46, 'Hay Inventatourisme', 'haythem@inventatourisme.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0037'),
(47, 'Sal Inventatourisme', 'sales2@inventatourisme.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0038'),
(48, 'Plt Pearlaketravel', 'plt@pearlaketravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0039'),
(49, 'Mou Voyages', 'mouna.voyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0040'),
(50, 'Com Raydtours', 'commercial@raydtours.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0041'),
(51, 'Sen Koubaji', 'senda.koubaji@dlh.de', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0042'),
(52, 'Lab Pharmadep', 'labo.pharmadep@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0043'),
(53, 'Eva Gnet', 'evatour@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0044'),
(54, 'Cac Commercial', 'cactusevents.commercial@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0045'),
(55, 'Con Euphoric', 'contact@euphoric-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0046'),
(56, 'Con Ciao', 'contact@ciao-traveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0047'),
(57, 'Gst Gnet', 'gst@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0048'),
(58, 'Out Happydays', 'outgoing@happydays.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0049'),
(59, 'Avi Tours', 'avia_tours@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0050'),
(60, 'Dal Travel', 'dalessandro.travel@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0051'),
(61, 'Man Bonvoyagetunisia', 'manager@bonvoyagetunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0052'),
(62, 'Tou Oussama', 'touiti.oussama@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0053'),
(63, 'Con Nas', 'contact.nas@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0054'),
(64, 'Ime Nssiri', 'imed.nssiri@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0055'),
(65, 'For Planet', 'fortuna@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0056'),
(66, '33T Tunisie', '33tours.tunisie@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0057'),
(67, 'Com Topnet', 'commercialhappydays@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0058'),
(68, 'Con Dreamrentacar', 'contact@dreamrentacar.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0059'),
(69, 'Inf Yasmintravel', 'info@yasmintravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0060'),
(70, 'Dmc Inventive', 'dmc@inventive-tunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0061'),
(71, 'Hop Planet', 'hopetravel@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0062'),
(72, 'Inf Traveltrendstunisia', 'info@traveltrendstunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0063'),
(73, 'Inf Euromedtravel', 'info@euromedtravel.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0064'),
(74, 'Inf Amelvoyages', 'info@amelvoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0065'),
(75, 'Wal Happydays', 'walidhnid@happydays.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0066'),
(76, 'Com Tahavoyages', 'commercial1@tahavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0067'),
(77, 'Nou Ayadi', 'nouha.ayadi@pearlaketravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0068'),
(78, 'Dor Srih', 'dorra.srih@pearlaketravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0069'),
(79, 'Yos Hotmail', 'yosrabadreddine@hotmail.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0070'),
(80, 'Com Euphoric', 'commercial@euphoric-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0071'),
(81, 'Bil Euphoric', 'billeterie@euphoric-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0072'),
(82, 'Dir Euphoric', 'direction@euphoric-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0073'),
(83, 'Inf Euphoric', 'info@euphoric-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0074'),
(84, 'Afr Gnet', 'africantours@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0075'),
(85, 'Web Orangers', 'webmaster@orangers.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0076'),
(86, 'Inf Alliancetravel', 'info@alliancetravel.ch', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:20', '2023-03-29 12:09:20', NULL, NULL, 'CON0077'),
(87, 'Inf Otentic', 'info@otentic.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0078'),
(88, 'Avi Yahoo', 'aviatours@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0079'),
(89, 'Inf Bedouintour', 'info@bedouintour.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0080'),
(90, 'Car Amydidon', 'carthage.amydidon@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0081'),
(91, 'Fet Bah', 'fethi.bah@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0082'),
(92, 'Hic Melliti', 'hichem.melliti@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0083'),
(93, 'Mou Had', 'moufida.had@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0084'),
(94, 'Gar Tou', 'gargouri.tou@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0085'),
(95, 'Lou Mongi', 'Loukil.mongi@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0086'),
(96, 'Lou Mehdi', 'Loukil.mehdi@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0087'),
(97, 'Ben Khaled', 'bensalah.khaled@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0088'),
(98, 'Car Hm', 'carthagetours.hm@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0089'),
(99, 'Car Djerba', 'carthagetours.djerba@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0090'),
(100, 'Ct. Sousse', 'ct.sousse@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0091'),
(101, 'Car Tozeur', 'carthagetours.tozeur@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0092'),
(102, 'Dir Creative', 'direction@creative-tunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0093'),
(103, 'Inf Desertlumiere', 'info@desertlumiere.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0094'),
(104, 'Age Desert', 'agence@desert-tresors.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0095'),
(105, 'Lez Pub', 'lezard-pub@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0096'),
(106, 'Inf Estetikatour', 'info@estetikatour.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0097'),
(107, 'Ove Dmc', 'overseas.dmc@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0098'),
(108, 'Con Cosmeticatravel', 'contact@cosmeticatravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0099'),
(109, 'Con Bienetre', 'contact@bienetre-tunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0100'),
(110, 'Inf Autotunisie', 'info@autotunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0101'),
(111, 'Mul Commercial', 'multivision.commercial@spg.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0102'),
(112, 'Inf Hafsitravel', 'info@hafsitravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0103'),
(113, 'Inf Boursevoyages', 'info@boursevoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0104'),
(114, 'Man Boursevoyages', 'manager@boursevoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0105'),
(115, 'Gal Rentacar', 'galaxy.rentacar@galaxygroupe.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0106'),
(116, 'Gal Travel', 'galaxy.travel@galaxygroupe.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0107'),
(117, 'Gam Khamaiel', 'gammoudi.khamaiel@galaxygroupe.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0108'),
(118, 'Ste Planet', 'stelfair@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0109'),
(119, 'Con Voyagerentunisie', 'contact@voyagerentunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0110'),
(120, 'Inf Agencealyssa', 'info@agencealyssa.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0111'),
(121, 'Com Sweettunisia', 'commercial@sweettunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0112'),
(122, 'Res Sweettunisia', 'reservation@sweettunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0113'),
(123, 'Sts Sfax', 'sts.sfax@tunet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0114'),
(124, 'Con Saharaaventurestunisia', 'contact@saharaaventurestunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0115'),
(125, 'Sot Tn', 'sotuvit.tn@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0116'),
(126, 'Ren Interlo', 'rentacar@interlo.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0117'),
(127, 'Ame Interlo', 'americanexpress@interlo.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0118'),
(128, 'Dec Sotuvit', 'decouvertes.sotuvit@interlo.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0119'),
(129, 'Waj Tunet', 'wajdivoyage@tunet.n', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0120'),
(130, 'Ces Travel', 'cesar.travel@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0121'),
(131, 'Ham Cesar', 'hammamet@cesar-travel-service.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0122'),
(132, 'Inf Cesar', 'info@cesar-travel-service.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0123'),
(133, 'Tun Cesar', 'tunis@cesar-travel-service.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0124'),
(134, 'Inf Kastiliyavoyages', 'info@kastiliyavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0125'),
(135, 'Ara Boussaid', 'arafet.boussaid@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0126'),
(136, 'Dal Abd', 'daly.abd@loisirclub.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0127'),
(137, 'Loi Planet', 'loisirclub@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0128'),
(138, 'Mon Ayed', 'monia.ayed@loisirclub.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0129'),
(139, 'Inf Magictourstunisia', 'info@magictourstunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0130'),
(140, 'Ahl Oktunisia', 'ahlem@oktunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0131'),
(141, 'Tra Oktunisia', 'travelandevents@oktunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0132'),
(142, 'Dir Oktunisia', 'direction@oktunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0133'),
(143, 'Com Oktunisia', 'commercial@oktunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0134'),
(144, 'Sai Sami', 'saidi.sami@platinevents.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0135'),
(145, 'Pri Contact', 'prima.contact@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0136'),
(146, 'Ope Punictours', 'operation.punictours@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0137'),
(147, 'Com Skylinetraveltunisie', 'commercial@skylinetraveltunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0138'),
(148, 'Tra Planet', 'travelacademy@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0139'),
(149, 'Kel Vestiges', 'kelibia@vestiges-tours-online.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0140'),
(150, 'Com Vestiges', 'commercialtunis@vestiges-tours-online.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0141'),
(151, 'Sou Vestiges', 'sousse@vestiges-tours-online.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0142'),
(152, 'Ger Vestiges', 'germany@vestiges-tours-dmc.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0143'),
(153, 'Pdg Vestiges', 'pdg@vestiges-tours-online.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0144'),
(154, 'Com Vestiges', 'commercial@vestiges-tours-online.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0145'),
(155, 'Vio Skynet', 'violetteTravel@skynet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0146'),
(156, 'Vis Gnet', 'visittn@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0147'),
(157, 'Con Voyages', 'contact@voyages-aventures.net', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0148'),
(158, 'Vlt Planet', 'Vlt@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0149'),
(159, 'Inf Zaied', 'info@zaied-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0150'),
(160, 'Tun Hotixsoft', 'tunisie@hotixsoft.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0151'),
(161, 'Bio Biodatacarthago', 'biodata@biodatacarthago.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0152'),
(162, 'Mak Topnet', 'maktaristravel@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0153'),
(163, 'Got Service', 'gotravel.service@ymail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0154'),
(164, 'Inf Uzitatraveltunisia', 'info@uzitatraveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0155'),
(165, 'Inf Sotuvit', 'info@sotuvit.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0156'),
(166, 'Com Jupitervoyages', 'commercial@jupitervoyages.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0157'),
(167, 'Inf Medtour', 'info@medtour.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0158'),
(168, 'Res Medtour', 'resa@medtour.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0159'),
(169, 'Com Medtour', 'compta@medtour.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0160'),
(170, 'Ros Gmail', 'rosatraveltn@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0161'),
(171, 'Res Sweetunisia', 'reservation@sweetunisia.info', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0162'),
(172, 'Com Gantravel', 'commercial@gantravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0163'),
(173, 'Rec Gantravel', 'reclamation@gantravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0164'),
(174, 'Pub Gantravel', 'pub@gantravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0165'),
(175, 'Con Optionvoyages', 'contact@optionvoyages.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0166'),
(176, 'Tou Tgv', 'tourisme@tgv.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0167'),
(177, 'Inf Suntraveltunisia', 'info@suntraveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0168'),
(178, 'Res Suntraveltunisia', 'reservation@suntraveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0169'),
(179, 'Bil Suntraveltunisia', 'biletterie@suntraveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0170'),
(180, 'Kd@ Activetravel', 'kd@activetravel.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0171'),
(181, 'Inf Mawasim', 'info@mawasim.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0172'),
(182, 'Con Easybooking', 'contact@easybooking.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0173'),
(183, 'Dir St', 'direction@st-tunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0174'),
(184, 'Con Travelbox', 'contact@travelbox.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0175'),
(185, 'Olf Brh', 'olfa_brh@hotmail.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0176'),
(186, 'Tun Hotmail', 'tunivoyage@hotmail.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0177'),
(187, 'Com Tunivoyage', 'commerciale@tunivoyage.com ', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0178'),
(188, 'Con Dream', 'CONTACT@dream-landtours.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0179'),
(189, 'Dar Yahoo', 'darine18@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0180'),
(190, 'Has Syrinetours', 'hassen@syrinetours.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0181'),
(191, 'Mod Ymail', 'moderntravel@ymail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0182'),
(192, 'Con Tta', 'contact@tta-agency.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0183'),
(193, 'Dia Travel', 'diamant.travel@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0184'),
(194, 'Mic Mkvoyages', 'mice.mkvoyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0185'),
(195, 'Com Yahoo', 'commercialbreaktours@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0186'),
(196, 'Inf Tourintunisia', 'info@tourintunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0187'),
(197, 'Inf Breaktours', 'info@breaktours.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0188'),
(198, 'Had Travel', 'hadrumete.travel@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0189'),
(199, 'Tou Voyageair', 'tourisme@voyageair.net', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0190'),
(200, 'Con Reservy', 'contact@reservy.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0191'),
(201, 'Kha Khelil', 'khalilo.khelil@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0192'),
(202, 'Kmd Mattoussi', 'kmd.mattoussi@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0193'),
(203, 'Com Tahavoyages', 'commercial@tahavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0194'),
(204, 'Dor Srih', 'dorra.srih@pearltravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0195'),
(205, 'Con Mayaseentravel', 'contact@mayaseentravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0196'),
(206, 'Inf Mayaseentravel', 'info@mayaseentravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0197'),
(207, 'Com Linkvoyages', 'Comptoir1@linkvoyages.net', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0198'),
(208, 'Con Rateltourstunisia', 'contact@rateltourstunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0199'),
(209, 'Con Idolevoyages', 'contact@idolevoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0200'),
(210, 'Inf Breaktours', 'info.breaktours@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0201'),
(211, 'Man Breaktours', 'manager.breaktours@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0202'),
(212, 'Com Taoufik', 'commercial@taoufik-mkacher-group.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0203'),
(213, 'Inf Lamarsavoyages', 'info@lamarsavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0204'),
(214, 'Inf Sunseekertunisia', 'info@sunseekertunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0205'),
(215, 'Res Aquasun', 'reservation@aquasun.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0206'),
(216, 'Res Miramarvoyages', 'resa@miramarvoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0207'),
(217, 'Res Yougotravel', 'resatn@yougotravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0208'),
(218, 'Boo Doniaholidays', 'booking@doniaholidays.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0209'),
(219, 'Lin Linkvoyages', 'link@linkvoyages.net', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0210'),
(220, 'Con Topeventstunisie', 'contact@topeventstunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0211'),
(221, 'Top Events.Tunisie', 'top.events.tunisie@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0212'),
(222, 'Com Topeventstunisie', 'commercial@topeventstunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0213'),
(223, 'Fin Topeventstunisie', 'financier@topeventstunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0214'),
(224, 'Dir Topeventstunisie', 'direction@topeventstunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0215'),
(225, 'Con Sunlinetraveltunisia', 'contact@sunlinetraveltunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0216'),
(226, 'Com Economy.Travel', 'commercial.economy.travel@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0217'),
(227, 'Dir Ayatravel', 'direction@ayatravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0218'),
(228, 'S.D D.S_Agence', 's.d.s_agence@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0219'),
(229, 'Inf Safarivoyages', 'info.safarivoyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0220'),
(230, 'Inf Mimivoyages', 'info@mimivoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0221'),
(231, 'Dir Soumatravel', 'direction@soumatravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0222'),
(232, 'Kou Gmail', 'kounouzbizerte@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0223'),
(233, 'Com Iyedtravel', 'commercial1@iyedtravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0224'),
(234, 'Inf Omegatravel', 'infos@omegatravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0225'),
(235, 'Inf Elyseevoyages', 'info@elyseevoyages.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0226'),
(236, 'Cla Topnet', 'classe1@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0227'),
(237, 'Con Tuliptravel', 'contact@tuliptravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0228'),
(238, 'Inf Goldtravelservice', 'info@goldtravelservice.net ', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0229'),
(239, 'Jan Yahoo', 'janenetoursjanenetours@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0230'),
(240, 'Inf Kh', 'info.kh@st-tunisia.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0231'),
(241, 'Boo Dream', 'Booking@dream-landtours.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0232'),
(242, 'Com Sfax', 'commercial.sfax@thapsusvoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0233'),
(243, 'Kha Voyages', 'khaldoun.voyages@topnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0234'),
(244, 'Com Tunisiabaytravel', 'commercial@tunisiabaytravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0235'),
(245, 'Inf Tunisiabaytravel', 'info@tunisiabaytravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0236'),
(246, 'Con Lifetravel', 'contact@lifetravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0237'),
(247, 'Con Voguevoyages', 'contact@voguevoyages.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0238'),
(248, 'Che Guerfalli', 'Cherif.guerfalli@tui.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0239'),
(249, 'Res Bestunitedtravel', 'reservation@bestunitedtravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0240'),
(250, 'Gm@ Libertavoyages', 'gm@libertavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0241'),
(251, 'Eli Gmail', 'elinetravelservice@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0242'),
(252, 'L.I Instantvoyage', 'l.instantvoyage@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0243'),
(253, 'Con Naimtravelservices', 'contact@naimtravelservices.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0244'),
(254, 'Tha Voyages', 'thapsus.voyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0245'),
(255, 'Com Thapsusvoyages', 'commercial@thapsusvoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0246'),
(256, 'Sal Travelsquare', 'sales@travelsquare.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0247'),
(257, 'Inf Travelsquare', 'info@travelsquare.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0248'),
(258, 'Kha Benaifa', 'khaled.benaifa@dtservices.travel', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0249'),
(259, 'Inf Pacha', 'info@pacha-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0250'),
(260, 'Sal Tunisia', 'sales@tunisia-travel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0251'),
(261, 'Com Optionvoyages', 'commercial@optionvoyages.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0252'),
(262, 'Res On-Line', 'reservation-on-line@goldenevents.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0253'),
(263, 'Tou Goldenevents', 'tourisme@goldenevents.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0254'),
(264, 'Bil Goldenevents', 'billetterie@goldenevents.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0255'),
(265, 'Res Holidaypure', 'resa.holidaypure@uts.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0256'),
(266, 'Sal Manager', 'sales.manager@optionvoyages.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0257'),
(267, 'Syn Tours', 'syndabad.tours@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0258'),
(268, 'Syn Res', 'syndabad.res@gnet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0259'),
(269, 'Inf Freedomtravel', 'info@freedomtravel.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0260'),
(270, 'Inf Atlantis', 'info@atlantis.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0261'),
(271, 'Omr Libertavoyages', 'omra@libertavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0262'),
(272, 'Eco Libertavoyages', 'ecommerce@libertavoyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0263'),
(273, 'Boo Miralina', 'booking@miralina.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0264'),
(274, 'Nou Travel', 'Nouza.Travel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0265'),
(275, 'Com Ovoyages', 'Commercial@ovoyages-tunisie.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0266'),
(276, 'Con Tta', 'contact@tta.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0267'),
(277, 'Con Barclaystravel', 'contact@barclaystravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0268'),
(278, 'Ska Syrinetours', 'skander@syrinetours.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0269'),
(279, 'Out Manel', 'outgoing@manel-voyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0270'),
(280, 'Com Manel', 'commercial@manel-voyages.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0271'),
(281, 'Boo Mazartravel', 'booking@mazartravel.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0272'),
(282, 'Med Medenine', 'medhitours.medenine@orange.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0273'),
(283, 'Sab Gmail', 'sabriavoyages@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0274'),
(284, 'Inf Orbitravel', 'info@orbitravel.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0275'),
(285, 'Con Ulysse', 'contact@ulysse-tours.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0276'),
(286, 'Sel Tours', 'Select.tours@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0277'),
(287, 'Waj Tunet', 'wajdivoyage@tunet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0278'),
(288, 'Age Avs', 'agence_avs@yahoo.fr', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0279'),
(289, 'Age Nefzawa', 'age.nefzawa@planet.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0280'),
(290, 'Con Ibooking', 'contact@ibooking.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0281'),
(291, 'Inf Tunisiatravel', 'info@tunisiatravel.org', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0282'),
(292, 'Com Ulyssevents', 'commercial@ulyssevents.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0283'),
(293, 'Sab Syrinetours', 'sabrine@syrinetours.com.tn', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0284'),
(294, 'Tun Orangetravelgroup', 'tunisia@orangetravelgroup.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-29 12:09:21', '2023-03-29 12:09:21', NULL, NULL, 'CON0285'),
(295, 'Proculogy', 'info@proculogy.com', '29604000', NULL, 'Business Consultancy', NULL, 'Bureau 2-2, 2nd Floor Marsa Mall, 2046, Tunis, Tunisia', 'http://www.proculogy.com/', '2023-03-31 10:58:48', '2023-03-31 10:58:48', NULL, '2046', 'CON0286'),
(296, 'Mkg concept', 'mailto:mkg@mkgconcept.net', '29951595', '.', 'Communication', NULL, 'Imm Nour, Rue du Lac Turkana 1053 Les Berges du Lac – Tunis', NULL, '2023-03-31 12:54:31', '2023-03-31 12:54:31', '71691591', '1053', 'CON0287'),
(297, 'CTN', 'COTUNAV@CTN.COM.TN', '71322802', NULL, 'Transport', NULL, '05, AVENUE DAG HAMMARSKJOELD\r\n\r\n1001 TUNIS – TUNISIA', 'WWW.CTN.COM.TN', '2023-03-31 13:18:56', '2023-03-31 13:18:56', NULL, NULL, 'CON0288'),
(298, 'Créateam', 'createam@planet.tn', NULL, NULL, 'Advertising Agency', NULL, 'Rue 8300 - Immeuble LUXOR I ,App B 3.5 - Montplaisir, Tunis, 1002', NULL, '2023-04-04 08:21:38', '2023-04-04 08:21:38', NULL, '1002', 'CON0289'),
(299, 'Institut Supérieur de Théologie Ezzitouna', NULL, '71575514', NULL, 'Université', NULL, '11, rue la mosquée el Hawa, place maakel ezzaim, 1008 Tunis', NULL, '2023-04-04 09:13:19', '2023-04-04 09:13:19', NULL, '1008', 'CON0290'),
(300, 'COSEM', 'mouradelghazi@hotmail.com', '22643404', NULL, NULL, NULL, 'Rue Chaghalin A46 , Manouba', NULL, '2023-04-11 08:10:06', '2023-04-11 08:10:06', NULL, NULL, 'CON0291'),
(301, 'Dance Beauty (École de danse)', NULL, '20262945', NULL, NULL, NULL, 'Rue mohamed bairem 5 marsa les pins, La Marsa, Tunisia', NULL, '2023-04-13 13:13:00', '2023-04-13 13:14:44', NULL, NULL, 'CON0292');

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date_debut` varchar(255) NOT NULL,
  `date_fin` varchar(255) NOT NULL,
  `nb_mois` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `entreprise_id` varchar(255) NOT NULL,
  `timbre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `devise` varchar(10) DEFAULT 'TND'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `numero`, `date_debut`, `date_fin`, `nb_mois`, `client_id`, `entreprise_id`, `timbre`, `created_at`, `updated_at`, `devise`) VALUES
(11, 'CN20230001', '2023-03-24', '2024-03-24 00:00:00', '12', '7', '1', '1', '2023-03-16 10:15:14', '2023-03-16 10:15:14', 'TND'),
(12, 'CN20230002', '2023-03-24', '2024-03-24 00:00:00', '12', '89', '1', '1', '2023-03-22 15:22:14', '2023-03-22 15:22:14', 'TND'),
(13, 'CN20230003', '2023-03-24', '2024-03-24', '12', '1', '1', '1', '2023-03-24 10:05:38', '2023-03-24 10:05:38', 'TND'),
(14, 'CN20230004', '2023-03-24', '2024-03-24 00:00:00', '12', '3', '1', '1', '2023-03-24 10:08:35', '2023-03-24 10:08:35', 'TND'),
(15, 'CN20230005', '2023-03-24', '2024-03-24 00:00:00', '12', '10', '1', '1', '2023-03-27 08:00:45', '2023-03-27 08:00:45', 'TND'),
(16, 'CN20230006', '2023-03-24', '2024-03-24 00:00:00', '12', '50', '1', '1', '2023-03-27 08:16:45', '2023-03-27 08:16:45', 'TND'),
(17, 'CN20230007', '2023-03-24', '2024-03-24 00:00:00', '12', '2', '1', '1', '2023-03-27 08:19:07', '2023-03-27 08:19:07', 'TND'),
(18, 'CN20230008', '2023-03-24', '2024-03-24 00:00:00', '12', '96', '1', '1', '2023-03-27 08:23:38', '2023-03-27 08:23:38', 'TND'),
(19, 'CN20230009', '2023-03-24', '2024-03-24 00:00:00', '12', '5', '1', '1', '2023-03-27 08:25:23', '2023-03-27 08:25:23', 'TND'),
(20, 'CN20230010', '2023-03-24', '2024-03-24 00:00:00', '12', '36', '1', '1', '2023-03-27 08:27:52', '2023-03-27 08:27:52', 'TND'),
(21, 'CN20230011', '2023-03-24', '2024-03-24 00:00:00', '12', '54', '1', '1', '2023-03-27 08:30:02', '2023-03-28 09:57:06', 'TND');

-- --------------------------------------------------------

--
-- Structure de la table `contrats_factures`
--

CREATE TABLE `contrats_factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrat_id` varchar(255) NOT NULL,
  `facture_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats_factures`
--

INSERT INTO `contrats_factures` (`id`, `contrat_id`, `facture_id`, `created_at`, `updated_at`) VALUES
(12, '11', '95', '2023-03-22 07:07:33', '2023-03-22 07:07:33'),
(13, '12', '99', '2023-03-22 15:22:16', '2023-03-22 15:22:16'),
(14, '13', '103', '2023-03-24 10:05:39', '2023-03-24 10:05:39'),
(15, '14', '104', '2023-03-24 10:08:36', '2023-03-24 10:08:36'),
(16, '15', '105', '2023-03-27 10:13:12', '2023-03-27 10:13:12'),
(17, '16', '106', '2023-03-27 10:49:02', '2023-03-27 10:49:02'),
(18, '17', '107', '2023-03-27 10:49:02', '2023-03-27 10:49:02'),
(19, '13', '182', '2023-04-24 08:07:52', '2023-04-24 08:07:52'),
(20, '14', '183', '2023-04-24 08:07:52', '2023-04-24 08:07:52'),
(21, '11', '184', '2023-04-24 08:33:26', '2023-04-24 08:33:26'),
(22, '12', '185', '2023-04-24 08:33:26', '2023-04-24 08:33:26'),
(23, '15', '186', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(24, '16', '187', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(25, '17', '167', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(26, '18', '189', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(27, '19', '190', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(28, '20', '191', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(29, '21', '192', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(30, '21', '112', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(31, '20', '111', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(32, '19', '110', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(33, '18', '212', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(34, '17', '213', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(35, '16', '214', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(36, '15', '215', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(37, '12', '99', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(38, '11', '217', '2023-04-28 13:04:25', '2023-04-28 13:04:25'),
(39, '21', '220', '2023-05-02 11:41:19', '2023-05-02 11:41:19'),
(40, '20', '221', '2023-05-02 11:41:19', '2023-05-02 11:41:19'),
(41, '15', '222', '2023-05-02 11:45:28', '2023-05-02 11:45:28'),
(42, '11', '223', '2023-05-02 11:46:35', '2023-05-02 11:46:35'),
(43, '18', '224', '2023-05-02 11:49:48', '2023-05-02 11:49:48'),
(44, '16', '225', '2023-05-02 11:50:42', '2023-05-02 11:50:42'),
(45, '17', '226', '2023-05-02 11:52:24', '2023-05-02 11:52:24'),
(46, '21', '227', '2023-05-02 14:24:56', '2023-05-02 14:24:56'),
(47, '20', '228', '2023-05-02 14:24:56', '2023-05-02 14:24:56'),
(48, '19', '229', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(49, '19', '230', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(50, '18', '231', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(51, '17', '232', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(52, '16', '233', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(53, '15', '234', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(54, '12', '235', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(55, '11', '236', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(56, '19', '237', '2023-05-02 14:28:15', '2023-05-02 14:28:15'),
(57, '19', '238', '2023-05-02 14:28:15', '2023-05-02 14:28:15'),
(58, '18', '239', '2023-05-02 14:28:15', '2023-05-02 14:28:15'),
(59, '17', '240', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(60, '16', '241', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(61, '15', '242', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(62, '12', '243', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(63, '11', '244', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(64, '19', '175', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(65, '18', '109', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(66, '17', '109', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(67, '16', '248', '2023-05-02 15:25:35', '2023-05-02 15:25:35');

-- --------------------------------------------------------

--
-- Structure de la table `customnotifs`
--

CREATE TABLE `customnotifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `type_notif` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `client_type_notif` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `facture_id` varchar(255) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `camion_id` varchar(255) DEFAULT NULL,
  `camion_type_notif` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `datesconges`
--

CREATE TABLE `datesconges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `conge_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `datesconges`
--

INSERT INTO `datesconges` (`id`, `date`, `conge_id`, `created_at`, `updated_at`) VALUES
(1, '2023-05-15', '1', '2023-04-28 15:29:27', '2023-04-28 15:29:27');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_paiement` varchar(255) NOT NULL,
  `fournisseur_id` varchar(255) DEFAULT NULL,
  `entreprise_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `retenu` double NOT NULL DEFAULT 0,
  `facture_retenu` double NOT NULL DEFAULT 1,
  `facture_ht` double NOT NULL DEFAULT 0,
  `facture_tva` double NOT NULL DEFAULT 0,
  `facture_debour` double NOT NULL DEFAULT 0,
  `facture_remise` double NOT NULL DEFAULT 0,
  `facture_paye` double NOT NULL DEFAULT 0,
  `facture_solde` double NOT NULL DEFAULT 0,
  `facture_ttc` double NOT NULL DEFAULT 0,
  `timbre` double NOT NULL DEFAULT 1,
  `footer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `entreprise_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `devis_ht` double NOT NULL DEFAULT 0,
  `devis_tva` double NOT NULL DEFAULT 0,
  `devis_ttc` double NOT NULL DEFAULT 0,
  `devis_remise` double NOT NULL DEFAULT 0,
  `condition` longtext DEFAULT NULL,
  `footer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `devise` varchar(255) DEFAULT 'TND'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `numero`, `type`, `date`, `client_id`, `entreprise_id`, `status`, `devis_ht`, `devis_tva`, `devis_ttc`, `devis_remise`, `condition`, `footer`, `created_at`, `updated_at`, `devise`) VALUES
(13, 'DEV20230001', NULL, '2023-01-06', '112', '1', 'en cours', 28700.5, 2532.235, 31232.735, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-06 16:06:58', '2023-01-16 10:02:37', 'TND'),
(14, 'DEV20230002', NULL, '2023-01-09', '79', '1', 'converti_facture', 10953.42, 2081.15, 13034.571, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-09 13:08:42', '2023-01-23 09:41:04', 'TND'),
(15, 'DEV20230003', NULL, '2023-01-10', '1', '1', 'en cours', 1539, 107.73, 1646.73, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-10 15:39:38', '2023-01-10 15:43:05', 'TND'),
(16, 'DEV20230004', NULL, '2023-01-11', '119', '1', 'en cours', 4059.3, 771.267, 4830.567, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-11 12:37:42', '2023-01-11 14:21:05', 'TND'),
(18, 'DEV20230006', NULL, '2023-01-11', '119', '1', 'en cours', 1120, 212.8, 1332.8, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-11 16:05:48', '2023-01-11 16:06:36', 'TND'),
(19, 'DEV20230007', NULL, '2023-01-13', '120', '1', 'en cours', 2780, 194.6, 2974.6, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-13 08:59:22', '2023-01-13 09:17:09', 'TND'),
(23, 'DEV20230008', NULL, '2023-01-17', '112', '1', 'en cours', 16145, 3067.55, 19212.55, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-17 12:01:40', '2023-01-17 15:39:45', 'TND'),
(24, 'DEV20230009', NULL, '2023-01-18', '1', '1', 'converti_facture', 2350, 164.5, 2514.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-18 13:37:01', '2023-01-23 09:57:24', 'TND'),
(25, 'DEV20230010', NULL, '2023-01-23', '121', '1', 'converti_facture', 5600, 1064, 6664, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-23 13:59:29', '2023-03-23 12:11:43', 'TND'),
(26, 'DEV20230011', NULL, '2023-01-25', '100', '1', 'en cours', 1350, 256.5, 1606.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-25 12:41:45', '2023-01-25 13:09:56', 'TND'),
(29, 'DEV20230012', NULL, '2023-01-27', '79', '1', 'en cours', 1500, 105, 1605, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-27 13:19:34', '2023-04-25 08:56:52', 'TND'),
(30, 'DEV20230013', NULL, '2023-01-30', '122', '1', 'en cours', 600, 0, 600, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-30 09:32:56', '2023-01-30 09:34:14', 'TND'),
(32, 'DEV20230014', NULL, '2023-01-31', '5', '1', 'converti_facture', 5890, 412.3, 6302.3, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-31 12:26:54', '2023-02-07 09:30:21', 'TND'),
(33, 'DEV20230015', NULL, '2023-02-01', '123', '1', 'en cours', 7580, 1440.2, 9020.2, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-01 14:43:00', '2023-02-01 15:16:50', 'TND'),
(35, 'DEV20230016', NULL, '2023-02-06', '79', '1', 'converti_facture', 1928, 366.32, 2294.32, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-06 10:51:56', '2023-02-13 12:52:35', 'TND'),
(36, 'DEV20230017', NULL, '2023-02-08', '36', '1', 'converti_facture', 984, 0, 984, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-08 13:36:15', '2023-02-09 14:48:52', 'TND'),
(37, 'DEV20230018', NULL, '2023-02-10', '26', '1', 'converti_facture', 13985.9, 1630.721, 15616.621, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-10 15:31:34', '2023-02-23 07:37:16', 'TND'),
(38, 'DEV20230019', NULL, '2023-02-13', '26', '1', 'en cours', 400, 76, 476, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-13 09:23:18', '2023-02-13 09:24:47', 'TND'),
(39, 'DEV20230020', NULL, '2023-02-13', '124', '1', 'en cours', 1350, 256.5, 1606.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-13 10:11:26', '2023-02-13 10:13:28', 'TND'),
(40, 'DEV20230021', NULL, '2023-02-14', '84', '1', 'en cours', 350, 66.5, 416.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-14 08:23:29', '2023-02-14 08:30:26', 'TND'),
(41, 'DEV20230022', NULL, '2023-02-14', '3', '1', 'converti_facture', 3915, 274.05, 4189.05, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-14 08:56:01', '2023-02-22 10:54:04', 'TND'),
(42, 'DEV20230023', NULL, '2023-02-14', '80', '1', 'en cours', 450, 85.5, 535.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-14 16:26:50', '2023-02-14 16:28:17', 'TND'),
(43, 'DEV20230024', NULL, '2023-02-15', '7', '1', 'en cours', 400, 76, 476, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-15 09:52:42', '2023-02-15 09:56:56', 'TND'),
(44, 'DEV20230025', NULL, '2023-02-20', '126', '1', 'en cours', 2050, 389.5, 2439.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-20 15:45:28', '2023-02-20 16:06:14', 'TND'),
(45, 'DEV20230026', 'export', '2023-02-22', '110', '1', 'en cours', 6170, 1172.3, 7342.3, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-22 12:50:06', '2023-02-22 13:01:48', 'TND'),
(46, 'DEV20230027', NULL, '2023-02-23', '127', '1', 'en cours', 3116, 484.04, 3600.04, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-23 14:05:52', '2023-02-23 14:21:27', 'TND'),
(54, 'DEV20230028', NULL, '2023-02-27', '84', '1', 'en cours', 2320, 440.8, 2760.8, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-27 16:00:51', '2023-02-27 16:03:04', 'TND'),
(55, 'DEV20230029', NULL, '2023-02-28', '5', '1', 'en cours', 5594, 391.58, 5985.58, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-02-28 15:02:33', '2023-02-28 15:11:46', 'TND'),
(56, 'DEV20230030', NULL, '2023-03-01', '96', '1', 'en cours', 10366.72, 1969.677, 12336.397, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-01 15:27:24', '2023-03-01 15:41:36', 'TND'),
(57, 'DEV20230031', NULL, '2023-03-02', '96', '1', 'en cours', 153, 29.07, 182.07, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-02 15:37:43', '2023-03-02 15:46:53', 'TND'),
(59, 'DEV20230033', NULL, '2023-03-03', '96', '1', 'converti_facture', 11000, 2090, 13090, 0, '20% y compris contrat de maintenance.', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-03 07:49:47', '2023-04-13 07:37:37', 'TND'),
(61, 'DEV20230035', NULL, '2023-03-03', '109', '1', 'converti_facture', 2381, 452.39, 2833.39, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-03 08:29:15', '2023-03-03 15:35:49', 'TND'),
(62, 'DEV20230036', NULL, '2023-03-03', '36', '1', 'converti_facture', 875, 0, 875, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-03 09:22:45', '2023-03-03 11:43:45', 'TND'),
(63, 'DEV20230037', NULL, '2023-03-03', '3', '1', 'en cours', 1380, 262.2, 1642.2, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-03 15:36:27', '2023-03-03 16:01:34', 'TND'),
(64, 'DEV20230038', NULL, '2023-03-03', '96', '1', 'en cours', 620, 117.8, 737.8, 0, '620 dt par mois y compris License Plesk et License SSL, exigence 3ans de contrat', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-03 15:49:17', '2023-03-03 15:51:09', 'TND'),
(65, 'DEV20230039', NULL, '2023-03-06', '5', '1', 'converti_facture', 8300, 1577, 9877, 0, 'mode de paiement : 50% avance 50% a la livraison', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-06 08:41:18', '2023-05-09 17:30:15', 'TND'),
(66, 'DEV20230040', NULL, '2023-03-07', '5', '1', 'converti_facture', 2614, 182.98, 2796.98, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-07 07:45:22', '2023-03-09 07:50:51', 'TND'),
(67, 'DEV20230041', NULL, '2023-03-08', '133', '1', 'en cours', 2650, 503.5, 3153.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-08 09:59:25', '2023-03-09 08:26:35', 'TND'),
(68, 'DEV20230042', NULL, '2023-03-10', '51', '1', 'en cours', 516, 98.04, 614.04, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-10 07:46:53', '2023-03-10 07:50:20', 'TND'),
(69, 'DEV20230043', NULL, '2023-03-10', '134', '1', 'en cours', 2600, 494, 3094, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-10 12:57:41', '2023-03-10 13:22:37', 'TND'),
(70, 'DEV20230044', NULL, '2023-03-10', '135', '1', 'en cours', 1010, 191.9, 1201.9, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-10 15:33:33', '2023-03-10 15:39:32', 'TND'),
(73, 'DEV20230045', NULL, '2023-03-13', '137', '1', 'en cours', 600, 114, 714, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-13 10:38:22', '2023-03-13 10:42:32', 'TND'),
(74, 'DEV20230046', NULL, '2023-03-14', '84', '1', 'en cours', 750, 142.5, 892.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-14 13:39:57', '2023-03-14 13:43:53', 'TND'),
(75, 'DEV20230047', NULL, '2023-03-14', '84', '1', 'converti_facture', 1800, 342, 2142, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-14 13:45:57', '2023-04-14 12:41:44', 'TND'),
(76, 'DEV20230048', NULL, '2023-03-15', '7', '1', 'converti_facture', 4408.5, 345.015, 4753.515, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 08:45:55', '2023-03-23 12:08:28', 'TND'),
(77, 'DEV20230049', NULL, '2023-03-15', '96', '1', 'en cours', 150, 28.5, 178.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 09:32:13', '2023-03-15 09:39:56', 'TND'),
(78, 'DEV20230050', NULL, '2023-03-15', '50', '1', 'en cours', 450, 85.5, 535.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 09:39:18', '2023-03-15 09:42:40', 'TND'),
(79, 'DEV20230051', NULL, '2023-03-15', '124', '1', 'en cours', 246.8, 46.892, 293.692, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 09:40:13', '2023-03-16 13:07:44', 'TND'),
(80, 'DEV20230052', NULL, '2023-03-15', '3', '1', 'en cours', 1480, 281.2, 1761.2, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-15 15:43:31', '2023-03-15 15:59:41', 'TND'),
(81, 'DEV20230053', NULL, '2023-03-16', '137', '1', 'en cours', 1130, 214.7, 1344.7, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-16 15:08:13', '2023-03-21 15:30:33', 'TND'),
(82, 'DEV20230054', NULL, '2023-03-21', '93', '1', 'en cours', 500, 95, 595, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-21 08:07:07', '2023-03-21 12:22:05', 'TND'),
(83, 'DEV20230055', NULL, '2023-03-21', '96', '1', 'en cours', 3311.88, 629.257, 3941.137, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-21 09:58:14', '2023-03-21 10:00:03', 'TND'),
(84, 'DEV20230056', NULL, '2023-03-21', '141', '1', 'en cours', 13575, 1252.65, 14827.65, 0, 'Paiement à la livraison', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-21 12:48:47', '2023-03-21 16:07:37', 'TND'),
(85, 'DEV20230057', NULL, '2023-03-21', '5', '1', 'en cours', 985, 187.15, 1172.15, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-21 13:17:19', '2023-03-21 14:25:15', 'TND'),
(86, 'DEV20230058', NULL, '2023-03-22', '3', '1', 'converti_facture', 950, 180.5, 1130.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-22 10:45:47', '2023-04-06 08:07:04', 'TND'),
(87, 'DEV20230059', NULL, '2023-03-23', '36', '1', 'converti_facture', 3896.25, 0, 3896.25, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-23 11:01:24', '2023-04-12 08:22:39', 'TND'),
(88, 'DEV20230060', NULL, '2023-03-23', '26', '1', 'converti_facture', 440, 53.6, 493.6, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-23 11:35:12', '2023-03-31 09:23:45', 'TND'),
(89, 'DEV20230061', NULL, '2023-03-24', '143', '1', 'en cours', 6900, 1311, 8211, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-24 11:25:46', '2023-03-24 11:33:52', 'TND'),
(90, 'DEV20230062', NULL, '2023-03-27', '50', '1', 'converti_facture', 1148, 218.12, 1366.12, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-27 12:58:51', '2023-03-29 11:18:03', 'TND'),
(91, 'DEV20230063', NULL, '2023-03-28', '5', '1', 'en cours', 1920, 364.8, 2284.8, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-28 10:29:48', '2023-03-28 10:32:30', 'TND'),
(92, 'DEV20230064', NULL, '2023-03-28', '1', '1', 'en cours', 485, 92.15, 577.15, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-28 10:34:55', '2023-03-28 10:36:31', 'TND'),
(93, 'DEV20230065', NULL, '2023-03-28', '144', '1', 'en cours', 83563, 15876.97, 99439.97, 0, 'NB : Hors main d\'oeuvre', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-28 11:33:44', '2023-04-03 13:14:54', 'TND'),
(94, 'DEV20230066', NULL, '2023-03-29', '51', '1', 'en cours', 350, 66.5, 416.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-29 09:29:21', '2023-03-29 09:32:21', 'TND'),
(95, 'DEV20230067', NULL, '2023-03-29', '1', '1', 'en cours', 585, 40.95, 625.95, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-29 11:55:06', '2023-03-29 11:59:19', 'TND'),
(96, 'DEV20230068', NULL, '2023-03-30', '142', '1', 'converti_facture', 182, 24.74, 206.74, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-30 08:25:02', '2023-04-06 07:40:33', 'TND'),
(97, 'DEV20230069', NULL, '2023-03-30', '7', '1', 'converti_facture', 1020, 68.005, 1039.505, 48.5, 'Remise de 10% sur le deuxième article.', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-03-30 11:30:45', '2023-03-31 10:21:18', 'TND'),
(99, 'DEV20230070', NULL, '2023-04-03', '146', '1', 'en cours', 6214, 1180.66, 7394.66, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-03 09:05:44', '2023-04-03 11:55:19', 'TND'),
(100, 'DEV20230071', NULL, '2023-04-03', '147', '1', 'converti_facture', 4600, 874, 5474, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-03 12:15:31', '2023-04-27 13:50:37', 'TND'),
(101, 'DEV20230072', NULL, '2023-04-04', '5', '1', 'en cours', 3520, 246.4, 3766.4, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-04 10:35:00', '2023-04-06 07:46:04', 'TND'),
(102, 'DEV20230073', NULL, '2023-04-04', '7', '1', 'en cours', 4650, 325.5, 4975.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-04 12:53:06', '2023-04-04 12:54:52', 'TND'),
(103, 'DEV20230074', NULL, '2023-04-05', '5', '1', 'en cours', 3060, 581.4, 3641.4, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-05 11:31:43', '2023-04-05 11:37:55', 'TND'),
(104, 'DEV20230075', NULL, '2023-04-06', '148', '1', 'en cours', 1465, 278.35, 1743.35, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-06 09:04:14', '2023-04-06 10:33:10', 'TND'),
(105, 'DEV20230076', NULL, '2023-04-06', '101', '1', 'converti_facture', 4520, 316.4, 4836.4, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-06 11:49:52', '2023-04-13 08:46:11', 'TND'),
(106, 'DEV20230077', NULL, '2023-04-07', '149', '1', 'en cours', 4200, 798, 4998, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-07 08:01:45', '2023-04-07 08:11:47', 'TND'),
(107, 'DEV20230078', NULL, '2023-04-07', '5', '1', 'converti_facture', 2290, 160.3, 2450.3, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-07 09:28:41', '2023-04-11 12:03:34', 'TND'),
(108, 'DEV20230079', NULL, '2023-04-10', '150', '1', 'converti_facture', 720, 50.4, 770.4, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-10 12:15:50', '2023-04-14 08:55:48', 'TND'),
(109, 'DEV20230080', NULL, '2023-04-12', '147', '1', 'converti_facture', 455, 86.45, 541.45, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-12 12:00:01', '2023-04-27 13:49:19', 'TND'),
(110, 'DEV20230081', NULL, '2023-04-13', '151', '1', 'en cours', 2350, 446.5, 2796.5, 0, 'Mode de paiement 50 % a l\'avance 50% a la livraison', 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-13 07:23:27', '2023-04-13 07:30:42', 'TND'),
(111, 'DEV20230082', NULL, '2023-04-13', '101', '1', 'en cours', 150, 28.5, 178.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-13 08:52:35', '2023-04-13 08:59:02', 'TND'),
(112, 'DEV20230083', NULL, '2023-04-13', '7', '1', 'converti_facture', 2970, 207.9, 3177.9, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-13 10:54:30', '2023-04-19 13:34:54', 'TND'),
(113, 'DEV20230084', NULL, '2023-03-07', '152', '1', 'en cours', 39000, 7410, 46410, 0, 'Société : Strategis LAB\nBanque : Union Internationale de Banque (UIB) - Groupe Société Générale\nIBAN : TN59 12 208 00 0005100 2142 64\nBIC : UIBKTNTT', 'Strategis LAB\n- Colisee Soula, Esc B 5 ème Etage, 2092 El Manar II, Tunis Tunisie\n-Tél : +33 09 70 46 85 14 Tel:+216 71 872 243- Fax: +216 71 872 404 -\nemail: contact@strategislab.com - www.strategislab.com', '2023-04-13 11:44:08', '2023-04-13 11:46:58', 'TND'),
(114, 'DEV20230085', NULL, '2023-04-14', '7', '1', 'en cours', 2850, 199.5, 3049.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-14 11:11:30', '2023-04-14 11:22:18', 'TND'),
(115, 'DEV20230086', NULL, '2023-04-26', '1', '1', 'converti_facture', 780, 54.6, 834.6, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-26 09:40:27', '2023-05-02 08:04:35', 'TND'),
(116, 'DEV20230087', NULL, '2023-04-26', '94', '1', 'converti_facture', 640, 44.8, 684.8, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-26 13:15:32', '2023-04-26 15:15:35', 'TND'),
(117, 'DEV20230088', NULL, '2023-04-26', '109', '1', 'converti_facture', 2670, 186.9, 2856.9, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-26 14:17:23', '2023-04-27 12:29:06', 'TND'),
(118, 'DEV20230089', NULL, '2023-04-27', '36', '1', 'en cours', 295, 56.05, 351.05, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-27 15:27:23', '2023-04-27 15:53:18', 'TND'),
(119, 'DEV20230090', 'import', '2023-04-28', '153', '1', 'en cours', 4070, 773.3, 4843.3, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-28 14:49:39', '2023-04-28 14:50:38', 'TND'),
(120, 'DEV20230091', 'import', '2023-04-28', '153', '1', 'converti_facture', 3820, 725.8, 4545.8, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-04-28 14:51:42', '2023-05-05 07:51:51', 'TND'),
(121, 'DEV20230092', NULL, '2023-05-02', '111', '1', 'en cours', 22950, 4360.5, 27310.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-02 12:24:52', '2023-05-02 12:50:05', 'TND'),
(122, 'DEV20230093', NULL, '2023-05-02', '16', '1', 'converti_facture', 575, 109.25, 684.25, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-02 15:27:21', '2023-05-10 12:07:51', 'TND'),
(123, 'DEV20230094', NULL, '2023-05-03', '5', '1', 'en cours', 2150, 408.5, 2558.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-03 15:25:07', '2023-05-03 15:26:59', 'TND'),
(126, 'DEV20230095', NULL, '2023-05-05', '10', '1', 'en cours', 250, 17.5, 267.5, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-05 12:26:59', '2023-05-05 12:27:38', 'TND'),
(127, 'DEV20230096', NULL, '2023-05-05', '155', '1', 'en cours', 10660, 2025.4, 12685.4, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-05 13:23:08', '2023-05-05 13:30:12', 'TND'),
(128, 'DEV20230097', NULL, '2023-05-05', '156', '1', 'en cours', 8385, 1593.15, 9978.15, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-05 13:29:28', '2023-05-05 13:36:18', 'TND'),
(129, 'DEV20230098', NULL, '2023-05-08', '157', '1', 'en cours', 5990, 419.3, 6409.3, 0, NULL, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-08 12:34:22', '2023-05-08 12:36:41', 'TND'),
(130, 'DEV20230099', NULL, '2023-05-08', '158', '1', 'en cours', 3600, 684, 4284, 0, NULL, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-08 14:15:45', '2023-05-08 14:25:50', 'TND'),
(131, 'DEV20230100', NULL, '2023-05-08', '159', '1', 'en cours', 5075, 916.038, 5737.288, 253.75, 'Note: Hors service d\'installation et configuration', 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-08 14:29:28', '2023-05-10 10:30:08', 'TND'),
(132, 'DEV20230101', NULL, '2023-05-08', '160', '1', 'en cours', 3800, 685.9, 4295.9, 190, 'Note: Hors service d\'installation et configuration', 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-08 14:32:14', '2023-05-10 10:30:41', 'TND'),
(133, 'DEV20230102', NULL, '2023-05-08', '161', '1', 'en cours', 5840, 1109.6, 6949.6, 0, NULL, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-05-08 15:49:22', '2023-05-10 10:19:47', 'TND'),
(134, 'DEV20230103', NULL, '2023-05-12', '71', '1', 'en cours', 0, 0, 0, 0, NULL, NULL, '2023-05-12 12:53:38', '2023-05-12 12:53:38', 'TND');

-- --------------------------------------------------------

--
-- Structure de la table `devises`
--

CREATE TABLE `devises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbole` varchar(255) NOT NULL,
  `grande_unite` varchar(255) NOT NULL,
  `petite_unite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devises`
--

INSERT INTO `devises` (`id`, `nom`, `code`, `symbole`, `grande_unite`, `petite_unite`, `created_at`, `updated_at`) VALUES
(1, 'Dinar Tunisien', 'TND', 'TND', 'Dinares', 'Millimes', '2023-03-08 13:41:38', '2023-03-08 13:41:38'),
(2, 'Euro', 'EUR', '€', 'Euros', 'Centimes', '2023-03-08 13:43:13', '2023-03-08 13:43:13'),
(3, 'US Dollar', 'USD', '$', 'Dollars', 'Pennys', '2023-03-08 13:44:02', '2023-03-08 13:44:52');

-- --------------------------------------------------------

--
-- Structure de la table `elementgroupes`
--

CREATE TABLE `elementgroupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ordre` varchar(255) NOT NULL,
  `groupe_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `elementgroupes`
--

INSERT INTO `elementgroupes` (`id`, `nom`, `ordre`, `groupe_id`, `created_at`, `updated_at`) VALUES
(169, 'NUMBER', '1', '6', '2023-01-27 09:52:07', '2023-01-27 09:52:07'),
(193, 'NUMBER', '1', '3', '2023-01-27 11:26:13', '2023-01-27 11:26:13'),
(225, 'NUMBER', '1', '7', '2023-02-10 09:57:51', '2023-02-10 09:57:51'),
(270, 'NUMBER', '1', '8', '2023-03-07 10:32:02', '2023-03-07 10:32:02'),
(285, 'YEAR', '1', '11', '2023-03-10 08:44:31', '2023-03-10 08:44:31'),
(286, 'NUMBER', '2', '11', '2023-03-10 08:44:31', '2023-03-10 08:44:31'),
(289, 'YEAR', '1', '5', '2023-03-13 13:34:18', '2023-03-13 13:34:18'),
(290, 'NUMBER', '2', '5', '2023-03-13 13:34:18', '2023-03-13 13:34:18'),
(291, 'YEAR', '1', '9', '2023-03-13 13:34:29', '2023-03-13 13:34:29'),
(292, 'NUMBER', '2', '9', '2023-03-13 13:34:29', '2023-03-13 13:34:29'),
(301, 'YEAR', '1', '10', '2023-03-17 15:42:47', '2023-03-17 15:42:47'),
(302, 'NUMBER', '2', '10', '2023-03-17 15:42:47', '2023-03-17 15:42:47'),
(303, 'YEAR', '1', '4', '2023-03-28 10:30:44', '2023-03-28 10:30:44'),
(304, 'NUMBER', '2', '4', '2023-03-28 10:30:44', '2023-03-28 10:30:44'),
(323, 'YEAR', '1', '1', '2023-05-04 15:39:20', '2023-05-04 15:39:20'),
(324, 'NUMBER', '2', '1', '2023-05-04 15:39:20', '2023-05-04 15:39:20'),
(337, 'YEAR', '1', '2', '2023-05-10 09:18:55', '2023-05-10 09:18:55'),
(338, 'NUMBER', '2', '2', '2023-05-10 09:18:55', '2023-05-10 09:18:55');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mf` varchar(255) NOT NULL,
  `rne` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `timbre` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `condition` longtext DEFAULT NULL,
  `footer` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `mf`, `rne`, `adresse`, `telephone`, `email`, `web`, `timbre`, `photo`, `condition`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'Next consult', '1634268JAM000', '1634268JAM000', '9 Rue Sidi Abdeljalil B1 ,Tunis , Tunisia', '71343076', 'contact@next.tn', 'www.next.tn', NULL, 'LOGO NEXT blue-01.png', NULL, 'www.next.tn;\r\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '2023-01-04 08:29:17', '2023-05-08 14:02:15');

-- --------------------------------------------------------

--
-- Structure de la table `facturecontrats`
--

CREATE TABLE `facturecontrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `date_paiement` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `facture_ht` double NOT NULL DEFAULT 0,
  `facture_tva` double NOT NULL DEFAULT 0,
  `facture_debour` double NOT NULL DEFAULT 0,
  `facture_remise` double NOT NULL DEFAULT 0,
  `facture_paye` double NOT NULL DEFAULT 0,
  `facture_solde` double NOT NULL DEFAULT 0,
  `facture_ttc` double NOT NULL DEFAULT 0,
  `timbre` double NOT NULL DEFAULT 1,
  `footer` varchar(255) DEFAULT NULL,
  `contrat_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `devise` varchar(10) DEFAULT 'TND'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facturecontrats`
--

INSERT INTO `facturecontrats` (`id`, `date`, `date_paiement`, `status`, `facture_ht`, `facture_tva`, `facture_debour`, `facture_remise`, `facture_paye`, `facture_solde`, `facture_ttc`, `timbre`, `footer`, `contrat_id`, `created_at`, `updated_at`, `devise`) VALUES
(11, NULL, NULL, NULL, 750, 142.5, 0, 0, 0, 0, 893.5, 1, NULL, '11', '2023-03-16 10:15:14', '2023-03-16 10:15:14', 'TND'),
(12, NULL, NULL, NULL, 700, 133, 0, 0, 0, 0, 834, 1, NULL, '12', '2023-03-22 15:22:14', '2023-03-22 15:22:14', 'TND'),
(13, NULL, NULL, NULL, 200, 38, 0, 0, 0, 0, 239, 1, NULL, '13', '2023-03-24 10:05:38', '2023-03-24 10:06:53', 'TND'),
(14, NULL, NULL, NULL, 500, 95, 0, 0, 0, 0, 596, 1, NULL, '14', '2023-03-24 10:08:35', '2023-03-24 10:08:35', 'TND'),
(15, NULL, NULL, NULL, 250, 47.5, 0, 0, 0, 0, 298.5, 1, NULL, '15', '2023-03-27 08:00:45', '2023-03-27 08:00:45', 'TND'),
(16, NULL, NULL, NULL, 1600, 304, 0, 0, 0, 0, 1905, 1, NULL, '16', '2023-03-27 08:16:45', '2023-03-27 08:16:45', 'TND'),
(17, NULL, NULL, NULL, 900, 171, 0, 0, 0, 0, 1072, 1, NULL, '17', '2023-03-27 08:19:07', '2023-03-27 08:19:07', 'TND'),
(18, NULL, NULL, NULL, 1500, 285, 0, 0, 0, 0, 1786, 1, NULL, '18', '2023-03-27 08:23:38', '2023-03-27 08:23:38', 'TND'),
(19, NULL, NULL, NULL, 1700, 323, 0, 0, 0, 0, 2024, 1, NULL, '19', '2023-03-27 08:25:23', '2023-03-27 08:25:23', 'TND'),
(20, NULL, NULL, NULL, 350, 0, 0, 0, 0, 0, 351, 1, NULL, '20', '2023-03-27 08:27:52', '2023-03-27 08:27:52', 'TND'),
(21, NULL, NULL, NULL, 1600, 304, 0, 0, 0, 0, 1905, 1, NULL, '21', '2023-03-27 08:30:02', '2023-03-28 09:57:06', 'TND');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `date_paiement` varchar(255) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `entreprise_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `retenu` double NOT NULL DEFAULT 0,
  `facture_retenu` double NOT NULL DEFAULT 1,
  `facture_ht` double NOT NULL DEFAULT 0,
  `facture_tva` double NOT NULL DEFAULT 0,
  `facture_debour` double NOT NULL DEFAULT 0,
  `facture_remise` double NOT NULL DEFAULT 0,
  `facture_paye` double NOT NULL DEFAULT 0,
  `facture_solde` double NOT NULL DEFAULT 0,
  `facture_ttc` double NOT NULL DEFAULT 0,
  `timbre` double NOT NULL DEFAULT 1,
  `footer` varchar(255) DEFAULT NULL,
  `devis_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `fournisseur_id` varchar(255) DEFAULT NULL,
  `devise` varchar(255) DEFAULT 'TND'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `numero`, `date`, `date_paiement`, `client_id`, `entreprise_id`, `status`, `retenu`, `facture_retenu`, `facture_ht`, `facture_tva`, `facture_debour`, `facture_remise`, `facture_paye`, `facture_solde`, `facture_ttc`, `timbre`, `footer`, `devis_id`, `created_at`, `updated_at`, `type`, `fournisseur_id`, `devise`) VALUES
(11, 'FA20230002', '2023-01-23', '2023-01-23', '54', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 08:18:43', '2023-03-07 07:06:50', 'client', NULL, 'TND'),
(12, 'FA20230003', '2023-01-23', '2023-01-23', '89', '1', 'paye', 0, 0, 500, 95, 0, 0, 596, 0, 596, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 08:27:41', '2023-02-03 15:44:34', 'client', NULL, 'TND'),
(13, 'FA20230004', '2023-01-23', '2023-01-23', '89', '1', 'en cours', 0, 0, 1895, 132.65, 0, 0, 0, 2028.65, 2028.65, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 08:42:20', '2023-01-30 09:22:42', 'client', NULL, 'TND'),
(14, 'FA20230005', '2023-01-23', '2023-01-23', '79', '1', 'paye', 0, 0, 10976.42, 2085.52, 0, 0, 13062.941, 0, 13062.941, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '14', '2023-01-23 09:41:04', '2023-02-14 07:22:09', 'client', NULL, 'TND'),
(15, 'FA20230006', '2023-01-23', '2023-01-23', '1', '1', 'en cours', 0, 0, 2350, 164.5, 0, 0, 0, 2515.5, 2515.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '24', '2023-01-23 09:57:24', '2023-01-30 09:24:35', 'client', NULL, 'TND'),
(16, 'FA20230007', '2023-01-23', '2023-01-23', '7', '1', 'paye', 0, 0, 400, 76, 0, 0, 477, 0, 477, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 10:26:35', '2023-02-13 16:00:08', 'client', NULL, 'TND'),
(17, 'FA20230008', '2023-01-23', '2023-01-23', '1', '1', 'paye', 0, 0, 200, 38, 0, 0, 239, 0, 239, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 10:32:50', '2023-03-10 12:34:45', 'client', NULL, 'TND'),
(18, 'FA20230009', '2023-01-23', '2023-01-23', '39', '1', 'en cours', 0, 0, 300, 57, 0, 0, 0, 358, 358, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-23 11:09:42', '2023-01-23 11:10:47', 'client', NULL, 'TND'),
(19, 'FA20230010', '2023-01-24', '2023-01-24', '10', '1', 'paye', 0, 0, 250, 47.5, 0, 0, 298.5, 0, 298.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-24 09:09:56', '2023-02-20 09:42:43', 'client', NULL, 'TND'),
(20, 'FA20230011', '2023-01-24', '2023-01-24', '10', '1', 'paye', 0, 0, 2160, 410.4, 0, 0, 2571.4, 0, 2571.4, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-24 09:13:55', '2023-02-14 07:21:40', 'client', NULL, 'TND'),
(21, 'FA20230012', '2023-01-24', '2023-01-24', '109', '1', 'paye', 0, 0, 350, 36.5, 0, 0, 387.5, 0, 387.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-24 13:39:38', '2023-02-03 15:44:05', 'client', NULL, 'TND'),
(22, 'FA20230013', '2023-01-26', '2023-01-26', '2', '1', 'paye', 0, 0, 900, 171, 0, 0, 1072, 0, 1072, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 07:03:49', '2023-02-03 15:43:47', 'client', NULL, 'TND'),
(24, 'FA20230015', '2023-01-26', '2023-01-26', '96', '1', 'paye', 0, 0, 1500, 285, 0, 0, 1786, 0, 1786, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 07:11:47', '2023-02-14 15:54:45', 'client', NULL, 'TND'),
(26, 'FA20230017', '2023-01-26', '2023-01-26', '5', '1', 'paye', 0, 0, 1700, 323, 0, 0, 2024, 0, 2024, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 09:54:32', '2023-02-03 10:30:24', 'client', NULL, 'TND'),
(27, 'FA20230018', '2023-01-26', '2023-01-26', '3', '1', 'paye', 0, 0, 600, 102, 0, 0, 703, 0, 703, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 09:59:29', '2023-03-23 07:00:55', 'client', NULL, 'TND'),
(31, 'FA20230022', '2023-01-26', '2023-01-26', '36', '1', 'paye', 0, 0, 350, 66.5, 0, 0, 417.5, 0, 417.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 13:02:32', '2023-02-16 10:15:09', 'client', NULL, 'TND'),
(32, 'FA20230023', '2023-01-26', '2023-01-26', '50', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-26 14:17:56', '2023-02-03 10:28:21', 'client', NULL, 'TND'),
(39, 'FA20230016', '2023-01-27', '2023-01-27', '50', '1', 'paye', 0, 0, 500, 59, 0, 0, 560, 0, 560, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-27 15:04:58', '2023-03-15 09:35:34', 'client', NULL, 'TND'),
(43, 'FA20230019', '2023-01-30', '2023-01-30', '89', '1', 'paye', 0, 0, 260, 49.4, 0, 0, 310.4, 0, 310.4, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-01-30 13:05:21', '2023-02-16 10:05:30', 'client', NULL, 'TND'),
(44, 'DEP20230001', '2023-02-07', '2023-02-07', NULL, '1', 'en cours', 0, 0, 1550, 294.5, 0, 0, 0, 1845.5, 1845.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-07 08:15:17', '2023-02-07 08:19:06', 'fournisseur', '11', 'TND'),
(45, 'FA20230001', '2023-02-07', '2023-02-07', '5', '1', 'paye', 0, 0, 5940, 415.8, 0, 0, 6356.8, 0, 6356.8, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '32', '2023-02-07 09:30:21', '2023-02-16 10:06:16', 'client', NULL, 'TND'),
(46, 'FA20230024', '2023-02-09', '2023-02-09', '36', '1', 'paye', 0, 0, 984, 0, 0, 0, 985, 0, 985, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '36', '2023-02-09 14:48:52', '2023-02-16 10:14:58', 'client', NULL, 'TND'),
(48, 'DEP20230003', '2023-02-10', '2023-02-10', NULL, '1', 'en cours', 0, 0, 1390, 97.3, 0, 0, 0, 1488.3, 1488.3, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-10 15:30:27', '2023-02-10 15:36:09', 'fournisseur', '12', 'TND'),
(49, 'DEP20230004', '2023-02-13', '2023-02-13', NULL, '1', 'en cours', 0, 0, 2036, 386.84, 0, 0, 0, 2423.84, 2423.84, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-13 08:23:26', '2023-02-13 08:26:46', 'fournisseur', '13', 'TND'),
(50, 'DEP20230005', '2023-02-13', '2023-02-13', NULL, '1', 'en cours', 0, 0, 1749, 332.31, 0, 0, 0, 2082.31, 2082.31, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-13 08:28:42', '2023-02-13 08:40:14', 'fournisseur', '12', 'TND'),
(51, 'DEP20230006', '2023-02-13', '2023-02-13', NULL, '1', 'en cours', 0, 0, 3360, 235.2, 0, 0, 0, 3596.2, 3596.2, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-13 08:59:32', '2023-02-13 09:07:02', 'fournisseur', '12', 'TND'),
(52, 'FA20230025', '2023-02-13', '2023-02-13', '79', '1', 'paye', 0, 0, 1928, 366.32, 0, 0, 2295.32, 0, 2295.32, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '35', '2023-02-13 12:52:35', '2023-03-02 16:09:05', 'client', NULL, 'TND'),
(53, 'FA20230020', '2023-02-13', '2023-02-13', '36', '1', 'paye', 0, 0, 350, 0, 0, 0, 351, 0, 351, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-13 15:46:36', '2023-05-09 07:51:08', 'client', NULL, 'TND'),
(55, 'FA20230026', '2023-02-16', '2023-02-16', '54', '1', 'paye', 0, 0, 1260, 239.4, 0, 0, 1500.4, 0, 1500.4, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-16 10:16:53', '2023-03-09 14:50:14', 'client', NULL, 'TND'),
(56, 'FA20230027', '2023-02-22', '2023-02-22', '2', '1', 'paye', 0, 0, 900, 171, 0, 0, 1072, 0, 1072, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 10:45:19', '2023-03-07 07:06:29', 'client', NULL, 'TND'),
(57, 'FA20230028', '2023-02-22', '2023-02-22', '3', '1', 'paye', 0, 0, 3915, 274.05, 0, 0, 4190.05, 0, 4190.05, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '41', '2023-02-22 10:54:04', '2023-03-02 16:24:36', 'client', NULL, 'TND'),
(58, 'FA20230029', '2023-02-22', '2023-02-22', '3', '1', 'paye', 0, 0, 500, 95, 0, 0, 596, 0, 596, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 12:26:14', '2023-03-02 16:25:21', 'client', NULL, 'TND'),
(59, 'FA20230030', '2023-02-22', '2023-02-22', '7', '1', 'paye', 0, 0, 1156, 219.64, 0, 0, 1376.64, 0, 1376.64, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 12:35:49', '2023-05-10 09:24:11', 'client', NULL, 'TND'),
(60, 'FA20230031', '2023-02-22', '2023-02-22', '7', '1', 'paye', 0, 0, 400, 76, 0, 0, 477, 0, 477, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 13:39:03', '2023-03-15 07:20:30', 'client', NULL, 'TND'),
(61, 'FA20230032', '2023-02-22', '2023-02-22', '1', '1', 'en cours', 0, 0, 200, 38, 0, 0, 0, 239, 239, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 14:53:01', '2023-02-22 14:56:13', 'client', NULL, 'TND'),
(62, 'FA20230033', '2023-02-22', '2023-02-22', '56', '1', 'paye', 0, 0, 285, 54.15, 0, 0, 340.15, 0, 340.15, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-22 15:02:25', '2023-03-24 11:52:14', 'client', NULL, 'TND'),
(63, 'FA20230034', '2023-02-23', '2023-02-23', '26', '1', 'paye_partielle', 0, 0, 10715.9, 1009.421, 0, 0, 5804.534, 5921.787, 11726.321, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '37', '2023-02-23 07:37:16', '2023-04-11 08:06:58', 'client', NULL, 'TND'),
(64, 'FA20230035', '2023-02-23', '2023-02-23', '54', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-23 13:09:49', '2023-03-09 14:49:58', 'client', NULL, 'TND'),
(68, 'FA20230036', '2023-02-24', '2023-02-24', '5', '1', 'paye', 0, 0, 1700, 323, 0, 0, 2024, 0, 2024, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-24 15:52:56', '2023-03-09 13:30:43', 'client', NULL, 'TND'),
(69, 'FA20230037', '2023-02-24', '2023-02-24', '89', '1', 'paye', 0, 0, 500, 95, 0, 0, 596, 0, 596, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-24 15:56:44', '2023-03-17 07:44:29', 'client', NULL, 'TND'),
(70, 'FA20230038', '2023-02-24', '2023-02-24', '50', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-24 16:03:45', '2023-03-02 16:05:03', 'client', NULL, 'TND'),
(71, 'FA20230039', '2023-02-24', '2023-02-24', '96', '1', 'paye', 0, 0, 1500, 285, 0, 0, 1786, 0, 1786, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-24 16:05:29', '2023-03-09 10:39:20', 'client', NULL, 'TND'),
(72, 'FA20230040', '2023-02-27', '2023-02-27', '10', '1', 'paye', 0, 0, 250, 47.5, 0, 0, 298.5, 0, 298.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-02-27 06:59:04', '2023-03-07 07:05:43', 'client', NULL, 'TND'),
(74, 'FA20230041', '2023-03-03', '2023-03-03', '36', '1', 'paye', 0, 0, 875, 0, 0, 0, 876, 0, 876, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '62', '2023-03-03 11:43:45', '2023-04-19 07:24:45', 'client', NULL, 'TND'),
(75, 'FA20230042', '2023-03-03', '2023-03-03', '109', '1', 'paye', 0, 0, 2381, 452.39, 0, 0, 2834.39, 0, 2834.39, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '61', '2023-03-03 15:35:49', '2023-03-23 06:56:29', 'client', NULL, 'TND'),
(77, 'FA20230014', '2023-03-07', '2023-03-07', '34', '1', 'en cours', 0, 0, 1984.3, 138.901, 0, 0, 0, 2124.201, 2124.201, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-07 08:17:50', '2023-03-23 07:05:55', 'client', NULL, 'TND'),
(78, 'DEP20230008', '2023-03-07', '2023-03-07', NULL, '1', 'valide', 0, 0, 779, 54.53, 0, 0, 0, 834.53, 834.53, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-07 09:11:20', '2023-03-27 07:09:34', 'fournisseur', '19', 'TND'),
(86, 'FA20230043', '2023-03-08', '2023-03-08', '100', '1', 'paye', 0, 0, 272, 0, 0, 0, 273, 0, 273, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-08 09:19:19', '2023-03-09 15:54:00', 'client', NULL, 'TND'),
(87, 'FA20230044', '2023-03-09', '2023-03-09', '5', '1', 'paye', 0, 0, 2614, 239.98, 0, 0, 2854.98, 0, 2854.98, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '66', '2023-03-09 07:50:51', '2023-03-10 07:35:47', 'client', NULL, 'TND'),
(90, 'FA20230045', '2023-03-13', '2023-03-13', '89', '1', 'paye', 0, 0, 345, 65.55, 0, 0, 411.55, 0, 411.55, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-13 13:53:41', '2023-03-23 10:55:36', 'client', NULL, 'TND'),
(91, 'FA20230046', '2023-03-17', '2023-03-17', '139', '1', 'paye', 0, 0, 1840, 349.6, 0, 0, 2189.6, 0, 2189.6, 0, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-15 13:07:12', '2023-05-09 15:38:52', 'client', NULL, 'TND'),
(93, 'DEP20230002', '2023-03-17', '2023-03-17', NULL, '1', 'en cours', 0, 0, 360, 25.2, 0, 0, 0, 386.2, 386.2, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-17 09:58:34', '2023-03-31 11:39:04', 'fournisseur', '14', 'TND'),
(94, 'FA20230047', '2023-03-21', '2023-03-21', '50', '1', 'paye', 0, 0, 813, 88.47, 0, 0, 902.47, 0, 902.47, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-21 12:40:11', '2023-03-22 14:51:24', 'client', NULL, 'TND'),
(95, 'FA20230048', '2023-03-22', '2023-03-22', '7', '1', 'paye', 0, 0, 750, 142.5, 0, 0, 893.5, 0, 893.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-22 07:07:33', '2023-04-11 07:35:29', 'client', NULL, 'TND'),
(96, 'FA20230049', '2023-03-22', '2023-03-22', '36', '1', 'paye', 0, 0, 1353.75, 0, 0, 0, 1354.75, 0, 1354.75, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-22 09:14:42', '2023-03-31 07:07:00', 'client', NULL, 'TND'),
(97, 'FA20230050', '2023-03-22', '2023-03-22', '142', '1', 'paye', 0, 0, 400, 58, 0, 0, 459, 0, 459, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-22 14:34:17', '2023-03-30 12:21:28', 'client', NULL, 'TND'),
(98, 'FA20230051', '2023-03-22', '2023-03-22', '89', '1', 'paye', 0, 0, 182.5, 13.315, 0, 0, 196.815, 0, 196.815, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-22 15:15:22', '2023-04-17 07:42:59', 'client', NULL, 'TND'),
(99, 'FA20230052', '2023-03-22', '2023-03-22', '89', '1', 'paye', 0, 0, 700, 133, 0, 0, 834, 0, 834, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-22 15:22:16', '2023-04-17 07:42:42', 'client', NULL, 'TND'),
(100, 'FA20230053', '2023-03-23', '2023-03-23', '124', '1', 'paye_partielle', 0, 0, 1650, 313.5, 0, 0, 1000, 964.5, 1964.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-23 10:07:33', '2023-03-27 12:40:29', 'client', NULL, 'TND'),
(101, 'FA20230054', '2023-03-23', '2023-03-23', '7', '1', 'paye', 0, 0, 4408.5, 345.015, 0, 0, 4754.515, 0, 4754.515, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '76', '2023-03-23 12:08:28', '2023-05-09 15:00:44', 'client', NULL, 'TND'),
(102, 'FA20230055', '2023-03-23', '2023-03-23', '121', '1', 'en cours', 0, 0, 5600, 1064, 0, 0, 0, 6665, 6665, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '25', '2023-03-23 12:11:43', '2023-04-27 10:47:17', 'client', NULL, 'TND'),
(103, 'FA20230056', '2023-03-24', '2023-03-24', '1', '1', 'en cours', 0, 0, 200, 38, 0, 0, 0, 239, 239, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-24 10:05:39', '2023-03-27 11:20:21', 'client', NULL, 'TND'),
(104, 'FA20230057', '2023-03-24', '2023-03-24', '3', '1', 'paye', 0, 0, 500, 95, 0, 0, 596, 0, 596, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-24 10:08:36', '2023-03-29 07:06:51', 'client', NULL, 'TND'),
(105, 'FA20230058', '2023-03-22', '2023-03-27', '10', '1', 'paye', 0, 0, 250, 47.5, 0, 0, 298.5, 0, 298.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:01:12', '2023-03-29 07:07:10', 'client', NULL, 'TND'),
(106, 'FA20230059', '2023-03-27', '2023-03-27', '4', '1', 'paye', 0, 0, 600, 114, 0, 0, 715, 0, 715, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:08:53', '2023-04-11 07:24:28', 'client', NULL, 'TND'),
(107, 'FA20230060', '2023-03-27', '2023-03-27', '50', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:17:10', '2023-05-10 09:43:28', 'client', NULL, 'TND'),
(108, 'FA20230061', '2023-03-27', '2023-03-27', '2', '1', 'paye', 0, 0, 900, 171, 0, 0, 1072, 0, 1072, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:50:32', '2023-05-03 12:35:03', 'client', NULL, 'TND'),
(109, 'FA20230062', '2023-03-27', '2023-03-27', '96', '1', 'paye', 0, 0, 1500, 285, 0, 0, 1786, 0, 1786, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:56:43', '2023-04-19 07:23:58', 'client', NULL, 'TND'),
(110, 'FA20230063', '2023-03-27', '2023-03-27', '5', '1', 'paye', 0, 0, 1700, 323, 0, 0, 2024, 0, 2024, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 08:57:30', '2023-04-11 07:35:09', 'client', NULL, 'TND'),
(112, 'FA20230065', '2023-03-27', '2023-03-27', '54', '1', 'paye', 0, 0, 1600, 304, 0, 0, 1905, 0, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-27 09:00:51', '2023-04-11 07:20:09', 'client', NULL, 'TND'),
(113, 'DEP20230007', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 19.8, 3.762, 0, 0, 0, 24.562, 24.562, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:08:17', '2023-03-28 10:15:45', 'fournisseur', '19', 'TND'),
(114, 'DEP20230009', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 3240, 226.8, 0, 0, 0, 3467.8, 3467.8, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:31:03', '2023-03-28 10:34:19', 'fournisseur', '20', 'TND'),
(115, 'DEP20230010', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 15.8, 3.002, 0, 0, 0, 19.802, 19.802, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:35:20', '2023-03-28 10:36:51', 'fournisseur', '19', 'TND'),
(116, 'DEP20230011', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 3999, 279.93, 0, 0, 0, 4279.93, 4279.93, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:39:06', '2023-03-28 10:45:21', 'fournisseur', '12', 'TND'),
(117, 'DEP20230012', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 3999, 279.93, 0, 0, 0, 4279.93, 4279.93, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:45:55', '2023-03-28 10:56:17', 'fournisseur', '12', 'TND'),
(118, 'DEP20230013', '2023-03-28', '2023-03-28', NULL, '1', 'en cours', 0, 0, 849, 161.31, 0, 0, 0, 1011.31, 1011.31, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 10:56:39', '2023-03-28 11:03:46', 'fournisseur', '12', 'TND'),
(119, 'FA20230066', '2023-03-28', '2023-03-28', '72', '1', 'paye', 0, 0, 2400, 456, 0, 0, 2857, 0, 2857, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 11:41:01', '2023-04-11 07:21:50', 'client', NULL, 'TND'),
(120, 'FA20230067', '2023-03-28', '2023-03-28', '2', '1', 'paye', 0, 0, 450, 31.5, 0, 0, 482.5, 0, 482.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-28 12:46:21', '2023-05-03 12:35:17', 'client', NULL, 'TND'),
(121, 'FA20230068', '2023-03-29', '2023-03-29', '3', '1', 'paye', 0, 0, 150, 10.5, 0, 0, 161.5, 0, 161.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-29 11:16:24', '2023-05-08 08:29:01', 'client', NULL, 'TND'),
(122, 'FA20230069', '2023-03-29', '2023-03-29', '50', '1', 'paye', 0, 0, 1148, 218.12, 0, 0, 1367.12, 0, 1367.12, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '90', '2023-03-29 11:18:03', '2023-05-10 09:44:16', 'client', NULL, 'TND'),
(123, 'FA20230070', '2023-03-29', '2023-03-29', '96', '1', 'en cours', 0, 0, 400, 76, 0, 0, 0, 477, 477, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-29 11:18:37', '2023-03-29 11:19:47', 'client', NULL, 'TND'),
(125, 'FA20230072', '2023-03-29', '2023-03-29', '100', '1', 'en cours', 0, 0, 272, 0, 0, 0, 0, 273, 273, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-29 11:23:33', '2023-03-29 11:25:52', 'client', NULL, '€'),
(126, 'FA20230071', '2023-03-29', '2023-03-29', '100', '1', 'en cours', 0, 0, 530, 0, 0, 0, 0, 531, 531, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-29 11:52:20', '2023-03-29 11:59:17', 'client', NULL, '€'),
(127, 'FA20230073', '2023-03-30', '2023-03-30', '50', '1', 'paye', 0, 0, 300, 57, 0, 0, 358, 0, 358, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-30 08:10:38', '2023-05-10 09:44:40', 'client', NULL, 'TND'),
(128, 'FA20230074', '2023-03-30', '2023-03-30', '1', '1', 'en cours', 0, 0, 1070, 133.1, 0, 0, 0, 1204.1, 1204.1, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-30 08:15:57', '2023-03-30 08:17:10', 'client', NULL, 'TND'),
(129, 'FA20230075', '2023-03-31', '2023-03-31', '26', '1', 'paye', 0, 0, 440, 53.6, 0, 0, 494.6, 0, 494.6, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '88', '2023-03-31 09:23:45', '2023-04-13 07:34:31', 'client', NULL, 'TND'),
(130, 'FA20230076', '2023-03-31', '2023-03-31', '7', '1', 'en cours', 0, 0, 1070, 67.41, 0, 107, 0, 1031.41, 1031.41, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '97', '2023-03-31 10:21:18', '2023-03-31 10:45:20', 'client', NULL, 'TND'),
(131, 'DEP20230014', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 3405, 238.35, 0, 0, 0, 3644.35, 3644.35, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 10:32:40', '2023-03-31 11:04:12', 'fournisseur', '12', 'TND'),
(132, 'DEP20230015', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 231.9, 16.233, 0, 0, 0, 249.133, 249.133, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 11:04:45', '2023-03-31 11:12:15', 'fournisseur', '14', 'TND'),
(133, 'DEP20230016', '2023-02-10', '2023-03-31', NULL, '1', 'en cours', 0, 0, 891.859, 169.453, 0, 0, 0, 1062.312, 1062.312, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 11:15:34', '2023-03-31 11:25:03', 'fournisseur', '21', 'TND'),
(134, 'DEP20230017', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 10, 1.9, 0, 0, 0, 12.9, 12.9, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 11:30:00', '2023-03-31 11:31:23', 'fournisseur', '22', 'TND'),
(135, 'DEP20230018', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 295.45, 20.682, 0, 0, 0, 317.132, 317.132, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 11:55:12', '2023-03-31 11:59:40', 'fournisseur', '14', 'TND'),
(136, 'DEP20230019', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 1880, 131.6, 0, 0, 0, 2012.6, 2012.6, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:00:22', '2023-03-31 12:04:46', 'fournisseur', '13', 'TND'),
(137, 'DEP20230020', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 1200, 228, 0, 0, 0, 1429, 1429, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:11:39', '2023-03-31 12:12:37', 'fournisseur', '23', 'TND'),
(138, 'DEP20230021', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 650.5, 45.535, 0, 0, 0, 697.035, 697.035, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:13:28', '2023-03-31 12:14:38', 'fournisseur', '22', 'TND'),
(139, 'DEP20230022', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 1390, 97.3, 0, 0, 0, 1488.3, 1488.3, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:24:34', '2023-03-31 12:39:41', 'fournisseur', '12', 'TND'),
(140, 'DEP20230023', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 3461, 242.27, 0, 0, 0, 3704.27, 3704.27, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:40:30', '2023-03-31 12:47:56', 'fournisseur', '12', 'TND'),
(141, 'DEP20230024', '2023-03-31', '2023-03-31', NULL, '1', 'en cours', 0, 0, 527, 100.13, 0, 0, 0, 628.13, 628.13, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-03-31 12:57:22', '2023-03-31 13:06:02', 'fournisseur', '16', 'TND'),
(142, 'DEP20230025', '2023-04-03', '2023-04-03', NULL, '1', 'en cours', 0, 0, 151.26, 28.739, 0, 0, 0, 180.999, 180.999, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 10:15:08', '2023-04-03 10:23:41', 'fournisseur', '24', 'TND'),
(143, 'DEP20230026', '2023-04-03', '2023-04-03', NULL, '1', 'en cours', 0, 0, 3230, 226.1, 0, 0, 0, 3457.1, 3457.1, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 11:57:57', '2023-04-03 12:02:18', 'fournisseur', '20', 'TND'),
(144, 'DEP20230027', '2023-04-03', '2023-04-03', NULL, '1', 'en cours', 0, 0, 11.668, 2.217, 0, 0, 0, 14.885, 14.885, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 12:06:31', '2023-04-03 12:08:10', 'fournisseur', '15', 'TND'),
(145, 'DEP20230028', '2023-04-03', '2023-04-03', NULL, '1', 'en cours', 0, 0, 1093.261, 207.72, 0, 0, 0, 1301.981, 1301.981, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 12:10:21', '2023-04-03 12:17:03', 'fournisseur', '15', 'TND'),
(146, 'DEP20230029', '2023-01-02', '2023-04-03', NULL, '1', 'en cours', 0, 0, 708, 134.52, 0, 0, 0, 843.52, 843.52, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 12:18:36', '2023-04-03 12:59:56', 'fournisseur', '13', 'TND'),
(147, 'DEP20230030', '2023-01-04', '2023-04-03', NULL, '1', 'en cours', 0, 0, 282.45, 34.882, 0, 98.857, 0, 219.475, 219.475, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-03 13:03:17', '2023-04-03 13:06:04', 'fournisseur', '25', 'TND'),
(148, 'DEP20230031', '2023-01-20', '2023-04-04', NULL, '1', 'en cours', 0, 0, 3360, 235.2, 0, 0, 0, 3596.2, 3596.2, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 07:54:56', '2023-04-04 07:59:17', 'fournisseur', '12', 'TND'),
(149, 'DEP20230032', '2023-02-10', '2023-04-04', NULL, '1', 'en cours', 0, 0, 1749, 332.31, 0, 0, 0, 2082.31, 2082.31, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 08:24:32', '2023-04-04 08:27:11', 'fournisseur', '12', 'TND'),
(150, 'DEP20230033', '2023-01-19', '2023-04-04', NULL, '1', 'en cours', 0, 0, 2036, 386.84, 0, 0, 0, 2423.84, 2423.84, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 08:30:57', '2023-04-04 11:14:42', 'fournisseur', '13', 'TND'),
(151, 'DEP20230034', '2023-01-20', '2023-04-04', NULL, '1', 'en cours', 0, 0, 79, 5.53, 0, 0, 0, 85.53, 85.53, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 11:17:46', '2023-04-04 11:18:49', 'fournisseur', '14', 'TND'),
(152, 'DEP20230035', '2023-04-04', '2023-04-04', NULL, '1', 'en cours', 0, 0, 159000, 30210, 0, 0, 0, 189211, 189211, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 11:25:44', '2023-04-04 11:27:09', 'fournisseur', '26', 'TND'),
(153, 'DEP20230036', '2023-02-02', '2023-04-04', NULL, '1', 'en cours', 0, 0, 173.7, 12.159, 0, 0, 0, 186.859, 186.859, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 11:27:23', '2023-04-04 11:30:10', 'fournisseur', '14', 'TND'),
(154, 'DEP20230037', '2023-02-28', '2023-04-04', NULL, '1', 'en cours', 0, 0, 1050, 73.5, 0, 0, 0, 1124.5, 1124.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-04 12:08:19', '2023-04-04 12:40:16', 'fournisseur', '14', 'TND'),
(155, 'DEP20230038', '2023-04-05', '2023-04-05', NULL, '1', 'en cours', 0, 0, 1660, 116.2, 0, 0, 0, 1777.2, 1777.2, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-05 10:43:17', '2023-04-14 11:00:08', 'fournisseur', '12', 'TND'),
(156, 'FA20230077', '2023-04-05', '2023-04-05', '4', '1', 'paye', 0, 0, 78.8, 14.972, 0, 0, 94.772, 0, 94.772, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-05 11:15:20', '2023-04-11 07:20:35', 'client', NULL, 'TND'),
(157, 'FA20230078', '2023-04-05', '2023-04-05', '84', '1', 'paye', 0, 0, 108.8, 20.672, 0, 0, 130.472, 0, 130.472, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-05 12:16:59', '2023-04-19 07:22:13', 'client', NULL, 'TND'),
(158, 'FA20230079', '2023-04-06', '2023-04-06', '142', '1', 'paye', 0, 0, 182, 24.74, 0, 0, 207.74, 0, 207.74, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '96', '2023-04-06 07:40:33', '2023-04-11 07:16:38', 'client', NULL, 'TND'),
(159, 'FA20230080', '2023-04-06', '2023-04-06', '3', '1', 'en cours', 0, 0, 950, 180.5, 0, 0, 0, 1131.5, 1131.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '86', '2023-04-06 08:07:04', '2023-04-27 10:41:09', 'client', NULL, 'TND'),
(160, 'FA20230081', '2023-04-06', '2023-04-06', '51', '1', 'en cours', 0, 0, 78.8, 14.972, 0, 0, 0, 94.772, 94.772, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-06 11:07:19', '2023-04-06 11:09:25', 'client', NULL, 'TND'),
(161, 'FA20230082', '2023-04-06', '2023-04-06', '94', '1', 'en cours', 0, 0, 100.8, 19.152, 0, 0, 0, 120.952, 120.952, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-06 11:11:36', '2023-04-06 11:15:18', 'client', NULL, 'TND'),
(162, 'FA20230083', '2023-04-06', '2023-04-06', '111', '1', 'en cours', 0, 0, 14, 2.66, 0, 0, 0, 17.66, 17.66, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-06 11:23:06', '2023-04-06 11:23:37', 'client', NULL, 'TND'),
(163, 'FA20230084', '2023-04-11', '2023-04-11', '34', '1', 'en cours', 0, 0, 148, 28.12, 0, 0, 0, 177.12, 177.12, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-11 08:10:30', '2023-04-11 08:12:23', 'client', NULL, 'TND'),
(164, 'FA20230085', '2023-04-11', '2023-04-11', '5', '1', 'paye', 0, 0, 2290, 160.3, 0, 0, 2451.3, 0, 2451.3, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '107', '2023-04-11 12:03:34', '2023-05-09 17:24:22', 'client', NULL, 'TND'),
(165, 'FA20230086', '2023-04-12', '2023-04-12', '36', '1', 'en cours', 0, 0, 3896.25, 0, 0, 0, 0, 3897.25, 3897.25, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '87', '2023-04-12 08:22:39', '2023-04-27 10:40:36', 'client', NULL, 'TND'),
(166, 'FA20230087', '2023-04-12', '2023-04-12', '84', '1', 'paye', 0, 0, 350, 66.5, 0, 0, 417.5, 0, 417.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-12 09:07:44', '2023-04-19 07:21:37', 'client', NULL, 'TND'),
(168, 'FA20230089', '2023-04-13', '2023-04-13', '96', '1', 'paye_partielle', 0, 0, 11000, 2090, 0, 0, 3000, 10091, 13091, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '59', '2023-04-13 07:37:37', '2023-04-13 07:38:02', 'client', NULL, 'TND'),
(169, 'FA20230090', '2023-04-13', '2023-04-13', '101', '1', 'en cours', 0, 0, 2080, 163.6, 0, 0, 0, 2244.6, 2244.6, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '105', '2023-04-13 08:46:11', '2023-04-13 11:46:36', 'client', NULL, 'TND'),
(171, 'DEP20230039', '2023-04-14', '2023-04-14', NULL, '1', 'en cours', 0, 0, 779, 54.53, 0, 0, 0, 834.53, 834.53, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-14 07:59:28', '2023-04-14 08:04:14', 'fournisseur', '19', 'TND'),
(172, 'FA20230091', '2023-04-14', '2023-04-14', '150', '1', 'paye', 0, 0, 720, 50.4, 0, 0, 771.4, 0, 771.4, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '108', '2023-04-14 08:55:48', '2023-04-19 07:21:00', 'client', NULL, 'TND'),
(173, 'DEP20230040', '2023-04-14', '2023-04-14', NULL, '1', 'en cours', 0, 0, 845, 59.15, 0, 0, 0, 905.15, 905.15, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-14 09:21:30', '2023-04-14 09:24:51', 'fournisseur', '12', 'TND'),
(174, 'DEP20230041', '2023-04-14', '2023-04-14', NULL, '1', 'en cours', 0, 0, 1747.059, 331.941, 0, 0, 0, 2080, 2080, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-14 09:39:57', '2023-04-14 09:41:42', 'fournisseur', '27', 'TND'),
(175, 'FA20230092', '2023-04-14', '2023-04-14', '5', '1', 'paye', 0, 0, 1700, 323, 0, 0, 2024, 0, 2024, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-14 10:10:50', '2023-04-19 11:29:54', 'client', NULL, 'TND'),
(176, 'FA20230093', '2023-04-14', '2023-04-14', '84', '1', 'paye_partielle', 0, 0, 1800, 342, 0, 0, 1000, 1143, 2143, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '75', '2023-04-14 12:41:44', '2023-04-14 12:43:27', 'client', NULL, 'TND'),
(177, 'FA20230094', '2023-04-14', '2023-04-14', '50', '1', 'paye', 0, 0, 1350, 256.5, 0, 0, 1607.5, 0, 1607.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-14 13:01:55', '2023-05-10 09:44:56', 'client', NULL, 'TND'),
(178, 'DEP20230042', '2023-04-17', '2023-04-17', NULL, '1', 'en cours', 0, 0, 29.7, 5.643, 0, 0, 0, 36.343, 36.343, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-17 09:31:58', '2023-04-17 11:17:02', 'fournisseur', '19', 'TND'),
(179, 'FA20230095', '2023-04-19', '2023-04-19', '7', '1', 'en cours', 0, 0, 2310, 161.7, 0, 0, 0, 2472.7, 2472.7, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '112', '2023-04-19 13:34:54', '2023-04-25 08:21:34', 'client', NULL, 'TND'),
(182, 'FA20230098', '2023-04-24', '2023-04-24', '1', '1', 'paye', 0, 0, 200, 38, 0, 0, 239, 0, 239, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:07:52', '2023-05-09 08:58:58', 'client', NULL, 'TND'),
(183, 'FA20230099', '2023-04-24', '2023-04-24', '3', '1', 'paye', 0, 0, 500, 95, 0, 0, 596, 0, 596, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:07:52', '2023-05-08 08:29:19', 'client', NULL, 'TND'),
(184, 'FA20230100', '2023-04-24', '2023-04-24', '7', '1', 'en cours', 0, 0, 750, 142.5, 0, 0, 0, 893.5, 893.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:26', '2023-04-24 08:33:26', 'client', NULL, 'TND'),
(185, 'FA20230101', '2023-04-24', '2023-04-24', '89', '1', 'en cours', 0, 0, 700, 133, 0, 0, 0, 834, 834, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:26', '2023-04-24 08:33:26', 'client', NULL, 'TND'),
(186, 'FA20230102', '2023-04-24', '2023-04-24', '10', '1', 'paye', 0, 0, 250, 47.5, 0, 0, 298.5, 0, 298.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-05-08 08:26:14', 'client', NULL, 'TND'),
(187, 'FA20230103', '2023-04-24', '2023-04-24', '50', '1', 'en cours', 0, 0, 1600, 304, 0, 0, 0, 1905, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-04-24 08:33:27', 'client', NULL, 'TND'),
(188, 'FA20230104', '2023-04-24', '2023-04-24', '2', '1', 'paye', 0, 0, 900, 171, 0, 0, 1072, 0, 1072, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-05-03 12:35:40', 'client', NULL, 'TND'),
(189, 'FA20230105', '2023-04-24', '2023-04-24', '96', '1', 'en cours', 0, 0, 1500, 285, 0, 0, 0, 1786, 1786, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-04-24 08:33:27', 'client', NULL, 'TND'),
(191, 'FA20230107', '2023-04-24', '2023-04-24', '36', '1', 'paye', 0, 0, 350, 0, 0, 0, 351, 0, 351, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-05-09 07:49:17', 'client', NULL, 'TND'),
(192, 'FA20230108', '2023-04-24', '2023-04-24', '54', '1', 'en cours', 0, 0, 1600, 304, 0, 0, 0, 1905, 1905, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 08:33:27', '2023-04-24 08:33:27', 'client', NULL, 'TND'),
(193, 'FA20230109', '2023-04-24', '2023-04-24', '47', '1', 'paye', 0, 0, 2250, 427.5, 0, 0, 2678.5, 0, 2678.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-24 16:29:27', '2023-05-05 07:25:12', 'client', NULL, 'TND'),
(195, 'FA20230110', '2023-04-26', '2023-04-26', '94', '1', 'en cours', 0, 0, 640, 44.8, 0, 0, 0, 685.8, 685.8, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '116', '2023-04-26 15:15:35', '2023-04-26 15:15:35', 'client', NULL, 'TND'),
(196, 'FA20230111', '2023-03-01', '2023-04-27', '153', '1', 'en cours', 0, 0, 2500, 475, 0, 0, 0, 2976, 2976, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-27 10:28:53', '2023-04-27 10:31:58', 'client', NULL, 'TND'),
(197, 'FA20230112', '2023-04-03', '2023-04-27', '153', '1', 'en cours', 0, 0, 2500, 475, 0, 0, 0, 2976, 2976, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-27 10:33:15', '2023-04-27 10:34:22', 'client', NULL, 'TND'),
(198, 'FA20230113', '2023-04-27', '2023-04-27', '109', '1', 'en cours', 0, 0, 2680, 187.6, 0, 0, 0, 2868.6, 2868.6, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '117', '2023-04-27 12:29:06', '2023-04-27 16:19:03', 'client', NULL, 'TND'),
(199, 'FA20230114', '2023-04-29', '2023-04-27', '147', '1', 'en cours', 0, 0, 455, 86.45, 0, 0, 0, 542.45, 542.45, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '109', '2023-04-27 13:49:19', '2023-04-27 13:50:00', 'client', NULL, 'TND'),
(200, 'FA20230115', '2023-04-29', '2023-04-27', '147', '1', 'en cours', 0, 0, 4600, 874, 0, 0, 0, 5475, 5475, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '100', '2023-04-27 13:50:37', '2023-04-27 13:50:49', 'client', NULL, 'TND'),
(201, 'DEP20230043', '2023-04-27', '2023-04-27', NULL, '1', 'en cours', 0, 0, 212, 40.28, 0, 0, 0, 253.28, 253.28, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-27 14:57:31', '2023-04-27 14:58:52', 'fournisseur', '14', 'TND'),
(202, 'DEP20230044', '2023-04-27', '2023-04-27', NULL, '1', 'en cours', 0, 0, 6865, 480.55, 0, 0, 0, 7346.55, 7346.55, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-27 14:59:34', '2023-04-28 10:41:58', 'fournisseur', '12', 'TND'),
(203, 'DEP20230045', '2023-04-28', '2023-04-28', NULL, '1', 'en cours', 0, 0, 650, 45.5, 0, 0, 0, 696.5, 696.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 11:53:42', '2023-04-28 12:03:25', 'fournisseur', '22', 'TND'),
(204, 'DEP20230046', '2023-04-28', '2023-04-28', NULL, '1', 'en cours', 0, 0, 88.785, 6.215, 0, 0, 0, 96, 96, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 12:03:46', '2023-04-28 12:04:39', 'fournisseur', '22', 'TND'),
(205, 'DEP20230047', '2023-04-28', '2023-04-28', NULL, '1', 'en cours', 0, 0, 560, 39.2, 0, 0, 0, 600.2, 600.2, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 12:05:01', '2023-04-28 12:06:01', 'fournisseur', '22', 'TND'),
(206, 'DEP20230048', '2023-04-28', '2023-04-28', NULL, '1', 'en cours', 0, 0, 2250, 427.5, 0, 0, 0, 2678.5, 2678.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 12:10:09', '2023-04-28 12:12:48', 'fournisseur', '28', 'TND'),
(207, 'DEP20230049', '2023-04-28', '2023-04-28', NULL, '1', 'en cours', 0, 0, 2250, 427.5, 0, 0, 0, 2678.5, 2678.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 12:13:00', '2023-04-28 12:14:23', 'fournisseur', '28', 'TND'),
(208, 'DEP20230050', '2023-04-23', '2023-04-28', NULL, '1', 'en cours', 0, 0, 467.387, 88.804, 0, 0, 0, 557.191, 557.191, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-04-28 12:14:55', '2023-05-02 13:58:14', 'fournisseur', '19', 'TND'),
(218, 'FA20230096', '2023-05-02', '2023-05-02', '36', '1', 'paye', 0, 0, 358, 0, 0, 0, 359, 0, 359, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-02 07:46:56', '2023-05-09 07:50:17', 'client', NULL, 'TND'),
(219, 'FA20230097', '2023-05-02', '2023-05-02', '1', '1', 'paye', 0, 0, 780, 54.6, 0, 0, 835.6, 0, 835.6, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '115', '2023-05-02 08:04:35', '2023-05-09 08:58:47', 'client', NULL, 'TND'),
(249, 'DEP20230051', '2023-05-03', '2023-05-03', NULL, '1', 'en cours', 0, 0, 1200, 84, 0, 0, 0, 1285, 1285, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-03 07:22:12', '2023-05-03 07:25:01', 'fournisseur', '12', 'TND'),
(250, 'DEP20230052', '2023-05-03', '2023-05-03', NULL, '1', 'en cours', 0, 0, 18.487, 3.513, 0, 0, 0, 23, 23, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-03 07:26:47', '2023-05-03 07:28:38', 'fournisseur', '22', 'TND'),
(251, 'DEP20230053', '2023-05-03', '2023-05-03', NULL, '1', 'en cours', 0, 0, 295, 56.05, 0, 0, 0, 352.05, 352.05, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-03 07:35:16', '2023-05-03 07:36:50', 'fournisseur', '30', 'TND'),
(252, 'FA20230116', '2023-05-03', '2023-05-03', '16', '1', 'en cours', 0, 0, 1690, 161.5, 0, 0, 0, 1852.5, 1852.5, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-03 10:22:46', '2023-05-03 10:37:55', 'client', NULL, 'TND'),
(254, 'FA20230118', '2023-05-05', '2023-05-05', '153', '1', 'en cours', 0, 0, 3820, 725.8, 0, 0, 0, 4546.8, 4546.8, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '120', '2023-05-05 07:51:51', '2023-05-05 07:51:51', 'client', NULL, 'TND'),
(255, 'FA20230119', '2023-05-08', '2023-05-08', '101', '1', 'en cours', 0, 0, 425, 80.75, 0, 0, 0, 506.75, 506.75, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-08 10:54:54', '2023-05-08 12:05:30', 'client', NULL, 'TND'),
(256, 'FA20230106', '2023-04-24', '2023-05-08', '47', '1', 'en cours', 0, 0, 1125, 213.75, 0, 0, 0, 1339.75, 1339.75, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-08 12:29:22', '2023-05-08 12:33:46', 'client', NULL, 'TND'),
(257, 'FA20230120', '2023-05-08', '2023-05-08', '5', '1', 'en cours', 0, 0, 125, 23.75, 0, 0, 0, 149.75, 149.75, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-08 13:16:27', '2023-05-08 13:17:31', 'client', NULL, 'TND'),
(259, 'DEP20230054', '2023-05-09', '2023-05-09', NULL, '1', 'en cours', 0, 0, 650, 45.5, 0, 0, 0, 696.5, 696.5, 1, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-09 14:47:58', '2023-05-09 14:51:35', 'fournisseur', '14', 'TND'),
(260, 'FA20230064', '2023-03-27', '2023-05-09', '5', '1', 'paye_partielle', 0, 0, 8300, 1577, 0, 0, 4000, 5878, 9878, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '65', '2023-05-09 17:30:15', '2023-05-09 17:31:04', 'client', NULL, 'TND'),
(261, 'FA20230117', '2023-05-04', '2023-05-09', '5', '1', 'en cours', 0, 0, 2250, 427.5, 0, 0, 0, 2678.5, 2678.5, 1, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-09 17:32:17', '2023-05-09 17:34:09', 'client', NULL, 'TND'),
(262, 'FA20230021', '2023-01-25', '2023-05-10', '34', '1', 'en cours', 0, 0, 7.5, 0.525, 0, 0, 0, 9.025, 9.025, 1, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-10 09:16:00', '2023-05-10 09:18:18', 'client', NULL, 'TND'),
(263, 'FA20230121', '2023-05-10', '2023-05-10', '16', '1', 'en cours', 0, 0, 575, 109.25, 0, 0, 0, 685.25, 685.25, 1, 'SARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', '122', '2023-05-10 12:07:51', '2023-05-10 12:07:51', 'client', NULL, 'TND'),
(264, 'FA20230122', '2023-05-10', '2023-05-10', '4', '1', 'en cours', 0, 0, 1469, 102.83, 0, 0, 0, 1572.83, 1572.83, 1, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-10 12:31:11', '2023-05-10 12:39:24', 'client', NULL, 'TND'),
(265, 'FA20230123', '2023-05-11', '2023-05-11', '162', '1', 'en cours', 0, 0, 500, 95, 0, 0, 0, 596, 596, 1, 'www.next.tn;\nSARL ; BIAT: TN59 0800 8000 6710 0226 3083 ; MF: 1634268JAM000', NULL, '2023-05-11 09:17:11', '2023-05-11 09:19:16', 'client', NULL, 'TND');

-- --------------------------------------------------------

--
-- Structure de la table `factures_ordres`
--

CREATE TABLE `factures_ordres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facture_id` varchar(255) NOT NULL,
  `ordre_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `chauffeur_id` varchar(255) DEFAULT NULL,
  `camion_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `file`, `client_id`, `chauffeur_id`, `camion_id`, `created_at`, `updated_at`) VALUES
(1, 'sage.png.png', '1', NULL, NULL, '2023-01-04 08:16:29', '2023-01-04 08:16:29'),
(2, 'Facture-19320.pdf.pdf', '2', NULL, NULL, '2023-01-04 09:24:50', '2023-01-04 09:24:50'),
(3, 'RNE BTK LEASING 05 01 2023.pdf.pdf', '119', NULL, NULL, '2023-01-12 14:12:14', '2023-01-12 14:12:14');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `mf` varchar(255) DEFAULT NULL,
  `adresse` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `numero`, `nom`, `email`, `telephone`, `code_postal`, `mf`, `adresse`, `created_at`, `updated_at`) VALUES
(11, 'FR0001', 'Systec Technology', 'systecs2014@gmail.com', '31520990', '1000', '1346122K/B/M/000', '16 Avenue Habib Bourguiba  1000 Tunis', '2023-02-07 08:15:01', '2023-02-09 08:09:40'),
(12, 'FR0002', 'CODIS', 'codis@codis.com.tn', '71961900', '2035', '0633266V', '19, rue de l\'energie solaire charguia 1', '2023-02-10 09:49:31', '2023-02-10 09:49:31'),
(13, 'FR0003', 'SMART', 'smart@smart.com.tn', '71115600', '2035', '544435X', '9 bis , impasse N°3 rue 8612 , ZI charguia 1 tunis', '2023-02-10 10:05:28', '2023-02-10 10:05:28'),
(14, 'FR0004', 'WINTEK', 'commercial@wintek.com.tn', '71906438', '2035', '1252675X', 'rue de l\'energie solaire IMP N°02 ZI Charguia 1 tunis', '2023-02-10 12:10:55', '2023-02-10 12:10:55'),
(15, 'FR0005', 'Attijari Leasing', 's.belkaid@gnet.tn', '71817026', '2001', '496311P', '1 rue medinat el katif 2001 cité Ennar II', '2023-02-10 12:27:37', '2023-02-10 12:27:37'),
(16, 'FR0006', 'NOUVELLE TECHNOLOGIE', 'kais.nouvelletechnologie@gmail.com', '52054723', '2023', '155326B', '9 rue 9069 jebel jelloud', '2023-02-10 12:30:52', '2023-02-10 12:30:52'),
(17, 'FR0007', 'STE, DAR IBN KHALDOUN', 'contact@next.tn', '71338147', '1008', '381035E', '25 Rue beguira , sidi bechir tunis', '2023-02-10 12:58:29', '2023-02-10 12:58:29'),
(18, 'FR0008', 'jalel cherni', 'techniquejalel@gmail.com', '26972249', '1008', '1179936J', '09, rue sidi abdeljail , sidi el bechir , tunis', '2023-02-10 13:29:07', '2023-02-10 13:29:07'),
(19, 'FR0009', 'MYTEK', 'contact@mytek.tn', '36010010', '2035', '1184751K/BE/002', '58 RUE DE L4INDUSTRIE CHARGUIA 1 TUNIS', '2023-03-07 09:07:42', '2023-03-07 09:07:42'),
(20, 'FR0010', 'Southcomp Distribution', 'S.Saadoun@southcomp-polaris.com', '71960438', '1053', '958967W', 'Immeuble Cristal Palace - Bureau 2.B.2/2.B.3 - 1053 Les Berges du Lac . Tunis', '2023-03-28 10:20:30', '2023-03-28 10:27:33'),
(21, 'FR0011', 'Equipement Voitures Européennes \"EVE\"', 'o.toujani@next.tn', '71353222', '4638', '32963W', '35. Rue Khaireddine Barba Rousse , Tunis', '2023-03-31 11:15:12', '2023-03-31 11:15:12'),
(22, 'FR0012', 'MBM  PROTECTION', 'mbm.info@gnet.tn', '71663187', '2000', '1602355G', '10 rue ahmed tlili , bardo', '2023-03-31 11:29:45', '2023-03-31 11:29:45'),
(23, 'FR0013', 'COMPAGNIE TUNISIENNE D\'ELECTRONIQUE', 'mag.charguia@elathir.com', '71907199', '1073', '388L/A/M/000', '27 , AVENUE KHEREDDINE PACHA 1073 MONTPLAISIR TUNIS', '2023-03-31 12:11:26', '2023-03-31 12:11:26'),
(24, 'FR0014', 'Ets Habib AROUA \"EHA\"', 'contact@eha.tn', '98468673', '1073', '510353M/A/C/000', 'Imm safsaf - mag 14 - montplaisir', '2023-04-03 09:56:57', '2023-04-03 09:56:57'),
(25, 'FR0015', 'STE ESPACE ELECTRIQUE', 'contact@see.tn', '98109460', '1001', '514244/A/A/M/000', '57 RUE OM KHALTHOUM', '2023-04-03 13:02:56', '2023-04-03 13:02:56'),
(26, 'FR0016', 'CARDTECH', 'commercial@digital-cardtech.net', '22475498', '1001', '913716J/B/C/000', '4 rue chaaben el bhouri 1001 tunis', '2023-04-04 11:25:17', '2023-04-04 11:25:17'),
(27, 'FR0017', 'TUNISIE TELECOM', 'actel.virtuelle@ttnet.tn', '71139700', '1053', '425665X', 'Tunisie Telecom, Jardins du Lac II, 1053, Tunis, Tunisie', '2023-04-14 09:39:33', '2023-04-14 09:39:33'),
(28, 'FR0018', 'GIC', 'contact@gic.tn', '70698375', '2073', '1196794L', 'RSD Ryhana Bloc H APP H23 CP 2073 la soukra ariana tunisie', '2023-04-28 12:09:58', '2023-04-28 12:09:58'),
(29, 'FR0019', 'ESET', 'moez.r@eset-nod32.fr', '71 752 506', NULL, NULL, 'Tunis', '2023-05-02 15:44:15', '2023-05-02 15:44:15'),
(30, 'FR0020', 'CTI NETWORK', 'commercial@cti-network.com', '71701110', '2080', '1068492K/A/M/000', '7, rue André Ampère , Cité Administrative Ariana - Tunisie', '2023-05-03 07:34:28', '2023-05-03 07:34:28');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE `frais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `facture_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `nb_prochain` varchar(255) NOT NULL,
  `nb_left` varchar(255) NOT NULL,
  `renist` varchar(255) NOT NULL,
  `date_increment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom`, `format`, `nb_prochain`, `nb_left`, `renist`, `date_increment`, `created_at`, `updated_at`) VALUES
(1, 'devis', 'DEV', '104', '4', 'year', NULL, '2023-01-26 13:15:48', '2023-05-12 12:53:38'),
(2, 'facture', 'FA', '124', '4', 'year', '2023-01-26', '2023-01-26 14:37:51', '2023-05-11 09:17:11'),
(3, 'intervention', 'INTERV', '1', '4', 'year', NULL, '2023-01-26 15:27:49', '2023-01-27 11:26:13'),
(4, 'depense', 'DEP', '56', '4', 'year', NULL, '2023-01-27 07:09:45', '2023-05-09 14:47:58'),
(5, 'client', 'CLT', '152', '4', 'year', NULL, '2023-01-27 07:55:25', '2023-05-11 09:15:03'),
(6, 'produit', 'PROD', '1', '4', 'year', NULL, '2023-01-27 08:32:42', '2023-01-27 09:52:07'),
(7, 'fournisseur', 'FR', '21', '4', 'year', NULL, '2023-01-27 08:44:03', '2023-05-03 07:34:28'),
(8, 'contact-crm', 'CON', '293', '4', 'year', NULL, '2023-02-24 13:02:15', '2023-04-13 13:13:00'),
(9, 'bonlivraison', 'BL', '6', '4', 'year', NULL, '2023-03-07 10:27:32', '2023-05-05 07:52:08'),
(10, 'contrat', 'CN', '12', '4', 'year', NULL, '2023-03-07 10:27:58', '2023-03-27 08:30:02'),
(11, 'boncommande', 'BN', '6', '4', 'year', NULL, '2023-03-09 08:22:17', '2023-05-02 15:44:15');

-- --------------------------------------------------------

--
-- Structure de la table `interventions`
--

CREATE TABLE `interventions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `entreprise_id` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `intervenant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `itembonlivraisons`
--

CREATE TABLE `itembonlivraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `bonlivraison_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itembonlivraisons`
--

INSERT INTO `itembonlivraisons` (`id`, `produit`, `description`, `quantites`, `bonlivraison_id`, `created_at`, `updated_at`) VALUES
(1, 'RJ45 , PRISES RJ45 , 8 BOITES , MOLURE 25 , MOLURE 16*16', 'CABLE RESEAUX RJ45 (600ml) \n8 Prises RJ45 \n8 Boites apparent \nMolure 25 (60m)\nmolure 16*16 (20ml)', '5', '3', '2023-03-15 13:03:56', '2023-03-15 13:03:56'),
(2, 'CAM-HD', 'CAM-HD', '5', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(3, 'DVR-8CH', 'DVR-8CH', '1', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(4, 'DISQUE DUR', 'DISQUE DUR', '1', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(5, 'CABLE', 'CABLE', '1', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(7, 'CAB-CAM-400', 'CABLE CAM 400M', '400', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(8, 'TUBE GRIS-400', 'TUBE GRIS 400M', '400', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(9, 'M-O', 'Main d\'Oeuvre', '1', '4', '2023-04-25 10:37:52', '2023-04-25 10:58:36'),
(10, 'TV-32-VEGA', 'TV 32  POUCE VEGA', '1', '5', '2023-04-25 10:57:31', '2023-04-25 10:57:40'),
(11, 'PC-LENOVO', 'Pc Lenovo Intel Core i5-1135G7 (2.40 GHz up to 4,20 GHz Turbo max, 8 Mo de mémoire cache, Quad-Core) - Système d\'exploitation: FreeDos - Mémoire RAM: 12 Go DDR4-3200 - Disque Dur: 512 Go SSD, 1TB HDD - Carte Graphique: Integrated avec WiFi, Bluetooth,1xUSB 2.0, 1x USB 3.2 Gen 1, 1x USB-C 3.2 Gen 1, 1x HDMI 1.4b, 1x prise combinée casque/microphone (3,5 mm) et lecteur de carte .', '1', '6', '2023-04-27 12:18:14', '2023-04-27 12:18:24'),
(12, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Haut-parleurs, Inclinable/Ajustable en hauteur/Pivotable)', '1', '6', '2023-04-27 12:18:14', '2023-04-27 12:18:24'),
(13, 'CS', 'Clavier et Souris', '1', '6', '2023-04-27 12:18:14', '2023-04-27 12:18:24'),
(14, 'WINDOWS-VM ', 'License Windows Server STD 16 Core 2019 Open 2 machine VM', '1', '7', '2023-05-05 07:52:08', '2023-05-05 07:52:08');

-- --------------------------------------------------------

--
-- Structure de la table `itemdevis`
--

CREATE TABLE `itemdevis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `prix_ht` varchar(255) NOT NULL,
  `tva` varchar(255) NOT NULL,
  `type_remise` varchar(255) DEFAULT NULL,
  `type_tva` varchar(255) DEFAULT NULL,
  `remise` varchar(255) DEFAULT NULL,
  `total_ht` varchar(255) NOT NULL,
  `total_remise` varchar(255) NOT NULL,
  `total_tva` varchar(255) NOT NULL,
  `total_ttc` varchar(255) NOT NULL,
  `devis_id` varchar(255) NOT NULL,
  `catalogue_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itemdevis`
--

INSERT INTO `itemdevis` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `devis_id`, `catalogue_id`, `created_at`, `updated_at`) VALUES
(10, 'SRV--HP', 'Serveur Hp DL380 Gen10     2nd Generation, 2 X Silver 4210R ( 10 core, 2.4 GHz ),13.75 Mo,64GB (4 X 32GB 2Rx4 PC4-2933V-R Smart Kit),Sans Lecteur,HPE 1Gb 4-port Ethernet Adapter ,8-SFF HDD Bays Hot Plug SAS,Broadcom MegaRAID MR416i-p 4GB, 4 X HPE 2.4TB SAS 12G10K SFF BC HDD, 8 X SFF, 2 x 800W Power Supply Kit (Gen10), 4-standard fans, Rack 2U', '1', '24340.500', '7', 'pourcentage', NULL, '0', '24340.500', '0.000', '1703.835', '26044.335', '13', NULL, '2023-01-06 16:25:36', '2023-01-16 10:02:37'),
(11, 'SWITCHEUR-48GB', 'Switch 48 Ports Gigabyte Administrable ', '1', '1885', '19', 'pourcentage', NULL, '0', '1885.000', '0.000', '358.150', '2243.150', '13', NULL, '2023-01-06 16:25:36', '2023-01-16 10:02:37'),
(14, 'LICENCE-WINDOWS', 'Windows Server Standard 2016 64Bit ', '1', '2475', '19', 'pourcentage', NULL, '0', '2475.000', '0.000', '470.250', '2945.250', '13', NULL, '2023-01-09 11:46:25', '2023-01-16 10:02:37'),
(25, 'CABLEFTP6A', 'Cable FTP Cat 6A ', '500', '2.600', '19', 'pourcentage', NULL, '0', '1300.000', '0.000', '247.000', '1547.000', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(26, 'PRISE-RJ45', 'Prise RJ45 apparente', '8', '17.650', '19', 'pourcentage', NULL, '0', '141.200', '0.000', '26.828', '168.028', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(27, 'PRISE-APPARANT', 'prise courant apparente', '7', '17.720', '19', 'pourcentage', NULL, '0', '124.040', '0.000', '23.568', '147.608', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(28, 'MOULURE', 'Moulure 40x40mm', '37', '10.420', '19', 'pourcentage', NULL, '0', '385.540', '0.000', '73.253', '458.793', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(29, 'MOULURE', 'Moulure 25x19mm', '20', '5.470', '19', 'pourcentage', NULL, '0', '109.400', '0.000', '20.786', '130.186', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(30, 'CABLE-HDMI', 'Cable HDMI 30M', '1', '120', '19', 'pourcentage', NULL, '0', '120.000', '0.000', '22.800', '142.800', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(31, 'CABLE-3-5', 'Cable 3de5', '90', '5.775', '19', 'pourcentage', NULL, '0', '519.750', '0.000', '98.752', '618.503', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(32, 'CHEVILLE', 'Cheville ', '400', '0.120', '19', 'pourcentage', NULL, '0', '48.000', '0.000', '9.120', '57.120', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(33, 'VISES', 'Vises', '400', '0.090', '19', 'pourcentage', NULL, '0', '36.000', '0.000', '6.840', '42.840', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(34, 'SERRE-CABLE', 'Serre Cable', '2', '11.500', '19', 'pourcentage', NULL, '0', '23.000', '0.000', '4.370', '27.370', '14', NULL, '2023-01-09 16:28:54', '2023-01-23 08:14:18'),
(35, 'PC-LENOVO', 'TB 15-ITL,i3-1115G4,12GB Base DDR4,256GB SSD M.2 2242 NVMe,Integrated,No OS,15.6\" FHD TN,720p HD Cam,Wi-fi AX 2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C 3PIN-EU,KB French', '1', '1539', '7', 'pourcentage', NULL, '0', '1539.000', '0.000', '107.730', '1646.730', '15', NULL, '2023-01-10 15:43:05', '2023-01-10 15:43:05'),
(36, 'BOUCHE-CABLE', 'Bouche Cable ', '45', '1.270', '19', 'pourcentage', NULL, '0', '57.150', '0.000', '10.858', '68.008', '14', NULL, '2023-01-11 13:03:36', '2023-01-23 08:14:18'),
(109, 'PANBRAS', 'Panneau de brassage 24 ports équipé ', '1', '292', '19', 'pourcentage', NULL, '0', '292.000', '0.000', '55.480', '347.480', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(110, 'PriseRJ45', 'Prise Réseau CAT6 ', '18', '32.650', '19', 'pourcentage', NULL, '0', '587.700', '0.000', '111.663', '699.363', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(111, 'CableCAT6', 'Bobine cable Réseau CAT 6 800m', '800', '1.775', '19', 'pourcentage', NULL, '0', '1420.000', '0.000', '269.800', '1689.800', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(112, 'MOULURE', 'Moulure 40x40mm', '20', '7.120', '19', 'pourcentage', NULL, '0', '142.400', '0.000', '27.056', '169.456', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(113, 'ONDULEUR', 'Onduleur Eaton Ellipse Pro 650 FR', '1', '380', '19', 'pourcentage', NULL, '0', '380.000', '0.000', '72.200', '452.200', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(114, 'PATCH-CABLE', 'Patch Cable CAT6 0.5M', '18', '5.750', '19', 'pourcentage', NULL, '0', '103.500', '0.000', '19.665', '123.165', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(115, 'Moulure', 'Moulure 25x19mm', '30', '4.940', '19', 'pourcentage', NULL, '0', '148.200', '0.000', '28.158', '176.358', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(116, 'MO', 'Main d\'oeuvre', '18', '53', '19', 'pourcentage', NULL, '0', '954.000', '0.000', '181.260', '1135.260', '16', NULL, '2023-01-11 14:01:08', '2023-01-11 14:21:15'),
(117, 'GCAB', 'Guide Cable ', '1', '31.500', '19', 'pourcentage', NULL, '0', '31.500', '0.000', '5.985', '37.485', '16', NULL, '2023-01-11 14:21:05', '2023-01-11 14:21:15'),
(118, 'OL100EP-CG01B (ECHO PRO 1kVA)', 'Onduleur NJOY On Line ECHO PRO 1000 VA / 800W', '1', '1120', '19', 'pourcentage', NULL, '0', '1120.000', '0.000', '212.800', '1332.800', '18', NULL, '2023-01-11 16:06:36', '2023-01-11 16:06:36'),
(119, 'MO', 'Main d\'oeuvre', '15', '38', '19', 'pourcentage', NULL, '0', '570.000', '0.000', '108.300', '678.300', '14', NULL, '2023-01-11 16:17:56', '2023-01-23 08:14:18'),
(120, 'Swit24POE', 'Switch Rackable 19\" TP-Link 24 ports PoE+\n10/100Mbps, 4 Ports RJ45\nGiga et 2× Combo Gigabit SFP Slots, capacité de\nswitching 8,8Gbps,\n250W', '2', '1327', '19', 'pourcentage', NULL, '0', '2654.000', '0.000', '504.260', '3158.260', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(121, 'PLA17', 'PLAteau pour armoire 6 U', '2', '24', '19', 'pourcentage', NULL, '0', '48.000', '0.000', '9.120', '57.120', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(122, 'PANBRAS', 'Panneau de brassage equippé', '2', '224', '19', 'pourcentage', NULL, '0', '448.000', '0.000', '85.120', '533.120', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(123, 'MPRISE', 'Multiprise 8 Prises Rackable 1U 19\"', '2', '91', '19', 'pourcentage', NULL, '0', '182.000', '0.000', '34.580', '216.580', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(124, 'GCAB', 'Guide cable', '2', '27.500', '19', 'pourcentage', NULL, '0', '55.000', '0.000', '10.450', '65.450', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(125, 'PriseRJ45', 'PRise RJ45 apparant', '40', '17.650', '19', 'pourcentage', NULL, '0', '706.000', '0.000', '134.140', '840.140', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(126, 'PRJ45', 'Patch cable RJ 45 0.5m', '40', '3.750', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(127, 'CableFTP6', 'Bobine cable FTP CAT 6 305m', '4', '292.835', '19', 'pourcentage', NULL, '0', '1171.340', '0.000', '222.555', '1393.895', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(128, 'MO', 'Main d\'ouvre par prise', '55', '38', '19', 'pourcentage', NULL, '0', '2090.000', '0.000', '397.100', '2487.100', '14', NULL, '2023-01-12 12:42:48', '2023-01-23 08:14:18'),
(129, 'SRV-DELL', 'Serveur PowerEdge T40, Chassis 3 x 3.5\", Intel Xeon E-2224G (8M Cache, 3.5 GHz) turbo (71W), 8GB (1x8GB) 3200MHz DDR4 UDIMM ECC, 1x1TB SATA (7.2k rpm) 3.5\", no Graphics, DVD RW, European Power Cord 220V, No RAID, 1Y Basic Onsite, Black', '1', '2780', '7', 'pourcentage', NULL, '0', '2780.000', '0.000', '194.600', '2974.600', '19', NULL, '2023-01-13 09:04:45', '2023-01-13 09:17:09'),
(137, 'ONDULEUR-ASTER2K', 'Onduleur On-Line Double Conversion Gamme Aster, 2kVA/1800W, Autonomie 50%, 8 x IEC, Tour/Rack, HID USB / RS232, Optional, Auto-Restart, <50dB', '1', '2300', '19', 'pourcentage', NULL, '0', '2300.000', '0.000', '437.000', '2737.000', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(138, 'AEPA-PREM-L1', 'Eset Protect Advanced On Premise 1 AN', '50', '71', '19', 'pourcentage', NULL, '0', '3550.000', '0.000', '674.500', '4224.500', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(139, 'V-VBRVUL-0I-SU1YP-00', 'Veeam Backup & Replication Universal Subscription License\nIncludes Entreprise Plus Edition features 1 Year Renewal\nSbscription Upfront Billing & Production(24/7) Support.10\ninstance pack.', '1', '4015', '19', 'pourcentage', NULL, '0', '4015.000', '0.000', '762.850', '4777.850', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(140, 'FG-40F', 'FORTINET FortiGate FG-40F ', '1', '2275', '19', 'pourcentage', NULL, '0', '2275.000', '0.000', '432.250', '2707.250', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(141, 'LIC-FG-40F', 'Licence FORTINET FortiGate FG-40F ', '1', '1130', '19', 'pourcentage', NULL, '0', '1130.000', '0.000', '214.700', '1344.700', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(142, 'WIN-SRV', 'windows server 2019 Standard 16 coeurs', '1', '2875', '19', 'pourcentage', NULL, '0', '2875.000', '0.000', '546.250', '3421.250', '23', NULL, '2023-01-17 15:39:45', '2023-01-17 15:39:45'),
(143, 'PC-LENOVO', 'TB 15-ITL,i5-1135G7,8GB Base DDR4,1TB 5400rpm,Disque dur SSD NVMe 500Go,nVidia MX450 2GB, No OS,15.6\" FHD IPS 300nits,720p HD Cam,Wi-fi AX 2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C 3PIN-EU,KB French', '1', '2350', '7', 'pourcentage', NULL, '0', '2350.000', '0.000', '164.500', '2514.500', '24', NULL, '2023-01-18 15:13:48', '2023-01-19 12:40:08'),
(144, 'PCFTP', 'Patch Cable 5m FTP', '1', '15', '19', 'pourcentage', NULL, '0', '15.000', '0.000', '2.850', '17.850', '14', NULL, '2023-01-20 08:16:40', '2023-01-23 08:14:18'),
(145, 'FG-40F', 'FORTINET FortiGate FG-40F', '1', '2475', '19', 'pourcentage', NULL, '0', '2475.000', '0.000', '470.250', '2945.250', '25', NULL, '2023-01-23 14:02:43', '2023-01-24 08:10:12'),
(146, 'LIC-FG-40F ', 'Licence FORTINET FortiGate FG-40F', '1', '1325', '19', 'pourcentage', NULL, '0', '1325.000', '0.000', '251.750', '1576.750', '25', NULL, '2023-01-23 14:02:43', '2023-01-24 08:10:12'),
(147, 'MO', 'Configuration et Installation', '3', '600', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '25', NULL, '2023-01-23 14:02:43', '2023-01-24 08:10:12'),
(148, 'SITE-VITRINE', 'Création site web vitrine', '1', '1350', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '26', NULL, '2023-01-25 12:57:06', '2023-01-25 13:09:56'),
(151, 'ONDULEUR-NJOY', 'Onduleur Njoy On Line Echo Pro, 2000VA/1600W, Autonomie 50%, 4 x Schuko, Tour, HID USB / RS232, SNMP: Optional, Auto-Restart, <40dB, LCD', '1', '1500', '7', 'pourcentage', NULL, '0', '1500.000', '0.000', '105.000', '1605.000', '29', NULL, '2023-01-27 13:25:41', '2023-01-27 13:35:27'),
(152, 'CM', 'Formation assisatance & support communication digital', '1', '600', '0', 'pourcentage', NULL, '0', '600.000', '0.000', '0.000', '600.000', '30', NULL, '2023-01-30 09:34:14', '2023-01-30 09:34:14'),
(153, 'LAT-5430-I7', 'PC PORTABLE LATITUDE 5430, Ecran 14\",\nProcesseur Intel Core Ci7-1255U up to 4.70GHz,\nMémoire 24Go, Disque Dur SSD 512Go, Wifi, 1\nan garantie', '1', '3995', '7', 'pourcentage', NULL, '0', '3995.000', '0.000', '279.650', '4274.650', '32', NULL, '2023-01-31 13:21:36', '2023-02-07 09:30:05'),
(154, 'V15-ITL-I5', 'PC PORTABLE LENOVO V15-ITL, Ecran 15.6\",\nProcesseur Intel Core\ni5-1135G7, Mémoire 8 Go, Disque Dur SSD\n256Go, HDMI, RJ45, Wifi, 1 an garantie', '1', '1895', '7', 'pourcentage', NULL, '0', '1895.000', '0.000', '132.650', '2027.650', '32', NULL, '2023-01-31 13:21:36', '2023-02-07 09:30:05'),
(155, 'CAMERA-IP-4MP', 'Caméra IP 4MP Outdoor', '5', '307', '19', 'pourcentage', NULL, '0', '1535.000', '0.000', '291.650', '1826.650', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(156, 'NVR-8PORTS', 'NVR 8 ports POE ', '1', '1250', '19', 'pourcentage', NULL, '0', '1250.000', '0.000', '237.500', '1487.500', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(157, 'DISQUE-DUR-6TO', 'Disque Dur 6To', '1', '784', '19', 'pourcentage', NULL, '0', '784.000', '0.000', '148.960', '932.960', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(158, 'CABLE-CAT6', 'Cable FTP CAT 6 420m', '420', '3.200', '19', 'pourcentage', NULL, '0', '1344.000', '0.000', '255.360', '1599.360', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(159, 'PVC-32-3.2MM', 'Pvc 32 3.2mm', '140', '6.000', '19', 'pourcentage', NULL, '0', '840.000', '0.000', '159.600', '999.600', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(160, 'TV-32', 'Smart TV 32 Pouces', '1', '615', '19', 'pourcentage', NULL, '0', '615.000', '0.000', '116.850', '731.850', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(161, 'SUPP-CAMERA', 'Support Caméra', '5', '15', '19', 'pourcentage', NULL, '0', '75.000', '0.000', '14.250', '89.250', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(162, 'BOITE-CAMERA', 'Boite Caméra', '5', '15', '19', 'pourcentage', NULL, '0', '75.000', '0.000', '14.250', '89.250', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(163, 'MO', 'Main d\'oeuvre et Transport', '1', '1062', '19', 'pourcentage', NULL, '0', '1062.000', '0.000', '201.780', '1263.780', '33', NULL, '2023-02-01 14:56:36', '2023-02-01 15:16:50'),
(164, 'ONDULEUR-ECHO-PRO', 'Onduleur on-line njoy echo pro, 3000VA/2400W, Autonomie 50%, 4 x Schuko, Tour, HID USB / RS232, SNMP: Optional, Auto-Restart, Niveau Sonore <40dB, LCD', '1', '1928', '19', 'pourcentage', NULL, '0', '1928.000', '0.000', '366.320', '2294.320', '35', NULL, '2023-02-06 12:33:14', '2023-02-06 12:58:17'),
(165, 'IMPRIMANTE-ZEBRA-ZD220', 'PRINTER ZD220 TT STANDARD EZPL..\nUSB', '1', '984', '0', 'pourcentage', NULL, '0', '984.000', '0.000', '0.000', '984.000', '36', NULL, '2023-02-08 13:41:47', '2023-02-09 07:51:16'),
(166, 'SERVEUR TOUR THINKSYSTEM ST50', 'ST50 Xeon E-2226G (6C 3.4GHz 12MB Cache/80W), SW RAID, 2xS4510 480GB, 2x16GB, 250W, No DVD, ', '1', '5790', '7', 'pourcentage', NULL, '0', '5790.000', '0.000', '405.300', '6195.300', '37', NULL, '2023-02-10 15:55:48', '2023-02-15 16:30:12'),
(167, 'FW-FG40F', 'FORTINET FortiGate FG-40F', '1', '2145', '19', 'pourcentage', NULL, '0', '2145.000', '0.000', '407.550', '2552.550', '37', NULL, '2023-02-10 15:55:48', '2023-02-15 16:30:12'),
(168, 'Lic-UTP', 'Licence Firewall Fortinet UTP pour 1 an', '1', '1125', '19', 'pourcentage', NULL, '0', '1125.000', '0.000', '213.750', '1338.750', '37', NULL, '2023-02-10 15:55:48', '2023-02-15 16:30:12'),
(169, 'POINT D\'ACCES', 'Point D\'accés TP Link 225', '1', '365', '19', 'pourcentage', NULL, '0', '365.000', '0.000', '69.350', '434.350', '37', NULL, '2023-02-10 15:55:48', '2023-02-15 16:30:12'),
(170, 'AESS-L1', 'ESET Server Security lic pleine 1 an', '1', '445.900', '19', 'pourcentage', NULL, '0', '445.900', '0.000', '84.721', '530.621', '37', NULL, '2023-02-10 15:55:48', '2023-02-15 16:30:12'),
(171, 'LENOVO V50T', 'V50t G2,180W TWR,i3-10100,4GB DDR4,1TB 7200rpm,Integrated,DVD±RW,No OS, , ,RTL8822CE 2x2AC+BT,3-in-1 Card Reader,,Parallel Port,NO_SECOND_REAR_COM_PORT,Internal Speaker,2-in-1 CPU fan,180W,USB CLP FRA,USB, Ecran + Clavier + Souris', '1', '1485', '7', 'pourcentage', NULL, '0', '1485.000', '0.000', '103.950', '1588.950', '37', NULL, '2023-02-10 16:13:23', '2023-02-15 16:30:12'),
(173, 'MO', 'Configuration et Installation', '3', '450', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '37', NULL, '2023-02-10 16:25:11', '2023-02-15 16:30:12'),
(174, 'IV', 'Identité visuelle (Graphique..)', '1', '400', '19', 'pourcentage', NULL, '0', '400.000', '0.000', '76.000', '476.000', '38', NULL, '2023-02-13 09:24:47', '2023-02-13 09:24:47'),
(175, 'SITE+IDENTITE', 'Site Web et Identité Visuelle', '1', '1350', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '39', NULL, '2023-02-13 10:13:28', '2023-02-13 10:13:28'),
(176, 'PAGE-WEB', 'Ajout d\'une nouvelle page web (service..)', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '40', NULL, '2023-02-14 08:30:26', '2023-02-14 08:30:26'),
(177, 'LAT-5430I7', 'PC PORTABLE LATITUDE 5430, Ecran 14\",\nProcesseur Intel Core Ci7-1255U up to\n4.70GHz, Mémoire 16Go, Disque Dur SSD\n512Go, Wifi.', '1', '3915', '7', 'pourcentage', NULL, '0', '3915.000', '0.000', '274.050', '4189.050', '41', NULL, '2023-02-14 08:57:32', '2023-02-16 08:07:08'),
(178, 'PAGE-WEB', 'Ajout d\'une nouvelle page web ', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '42', NULL, '2023-02-14 16:28:17', '2023-02-14 16:28:17'),
(179, 'SITE-WEB+CM', 'Webmaster Site Web avec Community management', '1', '400', '19', 'pourcentage', NULL, '0', '400.000', '0.000', '76.000', '476.000', '43', NULL, '2023-02-15 09:56:56', '2023-02-15 10:04:46'),
(180, 'ONDULEUR NJOY IN LINE ARGUS ', 'ONDULEUR NJOY IN LINE ARGUS, 1200VA/720W, Autonomie\n50%, 4 x IEC, Rack, HID USB /RS232, Auto-\nRestart, <50dB, LCD', '1', '1280', '7', 'pourcentage', NULL, '0', '1280.000', '0.000', '89.600', '1369.600', '37', NULL, '2023-02-15 16:30:12', '2023-02-15 16:30:12'),
(181, 'INTERVENTION-MAINTENANCE', 'Maintenance préventive, corrective et curative, Intervention deux journée présentiel par mois avec 4 tickets (support sur demande avec déplacement) ', '1', '1600', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '44', NULL, '2023-02-20 16:06:14', '2023-02-20 16:21:17'),
(182, 'CONSEIL-FORMATION', 'Conseil Et Formation (Par Jour)', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '44', NULL, '2023-02-20 16:06:14', '2023-02-20 16:21:17'),
(183, 'TL-EAP225-INDOOR', 'Point d\'accès WI-FI professionnel AC1350 double bande 2.4Ghz/5Ghz POE - Plafonnier Business solution (INDOOR)', '6', '460.000', '19', 'pourcentage', NULL, '0', '2760.000', '0.000', '524.400', '3284.400', '45', NULL, '2023-02-22 13:01:48', '2023-02-22 13:01:48'),
(184, 'TL-OC200', 'Contrôleur Réseau Hardware Omada (<100 appareils), Administration centralisée et multi-sites pour réseau WiFi (jusqu\'à 100 points d\'accès EAP; Switches JetStream et routeurs VPN SafeStream) Accès Cloud', '1', '680.000', '19', 'pourcentage', NULL, '0', '680.000', '0.000', '129.200', '809.200', '45', NULL, '2023-02-22 13:01:48', '2023-02-22 13:01:48'),
(185, 'TL-SG2210P', 'Switch TP-Link 8 Ports (Gigabyte) POE Avec 2SFP Slots-61W-Bande\npassante 20Gbps, Taux de transfert de paquets 14.9Mpps, Administration Centralisée', '1', '510.000', '19', 'pourcentage', NULL, '0', '510.000', '0.000', '96.900', '606.900', '45', NULL, '2023-02-22 13:01:48', '2023-02-22 13:01:48'),
(186, 'CAB-FTP6 ', 'Cable Rj45 FTP CAT6 (mètre) ', '300', '2.900', '19', 'pourcentage', NULL, '0', '870.000', '0.000', '165.300', '1035.300', '45', NULL, '2023-02-22 13:01:48', '2023-02-22 13:01:48'),
(187, 'MO', 'Main d\'ouvre et configuration (8 points d\'accès et contrôleur Wifi)', '9', '150', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '45', NULL, '2023-02-22 13:01:48', '2023-02-22 13:01:48'),
(188, 'ARM-7U', 'Armoire informatique 7U', '1', '340', '19', 'pourcentage', NULL, '0', '340.000', '0.000', '64.600', '404.600', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(189, 'CAB-FTP6', 'Cable Rj45 FTP CAT6 (mètre)', '100', '2.800', '19', 'pourcentage', NULL, '0', '280.000', '0.000', '53.200', '333.200', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(190, 'MOULURE-19', 'Moulure 25/19', '20', '5.800', '19', 'pourcentage', NULL, '0', '116.000', '0.000', '22.040', '138.040', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(191, 'EAP-225', 'Point d\'accès TP-Link EAP-225', '2', '450', '7', 'pourcentage', NULL, '0', '900.000', '0.000', '63.000', '963.000', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(192, 'TL-SG2210P', 'Switch TP-Link 8 Ports (Gigabyte) POE', '1', '550', '19', 'pourcentage', NULL, '0', '550.000', '0.000', '104.500', '654.500', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(193, 'PLATEAU-7U', 'PLATEAU POUR ARMOIRE 7U', '1', '35', '19', 'pourcentage', NULL, '0', '35.000', '0.000', '6.650', '41.650', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(194, 'MPRISE-8P', 'Multiprise 8 Prises Rackable 1U 19\"', '1', '95', '19', 'pourcentage', NULL, '0', '95.000', '0.000', '18.050', '113.050', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(195, 'SERVICE', 'Main d\'œuvre', '1', '800', '19', 'pourcentage', NULL, '0', '800.000', '0.000', '152.000', '952.000', '46', NULL, '2023-02-23 14:21:27', '2023-02-23 14:21:27'),
(196, 'CM', 'Community Manegement (Gestion,Rédaction,..)\n', '1', '1120', '19', 'pourcentage', NULL, '0', '1120.000', '0.000', '212.800', '1332.800', '54', NULL, '2023-02-27 16:03:04', '2023-02-27 16:03:04'),
(197, 'GRAPHISME', 'Graphisme (Charte graphique, design, vidéo)\n', '1', '1200', '19', 'pourcentage', NULL, '0', '1200.000', '0.000', '228.000', '1428.000', '54', NULL, '2023-02-27 16:03:04', '2023-02-27 16:03:04'),
(198, 'DELL-VOSTRO', 'Vostro 3510/Core i7-1165G7/ 16GB 256GB SSD (Boot) + 1TB 5400 (Storage) / 15.6-inch / NVIDIA(R) GeForce(R) MX350 with 2GB GDDR5 graphics memory / Win10 Pro 64bits\n\n', '1', '2540', '7', 'pourcentage', NULL, '0', '2540.000', '0.000', '177.800', '2717.800', '55', NULL, '2023-02-28 15:11:46', '2023-02-28 15:26:25'),
(199, 'DELL-LATITUDE', 'LAT 5430-N CI5- 1235U (10 Core, 12 MB Cache, 12 Threads, up to 4.40GHz) 8GB 256GB SSD / 14\" FHD (1920x1080), Win10 Pro 64bits\n', '1', '3054', '7', 'pourcentage', NULL, '0', '3054.000', '0.000', '213.780', '3267.780', '55', NULL, '2023-02-28 15:11:46', '2023-02-28 15:26:25'),
(200, 'ESET-ENTRY', 'ESET Protect  Entry OP Lic Pleine 1 an\n\n', '52', '68.950', '19', 'pourcentage', NULL, '0', '3585.400', '0.000', '681.226', '4266.626', '56', NULL, '2023-03-01 15:41:36', '2023-03-01 16:05:19'),
(201, 'ESET-ENTRY', 'ESET Protect  Entry OP Lic Pleine 3 an\n\n', '52', '130.410', '19', 'pourcentage', NULL, '0', '6781.320', '0.000', '1288.451', '8069.771', '56', NULL, '2023-03-01 15:41:36', '2023-03-01 16:05:19'),
(202, 'VM', 'vm 4core, 8G RAM, \n50 Go Stockage ( prix par mois)\n', '1', '120', '19', 'pourcentage', NULL, '0', '120.000', '0.000', '22.800', '142.800', '57', NULL, '2023-03-02 15:46:53', '2023-03-02 15:46:53'),
(203, 'LIC-PLESK', 'license plesk (prix par mois)\n', '1', '18', '19', 'pourcentage', NULL, '0', '18.000', '0.000', '3.420', '21.420', '57', NULL, '2023-03-02 15:46:53', '2023-03-02 15:46:53'),
(204, 'CERT', 'certificat \n', '1', '15', '19', 'pourcentage', NULL, '0', '15.000', '0.000', '2.850', '17.850', '57', NULL, '2023-03-02 15:46:53', '2023-03-02 15:46:53'),
(205, 'GT', 'Gestion Ticket\nGestion Client \nGestion Accessoires\nGestion Stocks\nGestion Emplacements\nGestion Pannes\nGestion Acheteurs\nGestion Users\nGestion Devis\nGestion Profil clients', '1', '11000', '19', 'pourcentage', NULL, '0', '11000.000', '0.000', '2090.000', '13090.000', '59', NULL, '2023-03-03 08:09:50', '2023-04-13 07:37:17'),
(207, 'TV TCL P735', 'Téléviseur TCL UHD 4K 50\" - Résolution: (3840 X 2160), 60Hz - Dolby Vision - Auto Low Latency Mode ( ALLM) - Haut parleur: 2x 10 W - Dolby Audio - HDR10 - MHL v.3.0 - Smart TV (Netflix - YouTube - Amazon Prime - AppleTV+ - Google Play - Google assistant) - Wifi - Bluetooth 5.0 - USB 3.0 - HDMI 2.1\n\n\n\n\n\n\n', '1', '1225', '19', 'pourcentage', NULL, '0', '1225.000', '0.000', '232.750', '1457.750', '61', NULL, '2023-03-03 08:35:07', '2023-03-03 12:07:18'),
(208, 'SUPP-MOB', 'Support mobile pour TV 50\" \n\n\n\n\n\n\n', '1', '961', '19', 'pourcentage', NULL, '0', '961.000', '0.000', '182.590', '1143.590', '61', NULL, '2023-03-03 08:35:07', '2023-03-03 12:07:18'),
(209, 'MO', 'Installation \n\n\n\n\n\n\n', '1', '150', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '61', NULL, '2023-03-03 08:35:07', '2023-03-03 12:07:18'),
(210, 'CABLE-HDMI', 'Cable HDMI 10mm\n\n\n\n\n', '1', '45', '19', 'pourcentage', NULL, '0', '45.000', '0.000', '8.550', '53.550', '61', NULL, '2023-03-03 09:17:24', '2023-03-03 12:07:18'),
(211, 'HP-M404DN', 'Imprimante HP Laser Jet  Pro M404DN \n', '1', '875.000', '0', 'pourcentage', NULL, '0', '875.000', '0.000', '0.000', '875.000', '62', NULL, '2023-03-03 09:24:20', '2023-03-03 09:24:20'),
(212, 'GT', 'Gestion Ticket\nGestion Client \nGestion Accessoires\nGestion Stocks\nGestion Emplacements\nGestion Pannes\nGestion Acheteurs\nGestion Users\nGestion Devis\nGestion Profil clients\n\n', '1', '620', '19', 'pourcentage', NULL, '0', '620.000', '0.000', '117.800', '737.800', '64', NULL, '2023-03-03 15:51:09', '2023-03-03 16:05:25'),
(216, 'POINTEUSE-REC-FACIALE', 'PRODUIT DE MARQUE HIKVISION\nPointeuse + contrôle d’accès à\nreconnaissance facial et à empreinte digital\n\n\n\n\n\n', '1', '780', '19', 'pourcentage', NULL, '0', '780.000', '0.000', '148.200', '928.200', '63', NULL, '2023-03-03 15:56:12', '2023-03-03 16:04:03'),
(218, 'MO', 'Installation et Configuration\n\n\n\n\n', '1', '600', '19', 'pourcentage', NULL, '0', '600.000', '0.000', '114.000', '714.000', '63', NULL, '2023-03-03 15:56:12', '2023-03-03 16:04:03'),
(219, 'DEVspe', 'Développement application web et mobile (SVR/FILORGA) gestion commande client avec espace client dédié\n\n\n', '1', '8300', '19', 'pourcentage', NULL, '0', '8300.000', '0.000', '1577.000', '9877.000', '65', NULL, '2023-03-06 08:42:45', '2023-03-06 08:44:37'),
(223, 'VIDÉO-PROJECTEUR-EPSON', 'EH-TW750 3300 Lumens FULL HD,WIFI,1920 x 1080, USB 2.0-A, USB 2.0, Entrée VGA,\nEntrée HDMI (2x), Miracast, Prise jack de sortie\n\n\n\n\n\n', '1', '2139', '7', 'pourcentage', NULL, '0', '2139.000', '0.000', '149.730', '2288.730', '66', NULL, '2023-03-07 07:51:41', '2023-03-08 10:36:35'),
(224, 'VM', 'vm 8G RAM, 2 Processeurs, 100GO Stockage de disque ( par mois)', '1', '200', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '67', NULL, '2023-03-08 10:08:59', '2023-03-09 08:26:35'),
(225, 'LIC', 'License Plesk ( par ans)', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '67', NULL, '2023-03-08 10:08:59', '2023-03-09 08:26:35'),
(226, 'SSL', 'License SSL (par ans)', '1', '300', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '67', NULL, '2023-03-08 10:08:59', '2023-03-09 08:26:35'),
(227, 'MOD', 'Mo DevOps', '3', '600', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '67', NULL, '2023-03-08 10:15:59', '2023-03-09 08:26:35'),
(228, 'LASER-ECRAN', 'Pointeuse Laser et Ecran de projection\n\n', '1', '475', '7', 'pourcentage', NULL, '0', '475.000', '0.000', '33.250', '508.250', '66', NULL, '2023-03-08 10:36:13', '2023-03-08 10:36:35'),
(229, 'LIC-ESET', 'Licences ESET', '7', '38', '19', 'pourcentage', NULL, '0', '266.000', '0.000', '50.540', '316.540', '68', NULL, '2023-03-10 07:50:20', '2023-03-10 07:50:20'),
(230, 'INT', 'Intervention', '1', '250', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '68', NULL, '2023-03-10 07:50:20', '2023-03-10 07:50:20'),
(231, 'INTERVENTION ', 'Maintenance et intervention une journée  + deux tickets (intervention en urgence) par mois.', '1', '800', '19', 'pourcentage', NULL, '0', '800.000', '0.000', '152.000', '952.000', '69', NULL, '2023-03-10 13:22:37', '2023-03-10 13:22:37'),
(232, 'FA', 'Un forfait de 20 heures d\'assistance.', '20', '90', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '69', NULL, '2023-03-10 13:22:37', '2023-03-10 13:22:37'),
(233, 'AESS-L1', 'ESET Server Security license 1 an', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '70', NULL, '2023-03-10 15:39:32', '2023-03-13 08:36:14'),
(234, 'LIC-WINDOWS', 'Licence Microsoft Windows 11 Pro 64 Bits FR', '1', '560', '19', 'pourcentage', NULL, '0', '560.000', '0.000', '106.400', '666.400', '70', NULL, '2023-03-10 15:39:32', '2023-03-13 08:36:14'),
(235, 'RS', 'relooking site web', '1', '600', '19', 'pourcentage', NULL, '0', '600.000', '0.000', '114.000', '714.000', '73', NULL, '2023-03-13 10:42:32', '2023-03-13 10:42:32'),
(236, 'AS', 'Amélioration du site web : \n ajout de nouvelles fonctionnalités', '1', '750', '19', 'pourcentage', NULL, '0', '750.000', '0.000', '142.500', '892.500', '74', NULL, '2023-03-14 13:43:53', '2023-03-14 13:43:53'),
(237, 'CS', 'création d’un site web vitrine from scratch ( sous pages)', '1', '1800', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '75', NULL, '2023-03-14 13:48:18', '2023-03-21 09:42:22'),
(238, 'SSD-SATA', 'Disque Due SATA SSD 512 Go', '1', '150', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '77', NULL, '2023-03-15 09:36:47', '2023-03-15 09:39:56'),
(239, 'SSD-SATA', 'Disque Due SATA SSD 512 Go', '3', '150', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '78', NULL, '2023-03-15 09:42:40', '2023-03-15 09:42:40'),
(240, 'VM', 'vm 4Core , 8RAM , \n100 GO Stockage  \n( 6mois)', '1', '200', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '79', NULL, '2023-03-15 09:51:27', '2023-03-16 13:08:22'),
(242, 'PC-LENOVO', 'TB 15-ITL,i5-1135G7,8GB Base DDR4,1TB\n5400rpm,Disque dur SSD NVMe\n500Go,nVidia MX450 2GB, No OS,15.6\" FHD\nIPS 300nits,720p HD Cam,Wi-fi AX\n2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C\n3PIN-EU,KB French', '1', '2350', '7', 'pourcentage', NULL, '0', '2350.000', '0.000', '164.500', '2514.500', '76', NULL, '2023-03-15 13:46:37', '2023-03-16 07:59:29'),
(243, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Haut-parleurs, Inclinable/Ajustable en hauteur/Pivotable', '3', '585', '7', 'pourcentage', NULL, '0', '1755.000', '0.000', '122.850', '1877.850', '76', NULL, '2023-03-15 13:46:37', '2023-03-16 07:59:29'),
(244, 'SSD-SATA', 'Disque Dur SSD SATA 512Go', '2', '150', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '76', NULL, '2023-03-15 15:12:40', '2023-03-16 07:59:29'),
(245, 'MB2000', 'MB2000/ID Pointeuse à reconnaissance facial', '1', '785', '19', 'pourcentage', NULL, '0', '785.000', '0.000', '149.150', '934.150', '80', NULL, '2023-03-15 15:59:41', '2023-03-15 15:59:41'),
(246, 'SP-V4I', 'SpeedFace V4L Pointeuse à reconnaissance facial', '1', '695', '19', 'pourcentage', NULL, '0', '695.000', '0.000', '132.050', '827.050', '80', NULL, '2023-03-15 15:59:41', '2023-03-15 15:59:41'),
(247, 'CABLE-SATA', 'Cable SATA', '1', '3.500', '19', 'pourcentage', NULL, '0', '3.500', '0.000', '0.665', '4.165', '76', NULL, '2023-03-15 16:01:54', '2023-03-16 07:59:29'),
(248, 'HBS', 'hébergement silver : espace  100GB, \nNombre domaine : 1\nEspace de disque pour les bases de données : 100MB , \nEspace de sauvegarde : 50GB, \nInterface de Gestion : odin plesk panel\nEmail : 20\nNombre de sous domaine : illimité \nTrafic : Illimité \nBase de données : 3\n(1 ans)', '1', '46.800', '19', 'pourcentage', NULL, '0', '46.800', '0.000', '8.892', '55.692', '79', NULL, '2023-03-16 10:44:34', '2023-03-16 13:08:22'),
(249, 'CS', 'Création d\'un site web vitrine', '1', '1050', '19', 'pourcentage', NULL, '0', '1050.000', '0.000', '199.500', '1249.500', '81', NULL, '2023-03-16 15:10:58', '2023-03-21 15:30:33'),
(250, 'CM', 'Community Management \n ( Page Facebook)', '1', '80', '19', 'pourcentage', NULL, '0', '80.000', '0.000', '15.200', '95.200', '81', NULL, '2023-03-16 15:10:58', '2023-03-21 15:30:33'),
(251, 'TREND-MICRO', 'Worry-Free Standard, Multi-Language: New, Normal, 12 months', '52', '63.690', '19', 'pourcentage', NULL, '0', '3311.880', '0.000', '629.257', '3941.137', '83', NULL, '2023-03-21 10:00:03', '2023-03-21 10:00:03'),
(252, 'DISQUE-DUR', 'Disque Dur SSD NVMe 512Go', '1', '250', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '82', NULL, '2023-03-21 12:22:05', '2023-03-21 12:22:05'),
(253, 'INSTALLATION-CONFIG', 'Installation, configuration et migration données', '1', '250', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '82', NULL, '2023-03-21 12:22:05', '2023-03-21 12:22:05'),
(254, 'ONDULEUR-NJOY', 'Onduleur NJOY On Line ECHO PRO\n1000 VA/800W', '1', '985', '19', 'pourcentage', NULL, '0', '985.000', '0.000', '187.150', '1172.150', '85', NULL, '2023-03-21 14:25:15', '2023-03-21 14:25:15'),
(255, 'LAT-I5', 'LAT 5430-N CI5- 1235U (10 Core, 12 MB Cache, 12 Threads, up to 4.40GHz) 16GB 512GB SSD / 14\" FHD (1920x1080), Linux.', '3', '2930', '7', 'pourcentage', NULL, '0', '8790.000', '0.000', '615.300', '9405.300', '84', NULL, '2023-03-21 15:37:30', '2023-03-22 12:23:29'),
(256, 'TELEPHONE', 'Téléphones Samsung A14', '3', '650', '19', 'pourcentage', NULL, '0', '1950.000', '0.000', '370.500', '2320.500', '84', NULL, '2023-03-21 15:37:30', '2023-03-22 12:23:29'),
(257, 'CLAVIER-SOURIS', 'Ensemble Clavier Et Souris Sans Fil DELL', '3', '145', '7', 'pourcentage', NULL, '0', '435.000', '0.000', '30.450', '465.450', '84', NULL, '2023-03-21 15:37:30', '2023-03-22 12:23:29'),
(258, 'CAS-JABRA', 'Casques Jabra', '3', '190', '19', 'pourcentage', NULL, '0', '570.000', '0.000', '108.300', '678.300', '84', NULL, '2023-03-21 15:37:30', '2023-03-22 12:23:29'),
(259, 'ECRAN-DELL', 'ECRAN DELL 23.8\" PIVOTANT IPS FULL HD P2422H', '3', '610', '7', 'pourcentage', NULL, '0', '1830.000', '0.000', '128.100', '1958.100', '84', NULL, '2023-03-21 15:37:30', '2023-03-22 12:23:29'),
(260, 'POINTEUSE', 'Pointeuse controle d\'accés Faciale + Empreinte, Hikvision', '1', '950', '19', 'pourcentage', NULL, '0', '950.000', '0.000', '180.500', '1130.500', '86', NULL, '2023-03-22 10:57:55', '2023-03-24 11:40:58'),
(261, 'CABLE-6U', 'Cable réseau FTP CAT 6 250m', '250', '2.650', '0', 'pourcentage', NULL, '0', '662.500', '0.000', '0.000', '662.500', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(262, 'PRISE-RESEAU', 'Prise Réseau', '4', '28.300', '0', 'pourcentage', NULL, '0', '113.200', '0.000', '0.000', '113.200', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(263, 'ARMOIRE', 'Armoire 7U', '1', '285', '0', 'pourcentage', NULL, '0', '285.000', '0.000', '0.000', '285.000', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(264, 'SWITCHEUR', 'Switcheur 16 Ports 10/100/1000', '1', '689', '0', 'pourcentage', NULL, '0', '689.000', '0.000', '0.000', '689.000', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(265, 'CABLE-COURANT', 'Cable Courant 3x2.5', '30', '7.800', '0', 'pourcentage', NULL, '0', '234.000', '0.000', '0.000', '234.000', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(266, 'MULTIPRISE', 'Multiprise pour armoire', '1', '45.000', '0', 'pourcentage', NULL, '0', '45.000', '0.000', '0.000', '45.000', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(267, 'TUBE-IRO', 'Tube IRO', '50', '3.200', '0', 'pourcentage', NULL, '0', '160.000', '0.000', '0.000', '160.000', '87', NULL, '2023-03-23 12:26:11', '2023-04-11 12:09:15'),
(268, 'DISQUE-DUR', 'Disque Dur Externe 2TB', '1', '250', '7', 'pourcentage', NULL, '0', '250.000', '0.000', '17.500', '267.500', '88', NULL, '2023-03-23 13:01:18', '2023-03-31 09:23:29'),
(269, 'MO', 'Main d\'oeuvre', '1', '750', '0', 'pourcentage', NULL, '0', '750.000', '0.000', '0.000', '750.000', '87', NULL, '2023-03-23 13:24:03', '2023-04-11 12:09:15'),
(270, 'SE', 'Standard e-commerce', '1', '1800', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(271, 'IM', 'Intégration Module de paiement en ligne', '1', '1500', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(272, 'MS', 'Un module de suivi de la commande par le visiteur est à prévoir (nous aurons accès aux APIs du partenaire de la livraison : a priori Aramex)', '1', '900', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(273, 'BS', 'Un bouton SOS : demande d’assistance technique par WhatsApp par la suite envisager des visites sur site si possible. (Formulaire + coordonnées pour que qu\'on puisse les contacter)', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(274, 'EF', 'Un espace Forum (FAQ) ou comment résoudre les problèmes : pour discuter des', '1', '950', '19', 'pourcentage', NULL, '0', '950.000', '0.000', '180.500', '1130.500', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(275, 'ET', 'Un espace Tutorial : capsules vidéo', '1', '600', '19', 'pourcentage', NULL, '0', '600.000', '0.000', '114.000', '714.000', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(276, 'PF', 'Une page Foire aux questions', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(277, 'PB', 'Une page Blog', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '89', NULL, '2023-03-24 11:33:52', '2023-03-24 11:35:14'),
(278, 'ESET-OP', 'ESET Protect Entry OP Lic Pleine 1 an', '14', '82', '19', 'pourcentage', NULL, '0', '1148.000', '0.000', '218.120', '1366.120', '90', NULL, '2023-03-27 13:00:02', '2023-03-27 13:00:02'),
(279, 'FAP', 'Fortinet fortiAP 231F', '1', '1920', '19', 'pourcentage', NULL, '0', '1920.000', '0.000', '364.800', '2284.800', '91', NULL, '2023-03-28 10:32:30', '2023-03-28 10:32:30'),
(280, 'DS', 'Dockstation d\'accueil EU ,1 x 3.5 mm audio male,\n1 x USB 2.0 Type-A, 1 x USB 3.1 Type-A, 1 x USB\n3.1 Type-C, 1 x RJ45, 1 x VGA x HDMI', '1', '485', '19', 'pourcentage', NULL, '0', '485.000', '0.000', '92.150', '577.150', '92', NULL, '2023-03-28 10:36:31', '2023-03-28 10:36:31'),
(281, 'GS', 'Grandstream UCM6301, 500 utilisateurs, 75 appels simultanés, 2 salles de Vidéoconférences (12 interlocuteurs en 1080p), Conférence vocale (75 interlocuteurs), 1 X FXS - 1 X FXO, 1 X USB 3.0, 1 SD Card, NAT router - 3 X 10/100/1000M PoE+, Montage mural ou sur bureau.', '1', '1920', '19', 'pourcentage', NULL, '0', '1920.000', '0.000', '364.800', '2284.800', '93', NULL, '2023-03-28 12:34:05', '2023-04-03 13:15:20'),
(282, 'GRP2602', 'Téléphones IP Grandstream, \n4 Comptes SIP / 2 Lignes, Ecran LCD Rétroéclairé 2,21\" (132 X 48), Haut-parleur Full Duplex, Coques interchangeables , 4 touches XML, Conférence à 5, Prise casque RJ9, Compatible EHS (EPOS - Jabra - Plantronics)\n2 ports 10/100 Mbps.', '67', '264', '19', 'pourcentage', NULL, '0', '17688.000', '0.000', '3360.720', '21048.720', '93', NULL, '2023-03-28 12:34:05', '2023-04-03 13:15:20'),
(283, 'INFOGERANCE', 'Maintenance et intervention une journée +\nun Ticket (intervention en urgence) par\nmois.', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '94', NULL, '2023-03-29 09:32:21', '2023-03-29 12:06:49'),
(284, 'ECRAN-PC', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Hautparleurs,\nInclinable/Ajustable\nen\nhauteur/Pivotable)', '1', '585', '7', 'pourcentage', NULL, '0', '585.000', '0.000', '40.950', '625.950', '95', NULL, '2023-03-29 11:59:19', '2023-03-29 11:59:19'),
(285, 'DISQUE-HDD', 'Disque dur HDD 500Go', '1', '82', '7', 'pourcentage', NULL, '0', '82.000', '0.000', '5.740', '87.740', '96', NULL, '2023-03-30 08:29:07', '2023-03-30 08:29:07'),
(286, 'MO', 'Main d\'oeuvre', '1', '100', '19', 'pourcentage', NULL, '0', '100.000', '0.000', '19.000', '119.000', '96', NULL, '2023-03-30 08:29:07', '2023-03-30 08:29:07'),
(287, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS,\n60Hz 4ms, HDMI VGA DP, Haut-parleurs,\nInclinable/Ajustable en hauteur/Pivotable', '1', '535', '7', 'pourcentage', NULL, '0', '535.000', '0.000', '37.450', '572.450', '97', NULL, '2023-03-30 11:58:35', '2023-03-31 07:48:18'),
(288, 'DS', 'Dockstation d\'accueil EU ,1 x 3.5 mm audio\nmale, 1 x USB 2.0 Type-A, 1 x USB 3.1 TypeA, 1 x USB 3.1 Type-C, 1 x RJ45, 1 x VGA\nx\nHDMI', '1', '485', '7', 'pourcentage', NULL, '10', '485.000', '48.500', '30.555', '467.055', '97', NULL, '2023-03-30 11:58:35', '2023-03-31 07:48:18'),
(289, 'ESET-DESK', 'ESET Internet Security', '5', '38', '19', 'pourcentage', NULL, '0', '190.000', '0.000', '36.100', '226.100', '88', NULL, '2023-03-31 09:23:29', '2023-03-31 09:23:29'),
(290, 'FG-100F', 'FG-100F UTP Bundle 24*7', '1', '18120', '19', 'pourcentage', NULL, '0', '18120.000', '0.000', '3442.800', '21562.800', '93', NULL, '2023-04-03 09:02:25', '2023-04-03 13:15:20'),
(291, 'FG-40F', 'Fortigate Fortinet 40F', '19', '1945', '19', 'pourcentage', NULL, '0', '36955.000', '0.000', '7021.450', '43976.450', '93', NULL, '2023-04-03 09:02:25', '2023-04-03 13:15:20'),
(292, 'SWITCH-8PORTS-POE', 'Switch TP-LINK 8 ports Gigabit POE + 2 Ports SFP', '19', '420', '19', 'pourcentage', NULL, '0', '7980.000', '0.000', '1516.200', '9496.200', '93', NULL, '2023-04-03 09:02:25', '2023-04-03 13:15:20'),
(293, 'FG-40F', 'Fortigate Fortinet 40F', '2', '2045', '19', 'pourcentage', NULL, '0', '4090.000', '0.000', '777.100', '4867.100', '99', NULL, '2023-04-03 09:06:18', '2023-04-03 12:32:56'),
(294, 'LIC-FG-40F', 'Licence Forigate Fortinet 40F', '2', '1062', '19', 'pourcentage', NULL, '0', '2124.000', '0.000', '403.560', '2527.560', '99', NULL, '2023-04-03 11:55:19', '2023-04-03 12:32:56'),
(295, 'CAM-HDD', 'Caméra 5MP Hikvision Full HD', '5', '180', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '100', NULL, '2023-04-03 12:18:32', '2023-04-03 12:19:34'),
(296, 'DVR-8CH', 'DVR Pro 8 chaines Hikvision', '1', '900', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '100', NULL, '2023-04-03 12:18:32', '2023-04-03 12:19:34'),
(297, 'DISQUE-DUR', 'Disque Dur 4TO', '1', '500', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '100', NULL, '2023-04-03 12:18:32', '2023-04-03 12:19:34'),
(298, 'CABLE', 'Cable et Tube Gris', '1', '1300', '19', 'pourcentage', NULL, '0', '1300.000', '0.000', '247.000', '1547.000', '100', NULL, '2023-04-03 12:18:32', '2023-04-03 12:19:34'),
(299, 'MO', 'Main D\'oeuvre', '1', '1000', '19', 'pourcentage', NULL, '0', '1000.000', '0.000', '190.000', '1190.000', '100', NULL, '2023-04-03 12:18:32', '2023-04-03 12:19:34'),
(300, 'SWITCH-16PORTS-POE', 'Switch TP-LINK 16 ports Gigabit POE + 2 Ports SFP', '1', '900', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '93', NULL, '2023-04-03 13:07:47', '2023-04-03 13:15:20'),
(301, 'IMP-CANON', 'Photocopieur multifonction Laser CANON 2425-I A3 - Écran 7\" Tactile TFT LCD Couleur - Technologie d\'impression: Laser monochrome - Fonctions: Impression, copie, numérisation - Processeur: double cœur 1GHz - Formats papier: A3 - Mémoire RAM: 2 Go - Stockage: 64 Go - Résolution d\'impression: 600 x 600 ppp - Vitesse de copie/d\'impression: Jusqu\'à 25 ppm (A4), jusqu\'à 12 ppm (A3) - Capacité d\'alimentation papier (A4, 80 g/m²): 330 feuilles - Capacité de sortie papie: 250 feuilles - Connectivité: Réseau, USB 2.0 - Dimensions: 627 x 665 x 516 mm, Garantie 1an.', '1', '4650', '7', 'pourcentage', NULL, '0', '4650.000', '0.000', '325.500', '4975.500', '102', NULL, '2023-04-04 12:54:52', '2023-04-04 13:27:46'),
(304, 'VM', 'VM 4 Coeurs, 8GB, 100GB de stockage', '12', '200', '19', 'pourcentage', NULL, '0', '2400.000', '0.000', '456.000', '2856.000', '103', NULL, '2023-04-05 11:37:55', '2023-04-05 11:37:55'),
(305, 'LIC-PLESK', 'Licence Plesk', '1', '360', '19', 'pourcentage', NULL, '0', '360.000', '0.000', '68.400', '428.400', '103', NULL, '2023-04-05 11:37:55', '2023-04-05 11:37:55'),
(306, 'CER-SSL', 'Certificat SSL', '1', '300', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '103', NULL, '2023-04-05 11:37:55', '2023-04-05 11:37:55'),
(307, 'IMP-EPSON', 'Imprimante à Réservoir Intégré EPSON ECOTANK L5290 4En1 Couleur - Fonction: Impression, Numérisation, Copie et Télécopie- Technologie d\'impression: Jet d\'encre (tête d\'impression Epson Micro Piezo) - Vitesse d\'impression (N&B/Couleur): 33 pages/min , 15 pages/min - Résolution d\'impression : 5.760 x 1.440 DPI (ppp) -  Vitesse de Numérisation: recto (A4 noir): 200 DPI - recto (couleur A4): 200 DPI  - Impression recto/verso: Manuel - Format Papier: A4 - Connectivite: Wi-Fi, USB, Ethernet, Wi-Fi Direct - Capacité du bac de sortie papier: 30 Feuilles - Capacité du bac à papier: 100 Feuilles Standard, 100 Feuilles maximale, 20 Feuilles photo - Dimensions: 375‎ x 347 x 237 mm -', '1', '985', '7', 'pourcentage', NULL, '0', '985.000', '0.000', '68.950', '1053.950', '101', NULL, '2023-04-06 07:46:04', '2023-04-06 08:11:03'),
(308, 'IMP-EPSON', 'mprimante Multifonctions à réservoir intégré Epson EcoTank L14150 - Ecran tactile - Format A3+  - Mode d\'impression: Tête d’impression PrecisionCore - Fonctions 4en1: Impression, Numérisation, Copie, Télécopie - Recto-verso automatique (A4, papier ordinaire) - Vitesse d\'impression 17 pages/min Monochrome, 9 pages/min Couleur - Résolution de la numérisation 1200 x 2400 DPI - Fax à grande vitesse en noir et blanc et en couleur - Connectivité: USB, Ethernet, Wi-Fi, Wi-Fi Direct', '1', '1870', '7', 'pourcentage', NULL, '0', '1870.000', '0.000', '130.900', '2000.900', '101', NULL, '2023-04-06 07:46:04', '2023-04-06 08:11:03'),
(309, 'IMP-EPSON', 'Imprimante Jet d\'encre Multifonction 3en1 L3156 Couleur - Impression, Copie, numérisation - Format: A4 - Technologie d\'impression: Jet d\'encre - Vitesse d\'impession: 33 ppm (N&B) - Résolution d\'impression: 5760 x 1440 DPI - Vitesse de Numérisation: 11s noir (200 DPI), 28 s couleur (200 DPI) - Capacité d\'entrée: 100 Feuilles - Fonctionne avec 4 Cartouches (noire, cyan, magenta, jaune) - Dimensions: 375 x 347 x 179 mm - Connectivité: USB, WiFi - Wi-Fi Direct.', '1', '665', '7', 'pourcentage', NULL, '0', '665.000', '0.000', '46.550', '711.550', '101', NULL, '2023-04-06 07:46:04', '2023-04-06 08:11:03'),
(310, 'SITE-VITRINE', 'Création d\'un site web Vitrine', '1', '1465', '19', 'pourcentage', NULL, '0', '1465.000', '0.000', '278.350', '1743.350', '104', NULL, '2023-04-06 09:05:56', '2023-04-06 10:33:10'),
(311, 'V50T-G2', 'V50t G2,180W TWR, i5-10400,12GB DDR4,1TB\n7200rpm, Integrated,DVD±RW,No OS,\n,RTL8822CE 2x2AC+BT,3-in-1 Card\nReader,,ParallelPort,NO_SECOND_REAR_COM_ PORT,Internal Speaker,2-in-1 CPU fan,180W,USB CLP FRA,USB CLP MOUSE, Ecran.', '1', '1930', '7', 'pourcentage', NULL, '0', '1930.000', '0.000', '135.100', '2065.100', '105', NULL, '2023-04-06 12:40:27', '2023-04-10 13:16:49'),
(312, 'TB', 'TB 15-ITL,i5-1135G7,8GB Base DDR4,1TB 5400rpm,  Disque Dur SSD 512GO, nVidia MX450 2GB,No OS,15.6\" FHD IPS 300nits,720p HD Cam,Wi-fi AX 2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C 3PIN-EU,KB French.', '1', '2590', '7', 'pourcentage', NULL, '0', '2590.000', '0.000', '181.300', '2771.300', '105', NULL, '2023-04-06 12:40:27', '2023-04-10 13:16:49'),
(313, 'FG-40F', 'Fortigate Fortinet 40F', '1', '2400', '19', 'pourcentage', NULL, '0', '2400.000', '0.000', '456.000', '2856.000', '106', NULL, '2023-04-07 08:06:19', '2023-04-07 08:11:47'),
(314, 'LIC-FG40F', 'Licence Forigate Fortinet 40F', '1', '1200', '19', 'pourcentage', NULL, '0', '1200.000', '0.000', '228.000', '1428.000', '106', NULL, '2023-04-07 08:06:19', '2023-04-07 08:11:47'),
(315, 'MO', 'Installation et Configuration', '1', '600', '19', 'pourcentage', NULL, '0', '600.000', '0.000', '114.000', '714.000', '106', NULL, '2023-04-07 08:11:47', '2023-04-07 08:11:47'),
(316, 'IMP-EPSON', 'Imprimante Multifonctions à réservoir intégré\nEpson EcoTank L14150 - Ecran tactile Format A3+ - Mode d\'impression:\nTête\nd’impression PrecisionCore - Fonctions\n4en1:\nImpression, Numérisation, Copie, Télécopie\nRecto-verso automatique (A4,\npapier\nordinaire) - Vitesse d\'impression\n17\npages/min Monochrome, 9\npages/min\nCouleur - Résolution de la numérisation\n1200\nx 2400 DPI - Fax à grande vitesse en noir\net\nblanc et en couleur - Connectivité:\nUSB,\nEthernet, Wi-Fi, Wi-Fi\nDirect', '1', '1870', '7', 'pourcentage', NULL, '0', '1870.000', '0.000', '130.900', '2000.900', '107', NULL, '2023-04-07 09:30:30', '2023-04-07 09:30:30'),
(317, 'IMP-HP', 'Imprimante Laser HP 107A Monochrome - Fonctions: Impression - Technologie d\'impression: Laser - Format Papier: A4 - Résolution d\'impression: Jusqu\'à 1 200 x 1 200 ppp  - Vitesse d\'impression: 20 ppm - Entrée papier standard: 150 feuilles - Mémoire: 64 Mo - Ecran: Voyant - Impression recto/verso: Manuel - Format compacte - Simplicité d\'installation - Tailles de support personnalisées: 76 x 127 à 216 x 356 mm - Connecteurs: USB  - Dimensions: 331 x 350 x 248 mm - Poids: 4,16 kg - Couleur: Blanc', '1', '420', '7', 'pourcentage', NULL, '0', '420.000', '0.000', '29.400', '449.400', '107', NULL, '2023-04-07 09:30:30', '2023-04-07 09:30:30'),
(318, 'RAM-T20', 'Barrettes Ram Serveur Dell PowerEdge T20 8Go', '2', '360', '7', 'pourcentage', NULL, '0', '720.000', '0.000', '50.400', '770.400', '108', NULL, '2023-04-10 12:18:36', '2023-04-10 12:43:31'),
(319, 'TB', 'Tube Gorge', '20', '2.400', '0', 'pourcentage', NULL, '0', '48.000', '0.000', '0.000', '48.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(320, 'MOULURE', 'Moulure 25x19', '20', '3.500', '0', 'pourcentage', NULL, '0', '70.000', '0.000', '0.000', '70.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(321, 'ATI', 'Attache Tube IRO', '50', '1.500', '0', 'pourcentage', NULL, '0', '75.000', '0.000', '0.000', '75.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(322, 'MTI', 'Manchon Tube IRO', '10', '2.000', '0', 'pourcentage', NULL, '0', '20.000', '0.000', '0.000', '20.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(323, 'PC-0.5M', 'Patch Cable 0.5m', '0.5', '7.100', '0', 'pourcentage', NULL, '0', '3.550', '0.000', '0.000', '3.550', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(324, 'PC-5M', 'Patch Cable 5m', '5', '19.000', '0', 'pourcentage', NULL, '0', '95.000', '0.000', '0.000', '95.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15');
INSERT INTO `itemdevis` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `devis_id`, `catalogue_id`, `created_at`, `updated_at`) VALUES
(325, 'PA-225', 'Point d\'accés EAP 225', '1', '550', '0', 'pourcentage', NULL, '0', '550.000', '0.000', '0.000', '550.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(326, 'NOYAU', 'Noyau prise RJ45', '8', '12.000', '0', 'pourcentage', NULL, '0', '96.000', '0.000', '0.000', '96.000', '87', NULL, '2023-04-11 12:09:15', '2023-04-11 12:09:15'),
(327, 'TV-TCL', 'TV TCL 32 Pouces', '1', '455', '19', 'pourcentage', NULL, '0', '455.000', '0.000', '86.450', '541.450', '109', NULL, '2023-04-12 12:07:54', '2023-04-12 12:07:54'),
(328, 'SWP', '- Slide dynamique\n- 5 pages presentation \n-  Catalogue produits\n- Catalogue Recette et Astuce\n- page Export avec maps\n- Actualites ( Newslettre) avec mailing\n- Contact\n- Hébergement \n- sécurité', '2350', '1', '19', 'pourcentage', NULL, '0', '2350.000', '0.000', '446.500', '2796.500', '110', NULL, '2023-04-13 07:30:42', '2023-04-13 07:31:47'),
(329, 'MIGRATION', 'Migration des données', '1', '150', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '111', NULL, '2023-04-13 08:59:02', '2023-04-13 08:59:02'),
(330, 'AssacTis001', 'Mission d\'assistance à la formalisation d\'un nouveau\nmodèle économique', '30', '1300', '19', 'pourcentage', NULL, '0', '39000.000', '0.000', '7410.000', '46410.000', '113', NULL, '2023-04-13 11:46:38', '2023-04-13 11:46:38'),
(331, 'IMP-KYOCERA', 'Imprimante Kyocera M6235 Multifonction couleur A4  3 en 1 - Ecran tactile 7 pouces - Impression, copie, scanner - Format A4 - Vitesse Jusqu\'à 35 ppm - Impression de la première page dans 7 secondes - Mémoire 1000 Mo - Résolution Jusqu\'à 1200 dpi - Bac Papier 500 feuilles - Impression Recto Verso Semi automatic - Préchauffage 25 secondes maximum - Dimensions 480 x 577 x 620 - USB - Ethernet', '1', '2970', '7', 'pourcentage', NULL, '0', '2970.000', '0.000', '207.900', '3177.900', '112', NULL, '2023-04-13 12:02:13', '2023-04-13 12:02:13'),
(332, 'TS-431K ', 'Serveur NAS Alpine AL214, 4-core, 1.7GHz , 1 GB DDR3 RAM, 16 TO( 4 X HDD 4 TO), 512 MB NAND flash, 4 x SATA 3.5\"/2.5\" 6Gb/s HDD/SSD ; Hot-swappable, Single disk, RAID 0/1/5/6/10/5 + spare / 6 + spare, 2 ports Ethernet Gigabit RJ-45, Power Status, LAN, USB, HDD, 3 x USB 3.2 port (1 x avant ; 2 x arrière), Tower, Power, Reset, USB One-Touch-Copy.', '1', '2850', '7', 'pourcentage', NULL, '0', '2850.000', '0.000', '199.500', '3049.500', '114', NULL, '2023-04-14 11:22:18', '2023-04-14 11:26:52'),
(333, 'SCANNER-EPSON', 'Scaner à plat WorkForce EPSON DS-1630 recto-verso - Résolution de la Numérisation: 600 x 600 dpi (optique), 1200 x 1200 dpi - Vitesse de numérisation (Monochrome / couleur): 25 page/min (A4 , 200/300 dpi) - Numérisation en recto-verso - Formats de papier: A4 - Connectivité: USB 3.0 - Chargeur automatique de documents: 50 pages -  Dimensions: 451‎ x 315 x 120 mm - Poids: 3.7 kg', '1', '780', '7', 'pourcentage', NULL, '0', '780.000', '0.000', '54.600', '834.600', '115', NULL, '2023-04-26 10:10:06', '2023-05-02 08:04:29'),
(335, 'IMP-EPSON', 'Imprimante Jet d\'encre L3150 Multifonction 3en1 Couleur - Fonctions: Impression, Copie, numérisation - Format: A4 - Technologie d\'impression: Jet d\'encre - Vitesse d\'impession: 33 ppm (N&B) - Résolution d\'impression: 5760 x 1440 DPI - Vitesse de Numérisation: 11s noir (200 DPI), 28 s couleur (200 DPI) - Capacité d\'entrée: 100 Feuilles - Fonctionne avec 4 Cartouches (noire, cyan, magenta, jaune) - Dimensions: 375 x 347 x 179 mm - Connectivité: USB, WiFi - Wi-Fi Direct', '1', '640', '7', 'pourcentage', NULL, '0', '640.000', '0.000', '44.800', '684.800', '116', NULL, '2023-04-26 13:17:09', '2023-04-26 15:15:27'),
(336, 'PC-LENOVO', 'Pc Lenovo Intel Core i5-1135G7 (2.40 GHz up to 4,20 GHz Turbo max, 8 Mo de mémoire cache, Quad-Core) - Système d\'exploitation: FreeDos - Mémoire RAM: 12 Go DDR4-3200 - Disque Dur: 512 Go SSD, 1TB HDD - Carte Graphique: Integrated avec WiFi, Bluetooth,1xUSB 2.0, 1x USB 3.2 Gen 1, 1x USB-C 3.2 Gen 1, 1x HDMI 1.4b, 1x prise combinée casque/microphone (3,5 mm) et lecteur de carte .', '1', '1930', '7', 'pourcentage', NULL, '0', '1930.000', '0.000', '135.100', '2065.100', '117', NULL, '2023-04-26 14:58:38', '2023-04-26 15:57:35'),
(337, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Haut-parleurs, Inclinable/Ajustable en hauteur/Pivotable)', '1', '575', '7', 'pourcentage', NULL, '0', '575.000', '0.000', '40.250', '615.250', '117', NULL, '2023-04-26 14:58:38', '2023-04-26 15:57:35'),
(338, 'CS', 'Clavier et Souris', '1', '165', '7', 'pourcentage', NULL, '0', '165.000', '0.000', '11.550', '176.550', '117', NULL, '2023-04-26 14:58:38', '2023-04-26 15:57:35'),
(339, 'TONER-HP59A', 'Toner LaserJet Adaptable HP 59A - Technologie d\'impression: Laser - Nombre total de pages (noir et blanc): 3000 pages - Avec puce - Dimensions: 362 x 102 x 198 mm - Poids: 1,07 kg', '1', '295', '19', 'pourcentage', NULL, '0', '295.000', '0.000', '56.050', '351.050', '118', NULL, '2023-04-27 15:53:18', '2023-04-27 15:53:18'),
(340, 'SWITCH-WS-PoE', 'Switch\nWS-C2960+24PC-L  Catalyst 2960 Plus 24 10/100 PoE + 2 T/SFP LAN Base', '1', '4070.000', '19', 'pourcentage', NULL, '0', '4070.000', '0.000', '773.300', '4843.300', '119', NULL, '2023-04-28 14:50:38', '2023-04-28 14:50:38'),
(341, 'WINDOWS-VM ', 'License Windows Server STD 16 Core 2019 Open 2 machine VM', '1', '3820.000', '19', 'pourcentage', NULL, '0', '3820.000', '0.000', '725.800', '4545.800', '120', NULL, '2023-04-28 14:53:02', '2023-04-28 14:53:02'),
(342, 'TR', 'Test et regression', '5', '450', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(343, 'MF', 'Module facture', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(344, 'OT', 'Module OT', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(345, 'MD', 'Module dossier', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(346, 'MDC', 'Modification module client', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(347, 'MD', 'Modification destination', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(348, 'MC', 'Modification catégorie client', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(349, 'MN', 'Module notifications', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(350, 'GC', 'Gestion des camions', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(351, 'GC', 'Gestion de chauffeurs && Gestion de sous traitons', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(352, 'MF', 'Module facture', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(353, 'MOT', 'Modification module ordre de travail', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(354, 'TX', 'Taux de taxation', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(355, 'MC', 'Module client', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(356, 'MG', 'Module gestion des dossiers', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(357, 'MD', 'Modification devis', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(358, 'CP', 'Catalogue prix & déstinations', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(359, 'MP', 'Module paiement', '2', '450', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(360, 'BL', 'Module Bon de livraison', '4', '450', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(361, 'MF', 'Module factures', '3', '450', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(362, 'MT', 'Module ordres de transports', '5', '450', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(363, 'MD', 'Module devis', '4', '450', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(364, 'AMC', 'Authentification+module client+module entreprises', '3', '450', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(365, 'UIT', 'Upload et integration template', '1', '450', '19', 'pourcentage', NULL, '0', '450.000', '0.000', '85.500', '535.500', '121', NULL, '2023-05-02 12:50:05', '2023-05-02 12:50:05'),
(366, 'ESET-DESK', 'Eset Internet Security pour Desktop', '5', '45', '19', 'pourcentage', NULL, '0', '225.000', '0.000', '42.750', '267.750', '122', NULL, '2023-05-02 15:32:05', '2023-05-10 12:07:38'),
(367, 'ESET-SERV', 'Eset File Security pour Serveur', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '122', NULL, '2023-05-02 15:32:05', '2023-05-10 12:07:38'),
(368, 'FAP-231F', 'Fortinet FortiAP 231F', '1', '2150', '19', 'pourcentage', NULL, '0', '2150.000', '0.000', '408.500', '2558.500', '123', NULL, '2023-05-03 15:26:59', '2023-05-03 15:26:59'),
(369, 'DDE', 'Disque Dur Externe 2TB', '1', '250', '7', 'pourcentage', NULL, '0', '250.000', '0.000', '17.500', '267.500', '126', NULL, '2023-05-05 12:27:38', '2023-05-05 12:27:56'),
(370, 'CAMERA', 'Caméra Hikvision 5MP Couleur', '12', '215', '19', 'pourcentage', NULL, '0', '2580.000', '0.000', '490.200', '3070.200', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(371, 'DVR', 'DVR Hikvision 16 Chaines', '1', '1690', '19', 'pourcentage', NULL, '0', '1690.000', '0.000', '321.100', '2011.100', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(372, 'DD', 'Disque Dur 2TB pour enregistrement', '1', '500', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(373, 'CABLE', 'Cable Coaxial + Tube Gris et accessoires', '1', '3000', '19', 'pourcentage', NULL, '0', '3000.000', '0.000', '570.000', '3570.000', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(374, 'MD', 'Main D\'oeuvre', '1', '2000', '19', 'pourcentage', NULL, '0', '2000.000', '0.000', '380.000', '2380.000', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(375, 'AI', 'Armoire Informatique 7U', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(376, 'TV', 'TV 32 Pouces', '1', '540', '19', 'pourcentage', NULL, '0', '540.000', '0.000', '102.600', '642.600', '127', NULL, '2023-05-05 13:30:12', '2023-05-05 13:36:34'),
(377, 'CAMERA', 'Caméra Hikvision 5MP Couleur', '7', '215', '19', 'pourcentage', NULL, '0', '1505.000', '0.000', '285.950', '1790.950', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(378, 'DVR', 'DVR Hikvision 16 Chaines', '1', '1690', '19', 'pourcentage', NULL, '0', '1690.000', '0.000', '321.100', '2011.100', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(379, 'DD', 'Disque Dur 2TB', '1', '500', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(380, 'CTA', 'Cable Coaxial + Tube Gris et accessoires', '1', '2000', '19', 'pourcentage', NULL, '0', '2000.000', '0.000', '380.000', '2380.000', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(381, 'MD', 'Main d\'oeuvre', '1', '1800', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(382, 'AI', 'Armoire Informatique 7U', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(383, 'TV', 'TV 32 Pouces', '1', '540', '19', 'pourcentage', NULL, '0', '540.000', '0.000', '102.600', '642.600', '128', NULL, '2023-05-05 13:36:18', '2023-05-05 13:36:18'),
(384, 'SERVEUR TOUR THINKSYSTEM ST50', 'ST550 Xeon Silver 4208 (8C 2.1GHz 11MB Cache/85W) 16GB 2933MHz (1x16GB, 2Rx8 RDIMM), O/B, 930-8i, 1x750W, XCC Enterprise ,No DVD.', '1', '5990', '7', 'pourcentage', NULL, '0', '5990.000', '0.000', '419.300', '6409.300', '129', NULL, '2023-05-08 12:36:41', '2023-05-08 12:36:41'),
(385, 'API', 'Connecteur API (connecteur entre les pointeuses et oddo)', '1', '3600', '19', 'pourcentage', NULL, '0', '3600.000', '0.000', '684.000', '4284.000', '130', NULL, '2023-05-08 14:16:06', '2023-05-08 14:25:50'),
(386, 'DS-K1T341AMF', 'Pointeuse + Contrôle d’accès à reconnaissance faciale & empreinte digitale.\n3 000 FACES \nCAMERA 2MP, WDR \n3 000 EMPREINTES\n3 000 BADGE DE FREQUENCE 13.56 Mhz\n150 000 EVENEMENTS\nPROTOCOLE DE COMMUNICATION :TCP/IP, RS-485, WIEGAND, IP65.', '5', '1015', '19', 'pourcentage', NULL, '5', '5075.000', '253.750', '916.038', '5737.288', '131', NULL, '2023-05-08 14:31:00', '2023-05-10 10:30:08'),
(387, 'DS-K1T201AMF', 'Contrôle d’accès à empreinte digitale & badge\n5 000 Empreintes \n100 000 badges   \n300 000 Evènements \nEcran LCD\nProtocole de communication: TCP/IP + WI-FI,RS-485, Wiegand', '5', '760', '19', 'pourcentage', NULL, '5', '3800.000', '190.000', '685.900', '4295.900', '132', NULL, '2023-05-08 14:33:11', '2023-05-10 10:30:41'),
(388, 'FG-60F', 'Fortigate Fortinet 60F', '1', '2800', '19', 'pourcentage', NULL, '0', '2800.000', '0.000', '532.000', '3332.000', '133', NULL, '2023-05-08 15:53:17', '2023-05-10 10:19:47'),
(389, 'LIC-60F', 'Licence Fortigate Fortinet 60F', '1', '1540', '19', 'pourcentage', NULL, '0', '1540.000', '0.000', '292.600', '1832.600', '133', NULL, '2023-05-08 15:53:17', '2023-05-10 10:19:47'),
(390, 'MO', 'installation& configuration', '3', '500', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '133', NULL, '2023-05-10 10:19:47', '2023-05-10 10:19:47');

-- --------------------------------------------------------

--
-- Structure de la table `itemfactures`
--

CREATE TABLE `itemfactures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `prix_ht` varchar(255) NOT NULL,
  `tva` varchar(255) NOT NULL,
  `type_remise` varchar(255) DEFAULT NULL,
  `type_tva` varchar(255) DEFAULT NULL,
  `remise` varchar(255) DEFAULT NULL,
  `total_ht` varchar(255) NOT NULL,
  `total_remise` varchar(255) NOT NULL,
  `total_tva` varchar(255) NOT NULL,
  `total_ttc` varchar(255) NOT NULL,
  `facture_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itemfactures`
--

INSERT INTO `itemfactures` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `facture_id`, `created_at`, `updated_at`) VALUES
(12, 'INFO-G', 'Infogérance pour le mois de Janvier', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '11', '2023-01-23 08:21:41', '2023-01-30 09:27:13'),
(13, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '500', '19', 'montant', NULL, '0', '500.000', '0.000', '95.000', '595.000', '12', '2023-01-23 08:29:01', '2023-01-23 08:58:31'),
(14, 'V15-ITL-i5', 'V15-ITL,i5-1135G7, 12GB Base DDR4, 500GB SSD M.2 2242 NVMe ,Integrated,15.6\" FHD TN,No OS,Wi-fi AC 2x2+BT,N-FPR,1MP HD Cam,2 Cell 38Whr,65W AC 3PIN,KYB French,1 Year Carry-in', '1', '1895.000', '7', 'pourcentage', NULL, '0', '1895.000', '0.000', '132.650', '2027.650', '13', '2023-01-23 08:43:25', '2023-01-30 09:22:42'),
(15, 'CABLEFTP6A', 'Cable FTP Cat 6A ', '500', '2.600', '19', 'pourcentage', NULL, '0', '1300.000', '0.000', '247.000', '1547.000', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(16, 'PRISE-RJ45', 'Prise RJ45 apparente', '8', '17.650', '19', 'pourcentage', NULL, '0', '141.200', '0.000', '26.828', '168.028', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(17, 'PRISE-APPARANT', 'prise courant apparente', '7', '17.720', '19', 'pourcentage', NULL, '0', '124.040', '0.000', '23.568', '147.608', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(18, 'MOULURE', 'Moulure 40x40mm', '37', '10.420', '19', 'pourcentage', NULL, '0', '385.540', '0.000', '73.253', '458.793', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(19, 'MOULURE', 'Moulure 25x19mm', '20', '5.470', '19', 'pourcentage', NULL, '0', '109.400', '0.000', '20.786', '130.186', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(20, 'CABLE-HDMI', 'Cable HDMI 30M', '1', '120', '19', 'pourcentage', NULL, '0', '120.000', '0.000', '22.800', '142.800', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(21, 'CABLE-3-5', 'Cable 3de5', '90', '5.775', '19', 'pourcentage', NULL, '0', '519.750', '0.000', '98.752', '618.503', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(22, 'CHEVILLE', 'Cheville ', '400', '0.120', '19', 'pourcentage', NULL, '0', '48.000', '0.000', '9.120', '57.120', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(23, 'VISES', 'Vises', '400', '0.090', '19', 'pourcentage', NULL, '0', '36.000', '0.000', '6.840', '42.840', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(24, 'SERRE-CABLE', 'Serre Cable', '2', '11.500', '19', 'pourcentage', NULL, '0', '23.000', '0.000', '4.370', '27.370', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(25, 'BOUCHE-MODULE', 'Bouche module ', '45', '1.270', '19', 'pourcentage', NULL, '0', '57.150', '0.000', '10.858', '68.008', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(26, 'MO', 'Main d\'oeuvre', '15', '38', '19', 'pourcentage', NULL, '0', '570.000', '0.000', '108.300', '678.300', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(27, 'Swit24POE', 'Switch Rackable 19\" TP-Link 24 ports PoE+\n10/100Mbps, 4 Ports RJ45\nGiga et 2× Combo Gigabit SFP Slots, capacité de\nswitching 8,8Gbps,\n250W', '2', '1327', '19', 'pourcentage', NULL, '0', '2654.000', '0.000', '504.260', '3158.260', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(28, 'PLA17', 'PLAteau pour armoire 6 U', '2', '24', '19', 'pourcentage', NULL, '0', '48.000', '0.000', '9.120', '57.120', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(29, 'PANBRAS', 'Panneau de brassage equippé', '2', '224', '19', 'pourcentage', NULL, '0', '448.000', '0.000', '85.120', '533.120', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(30, 'MPRISE', 'Multiprise 8 Prises Rackable 1U 19\"', '2', '91', '19', 'pourcentage', NULL, '0', '182.000', '0.000', '34.580', '216.580', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(31, 'GCAB', 'Guide cable', '2', '27.500', '19', 'pourcentage', NULL, '0', '55.000', '0.000', '10.450', '65.450', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(32, 'PriseRJ45', 'PRise RJ45 apparant', '40', '17.650', '19', 'pourcentage', NULL, '0', '706.000', '0.000', '134.140', '840.140', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(33, 'PRJ45', 'Patch cable RJ 45 0.5m', '40', '3.750', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(34, 'CableFTP6', 'Bobine cable FTP CAT 6 305m', '4', '292.835', '19', 'pourcentage', NULL, '0', '1171.340', '0.000', '222.555', '1393.895', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(35, 'MO', 'Main d\'ouvre par prise', '56', '38', '19', 'pourcentage', NULL, '0', '2128.000', '0.000', '404.320', '2532.320', '14', '2023-01-23 09:41:04', '2023-01-30 09:24:54'),
(37, 'PC-LENOVO', 'TB 15-ITL,i5-1135G7,8GB Base DDR4,1TB 5400rpm,Disque dur SSD NVMe 500Go,nVidia MX450 2GB, No OS,15.6\" FHD IPS 300nits,720p HD Cam,Wi-fi AX 2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C 3PIN-EU,KB French', '1', '2350', '7', 'pourcentage', NULL, '0', '2350.000', '0.000', '164.500', '2514.500', '15', '2023-01-23 09:57:24', '2023-01-30 09:24:35'),
(38, 'INFO-G', 'Infogérance pour le mois de Janvier', '1', '400', '19', 'pourcentage', NULL, '0', '400.000', '0.000', '76.000', '476.000', '16', '2023-01-23 10:30:02', '2023-01-23 10:30:02'),
(39, 'INFO-G', 'Infogérance pour le mois de Janvier', '1', '200', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '17', '2023-01-23 10:33:53', '2023-01-23 10:33:53'),
(40, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '300.000', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '18', '2023-01-23 11:10:47', '2023-01-23 11:10:47'),
(41, 'INFO-G', 'Infogérance pour le mois  de Janvier', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '19', '2023-01-24 09:11:35', '2023-01-24 09:11:35'),
(42, 'OFFICE-365', 'licences office 365 business standard', '4', '540.000', '19', 'pourcentage', NULL, '0', '2160.000', '0.000', '410.400', '2570.400', '20', '2023-01-24 09:15:33', '2023-01-30 09:24:20'),
(43, 'SSD-NVMe', 'Disque dur SSD NVMe 500Go', '1', '250.000', '7', 'pourcentage', NULL, '0', '250.000', '0.000', '17.500', '267.500', '21', '2023-01-24 13:42:47', '2023-01-24 13:42:47'),
(44, 'Migration données', ' Migration données ', '1', '100', '19', 'pourcentage', NULL, '0', '100.000', '0.000', '19.000', '119.000', '21', '2023-01-24 13:42:47', '2023-01-24 13:42:47'),
(45, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '22', '2023-01-26 07:05:02', '2023-01-30 09:24:04'),
(47, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '24', '2023-01-26 07:12:44', '2023-01-30 09:23:30'),
(48, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '26', '2023-01-26 09:55:35', '2023-01-30 09:23:16'),
(49, 'INFO-G', 'Infogérance pour le mois de  Janvier ', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '27', '2023-01-26 10:00:51', '2023-01-30 08:32:29'),
(53, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '350.000', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '31', '2023-01-26 13:03:33', '2023-01-26 13:03:33'),
(54, 'INFO-G', 'Infogérance pour le mois de Janvier ', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '32', '2023-01-26 14:18:52', '2023-01-30 09:22:59'),
(58, 'SSD-SATA', 'Disque dur SATA SSD 500Go', '2', '150.000', '7', 'pourcentage', NULL, '0', '300.000', '0.000', '21.000', '321.000', '39', '2023-01-27 15:14:03', '2023-01-27 15:14:03'),
(59, 'INST-MO', 'Installation et main d\'œuvre', '2', '100.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '39', '2023-01-27 15:14:03', '2023-01-27 15:14:03'),
(60, '4GO-DDR3', 'Barette mémoire 4Go DDR3 1600Mhz  ', '1', '100.000', '7', 'pourcentage', NULL, '0', '100.000', '0.000', '7.000', '107.000', '27', '2023-01-30 08:32:29', '2023-01-30 08:32:29'),
(61, 'HP-106A', 'Cartouche imprimante HP 106A', '2', '130.000', '19', 'pourcentage', NULL, '0', '260.000', '0.000', '49.400', '309.400', '43', '2023-01-30 13:06:10', '2023-01-30 13:06:10'),
(62, 'TL-EAP225', 'Point d\'acces  double bande TP LINK EAP225', '5', '310.000', '19', 'pourcentage', NULL, '0', '1550.000', '0.000', '294.500', '1844.500', '44', '2023-02-07 08:19:06', '2023-02-07 08:19:06'),
(63, 'LAT-5430-I7', 'PC PORTABLE LATITUDE 5430, Ecran 14\",\nProcesseur Intel Core Ci7-1255U up to 4.70GHz,\nMémoire 24Go, Disque Dur SSD 512Go, Wifi, 1\nan garantie', '1', '3995', '7', 'pourcentage', NULL, '0', '3995.000', '0.000', '279.650', '4274.650', '45', '2023-02-07 09:30:21', '2023-02-07 13:39:20'),
(64, 'V15-ITL-I5', 'PC PORTABLE LENOVO V15-ITL, Ecran 15.6\",\nProcesseur Intel Core\ni5-1135G7, Mémoire 12 Go, Disque Dur SSD\n512Go, HDMI, RJ45, Wifi, 1 an garantie', '1', '1945', '7', 'pourcentage', NULL, '0', '1945.000', '0.000', '136.150', '2081.150', '45', '2023-02-07 09:30:21', '2023-02-07 13:39:20'),
(65, 'IMPRIMANTE-ZEBRA-ZD220', 'PRINTER ZD220 TT STANDARD EZPL..\nUSB', '1', '984', '0', 'pourcentage', NULL, '0', '984.000', '0.000', '0.000', '984.000', '46', '2023-02-09 14:48:52', '2023-02-09 14:48:52'),
(66, '82KB00SJFE ', 'V15-ITL , i5-1135G7 , 4GB Base  DDR4 ,1TB \n5400rpm, integrated , 15.6 fhd tn ', '1', '1390.000', '7', 'pourcentage', NULL, '0', '1390.000', '0.000', '97.300', '1487.300', '48', '2023-02-10 15:36:09', '2023-02-10 15:36:09'),
(67, 'MS KLQ-00667 ', 'M365 Bus S tandars Retail French Subscr 1YR Africa ', '1', '509.000', '19', 'pourcentage', NULL, '0', '509.000', '0.000', '96.710', '605.710', '49', '2023-02-13 08:26:46', '2023-02-13 08:27:08'),
(68, 'MS KLOQ-00667 ', 'M365 Bus Standard Retail French Subscr 1YR Africa ', '3', '509.000', '19', 'pourcentage', NULL, '0', '1527.000', '0.000', '290.130', '1817.130', '49', '2023-02-13 08:26:46', '2023-02-13 08:27:08'),
(69, 'UPOL-OL300EP-CG01B ', 'UPS ON-LINE 3000VA ', '1', '1749.000', '19', 'pourcentage', NULL, '0', '1749.000', '0.000', '332.310', '2081.310', '50', '2023-02-13 08:40:14', '2023-02-13 08:59:16'),
(70, '20VE00DWFE', 'Think-Book  NBLN TB 15 G2 ITL I5 8G 1T NOS ', '1', '1970.000', '7', 'pourcentage', NULL, '0', '1970.000', '0.000', '137.900', '2107.900', '51', '2023-02-13 09:07:02', '2023-02-13 09:07:02'),
(71, '82KB00SJFE', 'V15-ITL i5-1135G7 4GB Base , DDR4 ,1TB , 5400rpm , Integration 15.6 FHD TN ', '1', '1390.000', '7', 'pourcentage', NULL, '0', '1390.000', '0.000', '97.300', '1487.300', '51', '2023-02-13 09:07:02', '2023-02-13 09:07:02'),
(72, 'ONDULEUR-ECHO-PRO', 'Onduleur on-line njoy echo pro, 3000VA/2400W, Autonomie 50%, 4 x Schuko, Tour, HID USB / RS232, SNMP: Optional, Auto-Restart, Niveau Sonore <40dB, LCD', '1', '1928', '19', 'pourcentage', NULL, '0', '1928.000', '0.000', '366.320', '2294.320', '52', '2023-02-13 12:52:35', '2023-02-13 12:52:35'),
(73, 'INFO-G ', 'Infogérance pour le mois Février ', '1', '350.000', '0', 'pourcentage', NULL, '0', '350.000', '0.000', '0.000', '350.000', '53', '2023-02-13 15:55:43', '2023-02-14 10:40:00'),
(74, 'INTERVENTION ', 'Intervention le 25 Janvier', '6', '90.000', '19', 'pourcentage', NULL, '0', '540.000', '0.000', '102.600', '642.600', '55', '2023-02-16 13:11:07', '2023-02-16 13:11:07'),
(75, 'INTERVENTION ', 'Intervention le 26 Janvier', '2', '90.000', '19', 'pourcentage', NULL, '0', '180.000', '0.000', '34.200', '214.200', '55', '2023-02-16 13:11:07', '2023-02-16 13:11:07'),
(76, 'INTERVENTION ', 'Intervention le 2 Fevrier', '1', '90.000', '19', 'pourcentage', NULL, '0', '90.000', '0.000', '17.100', '107.100', '55', '2023-02-16 13:11:07', '2023-02-16 13:11:07'),
(77, 'INTERVENTION ', 'Intervention le 9 Fevrier ', '3', '90.000', '19', 'pourcentage', NULL, '0', '270.000', '0.000', '51.300', '321.300', '55', '2023-02-16 13:11:07', '2023-02-16 13:11:07'),
(78, 'FORMATAGE ', 'Formatage et installation système pour 2 desktop   ', '2', '90.000', '19', 'pourcentage', NULL, '0', '180.000', '0.000', '34.200', '214.200', '55', '2023-02-16 13:11:07', '2023-02-16 13:11:07'),
(79, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '56', '2023-02-22 10:46:20', '2023-02-22 10:46:20'),
(80, 'LAT-5430I7', 'PC PORTABLE LATITUDE 5430, Ecran 14\",\nProcesseur Intel Core Ci7-1255U up to\n4.70GHz, Mémoire 16Go, Disque Dur SSD\n512Go, Wifi.', '1', '3915', '7', 'pourcentage', NULL, '0', '3915.000', '0.000', '274.050', '4189.050', '57', '2023-02-22 10:54:04', '2023-02-24 09:36:30'),
(81, 'INFO-G ', 'Infogérance pour le mois de Février ', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '58', '2023-02-22 12:27:56', '2023-02-22 12:27:56'),
(82, 'ESET-INT', 'Eset internet Security (AMT Sfax) ', '2', '53.000', '19', 'pourcentage', NULL, '0', '106.000', '0.000', '20.140', '126.140', '59', '2023-02-22 12:39:19', '2023-03-06 10:44:09'),
(83, 'INTERVENTION  ', 'Intervention1:\n- Réglage problème Outlook pour Manel\n- Formatage et installation Système pour Oumaima ainsi que la connexion au domaine, migration de tout les données.\n- Installation et configuration (Office, Outlook, Google Drive, Sage Commercial, Sage Comptabilité, Sage Paie) et installation imprimante et scanner.', '1', '350.000', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '59', '2023-02-22 12:39:19', '2023-03-06 10:44:09'),
(84, 'INTERVENTION ', 'Intervention2:\nConfiguration et installation VPN pour Manel AMT Sfax.\n- Installation ESET Antivirus pour Manel et Anis.\n- Connexion PC de Manel au domaine et création session domaine ainsi que la migration des données sur la nouvelle session.', '1', '350.000', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '59', '2023-02-22 12:39:19', '2023-03-06 10:44:09'),
(85, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '400.000', '19', 'pourcentage', NULL, '0', '400.000', '0.000', '76.000', '476.000', '60', '2023-02-22 13:39:52', '2023-02-22 13:39:52'),
(86, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '200.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '61', '2023-02-22 14:56:13', '2023-02-22 14:56:13'),
(87, 'ESET', 'Eset Internet Security ', '1', '35.000', '19', 'pourcentage', NULL, '0', '35.000', '0.000', '6.650', '41.650', '62', '2023-02-22 15:03:42', '2023-02-22 15:03:42'),
(88, 'INTERVENTION ', 'Intervention ', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '62', '2023-02-22 15:03:42', '2023-02-22 15:03:42'),
(89, 'SERVEUR TOUR THINKSYSTEM ST50', 'ST50 Xeon E-2226G (6C 3.4GHz 12MB Cache/80W), SW RAID, 2xS4510 480GB, 2x16GB, 250W, No DVD, ', '1', '5790', '7', 'pourcentage', NULL, '0', '5790.000', '0.000', '405.300', '6195.300', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(92, 'POINT D\'ACCES', 'Point D\'accés TP Link 225', '1', '365', '19', 'pourcentage', NULL, '0', '365.000', '0.000', '69.350', '434.350', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(93, 'AESS-L1', 'ESET Server Security lic pleine 1 an', '1', '445.900', '19', 'pourcentage', NULL, '0', '445.900', '0.000', '84.721', '530.621', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(94, 'LENOVO V50T', 'V50t G2,180W TWR,i3-10100,4GB DDR4,1TB 7200rpm,Integrated,DVD±RW,No OS, , ,RTL8822CE 2x2AC+BT,3-in-1 Card Reader,,Parallel Port,NO_SECOND_REAR_COM_PORT,Internal Speaker,2-in-1 CPU fan,180W,USB CLP FRA,USB, Ecran + Clavier + Souris', '1', '1485', '7', 'pourcentage', NULL, '0', '1485.000', '0.000', '103.950', '1588.950', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(95, 'MO', 'Configuration et Installation', '3', '450', '19', 'pourcentage', NULL, '0', '1350.000', '0.000', '256.500', '1606.500', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(96, 'ONDULEUR NJOY IN LINE ARGUS ', 'ONDULEUR NJOY IN LINE ARGUS, 1200VA/720W, Autonomie\n50%, 4 x IEC, Rack, HID USB /RS232, Auto-\nRestart, <50dB, LCD', '1', '1280', '7', 'pourcentage', NULL, '0', '1280.000', '0.000', '89.600', '1369.600', '63', '2023-02-23 07:37:16', '2023-02-24 08:38:15'),
(97, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '64', '2023-02-23 13:11:14', '2023-02-23 13:11:14'),
(101, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '68', '2023-02-24 15:53:44', '2023-02-24 15:53:44'),
(102, 'INFO-G', 'Infogérance pour le mois de Février ', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '69', '2023-02-24 15:57:28', '2023-02-24 15:57:28'),
(103, 'INFO-G', 'Infogérance pour le mois de Février', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '70', '2023-02-24 16:04:27', '2023-02-24 16:04:27'),
(104, 'INFO-G', 'Infogérance pour le mois de Février', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '71', '2023-02-24 16:06:10', '2023-02-24 16:06:10'),
(105, 'INFO-G ', 'Infogérance pour le mois de Février ', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '72', '2023-02-27 07:00:05', '2023-02-27 07:00:05'),
(107, 'INTERVENTION ', 'Intervention 3 : \n- Configuration et installation VPN pour Anis AMT Sfax.\n- Connexion PC de Anis au domaine et création session domaine ainsi que la migration des données sur la nouvelle session.', '1', '350.000', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '59', '2023-03-02 16:26:20', '2023-03-06 10:44:09'),
(108, 'HP-M404DN', 'Imprimante HP Laser Jet  Pro M404DN \n', '1', '875.000', '0', 'pourcentage', NULL, '0', '875.000', '0.000', '0.000', '875.000', '74', '2023-03-03 11:43:45', '2023-03-03 11:43:45'),
(109, 'TV TCL P735', 'Téléviseur TCL UHD 4K 50\" - Résolution: (3840 X 2160), 60Hz - Dolby Vision - Auto Low Latency Mode ( ALLM) - Haut parleur: 2x 10 W - Dolby Audio - HDR10 - MHL v.3.0 - Smart TV (Netflix - YouTube - Amazon Prime - AppleTV+ - Google Play - Google assistant) - Wifi - Bluetooth 5.0 - USB 3.0 - HDMI 2.1\n\n\n\n\n\n\n', '1', '1225', '19', 'pourcentage', NULL, '0', '1225.000', '0.000', '232.750', '1457.750', '75', '2023-03-03 15:35:49', '2023-03-03 15:35:49'),
(110, 'SUPP-MOB', 'Support mobile pour TV 50\" \n\n\n\n\n\n\n', '1', '961', '19', 'pourcentage', NULL, '0', '961.000', '0.000', '182.590', '1143.590', '75', '2023-03-03 15:35:49', '2023-03-03 15:35:49'),
(111, 'MO', 'Installation \n\n\n\n\n\n\n', '1', '150', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '75', '2023-03-03 15:35:49', '2023-03-03 15:35:49'),
(112, 'CABLE-HDMI', 'Cable HDMI 10mm\n\n\n\n\n', '1', '45', '19', 'pourcentage', NULL, '0', '45.000', '0.000', '8.550', '53.550', '75', '2023-03-03 15:35:49', '2023-03-03 15:35:49'),
(113, 'PC-V15', 'PC LENOVO V15', '1', '1517.000', '7', 'pourcentage', NULL, '0', '1517.000', '0.000', '106.190', '1623.190', '77', '2023-03-07 08:19:02', '2023-03-23 07:05:55'),
(114, 'W1A53A', 'HP IMPRIMANTE LASERJET PRO M404DN \nMONOCHROME GARANTIE 1 AN \nS N ; PHFMG47338', '1', '779.000', '7', 'pourcentage', NULL, '0', '779.000', '0.000', '54.530', '833.530', '78', '2023-03-07 09:21:59', '2023-03-27 07:09:34'),
(122, 'VM', 'Machine virtuel windows 10 pro Fevrier', '4', '68', '0', 'pourcentage', NULL, '0', '272.000', '0.000', '0.000', '272.000', '86', '2023-03-08 09:35:43', '2023-03-08 09:35:43'),
(123, 'VIDÉO-PROJECTEUR-EPSON', 'EH-TW750 3300 Lumens FULL HD,WIFI,1920 x 1080, USB 2.0-A, USB 2.0, Entrée VGA,\nEntrée HDMI (2x), Miracast, Prise jack de sortie\n\n\n\n\n\n', '1', '2139', '7', 'pourcentage', NULL, '0', '2139.000', '0.000', '149.730', '2288.730', '87', '2023-03-09 07:50:51', '2023-03-09 07:55:41'),
(124, 'LASER-ECRAN', 'Pointeuse Laser et Ecran de projection\n\n', '1', '475', '19', 'pourcentage', NULL, '0', '475.000', '0.000', '90.250', '565.250', '87', '2023-03-09 07:50:51', '2023-03-09 07:55:41'),
(127, 'BOBINE-40 MM*20MM', 'Bobine de 1000 étiquettes en papier blanc mat 40MM*20MM', '60', '5.750', '19', 'pourcentage', NULL, '0', '345.000', '0.000', '65.550', '410.550', '90', '2023-03-13 13:54:50', '2023-03-13 13:54:50'),
(128, 'MIse en place des prises réseaux informatiques ', 'Mise en place des prises réseaux Informatiques', '8', '230.000', '19', 'pourcentage', NULL, '0', '1840.000', '0.000', '349.600', '2189.600', '91', '2023-03-15 13:14:13', '2023-03-15 13:20:09'),
(129, 'SSD SATA  ', 'Disque Dur SSD SATA 512Go', '2', '150.000', '7', 'pourcentage', NULL, '0', '300.000', '0.000', '21.000', '321.000', '94', '2023-03-21 12:42:52', '2023-03-21 14:57:01'),
(130, 'SSD NVMe ', 'Disque Dur SSD NVMe 512Go', '1', '250.000', '7', 'pourcentage', NULL, '0', '250.000', '0.000', '17.500', '267.500', '94', '2023-03-21 12:42:52', '2023-03-21 14:57:01'),
(131, 'CABLE-SATA', 'Câble SATA pour Disque Dur', '2', '4', '19', 'pourcentage', NULL, '0', '8.000', '0.000', '1.520', '9.520', '94', '2023-03-21 12:42:52', '2023-03-21 14:57:01'),
(132, 'CABLE-ALIM', 'Cable Alimentation pour Laptop', '1', '5', '19', 'pourcentage', NULL, '0', '5.000', '0.000', '0.950', '5.950', '94', '2023-03-21 14:57:01', '2023-03-21 14:57:01'),
(133, 'INST-CONF', 'Installation et configuration Disque dur NVME', '1', '250', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '94', '2023-03-21 14:57:01', '2023-03-21 14:57:01'),
(134, 'INFO-G', 'Infogérance pour le mois  mars', '1', '750', '19', 'pourcentage', NULL, '0', '750.000', '0.000', '142.500', '892.500', '95', '2023-03-22 07:07:33', '2023-03-23 12:32:50'),
(135, ' LENOVO-I3', 'V15-ITL,Intel Core i3-1115G4 (2C / 4T, 3.0 / 4.1GHz, 6MB),4GB Base DDR4,256GB SSD M.2 2242 NVMe,Integrated,No OS,15.6\" FHD TN,1MP HD Cam,Wi-fi AC 2x2+BT,N-FPR,2 Cell 38Whr,65W WM-2PIN-EU,KB French, 1 Year Carry-in Topload Case', '1', '1171.750', '0', 'pourcentage', NULL, '0', '1171.750', '0.000', '0.000', '1171.750', '96', '2023-03-22 09:48:45', '2023-03-23 07:53:06'),
(136, 'ESET-NOD32 ', 'ESET NOD32 \nanti-virus , internet sécurité', '1', '32.000', '0', 'pourcentage', NULL, '0', '32.000', '0.000', '0.000', '32.000', '96', '2023-03-22 09:48:45', '2023-03-23 07:53:06'),
(137, 'SSD-DATO', 'Disque dur SSD DATO 512GB', '1', '150.000', '7', 'pourcentage', NULL, '0', '150.000', '0.000', '10.500', '160.500', '97', '2023-03-22 14:40:09', '2023-03-22 14:40:09'),
(138, 'MO', 'Main d\'œuvre', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '97', '2023-03-22 14:40:09', '2023-03-22 14:40:09'),
(139, 'SSD SATA ', 'Disque Dur SSD SATA 512Go', '1', '150.000', '7', 'pourcentage', NULL, '0', '150.000', '0.000', '10.500', '160.500', '98', '2023-03-22 15:18:47', '2023-03-22 15:26:47'),
(140, 'CLAVIER MACRO', 'Clavier Multimédia MACRO', '1', '16.500', '7', 'pourcentage', NULL, '0', '16.500', '0.000', '1.155', '17.655', '98', '2023-03-22 15:18:47', '2023-03-22 15:26:47'),
(141, 'USB-SPIDER', 'Souris Optique USB SPIDER', '1', '11.500', '7', 'pourcentage', NULL, '0', '11.500', '0.000', '0.805', '12.305', '98', '2023-03-22 15:18:47', '2023-03-22 15:26:47'),
(142, 'RJ45', 'Cable Réseau RJ45 1.5m', '1', '4.500', '19', 'pourcentage', NULL, '0', '4.500', '0.000', '0.855', '5.355', '98', '2023-03-22 15:18:47', '2023-03-22 15:26:47'),
(143, 'INFO-G', 'Infogérance pour le mois mars', '1', '700.000', '19', 'pourcentage', NULL, '0', '700.000', '0.000', '133.000', '833.000', '99', '2023-03-22 15:22:16', '2023-03-23 12:33:32'),
(144, 'ECR', 'Ecran Samsung 24\" CURVED', '1', '467.300', '7', 'pourcentage', NULL, '0', '467.300', '0.000', '32.711', '500.011', '77', '2023-03-23 07:05:55', '2023-03-23 07:05:55'),
(145, 'BARETTE-8GO ', 'Barette RAM 8GO DDR4 2666MHZ', '1', '150.000', '0', 'pourcentage', NULL, '0', '150.000', '0.000', '0.000', '150.000', '96', '2023-03-23 07:53:06', '2023-03-23 07:53:06'),
(146, 'SITE WEB + CHARTE GRAPHIQUE ', 'Site web et charte Graphique( logo carte visite et papier en tête)', '1', '1450.000', '19', 'pourcentage', NULL, '0', '1450.000', '0.000', '275.500', '1725.500', '100', '2023-03-23 10:09:23', '2023-03-27 12:31:59'),
(147, 'VM', 'VM mois mars', '1', '200.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '100', '2023-03-23 10:09:23', '2023-03-27 12:31:59'),
(148, 'PC-LENOVO', 'TB 15-ITL,i5-1135G7,8GB Base DDR4,1TB\n5400rpm,Disque dur SSD NVMe\n500Go,nVidia MX450 2GB, No OS,15.6\" FHD\nIPS 300nits,720p HD Cam,Wi-fi AX\n2x2+BT,Y-FPR,3 Cell 45Whr,65W USB-C\n3PIN-EU,KB French', '1', '2350', '7', 'pourcentage', NULL, '0', '2350.000', '0.000', '164.500', '2514.500', '101', '2023-03-23 12:08:28', '2023-04-27 10:47:02'),
(149, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Haut-parleurs, Inclinable/Ajustable en hauteur/Pivotable', '3', '585', '7', 'pourcentage', NULL, '0', '1755.000', '0.000', '122.850', '1877.850', '101', '2023-03-23 12:08:28', '2023-04-27 10:47:02'),
(150, 'SSD-SATA', 'Disque Dur SSD SATA 512Go', '2', '150', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '101', '2023-03-23 12:08:28', '2023-04-27 10:47:02'),
(151, 'CABLE-SATA', 'Cable SATA', '1', '3.500', '19', 'pourcentage', NULL, '0', '3.500', '0.000', '0.665', '4.165', '101', '2023-03-23 12:08:28', '2023-04-27 10:47:02'),
(152, 'FG-40F', 'FORTINET FortiGate FG-40F', '1', '2475', '19', 'pourcentage', NULL, '0', '2475.000', '0.000', '470.250', '2945.250', '102', '2023-03-23 12:11:43', '2023-04-27 10:47:17'),
(153, 'LIC-FG-40F ', 'Licence FORTINET FortiGate FG-40F', '1', '1325', '19', 'pourcentage', NULL, '0', '1325.000', '0.000', '251.750', '1576.750', '102', '2023-03-23 12:11:43', '2023-04-27 10:47:17'),
(154, 'MO', 'Configuration et Installation', '3', '600', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '102', '2023-03-23 12:11:43', '2023-04-27 10:47:17'),
(155, 'INFO-G', 'Infogérance pour le mois  mars', '1', '200.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '103', '2023-03-24 10:05:39', '2023-03-27 11:20:21'),
(156, 'INFO-G', 'Infogérance pour le mois  mars', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '104', '2023-03-24 10:08:36', '2023-03-24 10:08:36'),
(158, 'INFO-G ', 'Infogérance pour le mois mars', '1', '250', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '105', '2023-03-27 08:03:41', '2023-03-27 08:03:41'),
(159, 'VM', 'VM 3 mois (Janvier , Février et Mars)', '3', '200.00', '19', 'pourcentage', NULL, '0', '600.000', '0.000', '114.000', '714.000', '106', '2023-03-27 08:13:05', '2023-03-28 07:46:32'),
(160, 'INFO-G', 'Infogérance pour le mois mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '107', '2023-03-27 08:17:53', '2023-03-27 08:17:53'),
(161, 'INFO-G', 'Infogérance pour le mois mars', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '108', '2023-03-27 08:56:13', '2023-03-27 08:56:13'),
(162, 'INFO-G', 'Infogérance pour le mois mars', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '109', '2023-03-27 08:57:14', '2023-03-27 08:57:14'),
(163, 'INFO-G', 'Infogérance pour le mois mars', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '110', '2023-03-27 08:57:59', '2023-03-27 08:57:59'),
(165, 'INFO-G', 'Infogérance pour le mois mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '112', '2023-03-27 09:01:16', '2023-03-27 09:01:16'),
(166, 'CLASSICO ', 'NERONOBLIE BOITE DE 10 CAPSULE (50% ROBUSTA 50% ARABIC) COMP NESPRESS', '1', '9.900', '19', 'pourcentage', NULL, '0', '9.900', '0.000', '1.881', '11.781', '113', '2023-03-28 10:15:45', '2023-03-28 10:15:45'),
(167, 'QUALITA-ORO', 'NERONOBLIE BOITE DE 10 CAPSULE (80% ROBUSTA 20% ARABIC) COMP NESPRESS', '1', '9.900', '19', 'pourcentage', NULL, '0', '9.900', '0.000', '1.881', '11.781', '113', '2023-03-28 10:15:45', '2023-03-28 10:15:45'),
(168, '861916-5430', 'LAT 5430-N BTX 14\" CI7-1255U 10C 4.7GHz 16GB 512GB WIFIBT LX 1Y', '1', '3240.000', '7', 'pourcentage', NULL, '0', '3240.000', '0.000', '226.800', '3466.800', '114', '2023-03-28 10:34:19', '2023-03-28 10:34:19'),
(169, 'CROSE ', 'CAFE ROVI CARTON DE 10 CAPSULES NESPRESSO (10 CAPSULES ) CORSE INTENSITE 10', '2', '7.900', '19', 'pourcentage', NULL, '0', '15.800', '0.000', '3.002', '18.802', '115', '2023-03-28 10:36:51', '2023-03-28 10:36:51'),
(170, '7Y48A03YEA', 'Think-system st50 SERVER (5E-2200)', '1', '3999.000', '7', 'pourcentage', NULL, '0', '3999.000', '0.000', '279.930', '4278.930', '116', '2023-03-28 10:45:21', '2023-03-28 10:45:21'),
(171, '7Y48A03YEA', 'Think-System ST50 Server (E-2200)', '1', '3999.000', '7', 'pourcentage', NULL, '0', '3999.000', '0.000', '279.930', '4278.930', '117', '2023-03-28 10:56:17', '2023-03-28 10:56:17'),
(172, 'UPOL-OL100EP-CG01B', 'UPS ON-LINE 1000 VA', '1', '849.000', '19', 'pourcentage', NULL, '0', '849.000', '0.000', '161.310', '1010.310', '118', '2023-03-28 11:03:46', '2023-03-28 11:18:54'),
(173, 'AEEPA-U1', 'ESET Protect Entry OP Lic Upg 1an \nClinique IBN KHALDOUN / Clinique IBN KHALDOUN', '64', '37.500', '19', 'pourcentage', NULL, '0', '2400.000', '0.000', '456.000', '2856.000', '119', '2023-03-28 11:44:49', '2023-03-28 12:30:26'),
(174, 'RAM-8Go-DDR4', 'Barrette mémoire 8Go DDR4 2666MHz', '2', '150.000', '7', 'pourcentage', NULL, '0', '300.000', '0.000', '21.000', '321.000', '120', '2023-03-28 12:48:48', '2023-03-28 12:48:48'),
(175, 'SSD-SATA-512Go', 'Disque dur SSD Sata 512Go', '1', '150.000', '7', 'pourcentage', NULL, '0', '150.000', '0.000', '10.500', '160.500', '120', '2023-03-28 12:48:48', '2023-03-28 12:48:48'),
(176, 'DDR4-8GO', 'Barrette Mémoire 8Go DDR4 2666MHz', '1', '150.000', '7', 'pourcentage', NULL, '0', '150.000', '0.000', '10.500', '160.500', '121', '2023-03-29 11:17:26', '2023-03-29 11:35:34'),
(177, 'ESET-OP', 'ESET Protect Entry OP Lic Pleine 1 an', '14', '82', '19', 'pourcentage', NULL, '0', '1148.000', '0.000', '218.120', '1366.120', '122', '2023-03-29 11:18:03', '2023-04-27 10:46:43'),
(178, 'INTERVENTION \"GEI\" MENZAH', 'Interventions pour le site de GEI El Manzah \n\n- Intervention le 06/03/2023.\n\n- Intervention le 27/03/2023', '1', '400.000', '19', 'pourcentage', NULL, '0', '400.000', '0.000', '76.000', '476.000', '123', '2023-03-29 11:19:47', '2023-03-29 11:20:58'),
(179, 'VM', 'Machine virtuel Windows 10', '4', '68.000', '0', 'pourcentage', NULL, '0', '272.000', '0.000', '0.000', '272.000', '125', '2023-03-29 11:25:52', '2023-03-29 12:52:56'),
(180, 'SITE WEB', 'Création d\'un Site Web', '1', '530.000', '0', 'pourcentage', NULL, '0', '530.000', '0.000', '0.000', '530.000', '126', '2023-03-29 11:59:17', '2023-03-29 11:59:59'),
(181, 'INTERVENTION ', 'Intervention le 24/03/2023 à la maison de Mr Abdelmajid', '1', '300.000', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '127', '2023-03-30 08:13:46', '2023-03-30 08:13:46'),
(182, 'ECRAN-PC', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Hautparleurs,\nInclinable/Ajustable\nen\nhauteur/Pivotable)', '1', '585.000', '7', 'pourcentage', NULL, '0', '585.000', '0.000', '40.950', '625.950', '128', '2023-03-30 08:17:10', '2023-03-30 08:17:10'),
(183, 'DS', 'Dockstation d\'accueil EU ,1 x 3.5 mm audio male,\n1 x USB 2.0 Type-A, 1 x USB 3.1 Type-A, 1 x USB\n3.1 Type-C, 1 x RJ45, 1 x VGA x HDMI', '1', '485.000', '19', 'pourcentage', NULL, '0', '485.000', '0.000', '92.150', '577.150', '128', '2023-03-30 08:17:10', '2023-03-30 08:17:10'),
(184, 'DISQUE-DUR', 'Disque Dur Externe 2TB', '1', '250', '7', 'pourcentage', NULL, '0', '250.000', '0.000', '17.500', '267.500', '129', '2023-03-31 09:23:45', '2023-03-31 09:23:55'),
(185, 'ESET-DESK', 'ESET Internet Security', '5', '38', '19', 'pourcentage', NULL, '0', '190.000', '0.000', '36.100', '226.100', '129', '2023-03-31 09:23:45', '2023-03-31 09:23:55'),
(186, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS,\n60Hz 4ms, HDMI VGA DP, Haut-parleurs,\nInclinable/Ajustable en hauteur/Pivotable', '1', '585', '7', 'pourcentage', NULL, '10', '585.000', '58.500', '36.855', '563.355', '130', '2023-03-31 10:21:18', '2023-03-31 10:47:50'),
(187, 'DS', 'Dockstation d\'accueil EU ,1 x 3.5 mm audio\nmale, 1 x USB 2.0 Type-A, 1 x USB 3.1 TypeA, 1 x USB 3.1 Type-C, 1 x RJ45, 1 x VGA\nx\nHDMI', '1', '485', '7', 'pourcentage', NULL, '10', '485.000', '48.500', '30.555', '467.055', '130', '2023-03-31 10:21:18', '2023-03-31 10:47:50'),
(188, '82KB00SJFE', 'V15-ITL , i5-1135G7 , 4GB Base DDR4 ,1TB', '2', '1280.000', '7', 'pourcentage', NULL, '0', '2560.000', '0.000', '179.200', '2739.200', '131', '2023-03-31 11:04:12', '2023-03-31 11:04:12'),
(189, '40AU0065EU', 'Lenovo USB-C Mini Dock-EU', '1', '370.000', '7', 'pourcentage', NULL, '0', '370.000', '0.000', '25.900', '395.900', '131', '2023-03-31 11:04:12', '2023-03-31 11:04:12'),
(190, '62B6MAT3EU ', 'E24-28 \n23.8\"Monotor , IPSpanel , 1920w1080 , Input connectors VGA+DP 1.2', '1', '475.000', '7', 'pourcentage', NULL, '0', '475.000', '0.000', '33.250', '508.250', '131', '2023-03-31 11:04:12', '2023-03-31 11:04:12'),
(191, 'F081051', 'HDD EXT SP A66 2TB ANTI-CHOCK WATER PROOF BLLACK \nUSB 3.2 GEN1', '1', '199.00', '7', 'pourcentage', NULL, '0', '199.000', '0.000', '13.930', '212.930', '132', '2023-03-31 11:12:15', '2023-03-31 11:12:15'),
(192, 'F080202', 'DISQUE DUR 500GO 3.5/ SEGATE \n5VV1ZGZ', '1', '32.900', '7', 'pourcentage', NULL, '0', '32.900', '0.000', '2.303', '35.203', '132', '2023-03-31 11:12:15', '2023-03-31 11:12:15'),
(193, 'KIT DIS', 'KIT DIS GOLF 5 1.4', '1', '428.812', '19', 'pourcentage', NULL, '0', '428.812', '0.000', '81.474', '510.286', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(194, 'FILTRE ESS ', 'FILTRE ESS POLO 6/7 4B', '1', '67.335', '19', 'pourcentage', NULL, '0', '67.335', '0.000', '12.794', '80.129', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(195, 'FILTRE A HUILE ', 'FILTRE A HUILE VOLKSWAGEN 1.4-1.6', '1', '11.410', '19', 'pourcentage', NULL, '0', '11.410', '0.000', '2.168', '13.578', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(196, 'BOUG ALLU ', 'BOUG ALLU HOLF 5 6 POLO 7', '4', '26.704', '19', 'pourcentage', NULL, '0', '106.816', '0.000', '20.295', '127.111', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(197, 'GRI GOLF 6 ', 'GRI P/CHOC GOLF 6 AV G +ANT', '1', '30.206', '19', 'pourcentage', NULL, '0', '30.206', '0.000', '5.739', '35.945', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(198, 'FEU GOLF6  ', 'FEU ANT GOLF 6 G', '1', '65.176', '19', 'pourcentage', NULL, '0', '65.176', '0.000', '12.383', '77.559', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(199, 'HUILE 10W40', 'HUILE 10W40 5L', '1', '90.126', '19', 'pourcentage', NULL, '0', '90.126', '0.000', '17.124', '107.250', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(200, 'POMPE A EAU', 'POMPE A EAU GOLF 4 ESS 1.4', '1', '70.880', '19', 'pourcentage', NULL, '0', '70.880', '0.000', '13.467', '84.347', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(201, 'FILTRE A AIR ', 'FILTRE A AIR GOLF 5 6 POLO SEDAN', '1', '21.098', '19', 'pourcentage', NULL, '0', '21.098', '0.000', '4.009', '25.107', '133', '2023-03-31 11:25:03', '2023-03-31 11:25:03'),
(202, 'SATA ', 'Cable SATA DONNEES POUR DISQUE DUR', '5', '2.000', '19', 'pourcentage', NULL, '0', '10.000', '0.000', '1.900', '11.900', '134', '2023-03-31 11:31:23', '2023-03-31 11:31:23'),
(203, 'F080358', 'SSD 512GB DS700 RW (530/510) \nWBI70297664', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '93', '2023-03-31 11:39:04', '2023-03-31 12:00:05'),
(204, 'F080358', 'SSD 512GB DS700 RW (530/510) \nWBI70297663', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '93', '2023-03-31 11:39:04', '2023-03-31 12:00:05'),
(205, 'F080358', 'SSD 512GB DS700 RW(530/510) \nWBI70297746', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '93', '2023-03-31 11:39:04', '2023-03-31 12:00:05'),
(206, 'F080358', 'SSD 512GB DS700 RW5(530/510) RW5530/510) \nWBI70297778', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '93', '2023-03-31 11:39:04', '2023-03-31 12:00:05'),
(207, 'F080358', 'SSD 512GB DS 700 RW(530/510)\nWBI70297777', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '93', '2023-03-31 11:39:04', '2023-03-31 12:00:05'),
(208, 'F080358', 'SSD 512GB DS700 RW(530/510) \nWBI70297853', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '135', '2023-03-31 11:59:40', '2023-03-31 11:59:40'),
(209, 'F080358', 'SSD 512GB DS700 RW(530/510) \nWBI70297854', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '135', '2023-03-31 11:59:40', '2023-03-31 11:59:40'),
(210, 'F080358', 'SSD 512GB DS700 RW(530/510) \nWBI70297855', '1', '72.000', '7', 'pourcentage', NULL, '0', '72.000', '0.000', '5.040', '77.040', '135', '2023-03-31 11:59:40', '2023-03-31 11:59:40'),
(211, 'F110106', 'CLAVIER USB MACRO SIMPLE K747474', '5', '8.990', '7', 'pourcentage', NULL, '0', '44.950', '0.000', '3.147', '48.097', '135', '2023-03-31 11:59:40', '2023-03-31 11:59:40'),
(212, 'F110104', 'SOURIS USB MACRO 555/PUEPLZ', '5', '6.900', '7', 'pourcentage', NULL, '0', '34.500', '0.000', '2.415', '36.915', '135', '2023-03-31 11:59:40', '2023-03-31 11:59:40'),
(213, 'EP V11H980040', 'VIDEO PROJETEUR EH-TW750 FULL HD 3300 L WIFI', '1', '1880.000', '7', 'pourcentage', NULL, '0', '1880.000', '0.000', '131.600', '2011.600', '136', '2023-03-31 12:04:46', '2023-03-31 12:06:11'),
(214, '029000072', 'LED TCL 50P635 UHD GOOGLE TV', '1', '1200.000', '19', 'pourcentage', NULL, '0', '1200.000', '0.000', '228.000', '1428.000', '137', '2023-03-31 12:12:37', '2023-03-31 12:12:37'),
(215, '16G-DDR4-2', 'BARRETTE MEMOIRE SERVEUR 16G DDR4 2666E', '1', '650.500', '7', 'pourcentage', NULL, '0', '650.500', '0.000', '45.535', '696.035', '138', '2023-03-31 12:14:38', '2023-03-31 12:21:03'),
(216, '82KB00SJFE ', 'V15-ITL , i5-1135G7 , 4GB Base DDR4 , 1TB \n5400 RPM , INTEGRATED , 15.5 FHD TN', '1', '1390.000', '7', 'pourcentage', NULL, '0', '1390.000', '0.000', '97.300', '1487.300', '139', '2023-03-31 12:39:41', '2023-03-31 12:39:41'),
(217, 'SP008GBLFU266X02', 'DDR4-2666 CL  19 UDTMM 8GB*1 COMBO', '4', '79.000', '7', 'pourcentage', NULL, '0', '316.000', '0.000', '22.120', '338.120', '140', '2023-03-31 12:47:56', '2023-03-31 12:47:56'),
(218, '82kb00yxfe', 'V15-ITL , i3-1115G4 , 4GB Base DDR4 , 256GB SSD M.2 2242 NVMe', '1', '950.000', '7', 'pourcentage', NULL, '0', '950.000', '0.000', '66.500', '1016.500', '140', '2023-03-31 12:47:56', '2023-03-31 12:47:56'),
(219, '20VE00DWFE', 'Thinkbook NBLN TB 15G2 ITL i5 8G 1T NOS', '1', '1970.000', '7', 'pourcentage', NULL, '0', '1970.000', '0.000', '137.900', '2107.900', '140', '2023-03-31 12:47:56', '2023-03-31 12:47:56'),
(220, '62B6MAT3EU', 'E24-28 , 23.8 MONITOR , IPSpanel , 1920W1080 , Input connectors-VGA+DP 1.2', '3', '75.000', '7', 'pourcentage', NULL, '0', '225.000', '0.000', '15.750', '240.750', '140', '2023-03-31 12:47:56', '2023-03-31 12:47:56'),
(221, 'RJ45  UTP CAT6 ', 'NOYAU RJ45  UTP CAT6 WT', '12', '6.500', '19', 'pourcentage', NULL, '0', '78.000', '0.000', '14.820', '92.820', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(222, 'PLAQUE AVEC PLASTRON 45*45 WT ', 'PLAQUE AVEC PLASTRON 45*45 WT', '1', '5.500', '19', 'pourcentage', NULL, '0', '5.500', '0.000', '1.045', '6.545', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(223, 'BOITE APPARENTE SIMPLE AVEC PLASTRON 45*45 ', 'BOITE APPARENTE SIMPLE AVEC PLASTRON 45*45', '7', '6.500', '19', 'pourcentage', NULL, '0', '45.500', '0.000', '8.645', '54.145', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(224, 'RJ45 UTP CAT6 LONG', 'CORDON SURMOULE RJ45 UTP CAT6 LONG 0M50 WT', '10', '2.600', '19', 'pourcentage', NULL, '0', '26.000', '0.000', '4.940', '30.940', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(225, 'RJ45 UTP LONG ', 'CORDON SURMOULE  RJ45 UTP LONG 1M WT', '5', '3.600', '19', 'pourcentage', NULL, '0', '18.000', '0.000', '3.420', '21.420', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(226, 'RJ45 UTP LONG ', 'CORDON SURMOULE  RJ45 UTP LONG 2M WT', '5', '4.800', '19', 'pourcentage', NULL, '0', '24.000', '0.000', '4.560', '28.560', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(227, 'RJ45 UTP LONG', 'CORDON SURMOULE  RJ45 UTP LONG 3M WT', '5', '6.000', '19', 'pourcentage', NULL, '0', '30.000', '0.000', '5.700', '35.700', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(228, '8 PRISES 2P+T ', 'BANDEAU ELECTRIQUE 8 PRISES 2P+T AVEC INTERRUPTEUR', '4', '75.000', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '141', '2023-03-31 13:06:02', '2023-03-31 13:06:02'),
(229, 'CH106', 'TORNER HP LASERJET 107/ MFP135fnw', '2', '75.630', '19', 'pourcentage', NULL, '0', '151.260', '0.000', '28.739', '179.999', '142', '2023-04-03 10:23:41', '2023-04-03 10:23:41'),
(230, '861916-5430', 'LAT 5430-N BTX 14\" CI7 - 1255U 10C 4.7GHz 16GB 512GB \nWIFIBT LX 1Y', '1', '3230.000', '7', 'pourcentage', NULL, '0', '3230.000', '0.000', '226.100', '3456.100', '143', '2023-04-03 12:02:18', '2023-04-03 12:02:18'),
(231, 'FAC N°23036010', 'La présente est relative au loyer du 20/04/2023', '1', '11.668', '19', 'pourcentage', NULL, '0', '11.668', '0.000', '2.217', '13.885', '144', '2023-04-03 12:08:10', '2023-04-03 12:08:10'),
(232, 'FACN°2303691', 'La présente facture est relative au loyer du 20/03/2023 au 19/04/2023', '1', '1093.261', '19', 'pourcentage', NULL, '0', '1093.261', '0.000', '207.720', '1300.981', '145', '2023-04-03 12:17:03', '2023-04-03 12:17:33'),
(233, 'IN 711050', 'GUIDE CABLE 19p PLASTIQUE', '2', '17.000', '19', 'pourcentage', NULL, '0', '34.000', '0.000', '6.460', '40.460', '146', '2023-04-03 12:59:56', '2023-04-03 12:59:56'),
(234, 'TX EMSTPKSF24BLK1', 'Panneau de brassage vide STP6 24 Ports modulaire', '2', '52.000', '19', 'pourcentage', NULL, '0', '104.000', '0.000', '19.760', '123.760', '146', '2023-04-03 12:59:56', '2023-04-03 12:59:56'),
(235, 'TX PDU9WFR1.8MFR', 'PDU 9 Way Euro Style 16Amp 230v 1.8m cable', '2', '80.000', '19', 'pourcentage', NULL, '0', '160.000', '0.000', '30.400', '190.400', '146', '2023-04-03 12:59:56', '2023-04-03 12:59:56'),
(236, 'TX STPC6TJ180LV-E', 'Prises femelle keystone jack STP cat6 silver 3PR', '50', '8.200', '19', 'pourcentage', NULL, '0', '410.000', '0.000', '77.900', '487.900', '146', '2023-04-03 12:59:56', '2023-04-03 12:59:56'),
(237, 'M-40/40', 'MOLURE 40/40', '50', '4.893', '19', 'pourcentage', NULL, '35', '244.650', '85.627', '30.214', '189.237', '147', '2023-04-03 13:05:49', '2023-04-03 13:08:57'),
(238, 'M-25/17', 'MOLURE 25/17', '20', '1.890', '19', 'pourcentage', NULL, '35', '37.800', '13.230', '4.668', '29.238', '147', '2023-04-03 13:05:49', '2023-04-03 13:08:57'),
(239, '20VE00DWFE', 'ThnikBook NBLN TB 15 G2 ITL I5 8G 1T NOS', '1', '1970.000', '7', 'pourcentage', NULL, '0', '1970.000', '0.000', '137.900', '2107.900', '148', '2023-04-04 07:58:56', '2023-04-04 07:59:17'),
(240, '82KB00SJFE ', 'V15-ITL , i5-1135G7 ,4GB Base DDR4 ,1TB , 5400rpm , Integrated  , 15.6\" FHD TN', '1', '1390.000', '7', 'pourcentage', NULL, '0', '1390.000', '0.000', '97.300', '1487.300', '148', '2023-04-04 07:58:56', '2023-04-04 07:59:17'),
(241, 'UPOL-OL300EP-CG01B', 'UPS ON-LINE 3000VA', '1', '1749.000', '19', 'pourcentage', NULL, '0', '1749.000', '0.000', '332.310', '2081.310', '149', '2023-04-04 08:27:11', '2023-04-04 08:27:11'),
(242, 'MS-KLQ-00667', 'M365 Bus Standard Retail French Subscr 1YR Africa \nBL N° 23003267', '1', '509.000', '19', 'pourcentage', NULL, '0', '509.000', '0.000', '96.710', '605.710', '150', '2023-04-04 11:06:05', '2023-04-04 11:14:42'),
(243, 'MS KLQ-00667', 'M365 Bus Standard Retail French Subscr 1YR Africa \nBL N° 23003268', '3', '509.000', '19', 'pourcentage', NULL, '0', '1527.000', '0.000', '290.130', '1817.130', '150', '2023-04-04 11:06:05', '2023-04-04 11:14:42'),
(244, 'AKD4S8', 'DDR4 8GB 3200MHz SO DIMM', '1', '79.000', '7', 'pourcentage', NULL, '0', '79.000', '0.000', '5.530', '84.530', '151', '2023-04-04 11:18:49', '2023-04-04 11:18:49'),
(245, 'B1000-PABM4020', 'BOBINE 1000 ETIQ . EN PAPIER BLANC MAT 40MM*20MM', '60', '2650.000', '19', 'pourcentage', NULL, '0', '159000.000', '0.000', '30210.000', '189210.000', '152', '2023-04-04 11:27:09', '2023-04-04 11:27:09'),
(246, 'F090322', 'BARETTE MEMOIRE SODMIN 16GO DDRIV PC3200 DATO', '1', '135.000', '7', 'pourcentage', NULL, '0', '135.000', '0.000', '9.450', '144.450', '153', '2023-04-04 11:30:10', '2023-04-04 11:30:10'),
(247, 'F090412', 'BOITIER EXTERNE 2.5 USB 2.0', '3', '12.900', '7', 'pourcentage', NULL, '0', '38.700', '0.000', '2.709', '41.409', '153', '2023-04-04 11:30:10', '2023-04-04 11:30:10'),
(248, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114826', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(249, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114821', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(250, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114807', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(251, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114814', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(252, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114880', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(253, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114969', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(254, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114951', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(255, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114941', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(256, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114896', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(257, 'F080664', 'PCIe 512GB DP700 RW(2000/1800) \nN°SERIE 22114988', '1', '105.000', '7', 'pourcentage', NULL, '0', '105.000', '0.000', '7.350', '112.350', '154', '2023-04-04 12:40:16', '2023-04-04 12:40:16'),
(258, 'MCONSULTING.TN', 'Mconsulting.tn', '1', '14.000', '19', 'pourcentage', NULL, '0', '14.000', '0.000', '2.660', '16.660', '156', '2023-04-05 11:25:15', '2023-04-05 11:25:15'),
(259, 'WEB HOSTING-PACK SILVER ', 'Web Hosting-Pack silver', '12', '5.400', '19', 'pourcentage', NULL, '0', '64.800', '0.000', '12.312', '77.112', '156', '2023-04-05 11:25:15', '2023-04-05 11:25:15'),
(260, 'ELOQUENCE.COM', 'Eloquence.com', '1', '30.000', '19', 'pourcentage', NULL, '0', '30.000', '0.000', '5.700', '35.700', '157', '2023-04-05 12:29:57', '2023-04-05 12:29:57'),
(261, 'ELOQUENCE.TN', 'Eloquence.tn', '1', '14.000', '19', 'pourcentage', NULL, '0', '14.000', '0.000', '2.660', '16.660', '157', '2023-04-05 12:29:57', '2023-04-05 12:29:57'),
(262, 'WEB HOSTING-PACK SILVER ', 'Web Hosting-Pack silver', '12', '5.4000', '19', 'pourcentage', NULL, '0', '64.800', '0.000', '12.312', '77.112', '157', '2023-04-05 12:29:57', '2023-04-05 12:29:57'),
(263, 'DISQUE-HDD', 'Disque dur HDD 500Go', '1', '82', '7', 'pourcentage', NULL, '0', '82.000', '0.000', '5.740', '87.740', '158', '2023-04-06 07:40:33', '2023-04-06 07:40:33'),
(264, 'MO', 'Main d\'oeuvre', '1', '100', '19', 'pourcentage', NULL, '0', '100.000', '0.000', '19.000', '119.000', '158', '2023-04-06 07:40:33', '2023-04-06 07:40:33'),
(265, 'POINTEUSE', 'Pointeuse controle d\'accés Faciale + Empreinte, Hikvision', '1', '950', '19', 'pourcentage', NULL, '0', '950.000', '0.000', '180.500', '1130.500', '159', '2023-04-06 08:07:04', '2023-04-27 10:46:21'),
(266, 'COMEM.TN', 'Comem.tn', '1', '14.000', '19', 'pourcentage', NULL, '0', '14.000', '0.000', '2.660', '16.660', '160', '2023-04-06 11:09:25', '2023-04-06 11:09:25'),
(267, 'WEB HOSTING-PACK SILVER', 'Web Hosting-Pack silver', '12', '5.400', '19', 'pourcentage', NULL, '0', '64.800', '0.000', '12.312', '77.112', '160', '2023-04-06 11:09:25', '2023-04-06 11:09:25'),
(268, 'ALLIERRH.NET', 'Allierrh.net', '1', '36.000', '19', 'pourcentage', NULL, '0', '36.000', '0.000', '6.840', '42.840', '161', '2023-04-06 11:15:18', '2023-04-06 11:15:18'),
(269, 'WEB HOSTING-PACK SILVER ', 'Web Hosting-Pack silver', '12', '5.400', '19', 'pourcentage', NULL, '0', '64.800', '0.000', '12.312', '77.112', '161', '2023-04-06 11:15:18', '2023-04-06 11:15:18'),
(270, 'GST.TN', 'Gst.tn', '1', '14.000', '19', 'pourcentage', NULL, '0', '14.000', '0.000', '2.660', '16.660', '162', '2023-04-06 11:23:37', '2023-04-06 11:23:37'),
(271, 'ND HOST ', 'Nom de domaine Moderne.tn \nhébergement pro', '1', '148.000', '19', 'pourcentage', NULL, '0', '148.000', '0.000', '28.120', '176.120', '163', '2023-04-11 08:12:23', '2023-04-11 08:12:23');
INSERT INTO `itemfactures` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `facture_id`, `created_at`, `updated_at`) VALUES
(272, 'IMP-EPSON', 'Imprimante Multifonctions à réservoir intégré\nEpson EcoTank L14150 - Ecran tactile Format A3+ - Mode d\'impression:\nTête\nd’impression PrecisionCore - Fonctions\n4en1:\nImpression, Numérisation, Copie, Télécopie\nRecto-verso automatique (A4,\npapier\nordinaire) - Vitesse d\'impression\n17\npages/min Monochrome, 9\npages/min\nCouleur - Résolution de la numérisation\n1200\nx 2400 DPI - Fax à grande vitesse en noir\net\nblanc et en couleur - Connectivité:\nUSB,\nEthernet, Wi-Fi, Wi-Fi\nDirect', '1', '1870', '7', 'pourcentage', NULL, '0', '1870.000', '0.000', '130.900', '2000.900', '164', '2023-04-11 12:03:34', '2023-04-11 12:03:34'),
(273, 'IMP-HP', 'Imprimante Laser HP 107A Monochrome - Fonctions: Impression - Technologie d\'impression: Laser - Format Papier: A4 - Résolution d\'impression: Jusqu\'à 1 200 x 1 200 ppp  - Vitesse d\'impression: 20 ppm - Entrée papier standard: 150 feuilles - Mémoire: 64 Mo - Ecran: Voyant - Impression recto/verso: Manuel - Format compacte - Simplicité d\'installation - Tailles de support personnalisées: 76 x 127 à 216 x 356 mm - Connecteurs: USB  - Dimensions: 331 x 350 x 248 mm - Poids: 4,16 kg - Couleur: Blanc', '1', '420', '7', 'pourcentage', NULL, '0', '420.000', '0.000', '29.400', '449.400', '164', '2023-04-11 12:03:34', '2023-04-11 12:03:34'),
(274, 'CABLE-6U', 'Cable réseau FTP CAT 6 250m', '250', '2.650', '0', 'pourcentage', NULL, '0', '662.500', '0.000', '0.000', '662.500', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(275, 'PRISE-RESEAU', 'Prise Réseau', '4', '28.300', '0', 'pourcentage', NULL, '0', '113.200', '0.000', '0.000', '113.200', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(276, 'ARMOIRE', 'Armoire 7U', '1', '285', '0', 'pourcentage', NULL, '0', '285.000', '0.000', '0.000', '285.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(277, 'SWITCHEUR', 'Switcheur 16 Ports 10/100/1000', '1', '689', '0', 'pourcentage', NULL, '0', '689.000', '0.000', '0.000', '689.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(278, 'CABLE-COURANT', 'Cable Courant 3x2.5', '30', '7.800', '0', 'pourcentage', NULL, '0', '234.000', '0.000', '0.000', '234.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(279, 'MULTIPRISE', 'Multiprise pour armoire', '1', '45.000', '0', 'pourcentage', NULL, '0', '45.000', '0.000', '0.000', '45.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(280, 'TUBE-IRO', 'Tube IRO', '50', '3.200', '0', 'pourcentage', NULL, '0', '160.000', '0.000', '0.000', '160.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(281, 'MO', 'Main d\'oeuvre', '1', '750', '0', 'pourcentage', NULL, '0', '750.000', '0.000', '0.000', '750.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(282, 'TB', 'Tube Gorge', '20', '2.400', '0', 'pourcentage', NULL, '0', '48.000', '0.000', '0.000', '48.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(283, 'MOULURE', 'Moulure 25x19', '20', '3.500', '0', 'pourcentage', NULL, '0', '70.000', '0.000', '0.000', '70.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(284, 'ATI', 'Attache Tube IRO', '50', '1.500', '0', 'pourcentage', NULL, '0', '75.000', '0.000', '0.000', '75.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(285, 'MTI', 'Manchon Tube IRO', '10', '2.000', '0', 'pourcentage', NULL, '0', '20.000', '0.000', '0.000', '20.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(286, 'PC-0.5M', 'Patch Cable 0.5m', '0.5', '7.100', '0', 'pourcentage', NULL, '0', '3.550', '0.000', '0.000', '3.550', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(287, 'PC-5M', 'Patch Cable 5m', '5', '19.000', '0', 'pourcentage', NULL, '0', '95.000', '0.000', '0.000', '95.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(288, 'PA-225', 'Point d\'accés EAP 225', '1', '550', '0', 'pourcentage', NULL, '0', '550.000', '0.000', '0.000', '550.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(289, 'NOYAU', 'Noyau prise RJ45', '8', '12.000', '0', 'pourcentage', NULL, '0', '96.000', '0.000', '0.000', '96.000', '165', '2023-04-12 08:22:39', '2023-04-27 10:40:36'),
(290, 'DEV-PLUGIN', 'Développement spécifique (ajout plugin)', '1', '350.000', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '166', '2023-04-12 09:09:36', '2023-04-14 12:39:50'),
(292, 'GT', 'Gestion Ticket\nGestion Client \nGestion Accessoires\nGestion Stocks\nGestion Emplacements\nGestion Pannes\nGestion Acheteurs\nGestion Users\nGestion Devis\nGestion Profil clients', '1', '11000', '19', 'pourcentage', NULL, '0', '11000.000', '0.000', '2090.000', '13090.000', '168', '2023-04-13 07:37:37', '2023-04-13 07:37:37'),
(293, 'V50T-G2', 'V50t G2,180W TWR, i5-10400,12GB DDR4,1TB\n7200rpm, Integrated,DVD±RW,No OS,\n,RTL8822CE 2x2AC+BT,3-in-1 Card\nReader,,ParallelPort,NO_SECOND_REAR_COM_ PORT,Internal Speaker,2-in-1 CPU fan,180W,USB CLP FRA,USB CLP MOUSE, Ecran.', '1', '1930', '7', 'pourcentage', NULL, '0', '1930.000', '0.000', '135.100', '2065.100', '169', '2023-04-13 08:46:11', '2023-04-13 11:46:36'),
(295, 'M-D', 'Migration des données', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '169', '2023-04-13 11:46:36', '2023-04-13 11:46:36'),
(297, 'W1A53A ', 'HP IMPRIMANTE LASERJET PRO M404DN \nMONOCHROME GARANTIE 1AN \nSN ; PHFMG47338', '1', '779.000', '7', 'pourcentage', NULL, '0', '779.000', '0.000', '54.530', '833.530', '171', '2023-04-14 08:04:14', '2023-04-14 08:13:28'),
(298, 'RAM-T20', 'Barrettes Ram Serveur Dell PowerEdge T20 8Go', '2', '360', '7', 'pourcentage', NULL, '0', '720.000', '0.000', '50.400', '770.400', '172', '2023-04-14 08:55:48', '2023-04-14 08:55:48'),
(299, '62B6MAT3EU', 'E24-28 \n23.8\"Monitor , IPSpanel, 1920w1080 , Input connectors-VGA+DP 1.2', '1', '475.000', '7', 'pourcentage', NULL, '0', '475.000', '0.000', '33.250', '508.250', '173', '2023-04-14 09:24:51', '2023-04-14 09:24:51'),
(300, '40AU0065EU', 'Lenovo USB-C Mini Dock-EU', '1', '370.000', '7', 'pourcentage', NULL, '0', '370.000', '0.000', '25.900', '395.900', '173', '2023-04-14 09:24:51', '2023-04-14 09:24:51'),
(301, 'SAMSUNG_A53', 'SAMSUNG_A53 WHITE DS 8/128 5G', '1', '1747.059', '19', 'pourcentage', NULL, '0', '1747.059', '0.000', '331.941', '2079.000', '174', '2023-04-14 09:41:42', '2023-04-14 09:41:42'),
(302, 'INFO-G', 'Infogérance pour le mois d\'Avril', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '175', '2023-04-14 10:11:27', '2023-04-14 10:11:27'),
(303, 'C11CH96403', 'L14150', '1', '1660.000', '7', 'pourcentage', NULL, '0', '1660.000', '0.000', '116.200', '1776.200', '155', '2023-04-14 11:00:08', '2023-04-14 11:00:08'),
(304, 'CS', 'création d’un site web vitrine from scratch ( sous pages)', '1', '1800', '19', 'pourcentage', NULL, '0', '1800.000', '0.000', '342.000', '2142.000', '176', '2023-04-14 12:41:44', '2023-04-14 12:41:44'),
(305, 'ARABICA', 'NERONOBILE BOITE 10 CAPSULES (100% ARABICA) COMP NESPRESS', '1', '9.900', '19', 'pourcentage', NULL, '0', '9.900', '0.000', '1.881', '11.781', '178', '2023-04-17 11:17:02', '2023-04-17 11:17:02'),
(306, 'GUATEMALA', 'NERONOBILE BOITE 10 CAPSULES (100% ARABICA) COMP NESPRESS', '2', '9.900', '19', 'pourcentage', NULL, '0', '19.800', '0.000', '3.762', '23.562', '178', '2023-04-17 11:17:02', '2023-04-17 11:17:02'),
(307, 'INTERVENTION ', 'Intervention le 20/12/2022', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(308, 'INTERVENTION ', 'Intervention le 24/01/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(309, 'INTERVENTION ', 'Intervention le 27/01/2023', '1', '300.000', '19', 'pourcentage', NULL, '0', '300.000', '0.000', '57.000', '357.000', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(310, 'INTERVENTION ', 'Intervention le 07/02/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(311, 'INTERVENTION ', 'Intervention le 14/02/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(312, 'INTERVENTION ', 'Intervention le 14/03/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(313, 'INTERVENTION ', 'Intervention le 28/03/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(314, 'INTERVENTION ', 'Intervention le 11/04/2023', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '177', '2023-04-17 13:33:43', '2023-04-17 13:33:43'),
(315, 'IMP-KYOCERA', 'Imprimante Kyocera M6235 Multifonction couleur A4  3 en 1 - Ecran tactile 7 pouces - Impression, copie, scanner - Format A4 - Vitesse Jusqu\'à 35 ppm - Impression de la première page dans 7 secondes - Mémoire 1000 Mo - Résolution Jusqu\'à 1200 dpi - Bac Papier 500 feuilles - Impression Recto Verso Semi automatic - Préchauffage 25 secondes maximum - Dimensions 480 x 577 x 620 - USB - Ethernet', '1', '2310', '7', 'pourcentage', NULL, '0', '2310.000', '0.000', '161.700', '2471.700', '179', '2023-04-19 13:34:54', '2023-04-25 08:21:34'),
(318, 'INFO-G', 'Infogérance pour le mois  avril', '1', '200.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '182', '2023-04-24 08:07:52', '2023-04-24 08:07:52'),
(319, 'INFO-G', 'Infogérance pour le mois  avril', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '183', '2023-04-24 08:07:52', '2023-04-24 08:07:52'),
(320, 'INFO-G', 'Infogérance pour le mois  avril', '1', '750', '19', 'pourcentage', NULL, '0', '750.000', '0.000', '142.500', '892.500', '184', '2023-04-24 08:33:26', '2023-04-24 08:33:26'),
(321, 'INFO-G', 'Infogérance pour le mois avril', '1', '700.000', '19', 'pourcentage', NULL, '0', '700.000', '0.000', '133.000', '833.000', '185', '2023-04-24 08:33:26', '2023-04-24 08:33:26'),
(322, 'INFO-G', 'Infogérance pour le mois  avril', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '186', '2023-04-24 08:33:27', '2023-04-24 08:33:27'),
(323, 'INFO-G', 'Infogérance pour le mois avril', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '187', '2023-04-24 08:33:27', '2023-04-24 08:39:19'),
(324, 'INFO-G', 'Infogérance pour le mois avril', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '188', '2023-04-24 08:33:27', '2023-04-24 08:39:06'),
(325, 'INFO-G', 'Infogérance pour le mois  avril', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '189', '2023-04-24 08:33:27', '2023-04-24 08:38:53'),
(327, 'INFO-G', 'Infogérance pour le mois Mai', '1', '350.000', '0', 'pourcentage', NULL, '0', '350.000', '0.000', '0.000', '350.000', '191', '2023-04-24 08:33:27', '2023-05-08 13:18:31'),
(328, 'INFO-G', 'Infogérance pour le mois avril', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '192', '2023-04-24 08:33:27', '2023-04-24 08:38:15'),
(329, 'DEVsp', 'Developpement d\'un connecteur QAD SAGE XRT pour GALION', '5', '450', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '193', '2023-04-24 16:30:28', '2023-04-24 16:30:28'),
(331, 'IMP-EPSON', 'Imprimante Jet d\'encre L3150 Multifonction 3en1 Couleur - Fonctions: Impression, Copie, numérisation - Format: A4 - Technologie d\'impression: Jet d\'encre - Vitesse d\'impession: 33 ppm (N&B) - Résolution d\'impression: 5760 x 1440 DPI - Vitesse de Numérisation: 11s noir (200 DPI), 28 s couleur (200 DPI) - Capacité d\'entrée: 100 Feuilles - Fonctionne avec 4 Cartouches (noire, cyan, magenta, jaune) - Dimensions: 375 x 347 x 179 mm - Connectivité: USB, WiFi - Wi-Fi Direct', '1', '640', '7', 'pourcentage', NULL, '0', '640.000', '0.000', '44.800', '684.800', '195', '2023-04-26 15:15:35', '2023-04-26 15:15:35'),
(332, 'CONTRAT NORDIC ', 'MOIS DE MARS 2023 \nMaintenance de parc Informatique \ninfogérance des serveurs  \ndirection du  systémes d\'informations', '1', '2500.000', '19', 'pourcentage', NULL, '0', '2500.000', '0.000', '475.000', '2975.000', '196', '2023-04-27 10:31:58', '2023-04-27 10:31:58'),
(333, 'CONTRAT NORDIC ', 'MOIS DE AVRIL 2023 \nMaintenance de parc Informatique \ninfogérance des serveurs  \ndirection du  systémes d\'informations', '1', '2500.000', '19', 'pourcentage', NULL, '0', '2500.000', '0.000', '475.000', '2975.000', '197', '2023-04-27 10:34:22', '2023-04-27 10:34:22'),
(334, 'PC-LENOVO', 'Pc Lenovo Intel Core i5-1135G7 (2.40 GHz up to 4,20 GHz Turbo max, 8 Mo de mémoire cache, Quad-Core) - Système d\'exploitation: FreeDos - Mémoire RAM: 12 Go DDR4-3200 - Disque Dur: 512 Go SSD, 1TB HDD - Carte Graphique: Integrated avec WiFi, Bluetooth,1xUSB 2.0, 1x USB 3.2 Gen 1, 1x USB-C 3.2 Gen 1, 1x HDMI 1.4b, 1x prise combinée casque/microphone (3,5 mm) et lecteur de carte .', '1', '1930', '7', 'pourcentage', NULL, '0', '1930.000', '0.000', '135.100', '2065.100', '198', '2023-04-27 12:29:06', '2023-04-27 16:19:03'),
(335, 'ECRAN', 'Écran ThinkVision E24-28 24\" FHD (IPS, 60Hz 4ms, HDMI VGA DP, Haut-parleurs, Inclinable/Ajustable en hauteur/Pivotable)', '1', '575', '7', 'pourcentage', NULL, '0', '575.000', '0.000', '40.250', '615.250', '198', '2023-04-27 12:29:06', '2023-04-27 16:19:03'),
(336, 'CS', 'Clavier et Souris', '1', '165', '7', 'pourcentage', NULL, '0', '165.000', '0.000', '11.550', '176.550', '198', '2023-04-27 12:29:06', '2023-04-27 16:19:03'),
(337, 'TV-TCL', 'TV TCL 32 Pouces', '1', '455', '19', 'pourcentage', NULL, '0', '455.000', '0.000', '86.450', '541.450', '199', '2023-04-27 13:49:19', '2023-04-27 13:50:00'),
(338, 'CAM-HDD', 'Caméra 5MP Hikvision Full HD', '5', '180', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '200', '2023-04-27 13:50:37', '2023-04-27 13:50:49'),
(339, 'DVR-8CH', 'DVR Pro 8 chaines Hikvision', '1', '900', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '200', '2023-04-27 13:50:37', '2023-04-27 13:50:49'),
(340, 'DISQUE-DUR', 'Disque Dur 4TO', '1', '500', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '200', '2023-04-27 13:50:37', '2023-04-27 13:50:49'),
(341, 'CABLE', 'Cable et Tube Gris', '1', '1300', '19', 'pourcentage', NULL, '0', '1300.000', '0.000', '247.000', '1547.000', '200', '2023-04-27 13:50:37', '2023-04-27 13:50:49'),
(342, 'MO', 'Main D\'oeuvre', '1', '1000', '19', 'pourcentage', NULL, '0', '1000.000', '0.000', '190.000', '1190.000', '200', '2023-04-27 13:50:37', '2023-04-27 13:50:49'),
(343, 'F090350', 'BARETTE MEMOIRE SODMIN 8GO DDRIV PC3200 DATO', '4', '53.000', '19', 'pourcentage', NULL, '0', '212.000', '0.000', '40.280', '252.280', '201', '2023-04-27 14:58:52', '2023-04-27 14:59:24'),
(344, 'SS', 'Souris simple', '1', '10.000', '7', 'pourcentage', NULL, '0', '10.000', '0.000', '0.700', '10.700', '198', '2023-04-27 16:19:03', '2023-04-27 16:19:03'),
(345, 'C11CJ67408', 'L3250', '1', '580.000', '7', 'pourcentage', NULL, '0', '580.000', '0.000', '40.600', '620.600', '202', '2023-04-28 10:41:29', '2023-04-28 10:41:58'),
(346, 'B11B239402', 'WORKFORCE DS-1630', '1', '570.000', '7', 'pourcentage', NULL, '0', '570.000', '0.000', '39.900', '609.900', '202', '2023-04-28 10:41:29', '2023-04-28 10:41:58'),
(347, '4K30M39469', 'LENOVO ESSENTIAL WIRELESS KEYBOARD AND MOUSE COMBOFRENCH', '1', '120.000', '7', 'pourcentage', NULL, '0', '120.000', '0.000', '8.400', '128.400', '202', '2023-04-28 10:41:29', '2023-04-28 10:41:58'),
(348, '62B6MAT3EU', 'E24-28 \n23.8 MONITOR IPSpanel , 1920w1080 Input connectors-VGA+DP 1.2', '1', '475.000', '7', 'pourcentage', NULL, '0', '475.000', '0.000', '33.250', '508.250', '202', '2023-04-28 10:41:29', '2023-04-28 10:41:58'),
(349, '82TT002BFE', 'V15-IAP ,i15-1235U ,8GB Base DDR4 ,256GB SSD M.2 2242 NNMe', '4', '1280.000', '7', 'pourcentage', NULL, '0', '5120.000', '0.000', '358.400', '5478.400', '202', '2023-04-28 10:41:29', '2023-04-28 10:41:58'),
(350, '16G-DDR4', 'BARRETTE MEMOIRE SRVEUR 16G DDR4 2666E', '1', '650.000', '7', 'pourcentage', NULL, '0', '650.000', '0.000', '45.500', '695.500', '203', '2023-04-28 12:03:25', '2023-04-28 12:03:25'),
(351, 'ADDS1600W', 'BARRETTE MEMOIRE PORTABLE 8G DDR3L 1600MHZ', '1', '88.785', '7', 'pourcentage', NULL, '0', '88.785', '0.000', '6.215', '95.000', '204', '2023-04-28 12:04:39', '2023-04-28 12:04:39'),
(352, '8G-DDR3L', 'BARRETTE MEMOIRE SERVEUR 8G DDR3L 12800E', '2', '280.000', '7', 'pourcentage', NULL, '0', '560.000', '0.000', '39.200', '599.200', '205', '2023-04-28 12:06:01', '2023-04-28 12:06:01'),
(353, 'CONTRAT-NORDIC ', 'CONTRAT D\'INFOGERANCE \"pou le compte de AST (mois de mars 2023) \nMaintenance deparc informatique \ninfogérance des serveurs \ndirection du systémes d\'informations', '1', '2250.000', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '206', '2023-04-28 12:12:48', '2023-04-28 12:12:48'),
(354, 'CONTRAT-NORDIC', 'CONTRAT D\'INFOGERANCE \"pou le compte de AST (mois de avril 2023) \nMaintenance deparc informatique \ninfogérance des serveurs \ndirection du systémes d\'informations', '1', '2250.000', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '207', '2023-04-28 12:14:23', '2023-04-28 12:14:23'),
(364, 'CARTOUCHE -HP ', 'Cartouche encre pour imprimante HP laserjet pro M404dn', '1', '243.000', '0', 'pourcentage', NULL, '0', '243.000', '0.000', '0.000', '243.000', '218', '2023-05-02 07:48:54', '2023-05-08 13:15:29'),
(365, 'SCANNER-EPSON', 'Scaner à plat WorkForce EPSON DS-1630 recto-verso - Résolution de la Numérisation: 600 x 600 dpi (optique), 1200 x 1200 dpi - Vitesse de numérisation (Monochrome / couleur): 25 page/min (A4 , 200/300 dpi) - Numérisation en recto-verso - Formats de papier: A4 - Connectivité: USB 3.0 - Chargeur automatique de documents: 50 pages -  Dimensions: 451‎ x 315 x 120 mm - Poids: 3.7 kg', '1', '780', '7', 'pourcentage', NULL, '0', '780.000', '0.000', '54.600', '834.600', '219', '2023-05-02 08:04:35', '2023-05-02 08:04:35'),
(373, 'XP32810', 'KRUPS EXPRESSO 15BARS 220W 1.5L NOIR 1AN GRANTIE', '1', '467.387', '19', 'pourcentage', NULL, '0', '467.387', '0.000', '88.804', '556.191', '208', '2023-05-02 13:53:26', '2023-05-02 13:58:14'),
(374, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '227', '2023-05-02 14:24:56', '2023-05-02 14:24:56'),
(376, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '229', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(377, 'INFO-G', 'Infogérance pour le mois mars avril', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '230', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(378, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '231', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(379, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '232', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(380, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '233', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(381, 'INFO-G', 'Infogérance pour le mois  mars', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '234', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(382, 'INFO-G', 'Infogérance pour le mois mars', '1', '700.000', '19', 'pourcentage', NULL, '0', '700.000', '0.000', '133.000', '833.000', '235', '2023-05-02 14:24:57', '2023-05-02 14:24:57'),
(384, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '237', '2023-05-02 14:28:15', '2023-05-02 14:28:15'),
(385, 'INFO-G', 'Infogérance pour le mois mars avril', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '238', '2023-05-02 14:28:15', '2023-05-02 14:28:15'),
(387, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '240', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(388, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '241', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(389, 'INFO-G', 'Infogérance pour le mois  mars', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '242', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(390, 'INFO-G', 'Infogérance pour le mois mars', '1', '700.000', '19', 'pourcentage', NULL, '0', '700.000', '0.000', '133.000', '833.000', '243', '2023-05-02 14:28:16', '2023-05-02 14:28:16'),
(392, 'INFO-G', 'Infogérance pour le mois mars avril', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '245', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(394, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '247', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(395, 'INFO-G', 'Infogérance pour le mois mars mars', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '248', '2023-05-02 15:25:35', '2023-05-02 15:25:35'),
(396, 'ST1000VN002', 'HDD DESKTOP , NAS 3.5 1TB 64  MB SATA 5900', '2', '190.000', '7', 'pourcentage', NULL, '0', '380.000', '0.000', '26.600', '406.600', '249', '2023-05-03 07:25:01', '2023-05-03 07:25:01'),
(397, 'TS-231K', 'Processeur Annapurna Labs AL-214 quad-core 1.7 GH , 1Go de RAM', '1', '820.000', '7', 'pourcentage', NULL, '0', '820.000', '0.000', '57.400', '877.400', '249', '2023-05-03 07:25:01', '2023-05-03 07:25:01'),
(398, 'TRANS12V54', 'BL ; BL23003750 Du 020523 \nTRANSFO', '1', '18.487', '19', 'pourcentage', NULL, '0', '18.487', '0.000', '3.513', '22.000', '250', '2023-05-03 07:28:38', '2023-05-03 07:28:38'),
(399, '4KSU ', 'IP7WW-4KSU-C1 w/o SL2100 (Box)', '1', '295.000', '19', 'pourcentage', NULL, '0', '295.000', '0.000', '56.050', '351.050', '251', '2023-05-03 07:36:50', '2023-05-03 07:37:37'),
(400, 'TS-231K', 'QNAP Serveur NAS TS-231K 2To stockage', '1', '1330', '7', 'pourcentage', NULL, '0', '1330.000', '0.000', '93.100', '1423.100', '252', '2023-05-03 10:37:55', '2023-05-03 10:51:29'),
(401, 'SL2100-BOX', 'Box pour standard NEC SL2100', '1', '360', '19', 'pourcentage', NULL, '0', '360.000', '0.000', '68.400', '428.400', '252', '2023-05-03 10:37:55', '2023-05-03 10:51:29'),
(403, 'WINDOWS-VM ', 'License Windows Server STD 16 Core 2019 Open 2 machine VM', '1', '3820.000', '19', 'pourcentage', NULL, '0', '3820.000', '0.000', '725.800', '4545.800', '254', '2023-05-05 07:51:51', '2023-05-05 07:51:51'),
(404, 'SSD-SATA', 'Disque Dur SSD 512Go  SATA', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '255', '2023-05-08 12:05:30', '2023-05-08 12:05:30'),
(405, 'DDR3-8Go', 'Barrette mémoire 8Go DDR3', '1', '125.000', '19', 'pourcentage', NULL, '0', '125.000', '0.000', '23.750', '148.750', '255', '2023-05-08 12:05:30', '2023-05-08 12:05:30'),
(406, 'M-D', 'Migration des données', '1', '150.000', '19', 'pourcentage', NULL, '0', '150.000', '0.000', '28.500', '178.500', '255', '2023-05-08 12:05:30', '2023-05-08 12:05:30'),
(407, 'DEVspe', 'Amélioration du connecteur QAD to XRT (ADET) Lilas', '2.5', '450', '19', 'pourcentage', NULL, '0', '1125.000', '0.000', '213.750', '1338.750', '256', '2023-05-08 12:32:46', '2023-05-08 12:33:46'),
(408, 'REPARATION-HP', 'Réparation imprimante HP', '1', '115.000', '0', 'pourcentage', NULL, '0', '115.000', '0.000', '0.000', '115.000', '218', '2023-05-08 13:15:29', '2023-05-08 13:15:29'),
(409, 'REPARATION-EPSON', 'Réparation imprimante EPSON M2140', '1', '125.000', '19', 'pourcentage', NULL, '0', '125.000', '0.000', '23.750', '148.750', '257', '2023-05-08 13:17:31', '2023-05-08 13:17:31'),
(410, '9FGC120', 'DISQUE SSD 512G IMATION C321', '10', '65.000', '7', 'pourcentage', NULL, '0', '650.000', '0.000', '45.500', '695.500', '259', '2023-05-09 14:51:35', '2023-05-09 14:51:35'),
(411, 'DEVspe', 'Développement application web et mobile (SVR/FILORGA) gestion commande client avec espace client dédié', '1', '8300', '19', 'pourcentage', NULL, '0', '8300.000', '0.000', '1577.000', '9877.000', '260', '2023-05-09 17:30:15', '2023-05-09 17:30:37'),
(412, 'DEVspe', 'Migration SIRY FILLMED Mobile et WEB \ncentralisation sur meme application WEB', '5', '450', '19', 'pourcentage', NULL, '0', '2250.000', '0.000', '427.500', '2677.500', '261', '2023-05-09 17:34:09', '2023-05-09 17:35:26'),
(413, 'MTSOUR', 'Souris USB2.0', '1', '7.500', '7', 'pourcentage', NULL, '0', '7.500', '0.000', '0.525', '8.025', '262', '2023-05-10 09:18:01', '2023-05-10 09:18:18'),
(414, 'ESET-DESK', 'Eset Internet Security pour Desktop', '5', '45', '19', 'pourcentage', NULL, '0', '225.000', '0.000', '42.750', '267.750', '263', '2023-05-10 12:07:51', '2023-05-10 12:07:51'),
(415, 'ESET-SERV', 'Eset File Security pour Serveur', '1', '350', '19', 'pourcentage', NULL, '0', '350.000', '0.000', '66.500', '416.500', '263', '2023-05-10 12:07:51', '2023-05-10 12:07:51'),
(416, 'PC-I5-DDR4-256GB SSD', 'PCV15-IAP ,i5-1235U, 8GB Base DDR4 ,256GB SSD M.2 2242 NVMe', '1', '1469.000', '7', 'pourcentage', NULL, '0', '1469.000', '0.000', '102.830', '1571.830', '264', '2023-05-10 12:34:42', '2023-05-10 12:39:24'),
(417, 'REPARATION RESEAU LOCALE-IRC', 'Réparation et interconnexion réseau local IRC', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '265', '2023-05-11 09:19:16', '2023-05-11 09:26:30');

-- --------------------------------------------------------

--
-- Structure de la table `itemordres`
--

CREATE TABLE `itemordres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adress_enlev` varchar(255) DEFAULT NULL,
  `date_enlev` varchar(255) DEFAULT NULL,
  `nom_enlev` varchar(255) DEFAULT NULL,
  `adress_livraison` varchar(255) DEFAULT NULL,
  `date_livraison` varchar(255) DEFAULT NULL,
  `nom_livraison` varchar(255) DEFAULT NULL,
  `nature` varchar(255) DEFAULT NULL,
  `poids` varchar(255) DEFAULT NULL,
  `nb_coliss` varchar(255) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `specif` varchar(255) DEFAULT NULL,
  `no_dossier` varchar(255) DEFAULT NULL,
  `remarques` longtext DEFAULT NULL,
  `prix_achat` varchar(255) DEFAULT NULL,
  `prix_vente` varchar(255) DEFAULT NULL,
  `chauffeur_id` varchar(255) DEFAULT NULL,
  `camion_id` varchar(255) DEFAULT NULL,
  `matricule_camion` varchar(255) DEFAULT NULL,
  `evaluation` longtext DEFAULT NULL,
  `ordre_id` varchar(255) NOT NULL,
  `itemdevis_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `itemsboncommandes`
--

CREATE TABLE `itemsboncommandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `prix_ht` varchar(255) NOT NULL,
  `tva` varchar(255) NOT NULL,
  `type_remise` varchar(255) DEFAULT NULL,
  `type_tva` varchar(255) DEFAULT NULL,
  `remise` varchar(255) DEFAULT NULL,
  `total_ht` varchar(255) NOT NULL,
  `total_remise` varchar(255) NOT NULL,
  `total_tva` varchar(255) NOT NULL,
  `total_ttc` varchar(255) NOT NULL,
  `boncommande_id` varchar(255) NOT NULL,
  `catalogue_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itemsboncommandes`
--

INSERT INTO `itemsboncommandes` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `boncommande_id`, `catalogue_id`, `created_at`, `updated_at`) VALUES
(3, '82KB00SJFE', 'V15-ITL,i5-1135G7,4GB Base DDR4,1TB 5400rpm,Integrated,15.6\" FHD TN,No OS,Wi-fi AC 2x2 + BT,N-FPR,1MP HD Cam,2 Cell 38Whr,65W AC 3PIN,KYB French,1 Year Carry-in,BLACK,', '2', '1280', '7', 'pourcentage', NULL, '0', '2560.000', '0.000', '179.200', '2739.200', '5', NULL, '2023-03-28 11:47:42', '2023-03-28 12:00:06'),
(4, '40AU0065EU', 'Mini station d\'accueil EU ,1 x 3.5 mm audio male,\n1 x USB 2.0 Type-A, 1 x USB 3.1 Type-A, 1 x USB\n3.1 Type-C, 1 x RJ45, 1 x VGA x HDMI', '1', '390', '19', 'pourcentage', NULL, '0', '390.000', '0.000', '74.100', '464.100', '6', NULL, '2023-03-28 11:57:34', '2023-03-28 11:57:34'),
(5, 'AEIS23-A1L1', 'Pack OEM Eset Internet Secur. 1 lot de 50clés', '50', '24.710', '19', 'pourcentage', NULL, '0', '1235.500', '0.000', '234.745', '1470.245', '7', NULL, '2023-05-02 15:48:18', '2023-05-03 07:45:08'),
(6, 'AESS-L1', 'ESET Server Security lic pleine 1 an', '1', '231', '19', 'pourcentage', NULL, '0', '231.000', '0.000', '43.890', '274.890', '7', NULL, '2023-05-02 15:48:18', '2023-05-03 07:45:08');

-- --------------------------------------------------------

--
-- Structure de la table `itemsfacturecontrats`
--

CREATE TABLE `itemsfacturecontrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produit` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `quantites` varchar(255) NOT NULL,
  `prix_ht` varchar(255) NOT NULL,
  `tva` varchar(255) NOT NULL,
  `type_remise` varchar(255) DEFAULT NULL,
  `type_tva` varchar(255) DEFAULT NULL,
  `remise` varchar(255) DEFAULT NULL,
  `total_ht` varchar(255) NOT NULL,
  `total_remise` varchar(255) NOT NULL,
  `total_tva` varchar(255) NOT NULL,
  `total_ttc` varchar(255) NOT NULL,
  `facturecontrat_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itemsfacturecontrats`
--

INSERT INTO `itemsfacturecontrats` (`id`, `produit`, `description`, `quantites`, `prix_ht`, `tva`, `type_remise`, `type_tva`, `remise`, `total_ht`, `total_remise`, `total_tva`, `total_ttc`, `facturecontrat_id`, `created_at`, `updated_at`) VALUES
(15, 'INFO-G', 'Infogérance pour le mois ', '1', '750', '19', 'pourcentage', NULL, '0', '750.000', '0.000', '142.500', '892.500', '11', '2023-03-16 10:15:14', '2023-03-16 10:15:14'),
(16, 'INFO-G', 'Infogérance pour le mois', '1', '700.000', '19', 'pourcentage', NULL, '0', '700.000', '0.000', '133.000', '833.000', '12', '2023-03-22 15:22:14', '2023-03-22 15:22:14'),
(17, 'INFO-G', 'Infogérance pour le mois ', '1', '200.000', '19', 'pourcentage', NULL, '0', '200.000', '0.000', '38.000', '238.000', '13', '2023-03-24 10:05:38', '2023-03-24 10:06:53'),
(18, 'INFO-G', 'Infogérance pour le mois ', '1', '500.000', '19', 'pourcentage', NULL, '0', '500.000', '0.000', '95.000', '595.000', '14', '2023-03-24 10:08:35', '2023-03-24 10:08:35'),
(19, 'INFO-G', 'Infogérance pour le mois ', '1', '250.000', '19', 'pourcentage', NULL, '0', '250.000', '0.000', '47.500', '297.500', '15', '2023-03-27 08:00:45', '2023-03-27 08:00:45'),
(20, 'INFO-G', 'Infogérance pour le mois ', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '16', '2023-03-27 08:16:45', '2023-05-02 15:33:01'),
(21, 'INFO-G', 'Infogérance pour le mois ', '1', '900.000', '19', 'pourcentage', NULL, '0', '900.000', '0.000', '171.000', '1071.000', '17', '2023-03-27 08:19:07', '2023-05-02 15:32:52'),
(22, 'INFO-G', 'Infogérance pour le mois ', '1', '1500.000', '19', 'pourcentage', NULL, '0', '1500.000', '0.000', '285.000', '1785.000', '18', '2023-03-27 08:23:38', '2023-05-02 15:32:44'),
(23, 'INFO-G', 'Infogérance pour le mois ', '1', '1700.000', '19', 'pourcentage', NULL, '0', '1700.000', '0.000', '323.000', '2023.000', '19', '2023-03-27 08:25:23', '2023-05-02 15:32:36'),
(24, 'INFO-G', 'Infogérance pour le mois', '1', '350.000', '0', 'pourcentage', NULL, '0', '350.000', '0.000', '0.000', '350.000', '20', '2023-03-27 08:27:52', '2023-05-02 10:45:44'),
(25, 'INFO-G', 'Infogérance pour le mois ', '1', '1600.000', '19', 'pourcentage', NULL, '0', '1600.000', '0.000', '304.000', '1904.000', '21', '2023-03-27 08:30:02', '2023-05-02 15:32:23');

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
(51, '2014_10_12_000000_create_users_table', 1),
(52, '2014_10_12_100000_create_password_resets_table', 1),
(53, '2019_08_19_000000_create_failed_jobs_table', 1),
(54, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(56, '2022_10_21_135515_create_devis_table', 1),
(57, '2022_10_21_142830_create_entreprises_table', 1),
(58, '2022_10_24_153427_create_ordres_table', 1),
(59, '2022_10_25_101746_create_itemdevis_table', 1),
(60, '2022_10_27_131423_create_itemordres_table', 1),
(62, '2022_11_01_144046_create_frais_table', 1),
(63, '2022_11_01_144136_create_factures_ordres_table', 1),
(64, '2022_11_08_090537_create_paiements_table', 1),
(65, '2022_11_14_142414_create_catalogues_table', 1),
(66, '2022_11_17_122838_create_contacts_table', 1),
(67, '2022_11_18_081432_create_taxes_table', 1),
(68, '2022_11_18_123257_create_categories_table', 1),
(69, '2022_11_30_101626_create_customnotifs_table', 1),
(70, '2022_12_01_134517_create_files_table', 1),
(71, '2022_12_20_151405_create_itemfactures_table', 1),
(72, '2022_12_27_100651_create_roles_table', 1),
(73, '2022_12_27_101255_create_permissions_table', 1),
(74, '2022_12_27_101314_create_permission_role_table', 1),
(77, '2022_12_28_090529_create_interventions_table', 2),
(79, '2022_11_01_143600_create_factures_table', 3),
(81, '2022_10_18_150336_create_clients_table', 4),
(82, '2023_04_26_150724_create_conges_table', 5),
(83, '2023_04_28_110110_create_datesconges_table', 6);

-- --------------------------------------------------------

--
-- Structure de la table `oportunitys`
--

CREATE TABLE `oportunitys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `contactcrm_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `expected_revenue` varchar(255) NOT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `step` varchar(255) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oportunitys`
--

INSERT INTO `oportunitys` (`id`, `numero`, `contactcrm_id`, `email`, `telephone`, `expected_revenue`, `rating`, `status`, `step`, `titre`, `created_at`, `updated_at`) VALUES
(37, NULL, '12', 'contact@berg-life.tn', '72677271', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 10:51:28', '2023-03-10 10:51:28'),
(38, NULL, '13', 'Cytopharma@cytopharma.tn', '72668444', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 10:52:07', '2023-03-10 10:52:07'),
(39, NULL, '14', 'ibn.albaytar@planet.tn', '71799731', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 10:52:31', '2023-03-10 10:52:31'),
(40, NULL, '15', 'contact@infomedpharma.tn', '71863450', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:12:51', '2023-03-10 12:12:51'),
(41, NULL, '16', 'wissem.bensaid@group-ips.com', '71942058', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:15:16', '2023-03-10 12:15:16'),
(42, NULL, '17', 'laboratoirespharmaceutiques@hotmail.com', '71552252', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:16:40', '2023-03-10 12:16:40'),
(43, NULL, '18', 'contact@opaliarecordati.tn', '70559064', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:19:45', '2023-03-10 12:19:45'),
(44, NULL, '19', 'contact@pharmaderm.net', '70661519', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:20:27', '2023-03-10 12:20:27'),
(45, NULL, '22', 'samir.joudi@rns.tn', '21698751943', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:20:49', '2023-03-10 12:20:49'),
(46, NULL, '23', 'contact@sisora.com', '21671182670', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:21:06', '2023-03-10 12:21:06'),
(47, NULL, '24', 'info@tahapharma.com', '71711780', '920', NULL, 'en cours', 'step1', 'Opportunité', '2023-03-10 12:21:38', '2023-03-10 12:21:38'),
(51, NULL, '28', 's.benabid@gnet.tn', '71963492', '1135', NULL, 'en cours', 'step2', 'Opportunité', '2023-03-10 15:29:28', '2023-03-13 08:30:18'),
(54, NULL, '295', 'info@proculogy.com', '29604000', '100000', NULL, 'en cours', 'step2', 'Opportunité', '2023-03-31 11:02:54', '2023-04-04 08:16:57'),
(55, NULL, '296', 'mailto:mkg@mkgconcept.net', '29951595', '8200', NULL, 'en cours', 'step2', 'Opportunité', '2023-03-31 12:59:09', '2023-03-31 12:59:38'),
(56, NULL, '297', 'COTUNAV@CTN.COM.TN', '71322802', '33617', NULL, 'en cours', 'step2', 'Opportunité', '2023-03-31 13:19:49', '2023-03-31 13:19:49'),
(57, NULL, '298', 'createam@planet.tn', '71 900 602 - 71 900 632', '9000', NULL, 'en cours', 'step2', 'Opportunité', '2023-04-04 08:22:16', '2023-04-04 08:22:16'),
(58, NULL, '299', 'ISTH@gmail.com', '71575514', '8500', NULL, 'en cours', 'step3', 'Opportunité', '2023-04-04 09:15:24', '2023-04-11 12:38:51'),
(59, NULL, '301', 'J\'attendl\'email', '22129670', '1730', NULL, 'en cours', 'step2', 'Opportunité', '2023-04-13 13:18:33', '2023-04-13 13:18:33');

-- --------------------------------------------------------

--
-- Structure de la table `oportunitys_devis`
--

CREATE TABLE `oportunitys_devis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oportunity_id` varchar(255) NOT NULL,
  `devis_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oportunitys_devis`
--

INSERT INTO `oportunitys_devis` (`id`, `oportunity_id`, `devis_id`, `created_at`, `updated_at`) VALUES
(1, '21', '42', '2023-02-23 13:29:58', '2023-02-23 13:29:58'),
(2, '21', '43', '2023-02-23 13:30:06', '2023-02-23 13:30:06'),
(3, '21', '44', '2023-02-23 13:30:21', '2023-02-23 13:30:21'),
(4, '11', '45', '2023-02-23 13:31:03', '2023-02-23 13:31:03'),
(5, '21', '46', '2023-02-23 14:39:03', '2023-02-23 14:39:03'),
(6, '22', '47', '2023-02-23 15:19:19', '2023-02-23 15:19:19'),
(13, '51', '70', '2023-03-13 08:30:34', '2023-03-13 08:30:34'),
(15, '55', '98', '2023-03-31 13:20:05', '2023-03-31 13:20:05'),
(16, '59', '124', '2023-05-04 14:23:21', '2023-05-04 14:23:21'),
(17, '59', '125', '2023-05-04 14:24:00', '2023-05-04 14:24:00');

-- --------------------------------------------------------

--
-- Structure de la table `oportunitys_factures`
--

CREATE TABLE `oportunitys_factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oportunity_id` varchar(255) NOT NULL,
  `facture_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oportunitys_factures`
--

INSERT INTO `oportunitys_factures` (`id`, `oportunity_id`, `facture_id`, `created_at`, `updated_at`) VALUES
(1, '17', '54', '2023-02-23 14:26:32', '2023-02-23 14:26:32'),
(2, '17', '55', '2023-02-23 14:26:50', '2023-02-23 14:26:50'),
(3, '17', '56', '2023-02-23 14:28:16', '2023-02-23 14:28:16'),
(4, '17', '57', '2023-02-23 14:29:38', '2023-02-23 14:29:38'),
(5, '21', '58', '2023-02-23 14:40:23', '2023-02-23 14:40:23');

-- --------------------------------------------------------

--
-- Structure de la table `ordres`
--

CREATE TABLE `ordres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `devis_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `facture_id` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `user_id`, `facture_id`, `method`, `montant`, `note`, `type`, `date`, `created_at`, `updated_at`) VALUES
(4, '3', '32', 'virement', '1905', NULL, NULL, '2023-02-03', '2023-02-03 10:28:21', '2023-02-03 10:28:21'),
(5, '3', '26', 'cheque', '2024', NULL, NULL, '2023-02-03', '2023-02-03 10:30:24', '2023-02-03 10:30:24'),
(7, '3', '22', 'cheque', '1072', NULL, NULL, '2023-02-03', '2023-02-03 15:43:47', '2023-02-03 15:43:47'),
(8, '3', '21', 'cheque', '387.5', NULL, NULL, '2023-02-03', '2023-02-03 15:44:05', '2023-02-03 15:44:05'),
(9, '3', '12', 'cheque', '596', NULL, NULL, '2023-02-03', '2023-02-03 15:44:34', '2023-02-03 15:44:34'),
(10, '3', '16', 'cheque', '477', NULL, NULL, '2023-02-13', '2023-02-13 16:00:08', '2023-02-13 16:00:08'),
(11, '1', '20', 'cheque', '2571.4', NULL, NULL, '2023-02-14', '2023-02-14 07:21:40', '2023-02-14 07:21:40'),
(12, '1', '14', 'cheque', '13062.941', NULL, NULL, '2023-02-14', '2023-02-14 07:22:09', '2023-02-14 07:22:09'),
(13, '3', '24', 'cheque', '1786', NULL, NULL, '2023-02-14', '2023-02-14 15:54:45', '2023-02-14 15:54:45'),
(14, '3', '52', 'cheque', '2272.367', NULL, NULL, '2023-02-16', '2023-02-16 10:04:22', '2023-02-16 10:04:22'),
(15, '3', '43', 'cheque', '310.4', NULL, NULL, '2023-02-16', '2023-02-16 10:05:30', '2023-02-16 10:05:30'),
(16, '3', '45', 'cheque', '6356.8', NULL, NULL, '2023-02-16', '2023-02-16 10:06:16', '2023-02-16 10:06:16'),
(17, '3', '46', 'cheque', '985', NULL, NULL, '2023-02-16', '2023-02-16 10:14:58', '2023-02-16 10:14:58'),
(18, '3', '31', 'cheque', '417.5', NULL, NULL, '2023-02-16', '2023-02-16 10:15:09', '2023-02-16 10:15:09'),
(19, '1', '19', 'virement', '298.5', NULL, NULL, '2023-02-20', '2023-02-20 09:42:43', '2023-02-20 09:42:43'),
(20, '1', '70', 'cheque', '1905', NULL, NULL, '2023-03-02', '2023-03-02 16:05:03', '2023-03-02 16:05:03'),
(21, '1', '52', 'cheque', '22.953', NULL, NULL, '2023-03-02', '2023-03-02 16:09:05', '2023-03-02 16:09:05'),
(22, '1', '57', 'virement', '4190.05', NULL, NULL, '2023-03-02', '2023-03-02 16:24:36', '2023-03-02 16:24:36'),
(23, '1', '58', 'virement', '596', NULL, NULL, '2023-03-02', '2023-03-02 16:25:21', '2023-03-02 16:25:21'),
(24, '1', '72', 'virement', '298.5', NULL, NULL, '2023-03-07', '2023-03-07 07:05:43', '2023-03-07 07:05:43'),
(25, '1', '56', 'cheque', '1072', NULL, NULL, '2023-03-07', '2023-03-07 07:06:29', '2023-03-07 07:06:29'),
(26, '1', '11', 'virement', '1905', NULL, NULL, '2023-03-07', '2023-03-07 07:06:50', '2023-03-07 07:06:50'),
(27, '3', '71', 'cheque', '1786', NULL, NULL, '2023-03-09', '2023-03-09 10:39:20', '2023-03-09 10:39:20'),
(28, '3', '68', 'cheque', '2024', NULL, NULL, '2023-03-09', '2023-03-09 13:30:43', '2023-03-09 13:30:43'),
(29, '3', '64', 'cheque', '1905', NULL, NULL, '2023-03-09', '2023-03-09 14:49:58', '2023-03-09 14:49:58'),
(30, '3', '55', 'virement', '1500.4', NULL, NULL, '2023-03-09', '2023-03-09 14:50:14', '2023-03-09 14:50:14'),
(31, '3', '86', 'virement', '273', NULL, NULL, '2023-03-09', '2023-03-09 15:54:00', '2023-03-09 15:54:00'),
(32, '3', '87', 'cheque', '2854.98', NULL, NULL, '2023-03-10', '2023-03-10 07:35:47', '2023-03-10 07:35:47'),
(33, '3', '17', 'cheque', '239', NULL, NULL, '2023-03-10', '2023-03-10 12:34:45', '2023-03-10 12:34:45'),
(34, '3', '60', 'cheque', '477', NULL, NULL, '2023-03-15', '2023-03-15 07:20:30', '2023-03-15 07:20:30'),
(35, '3', '39', 'virement', '560', NULL, NULL, '2023-03-15', '2023-03-15 09:35:34', '2023-03-15 09:35:34'),
(36, '3', '69', 'cheque', '596', NULL, NULL, '2023-03-17', '2023-03-17 07:44:29', '2023-03-17 07:44:29'),
(37, '1', '75', 'cheque', '2806.046', NULL, NULL, '2023-03-17', '2023-03-17 15:59:55', '2023-03-17 15:59:55'),
(38, '1', '94', 'cheque', '902.47', NULL, NULL, '2023-03-22', '2023-03-22 14:51:24', '2023-03-22 14:51:24'),
(39, '1', '75', 'cheque', '28.344', NULL, NULL, '2023-03-23', '2023-03-23 06:56:29', '2023-03-23 06:56:29'),
(40, '1', '63', 'cheque', '2902.267', NULL, NULL, '2023-03-23', '2023-03-23 06:58:53', '2023-03-23 06:58:53'),
(41, '1', '27', 'virement', '703', NULL, NULL, '2023-03-23', '2023-03-23 07:00:55', '2023-03-23 07:00:55'),
(42, '3', '90', 'cheque', '411.55', NULL, NULL, '2023-03-23', '2023-03-23 10:55:36', '2023-03-23 10:55:36'),
(43, '3', '62', 'virement', '340.15', NULL, NULL, '2023-03-24', '2023-03-24 11:52:14', '2023-03-24 11:52:14'),
(45, '5', '100', 'cheque', '1000', NULL, NULL, '2023-03-27', '2023-03-27 12:40:29', '2023-03-27 12:40:29'),
(46, '3', '104', 'virement', '596', NULL, NULL, '2023-03-29', '2023-03-29 07:06:50', '2023-03-29 07:06:50'),
(47, '3', '105', 'virement', '298.5', NULL, NULL, '2023-03-29', '2023-03-29 07:07:10', '2023-03-29 07:07:10'),
(48, '3', '97', 'cheque', '459', NULL, NULL, '2023-03-30', '2023-03-30 12:21:28', '2023-03-30 12:21:28'),
(49, '1', '96', 'cheque', '1354.75', NULL, NULL, '2023-03-31', '2023-03-31 07:07:00', '2023-03-31 07:07:00'),
(50, '1', '158', 'cheque', '207.74', NULL, NULL, '2023-04-11', '2023-04-11 07:16:38', '2023-04-11 07:16:38'),
(51, '1', '112', 'virement', '1905', NULL, NULL, '2023-04-11', '2023-04-11 07:20:09', '2023-04-11 07:20:09'),
(52, '1', '156', 'virement', '94.772', NULL, NULL, '2023-04-11', '2023-04-11 07:20:35', '2023-04-11 07:20:35'),
(53, '1', '119', 'virement', '2857', NULL, NULL, '2023-04-11', '2023-04-11 07:21:50', '2023-04-11 07:21:50'),
(54, '1', '106', 'virement', '715', NULL, NULL, '2023-04-11', '2023-04-11 07:24:28', '2023-04-11 07:24:28'),
(55, '3', '110', 'cheque', '2024', NULL, NULL, '2023-04-11', '2023-04-11 07:35:09', '2023-04-11 07:35:09'),
(56, '3', '95', 'cheque', '893.5', NULL, NULL, '2023-04-11', '2023-04-11 07:35:29', '2023-04-11 07:35:29'),
(57, '3', '63', 'cheque', '2902.267', NULL, NULL, '2023-04-11', '2023-04-11 08:06:58', '2023-04-11 08:06:58'),
(58, '1', '129', 'cheque', '494.6', NULL, NULL, '2023-04-13', '2023-04-13 07:34:31', '2023-04-13 07:34:31'),
(59, '1', '168', 'cheque', '3000', NULL, NULL, '2023-04-13', '2023-04-13 07:38:02', '2023-04-13 07:38:02'),
(60, '3', '176', 'virement', '1000', NULL, NULL, '2023-04-14', '2023-04-14 12:43:27', '2023-04-14 12:43:27'),
(61, '3', '99', 'cheque', '834', NULL, NULL, '2023-04-17', '2023-04-17 07:42:42', '2023-04-17 07:42:42'),
(62, '3', '98', 'cheque', '196.815', NULL, NULL, '2023-04-17', '2023-04-17 07:42:59', '2023-04-17 07:42:59'),
(63, '1', '172', 'virement', '771.4', NULL, NULL, '2023-04-19', '2023-04-19 07:21:00', '2023-04-19 07:21:00'),
(64, '1', '166', 'virement', '417.5', NULL, NULL, '2023-04-19', '2023-04-19 07:21:37', '2023-04-19 07:21:37'),
(65, '1', '157', 'cheque', '130.472', NULL, NULL, '2023-04-19', '2023-04-19 07:22:13', '2023-04-19 07:22:13'),
(66, '1', '109', 'virement', '1786', NULL, NULL, '2023-04-19', '2023-04-19 07:23:58', '2023-04-19 07:23:58'),
(67, '1', '74', 'cheque', '876', NULL, NULL, '2023-04-19', '2023-04-19 07:24:45', '2023-04-19 07:24:45'),
(68, '3', '175', 'cheque', '2024', NULL, NULL, '2023-04-19', '2023-04-19 11:29:54', '2023-04-19 11:29:54'),
(69, '3', '164', 'cheque', '2426.787', NULL, NULL, '2023-04-19', '2023-04-19 11:30:13', '2023-04-19 11:30:13'),
(70, '3', '108', 'cheque', '1072', NULL, NULL, '2023-05-03', '2023-05-03 12:35:03', '2023-05-03 12:35:03'),
(71, '3', '120', 'cheque', '482.5', NULL, NULL, '2023-05-03', '2023-05-03 12:35:17', '2023-05-03 12:35:17'),
(72, '3', '188', 'cheque', '1072', NULL, NULL, '2023-05-03', '2023-05-03 12:35:40', '2023-05-03 12:35:40'),
(73, '1', '193', 'cheque', '2678.5', NULL, NULL, '2023-05-04', '2023-05-05 07:25:12', '2023-05-05 07:25:12'),
(74, '1', '186', 'virement', '298.5', NULL, NULL, '2023-05-08', '2023-05-08 08:26:14', '2023-05-08 08:26:14'),
(75, '1', '121', 'virement', '161.5', NULL, NULL, '2023-05-02', '2023-05-08 08:29:01', '2023-05-08 08:29:01'),
(76, '1', '183', 'virement', '596', NULL, NULL, '2023-05-08', '2023-05-08 08:29:19', '2023-05-08 08:29:19'),
(77, '1', '191', 'cheque', '351', NULL, NULL, '2023-05-08', '2023-05-09 07:49:17', '2023-05-09 07:49:17'),
(78, '1', '218', 'cheque', '359', NULL, NULL, '2023-05-08', '2023-05-09 07:50:17', '2023-05-09 07:50:17'),
(79, '1', '53', 'cheque', '351', NULL, NULL, '2023-03-09', '2023-05-09 07:51:08', '2023-05-09 07:51:08'),
(80, '3', '219', 'cheque', '835.6', NULL, NULL, '2023-05-08', '2023-05-09 08:58:47', '2023-05-09 08:58:47'),
(81, '3', '182', 'cheque', '239', NULL, NULL, '2023-05-08', '2023-05-09 08:58:58', '2023-05-09 08:58:58'),
(82, '3', '101', 'cheque', '4754.515', NULL, NULL, '2023-05-09', '2023-05-09 15:00:44', '2023-05-09 15:00:44'),
(83, '1', '91', 'virement', '2189.6', NULL, NULL, '2023-05-09', '2023-05-09 15:38:52', '2023-05-09 15:38:52'),
(84, '1', '164', 'cheque', '24.513', NULL, NULL, '2023-05-09', '2023-05-09 17:24:22', '2023-05-09 17:24:22'),
(85, '1', '260', 'cheque', '4000', NULL, NULL, '2023-03-27', '2023-05-09 17:31:04', '2023-05-09 17:31:04'),
(86, '1', '59', 'cheque', '1376.64', NULL, NULL, '2023-03-23', '2023-05-10 09:24:11', '2023-05-10 09:24:11'),
(87, '1', '107', 'virement', '1905', NULL, NULL, '2023-05-10', '2023-05-10 09:43:28', '2023-05-10 09:43:28'),
(88, '1', '122', 'virement', '1367.12', NULL, NULL, '2023-05-10', '2023-05-10 09:44:16', '2023-05-10 09:44:16'),
(89, '1', '127', 'virement', '358', NULL, NULL, '2023-05-10', '2023-05-10 09:44:40', '2023-05-10 09:44:40'),
(90, '1', '177', 'virement', '1607.5', NULL, NULL, '2023-05-10', '2023-05-10 09:44:56', '2023-05-10 09:44:56');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nb_conges` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `nb_conges`, `created_at`, `updated_at`) VALUES
(1, '21', '2023-04-27 15:13:57', '2023-04-27 15:28:42');

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
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'clients', NULL, NULL),
(2, 'catalogues', NULL, NULL),
(3, 'devis', NULL, NULL),
(4, 'factures', NULL, NULL),
(5, 'paiements', NULL, NULL),
(6, 'interventions', NULL, NULL),
(7, 'entreprises', NULL, NULL),
(8, 'taxes', NULL, NULL),
(9, 'categories', NULL, NULL),
(10, 'utilisateurs', NULL, NULL),
(11, 'roles', NULL, NULL),
(12, 'groupes', '2023-01-27 09:38:30', '2023-01-27 09:38:30'),
(13, 'fournisseurs', '2023-01-27 09:38:30', '2023-01-27 09:38:30'),
(14, 'depenses', '2023-01-27 09:38:30', '2023-01-27 09:38:30'),
(15, 'chiffres', '2023-02-02 07:54:39', '2023-02-02 07:54:39'),
(16, 'contacts', '2023-02-24 08:57:58', '2023-02-24 08:57:58'),
(17, 'opportunites', '2023-02-24 08:57:59', '2023-02-24 08:57:59'),
(18, 'calendrier', '2023-02-24 08:57:59', '2023-02-24 08:57:59'),
(19, 'bonlivraison', '2023-02-28 15:19:53', '2023-02-28 15:19:53'),
(20, 'contrat', '2023-03-07 09:18:21', '2023-03-07 09:18:21'),
(21, 'boncommande', '2023-03-09 07:18:14', '2023-03-09 07:18:14'),
(22, 'devise', '2023-03-09 07:18:14', '2023-03-09 07:18:14'),
(23, 'conges', '2023-04-28 13:04:17', '2023-04-28 13:04:17'),
(24, 'conges_admin', '2023-04-28 13:04:17', '2023-04-28 13:04:17');

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `permission_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(2, '1', '2', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(3, '1', '3', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(4, '1', '4', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(5, '1', '5', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(6, '1', '6', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(7, '1', '7', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(8, '1', '8', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(9, '1', '9', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(10, '1', '10', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(11, '1', '11', '2023-01-04 07:54:27', '2023-01-04 07:54:27'),
(12, '2', '3', '2023-01-06 12:27:51', '2023-01-06 12:27:51'),
(13, '3', '1', '2023-01-06 12:48:00', '2023-01-06 12:48:00'),
(14, '3', '2', '2023-01-06 12:48:00', '2023-01-06 12:48:00'),
(15, '3', '3', '2023-01-06 12:48:00', '2023-01-06 12:48:00'),
(16, '4', '1', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(17, '4', '2', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(18, '4', '3', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(19, '4', '4', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(20, '4', '5', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(21, '5', '1', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(22, '5', '2', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(23, '5', '3', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(24, '5', '4', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(25, '5', '5', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(26, '5', '6', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(27, '5', '7', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(28, '5', '8', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(29, '5', '9', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(30, '5', '10', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(31, '5', '11', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(32, '1', '12', NULL, NULL),
(33, '1', '13', NULL, NULL),
(34, '1', '14', NULL, NULL),
(35, '5', '12', NULL, NULL),
(36, '5', '13', NULL, NULL),
(37, '5', '14', NULL, NULL),
(38, '4', '13', '2023-02-01 09:24:43', '2023-02-01 09:24:43'),
(39, '4', '14', '2023-02-01 09:24:43', '2023-02-01 09:24:43'),
(40, '1', '15', NULL, NULL),
(41, '5', '15', NULL, NULL),
(42, '6', '1', '2023-02-02 07:58:11', '2023-02-02 07:58:11'),
(43, '6', '14', '2023-02-02 07:58:11', '2023-02-02 07:58:11'),
(45, '3', '5', '2023-02-03 10:33:42', '2023-02-03 10:33:42'),
(46, '7', '6', '2023-02-03 10:34:29', '2023-02-03 10:34:29'),
(47, '8', '1', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(48, '8', '2', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(49, '8', '3', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(50, '8', '5', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(51, '8', '6', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(52, '8', '10', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(53, '9', '1', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(54, '9', '2', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(55, '9', '3', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(56, '9', '4', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(57, '9', '5', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(58, '9', '6', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(59, '9', '7', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(60, '9', '8', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(61, '9', '9', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(62, '9', '10', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(63, '9', '11', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(64, '9', '12', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(65, '9', '13', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(66, '9', '14', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(67, '9', '15', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(68, '1', '16', NULL, NULL),
(69, '1', '17', NULL, NULL),
(70, '1', '18', NULL, NULL),
(71, '5', '16', NULL, NULL),
(72, '5', '17', NULL, NULL),
(73, '5', '18', NULL, NULL),
(74, '9', '16', NULL, NULL),
(75, '9', '17', NULL, NULL),
(76, '9', '18', NULL, NULL),
(79, '10', '17', '2023-02-24 09:04:06', '2023-02-24 09:04:06'),
(80, '10', '18', '2023-02-24 09:04:06', '2023-02-24 09:04:06'),
(82, '1', '19', NULL, NULL),
(83, '5', '19', NULL, NULL),
(84, '9', '19', NULL, NULL),
(85, '1', '20', NULL, NULL),
(86, '5', '20', NULL, NULL),
(87, '9', '20', NULL, NULL),
(88, '4', '20', '2023-03-07 10:38:24', '2023-03-07 10:38:24'),
(89, '1', '21', NULL, NULL),
(90, '1', '22', NULL, NULL),
(91, '5', '21', NULL, NULL),
(92, '5', '22', NULL, NULL),
(93, '9', '21', NULL, NULL),
(94, '9', '22', NULL, NULL),
(95, '3', '19', '2023-03-09 08:32:45', '2023-03-09 08:32:45'),
(96, '3', '21', '2023-03-09 08:32:45', '2023-03-09 08:32:45'),
(97, '4', '19', '2023-03-09 08:33:02', '2023-03-09 08:33:02'),
(98, '4', '21', '2023-03-09 08:33:02', '2023-03-09 08:33:02'),
(99, '3', '16', '2023-03-09 16:00:16', '2023-03-09 16:00:16'),
(100, '3', '17', '2023-03-09 16:00:16', '2023-03-09 16:00:16'),
(101, '3', '18', '2023-03-09 16:00:16', '2023-03-09 16:00:16'),
(102, '3', '13', '2023-03-10 08:44:50', '2023-03-10 08:44:50'),
(103, '11', '1', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(104, '11', '2', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(105, '11', '3', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(106, '11', '4', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(107, '11', '5', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(108, '11', '6', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(109, '11', '16', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(110, '11', '17', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(111, '11', '18', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(112, '11', '19', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(113, '11', '20', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(114, '11', '21', '2023-03-21 13:07:34', '2023-03-21 13:07:34'),
(115, '1', '23', NULL, NULL),
(116, '1', '24', NULL, NULL),
(117, '5', '23', NULL, NULL),
(118, '5', '24', NULL, NULL),
(119, '9', '23', NULL, NULL),
(120, '9', '24', NULL, NULL),
(121, '7', '23', '2023-04-28 14:36:30', '2023-04-28 14:36:30'),
(122, '11', '23', '2023-04-28 14:36:38', '2023-04-28 14:36:38'),
(123, '8', '23', '2023-04-28 14:36:50', '2023-04-28 14:36:50'),
(124, '4', '23', '2023-04-28 14:37:00', '2023-04-28 14:37:00'),
(125, '3', '23', '2023-04-28 14:37:10', '2023-04-28 14:37:10');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reunions`
--

CREATE TABLE `reunions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oportunity_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start` varchar(255) DEFAULT NULL,
  `end` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#2B88B7',
  `status` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reunions`
--

INSERT INTO `reunions` (`id`, `oportunity_id`, `user_id`, `title`, `type`, `start`, `end`, `color`, `status`, `categorie`, `created_at`, `updated_at`) VALUES
(43, '59', '11', 'Opportunité ( Dance Beauty (École de danse) )', 'en_ligne', 'Tue May 09 2023 09:21:00 GMT+0000', 'Tue May 09 2023 09:51:00 GMT+0000', '#1874A2', 'en attente', NULL, '2023-05-04 14:17:46', '2023-05-09 14:17:02');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', '2023-01-04 07:54:26', '2023-01-04 07:54:26'),
(3, 'commercial', '2023-01-06 12:48:00', '2023-01-06 12:48:00'),
(4, 'facturation', '2023-01-06 12:48:33', '2023-01-06 12:48:33'),
(5, 'Administrateur', '2023-01-17 07:44:13', '2023-01-17 07:44:13'),
(7, 'Tchnique', '2023-02-03 10:34:29', '2023-02-03 10:34:29'),
(8, 'supertechnique', '2023-02-03 10:35:06', '2023-02-03 10:35:06'),
(9, 'Administrateur', '2023-02-07 13:05:48', '2023-02-07 13:05:48'),
(11, 'Superviseur', '2023-03-21 13:07:34', '2023-03-21 13:07:34');

-- --------------------------------------------------------

--
-- Structure de la table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pourcentage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taxes`
--

INSERT INTO `taxes` (`id`, `nom`, `pourcentage`, `created_at`, `updated_at`) VALUES
(1, '7%', '7', '2023-01-04 13:03:28', '2023-01-04 13:03:28'),
(3, '19 %', '19', '2023-01-04 13:03:47', '2023-01-04 13:03:47'),
(4, 'Exonéré', '0', '2023-01-04 13:03:54', '2023-01-04 13:03:54');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `telephone`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'kais euchi', 'admin', '12345678', 'k.euchi@next.tn', NULL, '$2y$10$kMa9VS10vN5H1WkHzFOfK.ZO.jdzXFui/zGVn3lQXah6Ru6lp3kNi', '1', NULL, '2023-01-04 07:54:27', '2023-01-05 16:16:33', 'user.png'),
(3, 'Omayma_Touj', 'user', '90215998', 'o.toujani@next.tn', NULL, '$2y$10$D34r//wrHK/9k1ZVxKIG.ulpfBm9fBkvnZnkbx7vrgMFDm97XvY9C', '4', NULL, '2023-01-06 12:50:09', '2023-03-21 08:34:23', '16793876631984066402.jpeg'),
(4, 'Amine', 'user', '98144244', 'a.assili@next.tn', NULL, '$2y$10$WMyo/O5kFiI9NALAWaQJwu/cMEgmGfOGI.I9s5YUv05MrKUXO73yO', '3', NULL, '2023-01-06 12:51:08', '2023-01-06 12:51:08', 'user.png'),
(5, 'seif', 'admin', '23428834', 's.chehab@next.tn', NULL, '$2y$10$IVYJppxxO01KOfiznJXaMOw8sNB8cy0bkISzBO092LfNOy6qLGW1.', '5', NULL, '2023-01-17 07:44:13', '2023-03-17 11:33:26', '16790522621748017734.jpg'),
(7, 'Anwer Ochi', 'user', '90215974', 'a.ochi@next.tn', NULL, '$2y$10$PJGXRsNcYD58g/qI5/.rxe.MTo2Jve4/9mjIF2Arzwg2LhpcnwxLG', '11', NULL, '2023-02-03 10:37:25', '2023-03-31 09:17:43', 'user.png'),
(8, 'test', 'admin', '12345678', 'test@gmail.com', NULL, '$2y$10$yu0a2BVIEqFmgHwlretpYutgjn6LkUOQX9m352uTG0bNB8.PZvUJK', '9', NULL, '2023-02-07 13:05:48', '2023-02-07 13:05:48', 'user.png'),
(10, 'Khalil', 'user', '92920104', 'k.mahjoubi@next.tn', NULL, '$2y$10$oqNdqcJ30OCdQQAcSCpieeC96yeB0yoT4ycYHGPrgVSygZdD/S5h.', '3', NULL, '2023-03-02 14:56:03', '2023-03-02 14:56:03', 'user.png'),
(11, 'Mehdi Houas', 'user', '58408278', 'm.houas@next.tn', NULL, '$2y$10$X9ICKCh/BW9gm6.woA2Nju0hgmcTCrokqYyZvWUUKbr16nKGfP0XW', '3', NULL, '2023-05-04 08:09:14', '2023-05-04 08:09:14', 'user.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boncommandes`
--
ALTER TABLE `boncommandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bonlivraisons`
--
ALTER TABLE `bonlivraisons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `catalogues`
--
ALTER TABLE `catalogues`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contactscrm`
--
ALTER TABLE `contactscrm`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrats_factures`
--
ALTER TABLE `contrats_factures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customnotifs`
--
ALTER TABLE `customnotifs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `datesconges`
--
ALTER TABLE `datesconges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `devises`
--
ALTER TABLE `devises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `elementgroupes`
--
ALTER TABLE `elementgroupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facturecontrats`
--
ALTER TABLE `facturecontrats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `factures_ordres`
--
ALTER TABLE `factures_ordres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `frais`
--
ALTER TABLE `frais`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itembonlivraisons`
--
ALTER TABLE `itembonlivraisons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itemdevis`
--
ALTER TABLE `itemdevis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itemfactures`
--
ALTER TABLE `itemfactures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itemordres`
--
ALTER TABLE `itemordres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itemsboncommandes`
--
ALTER TABLE `itemsboncommandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itemsfacturecontrats`
--
ALTER TABLE `itemsfacturecontrats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oportunitys`
--
ALTER TABLE `oportunitys`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oportunitys_devis`
--
ALTER TABLE `oportunitys_devis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oportunitys_factures`
--
ALTER TABLE `oportunitys_factures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ordres`
--
ALTER TABLE `ordres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `reunions`
--
ALTER TABLE `reunions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taxes`
--
ALTER TABLE `taxes`
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
-- AUTO_INCREMENT pour la table `boncommandes`
--
ALTER TABLE `boncommandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `bonlivraisons`
--
ALTER TABLE `bonlivraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `catalogues`
--
ALTER TABLE `catalogues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contactscrm`
--
ALTER TABLE `contactscrm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `contrats_factures`
--
ALTER TABLE `contrats_factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `customnotifs`
--
ALTER TABLE `customnotifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `datesconges`
--
ALTER TABLE `datesconges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `devises`
--
ALTER TABLE `devises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `elementgroupes`
--
ALTER TABLE `elementgroupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facturecontrats`
--
ALTER TABLE `facturecontrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT pour la table `factures_ordres`
--
ALTER TABLE `factures_ordres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `frais`
--
ALTER TABLE `frais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `itembonlivraisons`
--
ALTER TABLE `itembonlivraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `itemdevis`
--
ALTER TABLE `itemdevis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT pour la table `itemfactures`
--
ALTER TABLE `itemfactures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT pour la table `itemordres`
--
ALTER TABLE `itemordres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `itemsboncommandes`
--
ALTER TABLE `itemsboncommandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `itemsfacturecontrats`
--
ALTER TABLE `itemsfacturecontrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `oportunitys`
--
ALTER TABLE `oportunitys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `oportunitys_devis`
--
ALTER TABLE `oportunitys_devis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `oportunitys_factures`
--
ALTER TABLE `oportunitys_factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ordres`
--
ALTER TABLE `ordres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reunions`
--
ALTER TABLE `reunions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
