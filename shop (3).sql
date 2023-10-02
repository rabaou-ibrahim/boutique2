-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 oct. 2023 à 19:34
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id_achat` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_achat`),
  KEY `FK_achats_utilisateurs` (`id_utilisateur`),
  KEY `FK_achats_produits` (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `pseudo`, `email`, `password`) VALUES
(1, 'IBRAHIM', 'Rabaou', 'rabaou', 'rabaou.ibrahim@laplateforme.io', '$2y$10$b8wJEAhACsz.CX37YO/s9e3TXpIGhLBGqck6XvCuNJRQbV0RZ16OW');

-- --------------------------------------------------------

--
-- Structure de la table `items_panier`
--

DROP TABLE IF EXISTS `items_panier`;
CREATE TABLE IF NOT EXISTS `items_panier` (
  `item_panier_id` int(11) NOT NULL AUTO_INCREMENT,
  `panier_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`item_panier_id`),
  KEY `FK_items_panier_paniers` (`panier_id`),
  KEY `FK_items_panier_produits` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items_panier`
--

INSERT INTO `items_panier` (`item_panier_id`, `panier_id`, `produit_id`, `quantite`, `prix`) VALUES
(19, 13, 14, 6, 104),
(17, 12, 27, 2, 60),
(16, 12, 33, 10, 180),
(18, 13, 33, 6, 90),
(20, 13, 27, 1, 30),
(25, 14, 27, 1, 30),
(24, 14, 33, 1, 10),
(23, 12, 14, 1, 52),
(26, 14, 14, 2, 52),
(51, 28, 14, 1, 52),
(50, 28, 27, 2, 60),
(49, 28, 33, 21, 210),
(52, 29, 33, 1, 10),
(53, 29, 27, 2, 60),
(54, 30, 33, 1, 10),
(55, 31, 14, 1, 52),
(56, 29, 14, 1, 52);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `FK_paniers_utilisateurs` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`id_panier`, `id_utilisateur`) VALUES
(13, 188),
(12, 187),
(14, 198),
(28, 199),
(29, 201),
(30, 95),
(31, 95);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `description`, `prix`) VALUES
(14, '2196_n10.jpg', 'Jean bleu', 'Jean', 52),
(33, '3490_n11.jpg', 'Jean large', 'Jean', 10),
(27, '4164_n13.jpg', 'Jean noir', 'Jean', 30);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `pseudo`, `email`, `password`) VALUES
(4, 'IBRAHIM', 'Rabaou', 'raba', 'rabaou.ibrahim@laplateforme.io', '$2y$10$dU//By8iUyQBp.SquDILreDCmXmXb0cldCGHLzMPGE2iAhG3gyF5K'),
(18, 'NDOYE', 'Maleye', 'maleye', 'maleyendoye@laplateforme.io', '$2y$10$M.CxSVOR0/JqoiRwyIyjWOXfc7iiTVsP0nMJYZ1zigFH1NEnYCMA.'),
(172, 'ABAKAR', 'Adam', 'adam', 'adam-abakar.abdallah@laplateforme.io', '$2y$10$2.xs1DdrnACnleryr7daau3/yTjL8HnqI2E23M7SnxJxLf84ac1z.'),
(201, 'a', 'a', 'a', 'a@a.a', '$2y$10$pEngTUgypj3zGZL1FIbwoO1ocNAklzFO7gCnoTJeSiaEH3AHkLbMu'),
(199, 'IBRA', 'raba', 'rabaouu', 'rabaou.ibrahim0@gmail.com', '$2y$10$lfqDrzkTG98pknNE9FioAOQdVj/QziYQoNwZ3J/iSZk0TGE2hKBy2'),
(200, 'IBRAH', 'Rabao', 'rabao', 'rabao@ibrahim.com', '$2y$10$V5gwZAtGd55OfGHpiz.WQu4AqoCTFGhpV2h8987Nv5tdpxt2YSWpm'),
(198, 'TEST3', 'test3', 'test3', 'test3@test.test', '$2y$10$V1tMkp2QEJAkqB08iaRZpusCSi3SdvFyoz.z4d4P566QkBC5Wj6su'),
(197, 'TEST', 'Test2', 'test2', 'test2@test.test', '$2y$10$XRy.aEy8/QKimdB7YlKMFejVNrYnsjVVSd3H.9oxMgErdL8d8Zsby'),
(196, 'IBRAHIM', 'raba', 'raba1', 'rabaou.ibrahim00@gmail.com', '$2y$10$EF0tL39s0aSjYPN7BZO8geOl3vZ72.YkT1vNubmftef147lNq5oT.'),
(188, 'test', 'test', 'test', 'test@test.test', '$2y$10$r3FnoiAx27ec78bPL6F3/.F3wgoDt2fhgIVcJeb/eBhwvt/kzBjrC'),
(187, 'aA', 'aA', 'A', 'aA@a.a', '$2y$10$34hgcu/2S3Vk2BKLaoiKZejSZatyfgA.w.2Pc7OjYoyfVq4LFsig6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
