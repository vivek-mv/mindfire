-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2016 at 10:58 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(20) NOT NULL,
  `fax` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `eid`, `type`, `street`, `city`, `state`, `zip`, `fax`) VALUES
(7, 106, 1, 'infocity,patia', 'bbsr', 'Orissa', 752050, 0),
(8, 106, 2, 'infocity,patia', '', '', 0, 0),
(9, 107, 1, 'erwew', 'sdf', 'Madhya Pradesh', 0, 0),
(10, 107, 2, 'erwew', '', 'Assam', 0, 0),
(13, 109, 1, 'infocity,patia', 'bbsr', 'Orissa', 752050, 0),
(14, 109, 2, 'infocity,patia', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `commMedium`
--

CREATE TABLE IF NOT EXISTS `commMedium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empId` int(11) NOT NULL,
  `msg` tinyint(1) NOT NULL,
  `email` tinyint(1) NOT NULL,
  `call` tinyint(1) NOT NULL,
  `any` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empId` (`empId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `commMedium`
--

INSERT INTO `commMedium` (`id`, `empId`, `msg`, `email`, `call`, `any`) VALUES
(4, 106, 0, 0, 0, 0),
(5, 107, 1, 1, 0, 0),
(7, 109, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(3) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `landline` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `maritalStatus` varchar(10) NOT NULL,
  `employment` varchar(11) NOT NULL,
  `employer` varchar(25) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `prefix`, `firstName`, `middleName`, `lastName`, `gender`, `dob`, `mobile`, `landline`, `email`, `maritalStatus`, `employment`, `employer`, `photo`, `note`) VALUES
(102, 'mr', 'asd', '', '', 'm', '0000-00-00', '', '', 'smruti@mail.com', 'married', 'employed', '', '', ''),
(106, 'mis', 'asd', '', '', 'm', '2016-06-09', '', '', 'smruti@mail.com', 'married', 'employed', 'elsewhere', 'football.jpg', ''),
(107, 'mr', 'ads', '', '', 'm', '2016-06-11', '', '', 'smruti@mail.com', 'married', 'unemployed', '', 'tree.jpg', ''),
(109, 'mr', 'afdjojfdo', '', '', 'm', '2016-06-04', '', '', 'smruti@mail.com', 'married', 'employed', '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `eid` FOREIGN KEY (`eid`) REFERENCES `employee` (`eid`);

--
-- Constraints for table `commMedium`
--
ALTER TABLE `commMedium`
  ADD CONSTRAINT `empID` FOREIGN KEY (`empId`) REFERENCES `employee` (`eid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
