SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `lisod` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `lisod` ;

-- -----------------------------------------------------
-- Table `lisod`.`manager`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`manager` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `plan` INT NULL DEFAULT 0 ,
  `reion` INT NULL DEFAULT 0 ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`doctor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`doctor` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `status` INT NULL DEFAULT 0 COMMENT ' /* comment truncated */ /*0 - активный
1 - статусный
2 - отказ
3 - не сотрудничает*/' ,
  `bithday` INT NULL DEFAULT 0 ,
  `card` VARCHAR(16) NULL ,
  `special` INT NULL ,
  `address` VARCHAR(255) NULL ,
  `percent` INT NULL DEFAULT 0 ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`patient`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`patient` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `doctor` INT NULL DEFAULT 0 ,
  `diagnosis` TEXT NULL ,
  `comment` TEXT NULL ,
  `status` INT NULL DEFAULT 0 COMMENT ' /* comment truncated */ /*0 - введенный call-центром
1 - направленный
2 - позвонивши
3 - пришедший
4 - отказ
*/' ,
  `dt_plan` DATETIME NULL ,
  `dt_consultion` DATETIME NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`phone`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`phone` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `tp` INT NULL DEFAULT 0 ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`email`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`email` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`birthday`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`birthday` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dt` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`clinic`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`clinic` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `city` INT NULL DEFAULT 0 ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`region`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`city`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `region` INT NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`special`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`special` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `state` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`manager_contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`manager_contact` (
  `pid` INT NULL ,
  `contact_id` INT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`doctor_contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`doctor_contact` (
  `pid` INT NULL ,
  `contact_id` INT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`patient_contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`patient_contact` (
  `pid` INT NULL ,
  `contact_id` INT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`office_contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`office_contact` (
  `pid` INT NULL ,
  `contact_id` INT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`call`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`call` (
  `id` INT NOT NULL AUTO_INCREMENT ,

  `name` varchar(256) default NULL ,
  `patient` INT NULL DEFAULT 0 ,
  `manager` INT NULL DEFAULT 0 ,


  `callerCID` varchar(20) default NULL COMMENT 'CID позвонившего',
  `toCID` varchar(50) default NULL COMMENT 'линия на которую позвонили. Для VIP контакт-центра 2020300',
  `event` varchar(50) default NULL COMMENT 'тип звонка. Сейчас два значения ”Входящий”, “Разговор”',
  `call_date` datetime default NULL COMMENT 'дата и время звонка',
  `pid` int(11) NOT NULL COMMENT 'уникальный идентификатор',
  `filename` varchar(256) default NULL COMMENT 'имя файла записи разговора'





  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`visit`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`visit` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dt` DATETIME NULL ,
  `doctor` INT NULL ,
  `clinic` INT NULL DEFAULT 0 ,
  `expens` INT NULL DEFAULT 0 ,
  `comment` TEXT NULL ,
  `status` INT NULL DEFAULT 0 COMMENT ' /* comment truncated */ /*0 -  введенно менеджером
1 -  подтверждено руководителем*/' ,
  `dt_plan` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `lisod`.`payment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`payment` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `doctor` INT NULL ,
  `patient` INT NULL ,
  `dt_consultion` DATETIME NULL ,
  `sum` DOUBLE NULL DEFAULT 0.0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB

-- -----------------------------------------------------
-- Table `lisod`.`reminder_manager`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`reminder_manager` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dt` DATETIME NULL ,
  `doctor` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`reminder_project`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`reminder_project` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tp` VARCHAR(45) NULL COMMENT ' /* comment truncated */ /*0 - ежедневные отчисления
1 - звонок*/' ,
  `doctor` INT NULL ,
  `sum` INT NULL DEFAULT 0 ,
  `dt` DATETIME NULL DEFAULT '2000-01-01' ,
  `fio` VARCHAR(255) NULL ,
  `phone` VARCHAR(45) NULL ,
  `notes` VARCHAR(1024) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lisod`.`reminder_call`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`reminder_call` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `phone` VARCHAR(255) NULL ,
  `comment` TEXT NULL ,
  `name` VARCHAR(255) NULL ,
  `dt` DATETIME NULL ,
  `status` INT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
-- -----------------------------------------------------
-- Table `lisod`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `lisod`.`pages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `title` VARCHAR(45) NULL ,
  `gid` INT NULL DEFAULT 0,
  `main` INT NULL DEFAULT 0,
  `page_id` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `lisod`.`tabs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `lisod`.`tabs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `gid` INT NULL DEFAULT 0 ,
  `page_id` INT NULL DEFAULT 0,
  `name` VARCHAR(45) NULL COMMENT 'tab id' ,
  `title` VARCHAR(45) NULL COMMENT 'tab name' ,
  `div` VARCHAR(45) NULL COMMENT 'tab href/div' ,
  `tbl` VARCHAR(255) NULL COMMENT 'tab table' ,
  `toolbar` VARCHAR(255) NULL COMMENT 'tab table' ,
  `ind` INT NULL DEFAULT 0 COMMENT 'tab index' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB


USE `lisod` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
