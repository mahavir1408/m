-- MySQL dump 10.13  Distrib 5.6.26, for osx10.8 (x86_64)
--
-- Host: localhost    Database: mahavir
-- ------------------------------------------------------
-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` smallint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Mahavir Bhojanalai',1,1474785169,1474785187),(2,'Mahavir Sweets',1,1474785187,1474785198);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `passwd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mahavir1','mahavirm1','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(2,'Mahavir2','mahavirm2','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(3,'Mahavir3','mahavirm3','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(4,'Mahavir4','mahavirm4','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(5,'Mahavir5','mahavirm5','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(6,'Mahavir6','mahavirm6','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(7,'Mahavir7','mahavirm7','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(8,'Mahavir8','mahavirm8','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(9,'Mahavir9','mahavirm9','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(10,'Mahavir10','mahavirm10','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(11,'Mahavir11','mahavirm11','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(12,'Mahavir12','mahavirm12','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(13,'Mahavir13','mahavirm13','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(14,'Mahavir14','mahavirm14','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(15,'Mahavir15','mahavirm15','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195),(16,'Mahavir16','mahavirm16','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,1474718998,1474719195);
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

-- Dump completed on 2016-09-28 23:32:33
