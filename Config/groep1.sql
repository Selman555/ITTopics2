-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2013 at 10:10 AM
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
DROP DATABASE IF EXISTS `groep1`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `id_website`, `textNL`, `textEN`) VALUES
(1, 'hoofdpagina', 'Wij zijn Pixel Apps, ook wel bekend als Groep 6.<br />__NewLine__Samen met onze 6 groepsleden verzorgen wij het reilen en zijlen op Ford Lommel Proving Grounds.<br />__NewLine__<br />__NewLine__<b>Korte inleiding</b><br />__NewLine__<p>Onze taak bestaat er uit een functionele applicatie te maken binnen Windows 8. De app bestaat er uit de chauffeurs te begeleiden op hun testritten.<br />De chauffeurs worden onder andere geholpen bij het bekijken van hun routineplan, het bijhouden van notities en het overzetten van de resultaten naar het hoofdgebouw.</p>__NewLine__<b>Bijkomende hoort natuurlijk het onderhouden van deze website.</b>__NewLine__<p>Zoals u kan zien vind u hierboven het navigatiemenu.<br />__NewLine__Voor meer informatie over ons project kan u terecht bij <i>Over ons</i><br />__NewLine__Wenst u contact op te nemen? U kan zich wenden naar het tabblad <i>Contact</i><br />__NewLine__Indien u meer over de individuele groepsleden wil weten kan u terecht bij <i>Leden</i><br />__NewLine__Als u meer informatie wenst over ons project, gelieve contact op te nemen met ons en wij verzorgen uw verzoek.</p>__NewLine__<b>Happy browsing!</b>', 'We are Pixel Apps (aka Group 6).<br />__NewLine__Together as a team of 6 members we are devoded to increase productivity at Ford Lommel Proving Grounds.<br />__NewLine__<br />__NewLine__<b>Short introduction</b><br />__NewLine__<p>Our mission exists in creating a functional app for Windows 8 tablets. The app is intented as a guiding tool for the drivers at Ford Proving Grounds during their test drives. <br />__NewLine__Drivers are aided with an overview of their driving routine, keeping an overview of comments made and sending all that data back to the main building for processing.</p>__NewLine__<b>On second hand, keeping an eye on this website is a maintenance task we are eager to commit ourselves to.</b><br />__NewLine__<p>Have you noticed the navigation menu at the top of this page? <br />__NewLine__For more information about our mission, please visit <i>About us</i><br />__NewLine__If you didn’t find what you were looking for, head over to <i>Contact</i>. We are happy to help. <br />__NewLine__Do you wish to know more about each individual member of our team, go to our <i>Members</i> page. <br /><br />__NewLine__<b>Happy browsing!</b>'),
(2, 'aboutpagina', '<h1>Over opdrachtgever</h1>__NewLine__<article>__NewLine__<p>Onze opdracht werd gegeven door Lommel Proving Grounds. <br>__NewLine__Dit bedrijf is gelegend in het bosrijke Lommel.<br><br>__NewLine__Bij Lommel Proving Grounds worden allerlei autos getest op verschillende punten.<br>__NewLine__Enkele voorbeelden van controlepunten:</p>__NewLine__<ul>__NewLine__<li>Duurzaamheid</li>__NewLine__<li>Corrosie</li>__NewLine__<li>Prestatie</li>__NewLine__<li>Remfunctionaliteit</li>__NewLine__<li>...</li>__NewLine__</ul>__NewLine__<p>Voor deze testen uitvoerbaar zijn, moeten er een groot aantal testchauffeurs aanwezig.<br>__NewLine__Deze testchauffeurs krijgen allemaal elke dag een heleboel documenten mee.<br>__NewLine__Daarom kwam Lommel Proving Grounds naar ons met de vraag of we een applicatie konden schrijven __NewLine__die het hun mensen wat gemakkelijker kon maken<br>__NewLine__met betrekking tot het vele papierwerk.</p>__NewLine__</article>__NewLine__<article> __NewLine__<h1>Waarom dit project</h1>__NewLine__<p>Onze groep heeft deze opdracht gekozen omdat:</p>__NewLine__<ul>__NewLine__<li>Het ons een interessant project leek, met veel mogelijkheid tot zelfontplooing</li>__NewLine__<li>Tevens vormt het voor ons ook een uitdaging om zulk een groot project in goede banen te leiden.</li>__NewLine__</ul>__NewLine__</article>__NewLine__<article>__NewLine__<h1>Opdrachtomschrijving</h1>__NewLine__<p>Het doel van dit project is het maken van een applicatie die de volgend dingen aanbiedt:</p>__NewLine__<ul>__NewLine__<li>Een digitale versie van alle taken en aandachtspunten voor de chauffeur.</li>__NewLine__<li>Voice to tekst, zodat de chauffeur tijdens het rijden opmerkingen kan inspreken.</li>__NewLine__<li>Bijhouden van waarschuwingen en problemen voor de volgende gebruiker.</li>__NewLine__<li>De bestuurder zou via wifi-connectie gegevens moeten kunnen doorsturen naar de server</li>__NewLine__<li>Als er geen wifi is dan moeten de gegevens via usb of bleutooth kunnen worden doorgegeven</li>__NewLine__</ul>__NewLine__</article>', '<h1>About our employer</h1>__NewLine__<article>__NewLine__<p>Our mission was presented to us by Ford Lommel Proving Grounds. A company residing at Lommel.<br />__NewLine__At Ford, many cars are tested for endurance. Some of these tests consist of:<br />__NewLine__<ul>__NewLine__<li>Durability</li>__NewLine__<li>Corrosion</li>__NewLine__<li>Performance</li>__NewLine__<li>Braking capabilities</li>__NewLine__<li>...</li>__NewLine__</ul>__NewLine__To be able to test all these cars, a lot of drivers are required.<br />__NewLine__Each day, the drivers are handed a ton of documents that are to be filled in manually.<br />__NewLine__Ford came to us looking for a solution in the form of a mobile app that would make their lives easier.<br />__NewLine__No more paperwork!</p>__NewLine__</article>__NewLine__<article>__NewLine__<h1>Why are we doing this?</h1>__NewLine__<p>Basically, we choose this because:__NewLine__<ul>__NewLine__<li>We saw the potential this projects holds for us, in means of self-improvement.</li>__NewLine__<li>A great opportunity where we could prove our worth which will not go by unnoticed.</li>__NewLine__</ul>__NewLine__</p>__NewLine__</article>__NewLine__<h1>Mission description</h1>__NewLine__<article>__NewLine__<p>At the end of our sprints, the app must have all of these capabilities:__NewLine__<ul>__NewLine__<li>Digitalisation of all POI for the drivers.</li>__NewLine__<li>Voice-to-tekst, enabling drivers to take notes while driving.</li>__NewLine__<li>Keeping track on notes and warnings for other drivers.</li>__NewLine__<li>The driver is able to send all the data gathered during driving to other storage media.</li>__NewLine__<li>In case of no connectivity, the data will be transfered by USB-flash drive</li>__NewLine__</ul></p>__NewLine__</article>');

-- --------------------------------------------------------

--
-- Table structure for table `errorlogging`
--

CREATE TABLE IF NOT EXISTS `errorlogging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `err_page` varchar(255) COLLATE utf8_bin NOT NULL,
  `err_message` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `errorlogging`
--

INSERT INTO `errorlogging` (`id`, `err_page`, `err_message`) VALUES
(2, 'Hoofdpagina', 'CMS is niet verzonden! Nee niet echt, dit is een test...'),
(3, 'ImbaPlayer', '1002');

-- --------------------------------------------------------

--
-- Table structure for table `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `HS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HS_Naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `HS_Score` int(11) NOT NULL,
  PRIMARY KEY (`HS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `highscore`
--

INSERT INTO `highscore` (`HS_ID`, `HS_Naam`, `HS_Score`) VALUES
(1, 'Glenn', 100),
(2, 'Steven', 50),
(3, 'glenn2', 1000),
(4, 'WingedDestinyX', 657),
(5, '8BallJunkie', 987),
(6, 'Selman555', 678),
(7, 'AnkeA', 123),
(8, 'StevenV', 564),
(9, 'RandomName', 213);

-- --------------------------------------------------------

--
-- Table structure for table `iplogging`
--

CREATE TABLE IF NOT EXISTS `iplogging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipadress` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Dumping data for table `iplogging`
--

INSERT INTO `iplogging` (`id`, `date`, `ipadress`) VALUES
(5, '2013-11-03 16:58:58', '::1'),
(6, '2013-11-03 16:59:49', '::1'),
(7, '2013-11-12 20:34:09', '::1'),
(8, '2013-11-12 20:54:31', '::1'),
(9, '2013-11-12 21:00:17', '::1'),
(10, '2013-11-12 21:03:12', '::1'),
(11, '2013-11-12 21:08:09', '::1'),
(12, '2013-11-12 21:12:28', '::1'),
(13, '2013-11-12 22:45:03', '::1'),
(14, '2013-11-12 22:45:23', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `Mem_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Mem_Username` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_Password` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_Salt` varchar(255) COLLATE utf8_bin NOT NULL,
  `Mem_level` int(1) NOT NULL,
  PRIMARY KEY (`Mem_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Password veld moet een hash zijn' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Mem_ID`, `Mem_Username`, `Mem_Password`, `Mem_Email`, `Mem_Salt`, `Mem_level`) VALUES
(1, 'Robbie', '99d87a7e84cd122af96a045d85bfd857fe50013c', 'freestylerstyler760@hotmail.com', 'c31wewg4zf', 1),
(2, 'selman555', '622651d5760a0a3613216328f09734a5f3266c27', 'robbie.vercammen@gmail.com', 'gPq05LBDi5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `punten`
--

CREATE TABLE IF NOT EXISTS `punten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `punt_behaald` int(11) NOT NULL,
  `punt_mogelijk` int(11) NOT NULL,
  `omschrijving` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `punten`
--

INSERT INTO `punten` (`id`, `naam`, `punt_behaald`, `punt_mogelijk`, `omschrijving`) VALUES
(1, 'ITTopics 2 Project', 19, 20, 'HTML5, CSS3 en javascript website'),
(2, 'ITTopics 1 project', 12, 20, 'IOS applicatie ontwikkeling'),
(3, 'MS Project', 16, 20, 'Sprints in MS Project');

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
(0, 'Inleveren MS Project', 'Sprints uitwerken in MS Project', 1, 1, 'AON', 0),
(1, 'Mock-Ups', 'Mock-Ups aanpassen aan meneer Heyns'' opmerkingen', 1, 1, 'AON', 2),
(3, 'Gegevensanalyse', 'ICT Project gegevensanalyse verbeteren', 1, 1, 'SNB', 0),
(4, 'OO-Analyse', 'ICT Project OO-Analyse verbeteren', 2, 1, 'AON', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
