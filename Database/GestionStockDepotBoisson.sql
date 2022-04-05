-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Avril 2022 à 19:58
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestionstockdepotboisson`
--

-- --------------------------------------------------------

--
-- Structure de la table `boissons`
--

CREATE TABLE IF NOT EXISTS `boissons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `litre` double NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `prix_unitaire` double NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `minimum` int(11) NOT NULL,
  `date_livraison` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `boissons`
--

INSERT INTO `boissons` (`id`, `litre`, `nom_produit`, `prix_unitaire`, `categorie`, `minimum`, `date_livraison`, `quantite`) VALUES
(1, 0, 'castel', 650, '1', 5, '2022-04-04 17:20:10', 1),
(2, 0, 'doppel', 7500, '1', 10, '2022-04-04 17:09:32', 9);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `nom` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `dette` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `id_commande` int(11) NOT NULL,
  `boisson` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` double NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `boisson`, `quantite`, `prix_unitaire`, `fournisseur`, `date_commande`) VALUES
(1, 'castel', 0, 0, 1, '2022-04-04 11:00:10'),
(0, 'doppel', 0, 0, 1, '2022-04-04 17:09:32'),
(0, 'castel', 0, 0, 1, '2022-04-04 17:20:10');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_achat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `tel`) VALUES
(1, 'Wilfried-Tech', 657933001);

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

CREATE TABLE IF NOT EXISTS `livraisons` (
  `id_livraison` int(20) NOT NULL AUTO_INCREMENT,
  `minimum` int(20) NOT NULL,
  `nom_produit` varchar(50) NOT NULL COMMENT 'categorie',
  `categorie` varchar(50) NOT NULL COMMENT 'quantite',
  `quantite_livrer` int(20) NOT NULL COMMENT 'prix_unitaire',
  `prix_unitaire` int(20) NOT NULL,
  `montant_total` int(20) NOT NULL,
  PRIMARY KEY (`id_livraison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `nom` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='table représentant les utilisateurs de notre dépôt';

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`nom`, `mot_de_passe`) VALUES
('admin', 'admin'),
('caissier', 'caissier'),
('magasinier', 'magasinier');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
