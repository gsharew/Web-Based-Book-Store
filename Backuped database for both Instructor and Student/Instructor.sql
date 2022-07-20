-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: Instructor
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Software_Engineering`
--

DROP TABLE IF EXISTS `Software_Engineering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Software_Engineering` (
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `year` varchar(3) DEFAULT NULL,
  `semister` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Software_Engineering`
--

LOCK TABLES `Software_Engineering` WRITE;
/*!40000 ALTER TABLE `Software_Engineering` DISABLE KEYS */;
INSERT INTO `Software_Engineering` VALUES ('Getachew','Sharew','Getachew','Getachew','Software_Engineering','java','1y','1s');
/*!40000 ALTER TABLE `Software_Engineering` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_comment`
--

DROP TABLE IF EXISTS `instructor_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_comment` (
  `username` varchar(30) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `comment` longtext,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_comment`
--

LOCK TABLES `instructor_comment` WRITE;
/*!40000 ALTER TABLE `instructor_comment` DISABLE KEYS */;
INSERT INTO `instructor_comment` VALUES ('Getachew','Software_Engineering','Hey Good work ','19-02-2022'),('Getachew','Software_Engineering','You are the great always ok ? you hear me ? ','19-02-2022'),('Getachew','Software_Engineering','i would like to thank you so much ','19-02-2022');
/*!40000 ALTER TABLE `instructor_comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-19 17:19:29
