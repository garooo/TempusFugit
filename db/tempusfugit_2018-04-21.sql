# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: annoiato.net (MySQL 5.5.59-0+deb8u1)
# Database: tempusfugit
# Generation Time: 2018-04-21 06:39:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `idAccount` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `dataNascita` date NOT NULL,
  `cellulare` bigint(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `colore` varchar(10) NOT NULL DEFAULT '#FFFFFF',
  `mail` varchar(30) NOT NULL,
  `nomeUtente` varchar(30) NOT NULL,
  PRIMARY KEY (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;

INSERT INTO `account` (`idAccount`, `nome`, `cognome`, `dataNascita`, `cellulare`, `password`, `colore`, `mail`, `nomeUtente`)
VALUES
	(1,'Test','Prof','1960-10-19',3463689827,'123debole','#FFFFFF','123debole@gmail.com','PROF'),
	(2,'Test','Stud','2000-03-11',3464148707,'456debole','#FFFFFF','456debole@gmail.com','STUD'),
	(3,'Test','Gen','1960-10-20',3459191919,'789debole','#FFFFFF','789debole@gmail.com','GEN'),
	(4,'Test','Sudo','1960-05-10',3464148707,'101debole','#FFFFFF','101debole@gmail.com','SUDO'),
	(7,'Test2','Prof','1919-03-01',3402985648,'102debole','#FFFFFF','120debole@gmail.com','PROF'),
	(8,'ciccio','pasticcio','1999-03-19',3594430591,'wordgiga','#FFFFFF','alfa@gmail.com','wordGiga');

/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
