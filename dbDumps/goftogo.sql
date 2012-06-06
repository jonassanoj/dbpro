-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2012 at 01:48 AM
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
  `date` date NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`answerID`),
  UNIQUE KEY `answeredDate` (`date`),
  KEY `Question_ID_fk_Answer` (`questionID`),
  KEY `Answer_userID_FK` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Catagory`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(40) NOT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `answerID` int(11) DEFAULT NULL,
  `Date` date NOT NULL,
  `body` text NOT NULL,
  `questionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `Answer_ID_fk_Comment` (`answerID`),
  KEY `Comment_userID_FK` (`userID`),
  KEY `Questionid_to_comment` (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `Field`
--

CREATE TABLE IF NOT EXISTS `Field` (
  `fieldID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(50) NOT NULL,
  PRIMARY KEY (`fieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) DEFAULT NULL,
  `fieldID` int(11) DEFAULT NULL,
  `postedDate` date DEFAULT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`questionID`),
  KEY `Question_userID_FK` (`userID`),
  KEY `Question_fieldID_FK` (`fieldID`),
  KEY `Question_catID_FK` (`catID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(20) NOT NULL,
  `fullName` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(120) NOT NULL,
  `imagePath` varchar(100) DEFAULT NULL,
  `acountCreationDate` date DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  `lastLogin` date DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `dateOfBirth` varchar(30) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `fieldID` int(11) DEFAULT NULL,
  `userTypeID` int(11) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`userID`),
  KEY `fieldID_to_User_fk_company` (`fieldID`),
  KEY `UserType_to_User_fk_company` (`userTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE IF NOT EXISTS `UserType` (
  `userTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(50) NOT NULL,
  PRIMARY KEY (`userTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `Answer_userID_FK` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`),
  ADD CONSTRAINT `Question_ID_fk_Answer` FOREIGN KEY (`questionID`) REFERENCES `Question` (`questionID`);

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Answer_ID_fk_Comment` FOREIGN KEY (`answerID`) REFERENCES `Answer` (`answerID`),
  ADD CONSTRAINT `Comment_userID_FK` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`),
  ADD CONSTRAINT `Questionid_to_comment` FOREIGN KEY (`questionID`) REFERENCES `Question` (`questionID`);

--
-- Constraints for table `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `Question_ibfk_1` FOREIGN KEY (`fieldID`) REFERENCES `Field` (`fieldID`),
  ADD CONSTRAINT `Question_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `User` (`userID`),
  ADD CONSTRAINT `Question_ibfk_3` FOREIGN KEY (`catID`) REFERENCES `Catagory` (`catID`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `FieldID_to_User` FOREIGN KEY (`fieldID`) REFERENCES `Field` (`fieldID`),
  ADD CONSTRAINT `userType_to_user` FOREIGN KEY (`userTypeID`) REFERENCES `UserType` (`userTypeID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
