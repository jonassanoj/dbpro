
CREATE TABLE IF NOT EXISTS `Answer` (
  `answerID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`answerID`),
  UNIQUE KEY `answeredDate` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `Category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldID` int(11) DEFAULT NULL,
  `catName` varchar(40) NOT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `Comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `answerID` int(11) DEFAULT NULL,
  `questionID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `Field` (
  `fieldID` int(11) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(50) NOT NULL,
  PRIMARY KEY (`fieldID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `Question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `title` varchar(140) NOT NULL,
  `body` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `User` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeID` int(11) DEFAULT NULL,
  `fieldID` int(11) DEFAULT NULL,
  `userName` varchar(20) NOT NULL,
  `fullName` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(120) NOT NULL,
  `imagePath` varchar(100) DEFAULT NULL,
  `accountCreationDate` datetime DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  `lastLogin` datetime DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `dateOfBirth` varchar(30) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `UserType` (
  `userTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(50) NOT NULL,
  PRIMARY KEY (`userTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `QuestionVote` (
  `voteID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  PRIMARY KEY (`voteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `AnswerVote` (
  `voteID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL,
  PRIMARY KEY (`voteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `UserType` (`userTypeID`, `userType`) VALUES
(8, 'unconfirmed'),
(9, 'deactivated'),
(1, 'Normal User'),
(2, 'Editor'),
(3, 'Admin');


