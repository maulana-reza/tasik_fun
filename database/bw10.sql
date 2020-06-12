/*
SQLyog Professional v12.5.1 (32 bit)
MySQL - 10.4.12-MariaDB : Database - bw10
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bw10` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `bw10`;

/*Table structure for table `documentation` */

DROP TABLE IF EXISTS `documentation`;

CREATE TABLE `documentation` (
  `id_documentation` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id_documentation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documentation` */

insert  into `documentation`(`id_documentation`,`title`,`description`,`date_create`,`date_edit`,`users_id`) values 
(2,'dokumentasi - update','<p>Deskripsi</p>','2020-06-12 13:28:39','2020-06-12 13:39:35',1),
(3,'dokumentasi','<p>Deskripsi</p>','2020-06-12 13:28:39','2020-06-12 13:28:39',1);

/*Table structure for table `documentation_image` */

DROP TABLE IF EXISTS `documentation_image`;

CREATE TABLE `documentation_image` (
  `id_documentation_image` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentation_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_documentation_image`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documentation_image` */

insert  into `documentation_image`(`id_documentation_image`,`name`,`documentation_id`,`description`) values 
(1,'61eaa4bb095a8bba9aa28e5d51d158b6.jpeg',2,''),
(10,'ff1df89e91d55772ee09401bddabddb4.jpeg',2,''),
(11,'ab13f73a074a7017be6da230d40a6bc8.jpeg',2,''),
(12,'fbf08a1d72e34ccb745f93bcc1d136e2.jpeg',3,''),
(13,'73dd4dfd0e1d2f75f877b40d1c06f1ae.jpeg',3,''),
(14,'c7995b22b23870bc649cc116991c4df2.jpeg',2,''),
(15,'e1396e50176a8b67d0d05454a22d5c26.jpeg',2,''),
(16,'2d3f1abcd73133634f4f5ac9b3c7d9cf.jpeg',2,''),
(17,'4433c536c249189f89b3d745de7e3dde.jpeg',2,'');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values 
(1,'admin','Administrator'),
(2,'members','General User');

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

insert  into `login_attempts`(`id`,`ip_address`,`login`,`time`) values 
(99,'::1','administratorp',1591894112),
(100,'::1','admin',1591895659),
(101,'::1','askdj',1591895753),
(102,'::1','asdkj',1591895902),
(103,'::1','asdkj',1591895902),
(104,'::1','alsjdk',1591895922),
(105,'::1','ajlsdkj',1591896045);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `villages_id` bigint(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`email`,`activation_selector`,`activation_code`,`forgotten_password_selector`,`forgotten_password_code`,`forgotten_password_time`,`remember_selector`,`remember_code`,`created_on`,`last_login`,`active`,`full_name`,`villages_id`,`phone`,`img`) values 
(1,'127.0.0.1','administrator','$2y$12$ZM5xx.DXRDP0MwNaTWBQhOb9vXAG2Uk5VzH989fzAHAskv1/jfeA6','7392maulana@gmail.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1591941880,1,'Administrator',8208010010,'085353389965','730edc645f4103bfdd1ed40d8a76a41e.jpeg'),
(34,'192.168.100.2','Voknam','$2y$10$IMfynFJQb9pINB2KYtCc7uqXhJyLvZs0XA2u.OuhVrDBdO41nDMZi','ardy544752@gmail.com',NULL,NULL,NULL,NULL,NULL,'692ccc7ef438041cde3f23e53a81e4db2c6c06d0','$2y$10$3XMSCeIGsiixnimLuqYxLe6RG//5cSVa96pQMAljNue7m75E9QEvq',1584416156,1584416237,1,'Voknam',2147483647,'089530056404',NULL),
(60,'::1','administrators','$2y$10$XRE64UYxNF5rUNjwNCkCN.25y0f.GkwJlneGsmsuZZ.P6DUczhCke','psynuyul20@gmail.com',NULL,NULL,'0f22ff8f4acde503ceab','$2y$10$GdNBdFIomwBz3AwE/3l7PO6Mse8tl1NH.aPezhyoGu/gvWdYZRIGa',1585088600,NULL,NULL,1585074527,NULL,1,'psynuyul',NULL,NULL,NULL),
(61,'::1','maulana-reza','$2y$10$F4LpjOQ5SmTXlTEPy1bkCuO/L49lPbF2or1XGVd1IS9vDjpAjJwDq','psynuyul1@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585088999,1586526964,1,'psynuyul',NULL,NULL,NULL),
(62,'192.168.1.6','asobiasobase','$2y$10$gWEMAEUwlaRTWX2s7BnhfebWUO3fSy4FtZCmiBHSNPCkS7WbBIx.K','psynuyul19@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585217709,1586291594,1,'maulana',3206120006,'','0dac85112b62f26d8f66279477ed30d0.jpg'),
(63,'192.168.1.6','TEST-1','$2y$10$MVX1r1qlJfHp7BoIz9ESs.NeD72ldoOYs42lTabbQ2ojv/wq2dj12','psynuyul9@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585271520,1585294367,1,'TEST-1',1706030024,'085353389965',NULL),
(64,'::1','asobiasbas','$2y$10$TXCk0l2Fbz6fHbcaZDNY1eI6yrvhgSmXEAo/VPX88XWnLvg65Y2R.','psynuyul5@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585431490,NULL,1,'psynuyul',NULL,NULL,NULL),
(65,'192.168.43.1','administratorsss','$2y$10$bI35QR8q1ixddKRD8dM/celVg1NU01P5CLmeNraPPSx6BNXIt1lJe','psynuyul15@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585432814,NULL,1,'admins',NULL,NULL,NULL),
(66,'192.168.43.1','administratorsssss','$2y$10$CBawSwEboXT1SeM0e1Jz.eyUA0bAEuJOC8cS5fiGlMUkK.y0MnrrK','psynuyul7@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585432893,NULL,1,'admins',NULL,NULL,NULL),
(67,'192.168.43.1','Asobi','$2y$10$TK1n2b0IPmdGtCup1tw/pOqbM0aVbu8dNk9/zYDRr9hDLNwB6W3ja','psynuyul8@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1585433261,1585435601,1,'Kdkkdksk',NULL,NULL,NULL),
(68,'::1','alksdjalksdj','$2y$10$mn0oM2sLxytnitXqMtA3q.AfpWLASx.HLgEDirKbmtuZmATKtL3EK','psynuyul16@gmail.com','4c5e1cc4f7762ee25c89','$2y$10$mRmCUm62gtXrgKGBwP94N.m1lKgMt/fdpfqCi4YgLaY9fAgOXHD72',NULL,NULL,NULL,NULL,NULL,1585596187,NULL,0,'kasjdklajsdlk',NULL,NULL,NULL);

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values 
(1,1,1),
(2,1,2),
(3,2,2),
(4,3,2),
(5,4,2),
(6,5,2),
(7,7,2),
(8,8,2),
(9,9,2),
(10,10,2),
(11,11,2),
(12,12,2),
(13,13,2),
(14,14,2),
(15,15,2),
(16,16,2),
(17,17,2),
(18,18,2),
(19,19,2),
(20,20,2),
(21,21,2),
(22,23,2),
(23,24,2),
(24,25,2),
(25,26,2),
(26,27,2),
(27,28,2),
(28,29,2),
(29,30,2),
(30,32,2),
(31,33,2),
(32,34,2),
(33,35,2),
(34,36,2),
(35,37,2),
(36,38,2),
(37,39,2),
(38,40,2),
(39,42,2),
(40,43,2),
(41,44,2),
(42,45,2),
(43,46,2),
(44,47,2),
(45,48,2),
(46,49,2),
(47,50,2),
(48,51,2),
(49,52,2),
(50,53,2),
(51,54,2),
(52,55,2),
(53,56,2),
(54,57,2),
(55,58,2),
(56,59,2),
(57,60,2),
(58,61,2),
(59,62,2),
(60,63,2),
(61,64,2),
(62,65,2),
(63,66,2),
(64,67,2),
(65,68,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
