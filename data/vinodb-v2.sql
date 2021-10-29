-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 oct. 2021 à 16:18
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vinodb`
--

-- --------------------------------------------------------

--
-- Structure de la table `vino__bouteille`
--

CREATE TABLE `vino__bouteille` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `code_saq` varchar(50) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `prix_saq` varchar(10) DEFAULT NULL,
  `url_saq` varchar(200) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `vino__type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vino__cellier`
--

CREATE TABLE `vino__cellier` (
  `id` int(11) NOT NULL,
  `nom_cellier` varchar(45) NOT NULL,
  `usager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vino__cellier`
--

INSERT INTO `vino__cellier` (`id`, `nom_cellier`, `usager_id`) VALUES
(10, 'cellier-test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `vino__cellier_has_vino__bouteille`
--

CREATE TABLE `vino__cellier_has_vino__bouteille` (
  `vino__cellier_id` int(11) NOT NULL DEFAULT 10,
  `vino__bouteille_id` int(11) NOT NULL,
  `quantite` varchar(45) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `garde_jusqua` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `prix` varchar(45) DEFAULT NULL,
  `millesime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vino__consommation`
--

CREATE TABLE `vino__consommation` (
  `id` int(11) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  `usager_id` int(11) NOT NULL,
  `bouteille_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `vino__listeachat`
--

CREATE TABLE `vino__listeachat` (
  `id` int(11) NOT NULL,
  `bouteille_id` varchar(45) NOT NULL,
  `usager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `vino__type`
--

CREATE TABLE `vino__type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vino__type`
--

INSERT INTO `vino__type` (`id`, `type`) VALUES
(1, 'Vin rouge'),
(2, 'Vin blanc');

-- --------------------------------------------------------

--
-- Structure de la table `vino__usager`
--

CREATE TABLE `vino__usager` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vino__usager`
--

INSERT INTO `vino__usager` (`id`, `nom`, `email`, `password`, `admin`, `prenom`, `username`) VALUES
(1, 'GC', 'fil@gmail.com', '123456', '1', 'Felix', 'filgc'),
(2, 'Martel', 'professeur@gmail.com', '123456', '1', 'Jonathan', 'prof123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`vino__type_id`);

--
-- Index pour la table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usager_id` (`usager_id`);

--
-- Index pour la table `vino__cellier_has_vino__bouteille`
--
ALTER TABLE `vino__cellier_has_vino__bouteille`
  ADD PRIMARY KEY (`vino__cellier_id`,`vino__bouteille_id`),
  ADD KEY `fk_vino__cellier_has_vino__bouteille_vino__bouteille1_idx` (`vino__bouteille_id`),
  ADD KEY `fk_vino__cellier_has_vino__bouteille_vino__cellier1_idx` (`vino__cellier_id`);

--
-- Index pour la table `vino__consommation`
--
ALTER TABLE `vino__consommation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vino__note_vino__usager_idx` (`usager_id`),
  ADD KEY `fk_vino__note_vino__bouteille1_idx` (`bouteille_id`);

--
-- Index pour la table `vino__listeachat`
--
ALTER TABLE `vino__listeachat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vino__listeAchat_vino__usager1_idx` (`usager_id`);

--
-- Index pour la table `vino__type`
--
ALTER TABLE `vino__type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vino__usager`
--
ALTER TABLE `vino__usager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `vino__consommation`
--
ALTER TABLE `vino__consommation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vino__listeachat`
--
ALTER TABLE `vino__listeachat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vino__usager`
--
ALTER TABLE `vino__usager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD CONSTRAINT `type` FOREIGN KEY (`vino__type_id`) REFERENCES `vino__type` (`id`);

--
-- Contraintes pour la table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  ADD CONSTRAINT `vino__cellier_ibfk_1` FOREIGN KEY (`usager_id`) REFERENCES `vino__usager` (`id`);

--
-- Contraintes pour la table `vino__cellier_has_vino__bouteille`
--
ALTER TABLE `vino__cellier_has_vino__bouteille`
  ADD CONSTRAINT `fk_vino__cellier_has_vino__bouteille_vino__bouteille1` FOREIGN KEY (`vino__bouteille_id`) REFERENCES `vino__bouteille` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vino__cellier_has_vino__bouteille_vino__cellier1` FOREIGN KEY (`vino__cellier_id`) REFERENCES `vino__cellier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vino__consommation`
--
ALTER TABLE `vino__consommation`
  ADD CONSTRAINT `fk_vino__note_vino__bouteille1` FOREIGN KEY (`bouteille_id`) REFERENCES `vino__bouteille` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vino__note_vino__usager` FOREIGN KEY (`usager_id`) REFERENCES `vino__usager` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vino__listeachat`
--
ALTER TABLE `vino__listeachat`
  ADD CONSTRAINT `fk_vino__listeAchat_vino__usager1` FOREIGN KEY (`usager_id`) REFERENCES `vino__usager` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
