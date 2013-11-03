-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2013 at 05:02 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `groep1`
--
CREATE DATABASE IF NOT EXISTS `groep1` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `groep1`;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_website` varchar(255) COLLATE utf8_bin NOT NULL,
  `textNL` text COLLATE utf8_bin NOT NULL,
  `textEN` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `id_website`, `textNL`, `textEN`) VALUES
(1, 'hoofdpagina', 'testje', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `HS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HS_Naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `HS_Score` int(11) NOT NULL,
  PRIMARY KEY (`HS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `highscore`
--

INSERT INTO `highscore` (`HS_ID`, `HS_Naam`, `HS_Score`) VALUES
(1, 'Glenn', 100),
(2, 'Steven', 50),
(3, 'glenn2', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `iplogging`
--

CREATE TABLE IF NOT EXISTS `iplogging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipadress` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `iplogging`
--

INSERT INTO `iplogging` (`id`, `date`, `ipadress`) VALUES
(5, '2013-11-03 16:58:58', '::1'),
(6, '2013-11-03 16:59:49', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `Mem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Mem_Username` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_Password` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_Salt` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_level` int(1) NOT NULL,
  PRIMARY KEY (`Mem_ID`),
  KEY `UsernameAndPassword` (`Mem_Username`,`Mem_Password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Password veld moet een hash zijn' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Mem_ID`, `Mem_Username`, `Mem_Password`, `Mem_Salt`, `Mem_level`) VALUES
(1, 'glenn', 'testje', 'salt', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
