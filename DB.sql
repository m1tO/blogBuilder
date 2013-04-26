/*
SQLyog Ultimate v9.20 
MySQL - 5.5.24-log : Database - blog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`blog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `blog`;

/*Table structure for table `categorie` */

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categorie` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `percorso` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`nome`,`percorso`) values (1,'Home','index.php');

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testo` longtext,
  `titolo` varchar(50) DEFAULT NULL,
  `dataPub` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idUtenti` int(11) DEFAULT NULL,
  `percorso` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `post` */

/*Table structure for table `ruoli` */

DROP TABLE IF EXISTS `ruoli`;

CREATE TABLE `ruoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ruoli` */

insert  into `ruoli`(`id`,`nome`) values (1,'other'),(2,'lettore'),(3,'scrittore'),(4,'amministratore');

<<<<<<< HEAD
/*Table structure for table `sottocategorie` */

DROP TABLE IF EXISTS `sottocategorie`;

CREATE TABLE `sottocategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` longtext,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sottocategorie` */
=======
/*Table structure for table `sottocategoria` */

DROP TABLE IF EXISTS `sottocategoria`;

CREATE TABLE `sottocategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sottocategoria` */
>>>>>>> f76d70f560dd28b40d34238f6f8ba893a97414f5

/*Table structure for table `sottocategoriepost` */

DROP TABLE IF EXISTS `sottocategoriepost`;

CREATE TABLE `sottocategoriepost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSottocategoria` int(11) DEFAULT NULL,
  `idPost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sottocategoriepost` */

/*Table structure for table `utenti` */

DROP TABLE IF EXISTS `utenti`;

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT 'img/avatar/default.png',
  `idRuolo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
<<<<<<< HEAD
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `utenti` */

insert  into `utenti`(`id`,`username`,`passwd`,`nome`,`cognome`,`email`,`avatar`,`idRuolo`) values (1,'demo','6c5ac7b4d3bd3311f033f971196cfa75','demo','demo','demo@demo.it','img/avatar/default.png',3),(2,'prova','6c5ac7b4d3bd3311f033f971196cfa75','prova','prova',NULL,'img/avatar/default.png',3);
=======
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `utenti` */

insert  into `utenti`(`id`,`username`,`passwd`,`nome`,`cognome`,`email`,`avatar`,`idRuolo`) values (1,'demo','6c5ac7b4d3bd3311f033f971196cfa75','demo','demo','demo@demo.it','img/avatar/default.png',3);
>>>>>>> f76d70f560dd28b40d34238f6f8ba893a97414f5

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
