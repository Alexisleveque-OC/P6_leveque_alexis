-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 août 2020 à 10:07
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `trick_id`, `content`, `created_at`) VALUES
(30, 71, 38, 'Je vient d\'arriver et je trouve que c\'est vraiment un super site! Félicitation au développeur !', '2020-07-28 04:50:04'),
(31, 69, 38, 'Je suis d\'accord avec vous.', '2020-07-28 05:09:54'),
(32, 69, 38, 'Le site est super bien fait! beau boulot!', '2020-07-28 05:10:15'),
(33, 69, 38, 'On m\'a dit que c\'était le nouveau wiki des snowboarders !!! je confirme!', '2020-07-28 05:10:47'),
(34, 70, 38, 'Wahou!!! super figure! mais je pense pas avoir encore le niveau pour exécuter ça :(', '2020-07-28 05:11:53'),
(35, 70, 38, 'Très belle explication cela dit!', '2020-07-28 05:12:08'),
(36, 70, 38, 'Lorem ipsium c\'est la vie!', '2020-07-28 05:12:31'),
(37, 70, 38, 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Laboris nisi ut aliquip ex ea commodo consequat.', '2020-07-28 05:13:03'),
(38, 70, 38, 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Laboris nisi ut aliquip ex ea commodo consequat.', '2020-07-28 05:13:08'),
(39, 70, 38, 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Laboris nisi ut aliquip ex ea commodo consequat.', '2020-07-28 05:13:12'),
(45, 70, 38, 'coucou', '2020-07-30 04:55:13'),
(46, 70, 38, 'coucou2', '2020-07-30 05:06:10'),
(47, 70, 38, 'coucou3', '2020-07-30 05:06:18'),
(48, 70, 38, 'coucou4', '2020-07-30 05:06:27'),
(49, 70, 38, 'coucou5', '2020-07-30 05:14:31'),
(50, 70, 38, 'coucou6', '2020-07-30 05:14:39'),
(51, 70, 38, 'coucou7', '2020-07-30 05:14:47'),
(52, 70, 38, 'coucou8', '2020-07-30 05:15:11'),
(53, 70, 38, 'coucou9', '2020-07-30 05:15:22'),
(54, 70, 38, 'coucou10', '2020-07-30 05:44:16');

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
('DoctrineMigrations\\Version20200710131430', '2020-07-10 13:15:06', 999),
('DoctrineMigrations\\Version20200710132100', '2020-07-10 13:21:11', 2384),
('DoctrineMigrations\\Version20200710135519', '2020-07-10 13:55:42', 8945),
('DoctrineMigrations\\Version20200721050241', '2020-07-21 05:03:09', 1157),
('DoctrineMigrations\\Version20200724052645', '2020-07-24 05:42:17', 2109),
('DoctrineMigrations\\Version20200724054155', '2020-07-24 05:42:19', 2464),
('DoctrineMigrations\\Version20200724071428', '2020-07-24 07:14:33', 678),
('DoctrineMigrations\\Version20200724083927', '2020-07-24 08:39:31', 333),
('DoctrineMigrations\\Version20200724093118', '2020-07-24 09:31:22', 955),
('DoctrineMigrations\\Version20200725090340', '2020-07-25 09:05:17', 202),
('DoctrineMigrations\\Version20200728063520', '2020-07-28 06:35:41', 128),
('DoctrineMigrations\\Version20200802145333', '2020-08-02 14:53:57', 2951),
('DoctrineMigrations\\Version20200803124848', '2020-08-03 12:49:02', 1225);

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `group`
--

INSERT INTO `group` (`id`, `title`, `description`, `slug`) VALUES
(17, 'grab', 'Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. »\r\n\r\nIl existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l\'effectuer, avec des difficultés variables', 'grab'),
(18, 'Rotation', 'On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués.', 'Rotation'),
(19, 'Flip', 'Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.\r\n\r\nIl est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.\r\n\r\nLes flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip, ...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.\r\n\r\nNéanmoins, en dépit de la difficulté technique relative d\'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.', 'Flip'),
(20, 'désaxés', 'Mix entre flips et rotations', 'desaxes'),
(21, 'GroupTest', 'GroupDescription', 'GroupTest');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trick_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C53D045FA76ED395` (`user_id`),
  KEY `IDX_C53D045FB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `trick_id`, `user_id`, `file_name`) VALUES
(20, 31, NULL, 'bawbaw-snow-5f1e5e2aedbd3.jpeg'),
(21, 31, NULL, 'telechargement-5f1e5e3731af6.jpeg'),
(22, 32, NULL, 'indy-5f1e6a77eb3cb.jpeg'),
(23, 32, NULL, 'indy2-5f1e6a81b8202.jpeg'),
(24, 33, NULL, '180-5f1e6dc549adc.jpeg'),
(25, 34, NULL, '360-5f1e6e2b4d141.jpeg'),
(26, 35, NULL, 'backflip2-5f1e716be9cf0.jpeg'),
(27, 35, NULL, 'backflip-5f1e7174d1ae6.jpeg'),
(28, 36, NULL, '6ea3b44dd4625f9ec0aa6909fc25b49f-5f1e726c70fc5.jpeg'),
(29, 37, NULL, 'rodeo-5f1e76eb9be4a.jpeg'),
(30, 37, NULL, 'rodeo-2-5f1e76f3b5109.jpeg'),
(31, 38, NULL, 'fro-5f1e77cba481b.jpeg'),
(32, 38, NULL, 'fr-5f1e77d3ab6ce.jpeg'),
(100, 76, NULL, 'fro-5f2a4960ef938.jpeg'),
(113, NULL, NULL, 'indy2-5f2813dc3245f.jpeg'),
(115, NULL, NULL, 'fro-5f2a8f0fc9d4f.jpeg'),
(120, NULL, 70, 'frontflipknuckle-5f33bb4d054cf.jpeg'),
(121, NULL, NULL, 'rodeo-5f2a8f169ba34.jpeg'),
(122, NULL, 79, 'indy-5f34d89cca67e.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5F37A13BA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `token`
--

INSERT INTO `token` (`id`, `user_id`, `token`) VALUES
(66, 69, 'f7a83f203e120eea'),
(67, 70, '5f21c7e5bd5e25e1'),
(68, 71, '3a8a1f9ef7c5a7b5'),
(69, 72, 'eb95c585efd492b8'),
(70, 73, '08707d366d670653'),
(75, 78, '5e9d0335831fd8fe'),
(76, 79, 'e585a016ad77412c');

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `group_name_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8F0A91EF717C8DA` (`group_name_id`),
  KEY `IDX_D8F0A91EA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `name`, `description`, `created_at`, `updated_at`, `group_name_id`, `user_id`, `slug`) VALUES
(31, 'Sad', 'Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.', '2020-07-27 04:52:15', NULL, 17, 69, 'Sad'),
(32, 'Indy', 'Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.', '2020-07-27 05:42:47', NULL, 17, 69, 'Indy'),
(33, '180', 'Un 180 désigne un demi-tour, soit 180 degrés d\'angle.', '2020-07-27 05:59:52', '2020-07-27 06:19:26', 18, 69, '180'),
(34, '360', 'Trois six pour un tour complet', '2020-07-27 06:02:18', '2020-07-27 06:19:42', 18, 69, '360'),
(35, 'Backflip', 'Consiste à effectuer une rotation de 360 degrés sur un axe horizontal. (un salto arrière)', '2020-07-27 06:16:08', '2020-07-27 06:19:06', 19, 69, 'Backflip'),
(36, 'Frontflip', 'Consiste à effectuer une rotation de 360 degrés sur un axe horizontal en avant. (un salto avant)', '2020-07-27 06:20:20', NULL, 19, 69, 'Frontflip'),
(37, 'rodeo', 'Faire une rotation horizontal et vertical', '2020-07-27 06:39:05', NULL, 20, 69, 'rodeo'),
(38, 'Frontside cork 540', '<p>Frontside Cork 540\'s have to be one of the best feeling tricks in snowboarding. This combination of flip and spin is easy on the eyes, and surprisingly easy in general after you get the feeling for it. Ce trick &agrave; &eacute;t&eacute; modifi&eacute;!</p>\r\n<p>eencore une fois</p>', '2020-07-27 06:42:52', '2020-08-13 10:07:30', 20, 79, 'Frontside-cork-540');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `validation`, `roles`) VALUES
(69, 'user', 'user1@gmail.com', '$2y$13$6EZIpZI/XV8dw05oqPs.lOrFz1VgVcMUTN7FNNlAnCKEDSk8RhWje', 1, '[]'),
(70, 'user2', 'user2@gmail.com', '$2y$13$n4OdjI6HaxP7nHJbwScg..Mj5mmFbD0BpS6NuXwZugYZSUNAXENVq', 1, '[]'),
(71, 'user3', 'user3@gmail.com', '$2y$13$A/M/4Uhlk.BF6Tpar8qIP.FQWfKDS1Nra3T03mKVIebwVAPv.YqfO', 1, '[]'),
(72, 'user4', 'user4@gmail.com', '$2y$13$hudXMRG8DrfaKBnSCWc7xeHFtw.zOez0aa/xkjMmuDB2q5AxNDJna', 1, '[]'),
(78, 'Usertest', 'UserTest@test.com', '$2y$13$1UucyolVy1jRp5fw2Kvb2.eoiz/4OWujxo8trGmgCbcHyfeHAwLLi', 0, '[]'),
(79, 'user41', 'user41@gmail.com', '$2y$13$xmRXOp9rAHM5pIjPDmr95OTAElsBQeZU8a7dR43KZWSfRr0b0l7QK', 1, '[]');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trick_id` int(11) DEFAULT NULL,
  `i_frame` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `i_frame`) VALUES
(19, 38, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/FMHiSF0rHF8\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(26, 76, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/FMHiSF0rHF8\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(27, 76, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/M_BOfGX0aGs\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(34, 38, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/M_BOfGX0aGs\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_C53D045FB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `FK_5F37A13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_D8F0A91EF717C8DA` FOREIGN KEY (`group_name_id`) REFERENCES `group` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
