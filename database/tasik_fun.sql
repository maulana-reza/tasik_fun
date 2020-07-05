/*
SQLyog Professional v12.5.1 (32 bit)
MySQL - 10.4.12-MariaDB : Database - tasik_fun
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tasik_fun` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `tasik_fun`;

/*Table structure for table `about` */

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `about` */

insert  into `about`(`description`) values 
('<p>Test Informasi</p>\r\n\r\n<p>&nbsp;</p>\r\n');

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `nama_panggilan` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`nama`,`tahun`,`nama_panggilan`,`contact`) values 
('Dewi Intan Sari',22,'Dewi','089651820260'),
('Ikhsan Nurjaman',20,'Ikhsan','085320026960'),
('Melisa Maharani',19,'Melisa','089603711246'),
('Yulia Harliani',21,'Yulia','085219429955');

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `kode_article` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `article` */

insert  into `article`(`kode_article`,`title`,`image`,`description`,`date_create`,`users_id`) values 
('JU002','judulkj','08b17467227a3220253bce453383531d.jpg','<p>Deskripsiasdsd</p>\r\n','2020-07-05 22:51:48',NULL),
('NA003','nama tempat','1f11dc839c878f757b141fdf281b3d38.jpg','<p>Deskripsi</p>\r\n','2020-07-05 22:54:04',NULL);

/*Table structure for table `article_image` */

DROP TABLE IF EXISTS `article_image`;

CREATE TABLE `article_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_article` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `article_image` */

insert  into `article_image`(`id`,`img`,`kode_article`) values 
(2,'efdd00c2524c4a4c7031c70c2d2e8f58.jpg','JU002'),
(3,'eb4a7406f73fed644bf772498802f48b.jpg','NA003');

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `tempat_wisata` */

DROP TABLE IF EXISTS `tempat_wisata`;

CREATE TABLE `tempat_wisata` (
  `kode_tempat_wisata` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tempat` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tempat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_tempat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'current_timestamp()',
  PRIMARY KEY (`kode_tempat_wisata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tempat_wisata` */

insert  into `tempat_wisata`(`kode_tempat_wisata`,`nama_tempat`,`alamat_tempat`,`img_tempat`) values 
('CBCSY001','nama tempat','alamat','0782934f00438c96f3a6a6b665c6ecf0.jpg'),
('CBCSY002','nama tempat','alamat','9a14a68e1e02b7a6ea5d628c9f21944a.jpg');

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
(1,'127.0.0.1','administrator','$2y$12$ZM5xx.DXRDP0MwNaTWBQhOb9vXAG2Uk5VzH989fzAHAskv1/jfeA6','7392maulana@gmail.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1593957973,1,'Administrator',8208010010,'085353389965','730edc645f4103bfdd1ed40d8a76a41e.jpeg');

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
