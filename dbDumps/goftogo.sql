-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2012 at 12:03 AM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `goftogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
  `answerID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`answerID`),
  UNIQUE KEY `answeredDate` (`date`),
  KEY `Question_ID_fk_Answer` (`questionID`),
  KEY `Answer_userID_FK` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Answer`
--

INSERT INTO `Answer` (`answerID`, `questionID`, `userID`, `body`, `rank`, `date`) VALUES
(1, 1, 3, 'my sql is .................', 0, '2012-06-05'),
(2, 1, 3, 'php means..............', 0, '2012-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldID` int(11) DEFAULT NULL,
  `catName` varchar(40) NOT NULL,
  PRIMARY KEY (`catID`),
  KEY `Category_fieldID_FK` (`fieldID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`catID`, `fieldID`, `catName`) VALUES
(1, 1, 'PHP'),
(2, 2, 'SQL'),
(3, 3, 'Mesh network'),
(4, 4, 'e-Government');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `answerID` int(11) DEFAULT NULL,
  `questionID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `Answer_ID_fk_Comment` (`answerID`),
  KEY `Comment_userID_FK` (`userID`),
  KEY `Questionid_to_comment` (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`commentID`, `answerID`, `questionID`, `userID`, `body`, `date`) VALUES
(1, NULL, 1, 1, 'it is good question but if you clearfy bet more what php means ', '2012-06-05'),
(2, NULL, 1, 4, 'hi this is not relevent question to this feild ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Field`
--

CREATE TABLE IF NOT EXISTS `Field` (
  `fieldID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(50) NOT NULL,
  PRIMARY KEY (`fieldID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Field`
--

INSERT INTO `Field` (`fieldID`, `fieldName`) VALUES
(1, 'Software Engineering'),
(2, 'Datatbase Management System'),
(3, 'Network'),
(4, 'Computer and Sociaty');

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `postedDate` date DEFAULT NULL,
  PRIMARY KEY (`questionID`),
  KEY `Question_userID_FK` (`userID`),
  KEY `Question_catID_FK` (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`questionID`, `catID`, `userID`, `title`, `body`, `rank`, `postedDate`) VALUES
(1, 1, 1, 'What is PHP', 'please provide me how to write hello world in PHP', 0, '2012-06-04'),
(2, 2, 2, 'my sql ', 'how to run query in mysql ', 0, '2012-06-03'),
(3, 2, 3, 'اچ ټی ام ال څه شی دی ', 'مهربانی وکی که د اچ تی امل په هکله څه معلومات راکی زه په دی څانګه کی نوی یم ', 0, '2012-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeID` int(11) DEFAULT NULL,
  `fieldID` int(11) DEFAULT NULL,
  `userName` varchar(20) NOT NULL,
  `fullName` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(120) NOT NULL,
  `imagePath` varchar(100) DEFAULT NULL,
  `acountCreationDate` date DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  `lastLogin` date DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `dateOfBirth` varchar(30) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`userID`),
  KEY `fieldID_to_User_fk_company` (`fieldID`),
  KEY `UserType_to_User_fk_company` (`userTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `userTypeID`, `fieldID`, `userName`, `fullName`, `email`, `password`, `imagePath`, `acountCreationDate`, `rank`, `lastLogin`, `organization`, `location`, `dateOfBirth`, `degree`, `detail`) VALUES
(1, 1, 3, 'SSameem', 'Saminullah Sameem ', 'SSameem@hotmail.com', '', NULL, '2012-06-06', 0, '2012-06-06', 'Khost University ', NULL, '01-01-1983', 'master', 'Saminullah is lecturer in khost university '),
(2, 1, 2, 'Ghezal_Ahmad', 'Ghezal Ahmadzai', 'Ghezal@yahoo.com', '', NULL, '2012-06-06', 0, '2012-06-06', 'Kabul University', NULL, '01-01-1986', 'master', 'Ghezal Ahmad zia is the profisional person in Database '),
(3, 2, 3, 'AAkbary', 'Abdul Aziz Akbary', 'Akbaty1@yahoo.com', '', NULL, '2012-06-05', 0, '2012-06-03', 'Khost University', NULL, '01-01-1983', 'master', NULL),
(4, 2, 4, 'AAlizai', 'Ashuqulllah Alizai', 'Alizai.csf@hotmail.com', '', NULL, '2012-06-06', 0, '2012-06-06', 'Herat University ', 'Farah', '01/01/1985', 'master', 'Alizai is teacher in herat University'),
(5, 1, 1, 'WAhmadZai', 'Wazir khan AhmadZai', 'WAhmadzai@yahoo.com', '', NULL, '2012-06-06', 0, '2012-06-06', 'Nangarhar University', 'Nangarhar', '01-01-1986', 'master', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE IF NOT EXISTS `UserType` (
  `userTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(50) NOT NULL,
  PRIMARY KEY (`userTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `UserType`
--

INSERT INTO `UserType` (`userTypeID`, `userType`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Normal User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `Answer_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `Question` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Answer_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `Category_fieldID_FK` FOREIGN KEY (`fieldID`) REFERENCES `Field` (`fieldID`);

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`answerID`) REFERENCES `Answer` (`answerID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Comment_ibfk_3` FOREIGN KEY (`questionID`) REFERENCES `Question` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `Question_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Question_ibfk_3` FOREIGN KEY (`catID`) REFERENCES `Category` (`catID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`fieldID`) REFERENCES `Field` (`fieldID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `User_ibfk_2` FOREIGN KEY (`userTypeID`) REFERENCES `UserType` (`userTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
