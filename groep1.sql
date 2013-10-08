-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2013 at 06:18 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Password veld moet een hash zijn' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
