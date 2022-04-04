-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 04 avr. 2022 à 15:12
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP : 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `GestionStockDepotBoisson`
--
CREATE DATABASE IF NOT EXISTS `GestionStockDepotBoisson` DEFAULT CHARACTER SET utf32 COLLATE utf32_general_ci;
USE `GestionStockDepotBoisson`;

-- --------------------------------------------------------

--
-- Structure de la table `Boissons`
--

CREATE TABLE `Boissons` (
  `nom` varchar(255) NOT NULL,
  `prix_unitaire` double NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `fournisseur` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `date_livraison` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantite_livrer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `Boissons`
--

INSERT INTO `Boissons` (`nom`, `prix_unitaire`, `quantite`, `fournisseur`, `minimum`, `date_livraison`, `quantite_livrer`) VALUES
('castel', 650, 5, 1, 5, '2022-04-04 11:00:10', 5);

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `nom` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `dette` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `id` int(11) NOT NULL,
  `boisson` varchar(255) NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `Commandes`
--

INSERT INTO `Commandes` (`id`, `boisson`, `fournisseur`, `date_commande`) VALUES
(1, 'castel', 1, '2022-04-04 11:00:10');

-- --------------------------------------------------------

--
-- Structure de la table `Factures`
--

CREATE TABLE `Factures` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `articles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`articles`)),
  `montant` double NOT NULL,
  `date_achat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `Fournisseurs`
--

CREATE TABLE `Fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `Fournisseurs`
--

INSERT INTO `Fournisseurs` (`id`, `nom`, `tel`) VALUES
(1, 'Wilfried-Tech', 657933001);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `nom` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='table représentant les utilisateurs de notre dépôt';

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`nom`, `mot_de_passe`) VALUES
('admin', 'admin'),
('caissier', 'caissier'),
('magasinier', 'magasinier'),
('secretaire', 'secretaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Boissons`
--
ALTER TABLE `Boissons`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`tel`) USING BTREE;

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Factures`
--
ALTER TABLE `Factures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Fournisseurs`
--
ALTER TABLE `Fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`nom`) USING BTREE,
  ADD UNIQUE KEY `mot_de_passe` (`mot_de_passe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Factures`
--
ALTER TABLE `Factures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Fournisseurs`
--
ALTER TABLE `Fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
