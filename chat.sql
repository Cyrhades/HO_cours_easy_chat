-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 17 fév. 2018 à 12:41
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `emoji`
--

DROP TABLE IF EXISTS `emoji`;
CREATE TABLE IF NOT EXISTS `emoji` (
  `name` varchar(10) NOT NULL,
  `url` varchar(80) NOT NULL,
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(2) NOT NULL,
  `message` text NOT NULL,
  `raw_message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `ip`) VALUES
(1, 'Yannick', '192.168.1.93'),
(2, 'Tony', '192.168.1.94'),
(3, 'Megane', '192.168.1.95'),
(4, 'Paul', '192.168.1.96'),
(5, 'Fabrice', '192.168.1.97'),
(6, 'Johanna', '192.168.1.98'),
(7, 'Christopher', '192.168.1.99'),
(8, 'Mehrez', '192.168.1.100'),
(9, 'Charles-Alexandre', '192.168.1.101'),
(10, 'Audrey', '192.168.1.102'),
(11, 'Hakim', '192.168.1.103'),
(12, 'Yseult', '192.168.1.104'),
(13, 'Julien', '192.168.1.105'),
(14, 'Laure', '192.168.1.106'),
(15, 'Cyril', '192.168.1.198');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
