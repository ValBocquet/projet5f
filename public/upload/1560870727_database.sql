-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 31 mai 2019 à 09:33
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `site_upload`
--

-- --------------------------------------------------------

--
-- Structure de la table `datas`
--

CREATE TABLE `datas` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `name_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_file` decimal(10,2) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190528063807', '2019-05-28 06:38:19'),
('20190528075822', '2019-05-28 07:58:31'),
('20190530093257', '2019-05-30 09:33:24');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`, `created_at`) VALUES
(7, 'Valentin', '$2y$13$MG6/L2ntG1NswQvwQSc1v.ZH/sZFW7Xv4CoZ.sS5gsuFibzqf6Jm6', 'shadowval@hotmail.fr', '2019-05-30 09:38:41'),
(8, 'asjaisj', '$2y$13$OqiNHxebRov8GtSn3TpkDeDEZz4T.nUtudZQHXZBReoK4Yf0VnmFG', 'azerty@gmail.com', '2019-05-30 09:44:30'),
(9, 'gfasjaisj', '$2y$13$6zQ5369werc9lKeZXtRFtOA4eb59sn4getPYxddzaFanXjZjAIW66', 'azertyccc@gmail.com', '2019-05-30 09:45:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CF180C1A79F37AE5` (`id_user_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `datas`
--
ALTER TABLE `datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `datas`
--
ALTER TABLE `datas`
  ADD CONSTRAINT `FK_CF180C1A79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `users` (`id`);
