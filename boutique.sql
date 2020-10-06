-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 06 oct. 2020 à 10:34
-- Version du serveur :  10.4.10-MariaDB
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
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `adresse_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  PRIMARY KEY (`adresse_id`),
  KEY `utilisateur_id` (`utilisateurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `commande_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int(11) NOT NULL,
  `adresse_id` int(11) NOT NULL,
  `creationdate` date NOT NULL,
  `quantité` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  PRIMARY KEY (`commande_id`),
  KEY `utilisateur_id` (`utilisateurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `valid_time` datetime NOT NULL,
  `nom` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `prix` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `taille` varchar(30) NOT NULL,
  PRIMARY KEY (`produit_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `nom`, `prenom`, `telephone`, `password`, `cart_id`, `admin`) VALUES
(3, 'dsfdq', 'dqsfd', 'dsqfdsdqs', '90789078', 'tetete', 0, 0),
(4, 'lea.martel@laplateforme.io', 'martel', 'Cam', '0676767687', '$2y$15$9MKbBmy5OBwwnc05cZPPTOsiLwqbETsUkr6bFWXGV7GHmCT1pzy1W', 0, 0),
(5, 'kevin.zimmermann@laplateforme.io', 'martel', 'lea', '0676767621', '$2y$15$4cxEMQgJv4.GIj6LcQw2L.5MSl0Q801eoaUQrtGp59xkOqfKWXPXC', 0, 0),
(6, 'totozimer@gmail.com', 'toto', 'toto', '0676732687', '$2y$15$sonyeSWpQpPkU73p0P9XV.BsZmRl4OU20.bArCYSgMCeEmjolWr6u', 0, 0),
(7, 'camille.laplate@gmail.com', 'cam', 'camille', '0632456776', '$2y$15$FKEaM/rLKSmWqdHRlH4YWeAYObydY1qf6U5sVFgxVUu8ANH63lEY2', 0, 0),
(8, 'bastien.albert@gmail.com', '', '', '', '$2y$15$C0OVj4tK7QqLzhZen02ryOs7gy4yoCKTdIx6NwtqenXivtMFphJ7e', 0, 0),
(10, 'lina.laplate@gmail.com', 'martel', 'lina', '', '$2y$15$0xVL9f6mCwV0rakEK.k9G.uV8vMgI7gjHL9.pLZpfSNXi1ueSk3ie', 0, 0),
(11, 'gftftfuf@gmail.com', 'martel', 'lina', '0633765643', '$2y$15$ey.7Tudz43v6P.8wmemoDOYZFNYKRQX7460yaIgJU5KXIC3bYACa6', 0, 0),
(12, 'lea04martel@gmail.com', 'martel', 'lea', '0632456732', '$2y$15$4VZA0Yvtb30.6ptTAiyMx..m1UD58zKyKaGldKffY75gWahKrSRGK', 0, 0),
(13, 'admin.admin@laplateforme.io', 'admin', 'admin', '0632456776', '$2y$15$HQuATnYS7tTfkQjo4m1Vbev1GhX2isq6Q1djVTTiW2aOLZWsxbizi', 0, 0),
(14, 'admin@laplateforme.io', 'admin', 'admin', '0632456776', '$2y$15$rmnBixTd2z0TwwU0MFpXB.9GyS6VfRuZ8GAwxMo4YklRmiK1VZm9u', 0, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
