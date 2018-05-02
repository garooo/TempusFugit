# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: annoiato.net (MySQL 5.5.59-0+deb8u1)
# Database: tempusfugit
# Generation Time: 2018-04-05 09:20:32 +0000
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;

INSERT INTO `account` (`idAccount`, `nome`, `cognome`, `dataNascita`, `cellulare`, `password`, `colore`, `mail`, `nomeUtente`)
VALUES
	(1,'Test','Prof','1960-10-19',3463689827,'123debole','#FFFFFF','123debole@gmail.com','PROF'),
	(2,'Test','Stud','2000-03-11',3464148707,'456debole','#FFFFFF','456debole@gmail.com','STUD'),
	(3,'Test','Gen','1960-10-20',3459191919,'789debole','#FFFFFF','789debole@gmail.com','GEN'),
	(4,'Test','Sudo','1960-05-10',3464148707,'101debole','#FFFFFF','101debole@gmail.com','SUDO');

/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comunicazioni
# ------------------------------------------------------------

CREATE TABLE `comunicazioni` (
  `idComunicazione` int(5) NOT NULL,
  `idCorsoCom` int(5) NOT NULL,
  `dataCom` date NOT NULL,
  `idEventoCom` int(5) DEFAULT NULL,
  `idProfCom` int(5) NOT NULL,
  PRIMARY KEY (`idComunicazione`),
  KEY `idCorsoCom` (`idCorsoCom`),
  KEY `idEventoCom` (`idEventoCom`),
  KEY `idProfCom` (`idProfCom`),
  CONSTRAINT `comunicazioni_ibfk_1` FOREIGN KEY (`idCorsoCom`) REFERENCES `corsi` (`idCorso`),
  CONSTRAINT `comunicazioni_ibfk_2` FOREIGN KEY (`idEventoCom`) REFERENCES `eventi` (`idEvento`),
  CONSTRAINT `comunicazioni_ibfk_3` FOREIGN KEY (`idProfCom`) REFERENCES `professore` (`idProfessore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table corsi
# ------------------------------------------------------------

CREATE TABLE `corsi` (
  `idCorso` int(5) NOT NULL AUTO_INCREMENT,
  `nomeCorso` varchar(20) NOT NULL,
  `idGruppoTelegram` int(5) NOT NULL,
  `idProf` int(5) NOT NULL,
  `postiDisponibili` int(4) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`idCorso`),
  UNIQUE KEY `idGruppoTelegram` (`idGruppoTelegram`),
  KEY `idProf` (`idProf`),
  CONSTRAINT `corsi_ibfk_1` FOREIGN KEY (`idProf`) REFERENCES `professore` (`idProfessore`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `corsi` WRITE;
/*!40000 ALTER TABLE `corsi` DISABLE KEYS */;

INSERT INTO `corsi` (`idCorso`, `nomeCorso`, `idGruppoTelegram`, `idProf`, `postiDisponibili`, `descrizione`)
VALUES
	(1,'corso1',1,1,30,'ciaone a tutti - Crso di rova in data 05/04/2018');

/*!40000 ALTER TABLE `corsi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table eventi
# ------------------------------------------------------------

CREATE TABLE `eventi` (
  `idEvento` int(5) NOT NULL,
  `idCCorso` int(5) NOT NULL,
  `dataOra` datetime NOT NULL,
  `luogo` varchar(20) NOT NULL,
  `nPart` int(4) NOT NULL,
  PRIMARY KEY (`idEvento`,`idCCorso`),
  KEY `idCCorso` (`idCCorso`),
  CONSTRAINT `eventi_ibfk_1` FOREIGN KEY (`idCCorso`) REFERENCES `corsi` (`idCorso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `eventi` WRITE;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;

INSERT INTO `eventi` (`idEvento`, `idCCorso`, `dataOra`, `luogo`, `nPart`)
VALUES
	(1,1,'2018-05-10 00:00:00','T06',10);

/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table genitori
# ------------------------------------------------------------

CREATE TABLE `genitori` (
  `idGenitore` int(5) NOT NULL,
  `idFiglio` int(5) NOT NULL,
  PRIMARY KEY (`idGenitore`,`idFiglio`),
  KEY `studenti_ibfk_2` (`idFiglio`),
  CONSTRAINT `studenti_ibfk_2` FOREIGN KEY (`idFiglio`) REFERENCES `studenti` (`idStudente`),
  CONSTRAINT `genitori_ibfk_1` FOREIGN KEY (`idGenitore`) REFERENCES `account` (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `genitori` WRITE;
/*!40000 ALTER TABLE `genitori` DISABLE KEYS */;

INSERT INTO `genitori` (`idGenitore`, `idFiglio`)
VALUES
	(4,2);

/*!40000 ALTER TABLE `genitori` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table iscrizioni
# ------------------------------------------------------------

CREATE TABLE `iscrizioni` (
  `idAccountI` int(5) NOT NULL,
  `idCorsoI` int(5) NOT NULL,
  PRIMARY KEY (`idAccountI`,`idCorsoI`),
  KEY `idCorsoI` (`idCorsoI`),
  CONSTRAINT `iscrizioni_ibfk_1` FOREIGN KEY (`idAccountI`) REFERENCES `account` (`idAccount`),
  CONSTRAINT `iscrizioni_ibfk_2` FOREIGN KEY (`idCorsoI`) REFERENCES `corsi` (`idCorso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `iscrizioni` WRITE;
/*!40000 ALTER TABLE `iscrizioni` DISABLE KEYS */;

INSERT INTO `iscrizioni` (`idAccountI`, `idCorsoI`)
VALUES
	(2,1);

/*!40000 ALTER TABLE `iscrizioni` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table messaggi
# ------------------------------------------------------------

CREATE TABLE `messaggi` (
  `idMessaggioInChat` int(5) NOT NULL,
  `idChat` int(5) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `testo` text,
  `idAllegato` int(10) DEFAULT NULL,
  `dataOra` datetime NOT NULL,
  PRIMARY KEY (`idMessaggioInChat`,`idChat`),
  KEY `idAllegato` (`idAllegato`),
  KEY `idChat` (`idChat`),
  CONSTRAINT `messaggi_ibfk_1` FOREIGN KEY (`idChat`) REFERENCES `corsi` (`idGruppoTelegram`),
  CONSTRAINT `messaggi_ibfk_2` FOREIGN KEY (`idAllegato`) REFERENCES `risorse` (`idRisorsa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table presenze
# ------------------------------------------------------------

CREATE TABLE `presenze` (
  `idAccountP` int(5) NOT NULL,
  `idEventoP` int(5) NOT NULL,
  `dataP` date NOT NULL,
  `oraEntrata` time DEFAULT NULL,
  `oraUscita` time DEFAULT NULL,
  `idProfFirma` int(5) NOT NULL,
  PRIMARY KEY (`idAccountP`,`idEventoP`),
  KEY `idEventoP` (`idEventoP`),
  KEY `presenze_ibfk_5` (`idProfFirma`),
  CONSTRAINT `presenze_ibfk_1` FOREIGN KEY (`idAccountP`) REFERENCES `account` (`idAccount`),
  CONSTRAINT `presenze_ibfk_3` FOREIGN KEY (`idEventoP`) REFERENCES `eventi` (`idEvento`),
  CONSTRAINT `presenze_ibfk_5` FOREIGN KEY (`idProfFirma`) REFERENCES `professore` (`idProfessore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table professore
# ------------------------------------------------------------

CREATE TABLE `professore` (
  `idProfessore` int(5) NOT NULL,
  PRIMARY KEY (`idProfessore`),
  CONSTRAINT `professore_ibfk_1` FOREIGN KEY (`idProfessore`) REFERENCES `account` (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `professore` WRITE;
/*!40000 ALTER TABLE `professore` DISABLE KEYS */;

INSERT INTO `professore` (`idProfessore`)
VALUES
	(1);

/*!40000 ALTER TABLE `professore` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table risorse
# ------------------------------------------------------------

CREATE TABLE `risorse` (
  `idRisorsa` int(11) NOT NULL AUTO_INCREMENT,
  `tipoRisorsa` varchar(4) NOT NULL,
  `bR` longblob NOT NULL,
  PRIMARY KEY (`idRisorsa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table studenti
# ------------------------------------------------------------

CREATE TABLE `studenti` (
  `idStudente` int(5) NOT NULL,
  `matricola` int(5) NOT NULL,
  PRIMARY KEY (`idStudente`),
  CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`idStudente`) REFERENCES `account` (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `studenti` WRITE;
/*!40000 ALTER TABLE `studenti` DISABLE KEYS */;

INSERT INTO `studenti` (`idStudente`, `matricola`)
VALUES
	(2,1234);

/*!40000 ALTER TABLE `studenti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table superuser
# ------------------------------------------------------------

CREATE TABLE `superuser` (
  `idSuperUser` int(5) NOT NULL,
  PRIMARY KEY (`idSuperUser`),
  CONSTRAINT `superuser_ibfk_1` FOREIGN KEY (`idSuperUser`) REFERENCES `account` (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `superuser` WRITE;
/*!40000 ALTER TABLE `superuser` DISABLE KEYS */;

INSERT INTO `superuser` (`idSuperUser`)
VALUES
	(4);

/*!40000 ALTER TABLE `superuser` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table visualizzato
# ------------------------------------------------------------

CREATE TABLE `visualizzato` (
  `idAccountV` int(5) NOT NULL,
  `idComunicazioneV` int(5) NOT NULL,
  PRIMARY KEY (`idAccountV`,`idComunicazioneV`),
  KEY `idComunicazioneV` (`idComunicazioneV`),
  CONSTRAINT `visualizzato_ibfk_1` FOREIGN KEY (`idComunicazioneV`) REFERENCES `comunicazioni` (`idComunicazione`),
  CONSTRAINT `visualizzato_ibfk_2` FOREIGN KEY (`idAccountV`) REFERENCES `studenti` (`idStudente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
