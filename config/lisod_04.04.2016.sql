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
  `manager` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (3,'Валентин Романович','Петров Петр петрович',12,'0674026850','2020300','Входящий','2016-03-19 00:04:00',2,'test.wav',NULL,NULL,1,' ввв'),(4,'dfeeeeeee','xsvdvdvdf',12,'0674026850','2020300','Входящий','2016-03-19 00:04:00',2,'test.wav',NULL,NULL,1,' ввв');
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
INSERT INTO `clinic` VALUES (1,'Lisod',1,1),(2,'Esida',2,1),(3,'assss123',1,0),(4,'Клиника',1,1),(5,'якорь',1,1),(6,'bavпробел',2,0),(7,'Новая запись',1,1),(8,'Клиника2',1,0),(9,'newnewnenw',1,0),(10,'gggg',2,0),(11,'assss123',2,1);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (2,'name',0,0,'card',1,'email',10,1,0,'       ',NULL),(4,'sdcsd',0,0,'1234',0,'a@b',10,0,0,NULL,NULL),(8,'asass',2,0,'123455',2,'aaa',20,1,1,'     ',NULL),(10,'asefsf',0,0,'ddd',0,'sss',20,0,0,NULL,NULL),(11,'Дядя доктор',0,0,'1223',1,'фффф',40,1,2,'    ',NULL),(12,'Тетя Люда',0,0,'12345',2,' a@ukr.net',30,1,2,NULL,NULL),(13,'Юрий Байда',1,0,'1231qaz',1,'dd@com',25,1,1,' ',NULL),(14,'123',0,0,'',0,'',1,1,0,' ',NULL),(15,'sdcsaca',0,0,'',0,'',22,1,0,'   Привет\nкак ваши дела ?  ',NULL),(16,NULL,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL),(17,NULL,NULL,0,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL),(18,'Айболит',0,0,'',2,'',4,1,2,' ',NULL),(19,'aaa',0,0,'',0,'',3,0,0,' ',NULL),(20,'Jqseek',0,0,'',2,'',1,1,0,'         ',NULL),(21,'dfgdsfgdsgsd',0,0,'',2,'',1,1,1,' ',NULL),(22,'doctor',0,0,'',0,'',1,1,0,' ',NULL);
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
INSERT INTO `doctor_contact` VALUES (12,20),(12,21),(12,22),(11,39),(NULL,40);
/*!40000 ALTER TABLE `doctor_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (22,1,'a@bbbb.c',1,1,6),(4,2,'',3,1,7);
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
INSERT INTO `manager_contact` VALUES (6,49),(6,50),(6,51),(7,52);
/*!40000 ALTER TABLE `manager_contact` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'manager',103,'Мед. представитель',1,'1'),(2,'doctor',1,'Врач',0,'2'),(3,'call',102,'Call-центр',0,'3'),(4,'doctor',103,'Врач',0,'2'),(5,'manager',102,'Мед. представитель',1,'1'),(6,'doctor',102,'Врач',0,'2'),(7,'patient',102,'Пациент',0,'4'),(8,'payment',102,'Напоминания',0,'5'),(9,'report',102,'Отчеты',0,'6'),(10,'admin',100,'Админ',1,'7');
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
  `status` int(11) DEFAULT '0' COMMENT ' /* comment truncated */ /*0 - введенный call-центром\n1 - направленный\n2 - позвонивши\n3 - пришедший\n4 - отказ\n*/',
  `dt_plan` datetime DEFAULT NULL,
  `dt_consultion` datetime DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  `comment` text,
  `mo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'fffff',50,' ',0,'2016-03-15 00:00:00','2016-03-11 00:00:00',1,' ',NULL),(2,'sdfsda',71,' ',0,'2016-03-11 00:00:00','2016-03-24 00:00:00',0,' ',NULL),(3,'три-три',32,' ',0,'2016-03-11 00:00:00',NULL,1,' ',NULL),(4,'qqqwwqw654',0,'  ',0,'2016-03-11 00:00:00','2016-03-31 00:00:00',1,'  ',NULL),(5,'Петров Петр петрович',12,'  ',0,'2016-03-12 00:00:00','2016-03-12 00:00:00',1,'  ',NULL),(6,'Первый Пациент',18,'      ',0,'2016-03-12 00:00:00','2016-03-12 00:00:00',1,'      ',NULL),(7,'sdcsadsa',22,' ',0,'2016-04-04 00:00:00','2016-04-22 00:00:00',1,' ',NULL);
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
  `doctor` int(11) DEFAULT NULL,
  `patient` int(11) DEFAULT NULL,
  `dt_consultion` datetime DEFAULT NULL,
  `sum` double DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,12,5,NULL,450,1,1),(2,18,6,NULL,300,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,'067 5027945',1,1),(2,'044 2492233',3,1),(3,'044 555 55 55',2,1),(4,'555',2,1),(5,'22',1,1),(6,'3333',2,1),(7,'444444',3,1),(8,'067345 667 7',1,1),(9,'34-69',2,1),(10,'044 454 466',3,1),(11,'069 123',1,1),(12,'097 88 99',1,1),(13,'09789123',1,1),(14,'055 4445 55',1,1),(15,'067 000 00 ',2,1),(16,'044 4343',3,1),(17,'067 111 00 ',2,1),(18,'044 44 44 44 44',2,1),(19,'0444',1,1),(20,'050123',1,1),(21,'044123',2,1),(22,'224435',4,1),(23,'3',1,1),(24,'044',1,1),(25,'044234',1,1),(26,'05050500505',1,1),(27,'067',1,1),(28,'044',3,1),(29,'044222',2,1),(30,'22222',2,1),(31,'067 23',1,1),(32,'050 123',1,1),(33,'22-61',2,1),(34,'067123',1,1),(35,'22061',2,1),(36,'044460',3,1),(37,'044000',3,1),(38,'043555',3,1),(39,'22223333',4,1),(40,'44-31',2,1),(41,'067 44443',1,1),(42,'067 234',1,1),(43,'044123',3,1),(44,'067 4444',1,1),(45,'044 444',3,1),(46,'0671239',1,1),(47,'044505',2,1),(48,'0672223',1,1),(49,'0671222',1,1),(50,'044555',2,1),(51,'2222',3,1),(52,'0444',3,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refresh`
--

LOCK TABLES `refresh` WRITE;
/*!40000 ALTER TABLE `refresh` DISABLE KEYS */;
INSERT INTO `refresh` VALUES (1,'call','2016-03-18 23:08:52'),(2,'call','2016-03-18 23:45:09'),(3,'call','2016-03-19 00:28:09'),(4,'call','2016-03-19 00:35:16'),(5,'call','2016-03-19 00:38:49'),(6,'call','2016-03-19 00:40:23'),(7,'call','2016-03-19 00:41:31'),(8,'call','2016-03-19 00:46:42'),(9,'call','2016-03-19 00:54:28'),(10,'call','2016-03-19 00:56:26'),(11,'call','2016-03-19 00:57:03'),(12,'call','2016-03-19 00:57:58'),(13,'call','2016-03-19 00:58:53'),(14,'call','2016-03-19 01:01:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'Киев',1),(2,'Одесса',1);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_call`
--

LOCK TABLES `reminder_call` WRITE;
/*!40000 ALTER TABLE `reminder_call` DISABLE KEYS */;
INSERT INTO `reminder_call` VALUES (1,'232',' dsrgeg','ffffff','2016-03-17 00:00:00',0),(2,'34325',' dsfvds  ','asadsAA','2016-03-13 00:00:00',1),(3,'22222',' ','qqqqq','2016-03-10 00:00:00',0),(4,'4444asd','dsvas','sssssss','2016-04-05 00:00:00',1);
/*!40000 ALTER TABLE `reminder_call` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_manager`
--

DROP TABLE IF EXISTS `reminder_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  `doctor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_manager`
--

LOCK TABLES `reminder_manager` WRITE;
/*!40000 ALTER TABLE `reminder_manager` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminder_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder_project`
--

DROP TABLE IF EXISTS `reminder_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tp` varchar(45) DEFAULT NULL COMMENT ' /* comment truncated */ /*0 - ежедневные отчисления\n1 - звонок*/',
  `doctor` int(11) DEFAULT NULL,
  `sum` int(11) DEFAULT '0',
  `dt` datetime DEFAULT '2000-01-01 00:00:00',
  `fio` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `notes` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder_project`
--

LOCK TABLES `reminder_project` WRITE;
/*!40000 ALTER TABLE `reminder_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminder_project` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special`
--

LOCK TABLES `special` WRITE;
/*!40000 ALTER TABLE `special` DISABLE KEYS */;
INSERT INTO `special` VALUES (1,'хирург',1),(2,'анастезиолог',1);
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
INSERT INTO `status` VALUES ('payment',0,'#ff531a'),('payment',1,'#204060'),('calls',0,'#ff531a'),('calls',1,'#204060');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabs`
--

LOCK TABLES `tabs` WRITE;
/*!40000 ALTER TABLE `tabs` DISABLE KEYS */;
INSERT INTO `tabs` VALUES (1,'visit_tab','Ежедневный отчет','div_visit_tab',103,1,'tables/visit.tpl','toolbar/visit.tpl',0),(2,'manager_tab','Медицинские представители','div_manager_tab',102,1,'tables/manager.tpl','toolbar/manager.tpl',1),(3,'doctor_tab','Статусные','div_doctorS_tab',103,2,'tables/doctorS.tpl','toolbar/doctorS.tpl',1),(4,'doctor_tab','Активные2','div_doctorA_tab',103,2,'tables/doctorA.tpl','toolbar/doctorA.tpl',0),(6,'visit_tab','Ежедневный отчет','div_visit_tab',102,1,'tables/visit.tpl','toolbar/visit.tpl',0),(7,'doctor','Статусные','div_status_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(8,'doctor','Активные','div_active_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(9,'doctor','Отказ','div_cancel_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(10,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(11,'patient','Направленный','div_directed_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',0),(12,'patient','Позвонивший','div_ring_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',1),(13,'patient','Пришедший','div_came_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',2),(14,'patient','Отказ','div_cancel_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',3),(15,'call','Call-центр','div_call_tab',102,3,'tables/call.tpl','toolbar/call.tpl',0),(16,'payment','Ежедневные начисления','div_payment_tab',102,5,'tables/payment.tpl','toolbar/payment.tpl',0),(17,'reminder','Звонки','div_reminder_tab',102,5,'tables/reminder.tpl','toolbar/reminder.tpl',1),(18,'repmanager','Отчет по Мед. представителям','div_repmanager_tab',102,6,'tables/repmanager.tpl','toolbar/repmanager.tpl',0),(20,'repdoctor','Отчет по Врачам','div_repdoctor_tab',102,6,'tables/repdoctor.tpl','toolbar/repdoctor.tpl',1),(21,'admin_tab','Админ','div_admin_tab',100,7,'tables/admin.tpl','toolbar/admin.tpl',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Александр Владимиров Владимирович','a.vladimir',103,1),(3,'Марина Петрашкова','marina',103,1),(4,'Новости Gt','newus',106,1),(5,'Чапа Боксер','chapa2',101,1),(6,'Собака Сявка','savann',106,1),(7,'NBX','nesd',101,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit`
--

LOCK TABLES `visit` WRITE;
/*!40000 ALTER TABLE `visit` DISABLE KEYS */;
INSERT INTO `visit` VALUES (13,'2016-03-14 00:00:00',12,1,40,' ',0,'2030-03-20 16:00:00',75,1);
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

-- Dump completed on 2016-04-04 20:19:33
