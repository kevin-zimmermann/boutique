-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 04 nov. 2020 à 22:28
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
-- Structure de la table `carte`
--

DROP TABLE IF EXISTS `carte`;
CREATE TABLE IF NOT EXISTS `carte` (
  `carte_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int(11) NOT NULL,
  PRIMARY KEY (`carte_id`),
  KEY `utilisateur_id` (`utilisateurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`commande_id`, `utilisateur_id`, `adresse_id`, `creationdate`, `prix`, `statut`) VALUES
(1, 14, 1, 1604060827, 53968, 'succeeded'),
(2, 14, 1, 1604313983, 540, 'succeeded'),
(3, 15, 5, 1604314642, 620, 'succeeded');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `commande_produit` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`commande_produit`),
  KEY `produit_id` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `discount`
--

INSERT INTO `discount` (`discount_id`, `valid_time`, `nom`, `valeur`, `type`) VALUES
(4, 1605139200, 'MERDE10', 10, 'euro'),
(5, 1604361600, 'blabla', 1000, 'euro');

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
  PRIMARY KEY (`facturation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facturation`
--

INSERT INTO `facturation` (`facturation_id`, `coupon_id`, `prix_tot`, `prix_reduc`, `user_id`) VALUES
(12, 0, '619.76', '619.76', 15);

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
  PRIMARY KEY (`panier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`panier_id`, `product_id`, `user_id`, `quantity`, `size`) VALUES
(11, 3, 15, 4, 's'),
(12, 9, 15, 2, 'xl');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `categorie_id`, `nom_produit`, `description`, `prix`, `image`, `date`) VALUES
(3, 9, 'MAILLOT OM DOMICILE 2020/21', ' MAILLOT OM DOMICILE 2020/21', '89.99', '', 0),
(4, 9, 'MAILLOT FRANCE DOMICILE 2020-2021', ' Maillot Nike France Domicile 2020-2021, coloris Bleu.', '90.00', '', 0),
(5, 9, 'MAILLOT OM EXT&Eacute;RIEUR 2020/21', ' Maillot Puma Olympique de Marseille Ext&eacute;rieur 2020/21, coloris Bleu.', '90.00', '', 0),
(7, 9, 'MAILLOT ARSENAL EXT&Eacute;RIEUR 2020/2021', ' Maillot adidas Arsenal Ext&eacute;rieur 2020/21, coloris Blanc et Noir.', '89.90', '', 0),
(9, 9, 'MAILLOT MANCHESTER UNITED DOMICILE 2020/2021', ' Maillot Authentique adidas Manchester United Domicile 2020/2021, coloris Rouge.', '129.90', '', 0),
(10, 9, 'MAILLOT REAL MADRID THIRD 2020/2021', ' Maillot adidas Real Madrid Third 2020/2021, coloris Noir et Rose.', '90.00', '', 0);

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
  PRIMARY KEY (`stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`stock_id`, `taille`, `produit_id`, `stock`) VALUES
(16, 'xl', 4, 10),
(15, 'l', 4, 10),
(14, 'm', 4, 10),
(13, 's', 4, 0),
(20, 'xl', 5, 10),
(19, 'l', 5, 10),
(18, 'm', 5, 20),
(17, 's', 5, 0),
(9, 's', 3, 5),
(10, 'm', 3, 50),
(11, 'l', 3, 20),
(12, 'xl', 3, 20),
(25, 's', 7, 0),
(26, 'm', 7, 10),
(27, 'l', 7, 10),
(28, 'xl', 7, 10),
(40, 'xl', 10, 30),
(39, 'l', 10, 30),
(38, 'm', 10, 30),
(37, 's', 10, 0),
(33, 's', 9, 0),
(34, 'm', 9, 10),
(35, 'l', 9, 10),
(36, 'xl', 9, 10);

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
  `cart_id` int(11) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `nom`, `prenom`, `telephone`, `password`, `cart_id`, `admin`) VALUES
(13, 'admin.admsqdsin@laplateforme.io', 'admin', 'admin', '0632456776', '$2y$15$HQuATnYS7tTfkQjo4m1Vbev1GhX2isq6Q1djVTTiW2aOLZWsxbizi', 0, 0),
(15, 'galactique13@hotmail.fr', 'admin', 'admin', '0656862757', '$2y$15$wlb3X8k0jmNOTojVRT/7V.1LoJ5nOWTP7OFi4AXED5zhjd9O8Bj96', 0, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`categorie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
