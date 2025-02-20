/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - db_simaks
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simaks` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_simaks`;

/*Table structure for table `pengumuman` */

DROP TABLE IF EXISTS `pengumuman`;

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengumuman` text DEFAULT NULL,
  `nidn` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengumuman` */

insert  into `pengumuman`(`id`,`pengumuman`,`nidn`,`tgl`) values 
(1,'besok Libur','10101010','2022-01-18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
