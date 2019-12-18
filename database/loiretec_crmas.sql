/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - loiretec_crmas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`loiretec_crmas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `loiretec_crmas`;

/*Table structure for table `creditsms` */

DROP TABLE IF EXISTS `creditsms`;

CREATE TABLE `creditsms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `total_sms_purchased` varchar(500) NOT NULL,
  `available_sms` varchar(500) NOT NULL,
  `used_sms` varchar(500) NOT NULL,
  `buy_sms_credit` varchar(500) NOT NULL,
  `store` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `creditsms` */

insert  into `creditsms`(`id`,`store_id`,`total_sms_purchased`,`available_sms`,`used_sms`,`buy_sms_credit`,`store`) values 
(1,1,'20000','19974','26','','1');

/*Table structure for table `loyality_setting` */

DROP TABLE IF EXISTS `loyality_setting`;

CREATE TABLE `loyality_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `loyality_expiry` varchar(200) NOT NULL,
  `min_points` varchar(200) NOT NULL,
  `max_points` varchar(200) NOT NULL,
  `rupee_value` varchar(200) NOT NULL,
  `loyality_points` varchar(255) NOT NULL,
  `loyality_point_earn` varchar(200) NOT NULL,
  `t_sale` varchar(200) NOT NULL,
  `store` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `loyality_setting` */

insert  into `loyality_setting`(`id`,`store_id`,`status`,`loyality_expiry`,`min_points`,`max_points`,`rupee_value`,`loyality_points`,`loyality_point_earn`,`t_sale`,`store`) values 
(1,1,'yes','90','700','5000','1','500','1','Percent','1');

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL,
  PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  UNIQUE KEY `mod_modulecode` (`mod_modulecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `module` */

insert  into `module`(`mod_modulegroupcode`,`mod_modulegroupname`,`mod_modulecode`,`mod_modulename`,`mod_modulegrouporder`,`mod_moduleorder`,`mod_modulepagename`) values 
('CHECKOUT','Checkout','PAYMENT','Payment',3,2,'payment.php'),
('CHECKOUT','Checkout','SHIPPING','Shipping',3,1,'shipping.php'),
('CHECKOUT','Checkout','TAX','Tax',3,3,'tax.php'),
('INVT','Inventory','PURCHASES','Purchases',2,1,'purchases.php'),
('INVT','Inventory','SALES','Sales',2,3,'sales.php'),
('INVT','Inventory','STOCKS','Stocks',2,2,'stocks.php');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL,
  PRIMARY KEY (`role_rolecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`role_rolecode`,`role_rolename`) values 
('ADMIN','Administrator'),
('SUPERADMIN','Super Admin');

/*Table structure for table `role_rights` */

DROP TABLE IF EXISTS `role_rights`;

CREATE TABLE `role_rights` (
  `store_id` int(11) DEFAULT NULL,
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  KEY `rr_modulecode` (`rr_modulecode`),
  CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role_rights` */

insert  into `role_rights`(`store_id`,`rr_rolecode`,`rr_modulecode`,`rr_create`,`rr_edit`,`rr_delete`,`rr_view`) values 
(1,'ADMIN','PAYMENT','no','no','no','yes'),
(1,'ADMIN','PURCHASES','yes','yes','yes','yes'),
(1,'ADMIN','SALES','no','no','no','no'),
(1,'ADMIN','SHIPPING','yes','yes','yes','yes'),
(1,'ADMIN','STOCKS','no','no','no','yes'),
(1,'ADMIN','TAX','no','no','no','no'),
(1,'SUPERADMIN','PAYMENT','yes','yes','yes','yes'),
(1,'SUPERADMIN','PURCHASES','yes','yes','yes','yes'),
(1,'SUPERADMIN','SALES','yes','yes','yes','yes'),
(1,'SUPERADMIN','SHIPPING','yes','yes','yes','yes'),
(1,'SUPERADMIN','STOCKS','yes','yes','yes','yes'),
(1,'SUPERADMIN','TAX','yes','yes','yes','yes');

/*Table structure for table `sms_report` */

DROP TABLE IF EXISTS `sms_report`;

CREATE TABLE `sms_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  `mobile` text NOT NULL,
  `from_date` varchar(500) NOT NULL,
  `to_date` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `operator` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `send` varchar(500) NOT NULL,
  `update_on` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sms_report` */

insert  into `sms_report`(`id`,`store_id`,`message`,`mobile`,`from_date`,`to_date`,`state`,`operator`,`status`,`send`,`update_on`) values 
(1,1,'Dear Monika , Thanks for visiting at Akshay Salon ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/yxhchl5d!','8130457937','2019-11-19','2019-11-19','1','operator','active','yes','on'),
(2,1,'Dear vaibhav deshmukh , Thanks for visiting at Akshay Salon ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/yxhchl5d!','9226337761','2019-11-30','2019-11-30','1','operator','active','yes','on'),
(3,1,'Dear abhishek pathak , Thanks for visiting at Akshay Salon ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/yxhchl5d!','8767999971','2019-11-30','2019-11-30','1','operator','active','yes','on'),
(4,1,'Dear abhishek pathak , Thanks for visiting at Akshay Salon ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/yxhchl5d!','8767999971','2019-11-30','2019-11-30','1','operator','active','yes','on'),
(6,1,'Dear testname thanks for choosing our package !','09818066320','','','1','operator','active','yes','on');

/*Table structure for table `smstemplates` */

DROP TABLE IF EXISTS `smstemplates`;

CREATE TABLE `smstemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `message_type` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `store` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `smstemplates` */

insert  into `smstemplates`(`id`,`store_id`,`message_type`,`message`,`store`) values 
(1,1,'Add Customer','Dear customer_name , Thanks for visiting at retailer_name ,we value your visit Have a Great Day Ahead Thanks','0'),
(2,1,'Enquiry','Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact retailer_number Thanks','0'),
(3,1,'Loyality','Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Thank','0'),
(4,1,'Birthday','Dear customer_name , We vish you a very Happy Birthday from retailer_name Team Thanks','0'),
(5,1,'Anniversary','Dear customer_name, we wish you a very Happy Anniversary. Best regards from retailer_name  !!!','0'),
(8,1,'Lost','Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact Us Thanks','0');

/*Table structure for table `system_users` */

DROP TABLE IF EXISTS `system_users`;

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL,
  `u_storeid` varchar(100) NOT NULL,
  `reguser_id` varchar(100) NOT NULL,
  PRIMARY KEY (`u_userid`),
  KEY `u_rolecode` (`u_rolecode`),
  CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `system_users` */

insert  into `system_users`(`u_userid`,`store_id`,`u_username`,`u_password`,`u_rolecode`,`u_storeid`,`reguser_id`) values 
(1,1,'akshay','Adid@s123','SUPERADMIN','1','1'),
(2,1,'amit','123456','ADMIN','','2'),
(12,2,'loiretech','','superadmin','','12');

/*Table structure for table `tbl_appoinment` */

DROP TABLE IF EXISTS `tbl_appoinment`;

CREATE TABLE `tbl_appoinment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `services` varchar(2000) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `time_slot` varchar(500) NOT NULL,
  `c_name` varchar(500) NOT NULL,
  `c_mobile` varchar(500) NOT NULL,
  `c_email` varchar(500) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_appoinment` */

insert  into `tbl_appoinment`(`id`,`store_id`,`services`,`emp_id`,`time_slot`,`c_name`,`c_mobile`,`c_email`,`c_address`,`date`) values 
(4,1,'a:1:{i:0;s:20:\"Bleach Face & Neck |\";}','4','09:00 AM','test customer ','875036672','amit@loiretechnologies.com','delhi','2019-12-13');

/*Table structure for table `tbl_campaign` */

DROP TABLE IF EXISTS `tbl_campaign`;

CREATE TABLE `tbl_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `campaign_category` varchar(500) NOT NULL,
  `campaign_name` varchar(500) NOT NULL,
  `campaign_sms` varchar(2000) NOT NULL,
  `customer_category` varchar(500) NOT NULL,
  `customer_group` varchar(500) NOT NULL,
  `campaign_before` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `last_run_date` date NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_campaign` */

insert  into `tbl_campaign`(`id`,`store_id`,`campaign_category`,`campaign_name`,`campaign_sms`,`customer_category`,`customer_group`,`campaign_before`,`date_time`,`store`,`userid`,`create_date`,`last_run_date`,`status`) values 
(1,1,'birthday','test by amit','test campaignddd','enquiry','Platinum','2','2019-12-12 02:22:00','','1','2019-12-13','0000-00-00','enabled');

/*Table structure for table `tbl_customer_data` */

DROP TABLE IF EXISTS `tbl_customer_data`;

CREATE TABLE `tbl_customer_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `mobile` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `anniversary` date NOT NULL,
  `dob` date NOT NULL,
  `employee` varchar(500) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `customer_group` varchar(500) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `reminder` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `nu_visit` varchar(100) NOT NULL,
  `last_visit_date` date NOT NULL,
  `c_date` date NOT NULL,
  `c_source` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_customer_data` */

insert  into `tbl_customer_data`(`id`,`store_id`,`mobile`,`name`,`email`,`anniversary`,`dob`,`employee`,`amount`,`customer_group`,`comment`,`reminder`,`store`,`userid`,`address`,`nu_visit`,`last_visit_date`,`c_date`,`c_source`) values 
(1,1,'8826126027','YOGESH','','0000-00-00','0000-00-00','rahul','200','','','','1','1','','','0000-00-00','2019-11-19',''),
(2,1,'8130457937','Monika','digestionformula0@gmail.com','2019-11-28','2019-12-01','Mahira','1199','Platinum','test','yes','1','1','New Delhi, https://www.digestionformula.com','','0000-00-00','2019-11-19',''),
(3,1,'8218490671','porash','','0000-00-00','0000-00-00','manish singh','180','','hello porash','','1','1','','','0000-00-00','2019-11-19',''),
(4,1,'9818066320','sidharth','test@gmail.com','2019-11-22','2020-01-02','rahul','599','Gold','test','yes','1','1','test','','0000-00-00','2019-11-19','Friends'),
(5,1,'1234567890','vijay','vijay@gmail.com','2019-11-30','2019-11-23','','500','','hair rgd hd gnfgzn zcgn nzdn znearhwrhEN DND N DN D MAFGMNANAH  AE AT DNA FYMN ','no','1','1','virar','','0000-00-00','2019-11-21',''),
(6,1,'9960382562','','','0000-00-00','2019-11-23','','750','','hfgjs sghsjs shsjs shsjs hsjshsjsh sjsh','yes','1','1','','','0000-00-00','2019-11-21',''),
(7,1,'9890375022','','','0000-00-00','0000-00-00','Akshay Bhai','500','','jhfkhfkhfhf','no','1','1','','','0000-00-00','2019-11-21',''),
(8,1,'9226337761','vaibhav deshmukh','','0000-00-00','0000-00-00','Akshay Bhai','900','Gold','','yes','1','1','','','0000-00-00','2019-11-30','Friends'),
(9,1,'8750366752','Amit Ku Singh','amit.mcp100@gmail.com','2019-12-12','2019-12-09','kayum ahmed','25000','Platinum','test by amit ku singh','yes','1','1','delhi','','0000-00-00','2019-12-12','Google Search');

/*Table structure for table `tbl_customer_group` */

DROP TABLE IF EXISTS `tbl_customer_group`;

CREATE TABLE `tbl_customer_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_customer_group` */

insert  into `tbl_customer_group`(`id`,`store_id`,`name`,`description`,`status`,`store`,`userid`) values 
(1,1,'Default','Default','enabled','1','1'),
(2,1,'Platinum','Platinum','enabled','1','1'),
(3,1,'Gold','Gold','enabled','1','1'),
(5,1,'Silver','Silver','enabled','1','1'),
(6,1,'Bronze','Bronze','enabled','1','1'),
(7,1,'Loyal','Loyal','enabled','1','1'),
(8,1,'Prime','Prime','enabled','1','1'),
(9,1,'Exitica','Exitica','enabled','1','1');

/*Table structure for table `tbl_customer_purchase` */

DROP TABLE IF EXISTS `tbl_customer_purchase`;

CREATE TABLE `tbl_customer_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `c_id` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `services` varchar(100) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_customer_purchase` */

insert  into `tbl_customer_purchase`(`id`,`store_id`,`c_id`,`store`,`mobile`,`amount`,`services`,`payment_mode`,`comment`,`date`) values 
(1,1,'1','1','8826126027','200','','','','2019-11-19'),
(2,1,'2','1','8130457937','1199','','','test','2019-11-19'),
(3,1,'3','1','8218490671','180','','','hello porash','2019-11-19'),
(4,1,'4','1','9818066320','599','','','test','2019-11-19'),
(5,1,'5','1','1234567890','500','','','hair rgd hd gnfgzn zcgn nzdn znearhwrhEN DND N DN D MAFGMNANAH  AE AT DNA FYMN ','2019-11-21'),
(6,1,'6','1','9960382562','750','','','hfgjs sghsjs shsjs shsjs hsjshsjsh sjsh','2019-11-21'),
(7,1,'7','1','9890375022','500','Threading Face ','','jhfkhfkhfhf','2019-11-21'),
(8,1,'8','1','9226337761','900','','','','2019-11-30'),
(9,1,'9','1','8750366752','25000','','','test by amit ku singh','2019-12-12');

/*Table structure for table `tbl_customer_source` */

DROP TABLE IF EXISTS `tbl_customer_source`;

CREATE TABLE `tbl_customer_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_customer_source` */

insert  into `tbl_customer_source`(`id`,`store_id`,`name`,`description`,`status`,`store`,`userid`) values 
(1,1,'Friends','Friends','enabled','1','1'),
(3,1,'Google Search','Google Search','enabled','1','1'),
(4,1,'Social Media','Social Media','enabled','1','1'),
(5,1,'Direct Walkin','Direct Walkin','enabled','1','1'),
(6,1,'Others','Others','enabled','1','1');

/*Table structure for table `tbl_employee` */

DROP TABLE IF EXISTS `tbl_employee`;

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `pic` varchar(500) NOT NULL,
  `e_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_employee` */

insert  into `tbl_employee`(`id`,`store_id`,`name`,`designation`,`pic`,`e_date`) values 
(4,1,'Akshay Bhai','owner','d41d8cd98f00b204e9800998ecf8427e','2019-11-21'),
(6,1,'junaid alim','senior stylist','d41d8cd98f00b204e9800998ecf8427e','2019-11-30'),
(7,1,'sanjay singh','senior stylist','d41d8cd98f00b204e9800998ecf8427e','2019-11-30'),
(8,1,'apeksha','beautician','d41d8cd98f00b204e9800998ecf8427e','2019-11-30'),
(9,1,'kayum ahmed','senior stylist female','d41d8cd98f00b204e9800998ecf8427e','2019-11-30'),
(10,1,'farid malik','junior stylist','d41d8cd98f00b204e9800998ecf8427e','2019-11-30'),
(11,1,'test','Developer','d41d8cd98f00b204e9800998ecf8427e','2019-12-13');

/*Table structure for table `tbl_feedback` */

DROP TABLE IF EXISTS `tbl_feedback`;

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `mobile` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mode` varchar(500) NOT NULL,
  `service` varchar(500) NOT NULL,
  `anniversary` date NOT NULL,
  `dob` date NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `date` date NOT NULL,
  `read` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_feedback` */

/*Table structure for table `tbl_feedbacksetting` */

DROP TABLE IF EXISTS `tbl_feedbacksetting`;

CREATE TABLE `tbl_feedbacksetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `feedback_value` varchar(500) NOT NULL,
  `store` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_feedbacksetting` */

insert  into `tbl_feedbacksetting`(`id`,`store_id`,`feedback_value`,`store`) values 
(1,NULL,'every','1');

/*Table structure for table `tbl_loyality` */

DROP TABLE IF EXISTS `tbl_loyality`;

CREATE TABLE `tbl_loyality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `c_id` varchar(100) NOT NULL,
  `available_points` varchar(100) NOT NULL,
  `used_points` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_loyality` */

insert  into `tbl_loyality`(`id`,`store_id`,`amount`,`c_id`,`available_points`,`used_points`,`mobile`) values 
(1,1,'200','1','0.4','0','8826126027'),
(2,1,'1199','2','2.398','0','8130457937'),
(3,1,'180','3','0.36','0','8218490671'),
(4,1,'599','4','1.198','0','9818066320'),
(5,1,'500','5','1','0','1234567890'),
(6,1,'750','6','1.5','0','9960382562'),
(7,1,'500','7','1','0','9890375022'),
(8,1,'900','8','1.8','0','9226337761'),
(9,1,'25000','9','50','0','8750366752');

/*Table structure for table `tbl_package` */

DROP TABLE IF EXISTS `tbl_package`;

CREATE TABLE `tbl_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `package_name` varchar(1000) NOT NULL,
  `package_price` varchar(200) NOT NULL,
  `package_expiry` varchar(200) NOT NULL,
  `package_days` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `services` varchar(2000) NOT NULL,
  `store` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_package` */

insert  into `tbl_package`(`id`,`store_id`,`package_name`,`package_price`,`package_expiry`,`package_days`,`create_date`,`services`,`store`) values 
(1,1,'test','2000','2','Days','2019-12-17 00:00:00','a:1:{i:0;a:2:{s:8:\"services\";s:15:\"Threading Face \";s:11:\"package_qty\";s:1:\"2\";}}','');

/*Table structure for table `tbl_package_otp` */

DROP TABLE IF EXISTS `tbl_package_otp`;

CREATE TABLE `tbl_package_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `mobile` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `store` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_package_otp` */

/*Table structure for table `tbl_package_services` */

DROP TABLE IF EXISTS `tbl_package_services`;

CREATE TABLE `tbl_package_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `package_id` varchar(100) NOT NULL,
  `service` varchar(1000) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_package_services` */

/*Table structure for table `tbl_product` */

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `price` varchar(50) CHARACTER SET latin1 NOT NULL,
  `userid` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_product` */

insert  into `tbl_product`(`id`,`store_id`,`product_name`,`price`,`userid`,`sales_date`) values 
(1,1,'Beardo Cream Wax','0',1,'2019-11-25'),
(2,1,'Qraa Wax','0',1,'2019-11-25'),
(3,1,'Beardo Wax Gel','0',1,'2019-11-25'),
(4,1,'Beardo Fash Wash','0',1,'2019-11-25'),
(5,1,'Cheryl`s Face Wash','0',1,'2019-12-16'),
(6,1,'Cheryl`s Sunblock SPF 30 ','0',1,'2019-12-16'),
(7,1,'Cheryl`s Sunblock SPF 50 ','0',1,'2019-11-25'),
(8,1,'Cheryl`s O2C2 Skin Radiance Lotion','0',1,'2019-12-16'),
(9,1,'Qraa De-Tan Scrub','0',1,'2019-11-25'),
(10,1,'Qraa Hair Vitilazer','0',1,'2019-11-25'),
(11,1,'Loreal Density Advance Shampoo','0',1,'2019-11-25'),
(12,1,'Loreal Vitamin Color Shampoo','0',1,'2019-11-25'),
(13,1,'Loreal Inforcer Shampoo','0',1,'2019-11-25'),
(14,1,'Loreal Instant Clear Shampoo','0',1,'2019-11-25'),
(15,1,'Loreal Extenso Shampoo','0',1,'2019-11-25'),
(16,1,'Loreal Extenso Hair Mask','0',1,'2019-11-25'),
(17,1,'Loreal Liss Unlimited Shampoo','0',1,'2019-11-25'),
(18,1,'Loreal Absolute Repair Shampoo','0',1,'2019-11-25'),
(19,1,'Loreal Inforcer Mask','0',1,'2019-11-25'),
(20,1,'Loreal Absolute Repair Mask','0',1,'2019-11-25'),
(21,1,'Loreal Vitamin O Mask','0',1,'2019-11-25'),
(22,1,'Streax Hair Serum','0',1,'2019-11-25'),
(23,1,'Berina Hair Spray Gold','0',1,'2019-11-25'),
(24,1,'Loreal Clay','0',1,'2019-11-25'),
(25,1,'Loreal Studio Hair Spray','0',1,'2019-11-25'),
(26,1,'Schwarzkopf Dust It','0',1,'2019-11-25'),
(27,1,'Qraa Hair Tonic','0',1,'2019-11-25');

/*Table structure for table `tbl_redeem_package` */

DROP TABLE IF EXISTS `tbl_redeem_package`;

CREATE TABLE `tbl_redeem_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `sell_pack_id` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `package` varchar(500) NOT NULL,
  `redeem_qty` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_redeem_package` */

/*Table structure for table `tbl_regain` */

DROP TABLE IF EXISTS `tbl_regain`;

CREATE TABLE `tbl_regain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `reminder` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_regain` */

insert  into `tbl_regain`(`id`,`store_id`,`reminder`,`duration`) values 
(1,1,'2','year');

/*Table structure for table `tbl_reminder` */

DROP TABLE IF EXISTS `tbl_reminder`;

CREATE TABLE `tbl_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `reminder` varchar(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_reminder` */

insert  into `tbl_reminder`(`id`,`store_id`,`reminder`,`duration`) values 
(11,1,'30','days');

/*Table structure for table `tbl_sales_report` */

DROP TABLE IF EXISTS `tbl_sales_report`;

CREATE TABLE `tbl_sales_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `sales_date` date NOT NULL,
  `product` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sales_report` */

insert  into `tbl_sales_report`(`id`,`store_id`,`name`,`employee`,`services`,`mobile`,`amount`,`payment_mode`,`sales_date`,`product`) values 
(1,1,'Monika','Mahira','Threading Forehead ','8130457937','1199','cash','2019-11-19',''),
(2,1,'porash','manish singh','','8218490671','200','cash','2019-11-19','Face wash'),
(3,1,'sidharth','rahul','','9818066320','599','wallet','2019-11-19','garnier hair Color'),
(4,1,'porash','manish singh','Bleach Half Arms ','8218490671','180','cash','2019-11-19',''),
(5,1,'vijay','','','1234567890','500','cash','2019-11-21','Face wash'),
(6,1,'','','','9960382562','750','cash','2019-11-21','garnier hair Color'),
(7,1,'','Akshay Bhai','Threading Face ','9890375022','500','card','2019-11-21',''),
(8,1,'vaibhav deshmukh','Akshay Bhai','','9226337761','900','cash','2019-11-30',''),
(9,1,'abhishek pathak','Akshay Bhai','Hair Services Hair Cuts  (For Female) ','8767999971','300','wallet','2019-11-30',''),
(10,1,'abhishek pathak','Akshay Bhai','Hair Services Hair Cuts  (For Female) ','8767999971','300','wallet','2019-11-30',''),
(11,1,'Amit Ku Singh','kayum ahmed','','8750366752','25000','cash','2019-12-12','');

/*Table structure for table `tbl_sellpackage` */

DROP TABLE IF EXISTS `tbl_sellpackage`;

CREATE TABLE `tbl_sellpackage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `package_id` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `userid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_sellpackage` */

insert  into `tbl_sellpackage`(`id`,`store_id`,`package_id`,`name`,`email`,`mobile`,`create_date`,`userid`) values 
(1,1,'1','testname','totaldetox96@gmail.com','09818066320','2019-12-17','1');

/*Table structure for table `tbl_services` */

DROP TABLE IF EXISTS `tbl_services`;

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `service_name` varchar(1000) NOT NULL,
  `added_date` date NOT NULL,
  `modi_date` date NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `pic` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_services` */

insert  into `tbl_services`(`id`,`store_id`,`service_name`,`added_date`,`modi_date`,`store`,`userid`,`price`,`pic`) values 
(7,1,'Threading Face ','2019-10-24','2019-10-24','1','1','80','07e9ce29fac62d868afe46ceacbb9b39.jpg'),
(8,1,'Bleach Upper Lip ','2019-10-24','2019-10-24','1','1','50','6a1ddb6820445c6fb25b65c15ba09606.jpg'),
(9,1,'Bleach Face & Neck ','2019-10-24','2019-10-24','1','1','300','d5756ccc7cda0d7d816c8db568873a9a.jpg'),
(10,1,'Bleach Under Arms ','2019-10-24','2019-10-24','1','1','150','20f6332a4068b3547f27e648065eefe2.jpg'),
(11,1,'Bleach Full Front ','2019-10-24','2019-10-24','1','1','500','673793cf0457534c690acc93ae9b6ab5.jpg'),
(12,1,'Bleach Half Front ','2019-10-24','2019-10-24','1','1','250','2c9980ac098333ccf7f7874783cc2ba3.jpg'),
(13,1,'Bleach Full Back ','2019-10-24','2019-10-24','1','1','500','387aea2afab2bbfd048b72dcc2ea6d2a.jpg'),
(14,1,'Bleach Half Back ','2019-10-24','2019-10-24','1','1','250','292f19113fcae90f54b28ea6b9c85b83.jpg'),
(15,1,'Bleach Full Arms ','2019-10-24','2019-10-24','1','1','300','4f7c42973a8dc8bc367e1fb8eefbbacd.jpg'),
(16,1,'Bleach Half Arms ','2019-10-24','2019-10-24','1','1','200','3c90a342bc5e37fc705af6949e7905f5.jpg'),
(17,1,'Bleach Full Legs ','2019-10-24','2019-10-24','1','1','400','2a90dbef29ad5e1479771c199d82dcc0.jpg'),
(18,1,'Bleach Half Legs ','2019-10-24','2019-10-24','1','1','200','ea1feab9cfcb167e68d53cce7dc9a3ff.jpg'),
(19,1,'Bleach Full Body ','2019-10-24','2019-10-24','1','1','1500','56970491973547230829896b0723551c.jpg'),
(20,1,'CleanUp Fruit CleanUp','2019-10-24','2019-10-24','1','1','350','9337e74caaf090f1a69c007cc0145536.jpg'),
(21,1,'CleanUp Organic CleanUp ','2019-10-24','2019-10-24','1','1','350','11a41cee94c7a22cf697777cf1b40fce.jpg'),
(22,1,'Facial Fruit Blast Facial ','2019-10-24','2019-10-24','1','1','700','a26280eea56a9af601d2935a5551cfca.jpg'),
(23,1,'Facial Gold Facial ','2019-10-24','2019-10-24','1','1','900','da4ec692587d2d02b47c630378e47132.jpg'),
(24,1,'Facial Diamond Facial ','2019-10-24','2019-10-24','1','1','900','b912d14d3df4afa8fb1fe842df28eebb.jpg'),
(25,1,'Facial Tan Clear ','2019-10-24','2019-10-24','1','1','1000','595519e4fa01be8a0137aa6a162cf2b9.jpg'),
(26,1,'Facial Vitalif ','2019-10-24','2019-10-24','1','1','1000','e2d3cd8a145c9d4f55ab86b705da2745.jpg'),
(27,1,'Facial Glovite ','2019-10-24','2019-10-24','1','1','1000','8a3719745d1735ff263677009b508e1e.jpg'),
(28,1,'Facial Oxyblast','2019-10-24','2019-10-24','1','1','1000','da43c6e4a1cd0ea1c46f87584b838f6b.jpg'),
(29,1,'Facial Sensiglow','2019-10-24','2019-10-24','1','1','1000','1a0f16740b62d6afd20f92b080520247.jpg'),
(30,1,'Facial Clariglow ','2019-10-24','2019-10-24','1','1','1000','375fc6cb826e124c88dfa3a65a2781dd.jpg'),
(31,1,'Wax Imported Honey Wax Upper Lip / Chin  ','2019-10-24','2019-10-24','1','1','40','57c4b0d41263068903cedce86694e09a.jpg'),
(32,1,'Wax Imported Honey Wax Jawline / Side Locks ','2019-10-24','2019-10-24','1','1','60','7894d35ec782f4ed5e2aa4c80e0fedba.jpg'),
(33,1,'Wax Imported Honey Wax Full Face ','2019-10-24','2019-10-24','1','1','100','9e927231775e9012228dcb218480d750.jpg'),
(34,1,'Wax Imported Honey Wax Full Arms ','2019-10-24','2019-10-24','1','1','150','f1b3911b4542e43df1af90cfb6b840fc.jpg'),
(35,1,'Wax Imported Honey Wax Half Arms ','2019-10-24','2019-10-24','1','1','80','60ffb78630ad3b2860ebda931051ac18.jpg'),
(36,1,'Wax Imported Honey Wax Full Legs ','2019-10-24','2019-10-24','1','1','200','548de343a3daf00a67b4e07e3cedc715.jpg'),
(37,1,'Wax Imported Honey Wax Half Legs ','2019-10-24','2019-10-24','1','1','100','b948c135ecce16307a428eefbb98b323.jpg'),
(38,1,'Wax Imported Honey Wax Full Front ','2019-10-24','2019-10-24','1','1','200','d0beb4a335bd9067b08c42d918335382.jpg'),
(39,1,'Wax Imported Honey Wax Half Front ','2019-10-24','2019-10-24','1','1','100','1e4b65b470a5e9cbdfd25332a2b0665d.jpg'),
(41,1,'Wax Imported Honey Wax Full Back ','2019-10-24','2019-10-24','1','1','200','48b477efdc71b3fc205a0ffa6293f99a.jpg'),
(42,1,'Wax Imported Honey Wax Half Back / Stomach ','2019-10-24','2019-10-24','1','1','250','d6368f86be8a90421966f74ae93edca9.jpg'),
(43,1,'Wax Imported Honey Wax Bikini Line ','2019-10-24','2019-10-24','1','1','100','b838ce3dfe291110476974c3ee212b33.jpg'),
(44,1,'Wax Imported Honey Wax Brazilian ','2019-10-24','2019-10-24','1','1','400','15340cb12dd3afa16c02ca86efdf8a14.jpg'),
(45,1,'Wax Imported Honey Wax Full Body','2019-10-24','2019-10-24','1','1','1500','7ff274529b57fc8249e1883d548d7184.jpg'),
(46,1,'Wax Liposoluble Wax Full Arms ','2019-10-24','2019-10-24','1','1','250','4408445d65087aa3751974aff028f941.jpg'),
(47,1,'Wax Liposoluble Wax Half Arms ','2019-10-24','2019-10-24','1','1','150','f65a2b4a5c8d8d9d754c3060a759bf91.jpg'),
(48,1,'Wax Liposoluble Wax Full Legs ','2019-10-24','2019-10-24','1','1','300','8f13f9b662b40d27ceb8e0b67cd00ca9.jpg'),
(49,1,'Wax Liposoluble Wax Half Legs ','2019-10-24','2019-10-24','1','1','200','a83a2747b6894e8ecb142e237c836ea0.jpg'),
(50,1,'Wax Liposoluble Wax Full Front ','2019-10-24','2019-10-24','1','1','250','6dd42a8a4f2358ef582801ab09a65623.jpg'),
(51,1,'Wax Liposoluble Wax Half Front ','2019-10-24','2019-10-24','1','1','150','157d3488ebccbd641c99b185cf76bc5c.jpg'),
(52,1,'Wax Liposoluble Wax Full Back ','2019-10-24','2019-10-24','1','1','250','967fa1372362a149aebf4f4b30242ba6.jpg'),
(53,1,'Wax Liposoluble Wax Half Back','2019-10-24','2019-10-24','1','1','150','8853200bfce0c023252991d47ef56a1d.jpg'),
(54,1,'Wax Liposoluble Wax Stomach Behind ','2019-10-24','2019-10-24','1','1','200','ea3ff0bf823f404fa4b66ce5d1da1ccb.jpg'),
(55,1,'Wax Liposoluble Wax Brazilian ','2019-10-24','2019-10-24','1','1','600','81ef69e449f1ad533c304d1136b97020.jpg'),
(56,1,'Wax Liposoluble Wax Full Body','2019-10-24','2019-10-24','1','1','2000','6b3bb19de4875d37769aa50e514c1384.jpg'),
(57,1,'Hair Services Hair Cuts  (For Female) ','2019-10-24','2019-10-24','1','1','350','483e6000aca8b4babb627715583ae201.jpg'),
(58,1,'Hair Services Advanced Hair Cuts  (For Female) ','2019-10-24','2019-10-24','1','1','500','f606a765a9d4a7659f71e223d2c4e172.jpg'),
(59,1,'Hair Services Hair Cut By Director (For Female) ','2019-10-24','2019-10-24','1','1','600','4acff29119f51c3e06d2631070728a4e.jpg'),
(60,1,'Hair Services Hair Wash Wash With Conditioning ','2019-10-24','2019-10-24','1','1','150','6b0e7080c8a694eb88ca745a94eb3d0e.jpg'),
(61,1,'Hair Services Hair Wash Wash With Deep Conditioning ','2019-10-24','2019-10-24','1','1','200','1d83036b5b0058b3f87a1a77dd78c001.jpg'),
(62,1,'Temporary Styling (curls & straight) Blow Dry ','2019-10-24','2019-10-24','1','1','200','5dcf1e63bf13e6c1a6ba4c6f063d1801.jpg'),
(63,1,'Temporary Styling (curls & straight) Mid Waist & Below Waist','2019-10-24','2019-10-24','1','1','300','646a8289cc033e4b7fc62e8ce4451034.jpg'),
(64,1,'Ironing Upto Shoulder ','2019-10-24','2019-10-24','1','1','150','fb47fceb86e255952dc65be3e0d4a5cf.jpg'),
(65,1,'Ironing Below Shoulder ','2019-10-24','2019-10-24','1','1','250','e2d45cedcebbc5b95f0b8e9d172eadd0.jpg'),
(66,1,'Ironing Mid Waist & Below Waist ','2019-10-24','2019-10-24','1','1','500','aea6f25b05a133ed0deb8cf06311d9ad.jpg'),
(67,1,'Tongs Below Shoulder ','2019-10-24','2019-10-24','1','1','300','f65ae5c651a76b44faae7ef05995e4ae.jpg'),
(68,1,'Tongs Mid Waist & Below Waist ','2019-10-24','2019-10-24','1','1','500','ecf0b670600b7a61926f93a1afbf1f5b.jpg'),
(69,1,'Permanent Styling Smoothening Fringe Portion ','2019-10-24','2019-10-24','1','1','700','161e204d5259e8b9d7d9062e3b9269d0.jpg'),
(70,1,'Permanent Styling Smoothening Crown ','2019-10-24','2019-10-24','1','1','1400','2b882b90ed0a607fe2db96f4cffdb6a8.jpg'),
(71,1,'Permanent Styling Smoothening Upto Shoulder ','2019-10-24','2019-10-24','1','1','2500','1b7d9967357491c24fa1b7ed63d7d65e.jpg'),
(72,1,'Permanent Styling Smoothening Below Shoulder','2019-10-24','2019-10-24','1','1','3500','eaafcacb094c1f463bf51d5bc8b472e3.jpg'),
(73,1,'Permanent Styling Smoothening Mid Waist & Below Waist','2019-10-24','2019-10-24','1','1','4800','8794813e91fe8e90de152b735b3cd656.jpg'),
(74,1,'Rebonding Fringe Portion','2019-10-24','2019-10-24','1','1','900','6b088b2ef892e6f505198b2116f6d516.jpg'),
(76,1,'Rebonding Crown ','2019-10-24','2019-10-24','1','1','1800','ed770987e7970f56ece4bf4ed4fc9d15.jpg'),
(77,1,'Rebonding Upto Shoulder ','2019-10-24','2019-10-24','1','1','3000','f00f8defa2786e5949314c8790d79a88.jpg'),
(78,1,'Rebonding Below Shoulder ','2019-10-24','2019-10-24','1','1','5000','04b5210a03b605a60c99bcd46dbe71b0.jpg'),
(79,1,'Rebonding Mid Waist & Below Waist ','2019-10-24','2019-10-24','1','1','7000','db70deabe890852e9dce67325f9fb64c.jpg'),
(80,1,'Colour Upto Neck','2019-10-24','2019-10-24','1','1','600','c8fd0aa0f26506423152fcb985885e71.jpg'),
(81,1,'Colour Below Shoulder ','2019-10-24','2019-10-24','1','1','800','e001bc1277321ba0cd42aac470f49e26.jpg'),
(82,1,'Colour Mid Waist ','2019-10-24','2019-10-24','1','1','1000','3822ef7fd5d655cd35c98786fc748208.jpg'),
(83,1,'Colour Below Waist ','2019-10-24','2019-10-24','1','1','1500','9bc0cf2ddfe7d698bc234882a9055ea4.jpg'),
(84,1,'Global Highlights Upto Shoulder','2019-10-24','2019-10-24','1','1','1000','4540b3e5abdf29f382b25c43f8cf69c3.jpg'),
(85,1,'Global Highlights Below Shoulder ','2019-10-24','2019-10-24','1','1','1800','8c689324b77bbb53de0c54b57dfe0dfe.jpg'),
(86,1,'Global Highlights Mid Waist','2019-10-24','2019-10-24','1','1','2500','ffa25c7ba1787484478a28f663d8171e.jpg'),
(87,1,'Global Highlights Below Waist','2019-10-24','2019-10-24','1','1','3500','5c7c5025d10c69694f0e80836c7ee083.jpg'),
(88,1,'Reflect & Lighters Shades Upto Shoulder','2019-10-24','2019-10-24','1','1','1000','737426d7b89c5d7945c999eff0eb6f40.jpg'),
(89,1,'Reflect & Lighters Shades Below Shoulder','2019-10-24','2019-10-24','1','1','1800','85b972faaca2fd0dc05a7a82c72a7846.jpg'),
(90,1,'Reflect & Lighters Shades Mid Waist','2019-10-24','2019-10-24','1','1','2500','72cd81cf9faeb8f58cb871c28bf33caa.jpg'),
(91,1,'Reflect & Lighters Shades Below Waist','2019-10-24','2019-10-24','1','1','3499','bd0c4d3a70b983929742041be2c6b2c5.jpg'),
(92,1,'Fashion Colours Per Streak ','2019-10-24','2019-10-24','1','1','300','7a1034d5b1db308717edd03b766fea68.jpg'),
(93,1,'Fashion Colours Global Fashion Highlights ','2019-10-24','2019-10-24','1','1','1200','631c8de9c0732d94ce5affef511df06f.jpg'),
(94,1,'Fashion Colours Upto Shoulder','2019-10-24','2019-10-24','1','1','1500','2ef59a0fbf042c702eb05c44c2c7b9a8.jpg'),
(95,1,'Fashion Colours Below Shoulder','2019-10-24','2019-10-24','1','1','3000','cb4b352fc87168743da4465d2c2272ec.jpg'),
(96,1,'Fashion Colours Mid Waist','2019-10-24','2019-10-24','1','1','4000','d87d6de813892e32618e9382657f70c8.jpg'),
(97,1,'Fashion Colours Below Waist ','2019-10-24','2019-10-24','1','1','4500','ba13992ee3679621f64adf6bb32da532.jpg'),
(98,1,'Hair Treatments Hair Spa','2019-10-24','2019-10-24','1','1','800','07c7e1aecf7f2af23601da953d7b8c36.jpg'),
(99,1,'Hair Treatments Powder Mix','2019-10-24','2019-10-24','1','1','900','327b6a3b5f11f4c8a89710d9cac3c60e.jpg'),
(100,1,'Hair Treatments Anti Dandruff - Treatment ','2019-10-24','2019-10-24','1','1','800','a318bd79121a5a2594a5ce5acc2fca49.jpg'),
(101,1,'Keratin Kera Smooth ','2019-10-24','2019-10-24','1','1','3000','33315a8190aaef33c512bba86f77827a.jpg'),
(102,1,'Keratin Keratin Infused','2019-10-24','2019-10-24','1','1','5000','ab68e6ef93d3e891488d7fcf1c78f384.jpg'),
(105,1,'Men Regular Haircut Junior Stylist','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(106,1,'Men Beard Wet Shave','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(107,1,'Men Beard Beard Carving','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(108,1,'Men Beard Beard Outlining','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(109,1,'Men Beard Beard Wash','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(110,1,'Men Beard Beard Spa','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(111,1,'Men Beard Beard Styling','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(112,1,'Men Beard Mustache Shaping','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(113,1,'Men Beard Mustache Styling','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(114,1,'Men Beard Eyebrows','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(115,1,'men regular haircut junior stylist','2019-12-03','2019-12-03','1','1','100','d41d8cd98f00b204e9800998ecf8427e'),
(116,1,'men regular haircut senior stylist','2019-12-03','2019-12-03','1','1','150','d41d8cd98f00b204e9800998ecf8427e'),
(117,1,'men regular haircut director','2019-12-03','2019-12-03','1','1','300','d41d8cd98f00b204e9800998ecf8427e'),
(118,1,'men advanced haircut junior stylist','2019-12-03','2019-12-03','1','1','200','d41d8cd98f00b204e9800998ecf8427e'),
(119,1,'men advanced haircut senior stylist','2019-12-03','2019-12-03','1','1','250','d41d8cd98f00b204e9800998ecf8427e'),
(120,1,'men advanced haircut director','2019-12-03','2019-12-03','1','1','450','d41d8cd98f00b204e9800998ecf8427e'),
(121,1,'Men Cleanup  Face Wash','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(122,1,'Men Cleanup  Fruit Cleanup','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(123,1,'men hair  regular wash','2019-12-03','2019-12-03','1','1','50','d41d8cd98f00b204e9800998ecf8427e'),
(124,1,'Men Cleanup  Charcoal Cleanup','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(125,1,'Men Cleanup  Dental Cleanup','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(126,1,'men hair wash deep conditioning','2019-12-03','2019-12-03','1','1','100','d41d8cd98f00b204e9800998ecf8427e'),
(127,1,'Men Cleanup  Charcoal Peel','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(128,1,'men hair wash deep cleansing','2019-12-03','2019-12-03','1','1','250','d41d8cd98f00b204e9800998ecf8427e'),
(129,1,'Men Cleanup  Detan','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(130,1,'men hair styling blow dry','2019-12-03','2019-12-03','1','1','100','d41d8cd98f00b204e9800998ecf8427e'),
(131,1,'Men Facial Fruit Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(132,1,'Men Facial White Glow','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(133,1,'Men Facial Gold Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(134,1,'men hair styling Ironing(short length)','2019-12-03','2019-12-03','1','1','150','d41d8cd98f00b204e9800998ecf8427e'),
(135,1,'Men Facial Diamond Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(136,1,'men hair grey coverage(basic length)','2019-12-03','2019-12-03','1','1','400','d41d8cd98f00b204e9800998ecf8427e'),
(137,1,'men hair reflects shades(basic length)','2019-12-03','2019-12-03','1','1','500','d41d8cd98f00b204e9800998ecf8427e'),
(138,1,'men hair fashion shade(crown part )','2019-12-03','2019-12-03','1','1','1500','d41d8cd98f00b204e9800998ecf8427e'),
(139,1,'men hair fashion shade streak','2019-12-03','2019-12-03','1','1','300','d41d8cd98f00b204e9800998ecf8427e'),
(140,1,'men hair blonde streak','2019-12-03','2019-12-03','1','1','150','d41d8cd98f00b204e9800998ecf8427e'),
(141,1,'men hair cap highlights(blonde)','2019-12-03','2019-12-03','1','1','800','d41d8cd98f00b204e9800998ecf8427e'),
(142,1,'men hair cap highlights fashion shade','2019-12-03','2019-12-03','1','1','1500','d41d8cd98f00b204e9800998ecf8427e'),
(143,1,'Men Facial Glovite Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(144,1,'Men Facial Anti Tan Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(145,1,'Men Facial Skin Whitening','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(146,1,'men hair hydrating spa','2019-12-03','2019-12-03','1','1','500','d41d8cd98f00b204e9800998ecf8427e'),
(147,1,'Men Facial O3 Glowing Facial','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(148,1,'Men Facial Hand Detan','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(149,1,'Men Facial Neck Detan','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(150,1,'men hair scalp cleansing(basic length)','2019-12-03','2019-12-03','1','1','800','d41d8cd98f00b204e9800998ecf8427e'),
(151,1,'men hair relaxing','2019-12-03','2019-12-03','1','1','300','d41d8cd98f00b204e9800998ecf8427e'),
(152,1,'men  head massage','2019-12-03','2019-12-03','1','1','150','d41d8cd98f00b204e9800998ecf8427e'),
(153,1,'men chair massage','2019-12-03','2019-12-03','1','1','300','d41d8cd98f00b204e9800998ecf8427e'),
(154,1,'Men Hair Smoothening','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(155,1,'Men Kera Smooth','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(156,1,'Men Rebonding','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(157,1,'Men Smart Bond','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(158,1,'Men Power mix Treatment','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(159,1,'Men Pedicure Regular','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(160,1,'Men Pedicure Foot Spa','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(161,1,'Men Pedicure Foot Reflexology','2019-12-03','2019-12-03','1','1','','d41d8cd98f00b204e9800998ecf8427e'),
(163,2,'pedicure','2019-12-18','2019-12-18','','','200','d41d8cd98f00b204e9800998ecf8427e');

/*Table structure for table `tbl_store` */

DROP TABLE IF EXISTS `tbl_store`;

CREATE TABLE `tbl_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) DEFAULT 'Loire CRM',
  `store_address` text DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(11) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_store` */

insert  into `tbl_store`(`store_id`,`store_name`,`store_address`,`state`,`city`,`website`,`email`,`contact`,`logo`,`create_date`) values 
(1,'Akshay Salon','Shop No 5 (Virar)',NULL,NULL,NULL,NULL,NULL,'e5d67599bbb698e0cb7ec7a0713419e2.jpg','2019-12-12 13:05:14'),
(2,'Loire wellnesss',NULL,NULL,NULL,NULL,'amit.mcp100@gmail.com','8750366753',NULL,'2019-12-18 00:00:00');

/*Table structure for table `tbl_timeslot` */

DROP TABLE IF EXISTS `tbl_timeslot`;

CREATE TABLE `tbl_timeslot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `time_slot` varchar(200) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_timeslot` */

insert  into `tbl_timeslot`(`id`,`store_id`,`time_slot`,`emp_id`) values 
(4,1,'09:00 AM','8'),
(5,1,'09:30 AM','8'),
(6,1,'10:00 AM','8'),
(7,1,'01:30 PM','8'),
(8,1,'02:00 PM','8'),
(9,1,'02:30 PM','8'),
(10,1,'08:30 PM','9'),
(11,1,'09:00 PM','9'),
(12,1,'09:00 AM','10'),
(13,1,'09:30 AM','10'),
(14,1,'10:00 AM','10'),
(15,1,'10:30 AM','10'),
(16,1,'12:00 PM','10'),
(17,1,'12:30 PM','10'),
(18,1,'01:00 PM','10'),
(28,1,'09:30 AM','12'),
(29,1,'02:00 PM','12'),
(30,1,'06:30 PM','12'),
(31,1,'12:00 PM','13'),
(32,1,'12:30 PM','13'),
(33,1,'03:30 PM','14'),
(34,1,'05:30 PM','14'),
(36,1,'09:00 AM','1'),
(37,1,'09:30 AM','1'),
(38,1,'10:00 AM','1'),
(39,1,'11:00 AM','1'),
(40,1,'11:30 AM','1'),
(41,1,'01:00 PM','1'),
(42,1,'01:30 PM','1'),
(43,1,'02:00 PM','1'),
(44,1,'02:30 PM','1'),
(45,1,'03:00 PM','1'),
(46,1,'03:30 PM','1'),
(47,1,'04:00 PM','1'),
(48,1,'04:30 PM','1'),
(49,1,'05:00 PM','1'),
(50,1,'05:30 PM','1'),
(51,1,'06:00 PM','1'),
(52,1,'06:30 PM','1'),
(53,1,'07:00 PM','1'),
(54,1,'07:30 PM','1'),
(55,1,'08:00 PM','1'),
(56,1,'08:30 PM','1'),
(57,1,'09:00 PM','1'),
(58,1,'09:00 AM','2'),
(59,1,'09:30 AM','2'),
(60,1,'10:00 AM','2'),
(61,1,'10:30 AM','2'),
(62,1,'11:00 AM','2'),
(63,1,'11:30 AM','2'),
(64,1,'12:00 PM','2'),
(65,1,'01:30 PM','2'),
(66,1,'02:00 PM','2'),
(67,1,'04:30 PM','2'),
(68,1,'05:00 PM','2'),
(69,1,'05:30 PM','2'),
(70,1,'06:30 PM','2'),
(71,1,'07:00 PM','2'),
(72,1,'07:30 PM','2'),
(73,1,'09:00 PM','2'),
(162,1,'09:00 AM','5'),
(163,1,'09:30 AM','5'),
(164,1,'10:00 AM','5'),
(165,1,'10:30 AM','5'),
(166,1,'11:00 AM','5'),
(167,1,'11:30 AM','5'),
(168,1,'12:00 PM','5'),
(169,1,'12:30 PM','5'),
(170,1,'02:00 PM','5'),
(171,1,'02:30 PM','5'),
(172,1,'03:00 PM','5'),
(173,1,'03:30 PM','5'),
(174,1,'04:00 PM','5'),
(175,1,'04:30 PM','5'),
(176,1,'05:00 PM','5'),
(177,1,'05:30 PM','5'),
(178,1,'06:00 PM','5'),
(179,1,'06:30 PM','5'),
(180,1,'07:00 PM','5'),
(181,1,'08:00 PM','5'),
(182,1,'08:30 PM','5'),
(183,1,'09:00 PM','5'),
(204,1,'09:00 AM','3'),
(205,1,'09:30 AM','3'),
(206,1,'10:00 AM','3'),
(207,1,'10:30 AM','3'),
(208,1,'11:00 AM','3'),
(209,1,'11:30 AM','3'),
(210,1,'12:00 PM','3'),
(211,1,'12:30 PM','3'),
(212,1,'01:00 PM','3'),
(213,1,'02:30 PM','3'),
(214,1,'03:00 PM','3'),
(215,1,'03:30 PM','3'),
(216,1,'04:30 PM','3'),
(217,1,'05:00 PM','3'),
(218,1,'05:30 PM','3'),
(219,1,'06:00 PM','3'),
(220,1,'06:30 PM','3'),
(221,1,'07:00 PM','3'),
(222,1,'08:00 PM','3'),
(223,1,'08:30 PM','3'),
(224,1,'09:00 AM','4'),
(225,1,'09:30 AM','4'),
(226,1,'10:00 AM','4'),
(227,1,'10:30 AM','4'),
(228,1,'11:00 AM','4'),
(229,1,'11:30 AM','4'),
(230,1,'12:00 PM','4'),
(231,1,'12:30 PM','4'),
(232,1,'02:00 PM','4'),
(233,1,'02:30 PM','4'),
(234,1,'03:00 PM','4'),
(235,1,'03:30 PM','4'),
(236,1,'04:00 PM','4'),
(237,1,'04:30 PM','4'),
(238,1,'05:00 PM','4'),
(239,1,'05:30 PM','4'),
(240,1,'06:00 PM','4'),
(241,1,'06:30 PM','4'),
(242,1,'07:00 PM','4'),
(243,1,'08:00 PM','4'),
(244,1,'08:30 PM','4'),
(245,1,'09:00 PM','4'),
(248,1,'09:00 AM','11'),
(249,1,'09:30 AM','11'),
(250,1,'10:00 AM','11'),
(251,1,'10:30 AM','11'),
(252,1,'11:00 AM','11'),
(253,1,'11:30 AM','11'),
(254,1,'12:00 PM','11'),
(255,1,'12:30 PM','11'),
(256,1,'06:30 PM','11'),
(257,1,'08:00 PM','11');

/*Table structure for table `tbl_user_data` */

DROP TABLE IF EXISTS `tbl_user_data`;

CREATE TABLE `tbl_user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `business_name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `usergroup` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `website` varchar(500) NOT NULL,
  `contact` varchar(500) NOT NULL,
  `bio` varchar(2000) NOT NULL,
  `parent_id` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `roles_name` varchar(200) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_user_data` */

insert  into `tbl_user_data`(`id`,`store_id`,`first_name`,`last_name`,`username`,`password`,`business_name`,`address`,`city`,`state`,`logo`,`usergroup`,`email`,`website`,`contact`,`bio`,`parent_id`,`store`,`userid`,`roles_name`,`create_date`) values 
(1,1,'Akshay','Kadam','akshay','Adid@s123','Akshay Salon','Shop No 5 (Virar)','Virar','Maharashtra','e5d67599bbb698e0cb7ec7a0713419e2.jpg','Other shops','','','9637345999','','0','1','1','superadmin','0000-00-00'),
(2,1,'Amit','Singh','amit','123456','Akshay Salon','Ghaziabad','Noida','Uttar Pradesh','','Salon/Spa','amit.mcp100@gmail.com','','8750366752','','1','1','2','1','2019-12-18'),
(12,2,'Loire wellnesss','','loiretech','123456','Loire wellnesss','','','','','','amit.mcp100@gmail.com','','8750366753','','0','','','superadmin','2019-12-18');

/*Table structure for table `tbl_user_group` */

DROP TABLE IF EXISTS `tbl_user_group`;

CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` varchar(100) NOT NULL,
  `parent_id` varchar(100) NOT NULL,
  `child_id` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `tiny_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_user_group` */

insert  into `tbl_user_group`(`id`,`store_id`,`parent_id`,`child_id`,`sender_id`,`tiny_url`) values 
(1,'1','0','1','AKSHAY','https://tinyurl.com/yxhchl5d'),
(2,'1','1','2','AKSHAY','https://tinyurl.com/y6ql3sen'),
(12,'2','0','12','Loire wellnesss','https://tinyurl.com/y6ql3sen');

/*Table structure for table `tbl_user_roles` */

DROP TABLE IF EXISTS `tbl_user_roles`;

CREATE TABLE `tbl_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `role_name` varchar(500) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `add_customer` varchar(100) NOT NULL,
  `add_campaign` varchar(100) NOT NULL,
  `all_campaign` varchar(100) NOT NULL,
  `all_sub_user` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `anniversary` varchar(100) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `loyality` varchar(100) NOT NULL,
  `lost_business` varchar(100) NOT NULL,
  `packages` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_user_roles` */

insert  into `tbl_user_roles`(`id`,`store_id`,`role_name`,`customer`,`add_customer`,`add_campaign`,`all_campaign`,`all_sub_user`,`birthday`,`anniversary`,`feedback`,`loyality`,`lost_business`,`packages`,`user_id`,`store`,`create_date`,`status`) values 
(1,1,'Manager','on','on','on','on','on','on','on','on','on','on','on','','2','2019-06-17','enabled');

/*Table structure for table `whatsapp_report` */

DROP TABLE IF EXISTS `whatsapp_report`;

CREATE TABLE `whatsapp_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `message` varchar(5000) NOT NULL,
  `mes_type` varchar(500) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `whatsapp_report` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
