-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 25 Octobre 2012 à 09:50
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mks`
--

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int(255) NOT NULL AUTO_INCREMENT,
  `PItem` text NOT NULL,
  `PDetails` varchar(255) NOT NULL,
  `PPriority` int(11) NOT NULL,
  `PEstimateValue` int(11) NOT NULL,
  `PEstimateEffort` int(11) NOT NULL,
  `PRemaining` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`ProductID`, `PItem`, `PDetails`, `PPriority`, `PEstimateValue`, `PEstimateEffort`, `PRemaining`) VALUES
(1, 'Create a market place', 'a good market place', 2, 5, 2, 0),
(4, 'Admin''s back office', 'Create form auth and admin''s back office for administrate this web site', 2, 10, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

CREATE TABLE IF NOT EXISTS `sprint` (
  `SprintID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  PRIMARY KEY (`SprintID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sprint`
--

INSERT INTO `sprint` (`SprintID`, `ProductID`) VALUES
(1, 1),
(2, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TDescription` text NOT NULL,
  `TEffort` int(11) NOT NULL,
  `SprintID` int(11) NOT NULL,
  PRIMARY KEY (`TaskID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`TaskID`, `TDescription`, `TEffort`, `SprintID`) VALUES
(1, 'Create form auth', 1, 1),
(2, 'show table', 0, 1),
(8, 'Organiser le tableau commande', 5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UName` varchar(55) NOT NULL,
  `ULastName` varchar(55) NOT NULL,
  `UMail` varchar(55) NOT NULL,
  `SprintID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`UserID`, `UName`, `ULastName`, `UMail`, `SprintID`) VALUES
(1, 'Pierre', 'Houdyer', 'houdyer@intech.fr', 1),
(2, 'Jessica', 'NDJIKI', 'ndjiki@intechinfo.fr', 1),
(3, 'Antoine', 'Meunier', 'ameunier@intechinfo.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `usertask`
--

CREATE TABLE IF NOT EXISTS `usertask` (
  `UserTaskID` int(11) NOT NULL AUTO_INCREMENT,
  `SprintID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`UserTaskID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `usertask`
--

INSERT INTO `usertask` (`UserTaskID`, `SprintID`, `UserID`) VALUES
(1, 1, 1),
(2, 1, 2),
(7, 4, 1),
(8, 4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
