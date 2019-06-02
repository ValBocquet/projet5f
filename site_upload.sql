-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 02 juin 2019 à 18:00
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site_upload`
--

-- --------------------------------------------------------

--
-- Structure de la table `datas`
--

DROP TABLE IF EXISTS `datas`;
CREATE TABLE IF NOT EXISTS `datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_id` int(11) NOT NULL,
  `name_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_file` decimal(10,2) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CF180C1A79F37AE5` (`id_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190528063807', '2019-05-28 06:38:19'),
('20190528075822', '2019-05-28 07:58:31'),
('20190530093257', '2019-05-30 09:33:24'),
('20190602143148', '2019-06-02 14:33:28');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `created_at`, `avatar`) VALUES
(7, 'Valentin', '$2y$13$MG6/L2ntG1NswQvwQSc1v.ZH/sZFW7Xv4CoZ.sS5gsuFibzqf6Jm6', 'shadowval@hotmail.fr', '2019-05-30 09:38:41', NULL),
(8, 'asjaisj', '$2y$13$OqiNHxebRov8GtSn3TpkDeDEZz4T.nUtudZQHXZBReoK4Yf0VnmFG', 'azerty@gmail.com', '2019-05-30 09:44:30', NULL),
(9, 'gfasjaisj', '$2y$13$6zQ5369werc9lKeZXtRFtOA4eb59sn4getPYxddzaFanXjZjAIW66', 'azertyccc@gmail.com', '2019-05-30 09:45:27', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `datas`
--
ALTER TABLE `datas`
  ADD CONSTRAINT `FK_CF180C1A79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
