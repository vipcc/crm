USE `callcenter` ;
CREATE  TABLE IF NOT EXISTS `callcenter`.`calls` (
  `callerCID` varchar(20) default NULL,
  `toCID` varchar(50) default NULL,
  `event` varchar(50) default NULL,
  `call_date` datetime default NULL,
  `duration` varchar(20) default NULL,
  `ID` int(11) NOT NULL auto_increment,
  `filename` varchar(256) default NULL,
  `call_id` varchar(100) default NULL,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

