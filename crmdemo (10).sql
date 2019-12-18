-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2019 at 12:49 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crmdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `creditsms`
--

CREATE TABLE `creditsms` (
  `id` int(11) NOT NULL,
  `total_sms_purchased` varchar(500) NOT NULL,
  `available_sms` varchar(500) NOT NULL,
  `used_sms` varchar(500) NOT NULL,
  `buy_sms_credit` varchar(500) NOT NULL,
  `store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `creditsms`
--

INSERT INTO `creditsms` (`id`, `total_sms_purchased`, `available_sms`, `used_sms`, `buy_sms_credit`, `store`) VALUES
(1, '12000', '11748', '252', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `loyality_setting`
--

CREATE TABLE `loyality_setting` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `loyality_expiry` varchar(200) NOT NULL,
  `min_points` varchar(200) NOT NULL,
  `max_points` varchar(200) NOT NULL,
  `rupee_value` varchar(200) NOT NULL,
  `loyality_points` varchar(255) NOT NULL,
  `loyality_point_earn` varchar(200) NOT NULL,
  `t_sale` varchar(200) NOT NULL,
  `store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loyality_setting`
--

INSERT INTO `loyality_setting` (`id`, `status`, `loyality_expiry`, `min_points`, `max_points`, `rupee_value`, `loyality_points`, `loyality_point_earn`, `t_sale`, `store`) VALUES
(1, 'yes', '90', '700', '5000', '1', '500', '1', 'Percent', '1');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`mod_modulegroupcode`, `mod_modulegroupname`, `mod_modulecode`, `mod_modulename`, `mod_modulegrouporder`, `mod_moduleorder`, `mod_modulepagename`) VALUES
('CHECKOUT', 'Checkout', 'PAYMENT', 'Payment', 3, 2, 'payment.php'),
('CHECKOUT', 'Checkout', 'SHIPPING', 'Shipping', 3, 1, 'shipping.php'),
('CHECKOUT', 'Checkout', 'TAX', 'Tax', 3, 3, 'tax.php'),
('INVT', 'Inventory', 'PURCHASES', 'Purchases', 2, 1, 'purchases.php'),
('INVT', 'Inventory', 'SALES', 'Sales', 2, 3, 'sales.php'),
('INVT', 'Inventory', 'STOCKS', 'Stocks', 2, 2, 'stocks.php');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_rolecode`, `role_rolename`) VALUES
('ADMIN', 'Administrator'),
('SUPERADMIN', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_rights`
--

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_rights`
--

INSERT INTO `role_rights` (`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`) VALUES
('ADMIN', 'PAYMENT', 'no', 'no', 'no', 'yes'),
('ADMIN', 'PURCHASES', 'yes', 'yes', 'yes', 'yes'),
('ADMIN', 'SALES', 'no', 'no', 'no', 'no'),
('ADMIN', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('ADMIN', 'STOCKS', 'no', 'no', 'no', 'yes'),
('ADMIN', 'TAX', 'no', 'no', 'no', 'no'),
('SUPERADMIN', 'PAYMENT', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'PURCHASES', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'SALES', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'STOCKS', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'TAX', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `smstemplates`
--

CREATE TABLE `smstemplates` (
  `id` int(11) NOT NULL,
  `message_type` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smstemplates`
--

INSERT INTO `smstemplates` (`id`, `message_type`, `message`, `store`) VALUES
(1, 'Add Customer', 'Dear customer_name , Thanks for visiting at retailer_name ,we value your visit Have a Great Day Ahead Thanks', '0'),
(2, 'Enquiry', 'Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact retailer_number Thanks', '0'),
(3, 'Loyality', 'Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Thank', '0'),
(4, 'Birthday', 'Dear customer_name , We vish you a very Happy Birthday from retailer_name Team Thanks', '0'),
(5, 'Anniversary', 'Dear customer_name, we wish you a very Happy Anniversary. Best regards from retailer_name  !!!', '0'),
(8, 'Lost', 'Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact Us Thanks', '0'),
(9, 'Add Customer', 'Dear customer_name , Thanks for visiting at retailer_name ,we value your visit Have a Great Day Ahead Thanks', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sms_report`
--

CREATE TABLE `sms_report` (
  `id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `mobile` text NOT NULL,
  `from_date` varchar(500) NOT NULL,
  `to_date` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `operator` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `send` varchar(500) NOT NULL,
  `update_on` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_report`
--

INSERT INTO `sms_report` (`id`, `message`, `mobile`, `from_date`, `to_date`, `state`, `operator`, `status`, `send`, `update_on`) VALUES
(3, 'hello porash ..........this is test demo', '8218490671', '2019-10-09', '2019-10-09', '1', 'operator', 'active', 'yes', 'on'),
(4, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9044535598', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(5, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9044535598', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(6, 'hello porash 15 oct........................!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(7, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(8, ' Please Give feedback https://tinyurl.com/y6ql3sen!', '8077186580', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(9, 'hello guddu .................!', '8077186580', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(10, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(11, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(12, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(13, ' Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-15', '2019-10-15', '1', 'operator', 'active', 'yes', 'on'),
(14, 'Dear demo16 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-16', '2019-10-16', '1', 'operator', 'active', 'yes', 'on'),
(15, 'Dear demo16 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-16', '2019-10-16', '1', 'operator', 'active', 'yes', 'on'),
(16, 'Dear demo test 16 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-16', '2019-10-16', '1', 'operator', 'active', 'yes', 'on'),
(17, 'Dear Rishi , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9044535598', '2019-10-18', '2019-10-18', '1', 'operator', 'active', 'yes', 'on'),
(18, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-18', '2019-10-18', '1', 'operator', 'active', 'yes', 'on'),
(19, 'hello', '9044535598,8218490671', '2019-10-18', '2019-10-18', '1', 'operator', 'active', 'yes', 'on'),
(20, 'Dear guddu 18 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8077186580', '2019-10-18', '2019-10-18', '1', 'operator', 'active', 'yes', 'on'),
(21, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-19', '2019-10-19', '1', 'operator', 'active', 'yes', 'on'),
(22, 'Dear porash , Thanks for Inquiring at Loire Technologies , we look forward to you Thank', '8218490671', '2019-10-19', '2019-10-19', '1', 'operator', 'active', 'yes', 'on'),
(23, 'hello', '8077186580,8218490671', '2019-10-19', '2019-10-19', '1', 'operator', 'active', 'yes', 'on'),
(24, 'Dear mani , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '7777555332', '2019-10-19', '2019-10-19', '1', 'operator', 'active', 'yes', 'on'),
(25, 'Dear demo16 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-19', '2019-10-19', '1', 'operator', 'active', 'yes', 'on'),
(26, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(27, 'Dear porash 2 , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(28, 'Dear anil , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(29, 'Dear guddu , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8077186580', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(30, 'Dear guddu 2 , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8077186580', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(31, 'Dear Rishi , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-21', '2019-10-21', '1', 'operator', 'active', 'yes', 'on'),
(32, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(33, 'Dear mani , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(34, 'Dear demo 22 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '7777555332', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(35, 'Dear rishi , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9090909090', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(36, 'Dear inder , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8888888888', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(37, 'Dear guddu 22 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8077186580', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(38, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(39, 'Dear Rishi , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(40, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(41, 'Dear Rishi , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-22', '2019-10-22', '1', 'operator', 'active', 'yes', 'on'),
(42, 'Dear anil , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '5656565656', '2019-10-23', '2019-10-23', '1', 'operator', 'active', 'yes', 'on'),
(43, 'Dear zubaria , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '6688899999', '2019-10-23', '2019-10-23', '1', 'operator', 'active', 'yes', 'on'),
(44, 'Dear porash , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '8218490671', '2019-10-24', '2019-10-24', '1', 'operator', 'active', 'yes', 'on'),
(45, 'Dear anil , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '9873492868', '2019-10-24', '2019-10-24', '1', 'operator', 'active', 'yes', 'on'),
(46, 'Dear demo 24 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '7777777777', '2019-10-24', '2019-10-24', '1', 'operator', 'active', 'yes', 'on'),
(47, 'Dear demo25 oct , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '5555555555', '2019-10-24', '2019-10-24', '1', 'operator', 'active', 'yes', 'on'),
(48, 'Dear deepak , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '1212121212', '2019-10-24', '2019-10-24', '1', 'operator', 'active', 'yes', 'on'),
(49, 'Dear kkll , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '7777999000', '2019-10-25', '2019-10-25', '1', 'operator', 'active', 'yes', 'on'),
(50, 'Dear sssss , Thanks for visiting at Loire Technologies ,we value your visit Have a Great Day Ahead Thanks Please Give feedbackhttps://tinyurl.com/y6ql3sen!', '1919191919', '2019-10-25', '2019-10-25', '1', 'operator', 'active', 'yes', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL,
  `u_storeid` varchar(100) NOT NULL,
  `reguser_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`u_userid`, `u_username`, `u_password`, `u_rolecode`, `u_storeid`, `reguser_id`) VALUES
(1, 'admin', '12345678', 'SUPERADMIN', '1', '1'),
(2, 'sales123', '123456', 'ADMIN', '1', '2'),
(3, 'sales123', '123456', 'ADMIN', '1', '3'),
(4, 'sales123', '123456', 'ADMIN', '1', '4'),
(5, 'sales123', '123456', 'ADMIN', '1', '5'),
(16, 'sales12345', '12345', 'ADMIN', '1', '16'),
(17, 'demo', '0000', 'ADMIN', '1', '17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appoinment`
--

CREATE TABLE `tbl_appoinment` (
  `id` int(11) NOT NULL,
  `services` varchar(2000) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `time_slot` varchar(500) NOT NULL,
  `c_name` varchar(500) NOT NULL,
  `c_mobile` varchar(500) NOT NULL,
  `c_email` varchar(500) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_appoinment`
--

INSERT INTO `tbl_appoinment` (`id`, `services`, `emp_id`, `time_slot`, `c_name`, `c_mobile`, `c_email`, `c_address`, `date`) VALUES
(2, 'a:2:{i:0;s:10:"Hair Cut|1";i:1;s:11:"Hair Wash|1";}', '4', '10:00 AM', 'Yogesh', '8826126027', 'er.yogesh31@gmail.com', 'ddff', '2019-08-27'),
(3, 'a:2:{i:0;s:10:"Hair Cut|3";i:1;s:11:"Hair Wash|4";}', '4', '11:00 AM', 'Manish', '8826126027', 'manish@loiretechnologies.com', '', '2019-08-27'),
(4, 'a:2:{i:0;s:8:"Facial|1";i:1;s:15:"Eye Bro Thred|2";}', '4', '09:00 PM', 'Rishi', '8826126027', 'rishi@loiretechnologies.com', 'gzb', '2019-08-27'),
(5, 'a:1:{i:0;s:8:"Facial|3";}', '4', '08:00 PM', 'Rishi verma', '9044535598', 'rishiverma973@gmail.com', 'phagwara punjab', '2019-08-27'),
(6, 'a:1:{i:0;s:8:"Facial|3";}', '4', '08:00 PM', 'yogesh', '8826126027', '', '', '2019-08-27'),
(7, 'a:1:{i:0;s:11:"Hair Wash|2";}', '7', '07:00 PM', 'sujitbose89@gmail.com', '8130901569', '', '', '2019-08-27'),
(8, 'a:2:{i:0;s:11:"Hair Wash|1";i:1;s:15:"Eye Bro Thred|1";}', '6', '09:00 AM', 'Gyanendra', '7834976709', '', '', '2019-08-27'),
(9, 'a:2:{i:0;s:8:"Facial|1";i:1;s:11:"Hair Wash|1";}', '6', '09:00 AM', 'Shambhu', '8010353279', '', '', '2019-08-28'),
(10, 'a:2:{i:0;s:8:"Facial|1";i:1;s:11:"Hair Wash|1";}', '6', '09:00 AM', 'Shambhu', '8010353279', '', '', '2019-08-28'),
(11, 'a:2:{i:0;s:10:"Hair Cut|1";i:1;s:8:"Facial|1";}', '6', '09:00 AM', 'Fhj', '69632137890754321346789094432345', '', '', '2019-08-28'),
(12, 'a:3:{i:0;s:10:"Hair Cut|2";i:1;s:8:"Facial|2";i:2;s:11:"Hair Wash|1";}', '7', '04:30 PM', 'shankar mishra', '07004645230', 'shakarji2010@gmail.com', 'USB', '2019-08-30'),
(13, 'a:1:{i:0;s:8:"Facial|1";}', '7', '', 'Rishi verma', '9044535598', 'rishiverma973@gmail.com', 'phagwara punjab, India', '2019-08-30'),
(14, 'a:1:{i:0;s:8:"Facial|1";}', '7', '', 'Rishi verma', '9044535598', 'rishiverma973@gmail.com', 'phagwara punjab, India', '2019-08-30'),
(15, 'a:2:{i:0;s:10:"Hair Cut|1";i:1;s:8:"Facial|1";}', '4', '10:30 AM', 'ambarish', '9871598291', '', '', '2019-09-03'),
(16, 'a:2:{i:0;s:34:"Hair Cut & Style Beard Trimming |1";i:1;s:45:"Hair Cut & Style Female Hair Cut & Blow-Dry|1";}', '7', '03:00 PM', 'poras', '8218490671', '', '', '2019-09-19'),
(17, 'a:3:{i:0;s:10:"Hair Cut|1";i:1;s:8:"Facial|1";i:2;s:66:"Beauty Body Wax Full Arms + Full Legs + Underarms Deluxe For Him|1";}', '', '', '', '90666666666666', '', '', '2019-09-19'),
(18, 'a:1:{i:0;s:10:"Hair Cut|1";}', '7', '08:00 PM', 'wqeqe', '5543453453', 'porashpandit001@gmail.com', 'noida', '2019-09-24'),
(19, 'a:1:{i:0;s:47:"Hair Cut & Style Children Hair Cut (Under 10)|1";}', '7', '', 'jjjjjj', '9879879870', 'jjj@gmail.com', 'delhi001', '2019-09-24'),
(20, 'a:1:{i:0;s:34:"Hair Cut & Style Beard Trimming |1";}', '4', '04:00 PM', 'werewr', '5454545454', 'werewr@gmail.com', 'delhi0009', '2019-09-24'),
(21, 'a:3:{i:0;s:10:"Hair Cut|1";i:1;s:8:"Facial|1";i:2;s:11:"Hair Wash|1";}', '9', '04:30 PM', 'demooooo', '98765433334', 'demoooo@gmail.com', 'demoooo', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_campaign`
--

CREATE TABLE `tbl_campaign` (
  `id` int(11) NOT NULL,
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
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_campaign`
--

INSERT INTO `tbl_campaign` (`id`, `campaign_category`, `campaign_name`, `campaign_sms`, `customer_category`, `customer_group`, `campaign_before`, `date_time`, `store`, `userid`, `create_date`, `last_run_date`, `status`) VALUES
(1, 'custom', 'Welcome Campaign', 'Dear Customer,Thanks for associate with Loire Technologies ,we value your association Have a Great Day Ahead Thanks', 'customer', '', 'Select Option', '2019-08-13 11:11:00', '1', '1', '2019-08-13', '0000-00-00', 'enabled'),
(3, 'regain_lost_business', 'Indpendence', 'Massage service & hair spa @1199', 'customer', 'Default', 'Select Option', '2019-08-14 11:26:00', '1', '1', '2019-08-14', '0000-00-00', 'enabled'),
(4, 'loyalty', 'Loyty', 'Dear Customer, you have 1008 point. Come and redeem it. ', 'customer', 'Prime', 'Select Option', '2019-08-25 07:19:00', '1', '1', '2019-08-24', '0000-00-00', 'enabled'),
(5, 'custom', 'diwali', 'hello', 'enquiry', 'Prime', 'Select Option', '2019-08-27 21:59:00', '1', '1', '2019-08-27', '0000-00-00', 'enabled'),
(6, 'custom', 'diwali', 'hello', 'customer', '', 'Select Option', '2019-09-20 23:59:00', '1', '1', '2019-09-19', '0000-00-00', 'enabled'),
(7, 'birthday', 'demo birthday', 'hello campaign', 'enquiry', 'Platinum', '9', '2019-09-18 12:00:00', '1', '1', '2019-09-25', '0000-00-00', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_data`
--

CREATE TABLE `tbl_customer_data` (
  `id` int(11) NOT NULL,
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
  `c_source` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_data`
--

INSERT INTO `tbl_customer_data` (`id`, `mobile`, `name`, `email`, `anniversary`, `dob`, `employee`, `amount`, `customer_group`, `comment`, `reminder`, `store`, `userid`, `address`, `nu_visit`, `last_visit_date`, `c_date`, `c_source`) VALUES
(157, '8218490671', 'porash', 'porashpandit001@gmail.com', '0000-00-00', '0000-00-00', 'guddu', '12300', 'Exitica', 'hello guddu......................!', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(158, '9873492868', 'anil', 'anil@gmail.com', '0000-00-00', '0000-00-00', 'Monika ', '2200', '', 'hello anil..................!', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(159, '7777777777', 'demo 24 oct', 'demo24@gmail.com', '0000-00-00', '0000-00-00', 'demo employee', '4400', '', 'hello demo 24 oct.......................', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(160, '5555555555', 'demo25 oct', 'demo@gmail.com', '0000-00-00', '0000-00-00', 'yogesh kumar', '2200', '', 'hello ', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(161, '7474747474', 'gagan', 'gagan@gmail.com', '0000-00-00', '0000-00-00', 'Monika ', '5500', '', 'hello gagan', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(162, '1212121212', 'deepak', 'deepak@gmail.com', '0000-00-00', '0000-00-00', 'yogesh kumar', '55900', '', 'hello deepak', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-24', ''),
(163, '6363636363', 'demo25oct', 'demo25oct@gmail.com', '0000-00-00', '0000-00-00', 'guddu', '', '', 'hello demo25 oct', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-25', ''),
(164, '7777999000', 'kkll', 'nkjl@gmail.com', '0000-00-00', '0000-00-00', 'yogesh kumar', '2000', '', 'rewrwr', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-25', ''),
(165, '1919191919', 'sssss', 'ssss@gmail.com', '0000-00-00', '0000-00-00', 'Monika ', '1500', '', 'sssssss', 'yes', '1', '1', '', '', '0000-00-00', '2019-10-25', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_group`
--

CREATE TABLE `tbl_customer_group` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_group`
--

INSERT INTO `tbl_customer_group` (`id`, `name`, `description`, `status`, `store`, `userid`) VALUES
(1, 'Default', 'Default', 'enabled', '1', '1'),
(2, 'Platinum', 'Platinum', 'enabled', '1', '1'),
(3, 'Gold', 'Gold', 'enabled', '1', '1'),
(5, 'Silver', 'Silver', 'enabled', '1', '1'),
(6, 'Bronze', 'Bronze', 'enabled', '1', '1'),
(7, 'Loyal', 'regular customers', 'enabled', '1', '1'),
(8, 'Prime', 'Prime', 'enabled', '1', '1'),
(9, 'Exitica', 'Exitica', 'enabled', '1', '1'),
(10, 'Greater Noida', 'local', 'enabled', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_purchase`
--

CREATE TABLE `tbl_customer_purchase` (
  `id` int(11) NOT NULL,
  `c_id` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `services` varchar(100) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_purchase`
--

INSERT INTO `tbl_customer_purchase` (`id`, `c_id`, `store`, `mobile`, `amount`, `services`, `payment_mode`, `comment`, `date`) VALUES
(224, '157', '1', '8218490671', '12300', 'Hair Wash', '', 'hello guddu......................!', '2019-10-24'),
(225, '158', '1', '9873492868', '2200', 'Eye Bro Thred', '', 'hello anil..................!', '2019-10-24'),
(226, '159', '1', '7777777777', '4400', 'Hair Care Loreal Spa ', '', 'hello demo 24 oct.......................', '2019-10-24'),
(227, '160', '1', '5555555555', '2200', 'Hair Care Powder Mix Color Lock', '', 'hello ', '2019-10-24'),
(228, '161', '1', '7474747474', '5500', 'Hair Cut & Style Ironing ', '', 'hello gagan', '2019-10-24'),
(229, '162', '1', '1212121212', '55900', 'Hair Wash', '', 'hello deepak', '2019-10-24'),
(230, '164', '1', '7777999000', '2000', 'Make Up Bridal Make Up ', 'wallet', 'rewrwr', '2019-10-25'),
(231, '165', '1', '1919191919', '1500', 'Hair Color Highlights - Crown Matrix ', '', 'sssssss', '2019-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_source`
--

CREATE TABLE `tbl_customer_source` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_source`
--

INSERT INTO `tbl_customer_source` (`id`, `name`, `description`, `status`, `store`, `userid`) VALUES
(1, 'Friends', 'Friends', 'enabled', '1', '1'),
(3, 'Google Search', 'Google Search', 'enabled', '1', '1'),
(4, 'Social Media', 'Social Media', 'enabled', '1', '1'),
(5, 'Direct Walkin', 'Direct Walkin', 'enabled', '1', '1'),
(6, 'Others', 'Others', 'enabled', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `pic` varchar(500) NOT NULL,
  `e_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `designation`, `pic`, `e_date`) VALUES
(4, 'yogesh kumar', 'developer', 'aad6e37210f93abdf214e4685747f928.jpg', '2019-08-22'),
(6, 'Monika ', 'Content writer', '1a6c17caee51138f57794b9d6e5e4d57.jpg', '2019-08-27'),
(7, 'guddu', 'Developer', '787a355286ceba45a760a44f9bd5ad66.jpg', '2019-08-27'),
(9, 'demo employee', 'demo designation', '8762d2f9ea7fa5b9fccac6c987320000.jpg', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mode` varchar(500) NOT NULL,
  `service` varchar(500) NOT NULL,
  `anniversary` date NOT NULL,
  `dob` date NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `date` date NOT NULL,
  `read` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `mobile`, `name`, `mode`, `service`, `anniversary`, `dob`, `comment`, `date`, `read`) VALUES
(1, '8826126027', 'Yogesh', 'Good', '', '0000-00-00', '0000-00-00', 'Good Services', '2019-08-06', 'yes'),
(2, '8077186580', 'Guddu', 'Good', '', '0000-00-00', '0000-00-00', 'Good Services', '2019-08-06', 'yes'),
(4, '9044535598', 'Rishi', 'Good', '', '0000-00-00', '0000-00-00', 'Good Services', '2019-08-06', 'yes'),
(5, '9711258868', 'Debashish', 'Good', '', '0000-00-00', '0000-00-00', 'Nice Work', '2019-08-06', 'yes'),
(6, '8826126027', 'yogesh kumar', 'Excellent', '', '0000-00-00', '0000-00-00', 'Nice ', '2019-08-06', 'yes'),
(7, '9711259968', 'Debashish', 'Excellent', '', '0000-00-00', '0000-00-00', '', '2019-08-06', 'yes'),
(8, '7834976709', 'Gyan', 'Excellent', '', '0000-00-00', '0000-00-00', 'Very Nice', '2019-08-09', 'yes'),
(9, '7834976709', 'Gyan', 'Excellent', '', '0000-00-00', '0000-00-00', 'Very Nice', '2019-08-09', 'yes'),
(10, '7042347875', 'Komal', 'Excellent', '', '0000-00-00', '0000-00-00', 'It was good ', '2019-08-12', 'yes'),
(11, '8130457937', 'Manish', 'Excellent', '', '0000-00-00', '0000-00-00', 'Good Services', '2019-08-13', 'yes'),
(12, '7387882220', 'Vipul Singhal', 'Excellent', '', '0000-00-00', '0000-00-00', '', '2019-08-14', 'yes'),
(13, '7834976708', 'Gyan', 'Poor', '', '0000-00-00', '0000-00-00', 'Very bad service', '2019-08-27', 'yes'),
(14, '8010353279', 'Shambhu', 'Average', '', '0000-00-00', '0000-00-00', 'Yo', '2019-08-27', 'yes'),
(15, '9304960078', 'Monika', 'Excellent', '', '0000-00-00', '0000-00-00', 'Great services', '2019-08-27', 'yes'),
(16, '9304960078', 'Monika', 'Excellent', '', '0000-00-00', '0000-00-00', '', '2019-08-27', 'yes'),
(17, '6383737383877378383', 'Viru', 'Poor', '', '0000-00-00', '0000-00-00', 'Poor', '2019-08-28', 'yes'),
(18, '9368236959', 'Fg', 'Poor', '', '0000-00-00', '0000-00-00', 'Fhjk', '2019-09-06', 'yes'),
(19, '9045290935', 'Subhan', 'Excellent', '', '0000-00-00', '0000-00-00', 'Gud', '2019-09-12', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedbacksetting`
--

CREATE TABLE `tbl_feedbacksetting` (
  `id` int(11) NOT NULL,
  `feedback_value` varchar(500) NOT NULL,
  `store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_feedbacksetting`
--

INSERT INTO `tbl_feedbacksetting` (`id`, `feedback_value`, `store`) VALUES
(1, 'every', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loyality`
--

CREATE TABLE `tbl_loyality` (
  `id` int(100) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `c_id` varchar(100) NOT NULL,
  `available_points` varchar(100) NOT NULL,
  `used_points` varchar(100) NOT NULL,
  `mobile` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_loyality`
--

INSERT INTO `tbl_loyality` (`id`, `amount`, `c_id`, `available_points`, `used_points`, `mobile`) VALUES
(49, '12300', '157', '24.6', '0', '8218490671'),
(50, '2200', '158', '4.4', '0', '9873492868'),
(51, '4400', '159', '8.8', '0', '7777777777'),
(52, '2200', '160', '4.4', '0', '5555555555'),
(53, '5500', '161', '11', '0', '7474747474'),
(54, '55900', '162', '111.8', '0', '1212121212'),
(55, '2000', '164', '4', '0', '7777999000'),
(56, '1500', '165', '3', '0', '1919191919');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(1000) NOT NULL,
  `package_price` varchar(200) NOT NULL,
  `package_expiry` varchar(200) NOT NULL,
  `package_days` varchar(200) NOT NULL,
  `create_date` date NOT NULL,
  `services` varchar(2000) NOT NULL,
  `store` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `package_name`, `package_price`, `package_expiry`, `package_days`, `create_date`, `services`, `store`) VALUES
(1, 'Rakhi', '4999', '2', 'Months', '2019-08-12', 'a:3:{i:0;a:2:{s:8:"services";s:4:"Padi";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:4:"Medi";s:11:"package_qty";s:1:"2";}i:2;a:2:{s:8:"services";s:7:"Cutting";s:11:"package_qty";s:1:"2";}}', '1'),
(2, 'Offer1499', '1499', '30', 'Days', '2019-08-13', 'a:4:{i:0;a:2:{s:8:"services";s:4:"Padi";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:4:"Medi";s:11:"package_qty";s:1:"1";}i:2;a:2:{s:8:"services";s:7:"Cutting";s:11:"package_qty";s:1:"2";}i:3;a:2:{s:8:"services";s:12:"Lotus Facial";s:11:"package_qty";s:1:"1";}}', '1'),
(3, 'offer freedom', '999', '10', 'Days', '2019-08-13', 'a:2:{i:0;a:2:{s:8:"services";s:12:"Lotus Facial";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:7:"Cutting";s:11:"package_qty";s:1:"1";}}', '1'),
(4, 'Dhamka', '5999', '3', 'Months', '2019-08-20', 'a:1:{i:0;a:2:{s:8:"services";s:8:"menicure";s:11:"package_qty";s:2:"10";}}', '1'),
(5, 'Dhamka 2 offer', '5999', '3', 'Months', '2019-08-22', 'a:3:{i:0;a:2:{s:8:"services";s:4:"Padi";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:4:"Medi";s:11:"package_qty";s:1:"2";}i:2;a:2:{s:8:"services";s:7:"Cutting";s:11:"package_qty";s:1:"2";}}', '1'),
(6, 'nilu999', '999', '30', 'Days', '2019-08-27', 'a:4:{i:0;a:2:{s:8:"services";s:8:"Hair Cut";s:11:"package_qty";s:1:"1";}i:1;a:2:{s:8:"services";s:8:"menicure";s:11:"package_qty";s:1:"2";}i:2;a:2:{s:8:"services";s:13:"Eye Bro Thred";s:11:"package_qty";s:1:"1";}i:3;a:2:{s:8:"services";s:12:"Lotus Facial";s:11:"package_qty";s:1:"1";}}', '1'),
(7, 'teez spcl pack.', '2999', '3', 'Months', '2019-09-03', 'a:2:{i:0;a:2:{s:8:"services";s:9:"Hair Wash";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:24:"Hair Cut & Style Blowdry";s:11:"package_qty";s:1:"2";}}', '1'),
(8, '1599', '1599', '3', 'Months', '2019-09-15', 'a:2:{i:0;a:2:{s:8:"services";s:8:"Hair Cut";s:11:"package_qty";s:1:"1";}i:1;a:2:{s:8:"services";s:21:"Hair Care Loreal Spa ";s:11:"package_qty";s:1:"2";}}', '1'),
(9, 'xz', '5999', '2', 'Months', '2019-09-17', 'a:2:{i:0;a:2:{s:8:"services";s:6:"Facial";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:13:"Eye Bro Thred";s:11:"package_qty";s:1:"2";}}', '1'),
(10, 'Abcd', '5999', '2', 'Months', '2019-09-18', 'a:3:{i:0;a:2:{s:8:"services";s:6:"Facial";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:9:"Hair Wash";s:11:"package_qty";s:1:"2";}i:2;a:2:{s:8:"services";s:32:"Hair Cut & Style Beard Trimming ";s:11:"package_qty";s:1:"2";}}', '1'),
(11, 'HappyDiwali@999', '999', '30', 'Days', '2019-09-19', 'a:3:{i:0;a:2:{s:8:"services";s:9:"Hair Wash";s:11:"package_qty";s:1:"2";}i:1;a:2:{s:8:"services";s:31:"Hair Cut & Style Male Hair Cut ";s:11:"package_qty";s:1:"1";}i:2;a:2:{s:8:"services";s:39:"Hair Cut & Style Tongs, Ringlets, Irons";s:11:"package_qty";s:1:"3";}}', '1'),
(12, 'demo package', '009990', '9', 'Days', '2019-09-25', 'N;', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package_otp`
--

CREATE TABLE `tbl_package_otp` (
  `id` int(11) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `store` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_package_otp`
--

INSERT INTO `tbl_package_otp` (`id`, `mobile`, `otp`, `create_date`, `store`, `status`) VALUES
(1, '7042347875', '733088', '2019-08-12', '1', '0'),
(2, '7042347875', '488252', '2019-08-12', '1', '0'),
(3, '7042347875', '897416', '2019-08-12', '1', '0'),
(4, '7011355594', '196125', '2019-08-12', '1', '0'),
(5, '7011734031', '39167 ', '2019-08-13', '1', '0'),
(6, '7011734031', '916667', '2019-08-13', '1', '0'),
(7, '9044535598', '208208', '2019-08-13', '1', '0'),
(8, '9044535598', '332610', '2019-08-13', '1', '0'),
(9, '9044535598', '295764', '2019-08-13', '1', '0'),
(10, '9044535598', '966046', '2019-08-13', '1', '0'),
(11, '9044535598', '985787', '2019-08-13', '1', '0'),
(12, '9044535598', '804553', '2019-08-13', '1', 'yes'),
(13, '9044535598', '732881', '2019-08-13', '1', 'yes'),
(14, '7709259516', '792964', '2019-08-13', '1', '0'),
(15, '7709259516', '728403', '2019-08-13', '1', 'yes'),
(16, '7387882220', '593198', '2019-08-14', '1', 'yes'),
(17, '6398179596', '845313', '2019-08-20', '1', 'yes'),
(18, '9873509228', '125642', '2019-08-22', '1', 'yes'),
(19, '9711781761', '14057 ', '2019-08-23', '1', '0'),
(20, '9711781761', '667117', '2019-08-23', '1', 'yes'),
(21, '9873649545', '283850', '2019-08-24', '1', '0'),
(22, '9650136270', '845869', '2019-08-24', '1', 'yes'),
(23, '9210056111', '110191', '2019-08-27', '1', 'yes'),
(24, '9304960078', '96564 ', '2019-08-27', '1', '0'),
(25, '9304960078', '972371', '2019-08-27', '1', 'yes'),
(26, '6394386586', '245494', '2019-09-03', '1', 'yes'),
(27, '8707779365', '855308', '2019-09-09', '1', 'yes'),
(28, '9811862160', '393358', '2019-09-11', '1', 'yes'),
(29, '9045290935', '374850', '2019-09-12', '1', 'yes'),
(30, '9810712506', '896987', '2019-09-15', '1', 'yes'),
(31, '8979777777', '187461', '2019-09-17', '1', 'yes'),
(32, '9811819434', '308082', '2019-09-18', '1', 'yes'),
(33, '8218590671', '663607', '2019-09-19', '1', '0'),
(34, '8218490671', '1913  ', '2019-09-19', '1', '0'),
(35, '8218490671', '378784', '2019-09-26', '1', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package_services`
--

CREATE TABLE `tbl_package_services` (
  `id` int(11) NOT NULL,
  `package_id` varchar(100) NOT NULL,
  `service` varchar(1000) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_redeem_package`
--

CREATE TABLE `tbl_redeem_package` (
  `id` int(11) NOT NULL,
  `sell_pack_id` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `package` varchar(500) NOT NULL,
  `redeem_qty` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_redeem_package`
--

INSERT INTO `tbl_redeem_package` (`id`, `sell_pack_id`, `mobile`, `package`, `redeem_qty`, `store_id`, `create_date`) VALUES
(1, '4', '9044535598', 'Padi', '1', '1', '2019-08-13'),
(2, '4', '9044535598', 'Medi', '1', '1', '2019-08-13'),
(3, '5', '7709259516', 'Cutting', '1', '1', '2019-08-13'),
(4, '5', '7709259516', 'Lotus Facial', '1', '1', '2019-08-13'),
(5, '5', '7709259516', 'Lotus Facial', '1', '1', '2019-08-13'),
(6, '6', '7387882220', 'Lotus Facial', '1', '1', '2019-08-14'),
(7, '7', '6398179596', 'menicure', '1', '1', '2019-08-20'),
(8, '7', '6398179596', 'menicure', '1', '1', '2019-08-20'),
(9, '8', '9873509228', 'Cutting', '1', '1', '2019-08-22'),
(10, '8', '9873509228', 'Cutting', '1', '1', '2019-08-22'),
(11, '9', '9711781761', 'Cutting', '1', '1', '2019-08-23'),
(12, '9', '9711781761', 'Cutting', '1', '1', '2019-08-23'),
(13, '11', '9650136270', 'menicure', '1', '1', '2019-08-24'),
(14, '11', '9650136270', 'menicure', '1', '1', '2019-08-24'),
(15, '12', '9210056111', 'Padi', '1', '1', '2019-08-27'),
(16, '12', '9210056111', 'Padi', '1', '1', '2019-08-27'),
(17, '13', '9304960078', 'Hair Cut', '1', '1', '2019-08-27'),
(18, '13', '9304960078', 'menicure', '1', '1', '2019-08-27'),
(19, '13', '9304960078', 'Eye Bro Thred', '1', '1', '2019-08-27'),
(20, '13', '9304960078', 'menicure', '1', '1', '2019-08-27'),
(21, '14', '6394386586', 'Hair Wash', '1', '1', '2019-09-03'),
(22, '14', '6394386586', 'Hair Wash', '1', '1', '2019-09-03'),
(23, '15', '8707779365', 'Padi', '1', '1', '2019-09-09'),
(24, '17', '9811862160', 'Padi', '1', '1', '2019-09-11'),
(25, '17', '9811862160', 'Padi', '1', '1', '2019-09-11'),
(26, '17', '9811862160', 'Medi', '1', '1', '2019-09-11'),
(27, '18', '9045290935', 'Hair Cut ', '1', '1', '2019-09-12'),
(28, '18', '9045290935', 'Hair Cut ', '1', '1', '2019-09-12'),
(29, '19', '9810712506', 'Hair Cut', '1', '1', '2019-09-15'),
(30, '19', '9810712506', 'Hair Care Loreal Spa ', '1', '1', '2019-09-15'),
(31, '20', '8979777777', 'Facial', '1', '1', '2019-09-17'),
(32, '20', '8979777777', 'Facial', '1', '1', '2019-09-17'),
(33, '21', '9811819434', 'Facial', '1', '1', '2019-09-18'),
(34, '21', '9811819434', 'Facial', '1', '1', '2019-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regain`
--

CREATE TABLE `tbl_regain` (
  `id` int(11) NOT NULL,
  `reminder` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_regain`
--

INSERT INTO `tbl_regain` (`id`, `reminder`, `duration`) VALUES
(1, '3', 'days');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminder`
--

CREATE TABLE `tbl_reminder` (
  `id` int(11) NOT NULL,
  `reminder` varchar(11) NOT NULL,
  `duration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reminder`
--

INSERT INTO `tbl_reminder` (`id`, `reminder`, `duration`) VALUES
(11, '15', 'days');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_report`
--

CREATE TABLE `tbl_sales_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `services` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales_report`
--

INSERT INTO `tbl_sales_report` (`id`, `name`, `employee`, `services`, `mobile`, `amount`, `payment_mode`, `sales_date`) VALUES
(1, 'porash', '', '', '8218490671', '31000', '', '2019-10-21'),
(2, 'porash 2', '', '', '8218490671', '44000', '', '2019-10-21'),
(3, 'anil', '', '', '8218490671', '21000', '', '2019-10-21'),
(4, 'guddu', '', '', '8077186580', '11000', '', '2019-10-21'),
(5, 'guddu 2', '', '', '8077186580', '13000', '', '2019-10-21'),
(6, 'Rishi', '', '', '9873492868', '', '', '2019-10-21'),
(7, 'porash', '', '', '8218490671', '34500', '', '2019-10-22'),
(8, 'mani', '', '', '9873492868', '6600', '', '2019-10-22'),
(9, 'demo 22 oct', '', '', '7777555332', '', '', '2019-10-22'),
(10, 'rishi', '', '', '9090909090', '19800', '', '2019-10-22'),
(11, 'inder', '', '', '8888888888', '', '', '2019-10-22'),
(12, 'guddu 22 oct', '', '', '8077186580', '4500', '', '2019-10-22'),
(13, 'porash', '', '', '8218490671', '12300', '', '2019-10-22'),
(14, 'Rishi', '', '', '9873492868', '', '', '2019-10-22'),
(15, 'porash', '', '', '8218490671', '7700', '', '2019-10-22'),
(16, 'Rishi', '', '', '9873492868', '', '', '2019-10-22'),
(17, 'demo23 oct', '', '', '7777777777', '6000', '', '2019-10-23'),
(18, 'anil', '', '', '5656565656', '', '', '2019-10-23'),
(19, 'zubaria', '', '', '6688899999', '82300', '', '2019-10-23'),
(20, 'porash', 'guddu', '', '8218490671', '12300', '', '2019-10-24'),
(21, 'anil', 'Monika ', '', '9873492868', '2200', '', '2019-10-24'),
(22, 'demo 24 oct', 'demo employee', '', '7777777777', '4400', '', '2019-10-24'),
(23, 'demo25 oct', 'yogesh kumar', 'Hair Care Powder Mix Color Lock', '5555555555', '2200', '', '2019-10-24'),
(24, 'gagan', 'Monika ', 'Hair Cut & Style Ironing ', '7474747474', '5500', '', '2019-10-24'),
(25, 'deepak', 'yogesh kumar', 'Hair Wash', '1212121212', '55900', '', '2019-10-24'),
(26, 'demo25oct', 'guddu', '', '6363636363', '', '', '2019-10-25'),
(27, 'kkll', 'yogesh kumar', 'Make Up Bridal Make Up ', '7777999000', '2000', '', '2019-10-25'),
(28, 'sssss', 'Monika ', 'Hair Color Highlights - Crown Matrix ', '1919191919', '1500', 'card', '2019-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sellpackage`
--

CREATE TABLE `tbl_sellpackage` (
  `id` int(11) NOT NULL,
  `package_id` varchar(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sellpackage`
--

INSERT INTO `tbl_sellpackage` (`id`, `package_id`, `name`, `email`, `mobile`, `create_date`, `store_id`, `userid`) VALUES
(1, '1', 'Komal', '', '7042347875', '2019-08-12', '1', '1'),
(2, '2', 'Ankit', '', '7011734031', '2019-08-13', '1', '1'),
(3, '2', 'Rishi', '', '1499', '2019-08-13', '1', '1'),
(4, '2', 'rishi', '', '9044535598', '2019-08-13', '1', '1'),
(5, '3', 'Shubham', '', '7709259516', '2019-08-13', '1', '1'),
(6, '2', 'Vipul', '', '7387882220', '2019-08-14', '1', '1'),
(7, '4', 'Arvind', '', '6398179596', '2019-08-20', '1', '1'),
(8, '5', 'Anjali sharma', '', '9873509228', '2019-08-22', '1', '1'),
(9, '5', 'Poonam', '', '9711781761', '2019-08-23', '1', '1'),
(10, '4', 'Tishar', '', '9873649545', '2019-08-24', '1', '1'),
(11, '4', 'Rammy', '', '9650136270', '2019-08-24', '1', '1'),
(12, '1', 'Nandni', '', '9210056111', '2019-08-27', '1', '1'),
(13, '6', 'monika', '', '9304960078', '2019-08-27', '1', '1'),
(14, '7', 'vikendra', '', '6394386586', '2019-09-03', '1', '1'),
(15, '2', 'Rizwan', '', '8707779365', '2019-09-09', '1', '1'),
(16, '2', 'Rizwan', '', '8707779365', '2019-09-09', '1', '1'),
(17, '2', 'Dev', '', '9811862160', '2019-09-11', '1', '1'),
(18, '7', 'shubhan', '', '9045290935', '2019-09-12', '1', '1'),
(19, '8', 'Goldy', '', '9810712506', '2019-09-15', '1', '1'),
(20, '9', 'sunny', '', '8979777777', '2019-09-17', '1', '1'),
(21, '10', 'Shubham', '', '9811819434', '2019-09-18', '1', '1'),
(22, '11', 'POras', 'porashpandit001@gmail.com', '8218490671', '2019-09-19', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(1000) NOT NULL,
  `added_date` date NOT NULL,
  `modi_date` date NOT NULL,
  `store` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `pic` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `service_name`, `added_date`, `modi_date`, `store`, `userid`, `price`, `pic`) VALUES
(1, 'Hair Cut', '2019-08-22', '2019-08-22', '1', '1', '999', 'f1e1c9c02ca7a456bc47763d7f16b3b5.jpg'),
(2, 'Facial', '2019-08-22', '2019-08-22', '1', '1', '1250', '5baadd737c30dbe46f9520f57656006b.jpg'),
(3, 'Hair Wash', '2019-08-22', '2019-08-22', '1', '1', '250', '99e6c8c96f081741acdadf4b713aa8e0.jpg'),
(4, 'Eye Bro Thred', '2019-08-22', '2019-08-22', '1', '1', '799', '82075a6e64bbe2018247fcf6806f26a7.jpg'),
(7, 'Hair Cut & Style Beard Trimming ', '2019-08-29', '2019-08-29', '1', '1', '', '23b6312a97e7e0311ecccda811200574.jpg'),
(8, 'Hair Cut & Style Female Hair Cut & Blow-Dry', '2019-08-29', '2019-08-29', '1', '1', '', 'f7b8bd26dc41712d217da92fe8bbf555.jpg'),
(9, 'Hair Cut & Style Male Hair Cut ', '2019-08-29', '2019-08-29', '1', '1', '', 'd9088b95ae3bdc2714d3c43697b0fccc.jpg'),
(10, 'Hair Cut & Style Children Hair Cut (Under 10)', '2019-08-29', '2019-08-29', '1', '1', '', 'bfd6b9650f0e203f11ae97a50ae58aa9.jpg'),
(11, 'Hair Cut & Style Shaving ', '2019-08-29', '2019-08-29', '1', '1', '', '6d0f760daa97d7af3f99402b7a9caf3f.jpg'),
(12, 'Hair Cut & Style Shaving - Whitening & Glow', '2019-08-29', '2019-08-29', '1', '1', '', 'c6d6e459b23c88c6d436d45a4a5b1dd5.jpg'),
(13, 'Hair Cut & Style Blowdry', '2019-08-29', '2019-08-29', '1', '1', '', 'e67b6a649eb6f357eb497df3446f5320.jpg'),
(14, 'Hair Cut & Style Ironing ', '2019-08-29', '2019-08-29', '1', '1', '', 'c5abe0db9e897254668ae03e23de7832.jpg'),
(15, 'Hair Cut & Style Tongs, Ringlets, Irons', '2019-08-29', '2019-08-29', '1', '1', '', 'ea5c5c40dc36293b2fd6ab36c27a1ff1.jpg'),
(16, 'Hair Cut & Style Jura / UpDo', '2019-08-29', '2019-08-29', '1', '1', '', '028f86397cbbe3d0790c93031ca426d0.jpg'),
(17, 'Hair Care Loreal Spa ', '2019-08-29', '2019-08-29', '1', '1', '', '1ccf63240adad631e44e8cafb7a9c42c.jpg'),
(18, 'Hair Care Hair Spa Treatment ', '2019-08-29', '2019-08-29', '1', '1', '', '2ffa5d572d63f67993d4903f8138ea60.jpg'),
(19, 'Hair Care Hair Spa With Scalp Treatment  ', '2019-08-29', '2019-08-29', '1', '1', '', '8ad98ca91f8ad9678f315d68d8dee979.jpg'),
(20, 'Hair Care Loreal Expert Treatment ', '2019-08-29', '2019-08-29', '1', '1', '', '0c2ce17020eb832e3bdeda60c8637724.jpg'),
(21, 'Hair Care Lipidium Primer ', '2019-08-29', '2019-08-29', '1', '1', '', '236ffcb4923cecd3a39a51bd5a3cbccc.jpg'),
(22, 'Hair Care Lipidium Powder Mix ', '2019-08-29', '2019-08-29', '1', '1', '', '326c85f0556cf5596a0ecf8d6112889e.jpg'),
(23, 'Hair Care Powder Mix Color Lock', '2019-08-29', '2019-08-29', '1', '1', '', '59df57782f098b8dc84b3efe9aa35f20.jpg'),
(24, 'Hair Care Matrix Spa ', '2019-08-29', '2019-08-29', '1', '1', '', 'c5172345ec3467ad2651537b93243e30.jpg'),
(26, 'Hair Care Matrix Spa Biolage - Smooth Proof', '2019-08-30', '2019-08-30', '1', '1', '', 'd9c30293058609e7c9a857618a88ee28.jpg'),
(27, 'Hair Care Matrix Advance Treatment Biolage Opti Straight ', '2019-08-30', '2019-08-30', '1', '1', '', '013b529c082846b6fdfd92f1494d418b.jpg'),
(28, 'Hair Care Matrix Advance Treatment Biolage Fibre Strong', '2019-08-30', '2019-08-30', '1', '1', '', '86edbe378cb4ecdce47d7e08b6296131.jpg'),
(29, 'Hair Straightening Keratin (Protein Treatment)', '2019-08-30', '2019-08-30', '1', '1', '', 'a94a275ca37a92d08c5049d49ff6b116.jpg'),
(59, 'Make Up Saree Drapping ', '2019-08-30', '2019-08-30', '1', '1', '', 'bc79fa439824ad8dea5bb04b745fd46c.jpg'),
(60, 'Make Up Male Make Up ', '2019-08-30', '2019-08-30', '1', '1', '', '4851da044e51cd09bda6a32059867bd0.jpg'),
(61, 'Make Up Eye Up', '2019-08-30', '2019-08-30', '1', '1', '', 'ed2d71e0620283fd821a01252421e538.jpg'),
(62, 'Make Up Light Make Up ', '2019-08-30', '2019-08-30', '1', '1', '', 'd6f6fef4d3f84ff36944954dfca8d17e.jpg'),
(63, 'Make Up Occasional Make Up  ', '2019-08-30', '2019-08-30', '1', '1', '', '0f9e8dc399f160c06987fc35643b5f5f.jpg'),
(64, 'Make Up Bridal Make Up ', '2019-08-30', '2019-08-30', '1', '1', '', '120eec5a83393b155d8e792fe627897d.jpg'),
(65, 'Hair Straightening Keratin (Protein Treatment) Smoothening Loreal', '2019-08-30', '2019-08-30', '1', '1', '', 'a009bad2c2fcb51230f1ebebf9aa1aab.jpg'),
(66, 'Hair Straightening Keratin (Protein Treatment) Smoothening Matrix', '2019-08-30', '2019-08-30', '1', '1', '', 'a009bad2c2fcb51230f1ebebf9aa1aab.jpg'),
(67, 'Hair Straightening Keratin (Protein Treatment) Rebonding Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '5243b273ba45dc976bf36ab3747f0ed2.jpg'),
(68, 'Hair Straightening Keratin (Protein Treatment) Rebonding Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '5243b273ba45dc976bf36ab3747f0ed2.jpg'),
(69, 'Hair Straightening Keratin (Protein Treatment) Straightening Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '898691c436758883928c2423471330cc.jpg'),
(70, 'Hair Straightening Keratin (Protein Treatment) Straightening Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '898691c436758883928c2423471330cc.jpg'),
(71, 'Hair Color Global Color- Majirel /Amonia Loreal ', '2019-08-30', '2019-08-30', '1', '1', '', '43519fd0772790cc8994d2006317f89c.jpg'),
(72, 'Hair Color Global Color- Majirel /Amonia Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '43519fd0772790cc8994d2006317f89c.jpg'),
(73, 'Hair Color Global Color- India / Amonia Free Loreal ', '2019-08-30', '2019-08-30', '1', '1', '', '877cce6927e7156d56fd5649059eb78c.jpg'),
(74, 'Hair Color Global Color- India / Amonia Free Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '877cce6927e7156d56fd5649059eb78c.jpg'),
(75, 'Hair Color Highlights - full Head Loreal', '2019-08-30', '2019-08-30', '1', '1', '', 'f4e4779d091bb66e7fcf61febb481a02.jpg'),
(76, 'Hair Color Highlights - full Head Matrix', '2019-08-30', '2019-08-30', '1', '1', '', 'f4e4779d091bb66e7fcf61febb481a02.jpg'),
(77, 'Hair Color Highlights - Crown Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '6c7ec7ec5727f07d8a8ae93032eddef3.jpg'),
(78, 'Hair Color Highlights - Crown Matrix ', '2019-08-30', '2019-08-30', '1', '1', '', '6c7ec7ec5727f07d8a8ae93032eddef3.jpg'),
(79, 'Hair Color Color Change - Majirel / Amonia Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '5fe4029563166ac3d50afa3b4b750971.jpg'),
(80, 'Hair Color Color Change - Majirel / Amonia Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '5fe4029563166ac3d50afa3b4b750971.jpg'),
(81, 'Hair Color Color Change - Inoa / Amonia Free Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '76714d8731d6b6499aa40ebadd4599f4.jpg'),
(82, 'Hair Color Global Color- Inoa / Amonia Free Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '76714d8731d6b6499aa40ebadd4599f4.jpg'),
(83, 'Hair Color Creative Color Loreal', '2019-08-30', '2019-08-30', '1', '1', '', '3db071bf0236f6f4d4b77036131ac6c7.jpg'),
(84, 'Hair Color Creative Color Matrix', '2019-08-30', '2019-08-30', '1', '1', '', '3db071bf0236f6f4d4b77036131ac6c7.jpg'),
(85, 'Spa Body Scrub ', '2019-08-30', '2019-08-30', '1', '1', '', '8b70c74acbef2a4ae9c4c5c4a1162298.jpg'),
(86, 'Spa Body Massage (60 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '268c8e016c2ef6fab8f725bdd59e7ec4.jpg'),
(87, 'Spa Head, Neck, & Shoulder (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '1ff45126a63fb334af4fa96ee0602a27.jpg'),
(88, 'Spa', '2019-08-30', '2019-08-30', '1', '1', '', '517dcc35f07ca8e52cfdd588ac861dc5.jpg'),
(89, 'Make Up', '2019-08-30', '2019-08-30', '1', '1', '', 'f836cd80e762bc58813d427bd44cd372.jpg'),
(90, 'Loreal Spa (Concentrate ) Clear Dose/ Purifying/ Hydrating/ Stimulating', '2019-08-30', '2019-08-30', '1', '1', '', 'db74e7eccd509e6c1b029ba765b28eef.jpg'),
(91, 'Loreal Expert ', '2019-08-30', '2019-08-30', '1', '1', '', 'a19fe316643df7e6db9d8e5085e590cd.jpg'),
(92, 'Loreal Expert Powder Mix Color Lock', '2019-08-30', '2019-08-30', '1', '1', '', '59df57782f098b8dc84b3efe9aa35f20.jpg'),
(93, 'Loreal Expert Lipidium Primer', '2019-08-30', '2019-08-30', '1', '1', '', '236ffcb4923cecd3a39a51bd5a3cbccc.jpg'),
(94, 'Loreal Expert Lipidium Powder Mix ', '2019-08-30', '2019-08-30', '1', '1', '', '326c85f0556cf5596a0ecf8d6112889e.jpg'),
(95, 'Matrix Spa ', '2019-08-30', '2019-08-30', '1', '1', '', 'c5172345ec3467ad2651537b93243e30.jpg'),
(96, 'Matrix Spa Biolage Booster', '2019-08-30', '2019-08-30', '1', '1', '', '30b9c634ce50eede9627d87a2715afc0.jpg'),
(97, 'Color Touch Up Root Touch Up - Majirel / Amopnia ', '2019-08-30', '2019-08-30', '1', '1', '', 'a58c044b1e7c535f4a799fdf68908c5f.jpg'),
(98, 'Color Touch Up Root Touch Up- Inoa / Amonia Free', '2019-08-30', '2019-08-30', '1', '1', '', '9bf3ed2949123760db67a8c64e839a50.jpg'),
(99, 'Color Touch Up Color Refreshment ', '2019-08-30', '2019-08-30', '1', '1', '', 'af7a09b0fc27efe56fb0350e9a50be03.jpg'),
(100, 'Spa Foot Massage (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '22dadf7ab0b8d98af9c761b6fa056dfe.jpg'),
(101, 'Spa Head Massage (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '89f3f429908aeef8be97008ae99c5990.jpg'),
(102, 'Color Touch Up ', '2019-08-30', '2019-08-30', '1', '1', '', 'fe55f66acc4357eb05e3c897cf541879.jpg'),
(103, 'Beauty ', '2019-08-30', '2019-08-30', '1', '1', '', '3f10e80e901b5e3fe260f72017e858d8.jpg'),
(104, 'Beauty Body Wax Full Arms Classic', '2019-08-30', '2019-08-30', '1', '1', '', '37e9252e754c50be25e9852efab270ad.jpg'),
(105, 'Beauty Body Wax Full Arms Deluxe ', '2019-08-30', '2019-08-30', '1', '1', '', '37e9252e754c50be25e9852efab270ad.jpg'),
(106, 'Beauty Body Wax Full Arms Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', '37e9252e754c50be25e9852efab270ad.jpg'),
(107, 'Beauty Body Wax Full Legs Classic', '2019-08-30', '2019-08-30', '1', '1', '', 'a0d43bffac2c03b81b6dfcb932ded4f6.jpg'),
(108, 'Beauty Body Wax Full legs Deluxe ', '2019-08-30', '2019-08-30', '1', '1', '', 'a0d43bffac2c03b81b6dfcb932ded4f6.jpg'),
(109, 'Beauty Body Wax Full legs Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', 'a0d43bffac2c03b81b6dfcb932ded4f6.jpg'),
(110, 'Beauty Body Wax Under Arms Classic', '2019-08-30', '2019-08-30', '1', '1', '', '4093006b0c9050ca1609726a2b1b59d7.jpg'),
(111, 'Beauty Body Wax Under Arms Deluxe', '2019-08-30', '2019-08-30', '1', '1', '', '4093006b0c9050ca1609726a2b1b59d7.jpg'),
(112, 'Beauty Body Wax Under Arms Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', '4093006b0c9050ca1609726a2b1b59d7.jpg'),
(113, 'Beauty Body Wax Back Body Classic', '2019-08-30', '2019-08-30', '1', '1', '', '542a23b236810b6989e495c42df60c08.jpg'),
(114, 'Beauty Body Wax Back Body Deluxe ', '2019-08-30', '2019-08-30', '1', '1', '', '542a23b236810b6989e495c42df60c08.jpg'),
(115, 'Beauty Body Wax Back Body Deluxe  For Him', '2019-08-30', '2019-08-30', '1', '1', '', '542a23b236810b6989e495c42df60c08.jpg'),
(116, 'Beauty Body Wax Half Front / Back Classic', '2019-08-30', '2019-08-30', '1', '1', '', 'a3b3fc760213d564773803ff3b0f23aa.jpg'),
(117, 'Beauty Body Wax Half Front / Back Deluxe', '2019-08-30', '2019-08-30', '1', '1', '', 'a3b3fc760213d564773803ff3b0f23aa.jpg'),
(118, 'Beauty Body Wax Half Front / Back Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', 'a3b3fc760213d564773803ff3b0f23aa.jpg'),
(119, 'Beauty Body Wax Full Arms + Full Legs + Underarms Classic', '2019-08-30', '2019-08-30', '1', '1', '', 'b8ee02c76e8b203ad285fe036f2987d4.jpg'),
(120, 'Beauty Body Wax Full Arms + Full Legs + Underarms Deluxe', '2019-08-30', '2019-08-30', '1', '1', '', 'b8ee02c76e8b203ad285fe036f2987d4.jpg'),
(121, 'Beauty Body Wax Full Arms + Full Legs + Underarms Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', 'b8ee02c76e8b203ad285fe036f2987d4.jpg'),
(122, 'Beauty Body Wax Full Body Classic', '2019-08-30', '2019-08-30', '1', '1', '', '96ca8e020e3cc9571246ecbead47e2b8.jpg'),
(123, ' Beauty Body Wax Full Body Deluxe For Him', '2019-08-30', '2019-08-30', '1', '1', '', '96ca8e020e3cc9571246ecbead47e2b8.jpg'),
(124, 'Beauty Body Wax Full Body Deluxe', '2019-08-30', '2019-08-30', '1', '1', '', '96ca8e020e3cc9571246ecbead47e2b8.jpg'),
(125, 'Beauty Body Wax Brazillian Wax Classic', '2019-08-30', '2019-08-30', '1', '1', '', 'd2061b095566277f93c3f5649321bede.jpg'),
(126, 'Beauty Body Wax Brazillian Wax Deluxe ', '2019-08-30', '2019-08-30', '1', '1', '', 'd2061b095566277f93c3f5649321bede.jpg'),
(127, 'Beauty Body Wax Brazillian Wax Deluxe For Him ', '2019-08-30', '2019-08-30', '1', '1', '', 'd2061b095566277f93c3f5649321bede.jpg'),
(128, 'Bleach / Lighten Up Face & Neck', '2019-08-30', '2019-08-30', '1', '1', '', '94baead0ad2ff3932eccecb9b54645d8.jpg'),
(129, 'Bleach / Lighten Up Face, Neck & Blouse Line', '2019-08-30', '2019-08-30', '1', '1', '', 'ee6f8e48f784304286853c904490026f.jpg'),
(130, 'Bleach / Lighten Up Arms', '2019-08-30', '2019-08-30', '1', '1', '', '0682e39ec84346298239a06a344e6f72.jpg'),
(131, 'Bleach / Lighten Up Legs', '2019-08-30', '2019-08-30', '1', '1', '', 'a751441e0d3229aacbd084bf53cca7e6.jpg'),
(132, 'Bleach / Lighten Up Tummy Front / Back (each)', '2019-08-30', '2019-08-30', '1', '1', '', 'e2148fb5c30f3a2cd27b2ac01985deef.jpg'),
(133, 'Bleach / Lighten Up Full Body', '2019-08-30', '2019-08-30', '1', '1', '', '96ca8e020e3cc9571246ecbead47e2b8.jpg'),
(134, 'Bleach / Lighten Up Anti Tan Pack', '2019-08-30', '2019-08-30', '1', '1', '', '6943dce2b68dae263ebfb70508f70840.jpg'),
(136, 'Beauty Facials Luxury Facials', '2019-08-30', '2019-08-30', '1', '1', '', '97644a933167a1dd6f50e16d714ad644.jpg'),
(137, 'Beauty Facials Luxury Facials Lotus Advanced Radiant Glow ', '2019-08-30', '2019-08-30', '1', '1', '', '204366be9bea491f4cbe3263d99679a8.jpg'),
(138, 'Beauty Facials Luxury Facials Lotus Advanced Firming', '2019-08-30', '2019-08-30', '1', '1', '', 'ee7de100d2a2d7a22f745e01241e3a4e.jpg'),
(139, 'Beauty Facials Premium Facials Lotus Acne', '2019-08-30', '2019-08-30', '1', '1', '', '4fecd72678f5d10ed51f779d10b77873.jpg'),
(140, 'Beauty Facials Premium Facials Cheryls By Loreal Glovite ', '2019-08-30', '2019-08-30', '1', '1', '', 'f19a132e3a8f31dac3a4e5a698e727d2.jpg'),
(141, 'Beauty Facials Premium Facials O3 + Seaweed Power', '2019-08-30', '2019-08-30', '1', '1', '', 'e992c3e5a8c2e1554b59810fcec83cb2.jpg'),
(142, 'Beauty Facials Classic Facials Lotus Puravitals Fruit Clean Up ', '2019-08-30', '2019-08-30', '1', '1', '', '2c07825263cb88619f517e9f5109f323.jpg'),
(143, 'Beauty Facials Classic Facials O3 + Whitening Clean Up', '2019-08-30', '2019-08-30', '1', '1', '', 'f2e9e8a2e2f6caac214e36f88ee6dbe7.jpg'),
(144, 'Beauty Facials Threading Eyebrows', '2019-08-30', '2019-08-30', '1', '1', '', 'e924085d4b2eba8ff92b9a532144de10.jpg'),
(145, 'Beauty Facials Threading Upper Lips ', '2019-08-30', '2019-08-30', '1', '1', '', '1cd783129544d5f49492d3adeb1347de.jpg'),
(146, 'Beauty Facials Threading Eyebrows + Upper Lips', '2019-08-30', '2019-08-30', '1', '1', '', '65d0acf84d80734693844496e4bd2f0b.jpg'),
(147, 'Beauty Facials Threading Forehead / Chin', '2019-08-30', '2019-08-30', '1', '1', '', '6078c05b62130708e5ffdae433ce34c4.jpg'),
(148, 'Beauty Facials Threading Sides & Jawline/ Neck', '2019-08-30', '2019-08-30', '1', '1', '', '7f536044c50b605c5359c62714537493.jpg'),
(149, 'Beauty Facials Threading Full Face ', '2019-08-30', '2019-08-30', '1', '1', '', 'f2d48e4eaebd82b09d11117623938c32.jpg'),
(150, 'Hand & Feet ', '2019-08-30', '2019-08-30', '1', '1', '', 'a972b47386b014fd4f95aa7414c947ed.jpg'),
(151, 'Hand & Feet Manicure Sara Lemon (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '689b1b0645eaf72c9052c6524cb1a7b7.jpg'),
(152, 'Hand & Feet Manicure Lotus Vitamin C Premium (45 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '689b1b0645eaf72c9052c6524cb1a7b7.jpg'),
(153, 'Hand & Feet Manicure Lotus Rose Luxury (60 Min)', '2019-08-30', '2019-08-30', '1', '1', '', '689b1b0645eaf72c9052c6524cb1a7b7.jpg'),
(154, 'Hand & Feet Pedicure Sara Lemon (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', 'f2caa4381f1f50ea2b4af9050be9b2c3.jpg'),
(155, 'Hand & Feet Pedicure Lotus Vitamin C Premium (45 Min)', '2019-08-30', '2019-08-30', '1', '1', '', 'f2caa4381f1f50ea2b4af9050be9b2c3.jpg'),
(156, 'Hand & Feet Pedicure Lotus Rose Luxury ', '2019-08-30', '2019-08-30', '1', '1', '', 'f2caa4381f1f50ea2b4af9050be9b2c3.jpg'),
(157, 'Hand & Feet Mani & Pedi Sara Lemon (30 Min)', '2019-08-30', '2019-08-30', '1', '1', '', 'e3e18589b488c2f3f9206c9dbf9f7f57.jpg'),
(158, 'Hand & Feet Mani & Pedi Lotus Vitamin C Premium (45 Min)', '2019-08-30', '2019-08-30', '1', '1', '', 'e3e18589b488c2f3f9206c9dbf9f7f57.jpg'),
(159, 'Hand & Feet Mani & Pedi Lotus Rose Luxury (60 Min)', '2019-08-30', '2019-08-30', '1', '1', '', 'e3e18589b488c2f3f9206c9dbf9f7f57.jpg'),
(160, 'demo2222', '2019-09-25', '2019-09-25', '1', '1', '22222', '2e857d0459e6718c8203149173376d1a.jpg'),
(161, 'demo30', '2019-09-30', '2019-09-30', '1', '1', '1999', '2e857d0459e6718c8203149173376d1a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeslot`
--

CREATE TABLE `tbl_timeslot` (
  `id` int(11) NOT NULL,
  `time_slot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_timeslot`
--

INSERT INTO `tbl_timeslot` (`id`, `time_slot`) VALUES
(2, '09:00 AM'),
(3, '09:30 AM'),
(4, '10:00 AM'),
(5, '10:30 AM'),
(6, '11:00 AM'),
(7, '11:30 AM'),
(8, '12:00 PM'),
(9, '12:30 PM'),
(10, '01:00 PM'),
(11, '01:30 PM'),
(12, '02:00 PM'),
(13, '02:30 PM'),
(14, '03:00 PM'),
(15, '03:30 PM'),
(16, '04:00 PM'),
(17, '04:30 PM'),
(18, '05:00 PM'),
(19, '05:30 PM'),
(20, '06:00 PM'),
(21, '06:30 PM'),
(22, '07:00 PM'),
(23, '07:30 PM'),
(24, '08:00 PM'),
(25, '08:30 PM'),
(26, '09:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_data`
--

CREATE TABLE `tbl_user_data` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
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
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_data`
--

INSERT INTO `tbl_user_data` (`id`, `first_name`, `last_name`, `username`, `business_name`, `address`, `city`, `state`, `logo`, `usergroup`, `email`, `website`, `contact`, `bio`, `parent_id`, `store`, `userid`, `roles_name`, `create_date`) VALUES
(1, 'Yogesh', 'Kumar', 'admin', 'Loire Technologies', 'Indirapuram, Ghaziabad', 'Ghaziabad', 'Ghaziabad', '', 'Salon/Spa', 'yogesh@loiretechnologies.com', 'https://www.loiretechnologies.com', '+91 8826126027', '', '0', '1', '1', 'superadmin', '0000-00-00'),
(2, 'rishi', 'verma', 'sales123', 'Loire Technologies', 'phagwara punjab', 'phagwara', 'Punjab', '', 'Demo', 'rishiverma973@gmail.com', '', '9044535598', '', '1', '1', '1', '2', '2019-08-26'),
(3, 'rishi', 'verma', 'sales123', 'Loire Technologies', 'phagwara punjab', 'phagwara', 'Punjab', '', 'Demo', 'rishiverma973@gmail.com', '', '9044535598', '', '1', '1', '1', '2', '2019-08-26'),
(4, 'rishi', 'verma', 'sales123', 'Loire Technologies', 'phagwara punjab', 'phagwara', 'Punjab', '', 'Demo', 'rishiverma973@gmail.com', '', '9044535598', '', '1', '1', '1', '2', '2019-08-26'),
(5, 'rishi', 'verma', 'sales123', 'Loire Technologies', 'phagwara punjab', 'phagwara', 'Punjab', '', 'Demo', 'rishiverma973@gmail.com', '', '9044535598', '', '1', '1', '1', '2', '2019-08-26'),
(6, 'porash sub user', 'sharma', 'porash', 'Loire Technologies', 'noida', 'delhi', 'Goa', '', 'Restaurant', 'porashpandit001@gmail.com', '', '9898989898', '', '1', '1', '1', '2', '2019-09-25'),
(8, 'porash sub user00002', 'sharma', 'demo1111', 'Loire Technologies', '', 'delhi', 'Kerala', '', 'Gym/Yoga', 'porashpandit001@gmail.com', '', '8000000000', '', '1', '1', '1', '5', '2019-09-25'),
(9, 'hello 1111', 'sharma', 'hello', 'Loire Technologies', '', 'delhi', 'Delhi', '', 'Gym/Yoga', 'porashpandit001@gmail.com', '', '7000000000', '', '1', '1', '1', '3', '2019-09-25'),
(10, 'jemo111', 'sharma', 'del', 'Loire Technologies', 'noida', 'delhi', 'Delhi', '', 'Salon/Spa', 'porashpandit001@gmail.com', '', '6909090909', '', '1', '1', '1', '3', '2019-09-25'),
(11, 'demo 07', 'demo007', 'hello', 'Loire Technologies', '', 'delhi', 'Maharashtra', '', 'Demo', 'admin@bladephp.co', '', '7000000000', '', '1', '1', '1', '5', '2019-10-07'),
(12, 'porash 2 sub user07', 'demo', 'demo@gmail.com', 'Loire Technologies', '', '', 'Maharashtra', '', 'Gym/Yoga', 'demo@gmail.com', '', '9898989898', '', '1', '1', '1', '3', '2019-10-07'),
(13, 'hello 11007', '', 'dqewrqewr', 'Loire Technologies', '', '', 'Delhi', '', 'Salon/Spa', 'demo08@gmail.com', '', '98000000445', '', '1', '1', '1', '6', '2019-10-07'),
(14, 'hello 1144', '', 'demo7 oct', 'Loire Technologies', '', '', 'Meghalaya', '', 'Demo', 'admin@bladephp.co', '', '98000000445', '', '1', '1', '1', '3', '2019-10-07'),
(15, 'hello 1144', '', 'demo7 oct', 'Loire Technologies', '', '', 'Meghalaya', '', 'Demo', 'admin@bladephp.co', '', '98000000445', '', '1', '1', '1', '3', '2019-10-07'),
(16, 'khklkrrwr', 'rrrr', 'sales12345', 'Loire Technologies', '', '', 'Bihar', '', 'Gym/Yoga', 'nitin002@gmail.com', '', '7000000000', '', '1', '1', '1', '4', '2019-10-07'),
(17, 'demo', '', 'demo', 'Loire Technologies', '', '', 'Meghalaya', '', 'Other shops', 'demo@gmail.com', '', '8218490671', '', '1', '1', '1', '3', '2019-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_group`
--

CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL,
  `parent_id` varchar(100) NOT NULL,
  `child_id` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `tiny_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`id`, `parent_id`, `child_id`, `store_id`, `sender_id`, `tiny_url`) VALUES
(1, '1', '1', '1', 'LOIRET', 'https://tinyurl.com/y6ql3sen'),
(2, '1', '2', '1', 'LOIRET', ''),
(3, '1', '3', '1', 'LOIRET', ''),
(4, '1', '4', '1', 'LOIRET', ''),
(5, '1', '5', '1', 'LOIRET', ''),
(6, '1', '', '1', 'LOIRET', ''),
(7, '1', '', '1', 'LOIRET', ''),
(8, '1', '', '1', 'LOIRET', ''),
(9, '1', '', '1', 'LOIRET', ''),
(10, '1', '10', '1', 'LOIRET', ''),
(14, '1', '15', '1', 'LOIRET', 'https://tinyurl.com/y6ql3sen'),
(15, '1', '16', '1', 'LOIRET', 'https://tinyurl.com/y6ql3sen'),
(16, '1', '17', '1', 'LOIRET', 'https://tinyurl.com/y6ql3sen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_roles`
--

CREATE TABLE `tbl_user_roles` (
  `id` int(11) NOT NULL,
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
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_roles`
--

INSERT INTO `tbl_user_roles` (`id`, `role_name`, `customer`, `add_customer`, `add_campaign`, `all_campaign`, `all_sub_user`, `birthday`, `anniversary`, `feedback`, `loyality`, `lost_business`, `packages`, `user_id`, `store`, `create_date`, `status`) VALUES
(1, 'Manager', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '', '2', '2019-06-17', 'enabled'),
(2, 'Sales', 'on', 'on', 'on', '', '', '', '', '', '', '', '', '', '1', '2019-07-09', 'enabled'),
(3, 'manager', '', 'on', '', '', '', '', '', '', '', '', '', '', '1', '2019-07-17', 'enabled'),
(4, 'salesteam', 'on', '', '', '', '', '', '', '', '', '', '', '', '1', '2019-08-13', 'enabled'),
(5, 'Owner', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', '', '1', '2019-08-23', 'enabled'),
(6, 'sales manager', 'on', 'on', 'on', 'on', '', '', '', '', '', 'on', 'on', '', '1', '2019-09-19', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_report`
--

CREATE TABLE `whatsapp_report` (
  `id` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `mes_type` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `whatsapp_report`
--

INSERT INTO `whatsapp_report` (`id`, `message`, `mes_type`, `date`) VALUES
(2, 'hi', 'text', '2019-08-07'),
(3, 'hi', 'text', '2019-08-07'),
(4, '', 'image', '2019-08-07'),
(5, 'https://crm.loiretechnologies.com/demo/whatsappimage/d9fbe536b93795d8d79c7d26f606b4e7.jpg', 'image', '2019-08-07'),
(6, 'https://crm.loiretechnologies.com/demo/whatsappimage/46061-3345-payslip.pdf', 'pdf', '2019-08-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditsms`
--
ALTER TABLE `creditsms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loyality_setting`
--
ALTER TABLE `loyality_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  ADD UNIQUE KEY `mod_modulecode` (`mod_modulecode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_rolecode`);

--
-- Indexes for table `role_rights`
--
ALTER TABLE `role_rights`
  ADD PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  ADD KEY `rr_modulecode` (`rr_modulecode`);

--
-- Indexes for table `smstemplates`
--
ALTER TABLE `smstemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_report`
--
ALTER TABLE `sms_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`u_userid`),
  ADD KEY `u_rolecode` (`u_rolecode`);

--
-- Indexes for table `tbl_appoinment`
--
ALTER TABLE `tbl_appoinment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_data`
--
ALTER TABLE `tbl_customer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_group`
--
ALTER TABLE `tbl_customer_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_purchase`
--
ALTER TABLE `tbl_customer_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_source`
--
ALTER TABLE `tbl_customer_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedbacksetting`
--
ALTER TABLE `tbl_feedbacksetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_loyality`
--
ALTER TABLE `tbl_loyality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package_otp`
--
ALTER TABLE `tbl_package_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package_services`
--
ALTER TABLE `tbl_package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_redeem_package`
--
ALTER TABLE `tbl_redeem_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_regain`
--
ALTER TABLE `tbl_regain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_report`
--
ALTER TABLE `tbl_sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sellpackage`
--
ALTER TABLE `tbl_sellpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_timeslot`
--
ALTER TABLE `tbl_timeslot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_data`
--
ALTER TABLE `tbl_user_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_report`
--
ALTER TABLE `whatsapp_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditsms`
--
ALTER TABLE `creditsms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loyality_setting`
--
ALTER TABLE `loyality_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `smstemplates`
--
ALTER TABLE `smstemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sms_report`
--
ALTER TABLE `sms_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `u_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_appoinment`
--
ALTER TABLE `tbl_appoinment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_customer_data`
--
ALTER TABLE `tbl_customer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `tbl_customer_group`
--
ALTER TABLE `tbl_customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_customer_purchase`
--
ALTER TABLE `tbl_customer_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `tbl_customer_source`
--
ALTER TABLE `tbl_customer_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_feedbacksetting`
--
ALTER TABLE `tbl_feedbacksetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_loyality`
--
ALTER TABLE `tbl_loyality`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_package_otp`
--
ALTER TABLE `tbl_package_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_package_services`
--
ALTER TABLE `tbl_package_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_redeem_package`
--
ALTER TABLE `tbl_redeem_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tbl_regain`
--
ALTER TABLE `tbl_regain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_reminder`
--
ALTER TABLE `tbl_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_sales_report`
--
ALTER TABLE `tbl_sales_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_sellpackage`
--
ALTER TABLE `tbl_sellpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `tbl_timeslot`
--
ALTER TABLE `tbl_timeslot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_user_data`
--
ALTER TABLE `tbl_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `whatsapp_report`
--
ALTER TABLE `whatsapp_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_rights`
--
ALTER TABLE `role_rights`
  ADD CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE;

--
-- Constraints for table `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
