-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: psychologist
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` bigint(19) DEFAULT NULL,
  `visible` enum('0','1') NOT NULL DEFAULT '0',
  `content` longtext DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `section` bigint(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'Первая новость!',NULL,1,'1','',NULL,1585167920,'Появился сайт!','12345',NULL),(3,'Вторая новость!',NULL,2,'1','',1585213977,NULL,'Сайт успешно запущен на Internet Explorer!','IE, совместимость, сайт',NULL);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constants`
--

DROP TABLE IF EXISTS `constants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `value` mediumtext DEFAULT NULL,
  `translate` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constants`
--

LOCK TABLES `constants` WRITE;
/*!40000 ALTER TABLE `constants` DISABLE KEYS */;
INSERT INTO `constants` VALUES (1,'root-path','path:Psycologist/',''),(2,'reviews-quantity','int:5',NULL);
/*!40000 ALTER TABLE `constants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `position` bigint(19) DEFAULT 1,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `visible` enum('1','0') DEFAULT '0',
  `description` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Основное меню',2,NULL,NULL,'1',NULL,NULL),(5,'test',2,NULL,1585213860,'0','Description of test menu','ok, ok1, ok2, test');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` bigint(19) NOT NULL,
  `display_children` enum('0','1') NOT NULL DEFAULT '0',
  `content` longtext DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `visible_in` enum('t','s','ts','0') DEFAULT '0',
  `description` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `is_link` enum('0','1') DEFAULT '1',
  `parent_id` bigint(19) DEFAULT 0,
  `menu_id` bigint(10) DEFAULT 0,
  `section_id` bigint(10) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Главная','Home',1,'1','<div class=\"text-center\"><h2 style=\"color: darkred\">Hello!!!</h2></div>\r\n[show_reviews]',NULL,1585740242,'ts','Description of Main page','ok, ok1, ok2','1',0,1,0),(17,'Тест','Тест',2,'0','[show_reviews_form]',1585740287,1585740304,'ts','Тест','Тест','1',1,1,0);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user` enum('hidden','visible') NOT NULL DEFAULT 'visible',
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `uploads` tinytext DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'test','test',4,3,'hidden',NULL,1586001995,NULL,1),(2,'test','tetetetetetet',2,0,'visible',1586001364,NULL,NULL,1),(3,'Тестовый отзыв','Норм',5,9,'visible',1586171378,1586171387,NULL,1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `position` bigint(19) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `visible` enum('0','1') DEFAULT '0',
  `description` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_codes`
--

DROP TABLE IF EXISTS `short_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `short_codes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varbinary(255) NOT NULL,
  `replacement` longtext DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `type` enum('c','d') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_codes`
--

LOCK TABLES `short_codes` WRITE;
/*!40000 ALTER TABLE `short_codes` DISABLE KEYS */;
INSERT INTO `short_codes` VALUES (1,'show_blog','','','c'),(2,'show_reviews','return returnReviews(\\app\\App::$id);',NULL,'c'),(3,'show_contacts','',NULL,'c'),(4,'show_sections',NULL,NULL,'c'),(8,'show_reviews_form','return \"<form method=\'post\' class=\'reviews text-center\'>\r\n<div class=\'row\'><div class=\'col-md-4\'><label for=\'rev-name\'>Ваше имя <sup class=\'req-star\'>*</sup>:</label></div>\r\n<div class=\'col-md-6\'><input type=\'text\' name=\'name\' required id=\'rev-name\' class=\'form-control\'></div></div>\r\n<div class=\'row\'><div class=\'col-md-6 offset-md-4\'><button type=\'submit\' class=\'btn btn-success btn-block\'>Отправить</button></div></div>\r\n</form>\";','','c');
/*!40000 ALTER TABLE `short_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varbinary(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` tinytext DEFAULT NULL,
  `role` enum('admin','moderator','commentator') NOT NULL DEFAULT 'commentator',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Daniel','admin','ae4796ff256d132001303b2cbd80b5e6','admin:OjoxOmFlNDc5NmZmMjU2ZDEzMjAwMTMwM2IyY2JkODBiNWU2','admin'),(8,'test','test','5d3fd1749a6d575b606278792208c7f5','test:OjoxOjVkM2ZkMTc0OWE2ZDU3NWI2MDYyNzg3OTIyMDhjN2Y1','moderator'),(9,'test2','test2','8dbeabbefbe263b99f1269e8975531f3','test2:OjoxOjhkYmVhYmJlZmJlMjYzYjk5ZjEyNjllODk3NTUzMWYz','commentator');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-16 22:39:38
