
`database`: "vaseAcademyDB"

drop database vaseAcademyDB;

show databases;

create database vaseAcademyDB;
use vaseAcademyDB;

CREATE TABLE `login` (
  `id` int(11) NOT NULL primary key,
  `userName` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `login` (`id`, `userName`, `password`, `token`, `firstName`, `lastName`, `phone`, `email`, `type`, `active`, `createdDate`, `updatedDate`) 
VALUES (1, 'admin', 'admin', '2057564ac24451b55368bb170fe0b91d', 'admin', 'admin', '9986552521', 'admin@gmail.com', 1, 1, now(), now());

CREATE TABLE IF NOT EXISTS `subject` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sname` varchar(80) NOT NULL, 
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY(`sname`),
  PRIMARY KEY (`sid`)
);

or 

CREATE TABLE IF NOT EXISTS `subject` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sname` varchar(80) NOT NULL, 
  `cmap` varchar(80) ,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY(`sname`),
  PRIMARY KEY (`sid`)
);


SELECT * FROM subject WHERE FIND_IN_SET((SELECT cid FROM class WHERE cid=9), class_map)

CREATE TABLE IF NOT EXISTS `class` (
  `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(80) NOT NULL, 
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY(`cname`),
  PRIMARY KEY (`cid`)
);




CREATE TABLE IF NOT EXISTS `classSub` (
  `csid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL, 
  `sid` int(11) NOT NULL, 
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY(`csid`),
  PRIMARY KEY (`csid`)
);


CREATE TABLE IF NOT EXISTS `studentprofile` (
  `stid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `uname` varchar(500) NOT NULL,
  `father_name` varchar(500) DEFAULT NULL,
  `emailid` char(50) NOT NULL,
  `verifyemail` varchar(1) DEFAULT NULL,
  `mobilenumber` char(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text,
  `profilepicurl` text,
  `classId` varchar(50)NOT NULL,
  `subjectID` varchar(50) NOT NULL,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stid`)
)


CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uemail` char(50) NOT NULL,
  `token` varchar(200) NOT NULL,
  `upassword` varchar(50) NOT NULL,
  `utype` char(1) NOT NULL DEFAULT 'U',
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY(`uemail`),
  PRIMARY KEY (`uid`)
);




CREATE TABLE IF NOT EXISTS `teacherprofile` (
  `tid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Teachername` varchar(500) NOT NULL,
  `father_name` varchar(500) DEFAULT NULL,
  `emailid` char(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verifyemail` varchar(1) DEFAULT NULL,
  `mobilenumber` char(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text,
  `profilepicurl` text,
  `classId` varchar(50),
  `subjectID` varchar(50) NOT NULL,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`)
)

