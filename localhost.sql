-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 13 Octobre 2020 à 11:30
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
-- Structure de la table `Affecter`
--

CREATE TABLE `Affecter` (
  `id_dev` int(11) NOT NULL,
  `id_tache` int(11) NOT NULL,
  `temps` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Competence`
--

CREATE TABLE `Competence` (
  `id_competence` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `version` text NOT NULL,
  `id_dev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `id_contrat` int(11) NOT NULL,
  `delai_prod` text NOT NULL,
  `date_signature` date NOT NULL,
  `coût_global` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Developpeur`
--

CREATE TABLE `Developpeur` (
  `id_dev` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `date_embauche` date NOT NULL,
  `cout_horaire` int(11) NOT NULL,
  `adr_ville` text NOT NULL,
  `adr_cp` text NOT NULL,
  `adr_rue` text NOT NULL,
  `adr_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Developpeur`
--

INSERT INTO `Developpeur` (`id_dev`, `nom`, `prenom`, `date_embauche`, `cout_horaire`, `adr_ville`, `adr_cp`, `adr_rue`, `adr_no`) VALUES
(2, 'Smith', 'John', '0001-02-10', 1900, 'Arras', '62000', 'Rue des chemins', '12');

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
  `id_resp` int(11) NOT NULL,
  `id_contrat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE `Role` (
  `id_role` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Role`
--

INSERT INTO `Role` (`id_role`, `libelle`) VALUES
(1, 'Developpeur'),
(2, 'Client'),
(3, 'Responsable');

-- --------------------------------------------------------

--
-- Structure de la table `Tâche`
--

CREATE TABLE `Tâche` (
  `id_tache` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `temps_tache` text NOT NULL,
  `status` text NOT NULL,
  `id_proj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Affecter`
--
ALTER TABLE `Affecter`
  ADD KEY `id_dev` (`id_dev`),
  ADD KEY `id_tache` (`id_tache`);

--
-- Index pour la table `Competence`
--
ALTER TABLE `Competence`
  ADD PRIMARY KEY (`id_competence`),
  ADD KEY `id_dev` (`id_dev`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`id_contrat`),
  ADD UNIQUE KEY `id_entreprise` (`id_entreprise`) USING BTREE;

--
-- Index pour la table `Developpeur`
--
ALTER TABLE `Developpeur`
  ADD PRIMARY KEY (`id_dev`);

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
  ADD KEY `id_resp` (`id_resp`),
  ADD KEY `id_contrat` (`id_contrat`);

--
-- Index pour la table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `Tâche`
--
ALTER TABLE `Tâche`
  ADD PRIMARY KEY (`id_tache`),
  ADD KEY `id_proj` (`id_proj`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Developpeur`
--
ALTER TABLE `Developpeur`
  MODIFY `id_dev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Role`
--
ALTER TABLE `Role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Affecter`
--
ALTER TABLE `Affecter`
  ADD CONSTRAINT `Affecter_ibfk_2` FOREIGN KEY (`id_tache`) REFERENCES `Tâche` (`id_tache`);

--
-- Contraintes pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `Contrat_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `Entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `Projet`
--
ALTER TABLE `Projet`
  ADD CONSTRAINT `Projet_ibfk_2` FOREIGN KEY (`id_contrat`) REFERENCES `Contrat` (`id_contrat`);

--
-- Contraintes pour la table `Tâche`
--
ALTER TABLE `Tâche`
  ADD CONSTRAINT `Tâche_ibfk_1` FOREIGN KEY (`id_proj`) REFERENCES `Projet` (`id_proj`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `Utilisateur_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `Role` (`id_role`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
