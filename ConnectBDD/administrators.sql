-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 avr. 2020 à 14:03
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
CREATE TABLE IF NOT EXISTS `administrators` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login_admin` varchar(255) DEFAULT NULL,
  `pass_admin` varchar(255) DEFAULT NULL,
  `date_admin` datetime DEFAULT NULL,
  `ip_admin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`id_admin`, `login_admin`, `pass_admin`, `date_admin`, `ip_admin`) VALUES
(1, 'admin', 'admin', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
