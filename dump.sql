-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Version du serveur : 5.7.40
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `3wa_projectrunning`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D860BF7AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bank`
--

INSERT INTO `bank` (`id`, `user_id`, `account`) VALUES
(1, 1, 0),
(2, 2, 76),
(3, 3, 42),
(4, 4, 217),
(5, 5, 20),
(6, 6, 20);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

DROP TABLE IF EXISTS `categorie_produit`;
CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`id`, `nom`) VALUES
(1, 'Chaussure'),
(2, 'Montre');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `reference`, `date_creation`) VALUES
(1, 1, '64ff08c8471e4', '2023-09-11 12:32:08'),
(2, 2, '64ff09c925767', '2023-09-11 12:36:25'),
(3, 2, '64ff0b434f714', '2023-09-11 12:42:43'),
(4, 2, '64ff0bba3fbe1', '2023-09-11 12:44:42'),
(5, 2, '64ff0ca5e36fc', '2023-09-11 12:48:37'),
(6, 2, '64ff0fb439268', '2023-09-11 13:01:40'),
(7, 2, '65001547872e4', '2023-09-12 07:37:43'),
(8, 2, '650037eb38748', '2023-09-12 10:05:31'),
(9, 2, '65003d314687f', '2023-09-12 10:28:01'),
(10, 3, '65003e4e425e7', '2023-09-12 10:32:46'),
(11, 3, '65004fcb6feb8', '2023-09-12 11:47:23'),
(12, 3, '65008cd779997', '2023-09-12 16:07:51'),
(13, 3, '65008d3e0e696', '2023-09-12 16:09:34'),
(14, 3, '65008f4b50660', '2023-09-12 16:18:19'),
(15, 3, '65009daa88027', '2023-09-12 17:19:38'),
(16, 3, '65009e103a0e9', '2023-09-12 17:21:20'),
(17, 3, '65009ec151fd0', '2023-09-12 17:24:17'),
(18, 3, '65009f1bdac93', '2023-09-12 17:25:47'),
(19, 3, '6500a1ef3c4e1', '2023-09-12 17:37:51'),
(20, 3, '6501669ccb868', '2023-09-13 07:37:00'),
(21, 3, '650167589aef9', '2023-09-13 07:40:08'),
(22, 3, '65016ac9545c0', '2023-09-13 07:54:49'),
(23, 3, '65016aefdd5a4', '2023-09-13 07:55:27'),
(24, 3, '65016b5161680', '2023-09-13 07:57:05'),
(25, 3, '65016dea2f123', '2023-09-13 08:08:10'),
(26, 3, '65016e4dd71d4', '2023-09-13 08:09:49'),
(27, 3, '65016eb7c8d74', '2023-09-13 08:11:35'),
(28, 3, '65016fc80999e', '2023-09-13 08:16:08'),
(29, 3, '650170d6e25a5', '2023-09-13 08:20:38'),
(30, 3, '650171465d7a9', '2023-09-13 08:22:30'),
(31, 3, '650172649e636', '2023-09-13 08:27:16'),
(32, 3, '65017270ac7c3', '2023-09-13 08:27:28'),
(33, 3, '6501733c8f987', '2023-09-13 08:30:52'),
(34, 3, '6501735092da4', '2023-09-13 08:31:12'),
(35, 3, '650173c60f7c3', '2023-09-13 08:33:10'),
(36, 3, '6501770be4d19', '2023-09-13 08:47:07'),
(37, 1, '65017d722607a', '2023-09-13 09:14:26'),
(38, 1, '65017d809afba', '2023-09-13 09:14:40'),
(39, 3, '6502b7d505309', '2023-09-14 07:35:49'),
(40, 4, '65042eefd36ee', '2023-09-15 10:16:15'),
(41, 1, '65167b545beba', '2023-09-29 07:23:00'),
(42, 1, '65167b83815da', '2023-09-29 07:23:47'),
(43, 1, '65167bf56f148', '2023-09-29 07:25:41'),
(44, 1, '65167c90c468e', '2023-09-29 07:28:16'),
(45, 1, '6516c6d6caf5b', '2023-09-29 12:45:10'),
(46, 1, '6516ca7ce5915', '2023-09-29 13:00:44'),
(47, 1, '6516cbf9b3a30', '2023-09-29 13:07:05'),
(48, 1, '6516cef4c2bc3', '2023-09-29 13:19:48'),
(49, 1, '6516edc3f2013', '2023-09-29 15:31:15'),
(50, 1, '6516ee032e2e8', '2023-09-29 15:32:19'),
(51, 1, '6516ee1d14daf', '2023-09-29 15:32:45'),
(52, 1, '6516ee3bc4555', '2023-09-29 15:33:15'),
(53, 1, '6516ee7419167', '2023-09-29 15:34:12'),
(54, 1, '65180ac1e0d81', '2023-09-30 11:47:13'),
(55, 1, '65192be551322', '2023-10-01 08:20:53'),
(56, 2, '651a8692701a9', '2023-10-02 09:00:02'),
(57, 2, '651acb566ea83', '2023-10-02 13:53:26'),
(58, 2, '651acb8ea9e70', '2023-10-02 13:54:22'),
(59, 2, '651acd95a42fb', '2023-10-02 14:03:01'),
(60, 2, '651ace58bc8f0', '2023-10-02 14:06:16'),
(61, 2, '651ace92169f0', '2023-10-02 14:07:14'),
(62, 2, '651bbddab1179', '2023-10-03 07:08:10'),
(63, 3, '651bc056c8452', '2023-10-03 07:18:46'),
(64, 2, '651c2ecf7e23f', '2023-10-03 15:10:07'),
(65, 2, '651c442e46145', '2023-10-03 16:41:18'),
(66, 2, '651d7e210fe37', '2023-10-04 15:00:49'),
(67, 2, '651daba0486b0', '2023-10-04 18:14:56'),
(68, 2, '651fb4e31e34a', '2023-10-06 07:18:59'),
(69, 2, '651fb6736330f', '2023-10-06 07:25:39'),
(70, 2, '651fc9a5d7712', '2023-10-06 08:47:33'),
(71, 2, '651fcb8283361', '2023-10-06 08:55:30'),
(72, 2, '651fcc239e070', '2023-10-06 08:58:11'),
(73, 2, '651fd0eabe60d', '2023-10-06 09:18:34'),
(74, 2, '651fd520a1531', '2023-10-06 09:36:32'),
(75, 2, '65200c455fb3b', '2023-10-06 13:31:49'),
(76, 2, '65200dd4268c6', '2023-10-06 13:38:28'),
(77, 2, '6520125356c91', '2023-10-06 13:57:39'),
(78, 1, '65211c82c6a40', '2023-10-07 08:53:22'),
(79, 1, '652134479cb8c', '2023-10-07 10:34:47'),
(81, 2, '6522686693b5b', '2023-10-08 08:29:26'),
(82, 2, '652268d038965', '2023-10-08 08:31:12'),
(83, 2, '6522698477218', '2023-10-08 08:34:12'),
(84, 2, '652269cd9192c', '2023-10-08 08:35:25'),
(85, 2, '65226a958b612', '2023-10-08 08:38:45'),
(86, 2, '65227f0d7f84c', '2023-10-08 10:06:05'),
(87, 2, '652289c9c085d', '2023-10-08 10:51:53'),
(88, 2, '6522d86484ee9', '2023-10-08 16:27:16'),
(93, 2, '6523f6e7050e8', '2023-10-09 12:49:43'),
(94, 2, '652434dfb82ce', '2023-10-09 17:14:07'),
(95, 4, '6525738843c23', '2023-10-10 15:53:44'),
(96, 4, '652573d8eda81', '2023-10-10 15:55:04');

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

DROP TABLE IF EXISTS `detail_commande`;
CREATE TABLE IF NOT EXISTS `detail_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_98344FA682EA2E54` (`commande_id`),
  KEY `IDX_98344FA6F347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_commande`
--

INSERT INTO `detail_commande` (`id`, `commande_id`, `produit_id`, `quantite`, `prix`) VALUES
(1, 1, 1, 2, 115),
(2, 1, 3, 1, 140),
(3, 2, 2, 2, 205),
(4, 2, 4, 1, 198),
(5, 3, 2, 1, 205),
(6, 4, 2, 1, 205),
(7, 5, 2, 2, 205),
(8, 5, 4, 1, 198),
(9, 6, 1, 2, 115),
(10, 6, 3, 1, 140),
(11, 6, 2, 2, 205),
(12, 7, 2, 2, 205),
(13, 7, 4, 3, 198),
(14, 8, 2, 2, 205),
(15, 8, 1, 2, 115),
(16, 9, 2, 1, 205),
(17, 9, 1, 1, 115),
(18, 9, 3, 1, 140),
(19, 9, 4, 2, 198),
(20, 10, 2, 1, 205),
(21, 10, 1, 2, 115),
(22, 11, 2, 1, 205),
(23, 11, 4, 3, 198),
(24, 12, 4, 6, 198),
(25, 12, 2, 3, 205),
(26, 13, 2, 2, 205),
(27, 13, 4, 1, 198),
(28, 14, 4, 2, 198),
(29, 14, 2, 1, 205),
(30, 15, 2, 2, 205),
(31, 15, 4, 1, 198),
(32, 16, 1, 1, 115),
(33, 16, 3, 3, 140),
(34, 17, 1, 1, 115),
(35, 18, 3, 1, 140),
(36, 19, 1, 1, 115),
(37, 20, 1, 2, 115),
(38, 21, 1, 2, 115),
(39, 22, 1, 1, 115),
(40, 23, 3, 2, 140),
(41, 24, 2, 2, 205),
(42, 24, 4, 2, 198),
(43, 25, 2, 2, 205),
(44, 25, 4, 3, 198),
(45, 26, 4, 3, 198),
(46, 27, 2, 1, 205),
(47, 28, 1, 2, 115),
(48, 28, 4, 1, 198),
(49, 29, 1, 1, 115),
(50, 29, 3, 1, 140),
(51, 30, 2, 1, 205),
(52, 31, 1, 3, 115),
(53, 32, 3, 2, 140),
(54, 33, 1, 1, 115),
(55, 34, 3, 2, 140),
(56, 35, 2, 1, 205),
(57, 36, 1, 5, 115),
(58, 37, 3, 1, 140),
(59, 38, 1, 2, 115),
(60, 39, 4, 1, 198),
(61, 40, 4, 1, 198),
(62, 41, 1, 1, 115),
(63, 42, 4, 1, 198),
(64, 43, 3, 1, 140),
(65, 44, 1, 3, 115),
(66, 45, 3, 3, 140),
(67, 45, 1, 2, 115),
(68, 46, 1, 3, 115),
(69, 47, 3, 1, 140),
(70, 48, 2, 1, 205),
(71, 48, 4, 2, 198),
(72, 49, 3, 1, 140),
(73, 50, 1, 2, 115),
(74, 50, 3, 1, 140),
(75, 51, 3, 3, 140),
(76, 52, 1, 1, 115),
(77, 53, 1, 2, 115),
(78, 53, 3, 3, 140),
(79, 54, 3, 1, 140),
(80, 54, 1, 2, 115),
(81, 55, 1, 1, 115),
(82, 55, 2, 2, 205),
(83, 55, 3, 1, 140),
(84, 56, 1, 3, 115),
(85, 56, 4, 1, 198),
(86, 57, 1, 2, 115),
(87, 57, 3, 1, 140),
(88, 57, 2, 1, 205),
(89, 57, 4, 1, 198),
(90, 58, 1, 1, 115),
(91, 59, 2, 1, 205),
(92, 60, 1, 2, 115),
(93, 60, 2, 1, 205),
(94, 61, 1, 1, 115),
(95, 62, 3, 1, 140),
(96, 62, 1, 2, 115),
(97, 62, 2, 1, 205),
(98, 63, 1, 1, 115),
(99, 63, 2, 2, 205),
(100, 64, 1, 2, 115),
(101, 64, 2, 1, 205),
(102, 65, 4, 1, 198),
(103, 65, 1, 1, 115),
(104, 66, 2, 1, 205),
(105, 66, 4, 1, 198),
(106, 67, 2, 2, 205),
(107, 67, 1, 1, 115),
(108, 68, 3, 2, 140),
(109, 68, 6, 1, 160),
(110, 68, 2, 1, 205),
(111, 69, 4, 1, 198),
(112, 70, 2, 1, 205),
(113, 70, 5, 2, 90),
(114, 71, 2, 2, 205),
(115, 72, 4, 2, 198),
(116, 72, 5, 1, 90),
(117, 73, 4, 2, 198),
(118, 73, 1, 1, 115),
(119, 74, 5, 1, 90),
(120, 74, 2, 2, 205),
(121, 74, 1, 1, 115),
(122, 75, 1, 1, 115),
(123, 75, 6, 1, 160),
(124, 76, 5, 1, 90),
(125, 76, 1, 1, 115),
(126, 77, 1, 2, 115),
(127, 78, 1, 1, 115),
(128, 79, 1, 1, 115),
(131, 81, 1, 1, 115),
(132, 81, 4, 1, 198),
(133, 82, 1, 1, 115),
(134, 82, 5, 1, 90),
(135, 82, 2, 3, 205),
(136, 83, 1, 1, 115),
(137, 84, 6, 1, 160),
(138, 85, 1, 1, 115),
(139, 85, 3, 3, 140),
(140, 85, 4, 2, 198),
(141, 86, 1, 1, 115),
(142, 86, 4, 2, 198),
(143, 87, 2, 2, 205),
(144, 87, 5, 2, 90),
(145, 88, 4, 2, 198),
(146, 88, 6, 1, 160),
(155, 93, 1, 1, 115),
(156, 93, 14, 2, 285),
(157, 94, 8, 1, 120),
(158, 95, 8, 2, 120),
(159, 95, 11, 1, 254),
(160, 95, 4, 2, 198),
(161, 96, 1, 1, 115);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230905142545', '2023-09-05 14:26:46', 123),
('DoctrineMigrations\\Version20230905144850', '2023-09-05 14:49:03', 41),
('DoctrineMigrations\\Version20230906084804', '2023-09-06 08:48:11', 83),
('DoctrineMigrations\\Version20230906115456', '2023-09-07 13:51:33', 48),
('DoctrineMigrations\\Version20230907140013', '2023-09-07 14:00:23', 49),
('DoctrineMigrations\\Version20230908170351', '2023-09-08 17:04:02', 517),
('DoctrineMigrations\\Version20230910103250', '2023-09-10 10:33:02', 282),
('DoctrineMigrations\\Version20230911094826', '2023-09-11 09:49:23', 550),
('DoctrineMigrations\\Version20230911095304', '2023-09-11 09:53:12', 257),
('DoctrineMigrations\\Version20230911115448', '2023-09-11 11:54:53', 34),
('DoctrineMigrations\\Version20230911121237', '2023-09-11 12:12:42', 75),
('DoctrineMigrations\\Version20230911123141', '2023-09-11 12:31:45', 40),
('DoctrineMigrations\\Version20230929140012', '2023-09-29 14:00:22', 134),
('DoctrineMigrations\\Version20231006093319', '2023-10-06 09:33:32', 355),
('DoctrineMigrations\\Version20231008123634', '2023-10-08 12:36:47', 86),
('DoctrineMigrations\\Version20231008150408', '2023-10-08 15:04:12', 32);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `categorie_id`, `nom`, `description`, `taille`, `couleur`, `prix`, `quantite`, `image`) VALUES
(1, 1, 'nimbus712', 'Les renforts au niveau du médio-pied vous dotent d\'un maintien efficace et la coque talonnière vient stabiliser l\'ensemble pour des sorties sportives plus sûres.', '44', 'blanc/bleu', 115, 1, '/photo/chaussure1.jpg'),
(2, 2, 'Venu 2SConnect', 'Le GPS est doté de la puce GNSS afin de proposer un suivi précis même dans les environnements les plus isolés', '1.8', 'noir', 205, 2, '/photo/montre1.jpg'),
(3, 1, 'airForce 4', 'chaussure confortable', '45', 'rose', 140, 0, '/photo/chaussure2.jpg'),
(4, 2, 'garmin 715', 'Montre de course GPS connectée dotée de toutes les fonctionnalités de course à pied dont vous avez besoin, avec un design élégant et léger.', '2', 'noir/rouge', 198, 1, '/photo/montre2.jpg'),
(5, 1, 'Meindl 72X', 'Chaussure pour marathon', '42', 'vert', 90, 4, '/photo/chaussure3.jpg'),
(6, 1, 'DNA Force', 'Chaussure avec semelle renforcée', '44', 'bleu', 160, 5, '/photo/chaussure4.jpg'),
(8, 1, 'Keep Running', 'Cette paire de chaussures est parfaite pour la course', '41', 'noir/rouge', 120, 0, '/photo/chaussure5.jpg'),
(9, 1, 'Gel-Excite 9', 'Les semelles intérieures sont en EVA. Elles offrent ainsi un confort optimal.', '42', 'noir', 99, 1, '/photo/chaussure6.jpg'),
(10, 1, 'Rincon 3', 'Matière supérieure en Maille', '43', 'bleu', 134, 2, '/photo/chaussure7.jpg'),
(11, 2, 'Montre Stylea Sportive', 'La montre mesure de façon précise et intelligente votre fréquence cardiaque', '1.2', 'noir', 254, 5, '/photo/montre3.jpg'),
(12, 2, 'Suunto 5', 'Montre de course compacte et légère pour les débutants.', '2', 'noir', 231, 3, '/photo/montre4.jpg'),
(13, 2, 'Apex 2 Pro', 'Bénéficiez une récupération adaptée grâce à un suivi de votre sommeil et de ses différentes phases.', '1.7', 'noir', 199, 5, '/photo/montre5.jpg'),
(14, 2, 'Fenix 7X Solar', 'Interface utilisateur avec écran tactile et 5 boutons pour une expérience simplifiée et plus intuitive', '2.25', 'noir', 285, 1, '/photo/montre6.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `adresse`) VALUES
(1, 'nicolas@orange.fr', '[\"ROLE_ADMIN\"]', '$2y$13$EVc.UMPvLjXTVcfQg8T14.E.3R5AYPrmFcij718YFg8Nb3CBNJ4sS', 'Massaï', 'Nicolas', 'rue saint-exupery'),
(2, 'test@test.fr', '[\"ROLE_USER\"]', '$2y$13$lJ89oqU5AuedSciIRZfRRuISHIV6iPIaxVGvwXiwAPV756tHChlqy', 'test', 'Test', 'Rue des oliviers'),
(3, 'dubois@adrien.fr', '[\"ROLE_USER\"]', '$2y$13$PcG7UESZwq121Ec/tXmA0.V6ejKhgRRfngsiE9Gw8XmXHgHfteiqm', 'Dubois', 'Adrien', 'chemin lf'),
(4, 'eric@frey.fr', '[\"ROLE_USER\"]', '$2y$13$iG/Km4gJ7ut0ljUUrSpgye7.NIDevIwK0v4rwnk3CawazXoQX3O6O', 'eric', 'frey', 'chemin saint-antoine'),
(5, 'franck@flag.fr', '[\"ROLE_USER\"]', '$2y$13$FqfbB6wdTSXGkLo1H.ljX.TRdWK6j/bvE5vz1AF1J7dehx0mY3pc6', 'Flag', 'Franck', 'avenue Saint-Exupéry'),
(6, 'jules@besot.fr', '[\"ROLE_USER\"]', '$2y$13$CmUJ4fAsFCxD//hd5AXVG.qetDpRoz2ib8jt4Ef0HxOdUbr0nz1se', 'Besot', 'Jules', 'rue de la France');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `FK_D860BF7AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `FK_98344FA682EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_98344FA6F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie_produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
