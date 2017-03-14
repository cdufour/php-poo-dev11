-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Mars 2017 à 14:10
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formation-php-poo`
--

-- --------------------------------------------------------

--
-- Structure de la table `but`
--

CREATE TABLE `but` (
  `id` int(11) NOT NULL,
  `rencontre` int(11) NOT NULL,
  `joueur` int(11) NOT NULL,
  `minute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `but`
--

INSERT INTO `but` (`id`, `rencontre`, `joueur`, `minute`) VALUES
(1, 23, 1, 12),
(2, 23, 1, 69),
(3, 23, 2, 80);

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`id`, `nom`) VALUES
(1, 'Amical'),
(2, 'Ligue des Champions'),
(3, 'Ligue 1'),
(4, 'Ligue 2');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `annee_de_creation` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`id`, `nom`, `logo`, `annee_de_creation`) VALUES
(1, 'Paris Saint Germain', '', 1970),
(2, 'Juventus', 'http://www.juventus.com/pics/layout/juventus_logo.png', 1897),
(3, 'Arsenal', '', 1892),
(4, 'Chelsea', '', 1950),
(5, 'Leicester', '', 1936),
(6, 'Inter Milan', '', 1906),
(7, 'Benfica Lisbonne', '', 1890),
(8, 'FC Porto', '', 1906),
(9, 'FC Porto', '', 1906);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`id`, `nom`, `prenom`, `equipe`) VALUES
(1, 'Pogba', 'Paul', 2),
(2, 'Marchisio', 'Claudio', 2),
(3, 'Gianluigi', 'Buffon', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `id` int(11) NOT NULL,
  `equipe1` int(11) NOT NULL,
  `equipe2` int(11) NOT NULL,
  `score1` int(11) NOT NULL,
  `score2` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `competition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rencontre`
--

INSERT INTO `rencontre` (`id`, `equipe1`, `equipe2`, `score1`, `score2`, `date`, `lieu`, `competition`) VALUES
(8, 4, 8, 4, 2, '0000-00-00 00:00:00', 'Milan', 2),
(9, 2, 1, 6, 1, '0000-00-00 00:00:00', 'Turin', 1),
(23, 2, 7, 3, 0, '0000-00-00 00:00:00', 'test', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `but`
--
ALTER TABLE `but`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `but`
--
ALTER TABLE `but`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
