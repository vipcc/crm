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
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES ('crm_manager',103),('crm_operator',105),('crm_socio',106),('crm_project',102),('crm_boss',101),('crm_admin',100);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tabs`
--

LOCK TABLES `tabs` WRITE;
/*!40000 ALTER TABLE `tabs` DISABLE KEYS */;
INSERT INTO `tabs` VALUES (1,'visit_tab','Ежедневный отчет','div_visit_tab',103,1,'tables/visit.tpl','toolbar/visit.tpl',0),(2,'manager_tab','Медицинские представители','div_manager_tab',102,1,'tables/manager.tpl','toolbar/manager.tpl',1),(6,'visit_tab','Ежедневный отчет','div_visit_tab',102,1,'tables/visit.tpl','toolbar/visit.tpl',0),(7,'doctor','Статусные','div_status_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(8,'doctor','Активные','div_active_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(9,'doctor','Отказ','div_cancel_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(10,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(11,'patient','Направленный','div_directed_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',0),(12,'patient','Позвонивший','div_ring_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',1),(13,'patient','Пришедший','div_came_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',2),(14,'patient','Отказ','div_cancel_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',3),(15,'call','Call-центр','div_call_tab',102,3,'tables/call.tpl','toolbar/call.tpl',0),(16,'payment','Ежедневные начисления','div_payment_tab',102,5,'tables/payment.tpl','toolbar/payment.tpl',0),(17,'reminder','Звонки','div_reminder_tab',102,5,'tables/reminder.tpl','toolbar/reminder.tpl',1),(18,'repmanager','Отчет по Мед. представителям','div_repmanager_tab',102,6,'tables/repmanager.tpl','toolbar/repmanager.tpl',0),(20,'repdoctor','Отчет по Врачам','div_repdoctor_tab',102,6,'tables/repdoctor.tpl','toolbar/repdoctor.tpl',1),(21,'admin_tab','Админ','div_admin_tab',100,7,'tables/admin.tpl','toolbar/admin.tpl',0),(22,'doctor','Активные','div_active_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(23,'doctor','Отказ','div_cancel_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(24,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(25,'doctor','Статусные','div_status_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(26,'patient','Направленный','div_directed_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',0),(27,'call','Call-центр','div_call_tab',105,3,'tables/call.tpl','toolbar/call.tpl',0),(28,'patient','Направленный','div_directed_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',0),(29,'patient','Позвонивший','div_ring_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',1),(30,'patient','Позвонивший','div_ring_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',1),(31,'patient','Пришедший','div_came_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',2),(32,'patient','Отказ','div_cancel_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',3),(33,'reminder','Звонки','div_reminder_tab',105,5,'tables/reminder.tpl','toolbar/reminder.tpl',0),(34,'reppatient','Отчет по пациентам','div_reppatient_tab',102,6,'tables/reppatient.tpl','toolbar/reppatient.tpl',2);
/*!40000 ALTER TABLE `tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'manager',103,'Мед. представитель',1,'1'),(3,'call',102,'Call-центр',0,'3'),(4,'doctor',103,'Врач',0,'2'),(5,'manager',102,'Мед. представитель',1,'1'),(6,'doctor',102,'Врач',0,'2'),(7,'patient',102,'Пациент',0,'4'),(8,'payment',102,'Напоминания',0,'5'),(9,'report',102,'Отчеты',0,'6'),(10,'admin',100,'Админ',1,'7'),(11,'patient',103,'Пациент',0,'4'),(12,'call',105,'Call-центр',1,'3'),(13,'patient',105,'Пациент',0,'4'),(14,'payment',105,'Напоминания',0,'5');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `acl`
--

LOCK TABLES `acl` WRITE;
/*!40000 ALTER TABLE `acl` DISABLE KEYS */;
INSERT INTO `acl` VALUES (1,102,0,0,0,1,0,0,0,1),(2,102,0,0,1,1,1,1,1,1),(3,102,0,1,0,1,0,0,0,0),(4,102,0,1,1,1,1,1,1,0),(5,103,0,0,0,1,0,0,0,0),(6,103,0,0,1,1,1,1,0,0),(7,103,1,0,0,1,0,0,0,0),(8,103,1,1,0,1,0,0,0,0),(9,103,1,0,1,1,1,1,0,0),(10,103,1,1,1,1,1,1,0,0),(11,103,1,2,0,1,0,0,0,0),(12,103,1,2,1,1,1,1,0,0),(13,103,1,3,0,1,0,0,0,0),(14,103,1,3,1,1,1,1,0,0),(15,103,3,0,0,1,0,0,0,0),(16,103,3,0,1,1,1,1,0,0),(17,103,3,1,0,0,0,0,0,0),(18,103,3,1,1,0,0,0,0,0),(19,102,1,0,0,1,0,0,0,0),(20,102,1,0,1,1,1,1,0,0),(21,102,1,1,0,1,0,0,0,0),(22,102,1,1,1,1,1,1,0,0),(23,102,1,2,0,1,0,0,0,0),(24,102,1,2,1,1,1,1,0,0),(25,102,1,3,0,1,0,0,0,0),(26,102,1,3,1,1,1,1,0,0),(27,102,3,0,0,1,0,0,0,0),(28,102,3,0,1,1,1,1,0,0),(29,102,3,1,0,1,0,0,0,0),(30,102,3,1,1,1,1,1,0,0),(31,102,3,2,0,1,0,0,0,0),(32,102,3,2,1,1,1,1,0,0),(33,102,3,3,0,1,0,0,0,0),(34,102,3,3,1,1,1,1,0,0),(35,105,3,1,1,0,1,0,0,0),(36,102,4,0,1,0,0,0,1,0),(37,102,4,1,0,1,0,0,0,0),(38,102,4,1,1,1,1,1,1,0),(39,105,4,0,0,1,0,0,0,0),(40,105,4,0,1,1,1,1,1,0);
/*!40000 ALTER TABLE `acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (31,'Киев',1),(32,'Донецкая обл.',1),(33,'Днепропетровская обл.',1),(34,'Харьковская обл.',1),(35,'Киевская обл.',1),(36,'Одесская обл.',1),(37,'Львовская обл.',1),(38,'Луганская обл.',1),(39,'Полтавская обл.',1),(40,'Запорожская обл.',1),(41,'Крым',1),(42,'Винницкая обл.',1),(43,'Ивано-Франковская обл.',1),(44,'Черкасская обл.',1),(45,'Николаевская обл.',1),(46,'Хмельницкая обл.',1),(47,'Сумская обл.',1),(48,'Житомирская обл.',1),(49,'Черниговская обл.',1),(50,'Кировоградская обл.',1),(51,'Ровненская обл.',1),(52,'Закарпатская обл.',1),(53,'Волынская обл.',1),(54,'Херсонская обл.',1),(55,'Тернопольская обл.',1),(56,'Черновицкая обл.',1);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('payment',0,'#ff531a'),('payment',1,'#204060'),('calls',0,'#ff531a'),('calls',1,'#204060'),('manager',0,'#ff531a'),('manager',1,'#204060');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 23:58:16
