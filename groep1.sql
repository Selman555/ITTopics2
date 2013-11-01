-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 07:24 AM
-- Server version: 5.5.31
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `groep1`
--
CREATE DATABASE IF NOT EXISTS `groep1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `groep1`;

-- --------------------------------------------------------

--
-- Table structure for table `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `HS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HS_Naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `HS_Score` int(11) NOT NULL,
  PRIMARY KEY (`HS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`Mem_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Password veld moet een hash zijn' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Mem_ID`, `Mem_Username`, `Mem_Password`, `Mem_Salt`, `Mem_level`) VALUES
(1, 'Steven', 'verheyen', 'fjdqkljfsklfjqlk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `omschrijving` varchar(255) COLLATE utf8_bin NOT NULL,
  `prioriteit` int(11) NOT NULL,
  `doorID` int(11) NOT NULL,
  `richting` varchar(3) COLLATE utf8_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `naam`, `omschrijving`, `prioriteit`, `doorID`, `richting`, `status`) VALUES
(0, 'TO DO Test Webservice DONE!', 'Een testje om gegevens uit een webservice te lezen', 1, 1, 'AON', 0),
(1, 'Test met webserice - nazicht', 'FREAKING AWESOME!!!', 1, 1, 'AON', 2),
(3, 'Nog een test', 'zodat jullie de layout kunnen bezichtigen TRALALALALAAAAA!!!', 1, 1, 'SNB', 0),
(4, 'Test voor de moeder', 'met een tekst van letters', 2, 1, 'AON', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
