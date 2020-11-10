-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 10 nov. 2020 à 16:20
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `adresse_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  PRIMARY KEY (`adresse_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`adresse_id`, `utilisateur_id`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`) VALUES
(5, 15, 'qsdsqdsd', 'qsdsqdqd', '  qsdsqdqsd ', '10935', 'Marseille', '0656862757'),
(6, 15, 'jul', 'qsdsqdqd', '  qsdsqdqsd ', '10935', 'Marseille', '0656862757'),
(7, 15, 'jul', 'qsdsqdqd', '  qsdsqdqsd ', '10935', 'Marseille', '0656862757');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `nom_categorie`) VALUES
(9, 'Maillots'),
(11, 'Shorts'),
(12, 'Survêtements'),
(18, 'Chaussettes');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `adresse_id` int(11) NOT NULL,
  `creationdate` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL,
  PRIMARY KEY (`commande_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `adresse_id` (`adresse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`commande_id`, `utilisateur_id`, `adresse_id`, `creationdate`, `prix`, `statut`) VALUES
(2, 15, 5, 1605024681, 295, 'succeeded'),
(3, 15, 5, 1605024791, 405, 'succeeded');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `commande_produit` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `taille` enum('s','m','l','xl') NOT NULL DEFAULT 's',
  PRIMARY KEY (`commande_produit`),
  KEY `produit_id` (`produit_id`),
  KEY `commande_id` (`commande_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`commande_produit`, `commande_id`, `quantité`, `produit_id`, `taille`) VALUES
(1, 2, 1, 3, 'm'),
(2, 2, 1, 19, 'm'),
(3, 2, 1, 48, 'm'),
(4, 2, 1, 41, 'm'),
(5, 2, 1, 16, 's'),
(6, 3, 5, 3, 'xl');

-- --------------------------------------------------------

--
-- Structure de la table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `valid_time` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL,
  `type` enum('pourcent','euro') NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `discount`
--

INSERT INTO `discount` (`discount_id`, `valid_time`, `nom`, `valeur`, `type`) VALUES
(6, 1605398400, 'FOOT10', 10, 'pourcent'),
(7, 1605398400, 'OM10', 10, 'euro');

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

DROP TABLE IF EXISTS `facturation`;
CREATE TABLE IF NOT EXISTS `facturation` (
  `facturation_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `prix_tot` decimal(10,2) NOT NULL,
  `prix_reduc` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`facturation_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facturation`
--

INSERT INTO `facturation` (`facturation_id`, `coupon_id`, `prix_tot`, `prix_reduc`, `user_id`) VALUES
(12, 0, '89.99', '89.99', 15);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panier_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` enum('s','m','l','xl') NOT NULL DEFAULT 's',
  PRIMARY KEY (`panier_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`panier_id`, `product_id`, `user_id`, `quantity`, `size`) VALUES
(7, 3, 15, 1, 's');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `produit_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`produit_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `categorie_id`, `nom_produit`, `description`, `prix`, `image`, `date`) VALUES
(3, 9, 'MAILLOT OM DOMICILE 2020/21', ' MAILLOT OM DOMICILE 2020/21', '89.99', '', 0),
(4, 9, 'MAILLOT FRANCE DOMICILE 2020-2021', ' Maillot Nike France Domicile 2020-2021, coloris Bleu.', '90.00', '', 0),
(5, 9, 'MAILLOT OM EXTÉRIEUR 2020/21', ' Maillot Puma Olympique de Marseille Extérieur 2020/21, coloris Bleu.', '90.00', '', 0),
(11, 9, 'MAILLOT RENNES THIRD 2020/2021', ' Maillot Puma Rennes Third 2020/2021, coloris Noir.', '89.90', '', 0),
(12, 9, 'MAILLOT BAYERN MUNICH THIRD 2020/2021', ' Maillot adidas Bayern Munich Third 2020/2021, coloris Noir et Rouge.', '89.90', '', 0),
(13, 9, 'MAILLOT JUVENTUS THIRD 2020/2021', ' Maillot adidas Juventus Third 2020/2021, coloris Orange.', '89.90', '', 0),
(15, 9, 'MAILLOT REAL MADRID THIRD 2020/2021', ' Maillot adidas Real Madrid Third 2020/2021, coloris Noir.', '90.00', '', 0),
(16, 9, 'MAILLOT MANCHESTER UNITED THIRD 2020/2021', ' Maillot adidas Manchester United Third 2020/2021, coloris Blanc et Noir.', '89.90', '', 0),
(17, 9, 'MAILLOT AC MILAN EXTÉRIEUR 2020/2021', ' Maillot Puma AC Milan Extérieur 2020/2021, coloris Blanc.', '89.90', '', 0),
(18, 11, 'SHORT NIKE ACADEMY BLEU', ' Short Nike Academy, coloris Bleu.\nTissu extensible, 100 % Polyester recyclé', '19.90', '', 1604501728),
(19, 11, 'SHORT NIKE ARBITRE NOIR', ' Short Nike Arbitre, coloris Noir.\nConçu spécialement pour les arbitres.\nTissu respirant et aéré.', '34.90', '', 1604502269),
(20, 11, 'SHORT NIKE FLEX STRIDE BLEU', ' Short Nike Flex Stride, coloris Bleu.\nCoupe standard pour une tenue décontractée\nTissu respirant et extensible.', '40.00', '', 1604502570),
(21, 11, 'SHORT NIKE STRIKE ROSE FEMME', ' Short Nike Strike, coloris Rose, Femme.\nCoupe standard pour une tenue décontractée, ajustement idéal.', '24.90', '', 1604502693),
(24, 11, 'SHORT ADIDAS SQUADRA 17 BLEU FEMME', ' Short adidas Squadra 17, coloris Bleu, Femme.\nCoupe standard.', '20.00', '', 1604502929),
(25, 11, 'SHORT ADIDAS SQUADRA 17 BLANC', ' Short adidas Squadra 17, coloris Blanc.\nTissu respirant et confortable.', '18.00', '', 1604503288),
(26, 11, 'SHORT LE COQ SPORTIF MATCH BLEU', ' Short Le Coq Sportif Match, coloris Bleu.\nConfortable.', '15.90', '', 1604506406),
(27, 11, 'SHORT NIKE ACADEMY BLANC', ' Short Nike Academy, coloris Blanc.\nTissu respirant, mouvements naturels.', '20.00', '', 1604506699),
(28, 11, 'SHORT NIKE ROUGE', ' Short Nike, coloris Rouge.\nTissu respirant et confortable.', '24.90', '', 1604506836),
(29, 12, 'SURVÊTEMENT LIVERPOOL ROUGE', ' Survêtement Liverpool, coloris Rouge.\nVeste + Pantalon.', '59.00', '', 1604672884),
(30, 12, 'SURVÊTEMENT FRANCE FAN BLEU', ' Survêtement France Fan, coloris Bleu.\nVeste + Pantalon.\nMouvements naturels.', '69.90', '', 1604673251),
(31, 12, 'SURVÊTEMENT BAYERN MUNICH NOIR', ' Survêtement adidas Bayern Munich, coloris Noir.\nConfectionné en polyester recyclé pour préserver les ressources naturelles de la planète et diminuer les émissions carbone.', '109.90', '', 1604673426),
(32, 12, 'SURVÊTEMENT JUVENTUS GRIS/BLEU', ' Survêtement adidas Juventus, coloris Gris et Bleu.\nConfectionné en polyester recyclé pour préserver les ressources naturelles de la planète et diminuer les émissions carbone.', '109.90', '', 1604674559),
(33, 12, 'SURVÊTEMENT BARÇA STRIKE BLEU', ' Survêtement entraînement Nike Barça Strike, coloris Bleu.\nCoupe standard.', '119.90', '', 1604674657),
(34, 12, 'SURVÊTEMENT S.S. LAZIO BLEU', ' Survêtement Macron S.S. Lazio, coloris Bleu.\nVeste + Pantalon. Rangements sécurisés.', '104.90', '', 1604674748),
(35, 12, 'SURVÊTEMENT ENTRAÎNEMENT REAL MADRID GRIS', ' Survêtement entraînement adidas Real Madrid, coloris Gris.\nVeste + Pantalon.', '99.90', '', 1604674884),
(36, 12, 'SURVÊTEMENT INTER MILAN STRIKE NOIR/BLEU', ' Survêtement entraînement Nike Inter Milan Strike, coloris Noir et Bleu.\nCoupe standard.', '119.90', '', 1604675025),
(41, 12, 'SURVÊTEMENT OM FAN NOIR', ' Survêtement Olympique de Marseille Fan, coloris Noir.\nSous licence officielle de l\'OM, confortable.', '69.90', '', 1604935815),
(42, 18, 'CHAUSSETTES MANCHESTER CITY 2020/2021', ' Chaussettes Puma Manchester City 2020/2021, coloris Bleu.', '19.90', '', 1604937351),
(43, 18, 'CHAUSSETTES JUVENTUS THIRD 2020/2021', ' Chaussettes adidas Juventus Third 2020/2021, coloris Orange.', '19.90', '', 1604937681),
(44, 18, 'CHAUSSETTES BAYERN MUNICH THIRD 2020/2021', ' Chaussettes adidas Bayern Munich Extérieur 2020/2021, coloris Noir.', '19.90', '', 1604937756),
(45, 18, 'CHAUSSETTES REAL MADRID THIRD 2020/2021', ' Chaussettes adidas Real Madrid Third 2020/2021, coloris Noir.', '19.90', '', 1604937849),
(46, 18, 'CHAUSSETTES BARÇA DOMICILE 2020/2021', ' Chaussettes Nike Barça Domicile 2020/2021, coloris Bleu et Rouge.', '19.90', '', 1604937983),
(47, 18, 'CHAUSSETTES ARSENAL EXTÉRIEUR 2020/2021', ' Chaussettes adidas Arsenal Extérieur 2020/2021, coloris Blanc.', '19.90', '', 1604938338),
(48, 18, 'CHAUSSETTES FRANCE 2020-2021', ' Chaussette Nike France 2020-2021, coloris Blanc.', '20.00', '', 1604938436),
(49, 18, 'CHAUSSETTES ALLEMAGNE DOMICILE 2019/20', ' Chaussettes adidas Allemagne Domicile 2019/20, coloris Blanc.', '17.90', '', 1604938634),
(50, 18, 'CHAUSSETTES BELGIQUE DOMICILE EURO 2020', ' Chaussettes adidas Belgique Domicile Euro 2020, coloris Rouge.', '17.90', '', 1604938759);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `taille` enum('s','m','l','xl') NOT NULL DEFAULT 's',
  `produit_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`stock_id`, `taille`, `produit_id`, `stock`) VALUES
(9, 's', 3, 15),
(10, 'm', 3, 20),
(11, 'l', 3, 20),
(12, 'xl', 3, 20),
(13, 's', 4, 10),
(14, 'm', 4, 10),
(15, 'l', 4, 10),
(16, 'xl', 4, 10),
(17, 's', 5, 20),
(18, 'm', 5, 20),
(19, 'l', 5, 10),
(20, 'xl', 5, 10),
(41, 's', 11, 20),
(42, 'm', 11, 20),
(43, 'l', 11, 20),
(44, 'xl', 11, 20),
(45, 's', 12, 10),
(46, 'm', 12, 10),
(47, 'l', 12, 10),
(48, 'xl', 12, 10),
(49, 's', 13, 15),
(50, 'm', 13, 20),
(51, 'l', 13, 20),
(52, 'xl', 13, 20),
(57, 's', 15, 30),
(58, 'm', 15, 30),
(59, 'l', 15, 30),
(60, 'xl', 15, 30),
(61, 's', 16, 10),
(62, 'm', 16, 10),
(63, 'l', 16, 10),
(64, 'xl', 16, 10),
(65, 's', 17, 10),
(66, 'm', 17, 10),
(67, 'l', 17, 10),
(68, 'xl', 17, 10),
(69, 's', 18, 10),
(70, 'm', 18, 10),
(71, 'l', 18, 10),
(72, 'xl', 18, 10),
(73, 's', 19, 10),
(74, 'm', 19, 10),
(75, 'l', 19, 10),
(76, 'xl', 19, 10),
(77, 's', 20, 10),
(78, 'm', 20, 10),
(79, 'l', 20, 10),
(80, 'xl', 20, 10),
(81, 's', 21, 10),
(82, 'm', 21, 10),
(83, 'l', 21, 10),
(84, 'xl', 21, 10),
(93, 's', 24, 10),
(94, 'm', 24, 10),
(95, 'l', 24, 10),
(96, 'xl', 24, 10),
(97, 's', 25, 0),
(98, 'm', 25, 10),
(99, 'l', 25, 10),
(100, 'xl', 25, 10),
(101, 's', 26, 10),
(102, 'm', 26, 10),
(103, 'l', 26, 10),
(104, 'xl', 26, 10),
(105, 's', 27, 10),
(106, 'm', 27, 10),
(107, 'l', 27, 10),
(108, 'xl', 27, 10),
(109, 's', 28, 20),
(110, 'm', 28, 20),
(111, 'l', 28, 20),
(112, 'xl', 28, 20),
(113, 's', 29, 10),
(114, 'm', 29, 10),
(115, 'l', 29, 10),
(116, 'xl', 29, 10),
(117, 's', 30, 10),
(118, 'm', 30, 10),
(119, 'l', 30, 10),
(120, 'xl', 30, 10),
(121, 's', 31, 10),
(122, 'm', 31, 10),
(123, 'l', 31, 10),
(124, 'xl', 31, 10),
(125, 's', 32, 10),
(126, 'm', 32, 10),
(127, 'l', 32, 10),
(128, 'xl', 32, 10),
(129, 's', 33, 10),
(130, 'm', 33, 10),
(131, 'l', 33, 10),
(132, 'xl', 33, 10),
(133, 's', 34, 15),
(134, 'm', 34, 15),
(135, 'l', 34, 15),
(136, 'xl', 34, 10),
(137, 's', 35, 20),
(138, 'm', 35, 10),
(139, 'l', 35, 10),
(140, 'xl', 35, 10),
(141, 's', 36, 10),
(142, 'm', 36, 10),
(143, 'l', 36, 10),
(144, 'xl', 36, 10),
(161, 's', 41, 20),
(162, 'm', 41, 20),
(163, 'l', 41, 20),
(164, 'xl', 41, 20),
(165, 's', 42, 15),
(166, 'm', 42, 15),
(167, 'l', 42, 15),
(168, 'xl', 42, 15),
(169, 's', 43, 15),
(170, 'm', 43, 15),
(171, 'l', 43, 15),
(172, 'xl', 43, 15),
(173, 's', 44, 15),
(174, 'm', 44, 15),
(175, 'l', 44, 15),
(176, 'xl', 44, 15),
(177, 's', 45, 20),
(178, 'm', 45, 20),
(179, 'l', 45, 20),
(180, 'xl', 45, 20),
(181, 's', 46, 15),
(182, 'm', 46, 15),
(183, 'l', 46, 15),
(184, 'xl', 46, 15),
(185, 's', 47, 10),
(186, 'm', 47, 10),
(187, 'l', 47, 10),
(188, 'xl', 47, 10),
(189, 's', 48, 20),
(190, 'm', 48, 20),
(191, 'l', 48, 20),
(192, 'xl', 48, 20),
(193, 's', 49, 10),
(194, 'm', 49, 10),
(195, 'l', 49, 10),
(196, 'xl', 49, 10),
(197, 's', 50, 10),
(198, 'm', 50, 10),
(199, 'l', 50, 10),
(200, 'xl', 50, 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `nom`, `prenom`, `telephone`, `password`, `admin`) VALUES
(15, 'galactique13@hotmail.fr', 'admin', 'admin', '0656862757', '$2y$15$wlb3X8k0jmNOTojVRT/7V.1LoJ5nOWTP7OFi4AXED5zhjd9O8Bj96', 1),
(17, 'lazrnovaxx@gmail.com', 'ghffghfgh', 'ggffg', '0656862757', '$2y$15$br8sewukYl.e/VGauLKaGeBgZSTmpTvy7qacR0n0g1OlAlzqqmmrO', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`adresse_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`commande_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD CONSTRAINT `facturation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `produit` (`produit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
