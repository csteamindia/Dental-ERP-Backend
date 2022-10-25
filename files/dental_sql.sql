-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2022 at 01:11 PM
-- Server version: 5.7.40
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keepsmileslab_react`
--

-- --------------------------------------------------------


--
-- Table structure for table `rpd_company`
--

CREATE TABLE `rpd_company` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(180) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(320) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `pan` varchar(10) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `website` varchar(320) NOT NULL,
  `address` text NOT NULL,
  `image` text,
  `added_by` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_company`
--

INSERT INTO `rpd_company` (`id`, `title`, `mobile`, `tel`, `email`, `fax`, `pan`, `gst`, `cin`, `website`, `address`, `image`, `added_by`, `status`) VALUES
(1, 'RPD Ltd', '9372051201', '', 'info@rpddentalart.comc', '0222670652', 'AAFCV4718A', '27AAFCV4718A1ZJ', '1234567890', 'www.rpddentalart.com', 'Unit No : 102 Eco Heights, Shri Nityanand CHS Ltd, Swami Nityananand Marg, Opp. Western Railway Quarters , Andheri (East), Mumbai, Maharashtra 400069', NULL, '2020-06-04 10:51:32', 1);



--
-- Table structure for table `rpd_profile`
--

CREATE TABLE `rpd_profile` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `logo_mini_txt` varchar(4) NOT NULL,
  `logo_txt` varchar(15) NOT NULL,
  `is_setting_side_bar` int(1) NOT NULL DEFAULT '0',
  `btn_logout` int(1) NOT NULL DEFAULT '0',
  `profile_btn` int(1) NOT NULL DEFAULT '0',
  `is_lock` int(1) NOT NULL DEFAULT '0',
  `change_pwd` int(1) NOT NULL DEFAULT '0',
  `is_search_in_bar` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_profile`
--

INSERT INTO `rpd_profile` (`id`, `title`, `logo_mini_txt`, `logo_txt`, `is_setting_side_bar`, `btn_logout`, `profile_btn`, `is_lock`, `change_pwd`, `is_search_in_bar`) VALUES
(1, 'RPD Dental Art Private Limited', '', 'ECAPS', 0, 1, 0, 0, 0, 0);

--
-- Table structure for table `rpd_department`
--

CREATE TABLE `rpd_department` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_department`
--

INSERT INTO `rpd_department` (`id`, `title`, `code`, `status`) VALUES (1, 'India', 'IN', 1);


--
-- Table structure for table `rpd_designation`
--

CREATE TABLE `rpd_designation` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_designation`
--

INSERT INTO `rpd_designation` (`id`, `title`, `code`, `status`) VALUES (1, 'Field  Executive', 'FEXE', 0);


--
-- Table structure for table `rpd_labdepartment`
--

CREATE TABLE `rpd_labdepartment` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_labdepartment`
--

INSERT INTO `rpd_labdepartment` (`id`, `title`, `code`, `status`) VALUES (2, 'Diecutting', 'LDIE', 0);

--
-- Table structure for table `rpd_country`
--

CREATE TABLE `rpd_country` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_country`
--

INSERT INTO `rpd_country` (`id`, `title`, `code`, `status`) VALUES (1, 'India', 'IN', 0);


--
-- Table structure for table `rpd_states`
--

CREATE TABLE `rpd_states` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `country` varchar(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_states`
--

INSERT INTO `rpd_states` (`id`, `title`, `code`, `country`, `status`) VALUES (39, 'APi State', 'AS', 'IN', 0);

--
-- Table structure for table `rpd_cities`
--

CREATE TABLE `rpd_cities` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `state` varchar(6) DEFAULT NULL,
  `country` varchar(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_cities`
--

INSERT INTO `rpd_cities` (`id`, `title`, `code`, `state`, `country`, `status`) VALUES (1, 'APi', 'AS2', 'GUJ', 'IN', 1);


--
-- Table structure for table `rpd_stations`
--

CREATE TABLE `rpd_stations` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(6) NOT NULL,
  `city` varchar(6) DEFAULT NULL,
  `state` varchar(6) DEFAULT NULL,
  `country` varchar(66) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_stations`
--

INSERT INTO `rpd_stations` (`id`, `title`, `code`, `city`, `state`, `country`, `status`) VALUES (1, 'Dahisar-W', '', '2', '2', '1', 0);


--
-- Table structure for table `rpd_source`
--

CREATE TABLE `rpd_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(60) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_source`
--

INSERT INTO `rpd_source` (`id`, `title`, `code`, `status`) VALUES (1, 'APi State 2', 'AS2', 0);

--
-- Table structure for table `rpd_qualification`
--

CREATE TABLE `rpd_qualification` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_qualification`
--

INSERT INTO `rpd_qualification` (`id`, `title`, `code`, `status`) VALUES (1, 'BDS', 'DBDS', 0);

--
-- Table structure for table `rpd_correction_template`
--

CREATE TABLE `rpd_correction_template` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(60) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rpd_correction_template`
--

INSERT INTO `rpd_correction_template` (`id`, `title`, `code`, `status`) VALUES (1, 'Remove High Points', NULL, 0);

--
-- Table structure for table `rpd_role`
--

CREATE TABLE `rpd_role` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `previlize` text,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_role`
--

INSERT INTO `rpd_role` (`id`, `title`, `code`, `previlize`, `status`) VALUES
(1, 'Employee', 'EMP', '[\"19\",\"36\",\"37\",\"20\",\"38\",\"40\",\"41\",\"43\",\"21\",\"44\",\"45\",\"46\",\"47\",\"51\",\"52\",\"53\",\"54\",\"55\",\"61\",\"63\",\"49\",\"70\",\"93\",\"65\"]', 0);

--
-- Table structure for table `rpd_privileges`
--

CREATE TABLE `rpd_privileges` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `label` varchar(160) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `link` text NOT NULL,
  `icon` varchar(30) NOT NULL,
  `color` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_privileges`
--

INSERT INTO `rpd_privileges` (`id`, `label`, `parent`, `link`, `icon`, `color`, `status`) VALUES (1, 'Dashboard', 0, '/', 'fa-dashboard', '', 0);

--
-- Table structure for table `rpd_location`
--

CREATE TABLE `rpd_location` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_location`
--

INSERT INTO `rpd_location` (`id`, `title`, `code`, `status`) VALUES (1, 'Andheri ', 'AND', 0);

--
-- Table structure for table `rpd_shade`
--

CREATE TABLE `rpd_shade` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `shadeguide` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_shade`
--

INSERT INTO `rpd_shade` (`id`, `title`, `code`, `shadeguide`, `status`) VALUES (1, '1M1', 'S1', '3SH', 1);

--
-- Table structure for table `rpd_shadeguide`
--

CREATE TABLE `rpd_shadeguide` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_shadeguide`
--

INSERT INTO `rpd_shadeguide` (`id`, `title`, `code`, `status`) VALUES (1, 'Vita Classic', 'VLC', 0);

--
-- Table structure for table `rpd_productgroup`
--

CREATE TABLE `rpd_productgroup` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `group` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_productgroup`
--

INSERT INTO `rpd_productgroup` (`id`, `group`, `code`, `status`) VALUES (1, 'EMAX', 'G001', 0);



--
-- Table structure for table `rpd_producttype`
--

CREATE TABLE `rpd_producttype` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `product_category` varchar(16) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_producttype`
--

INSERT INTO `rpd_producttype` (`id`, `title`, `product_category`, `code`, `status`) VALUES (1, 'Lava', 'CA01', 'PT', 0);

--
-- Table structure for table `rpd_productcategory`
--

CREATE TABLE `rpd_productcategory` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_productcategory`
--

INSERT INTO `rpd_productcategory` (`id`, `title`, `code`, `status`) VALUES (3, '3M Lava', 'CA01', 0);

CREATE TABLE `rpd_product` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(120) NOT NULL,
  `code` varchar(10) NOT NULL,
  `legancy_code` varchar(20) DEFAULT NULL,
  `desc` varchar(320) DEFAULT NULL,
  `group` varchar(16) NOT NULL,
  `brand` varchar(16) DEFAULT NULL,
  `warranty` varchar(16) DEFAULT NULL,
  `category` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL,
  `unit_price` varchar(10) NOT NULL,
  `added_at` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_product`
--

INSERT INTO `rpd_product` (`id`, `title`, `code`, `legancy_code`, `desc`, `group`, `brand`, `warranty`, `category`, `type`, `unit_price`, `added_at`, `status`) VALUES
(1, 'EMax Veneer', 'PR001', NULL, NULL, '0', '0', '4', 'CA04', 'PT3', '2400', '2020-06-05 15:29:38', 0);

--
-- Table structure for table `rpd_warranty`
--

CREATE TABLE `rpd_warranty` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `title` varchar(60) NOT NULL,
  `code` varchar(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_warranty`
--

INSERT INTO `rpd_warranty` (`id`, `title`, `code`, `status`) VALUES (1, '3 Years', NULL, 0);


--
-- Table structure for table `rpd_warranty_cards`
--

CREATE TABLE `rpd_warranty_cards` (
  `id` int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
  `card_no` varchar(60) NOT NULL,
  `added_by` varchar(16) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_warranty_cards`
--

INSERT INTO `rpd_warranty_cards` (`id`, `card_no`, `added_by`, `added_at`) VALUES
(20, '001', 'admin', '2021-03-17 16:16:52');


--
-- Table structure for table `rpd_warrenty_card For Assign to client`
--

CREATE TABLE `rpd_warrenty_card` (
  `id` int(11) NOT NULL,
  `warrenty_code` varchar(45) NOT NULL,
  `verification_code` varchar(16) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(12) NOT NULL,
  `frame_bar_code` varchar(16) NOT NULL,
  `case_number` varchar(16) NOT NULL,
  `product_type` varchar(16) NOT NULL,
  `product` varchar(16) NOT NULL,
  `units` int(11) NOT NULL,
  `case_desc` text NOT NULL,
  `shade_1` varchar(16) NOT NULL,
  `shade_2` varchar(16) NOT NULL,
  `shade_3` varchar(16) NOT NULL,
  `clientname` varchar(120) NOT NULL,
  `cmobile` varchar(10) NOT NULL,
  `cemail` varchar(320) NOT NULL,
  `clocation` varchar(60) NOT NULL,
  `patiantname` varchar(120) NOT NULL,
  `pmobile` varchar(10) NOT NULL,
  `pemail` varchar(320) NOT NULL,
  `plocation` varchar(60) NOT NULL,
  `pstatus` int(1) NOT NULL DEFAULT '0',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(16) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpd_warrenty_card`
--

INSERT INTO `rpd_warrenty_card` (`id`, `warrenty_code`, `verification_code`, `date`, `time`, `frame_bar_code`, `case_number`, `product_type`, `product`, `units`, `case_desc`, `shade_1`, `shade_2`, `shade_3`, `clientname`, `cmobile`, `cemail`, `clocation`, `patiantname`, `pmobile`, `pemail`, `plocation`, `pstatus`, `added_at`, `added_by`, `updated_at`, `status`) VALUES
(6, '001', '0', '2021-03-17', '17:08:03', '0', '210320402', 'PT2', 'PR025', 1, 'NO HIGH POINT, TIGHT FITTING, PROPER MARGIN', 'A2', '', '', 'Dr. Pratap Dhawale', '9425056477', '', '130 - Anupam Nagar, Indore', 'PRERNA GUPTA', '', '', '', 1, '2021-03-17 00:00:00', '00049', NULL, 0);
