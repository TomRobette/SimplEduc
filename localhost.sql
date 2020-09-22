-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 22 Septembre 2020 à 11:25
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simpleduc`
--
CREATE DATABASE IF NOT EXISTS `simpleduc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `simpleduc`;

-- --------------------------------------------------------

--
-- Structure de la table `Competence`
--

CREATE TABLE `Competence` (
  `id_competence` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `version` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `id_contrat` int(11) NOT NULL,
  `delai_prod` text NOT NULL,
  `date_signature` date NOT NULL,
  `coût_global` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Developpeur`
--

CREATE TABLE `Developpeur` (
  `id_dev` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `no_sup` int(11) DEFAULT NULL,
  `date_embauche` date NOT NULL,
  `coût_horaire` int(11) NOT NULL,
  `adr_ville` text NOT NULL,
  `adr_cp` text NOT NULL,
  `adr_rue` text NOT NULL,
  `adr_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Entreprise`
--

CREATE TABLE `Entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `adr_ville` text NOT NULL,
  `adr_cp` text NOT NULL,
  `adr_rue` text NOT NULL,
  `adr_no` text NOT NULL,
  `nom_contact` text NOT NULL,
  `prenom_contact` text NOT NULL,
  `tel_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Projet`
--

CREATE TABLE `Projet` (
  `id_proj` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `id_resp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Tâche`
--

CREATE TABLE `Tâche` (
  `id_tache` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `temps_tache` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Competence`
--
ALTER TABLE `Competence`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`id_contrat`);

--
-- Index pour la table `Developpeur`
--
ALTER TABLE `Developpeur`
  ADD PRIMARY KEY (`id_dev`),
  ADD KEY `no_sup` (`no_sup`),
  ADD KEY `no_sup_2` (`no_sup`),
  ADD KEY `id_dev` (`id_dev`);

--
-- Index pour la table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `Projet`
--
ALTER TABLE `Projet`
  ADD PRIMARY KEY (`id_proj`),
  ADD KEY `id_resp` (`id_resp`);

--
-- Index pour la table `Tâche`
--
ALTER TABLE `Tâche`
  ADD PRIMARY KEY (`id_tache`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Developpeur`
--
ALTER TABLE `Developpeur`
  ADD CONSTRAINT `Developpeur_ibfk_1` FOREIGN KEY (`no_sup`) REFERENCES `Developpeur` (`id_dev`);

--
-- Contraintes pour la table `Projet`
--
ALTER TABLE `Projet`
  ADD CONSTRAINT `Projet_ibfk_1` FOREIGN KEY (`id_resp`) REFERENCES `Developpeur` (`id_dev`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
