-- MySQL dump 10.13  Distrib 5.6.27, for FreeBSD10.2 (amd64)
--
-- Host: localhost    Database: lisod
-- ------------------------------------------------------
-- Server version	5.6.27-log

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
-- Table structure for table `acl`
--

DROP TABLE IF EXISTS `acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `tab` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT '0',
  `btn_add` int(11) DEFAULT '0',
  `btn_save` int(11) DEFAULT '0',
  `btn_del` int(11) DEFAULT '0',
  `confirm` int(11) DEFAULT '0',
  `deconfirm` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl`
--

LOCK TABLES `acl` WRITE;
/*!40000 ALTER TABLE `acl` DISABLE KEYS */;
INSERT INTO `acl` VALUES (1,102,0,0,0,1,0,0,0,1),(2,102,0,0,1,1,1,1,1,1),(3,102,0,1,0,1,0,0,0,0),(4,102,0,1,1,1,1,1,1,0),(5,103,0,0,0,1,0,0,0,0),(6,103,0,0,1,1,1,1,0,0),(7,103,1,0,0,1,0,0,0,0),(8,103,1,1,0,1,0,0,0,0),(9,103,1,0,1,1,1,1,0,0),(10,103,1,1,1,1,1,1,0,0),(11,103,1,2,0,1,0,0,0,0),(12,103,1,2,1,1,1,1,0,0),(13,103,1,3,0,1,0,0,0,0),(14,103,1,3,1,1,1,1,0,0),(15,103,3,0,0,1,0,0,0,0),(16,103,3,0,1,1,1,1,0,0),(17,103,3,1,0,0,0,0,0,0),(18,103,3,1,1,0,0,0,0,0),(19,102,1,0,0,1,0,0,0,0),(20,102,1,0,1,1,1,1,0,0),(21,102,1,1,0,1,0,0,0,0),(22,102,1,1,1,1,1,1,0,0),(23,102,1,2,0,1,0,0,0,0),(24,102,1,2,1,1,1,1,0,0),(25,102,1,3,0,1,0,0,0,0),(26,102,1,3,1,1,1,1,0,0),(27,102,3,0,0,1,0,0,0,0),(28,102,3,0,1,1,1,1,0,0),(29,102,3,1,0,1,0,0,0,0),(30,102,3,1,1,1,1,1,0,0),(31,102,3,2,0,1,0,0,0,0),(32,102,3,2,1,1,1,1,0,0),(33,102,3,3,0,1,0,0,0,0),(34,102,3,3,1,1,1,1,0,0),(35,105,3,1,1,0,1,0,0,0),(36,102,4,0,1,0,0,0,1,0),(37,102,4,1,0,1,0,0,0,0),(38,102,4,1,1,1,1,1,1,0),(39,105,4,0,0,1,0,0,0,0),(40,105,4,0,1,1,1,1,1,0);
/*!40000 ALTER TABLE `acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `birthday`
--

DROP TABLE IF EXISTS `birthday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `birthday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `birthday`
--

LOCK TABLES `birthday` WRITE;
/*!40000 ALTER TABLE `birthday` DISABLE KEYS */;
/*!40000 ALTER TABLE `birthday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `doctor` int(11) DEFAULT '0',
  `callerCID` varchar(20) DEFAULT NULL COMMENT 'CID позвонившего',
  `toCID` varchar(50) DEFAULT NULL COMMENT 'линия на которую позвонили. Для VIP контакт-центра 2020300',
  `event` varchar(50) DEFAULT NULL COMMENT 'тип звонка. Сейчас два значения ”Входящий”, “Разговор”',
  `call_date` datetime DEFAULT NULL COMMENT 'дата и время звонка',
  `pid` int(11) NOT NULL COMMENT 'уникальный идентификатор',
  `filename` varchar(256) DEFAULT NULL COMMENT 'имя файла записи разговора',
  `operator` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `comment` text,
  `manager` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (3,'Валентин Романович','Петров Петр петрович',12,'0674026850','2020300','Входящий','2016-03-19 00:04:00',2,'test.wav',NULL,1,' ввв',NULL),(4,'dfeeeeeee','xsvdvdvdf',12,'0674026850','2020300','Входящий','2016-04-10 00:04:00',2,'test.wav',NULL,1,' ввв',NULL),(5,NULL,NULL,0,'0674026850','2020300','Входящий','2016-04-05 11:04:00',4,'test.wav',NULL,0,NULL,NULL),(6,'nnnnnn','pppp',8,'0674026850','2020300','Входящий','2016-04-05 11:04:00',5,'test.wav',NULL,1,'',NULL),(7,'tttt','Второй пациент',26,'0674026850','2020300','Входящий','2016-04-12 18:04:00',6,'test.wav',NULL,1,' ваваав',NULL),(8,'l lzlzl4445','Второй пациент',26,'0674026850','2020300','Входящий','2016-04-12 18:04:00',7,'test.wav',10,1,'  aaa  ',NULL),(9,'дядя','віп паціент',27,'0674026850','2020300','разговор','2016-04-12 18:04:00',8,'test.wav',10,1,' коментююю  4    ',0),(10,'звонящий','новый пациент',27,'0674026843','2020300','разговор','2016-04-12 19:04:00',9,'test.wav',10,1,' ком новый пациент',0),(11,'sssssss','patient new',26,'0674026843','2020300','разговор','2016-04-12 19:04:00',10,'test.wav',10,1,' qaz',0),(12,NULL,NULL,0,'0674026842','2020300','разговор','2016-04-14 19:04:00',11,'test.wav',NULL,0,NULL,0),(13,NULL,NULL,0,'0674026850','2020300','Входящий','2016-04-13 18:04:00',12,'test.wav',NULL,0,NULL,0),(14,NULL,NULL,0,'444','2020300','разговор','2016-04-12 19:04:00',13,'test.wav',NULL,0,NULL,0),(15,NULL,NULL,0,'0674026850','2020300','Входящий','2016-04-12 18:04:00',14,'test.wav',NULL,0,NULL,0),(16,NULL,NULL,0,'0978884433','2020300','разговор','2016-04-13 12:55:00',15,'tttt.wav',NULL,0,NULL,0),(17,'квоывмы ывмм ','третий пациент',25,'2344334','2020300','разговор','2016-04-16 20:04:00',16,NULL,10,1,' позвонил поздно вечером',0),(18,NULL,NULL,0,'122121','2020300','разговор','2016-04-17 23:00:00',17,NULL,NULL,0,NULL,0),(19,NULL,NULL,0,'3333333','2020300','разговор','2016-04-17 23:00:01',18,NULL,NULL,0,NULL,0),(20,NULL,NULL,0,'33333as33','2020300','разговор','2016-04-18 23:00:01',19,NULL,NULL,0,NULL,0),(21,NULL,NULL,0,'2313','2020300','разговор','2016-04-18 21:00:01',20,NULL,NULL,0,NULL,0),(22,NULL,NULL,0,'aaaaaaa','2020300','разговор','2016-04-18 20:00:01',21,NULL,NULL,0,NULL,0),(23,NULL,NULL,0,'bbbb','2020300','разговор','2016-04-18 23:00:01',22,NULL,NULL,0,NULL,0),(24,'sdvvs','dhffbfgg',25,'asfafsc','2020300','разговор','2016-04-19 23:00:01',23,NULL,3,1,' ',0),(25,'aaa','неизвестный',28,'csdssddfdfdsf','2020300','разговор','2016-04-19 22:00:01',24,NULL,10,1,' ',0),(26,'fghfhhjghjgjhg','Новый Больной',28,'7777777','2020300','разговор','2016-04-20 22:00:01',25,NULL,10,1,'  ',0);
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Kiev',NULL),(2,'Odessa',NULL);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic`
--

DROP TABLE IF EXISTS `clinic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `region` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic`
--

LOCK TABLES `clinic` WRITE;
/*!40000 ALTER TABLE `clinic` DISABLE KEYS */;
INSERT INTO `clinic` VALUES (1,'Lisod',31,1),(2,'Esida',35,1),(3,'assss123',1,0),(4,'Клиника',40,1),(5,'якорь',1,1),(6,'bavпробел',2,0),(7,'Новая запись',42,1),(8,'Клиника2',1,0),(9,'newnewnenw',1,0),(10,'gggg',2,0),(11,'assss123',2,1);
/*!40000 ALTER TABLE `clinic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT ' /* comment truncated */ /*0 - активный\n1 - статусный\n2 - отказ\n3 - не сотрудничает*/',
  `bithday` int(11) DEFAULT '0',
  `card` varchar(16) DEFAULT NULL,
  `special` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `percent` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  `clinic` int(11) DEFAULT '0',
  `comment` text,
  `manager` int(11) DEFAULT '0',
  `dt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (25,'Врач Первый',2,0,'',1,'aa',0,1,4,'      ',6,'2016-04-12 07:55:04'),(26,'Второй Доктор',3,0,'',2,'',0,1,1,'       ',6,'2016-04-12 07:55:04'),(27,'Статусний врач',0,0,'',1,'',0,1,2,' ',7,'2016-04-12 07:55:04'),(28,'Новый Дядя',0,0,'',3,'в@sdvsdfg',0,1,4,'  ',6,'2016-04-20 13:09:14');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_contact`
--

DROP TABLE IF EXISTS `doctor_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_contact` (
  `pid` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_contact`
--

LOCK TABLES `doctor_contact` WRITE;
/*!40000 ALTER TABLE `doctor_contact` DISABLE KEYS */;
INSERT INTO `doctor_contact` VALUES (12,20),(12,21),(12,22),(11,39),(NULL,40),(15,53),(NULL,54),(24,55),(NULL,56),(NULL,57),(27,63),(26,61),(26,62),(28,64),(28,65),(25,59),(25,60);
/*!40000 ALTER TABLE `doctor_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edit_acl`
--

DROP TABLE IF EXISTS `edit_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edit_acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `tab` int(11) DEFAULT NULL,
  `edit` varchar(45) DEFAULT NULL,
  `permission` int(11) DEFAULT '0' COMMENT '0 - do not show\n1 - read\n2 - write',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edit_acl`
--

LOCK TABLES `edit_acl` WRITE;
/*!40000 ALTER TABLE `edit_acl` DISABLE KEYS */;
INSERT INTO `edit_acl` VALUES (1,103,3,0,'mo_id',0),(2,103,3,0,'dt_consultion',0);
/*!40000 ALTER TABLE `edit_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin`
--

DROP TABLE IF EXISTS `fin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  `mo_id` int(11) DEFAULT NULL,
  `sum` float DEFAULT '0',
  `bonus` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin`
--

LOCK TABLES `fin` WRITE;
/*!40000 ALTER TABLE `fin` DISABLE KEYS */;
INSERT INTO `fin` VALUES (1,'2016-03-31 00:00:00',54184,0,500),(2,'2016-03-31 00:00:00',55447,7742,887.1),(3,'2016-03-30 00:00:00',55465,825,82.5),(4,'2016-03-31 00:00:00',53760,7742,887.1);
/*!40000 ALTER TABLE `fin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `name` varchar(45) DEFAULT NULL,
  `id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES ('crm_manager',103),('crm_operator',105),('crm_socio',106),('crm_project',102),('crm_boss',101),('crm_admin',100);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `plan` int(11) DEFAULT '0',
  `region` int(11) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `user` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (3,42,'a@bbbb.c',1,1,6,'2016-04-12 07:55:41'),(4,31,'aaaaa',3,1,7,'2016-04-12 07:55:41');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_contact`
--

DROP TABLE IF EXISTS `manager_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager_contact` (
  `pid` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_contact`
--

LOCK TABLES `manager_contact` WRITE;
/*!40000 ALTER TABLE `manager_contact` DISABLE KEYS */;
INSERT INTO `manager_contact` VALUES (7,52),(6,49),(6,50),(6,51);
/*!40000 ALTER TABLE `manager_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_work`
--

DROP TABLE IF EXISTS `manager_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager` int(11) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  `visits` int(11) DEFAULT '0',
  `done` int(11) DEFAULT '0',
  `plan` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_work`
--

LOCK TABLES `manager_work` WRITE;
/*!40000 ALTER TABLE `manager_work` DISABLE KEYS */;
INSERT INTO `manager_work` VALUES (1,6,'2016-04-09 00:00:00',0,0,22),(2,6,'2016-04-09 00:00:00',0,0,22),(3,6,'2016-04-09 00:00:00',0,0,22),(4,6,'2016-04-09 00:00:00',0,0,22),(5,6,'2016-04-09 00:00:00',11,0,22),(6,NULL,'2016-04-09 00:00:00',0,1,NULL),(7,NULL,'2016-04-09 00:00:00',0,1,NULL),(8,NULL,'2016-04-09 00:00:00',0,1,NULL),(9,NULL,'2016-04-09 00:00:00',0,1,NULL),(10,NULL,'2016-04-09 00:00:00',0,1,NULL),(11,6,'2016-04-09 00:00:00',5,0,22),(12,6,'2016-04-09 00:00:00',4,0,22),(13,6,'2016-04-15 00:00:00',22,1,22),(14,6,'2016-04-10 00:00:00',2,0,22),(15,6,'2016-04-12 00:00:00',3,0,22),(16,6,'2016-04-10 00:00:00',4,0,22),(17,6,'2016-04-10 00:00:00',5,0,22),(28,7,'2016-04-19 00:00:00',9,1,4),(31,6,'2016-04-19 00:00:00',3,0,22),(34,6,'2016-04-05 00:00:00',1,0,3),(35,6,'2016-04-20 00:00:00',3,1,3);
/*!40000 ALTER TABLE `manager_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_contact`
--

DROP TABLE IF EXISTS `office_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_contact` (
  `pid` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_contact`
--

LOCK TABLES `office_contact` WRITE;
/*!40000 ALTER TABLE `office_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `gid` int(11) DEFAULT '0',
  `title` varchar(45) DEFAULT NULL,
  `main` int(11) DEFAULT '0',
  `page_id` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'manager',103,'Мед. представитель',1,'1'),(3,'call',102,'Call-центр',0,'3'),(4,'doctor',103,'Врач',0,'2'),(5,'manager',102,'Мед. представитель',1,'1'),(6,'doctor',102,'Врач',0,'2'),(7,'patient',102,'Пациент',0,'4'),(8,'payment',102,'Напоминания',0,'5'),(9,'report',102,'Отчеты',0,'6'),(10,'admin',100,'Админ',1,'7'),(11,'patient',103,'Пациент',0,'4'),(12,'call',105,'Call-центр',1,'3'),(13,'patient',105,'Пациент',0,'4'),(14,'payment',105,'Напоминания',0,'5');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `doctor` int(11) DEFAULT '0',
  `diagnosis` text,
  `status` int(11) DEFAULT '0' COMMENT ' /* comment truncated */ /*0 - введенный call-центром\\n1 - направленный\\n2 - позвонивши\\n3 - пришедший\\n4 - отказ\\n*/',
  `dt_plan` datetime DEFAULT NULL,
  `dt_consultion` datetime DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  `comment` text,
  `mo_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (8,'Первый пациент',25,' ',2,'2016-04-09 00:00:00',NULL,1,' ',NULL),(9,'Второй пациент',26,'  diagnos',2,'2016-04-09 00:00:00',NULL,1,'commen',NULL),(10,'віп паціент',27,'какой-то диагноз   2',1,'2016-04-25 00:00:00',NULL,1,'   ','0'),(12,'новый пациент',27,' ',0,'2016-04-25 00:00:00',NULL,1,' ком новый пациент ','12345'),(13,'patient new',26,'   ',2,'2016-04-12 00:00:00',NULL,1,' qaz   ','43407'),(14,'третий пациент',25,'  ',2,'2016-04-19 00:00:00','2016-01-10 00:00:00',1,'  ','53760'),(15,'dhffbfgg',25,' ffffff',1,'2016-04-17 00:00:00',NULL,1,' ',NULL),(16,'Новый Больной',28,'  ',1,'2016-04-20 00:00:00','2016-01-30 00:00:00',1,'  ','54184'),(17,'неизвестный',28,NULL,1,'2016-04-25 00:00:00',NULL,1,' ',NULL),(18,'222',28,' ',0,'2016-04-25 00:00:00',NULL,1,' ',NULL);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_contact`
--

DROP TABLE IF EXISTS `patient_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_contact` (
  `pid` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_contact`
--

LOCK TABLES `patient_contact` WRITE;
/*!40000 ALTER TABLE `patient_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  `tp` int(11) DEFAULT '0',
  `patient` int(11) DEFAULT NULL,
  `mo_id` int(11) DEFAULT NULL,
  `sum` float DEFAULT '0',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (118,'2016-04-12 00:00:00',0,NULL,43407,1994.85,NULL),(119,'2016-01-14 00:00:00',0,NULL,43407,1994,NULL),(123,'2016-01-10 00:00:00',0,14,53760,1020,1),(124,'2016-01-30 00:00:00',0,16,54184,3750,0);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `tp` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,'067 5027945',1,1),(2,'044 2492233',3,1),(3,'044 555 55 55',2,1),(4,'555',2,1),(5,'22',1,1),(6,'3333',2,1),(7,'444444',3,1),(8,'067345 667 7',1,1),(9,'34-69',2,1),(10,'044 454 466',3,1),(11,'069 123',1,1),(12,'097 88 99',1,1),(13,'09789123',1,1),(14,'055 4445 55',1,1),(15,'067 000 00 ',2,1),(16,'044 4343',3,1),(17,'067 111 00 ',2,1),(18,'044 44 44 44 44',2,1),(19,'0444',1,1),(20,'050123',1,1),(21,'044123',2,1),(22,'224435',4,1),(23,'3',1,1),(24,'044',1,1),(25,'044234',1,1),(26,'05050500505',1,1),(27,'067',1,1),(28,'044',3,1),(29,'044222',2,1),(30,'22222',2,1),(31,'067 23',1,1),(32,'050 123',1,1),(33,'22-61',2,1),(34,'067123',1,1),(35,'22061',2,1),(36,'044460',3,1),(37,'044000',3,1),(38,'043555',3,1),(39,'22223333',4,1),(40,'44-31',2,1),(41,'067 44443',1,1),(42,'067 234',1,1),(43,'044123',3,1),(44,'067 4444',1,1),(45,'044 444',3,1),(46,'0671239',1,1),(47,'044505',2,1),(48,'0672223',1,1),(49,'0671222',1,1),(50,'044555',2,1),(51,'2222',3,1),(52,'0444',3,1),(53,'2222',2,1),(54,'7777',4,1),(55,'44444',4,1),(56,'067 123',1,1),(57,'044 123',2,1),(58,'067 321 22 45',1,1),(59,'044 2223112',1,1),(60,'044 444 3550',2,1),(61,'067554433',1,1),(62,'044 334422',3,1),(63,'06755555',1,1),(64,'067555',1,1),(65,'044233',3,1);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refresh`
--

DROP TABLE IF EXISTS `refresh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refresh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `tm` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refresh`
--

LOCK TABLES `refresh` WRITE;
/*!40000 ALTER TABLE `refresh` DISABLE KEYS */;
INSERT INTO `refresh` VALUES (1,'call','2016-03-18 23:08:52'),(2,'call','2016-03-18 23:45:09'),(3,'call','2016-03-19 00:28:09'),(4,'call','2016-03-19 00:35:16'),(5,'call','2016-03-19 00:38:49'),(6,'call','2016-03-19 00:40:23'),(7,'call','2016-03-19 00:41:31'),(8,'call','2016-03-19 00:46:42'),(9,'call','2016-03-19 00:54:28'),(10,'call','2016-03-19 00:56:26'),(11,'call','2016-03-19 00:57:03'),(12,'call','2016-03-19 00:57:58'),(13,'call','2016-03-19 00:58:53'),(14,'call','2016-03-19 01:01:21'),(15,'call','2016-04-05 12:25:51'),(16,'call','2016-04-12 00:12:20'),(17,'call','2016-04-12 14:02:40'),(18,'call','2016-04-12 14:24:30'),(19,'call','2016-04-12 20:42:40'),(20,'call','2016-04-12 21:06:00'),(21,'call','2016-04-13 12:33:40'),(22,'call','2016-04-13 12:37:20'),(23,'call','2016-04-13 12:37:41'),(24,'call','2016-04-13 12:38:00'),(25,'call','2016-04-13 12:40:20'),(26,'call','2016-04-16 21:07:00'),(27,'call','2016-04-17 02:29:20'),(28,'call','2016-04-17 02:33:40'),(29,'call','2016-04-18 00:51:50'),(30,'call','2016-04-18 01:40:30'),(31,'call','2016-04-18 01:43:00'),(32,'call','2016-04-18 01:48:20'),(33,'call','2016-04-19 00:16:00'),(34,'call','2016-04-19 00:17:40'),(35,'call','2016-04-20 16:13:22');
/*!40000 ALTER TABLE `refresh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (31,'Киев',1),(32,'Донецкая обл.',1),(33,'Днепропетровская обл.',1),(34,'Харьковская обл.',1),(35,'Киевская обл.',1),(36,'Одесская обл.',1),(37,'Львовская обл.',1),(38,'Луганская обл.',1),(39,'Полтавская обл.',1),(40,'Запорожская обл.',1),(41,'Крым',1),(42,'Винницкая обл.',1),(43,'Ивано-Франковская обл.',1),(44,'Черкасская обл.',1),(45,'Николаевская обл.',1),(46,'Хмельницкая обл.',1),(47,'Сумская обл.',1),(48,'Житомирская обл.',1),(49,'Черниговская обл.',1),(50,'Кировоградская обл.',1),(51,'Ровненская обл.',1),(52,'Закарпатская обл.',1),(53,'Волынская обл.',1),(54,'Херсонская обл.',1),(55,'Тернопольская обл.',1),(56,'Черновицкая обл.',1);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_call`
--

DROP TABLE IF EXISTS `reminder_call`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL,
  `comment` text,
  `name` varchar(255) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_call`
--

LOCK TABLES `reminder_call` WRITE;
/*!40000 ALTER TABLE `reminder_call` DISABLE KEYS */;
INSERT INTO `reminder_call` VALUES (1,'232',' dsrgeg','ffffff','2016-03-17 00:00:00',0,NULL),(2,'34325',' dsfvds  ','asadsAA','2016-03-13 00:00:00',1,NULL),(3,'22222',' ','qqqqq','2016-03-10 00:00:00',0,NULL),(4,'4444asd','dsvas','sssssss','2016-04-05 00:00:00',1,NULL),(5,'33333',' dfvdsvsdfsdbsdf','dsdcaller','2016-04-10 00:00:00',0,NULL),(6,'',' cscsdca','ddd','2016-04-13 00:00:00',0,NULL),(7,'334455',' sdfsdfdffdv davd fvd vdfv\ndfv\ndfv','pomni menya','2016-04-19 00:00:00',1,NULL),(8,'123',' ','abc','2016-04-20 00:00:00',1,NULL),(9,'www',' ee','sdc','2016-04-20 00:00:00',1,NULL),(10,'112212111',' sadcs','call','2016-04-08 00:00:00',0,NULL),(11,'99999',' ','99999','2016-04-20 00:00:00',0,NULL),(12,'111',' 111','VIP','2016-04-20 00:00:00',0,NULL),(13,'',' ','call own','2016-04-20 00:00:00',0,10),(14,'',' ','vip own','2016-04-20 00:00:00',0,3);
/*!40000 ALTER TABLE `reminder_call` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special`
--

DROP TABLE IF EXISTS `special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special`
--

LOCK TABLES `special` WRITE;
/*!40000 ALTER TABLE `special` DISABLE KEYS */;
INSERT INTO `special` VALUES (1,'хирург',1),(2,'анастезиолог',1),(3,'гинеколог',1),(4,'математик',0);
/*!40000 ALTER TABLE `special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `table` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `color` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('payment',0,'#ff531a'),('payment',1,'#204060'),('calls',0,'#ff531a'),('calls',1,'#204060'),('manager',0,'#ff531a'),('manager',1,'#204060');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabs`
--

DROP TABLE IF EXISTS `tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT 'tab id',
  `title` varchar(45) DEFAULT NULL COMMENT 'tab name',
  `div` varchar(45) DEFAULT NULL COMMENT 'tab href/div',
  `gid` int(11) DEFAULT '0',
  `page_id` int(11) DEFAULT '0',
  `tbl` varchar(255) DEFAULT NULL,
  `toolbar` varchar(255) DEFAULT NULL,
  `ind` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabs`
--

LOCK TABLES `tabs` WRITE;
/*!40000 ALTER TABLE `tabs` DISABLE KEYS */;
INSERT INTO `tabs` VALUES (1,'visit_tab','Ежедневный отчет','div_visit_tab',103,1,'tables/visit.tpl','toolbar/visit.tpl',0),(2,'manager_tab','Медицинские представители','div_manager_tab',102,1,'tables/manager.tpl','toolbar/manager.tpl',1),(6,'visit_tab','Ежедневный отчет','div_visit_tab',102,1,'tables/visit.tpl','toolbar/visit.tpl',0),(7,'doctor','Статусные','div_status_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(8,'doctor','Активные','div_active_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(9,'doctor','Отказ','div_cancel_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(10,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(11,'patient','Направленный','div_directed_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',0),(12,'patient','Позвонивший','div_ring_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',1),(13,'patient','Пришедший','div_came_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',2),(14,'patient','Отказ','div_cancel_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',3),(15,'call','Call-центр','div_call_tab',102,3,'tables/call.tpl','toolbar/call.tpl',0),(16,'payment','Ежедневные начисления','div_payment_tab',102,5,'tables/payment.tpl','toolbar/payment.tpl',0),(17,'reminder','Звонки','div_reminder_tab',102,5,'tables/reminder.tpl','toolbar/reminder.tpl',1),(18,'repmanager','Отчет по Мед. представителям','div_repmanager_tab',102,6,'tables/repmanager.tpl','toolbar/repmanager.tpl',0),(20,'repdoctor','Отчет по Врачам','div_repdoctor_tab',102,6,'tables/repdoctor.tpl','toolbar/repdoctor.tpl',1),(21,'admin_tab','Админ','div_admin_tab',100,7,'tables/admin.tpl','toolbar/admin.tpl',0),(22,'doctor','Активные','div_active_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(23,'doctor','Отказ','div_cancel_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(24,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(25,'doctor','Статусные','div_status_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(26,'patient','Направленный','div_directed_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',0),(27,'call','Call-центр','div_call_tab',105,3,'tables/call.tpl','toolbar/call.tpl',0),(28,'patient','Направленный','div_directed_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',0),(29,'patient','Позвонивший','div_ring_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',1),(30,'patient','Позвонивший','div_ring_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',1),(31,'patient','Пришедший','div_came_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',2),(32,'patient','Отказ','div_cancel_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',3),(33,'reminder','Звонки','div_reminder_tab',105,5,'tables/reminder.tpl','toolbar/reminder.tpl',0),(34,'reppatient','Отчет по пациентам','div_reppatient_tab',102,6,'tables/reppatient.tpl','toolbar/reppatient.tpl',2);
/*!40000 ALTER TABLE `tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(64) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Александр Владимиров Владимирович','a.vladimir',103,1),(3,'Марина Петрашкова','marina',103,1),(4,'Новости Gt','newus',106,1),(5,'Чапа Боксер','chapa2',101,1),(6,'Собака Сявка','savann',106,1),(7,'NBX','nesd',101,1),(10,'asb-9','asb-9',105,1),(11,'Новый менеджер','newman',103,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit`
--

DROP TABLE IF EXISTS `visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  `doctor` int(11) DEFAULT '0',
  `clinic` int(11) DEFAULT '0',
  `expens` int(11) DEFAULT '0',
  `comment` text,
  `status` int(11) DEFAULT '0' COMMENT ' /* comment truncated */ /*0 -  введенно менеджером\n1 -  подтверждено руководителем*/',
  `dt_plan` datetime DEFAULT NULL,
  `manager` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit`
--

LOCK TABLES `visit` WRITE;
/*!40000 ALTER TABLE `visit` DISABLE KEYS */;
INSERT INTO `visit` VALUES (14,'2016-04-09 00:00:00',25,4,50,'  попили кофе',0,'2021-04-20 00:00:00',6,1),(15,'2016-04-09 00:00:00',26,1,100,' попили кофе',0,'2026-04-20 16:00:00',6,1),(16,'2016-04-04 00:00:00',0,0,10,' ',0,'2027-04-20 16:00:00',6,1),(18,'2016-04-09 00:00:00',26,2,0,'  ',0,'2016-04-09 00:00:00',6,1),(34,'2016-04-09 00:00:00',26,7,0,'  ',0,NULL,6,1),(42,'2016-04-10 00:00:00',0,0,0,' ',1,NULL,6,1),(43,'2016-04-10 00:00:00',0,0,0,'  ',1,NULL,6,1),(44,'2016-04-10 00:00:00',0,0,0,' ',1,NULL,6,1),(45,'2016-04-10 00:00:00',0,0,0,' ',1,NULL,6,1),(46,'2016-04-10 00:00:00',26,2,0,' ',1,NULL,6,1),(47,'2016-04-19 00:00:00',26,4,0,' ',0,NULL,7,1),(48,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(51,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(52,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(53,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(54,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(55,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(56,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(57,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,7,1),(58,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,6,1),(59,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,6,1),(60,'2016-04-19 00:00:00',0,0,0,' ',0,NULL,6,1),(61,'2016-04-20 00:00:00',28,4,100,' gfgnmh,j',0,NULL,6,1),(62,'2016-04-20 00:00:00',28,0,0,' ',0,NULL,6,1),(63,'2016-04-05 00:00:00',26,7,0,' hfjgk',0,NULL,6,1),(64,'2016-04-20 00:00:00',0,0,0,' ',0,NULL,6,1);
/*!40000 ALTER TABLE `visit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 23:58:24
