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

/*Table structure for table `about` */

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `company_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `about` */

insert  into `about`(`company_name`,`address`,`location`,`phone_number`,`email`,`description`) values 
('Nama perusahaan','<p>paraghraph</p>\r\n',NULL,'0853533899655','7392maulana@gmail.comm','<p>address</p>\r\n');

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `documentation_id` int(11) NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banner` */

insert  into `banner`(`id_banner`,`documentation_id`) values 
(3,9),
(4,23);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id_category`,`name`,`icon`) values 
(27,'Fashion','4fe43cad8aa3520656f86c836e19ec37.jpg'),
(28,'Food','1da1b6ab19c1d5873e7d11db5a93382e.jpg');

/*Table structure for table `documentation` */

DROP TABLE IF EXISTS `documentation`;

CREATE TABLE `documentation` (
  `id_documentation` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `date_edit` timestamp NULL,
  `users_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_documentation`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documentation` */

insert  into `documentation`(`id_documentation`,`title`,`description`,`date_create`,`date_edit`,`users_id`,`category_id`) values 
(23,'Taman jajan BW10','<p>Deskripsi</p>\r\n','2020-06-24 04:38:48','2020-06-24 04:38:48',1,27),
(29,'TEST','<p>Deskripsi</p>\r\n','2020-06-24 04:52:38','2020-06-24 04:52:38',1,27);

/*Table structure for table `documentation_image` */

DROP TABLE IF EXISTS `documentation_image`;

CREATE TABLE `documentation_image` (
  `id_documentation_image` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentation_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_documentation_image`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documentation_image` */

insert  into `documentation_image`(`id_documentation_image`,`name`,`documentation_id`,`description`) values 
(58,'482b95f8bdbea2e6351c146072e41690.jpg',25,''),
(59,'f6468355699537f4ceed55a378197696.jpg',25,''),
(60,'f4fa44a188ba104733047f5228c243df.jpg',25,''),
(61,'9431088c1b40e35f73675f368a4f60b5.jpg',25,''),
(62,'d3d8018198e43d5b00d769a7b4df1565.jpg',25,''),
(63,'57129aa69e7a9227458de060e454841d.jpg',25,''),
(64,'c80c91a23f834a878b822ae1349c3030.jpg',25,''),
(65,'6e7d758526fbed3acd34988c28dd0efc.jpg',25,''),
(66,'0b56ddb1772b0e30d3e2367a3c20ed67.jpg',25,''),
(67,'975deb7c415037d5f1a67ccb0d3e0fe2.jpg',25,''),
(68,'2f382f7251d39b451fb2dc361786a8fb.jpg',25,''),
(69,'c69a771daa5514367dd0dca520dd6e72.jpg',25,''),
(70,'5c13c190f570b0ad8fbad0318a43771c.jpg',25,''),
(71,'1a09a9fb04cbd9e4232abad626f7ef6b.jpg',25,''),
(72,'c35959987445ce8c0513a2df0c322671.jpg',25,''),
(73,'c2252d4ed38d10a08d6545ef0a1f1bd1.jpg',25,''),
(74,'909903b8d8eeee22189f25e05717a285.jpg',25,''),
(75,'c9d08909f1defa44209813519d4d6bfe.jpg',25,''),
(76,'1bb365ef428e4bd06ac5b0793390cda0.jpg',25,''),
(77,'6baea92f6c8f4c133ad37f91f8f932d6.png',25,''),
(98,'71a65f1ab659b7c8c882046111406a81.jpg',23,''),
(105,'e880e28826379c5a2dade1fac880ba39.png',23,''),
(106,'1e92b48d79517a5e1ea9ad3b2f57189d.jpg',23,''),
(107,'90af49331352137bcf1465d13801b4ed.jpg',23,''),
(108,'aae57eed4d58d96184e6897e88f86e84.jpg',23,''),
(109,'34b61ed718b58f673948aa0b83c12770.jpg',26,''),
(110,'fedf40c9f6bcda194dc6a0dd6800813b.jpg',27,''),
(111,'facdd1f5e2b346de4f3446700bf26c1b.jpg',27,''),
(112,'ebed454cb193b312feff1951781a3114.png',28,''),
(113,'9f5a1e1f2fd282c5c8bdbc469b9712f7.png',29,'');

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

/*Table structure for table `social` */

DROP TABLE IF EXISTS `social`;

CREATE TABLE `social` (
  `id_social` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_social`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `social` */

insert  into `social`(`id_social`,`id`,`url`,`img`,`path`) values 
(49,'7392maulana@gmail.com','mailto:7392maulana@gmail.com','gmail.jpg','path'),
(50,'','','1865ac04b892267b1a3a5e14ba9bdeed.jpg','http://192.168.100.146/bw10/assets/sosmed_icon'),
(51,'Hhh','Hhhj','5d5478b0a1ed272384824669da3302f3.jpg','http://192.168.100.146/bw10/assets/sosmed_icon'),
(52,'','','5ce8fe747bb0efebbee75d3ed348954d.png','http://localhost/bw10/assets/sosmed_icon'),
(53,'','','72cc60c552d004c9580face659fe9ed2.jpg','http://localhost/bw10/assets/sosmed_icon'),
(54,'','','e147538fd2e5a549d988dc468158c6ee.png','http://localhost/bw10/assets/sosmed_icon');

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
(1,'127.0.0.1','administrator','$2y$12$ZM5xx.DXRDP0MwNaTWBQhOb9vXAG2Uk5VzH989fzAHAskv1/jfeA6','7392maulana@gmail.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1592944942,1,'Administrator',8208010010,'085353389965','730edc645f4103bfdd1ed40d8a76a41e.jpeg');

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
