-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 20 oct. 2021 à 15:30
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
  `prix_saq` float DEFAULT NULL,
  `url_saq` varchar(200) DEFAULT NULL,
  `url_img` varchar(200) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `vino__type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vino__bouteille`
--

INSERT INTO `vino__bouteille` (`id`, `nom`, `image`, `code_saq`, `pays`, `description`, `prix_saq`, `url_saq`, `url_img`, `format`, `vino__type_id`) VALUES
(1, 'Borsao Seleccion', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', '10324623', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', 11, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(2, 'Monasterio de Las Vinas Gran Reserva', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', '10359156', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10359156', 19, 'https://www.saq.com/page/fr/saqcom/vin-rouge/monasterio-de-las-vinas-gran-reserva/10359156', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(3, 'Castano Hecula', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', '11676671', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11676671', 12, 'https://www.saq.com/page/fr/saqcom/vin-rouge/castano-hecula/11676671', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(4, 'Campo Viejo Tempranillo Rioja', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', '11462446', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11462446', 14, 'https://www.saq.com/page/fr/saqcom/vin-rouge/campo-viejo-tempranillo-rioja/11462446', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(5, 'Bodegas Atalaya Laya 2017', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', '12375942', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12375942', 17, 'https://www.saq.com/page/fr/saqcom/vin-rouge/bodegas-atalaya-laya-2017/12375942', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(6, 'Vin Vault Pinot Grigio', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', '13467048', 'États-Unis', 'Vin blanc\r\n         \r\n      \r\n      \r\n      États-Unis, 3 L\r\n      \r\n      \r\n      Code SAQ : 13467048', NULL, 'https://www.saq.com/page/fr/saqcom/vin-blanc/vin-vault-pinot-grigio/13467048', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', ' 3 L', 2),
(7, 'Huber Riesling Engelsberg 2017', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', '13675841', 'Autriche', 'Vin blanc\r\n         \r\n      \r\n      \r\n      Autriche, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13675841', 22, 'https://www.saq.com/page/fr/saqcom/vin-blanc/huber-riesling-engelsberg-2017/13675841', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', ' 750 ml', 2),
(8, 'Dominio de Tares Estay Castilla y Léon 2015', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', '13802571', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13802571', 18, 'https://www.saq.com/page/fr/saqcom/vin-rouge/dominio-de-tares-estay-castilla-y-leon-2015/13802571', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(9, 'Tessellae Old Vines Côtes du Roussillon 2016', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', '12216562', 'France', 'Vin rouge\r\n         \r\n      \r\n      \r\n      France, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12216562', 21, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tessellae-old-vines-cotes-du-roussillon-2016/12216562', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(10, 'Tenuta Il Falchetto Bricco Paradiso -... 2015', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', '13637422', 'Italie', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Italie, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13637422', 34, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tenuta-il-falchetto-bricco-paradiso---barbera-dasti-superiore-docg-2015/13637422', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', ' 750 ml', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vino__cellier`
--

CREATE TABLE `vino__cellier` (
  `id` int(11) NOT NULL,
  `date_achat` date DEFAULT NULL,
  `garde_jusqua` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `millesime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vino__cellier`
--

INSERT INTO `vino__cellier` (`id`, `date_achat`, `garde_jusqua`, `notes`, `prix`, `millesime`) VALUES
(1, '0000-00-00', '', '', 0, 0),
(2, '0000-00-00', '', '', 0, 0),
(3, '2019-01-16', '2020', '2019-01-16', 22, 1999),
(4, '0000-00-00', '', '', 0, 0),
(5, '0000-00-00', '', '', 0, 0),
(6, '0000-00-00', '', '', 0, 0),
(7, '0000-00-00', '', '', 0, 0),
(8, '0000-00-00', '', '', 0, 2000),
(9, '2019-01-26', 'non', '2019-01-26', 23.52, 2015);

-- --------------------------------------------------------

--
-- Structure de la table `vino__cellier_has_vino__bouteille`
--

CREATE TABLE `vino__cellier_has_vino__bouteille` (
  `vino__cellier_id` int(11) NOT NULL,
  `vino__bouteille_id` int(11) NOT NULL,
  `quantite` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vino__cellier_has_vino__bouteille`
--

INSERT INTO `vino__cellier_has_vino__bouteille` (`vino__cellier_id`, `vino__bouteille_id`, `quantite`) VALUES
(1, 5, '1'),
(1, 8, '0'),
(1, 10, '1');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD CONSTRAINT `type` FOREIGN KEY (`vino__type_id`) REFERENCES `vino__type` (`id`);

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
