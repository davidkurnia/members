# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.8-MariaDB)
# Database: pwluas
# Generation Time: 2018-12-27 09:59:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table city
# ------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `idcity` int(11) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(150) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idcity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;

INSERT INTO `city` (`idcity`, `cityname`, `country`)
VALUES
	(1,'Yogyakarta','Indonesia'),
	(2,'Tokyo','Japan'),
	(3,'London','UK'),
	(4,'Paris','France');

/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `idcompany` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idcompany`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;

INSERT INTO `company` (`idcompany`, `name`)
VALUES
	(1,'BMD'),
	(2,'Universitas Amikom'),
	(3,'Ayodhya City'),
	(4,'Playground Center');

/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `idcompany` int(11) NOT NULL,
  `idcity` int(11) NOT NULL,
  PRIMARY KEY (`id`,`idcompany`,`idcity`),
  KEY `fk_members_company_idx` (`idcompany`),
  KEY `fk_members_city_idx` (`idcity`),
  CONSTRAINT `fk_members_city1` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_members_company` FOREIGN KEY (`idcompany`) REFERENCES `company` (`idcompany`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `fullname`, `email`, `address`, `foto`, `idcompany`, `idcity`)
VALUES
	(2,'Aydin Ahmad','aydin@gmail.com','Ayodhya Citra',NULL,4,1),
	(3,'Arfan Fatih','arfanfatih@gmail.com','Odaiba City',NULL,3,2),
	(4,'Aqila Nur','aqila@gmail.com','Emirates City',NULL,1,3),
	(5,'Arif Laksito','arif@amikom.ac.id','Ring Road','youravatar.png',2,1);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
