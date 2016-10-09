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
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'Mahavir Bhojanalai','Ahmednagar, Maharashtra',1,1474785169,1475845453),(2,'Mahavir Sweets','Ahmednagar, Maharashtra',1,1474785187,1474785198),(3,'Addedbits','',1,1474785169,1474785169),(4,'Careertech','',0,1474785169,1474785169),(5,'PSL','',0,1475421002,1475422230),(6,'Agile','',0,1475421053,1475421053),(7,'Wipro','Hinjewadi, Pune',0,1475845477,1475845486);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` smallint(2) NOT NULL,
  `invoice_no` int(10) unsigned zerofill NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `customer_info` varchar(355) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,1,2,0000080000,1.00,'12',12),(2,1,2,0000100000,1.00,'12',3),(3,1,1,0000000011,1.00,'12',12),(4,1,2,1000000000,1.00,'12',3),(5,1,1,0000000020,1.00,'12',12),(6,1,2,1000000001,1.00,'12',3);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` smallint(2) NOT NULL,
  `pid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `quanity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_details`
--

LOCK TABLES `invoice_details` WRITE;
/*!40000 ALTER TABLE `invoice_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `cid` smallint(2) NOT NULL,
  `uid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Shev',1,1,12.00,1474785187,1474785187),(2,'Chakli',1,1,0.00,1474785187,1474785187),(3,'Papad',1,2,0.00,1474785187,1474785187),(4,'Murmure',1,3,0.00,1474785187,1474785187),(5,'Chapati',1,1,0.00,1474785187,1474785187),(6,'Rice',1,1,0.00,1474785187,1474785187),(7,'Moong Dal',1,2,0.00,1474785187,1474785187),(8,'Rajma',1,3,0.00,1474785187,1474785187),(9,'Shengdana',1,1,0.00,1474785187,1474785187),(10,'Chatni',1,1,0.00,1474785187,1474785187),(11,'Pickle',1,2,0.00,1474785187,1474785187),(12,'Medu wada',1,3,0.00,1474785187,1474785187),(13,'Crispy Aloo',1,1,0.00,1474785187,1474785187),(14,'Rice Flake',1,1,0.00,1474785187,1474785187),(15,'Moong Wada',1,2,0.00,1474785187,1474785187),(16,'Rajma Wada',1,3,0.00,1474785187,1474785187),(17,'Potato Chivda',2,5,65.01,1474785187,1475956394),(18,'Potato Chakli',2,6,22.20,1474785187,1475956385),(19,'Potato Papad',2,7,12.00,1474785187,1475956372),(20,'Kurkure',2,3,55.00,1474785187,1475956361),(21,'Wafers',2,8,19.00,1474785187,1475956355),(22,'Puf Corn',2,9,15.00,1474785187,1475956345),(23,'Chili Mili',2,10,5.00,1474785187,1475956334),(24,'Banana Chips',2,11,25.00,1474785187,1475956325),(25,'Chikki',2,9,60.00,1474785187,1475956314),(26,'Aloo Bhujiya',2,7,16.00,1474785187,1475956306),(27,'Son Papdi',3,6,0.00,1474785187,1474785187),(28,'Idli',2,6,5.00,1474785187,1475956297),(29,'Cake',2,9,50.00,1474785187,1475956290),(30,'Farsan',2,10,20.00,1474785187,1475956285),(31,'Palak Shev',2,8,13.01,1474785187,1475993384),(32,'Lasoon Shev',1,3,0.00,1474785187,1474785187),(33,'Dhokla',4,1,10.00,1475414740,1475414740),(34,'Dhokli',1,21,12.00,1475416595,1475416595),(35,'Poha1',1,21,10.00,1475418667,1475419289);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_quantity`
--

DROP TABLE IF EXISTS `product_quantity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` smallint(2) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_quantity`
--

LOCK TABLES `product_quantity` WRITE;
/*!40000 ALTER TABLE `product_quantity` DISABLE KEYS */;
INSERT INTO `product_quantity` VALUES (1,1,0,0,10,1474785187),(2,2,0,0,20,1474785187),(3,1,0,0,50,1474784187),(4,2,0,0,200,1474784187),(5,1,0,0,110,1474785167),(6,2,0,0,250,1474785187),(7,1,0,0,502,1474784187),(8,2,0,0,2000,1474784187),(9,35,21,1,1,1475420286),(10,35,21,1,10,1475420297),(11,35,21,1,10000,1475420321),(12,34,21,1,10,1475420419),(13,31,1,2,1000,1475598156),(14,31,1,2,500,1475834929);
/*!40000 ALTER TABLE `product_quantity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_company`
--

DROP TABLE IF EXISTS `user_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_company`
--

LOCK TABLES `user_company` WRITE;
/*!40000 ALTER TABLE `user_company` DISABLE KEYS */;
INSERT INTO `user_company` VALUES (5,16,3,0),(6,16,2,0),(7,16,1,0),(8,16,4,0),(9,16,1,0),(10,16,2,0),(17,1,2,0),(18,20,2,0),(19,20,1,0),(21,1,3,0),(22,1,4,0),(23,21,1,0);
/*!40000 ALTER TABLE `user_company` ENABLE KEYS */;
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
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mahavir1','mahavirm1','veer712@gmail.com','09881712904','9adae88d4114c5e6212de9c9a36929d7',1,1,1474718998,1475344552),(2,'Mahavir2','mahavirm2','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(3,'Mahavir3','mahavirm3','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(4,'Mahavir4','mahavirm4','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(5,'Mahavir5','mahavirm5','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(6,'Mahavir6','mahavirm6','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(7,'Mahavir7','mahavirm7','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(8,'Mahavir8','mahavirm8','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(9,'Mahavir9','mahavirm9','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(10,'Mahavir10','mahavirm10','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(11,'Mahavir11','mahavirm11','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(12,'Mahavir12','mahavirm12','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(13,'Mahavir13','mahavirm13','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(14,'Mahavir14','mahavirm14','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(15,'Mahavir15','mahavirm15','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(16,'Mahavir16','mahavirm16','veer712@gmail.com','09881712904','0d4f6b871cd215fd423c23801092bfd5',1,0,1474718998,1474719195),(17,'Mahavir','mahavirm18','mahavirm1','999','flashkit',1,1,1475332590,1475332590),(18,'Mahavir','mahavirm17','mahavirm17','999','12345',0,0,1475332718,1475332718),(19,'Mahavir19','mahavirm19','mahavirm19','999','123',1,1,1475332762,1475332762),(20,'Mahavir Vijay Munot','mahavirm20','veer712@gmail.com','9881712904','342000dae054d06390f83c617c1c80d0',1,1,1475332812,1475342959),(21,'Rupesh Patwa','rupesh','rupesh@gmail.com','9881712904','9adae88d4114c5e6212de9c9a36929d7',1,1,1475343094,1475416187);
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

-- Dump completed on 2016-10-09 21:38:08
