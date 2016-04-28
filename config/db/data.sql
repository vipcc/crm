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
INSERT INTO `groups` VALUES ('G_CRM_MANAGER',103),('G_CRM_OPERATOR',105),('G_CRM_SOCIO',106),('G_CRM_PROJECT',102),('G_CRM_BOSS',101),('G_CRM_ADMIN',100);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tabs`
--

LOCK TABLES `tabs` WRITE;
/*!40000 ALTER TABLE `tabs` DISABLE KEYS */;
INSERT INTO `tabs` VALUES (1,'visit_tab','Ежедневный отчет','div_visit_tab',103,1,'tables/visit.tpl','toolbar/visit.tpl',0),(2,'manager_tab','Медицинские представители','div_manager_tab',102,1,'tables/manager.tpl','toolbar/manager.tpl',1),(6,'visit_tab','Ежедневный отчет','div_visit_tab',102,1,'tables/visit.tpl','toolbar/visit.tpl',0),(7,'doctor','Статусные','div_status_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(8,'doctor','Активные','div_active_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(9,'doctor','Отказ','div_cancel_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(10,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',102,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(11,'patient','Направленный','div_directed_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',0),(12,'patient','Позвонивший','div_ring_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',1),(13,'patient','Пришедший','div_came_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',2),(14,'patient','Отказ','div_cancel_patient_tab',102,4,'tables/patient.tpl','toolbar/patient.tpl',3),(15,'call','Call-центр','div_call_tab',102,3,'tables/call.tpl','toolbar/call.tpl',0),(16,'payment','Ежедневные начисления','div_payment_tab',102,5,'tables/payment.tpl','toolbar/payment.tpl',0),(17,'reminder','Звонки','div_reminder_tab',102,5,'tables/reminder.tpl','toolbar/reminder.tpl',1),(18,'repmanager','Отчет по Мед. представителям','div_repmanager_tab',102,6,'tables/repmanager.tpl','toolbar/repmanager.tpl',0),(20,'repdoctor','Отчет по Врачам','div_repdoctor_tab',102,6,'tables/repdoctor.tpl','toolbar/repdoctor.tpl',1),(21,'admin_tab','Админ','div_admin_tab',100,7,'tables/admin.tpl','toolbar/admin.tpl',0),(22,'doctor','Активные','div_active_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',0),(23,'doctor','Отказ','div_cancel_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',2),(24,'doctor','Не сотрудничают','div_dontcooperate_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',3),(25,'doctor','Статусные','div_status_doctor_tab',103,2,'tables/doctor.tpl','toolbar/doctor.tpl',1),(26,'patient','Направленный','div_directed_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',0),(27,'call','Call-центр','div_call_tab',105,3,'tables/call.tpl','toolbar/call.tpl',0),(28,'patient','Направленный','div_directed_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',0),(29,'patient','Позвонивший','div_ring_patient_tab',105,4,'tables/patient.tpl','toolbar/patient.tpl',1),(30,'patient','Позвонивший','div_ring_patient_tab',103,4,'tables/patient.tpl','toolbar/patient.tpl',1);
/*!40000 ALTER TABLE `tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'manager',103,'Мед. представитель',1,'1'),(3,'call',102,'Call-центр',0,'3'),(4,'doctor',103,'Врач',0,'2'),(5,'manager',102,'Мед. представитель',1,'1'),(6,'doctor',102,'Врач',0,'2'),(7,'patient',102,'Пациент',0,'4'),(8,'payment',102,'Напоминания',0,'5'),(9,'report',102,'Отчеты',0,'6'),(10,'admin',100,'Админ',1,'7'),(11,'patient',103,'Пациент',0,'4'),(12,'call',105,'Call-центр',1,'3'),(13,'patient',105,'Пациент',0,'4');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-13 13:01:49
