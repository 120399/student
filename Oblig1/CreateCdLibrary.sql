-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Generation Time: Aug 18, 2013 at 08:28 PM
-- Server version: 5.6.11-log
-- PHP Version: 5.4.14

--
-- Database: `oppstartsoving`
--

-- --------------------------------------------------------

--
-- Table structure for table `cd`
--

CREATE TABLE IF NOT EXISTS `cd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_bin NOT NULL,
  `artist` varchar(128) COLLATE utf8_bin NOT NULL,
  `genre` varchar(128) COLLATE utf8_bin NOT NULL,
  `creationYear` year(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MusicGenreIdx` (`genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cd`
--

INSERT INTO `cd` (`id`, `title`, `artist`, `genre`, `creationYear`) VALUES
(1, 'Believe - Deluxe Edition (m/DVD)', 'Justin Bieber', 'Pop', 2012),
(2, 'Contakt', 'Madcon', 'Hip hop', 2012),
(3, 'Live Viking Stadion 9. Juni 2012', 'Mods', 'Rock', 2012),
(4, 'Living Things', 'Linkin Park', 'Hardrock', 2012),
(5, 'Odyssey - In Studio & In Concert (3CD)', 'Terje Rypdal', 'Klassisk', 2012),
(6, 'Sexual Harassment - Limited Edition', 'Turboneger', 'Punk', 2012);
