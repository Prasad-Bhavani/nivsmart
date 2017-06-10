-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 02:34 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nivsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(250) NOT NULL,
  `phno` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `addr` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `phno`, `email`, `state_id`, `city_id`, `addr`, `status`, `created_date_time`, `updated_date_time`) VALUES
(1, 'Main Branch(Guntur)', '9885420428', 'vijaykumar@gmail.com', 1, 1, 'AT. Agraharam', 1, '2016-11-21 21:24:34', '2016-11-21 21:31:02'),
(2, 'Tenali', '9885420428', 'mallesh@gmail.com', 1, 2, 'Railway Station Center', 1, '2016-11-21 21:27:27', '2016-11-22 16:20:10'),
(3, 'Vijayawada Branch', '9703655655', 'prasad.koppana@charvikent.com', 1, 3, 'Near Bandar Road', 1, '2016-11-21 21:29:30', '2016-11-25 15:17:01'),
(4, 'Vizag Branch', '9703655655', 'prasad@gmail.com', 1, 4, 'Near Seethammadhara', 1, '2016-11-21 21:30:35', '2016-11-25 15:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `business_names`
--

CREATE TABLE IF NOT EXISTS `business_names` (
  `id` int(11) NOT NULL,
  `business_type_id` int(11) NOT NULL,
  `business_name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_names`
--

INSERT INTO `business_names` (`id`, `business_type_id`, `business_name`, `status`) VALUES
(1, 1, 'Manfacturing 1', 0),
(2, 3, 'Service 1', 0),
(3, 3, 'Non Gov Organizations', 1),
(4, 3, 'Accounting Services', 1),
(5, 2, 'Food Beverages & Tobaco', 1),
(6, 2, 'Electronic Parts and Equipments', 1),
(7, 2, 'Auto Motives', 1),
(8, 1, 'Wooden Containers', 1),
(9, 1, 'Soft Drinks', 1),
(10, 1, 'Paper & Paperboard Products', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city`, `status`, `created_date_time`, `updated_date_time`) VALUES
(1, 1, 'Guntur', 0, '2016-11-21 21:18:12', '2017-02-22 15:50:37'),
(2, 1, 'Tenali', 1, '2016-11-21 21:18:21', '0000-00-00 00:00:00'),
(3, 1, 'Vijayawada', 0, '2016-11-21 21:18:36', '2017-02-22 15:51:00'),
(4, 1, 'Vizag', 1, '2016-11-21 21:18:45', '0000-00-00 00:00:00'),
(5, 4, 'Kochi', 1, '2016-11-21 21:20:33', '0000-00-00 00:00:00'),
(6, 4, 'Thiruvananthapuram', 0, '2016-11-21 21:20:46', '2017-02-22 15:50:56'),
(7, 4, 'Kottayam', 1, '2016-11-21 21:21:42', '0000-00-00 00:00:00'),
(8, 3, 'Chennai', 0, '2016-11-21 21:22:12', '2017-02-22 15:50:55'),
(9, 3, 'Coimbatore', 0, '2016-11-21 21:22:24', '2017-02-22 18:43:31'),
(10, 3, 'Madurai', 0, '2016-11-21 21:22:32', '2017-02-22 15:48:42'),
(11, 2, 'Hyderabad', 1, '2016-11-21 21:22:59', '0000-00-00 00:00:00'),
(12, 2, 'Khammam', 1, '2016-11-21 21:23:13', '2017-02-22 15:49:31'),
(13, 2, 'Karimnagar', 1, '2016-11-21 21:23:25', '2016-12-01 19:12:43'),
(14, 1, 'Kakinada', 0, '2016-12-01 19:12:54', '2017-02-22 15:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `crm_leads`
--

CREATE TABLE IF NOT EXISTS `crm_leads` (
  `id` int(11) NOT NULL,
  `lead_branch_id` int(11) NOT NULL,
  `source_from` int(11) NOT NULL,
  `created_emp_id` int(11) NOT NULL,
  `lead_id` varchar(250) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `nature_of_business_type` int(11) NOT NULL,
  `business_name` int(11) NOT NULL,
  `if_tally_customer` int(11) NOT NULL,
  `any_other_software` varchar(250) NOT NULL,
  `existing_tally_no` varchar(250) NOT NULL,
  `is_upgrade` int(11) NOT NULL,
  `upgrade_version` varchar(250) NOT NULL,
  `if_prospect` int(11) NOT NULL,
  `prospect_type_id` int(11) NOT NULL,
  `prospect_details_id` int(11) NOT NULL,
  `if_interest_demo` int(11) NOT NULL,
  `demo_date_time` datetime NOT NULL,
  `if_referred` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `created_date_time` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `lead_dept_id` int(11) NOT NULL,
  `is_present` int(11) NOT NULL,
  `last_process_id` int(11) NOT NULL,
  `assign_tele_id` int(11) NOT NULL,
  `lead_verified` int(11) NOT NULL,
  `lead_completed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crm_leads`
--

INSERT INTO `crm_leads` (`id`, `lead_branch_id`, `source_from`, `created_emp_id`, `lead_id`, `customer_id`, `nature_of_business_type`, `business_name`, `if_tally_customer`, `any_other_software`, `existing_tally_no`, `is_upgrade`, `upgrade_version`, `if_prospect`, `prospect_type_id`, `prospect_details_id`, `if_interest_demo`, `demo_date_time`, `if_referred`, `remarks`, `created_date_time`, `last_updated`, `status`, `lead_dept_id`, `is_present`, `last_process_id`, `assign_tele_id`, `lead_verified`, `lead_completed`) VALUES
(1, 2, 0, 3, 'LID001', 1, 1, 8, 0, 'No', '', 0, '', 1, 2, 5, 0, '0000-00-00 00:00:00', 0, 'He want to installation of tally', '2017-02-12 21:16:50', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 3, 'LID002', 2, 1, 9, 1, '', 'Tally 1.256.05.06', 1, 'Tally 6.5.203', 1, 1, 8, 1, '2017-02-22 21:19:00', 0, 'Update Tally', '2017-02-12 21:19:40', '2017-02-13 00:13:01', 1, 7, 0, 163, 6, 1, 1),
(3, 2, 0, 3, 'LID003', 3, 3, 3, 0, 'NO one Can''t use', '', 0, '', 1, 2, 6, 0, '0000-00-00 00:00:00', 0, 'Not Interest for Take Tally', '2017-02-12 21:20:59', '2017-02-13 00:17:53', 2, 7, 0, 167, 6, 1, 1),
(4, 2, 0, 3, 'LID004', 4, 1, 8, 1, '', 'No one used', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'No interest to take tally', '2017-02-12 21:21:59', '2017-02-17 20:52:04', 6, 0, 0, 100, 0, 0, 0),
(5, 2, 0, 3, 'LID005', 5, 2, 5, 0, 'No', '', 0, '', 1, 3, 1, 1, '2017-02-15 00:21:00', 0, 'Required Information for solution and Tally Instalation', '2017-02-12 21:23:34', '2017-02-13 12:43:01', 5, 7, 7, 80, 6, 0, 0),
(6, 2, 0, 3, 'LID006', 6, 1, 8, 0, 'No', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not intrested', '2017-02-14 12:19:37', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(10, 2, 0, 4, 'LID010', 10, 1, 8, 0, 'not used', '', 0, '', 1, 1, 8, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-15 01:34:30', '2017-02-17 23:30:41', 3, 0, 6, 34, 6, 0, 0),
(11, 2, 0, 7, 'LID011', 11, 1, 8, 1, '', 'TALLY 14235', 1, 'Version 1.5.26', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'He want New Tally', '2017-02-15 17:45:02', '2017-02-17 23:29:32', 3, 0, 6, 86, 6, 0, 0),
(12, 2, 0, 31, 'LID012', 12, 1, 8, 0, 'No', '', 0, '', 1, 1, 8, 1, '2017-02-22 17:23:00', 0, 'New Tally', '2017-02-16 17:23:30', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(13, 2, 0, 31, 'LID013', 13, 1, 8, 0, 'Not Used', '', 0, '', 0, 0, 0, 1, '2017-02-23 23:36:00', 0, 'Tally updations', '2017-02-16 17:34:35', '2017-02-22 00:05:31', 5, 4, 13, 168, 31, 0, 0),
(16, 2, 0, 31, 'LID016', 16, 3, 3, 1, '', 'no', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not intreset for Tally', '2017-02-16 17:42:49', '2017-02-17 20:13:52', 6, 0, 31, 101, 31, 0, 0),
(17, 2, 0, 31, 'LID017', 17, 3, 3, 1, '', 'no', 1, '1.2.5', 1, 1, 8, 1, '2017-02-17 20:54:00', 0, 'He is not intrested', '2017-02-16 20:55:07', '2017-02-16 20:55:07', 5, 0, 31, 41, 31, 0, 0),
(18, 2, 0, 31, 'LID018', 18, 3, 3, 1, '', 'no', 1, '1.2.5', 1, 1, 8, 1, '2017-02-17 20:54:00', 0, 'He is not intrested', '2017-02-16 20:55:49', '2017-02-22 00:03:10', 5, 0, 31, 42, 31, 0, 0),
(19, 2, 0, 31, 'LID019', 19, 3, 4, 1, '', 'NO', 1, 'no 1.2.6.8', 1, 1, 8, 1, '2017-02-18 20:57:00', 0, 'Just Intreseted', '2017-02-16 20:57:26', '2017-02-16 20:57:26', 5, 0, 31, 43, 31, 0, 0),
(20, 2, 0, 31, 'LID020', 20, 1, 8, 1, '', 'Zdfdsff', 1, 'fdsfdsf', 0, 0, 0, 1, '2017-02-10 21:03:00', 0, 'fds fdsfdsf', '2017-02-16 21:03:44', '0000-00-00 00:00:00', 5, 0, 31, 44, 31, 0, 0),
(21, 2, 0, 31, 'LID021', 21, 1, 9, 1, '', 'dfsf dsfdsf', 0, '', 1, 2, 5, 1, '2017-02-03 21:07:00', 0, 'dsfdsff dfdsf', '2017-02-16 21:08:32', '0000-00-00 00:00:00', 6, 0, 31, 45, 31, 0, 0),
(22, 2, 0, 31, 'LID022', 22, 1, 9, 1, '', 'dfsf dsfdsf', 0, '', 1, 2, 5, 1, '2017-02-03 21:07:00', 0, 'dsfdsff dfdsf', '2017-02-16 21:09:31', '0000-00-00 00:00:00', 5, 0, 31, 46, 31, 0, 0),
(23, 2, 0, 31, 'LID023', 23, 1, 9, 1, '', 'dfsf dsfdsf', 0, '', 1, 2, 5, 1, '2017-02-03 21:07:00', 0, 'dsfdsff dfdsf', '2017-02-16 21:09:52', '0000-00-00 00:00:00', 5, 0, 31, 47, 31, 0, 0),
(24, 2, 0, 31, 'LID024', 24, 1, 8, 1, '', 'NO', 1, '1.2.255', 1, 1, 8, 1, '2017-02-17 22:59:00', 0, 'He Take Tally', '2017-02-16 22:59:56', '0000-00-00 00:00:00', 0, 0, 31, 48, 31, 0, 0),
(25, 2, 0, 31, 'LID025', 25, 1, 8, 1, '', 'NO', 1, 'no', 1, 2, 5, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-16 23:03:55', '2017-02-16 23:06:29', 5, 28, 28, 173, 31, 0, 0),
(26, 2, 0, 31, 'LID026', 26, 1, 8, 1, '', 'NO', 1, 'Tally Gold 1234567890', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-16 23:05:51', '2017-02-17 23:37:46', 3, 0, 31, 53, 31, 0, 0),
(27, 2, 0, 31, 'LID027', 27, 1, 8, 1, '', 'NO', 1, 'no', 1, 2, 5, 1, '2017-02-18 23:13:00', 0, 'He Don''t  want to tally', '2017-02-16 23:14:07', '0000-00-00 00:00:00', 2, 0, 31, 54, 31, 0, 0),
(28, 2, 0, 4, 'LID028', 28, 1, 8, 0, 'No one Use', '', 0, '', 0, 0, 0, 1, '2017-02-04 23:26:00', 0, 'Lead Creation', '2017-02-17 09:27:20', '2017-02-17 23:27:04', 5, 0, 6, 81, 0, 0, 0),
(29, 2, 0, 4, 'LID029', 29, 1, 8, 1, '', 'no', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not', '2017-02-17 10:41:22', '0000-00-00 00:00:00', 5, 0, 31, 85, 31, 0, 0),
(30, 2, 0, 4, 'LID030', 30, 1, 8, 1, '', 'no use', 1, 'version 1.2.5', 1, 1, 8, 1, '2017-02-24 10:42:00', 0, 'New Tally', '2017-02-17 10:42:10', '0000-00-00 00:00:00', 5, 0, 31, 84, 31, 0, 0),
(31, 2, 0, 31, 'LID031', 31, 0, 0, 0, '', '', 0, '', 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 'New Lead Creation', '2017-02-17 20:47:35', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(33, 2, 0, 31, 'LID033', 33, 1, 8, 0, 'no', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not Intrested', '2017-02-19 21:45:19', '0000-00-00 00:00:00', 5, 0, 31, 91, 31, 0, 0),
(34, 2, 0, 31, 'LID034', 34, 1, 8, 0, 'no', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not Intrested', '2017-02-19 21:51:10', '0000-00-00 00:00:00', 6, 0, 31, 92, 31, 0, 0),
(35, 2, 0, 31, 'LID035', 35, 1, 9, 0, 'no', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not Interested', '2017-02-19 21:59:29', '0000-00-00 00:00:00', 6, 0, 31, 93, 31, 0, 0),
(36, 2, 0, 31, 'LID036', 36, 1, 8, 1, '', 'Tally 123456', 1, 'Tally 6.2.53.6', 1, 1, 9, 0, '0000-00-00 00:00:00', 0, 'He want updation and New tally', '2017-02-19 22:01:07', '0000-00-00 00:00:00', 5, 0, 31, 94, 31, 0, 0),
(37, 2, 0, 4, 'LID037', 37, 1, 8, 1, '', 'Tally 1.35.6', 0, '', 0, 0, 0, 1, '2017-02-28 23:37:00', 0, 'He Want to new Tally', '2017-02-19 23:38:12', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(38, 2, 0, 4, 'LID038', 38, 1, 8, 1, '', 'Tally 2.6', 1, 'Tally 3.2.6', 1, 1, 9, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-20 00:04:22', '0000-00-00 00:00:00', 5, 7, 7, 111, 6, 0, 0),
(39, 1, 0, 1, 'LID039', 39, 0, 0, 0, '', '', 0, '', 1, 2, 0, 0, '0000-00-00 00:00:00', 0, 'He want new Tally', '2017-02-21 12:38:19', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(40, 2, 0, 4, 'LID040', 40, 1, 8, 1, '', 'Yes', 1, 'Version Tally 2.6.3', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Tally Updation Required', '2017-02-21 20:11:04', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(41, 2, 0, 4, 'LID041', 41, 1, 9, 0, 'NO use', '', 0, '', 1, 1, 9, 0, '0000-00-00 00:00:00', 1, 'He want to what about Tally', '2017-02-21 20:13:42', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(42, 2, 0, 4, 'LID042', 42, 3, 4, 1, '', 'Tally 1.2.36.5', 1, 'New update version', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'He want to update present tally', '2017-02-21 20:16:01', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(43, 1, 0, 4, 'LID043', 43, 1, 8, 0, 'No use', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not intrested Tally', '2017-02-21 21:28:09', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(44, 1, 0, 4, 'LID044', 44, 2, 6, 0, 'no use', '', 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 'Not Interested for Tally', '2017-02-21 21:41:45', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(45, 2, 0, 4, 'LID045', 45, 1, 8, 1, '', 'Serial no 1253', 1, 'no', 1, 2, 6, 0, '0000-00-00 00:00:00', 0, 'Service', '2017-02-21 21:45:21', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(46, 1, 0, 4, 'LID046', 46, 1, 8, 0, 'no use', '', 0, '', 1, 2, 5, 1, '2017-02-22 21:46:00', 0, 'He want to New Tally', '2017-02-21 21:46:56', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(47, 3, 0, 31, 'LID047', 47, 1, 8, 0, 'No use', '', 0, '', 1, 1, 9, 1, '2017-02-22 22:18:00', 0, 'New Tally Requirement', '2017-02-21 22:18:52', '0000-00-00 00:00:00', 5, 0, 31, 98, 31, 0, 0),
(48, 2, 0, 31, 'LID048', 48, 1, 8, 0, 'no', '', 0, '', 1, 1, 8, 1, '2017-02-16 22:20:00', 0, 'New Tally', '2017-02-21 22:20:19', '0000-00-00 00:00:00', 5, 0, 31, 99, 31, 0, 0),
(49, 2, 0, 13, 'LID049', 49, 1, 8, 0, 'No Use', '', 0, '', 1, 1, 10, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-21 22:31:53', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(50, 1, 0, 13, 'LID050', 50, 1, 8, 0, 'No use', '', 0, '', 1, 2, 4, 1, '2017-02-23 22:33:00', 2, 'He want Demo for Tally Implementation', '2017-02-21 22:33:26', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(51, 2, 0, 13, 'LID051', 51, 0, 0, 0, '', '', 0, '', 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 'He want to New Tally', '2017-02-21 22:35:21', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(52, 3, 0, 7, 'LID052', 52, 1, 8, 0, 'no use', '', 0, '', 1, 1, 9, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-21 22:37:32', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(53, 2, 0, 28, 'LID053', 53, 1, 9, 0, 'no use', '', 0, '', 1, 1, 8, 1, '2017-02-23 22:41:00', 0, 'New Tally Requirement', '2017-02-21 22:41:57', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(54, 2, 0, 28, 'LID054', 54, 0, 0, 0, '', '', 0, '', 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-21 22:42:45', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(55, 2, 0, 28, 'LID055', 55, 0, 0, 0, '', '', 0, '', 1, 2, 0, 0, '0000-00-00 00:00:00', 0, 'He Want to Solution for Tally 3.2.36', '2017-02-21 22:43:56', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(56, 1, 0, 28, 'LID056', 56, 1, 9, 0, 'no use', '', 0, '', 1, 1, 9, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-21 22:45:05', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(57, 4, 0, 27, 'LID057', 57, 1, 9, 1, '', 'no use', 0, '', 1, 1, 17, 0, '0000-00-00 00:00:00', 0, 'New Tally', '2017-02-21 22:47:33', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0),
(58, 2, 0, 27, 'LID058', 58, 0, 0, 0, '', '', 0, '', 1, 3, 0, 0, '0000-00-00 00:00:00', 0, 'Soution for Tally', '2017-02-21 22:48:20', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `crm_referred_customers`
--

CREATE TABLE IF NOT EXISTS `crm_referred_customers` (
  `id` int(11) NOT NULL,
  `referred_company` varchar(250) NOT NULL,
  `referred_person` varchar(250) NOT NULL,
  `referred_contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crm_referred_customers`
--

INSERT INTO `crm_referred_customers` (`id`, `referred_company`, `referred_person`, `referred_contact_no`) VALUES
(1, 'Suma Tech Soft', 'Suma', '985422885245'),
(2, 'Prasad Tech Soft', 'Prasad', '9491862697');

-- --------------------------------------------------------

--
-- Table structure for table `customer_personal_details`
--

CREATE TABLE IF NOT EXISTS `customer_personal_details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `contact_no_1` varchar(15) NOT NULL,
  `contact_no_2` varchar(15) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `addr` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_personal_details`
--

INSERT INTO `customer_personal_details` (`id`, `company_name`, `contact_no_1`, `contact_no_2`, `contact_person`, `addr`, `state_id`, `city_id`, `created_date_time`, `last_updated`) VALUES
(1, 'Charvikent', '9703655655', '', 'Mallesh Rao', 'AT Agraharam', 1, 2, '2017-02-12 21:16:50', '0000-00-00 00:00:00'),
(2, 'Lyratech', '9885420428', '9491862697', 'Srinuvas Rao', 'Bus Stand', 1, 1, '2017-02-12 21:19:40', '2017-02-13 00:13:01'),
(3, 'Apsara Tech', '9885420426', '9491862697', 'Sirisha', 'Main Road', 1, 1, '2017-02-12 23:44:55', '2017-02-13 00:02:16'),
(4, 'Sai Infra Strauctures', '9885420428', '', 'Vinodh kumar', 'AT Agraharam', 1, 1, '2017-02-12 21:25:44', '2017-02-17 20:52:04'),
(5, 'SVCT', '9491862697', '', 'Aditya', 'Ashoknagar', 1, 1, '2017-02-12 21:23:34', '2017-02-13 00:16:12'),
(6, 'Srinu infotech', '9491862697', '', 'Srinu', 'AT Agraharam', 1, 1, '2017-02-14 12:19:37', '0000-00-00 00:00:00'),
(10, 'Charvient', '9885420427', '8859584528', 'Prasad', 'Guntur', 1, 1, '2017-02-15 01:34:30', '2017-02-17 23:30:41'),
(11, 'Nani Info Tech', '9010102233', '9885420428', 'Subbarao Kota', 'Guntur', 1, 1, '2017-02-15 17:45:02', '2017-02-17 23:29:32'),
(12, 'Charvikent', '9885420428', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-16 17:23:30', '0000-00-00 00:00:00'),
(13, 'Prasad Bhavani Solutions', '9705828097', '98554285852', 'Prasad', 'AT Agraharam', 1, 14, '2017-02-16 17:34:35', '2017-02-22 00:05:31'),
(14, 'Sri Sri Sri Prasad', '9090909090', '', 'Prasad', 'Sri Sri Sri', 1, 1, '2017-02-16 17:41:57', '0000-00-00 00:00:00'),
(15, 'Sri Sri Sri Prasad', '9090909090', '', 'Prasad', 'Sri Sri Sri', 1, 1, '2017-02-16 17:42:01', '0000-00-00 00:00:00'),
(16, 'Sri Sri Sri Prasad Tech', '9090909090', '', 'Prasad', 'Sri Sri Sri', 1, 1, '2017-02-16 17:42:49', '2017-02-17 20:13:52'),
(17, 'Prasad Tech', '9885420428', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-16 20:55:07', '0000-00-00 00:00:00'),
(18, 'Prasad Tech Soft', '9885420427', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-16 20:55:49', '2017-02-22 00:03:10'),
(19, 'Praad', '48484584', '98', 'Krish', 'AT Agraharam', 1, 1, '2017-02-16 20:57:26', '0000-00-00 00:00:00'),
(20, 'Prasad Tech', '98854204252', '', 'Prasad', 'At Agraharam', 1, 1, '2017-02-16 21:03:44', '0000-00-00 00:00:00'),
(21, 'Pradsad', '9847946', '', 'Praad', 'dsfdsfds', 1, 14, '2017-02-16 21:08:32', '0000-00-00 00:00:00'),
(22, 'Pradsad', '9847946', '', 'Praad', 'dsfdsfds', 1, 14, '2017-02-16 21:09:31', '0000-00-00 00:00:00'),
(23, 'Pradsad', '9847946', '', 'Praad', 'dsfdsfds', 1, 14, '2017-02-16 21:09:52', '0000-00-00 00:00:00'),
(24, 'Prasad Tech', '9885420428', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-16 22:59:56', '0000-00-00 00:00:00'),
(25, 'Prasad Tech', '9885420428', '', 'Prasad', 'At Agraharam', 1, 1, '2017-02-16 23:03:55', '2017-02-16 23:06:29'),
(26, 'Prasad Tech Soft Solutions', '9885420428', '9491862697', 'Prasad', 'At Agraham', 1, 1, '2017-02-16 23:05:51', '2017-02-17 23:37:46'),
(27, 'Job Solutions', '9491862697', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-16 23:14:07', '0000-00-00 00:00:00'),
(28, 'Prasad Tech Soft', '9885420426', '', 'Prasad Bhavani', 'Guntu', 1, 1, '2017-02-17 09:27:20', '2017-02-17 23:27:04'),
(29, 'Prasad Solutions', '9885420422', '9491862697', 'Krish', 'Guntur', 1, 1, '2017-02-17 10:41:22', '0000-00-00 00:00:00'),
(30, 'Prasad Solutions', '9885420428', '', 'Srinu', 'AT Agraharam', 1, 1, '2017-02-17 10:42:10', '0000-00-00 00:00:00'),
(31, 'Prasad Solutions', '9885420428', '', 'Prasad', '', 0, 0, '2017-02-17 20:47:35', '0000-00-00 00:00:00'),
(32, 'Prasad Tech Soft', '9491862697', '', 'Prasad', 'Guntur', 1, 1, '2017-02-19 21:32:02', '0000-00-00 00:00:00'),
(33, 'Prasad Tech Soft', '9491862697', '', 'Prasad', 'Guntur', 1, 1, '2017-02-19 21:45:19', '0000-00-00 00:00:00'),
(34, 'Prasad Soft', '9491862697', '', 'Srinu', 'AT Agraharam', 1, 1, '2017-02-19 21:51:10', '0000-00-00 00:00:00'),
(35, 'Ganesh Soft', '9858542802', '', 'Ganesh', 'AT Agraharam', 1, 1, '2017-02-19 21:59:29', '0000-00-00 00:00:00'),
(36, 'Srivalli Instra', '9705828092', '', 'Srivalli', 'AT Agraharam', 1, 1, '2017-02-19 22:01:07', '0000-00-00 00:00:00'),
(37, 'Ganesh Soft', '9491862697', '', 'Ganesh', 'At Agraharam', 1, 1, '2017-02-19 23:38:12', '0000-00-00 00:00:00'),
(38, 'Sri Tech', '97508855958', '', 'Sri', 'AT Agraharam', 1, 1, '2017-02-20 00:04:22', '0000-00-00 00:00:00'),
(39, 'Sandeep Soft Tech', '9491862695', '', 'Sandeep', '', 0, 0, '2017-02-21 12:38:19', '0000-00-00 00:00:00'),
(40, 'Sri Tech', '9405852888', '', 'Srivas', 'Guntur', 1, 1, '2017-02-21 20:11:04', '0000-00-00 00:00:00'),
(41, 'Deva Infra', '9582588555', '', 'Deva', 'Bus Stand Road', 1, 1, '2017-02-21 20:13:42', '0000-00-00 00:00:00'),
(42, 'Selvamaran Services', '94568955965', '', 'Selvam', 'Guntur', 1, 1, '2017-02-21 20:16:01', '0000-00-00 00:00:00'),
(43, 'Srinu Krish', '9858542820', '', 'Srinu', 'Guntur', 1, 1, '2017-02-21 21:28:09', '0000-00-00 00:00:00'),
(44, 'Kishore Solutions', '9491862698', '', 'Kishore', 'AT Agraharam', 1, 1, '2017-02-21 21:41:45', '0000-00-00 00:00:00'),
(45, 'Sri Sai Ganesh', '97524826982', '', 'Sai Siva', 'Guntur', 1, 2, '2017-02-21 21:45:21', '0000-00-00 00:00:00'),
(46, 'Siva Sai Infotech', '9458298552', '', 'Siva Sai', 'Guntur', 1, 1, '2017-02-21 21:46:56', '0000-00-00 00:00:00'),
(47, 'Ganesh Tech', '9584582895', '', 'Ganesh', 'Bus Station', 1, 1, '2017-02-21 22:18:52', '0000-00-00 00:00:00'),
(48, 'Sai Ganapathi', '94586895869', '', 'Ganapathi', 'AT Agraharam', 1, 1, '2017-02-21 22:20:19', '0000-00-00 00:00:00'),
(49, 'Prasad Tech', '9885420428', '', 'Prasad', 'AT Agraharam', 1, 1, '2017-02-21 22:31:53', '0000-00-00 00:00:00'),
(50, 'Ganesh Tech Soft', '9491862697', '', 'Ganesh', 'Bus Stand, 4th Lane', 1, 1, '2017-02-21 22:33:26', '0000-00-00 00:00:00'),
(51, 'Singu Solutions', '9705838065', '', 'Siva K.', '', 0, 0, '2017-02-21 22:35:21', '0000-00-00 00:00:00'),
(52, 'Siva Sai Tech', '9885420428', '', 'Siva Sai', 'Guntur', 1, 1, '2017-02-21 22:37:32', '0000-00-00 00:00:00'),
(53, 'Siva Sai Tech Soft', '94856895868', '', 'Siva Kumar', 'AT Agraharam', 1, 1, '2017-02-21 22:41:57', '0000-00-00 00:00:00'),
(54, 'Aravindh Solutions', '9854240285', '', 'Aravindh', '', 0, 0, '2017-02-21 22:42:45', '0000-00-00 00:00:00'),
(55, 'Lyratechnologies', '9885420428', '', 'Mallesh Talluri', '', 0, 0, '2017-02-21 22:43:56', '0000-00-00 00:00:00'),
(56, 'Charvikent', '9491862697', '', 'Ramesh Babu', 'AT Agraharam', 1, 1, '2017-02-21 22:45:05', '0000-00-00 00:00:00'),
(57, 'Shambo Shamba Siva Groups', '9000600058', '', 'Shiva Kumar', 'RTC Bus Stand Opposite', 1, 1, '2017-02-21 22:47:33', '0000-00-00 00:00:00'),
(58, 'Sai Durga', '9458866895', '', 'Sai Durga', '', 0, 0, '2017-02-21 22:48:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL,
  `sector` varchar(250) NOT NULL,
  `dept` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `is_view` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `sector`, `dept`, `status`, `created_date_time`, `updated_date_time`, `is_view`) VALUES
(1, 'CRM', 'Master', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(3, 'CRM', 'Marketing', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(4, 'CRM', 'Sales', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(5, 'CRM', 'Service', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(6, 'CRM', 'Solution', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(7, 'CRM', 'Accounts', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(8, 'CRM', 'Feedback', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1),
(9, 'CRM', 'Partner', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 0),
(10, 'CRM', 'User', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dept_roles`
--

CREATE TABLE IF NOT EXISTS `dept_roles` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `role` varchar(250) NOT NULL,
  `label` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `multiple_branches` int(11) NOT NULL,
  `is_multiple` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_roles`
--

INSERT INTO `dept_roles` (`id`, `dept_id`, `role`, `label`, `status`, `created_date_time`, `updated_date_time`, `multiple_branches`, `is_multiple`) VALUES
(1, 1, 'Super Admin', 'MASSA', 1, '2016-11-22 00:00:00', '2016-11-22 00:00:00', 0, 0),
(2, 1, 'Admin', 'MASAD', 1, '2016-11-22 00:00:00', '2016-11-22 00:00:00', 1, 0),
(3, 3, 'Head', 'MARHE', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 0),
(4, 3, 'Executive', 'MAREX', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(5, 3, 'Lead Manager', 'MARLM', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(6, 4, 'Head', 'SALHE', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 0),
(7, 4, 'Executive', 'SALEX', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(8, 5, 'Head', 'SERHE', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 0),
(9, 5, 'Executive', 'SEREX', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(10, 6, 'Head', 'SOLHE', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 0),
(11, 6, 'Executive', 'SOLEX', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(12, 7, 'Accountant', 'ACUNT', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 0),
(13, 8, 'Telecaller', 'FEDTC', 1, '2016-11-16 20:46:54', '2016-11-16 20:46:54', 1, 1),
(14, 3, 'Telecaller', 'MARTC', 1, '2017-02-02 16:35:32', '2017-02-02 19:51:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(250) NOT NULL,
  `emp_pass` varchar(250) NOT NULL,
  `emp_dept_id` int(11) NOT NULL,
  `emp_role_id` int(11) NOT NULL,
  `emp_branch_ids` varchar(250) NOT NULL,
  `emp_grade_id` varchar(250) NOT NULL,
  `emp_email` varchar(250) NOT NULL,
  `emp_name` varchar(250) NOT NULL,
  `emp_phone_no` varchar(250) NOT NULL,
  `emp_state_id` int(11) NOT NULL,
  `emp_city_id` int(11) NOT NULL,
  `emp_addr` text NOT NULL,
  `emp_education` varchar(250) NOT NULL,
  `emp_pan_no` varchar(250) NOT NULL,
  `emp_bank_name` varchar(250) NOT NULL,
  `emp_bank_ac_no` varchar(250) NOT NULL,
  `emp_bank_branch` varchar(250) NOT NULL,
  `emp_bank_ifsc_code` varchar(250) NOT NULL,
  `emp_photo` varchar(250) NOT NULL,
  `emp_status` int(11) NOT NULL,
  `emp_created_date_time` datetime NOT NULL,
  `emp_last_updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `emp_pass`, `emp_dept_id`, `emp_role_id`, `emp_branch_ids`, `emp_grade_id`, `emp_email`, `emp_name`, `emp_phone_no`, `emp_state_id`, `emp_city_id`, `emp_addr`, `emp_education`, `emp_pan_no`, `emp_bank_name`, `emp_bank_ac_no`, `emp_bank_branch`, `emp_bank_ifsc_code`, `emp_photo`, `emp_status`, `emp_created_date_time`, `emp_last_updated_date_time`) VALUES
(1, 'nivsmart@admin.com', 'NivSmart@444', 1, 1, '', '', 'info@nivinfo.com', 'NIV SMART', '', 0, 0, '', '', '', '', '', '', '', '', 1, '2016-11-23 22:52:00', '2016-11-23 00:56:56'),
(2, 'MASAD001', '12345', 1, 2, '1,2,', '', 'bhavaniprasadkoppana@gmail.com', 'Prasad Bhavani', '9491862697', 1, 1, 'AT Agraharam', 'MCA', '123456789', 'HDFC Bank', '123456789', 'Kakinada', 'HD5689', '', 1, '2016-11-22 01:04:47', '2017-03-04 12:34:16'),
(3, 'MARHE002', '12345', 3, 3, '1,2,', '', 'gopi@gmail.com', 'Gopi', '9491862697', 1, 1, 'At Agraharam', 'M.Tech', '123456', 'State Bank of India', '12345678', 'Guntur', '123456789', '', 1, '2016-11-22 01:05:51', '2017-02-02 22:50:20'),
(4, 'MAREX003', '12345', 3, 4, '1,3,2,', '', 'bhavani@gmail.com', 'Prasad', '9491862697', 1, 1, 'At Agraharam', 'MCA', '121212', '1212', '12121', '12121', '121212', '', 1, '2016-11-22 01:06:29', '2017-02-02 22:50:20'),
(5, 'MARLM004', '12345', 3, 5, ',', '', 'subbarao.kota@gmail.com', 'Subbarao', '9292101033', 1, 2, 'Near Main Road', 'B.Tech', '1234559', 'State Bank of India', '1234567890', 'Tenali Branch', 'SB12568', '', 1, '2016-11-22 01:09:12', '2017-03-04 16:27:20'),
(6, 'MARLM006', '12345', 3, 5, '1,2,3,4,', '', 'bhavaniprasad@gmail.com', 'Prasad', '9493094998', 1, 1, 'AT Agraharam', 'MCA', '12346', 'HDFC', '1234567890', 'HDFC Branch', 'HD123456', '', 1, '2016-11-26 18:46:50', '2017-02-02 22:50:20'),
(7, 'SALHE007', '12345', 4, 6, '1,2,3,', '', 'vamshi@gmail.com', 'Vamshi', '9491862697', 1, 1, 'Bus Stand', 'MCA', '12345678', 'Andhra Bank', '1234569', 'Main Branch', 'ABN12346', '', 1, '2016-12-08 11:51:39', '2017-02-02 22:50:20'),
(8, 'SERHE008', '12345', 5, 8, '1,2,4,', '', 'gopitirumala@gmail.com', 'Gopi', '9703655655', 1, 1, 'Main Roard', 'M.Tech', '56895632', 'State Bank of india', '5002368956995', 'Guntur Branch', 'SBN65896', '', 1, '2016-12-08 11:57:13', '2017-02-02 22:50:20'),
(9, 'SOLHE009', '12345', 6, 10, '1,2,3,4,', '', 'kishore@gmail.com', 'Kishore', '9703655655', 1, 1, 'AT Agraharam', 'MCOM', '50068956699', 'HDFC Bank', '5002358997451', 'Main Branch', 'HD56895', '', 1, '2016-12-08 12:00:11', '2017-02-02 22:50:20'),
(10, 'SEREX010', '12345', 5, 9, '1,2,3,', '', 'srinu@gmail.com', 'Srinu', '9885420428', 1, 1, 'Guntur', 'MCA', '1254696', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:06:50', '2017-02-02 22:50:20'),
(11, 'SEREX011', '12345', 5, 9, '1,2,3,4,', '', 'krish@gmail.com', 'Krishna', '9705828097', 1, 1, 'Guntur', 'M.Tech', '12968', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:07:25', '2017-02-02 22:50:20'),
(12, 'SEREX012', '12345', 5, 9, '1,2,3,4,', '', 'vani@gmail.com', 'Vani', '9429588595', 1, 1, 'Guntur', 'BSC', '568955', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:08:06', '2017-02-02 22:50:20'),
(13, 'SALEX013', '12345', 4, 7, '1,2,3,', '', 'prasad@gmail.com', 'Prasad Bhavani', '9705555555', 1, 1, 'Guntur', 'MBA', '5689566', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:48:42', '2017-02-02 22:50:20'),
(14, 'SALEX014', '12345', 4, 7, '1,2,3,', '', 'gopi123@gmail.com', 'Gopi Tirumala', '9676672567', 1, 1, 'Guntur', 'MSC', '685558555', 'no', 'no', 'no', 'no', '', 0, '2016-12-29 16:50:52', '2017-02-02 22:50:20'),
(15, 'SALEX015', '12345', 4, 7, '1,2,3,', '', 'mallesh.talluri@gmail.com', 'Mallesh Rao Talluri', '9705828097', 1, 1, 'Guntur', 'M.Tech', '568955225966', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:53:23', '2017-02-02 22:50:20'),
(16, 'SOLEX016', '12345', 6, 11, '1,2,3,4,', '', 'kishore.p@gmail.com', 'Kishore P', '9491862697', 1, 1, 'Guntur', 'MSC', '5689452699', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:54:49', '2017-02-02 22:50:20'),
(17, 'SOLEX017', '12345', 6, 11, '2,3,', '', 'nadhini@gmail.com', 'Nandhini', '9885420428', 1, 1, 'Guntur', 'B.Tech', '568422369', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:55:51', '2017-02-02 22:50:20'),
(18, 'SOLEX018', '12345', 6, 11, '2,3,4,', '', 'kalyani@gmail.com', 'Laksmi kalyani', '9705828097', 1, 1, 'Guntur', 'M.Tech', '568795555555', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 16:57:51', '2017-02-02 22:50:20'),
(19, 'MAREX019', '12345', 3, 4, '1,2,3,', '', 'rajkumar@gmail.com', 'Raj Kumar', '9705828095', 1, 1, 'Guntur', 'MBA', '125955558', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:01:09', '2017-02-02 22:50:20'),
(20, 'SALEX020', '12345', 4, 7, '1,2,3,', '', 'ganesh@gmail.com', 'Ganesh K.', '9988776655', 1, 1, 'Guntur', 'MSC', '1234568', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:01:56', '2017-02-02 22:50:20'),
(21, 'SEREX021', '12345', 5, 9, '2,3,', '', 'sirisha@gmail.com', 'Shirisha Valli', '8899776655', 1, 1, 'Guntur', 'M.Tech', '65984522', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:02:54', '2017-02-02 22:50:20'),
(22, 'SOLEX022', '12345', 6, 11, '1,2,4,', '', 'rohita@gmail.com', 'Rohita K.', '9705197052', 1, 1, 'Guntur', 'MSC', '5899547774', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:03:54', '2017-02-02 22:50:20'),
(23, 'SALEX023', '12345', 4, 7, '1,2,3,', '', 'madhuri@gmail.com', 'Madhuri P.', '9666596665', 1, 1, 'Guntur', 'MBA', '842269855', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:04:56', '2017-02-02 22:50:20'),
(24, 'MAREX024', '12345', 3, 4, '1,2,3,', '', 'venkat@gmail.com', 'Venkateswara Rao K.', '9440788799', 1, 1, 'Guntur', 'B.Tech', '256849522', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:06:16', '2017-02-02 22:50:20'),
(25, 'MARLM025', '12345', 3, 5, '1,2,3,', '', 'srivani@gmail.com', 'Srivani T.', '9988776655', 1, 1, 'Guntur', 'B.Tech', '5689744552', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:16:53', '2017-02-02 22:50:20'),
(26, 'MARLM026', '12345', 3, 5, '1,2,3,', '', 'nikitha@gmail.com', 'Nikitha P.', '9885420428', 1, 1, 'Guntur', 'MBA', '5689541', 'no', 'no', 'no', 'no', '', 1, '2016-12-29 17:18:03', '2017-02-02 22:50:20'),
(27, 'FEDTC027', '12345', 8, 13, '1,2,3,4,', '', 'gayatri@gmail.com', 'Gayatri', '9491862697', 1, 1, 'AT Agraharam', 'MBA', 'NA', 'NA', 'NA', 'NA', 'NA', '', 1, '2017-01-11 00:00:10', '2017-02-02 22:50:20'),
(28, 'ACUNT028', '12345', 7, 12, '1,2,3,', '', 'prasadmba@gmail.com', 'Prasad', '9885420428', 1, 1, 'Guntur', 'MBA', '', 'NA', 'NA', 'NA', 'NA', '', 1, '2017-01-27 17:55:35', '2017-02-02 22:50:20'),
(29, 'FEDTC029', '12345', 8, 13, '1,2,3,', '', 'srinuk@gmail.com', 'Srinu', '9885420428', 1, 1, 'Guntur', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '', 1, '2017-01-31 23:25:32', '2017-02-02 22:50:20'),
(30, 'MARHE030', '12345', 3, 3, '3,', '', 'gopi@gmail.com', 'Gopi', '9491862697', 1, 1, 'At Agraharam', 'M.Tech', '123456', 'State Bank of India', '12345678', 'Guntur', '123456789', '', 1, '2017-02-02 01:16:54', '2017-02-02 22:50:20'),
(31, 'MARTC031', '12345', 3, 14, '1,2,', '', 'prasadkoppana@gmail.com', 'Prasad', '9491862697', 1, 1, 'Guntur', 'MCA', '1234567890', 'NA', 'NA', 'NA', 'NA', '', 1, '2017-02-02 22:55:50', '0000-00-00 00:00:00'),
(32, 'FEDTC032', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana@gmail.com', 'Prasad Bhavani', '9584559854', 1, 2, 'dsf', 'dsfgdsf', 'dsdfds', 'qdfds', 'dsfgdsf', 'dsfdsfds', 'dsfdsfd', '', 1, '2017-03-04 16:28:53', '0000-00-00 00:00:00'),
(33, 'FEDTC033', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana@gmail.com', 'BHavnmo', '9885420428', 1, 2, 'sfa', 'df', 'dfdf', 'dsfds', 'dsfdsf', 'dfdsf', 'dsfdsf', '', 1, '2017-03-04 16:31:32', '0000-00-00 00:00:00'),
(34, 'ACUNT034', '12345', 7, 12, 'undefined,', '', 'bhavaniprasadkoppana@gmail.com', 'ds dsad', '9885420428', 1, 2, 'n', 'nbo', 'no', 'n', 'n', 'n', 'n', '', 1, '2017-03-04 16:32:33', '0000-00-00 00:00:00'),
(35, 'FEDTC035', '12345', 8, 13, ',', '', 'bhavaniprasadkoppana@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'o', '', 1, '2017-03-04 16:33:13', '0000-00-00 00:00:00'),
(36, 'FEDTC036', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana123@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:42:24', '0000-00-00 00:00:00'),
(37, 'FEDTC037', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana1243@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:42:31', '0000-00-00 00:00:00'),
(38, 'FEDTC038', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana124453@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:44:17', '0000-00-00 00:00:00'),
(39, 'FEDTC039', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana25124453@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:44:48', '0000-00-00 00:00:00'),
(40, 'FEDTC040', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana125124453@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:45:31', '0000-00-00 00:00:00'),
(41, 'FEDTC041', '12345', 8, 13, 'undefined,', '', 'bhavaniprasadkoppana125525124453@gmail.com', 'Prasad Bhavani', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:45:48', '0000-00-00 00:00:00'),
(42, 'ACUNT042', '12345', 7, 12, 'undefined,', '', 'bhavaniprasadkoppana5125@gmail.com', 'dfdsf', '9885420428', 1, 2, 'no', 'no', 'no', 'non', 'o', 'no', 'no', '', 1, '2017-03-04 16:46:42', '0000-00-00 00:00:00'),
(43, 'FEDTC043', '12345', 8, 13, '2,', '', 'bhavaniprasadkoppan@gmail.com', 'Prasd', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'on', 'no', '', 1, '2017-03-04 16:47:13', '0000-00-00 00:00:00'),
(44, 'MAREX044', '12345', 3, 4, '1,2,', '', 'bhavaniprasadkoppa@gmail.com', 'Prasad', '9885420428', 1, 2, 'no', 'no', 'no', 'no', 'no', 'no', 'no', '', 1, '2017-03-04 16:48:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lead_followups`
--

CREATE TABLE IF NOT EXISTS `lead_followups` (
  `id` int(11) NOT NULL,
  `lead_process_id` int(11) NOT NULL,
  `followup_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_followups`
--

INSERT INTO `lead_followups` (`id`, `lead_process_id`, `followup_date_time`) VALUES
(1, 6, '2017-02-23 23:56:00'),
(2, 0, '2017-02-23 23:57:00'),
(3, 0, '2017-02-23 23:57:00'),
(4, 0, '2017-02-23 23:57:00'),
(5, 0, '2017-02-23 23:57:00'),
(6, 3, '2017-02-23 23:59:00'),
(7, 3, '2017-02-24 00:00:00'),
(8, 13, '2017-02-25 00:01:00'),
(10, 15, '2017-02-16 00:09:00'),
(11, 16, '2017-02-23 00:11:00'),
(12, 17, '2017-02-24 00:12:00'),
(13, 19, '2017-02-16 00:14:00'),
(14, 20, '2017-02-24 00:15:00'),
(15, 24, '2017-02-16 00:20:00'),
(16, 49, '2017-02-23 23:03:00'),
(17, 50, '2017-02-25 23:05:00'),
(18, 52, '2017-02-25 23:06:00'),
(19, 53, '2017-02-25 23:09:00'),
(20, 34, '2017-02-22 19:05:00'),
(21, 86, '2017-02-15 23:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `lead_process`
--

CREATE TABLE IF NOT EXISTS `lead_process` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `tele_id` int(11) NOT NULL,
  `is_taken_from` int(11) NOT NULL,
  `is_present_at` int(11) NOT NULL,
  `is_moved_to` int(11) NOT NULL,
  `type_of_process` int(11) NOT NULL COMMENT '1=>completed,2=>droped,3=>followup,4=>freezed,5=>Moved,6=>cold,7=>Rollback,8=>Assign',
  `is_status` int(11) NOT NULL,
  `is_remarks` text NOT NULL,
  `is_taken_date_time` datetime NOT NULL,
  `is_updated_date_time` datetime NOT NULL,
  `is_taken_others` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_process`
--

INSERT INTO `lead_process` (`id`, `leadid`, `tele_id`, `is_taken_from`, `is_present_at`, `is_moved_to`, `type_of_process`, `is_status`, `is_remarks`, `is_taken_date_time`, `is_updated_date_time`, `is_taken_others`) VALUES
(3, 3, 6, 0, 6, 0, 6, 1, 'He is not Repond to take a call', '2017-02-12 22:58:32', '2017-02-12 22:59:05', 0),
(4, 3, 6, 0, 6, 0, 6, 1, 'Again Call After 4 Days', '2017-02-12 22:59:56', '2017-02-12 23:04:33', 0),
(5, 3, 6, 0, 6, 0, 6, 1, 'He not respond', '2017-02-12 23:04:48', '2017-02-12 23:44:12', 0),
(6, 3, 6, 0, 6, 0, 3, 1, 'Follow-up', '2017-02-12 23:44:28', '2017-02-12 23:56:50', 0),
(7, 3, 6, 0, 6, 0, 3, 1, 'Again Follow-up', '2017-02-12 23:56:50', '2017-02-12 23:57:40', 0),
(8, 3, 6, 0, 6, 0, 3, 1, 'Again Follow-up', '2017-02-12 23:57:40', '2017-02-12 23:57:44', 0),
(9, 3, 6, 0, 6, 0, 3, 1, 'Again Follow-up', '2017-02-12 23:57:44', '2017-02-12 23:57:44', 0),
(10, 3, 6, 0, 6, 0, 3, 1, 'Again Follow-up', '2017-02-12 23:57:44', '2017-02-12 23:57:45', 0),
(11, 3, 6, 0, 6, 0, 3, 1, 'Follow-up for Tomorrow', '2017-02-12 23:57:45', '2017-02-12 23:59:42', 0),
(12, 3, 6, 0, 6, 0, 3, 1, 'Follow-up 4th Time', '2017-02-12 23:59:42', '2017-02-13 00:00:24', 0),
(13, 3, 6, 0, 6, 0, 3, 1, 'Follow-up 5th Time', '2017-02-13 00:00:24', '2017-02-13 00:01:42', 0),
(14, 3, 6, 0, 6, 0, 5, 1, 'He want New Tally', '2017-02-13 00:01:42', '2017-02-13 00:02:16', 0),
(15, 2, 6, 0, 6, 0, 3, 1, 'Once Follow-up', '2017-02-13 00:03:09', '2017-02-13 00:10:56', 0),
(16, 2, 6, 0, 6, 0, 3, 1, 'Again Follow-up', '2017-02-13 00:10:56', '2017-02-13 00:12:06', 0),
(17, 2, 6, 0, 6, 0, 3, 1, 'Follow-up', '2017-02-13 00:12:06', '2017-02-13 00:12:39', 0),
(18, 2, 6, 0, 6, 0, 5, 1, 'New Tally', '2017-02-13 00:12:39', '2017-02-13 00:13:01', 0),
(19, 5, 6, 0, 6, 0, 3, 1, 'Once Follow-up', '2017-02-13 00:13:26', '2017-02-13 00:14:31', 0),
(20, 5, 6, 0, 6, 0, 3, 1, 'no', '2017-02-13 00:14:31', '2017-02-13 00:15:54', 0),
(21, 5, 6, 0, 6, 0, 5, 1, 'New Tally', '2017-02-13 00:15:54', '2017-02-13 00:16:12', 0),
(22, 3, 6, 6, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-13 00:02:16', '2017-02-13 00:17:53', 0),
(23, 5, 6, 6, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-13 00:16:12', '2017-02-13 00:17:53', 0),
(24, 5, 6, 7, 7, 0, 3, 1, 'He ask to meet at evening time', '2017-02-13 00:17:53', '2017-02-13 00:21:02', 0),
(25, 5, 6, 7, 6, 7, 5, 1, 'ok You can proceed', '2017-02-13 00:21:02', '2017-02-13 00:21:48', 0),
(26, 5, 6, 6, 7, 0, 5, 1, 'Quotation Request', '2017-02-13 00:21:48', '2017-02-13 00:24:16', 0),
(27, 5, 6, 7, 28, 7, 5, 1, 'Quotation Generated', '2017-02-13 00:24:16', '2017-02-13 12:41:13', 0),
(28, 5, 6, 28, 7, 0, 5, 1, 'Once Generate Quotation', '2017-02-13 12:41:13', '2017-02-13 12:43:01', 0),
(29, 5, 6, 7, 28, 7, 5, 1, 'Quotation Generated', '2017-02-13 12:43:01', '2017-02-13 12:46:54', 0),
(30, 5, 6, 28, 7, 0, 5, 1, 'Once again update Quotation', '2017-02-13 12:46:54', '2017-02-13 12:58:44', 0),
(31, 5, 6, 7, 28, 7, 5, 1, 'New Updated Quotation', '2017-02-13 12:58:44', '2017-02-13 13:11:23', 0),
(32, 5, 6, 28, 7, 0, 5, 1, 'Quotation', '2017-02-13 13:11:23', '2017-02-13 13:12:50', 0),
(33, 5, 6, 7, 28, 7, 5, 1, 'Updated Quotation', '2017-02-13 13:12:50', '2017-02-13 13:13:54', 0),
(34, 10, 6, 0, 6, 0, 3, 1, 'Follow-up', '2017-02-15 01:37:51', '2017-02-17 19:06:10', 0),
(35, 3, 6, 7, 7, 0, 5, 1, 'Generate Quotation', '2017-02-13 00:17:53', '2017-02-15 10:19:38', 0),
(36, 2, 6, 6, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-13 00:13:01', '2017-02-15 10:53:48', 0),
(37, 13, 31, 0, 31, 0, 5, 1, 'He want to New Tally', '2017-02-16 17:34:35', '2017-02-22 00:42:33', 0),
(38, 14, 31, 0, 31, 0, 0, 0, '', '2017-02-16 17:41:57', '0000-00-00 00:00:00', 0),
(39, 15, 31, 0, 31, 0, 0, 0, '', '2017-02-16 17:42:01', '0000-00-00 00:00:00', 0),
(40, 16, 31, 31, 31, 0, 6, 1, 'Once update and Follow-up Again', '2017-02-16 17:42:49', '2017-02-17 20:37:24', 0),
(41, 17, 31, 31, 31, 0, 0, 1, '', '2017-02-16 20:55:07', '2017-02-16 20:55:07', 0),
(42, 18, 31, 31, 31, 0, 0, 1, '', '2017-02-16 20:55:49', '2017-02-16 20:55:49', 0),
(43, 19, 31, 31, 31, 0, 0, 1, '', '2017-02-16 20:57:26', '2017-02-16 20:57:26', 0),
(44, 20, 31, 31, 31, 0, 0, 1, '', '2017-02-16 21:03:44', '2017-02-16 21:03:44', 0),
(45, 21, 31, 31, 31, 0, 0, 0, '', '2017-02-16 21:08:32', '0000-00-00 00:00:00', 0),
(46, 22, 31, 31, 31, 0, 0, 0, '', '2017-02-16 21:09:31', '0000-00-00 00:00:00', 0),
(47, 23, 31, 31, 31, 0, 0, 0, '', '2017-02-16 21:09:52', '0000-00-00 00:00:00', 0),
(49, 25, 31, 31, 31, 0, 3, 1, '', '2017-02-16 23:03:55', '2017-02-16 23:03:55', 0),
(50, 26, 31, 31, 31, 0, 3, 1, 'Once Follow-up', '2017-02-16 23:05:51', '2017-02-16 23:05:51', 0),
(51, 25, 31, 0, 31, 0, 5, 1, 'New Tally', '2017-02-16 23:03:55', '2017-02-16 23:06:29', 0),
(52, 26, 31, 0, 31, 0, 3, 1, 'Follow-up', '2017-02-16 23:05:51', '2017-02-16 23:07:02', 0),
(53, 26, 31, 0, 31, 0, 3, 1, 'Once Again Follow-up', '2017-02-16 23:07:02', '2017-02-16 23:09:52', 0),
(54, 27, 31, 31, 31, 0, 2, 1, 'He Droped', '2017-02-16 23:14:07', '2017-02-16 23:14:07', 0),
(55, 5, 6, 28, 7, 0, 4, 1, 'It''s Completed', '2017-02-13 13:13:54', '2017-02-16 23:31:12', 0),
(56, 5, 6, 7, 7, 0, 4, 1, 'It''s Completed', '2017-02-16 23:31:12', '2017-02-16 23:34:48', 0),
(57, 5, 6, 7, 7, 0, 4, 1, 'It''s Completed', '2017-02-16 23:34:48', '2017-02-16 23:35:27', 0),
(58, 2, 6, 7, 7, 0, 5, 1, 'UPdate Quotation', '2017-02-15 10:53:48', '2017-02-16 23:37:21', 0),
(59, 3, 6, 7, 28, 7, 5, 1, 'It''s Finished', '2017-02-15 10:19:38', '2017-02-16 23:38:41', 0),
(60, 3, 6, 28, 7, 0, 4, 1, 'gdg fdg', '2017-02-16 23:38:41', '2017-02-16 23:41:52', 0),
(61, 3, 29, 7, 29, 0, 0, 0, '', '2017-02-16 23:46:16', '0000-00-00 00:00:00', 0),
(62, 3, 6, 7, 29, 7, 7, 1, 'Update Check List', '2017-02-16 23:41:52', '2017-02-16 23:46:29', 0),
(63, 25, 31, 31, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-16 23:06:29', '2017-02-16 23:48:55', 0),
(64, 3, 6, 29, 7, 0, 4, 1, 'sd dasdsad', '2017-02-16 23:46:29', '2017-02-16 23:50:53', 0),
(65, 3, 6, 7, 7, 0, 4, 1, 'sd dasdsad', '2017-02-16 23:50:53', '2017-02-16 23:50:55', 0),
(66, 3, 6, 7, 7, 0, 4, 1, 'sd dasdsad', '2017-02-16 23:50:55', '2017-02-16 23:50:55', 0),
(67, 3, 29, 7, 29, 0, 8, 0, 'Lead In-progress', '2017-02-16 23:52:33', '0000-00-00 00:00:00', 0),
(68, 3, 6, 7, 29, 7, 7, 1, 'Roll Backed', '2017-02-16 23:50:55', '2017-02-16 23:52:46', 0),
(69, 3, 6, 29, 7, 0, 4, 1, 'Updated All Fields', '2017-02-16 23:52:46', '2017-02-17 00:37:09', 0),
(70, 3, 29, 7, 29, 0, 8, 0, 'Lead In-progress', '2017-02-17 00:38:09', '0000-00-00 00:00:00', 0),
(71, 3, 6, 7, 29, 7, 7, 1, 'Once check Chceklist', '2017-02-17 00:37:09', '2017-02-17 00:38:23', 0),
(72, 3, 6, 29, 7, 0, 4, 1, 'fdsf dfdsfdsf', '2017-02-17 00:38:23', '2017-02-17 00:39:28', 0),
(73, 3, 29, 7, 29, 0, 8, 0, 'Lead In-progress', '2017-02-17 00:40:44', '0000-00-00 00:00:00', 0),
(74, 3, 6, 7, 29, 7, 7, 1, 'Once check Checklist Again', '2017-02-17 00:39:28', '2017-02-17 00:40:58', 0),
(75, 3, 6, 29, 7, 0, 4, 1, 'dsadsdsa dsads', '2017-02-17 00:40:58', '2017-02-17 00:41:42', 0),
(76, 5, 29, 7, 29, 0, 8, 0, 'Lead In-progress', '2017-02-17 00:42:57', '0000-00-00 00:00:00', 0),
(77, 5, 6, 7, 29, 7, 7, 1, 'Once checklist Check', '2017-02-16 23:35:27', '2017-02-17 00:43:11', 0),
(78, 5, 6, 29, 7, 0, 4, 1, 'He Stayed', '2017-02-17 00:43:11', '2017-02-17 01:11:45', 0),
(79, 5, 29, 7, 29, 0, 8, 0, 'Lead In-progress', '2017-02-17 01:12:34', '0000-00-00 00:00:00', 0),
(80, 5, 6, 7, 29, 7, 7, 1, 'Once check', '2017-02-17 01:11:45', '2017-02-17 01:12:43', 0),
(81, 28, 6, 0, 6, 0, 0, 0, '', '2017-02-17 09:28:19', '0000-00-00 00:00:00', 0),
(82, 30, 31, 0, 31, 0, 0, 0, '', '2017-02-17 17:08:19', '0000-00-00 00:00:00', 0),
(83, 29, 31, 0, 31, 0, 0, 0, '', '2017-02-17 17:10:21', '0000-00-00 00:00:00', 0),
(84, 30, 31, 0, 31, 0, 0, 0, '', '2017-02-17 17:11:15', '0000-00-00 00:00:00', 0),
(85, 29, 31, 0, 31, 0, 0, 0, '', '2017-02-17 17:11:15', '0000-00-00 00:00:00', 0),
(86, 11, 6, 0, 6, 0, 3, 1, 'He want to once call me at 6pm', '2017-02-17 19:05:50', '2017-02-21 23:39:35', 0),
(87, 16, 31, 0, 31, 0, 6, 1, 'Update and Follow-up Again', '2017-02-17 20:37:24', '2017-02-17 20:39:53', 0),
(88, 16, 31, 0, 31, 0, 6, 1, 'Call After 2 Days', '2017-02-17 20:39:53', '2017-02-22 00:07:13', 0),
(89, 4, 6, 0, 6, 0, 6, 1, 'He is not respond to Take a Call', '2017-02-17 20:49:06', '2017-02-21 23:15:36', 0),
(91, 33, 31, 31, 31, 0, 0, 0, '', '2017-02-19 21:45:19', '0000-00-00 00:00:00', 0),
(92, 34, 31, 31, 31, 0, 0, 0, '', '2017-02-19 21:51:10', '0000-00-00 00:00:00', 0),
(93, 35, 31, 31, 31, 0, 0, 0, '', '2017-02-19 21:59:29', '0000-00-00 00:00:00', 0),
(94, 36, 31, 31, 31, 0, 0, 0, '', '2017-02-19 22:01:07', '0000-00-00 00:00:00', 0),
(95, 38, 6, 0, 6, 0, 5, 1, 'He want new Tally', '2017-02-20 00:04:58', '2017-02-20 00:05:33', 0),
(96, 38, 6, 6, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-20 00:05:33', '2017-02-20 00:08:51', 0),
(97, 38, 6, 7, 7, 0, 5, 1, 'New Quotation', '2017-02-20 00:08:51', '2017-02-20 00:09:49', 0),
(98, 47, 31, 31, 31, 0, 0, 0, '', '2017-02-21 22:18:52', '0000-00-00 00:00:00', 0),
(99, 48, 31, 31, 31, 0, 0, 0, '', '2017-02-21 22:20:19', '0000-00-00 00:00:00', 0),
(100, 4, 6, 0, 6, 0, 6, 1, 'He dont want intreset', '2017-02-21 23:23:51', '2017-02-21 23:25:19', 0),
(101, 16, 31, 0, 31, 0, 0, 0, '', '2017-02-22 00:07:13', '0000-00-00 00:00:00', 0),
(102, 25, 31, 7, 7, 13, 5, 1, 'Lead Handle', '2017-02-16 23:48:55', '2017-02-22 20:15:40', 0),
(103, 3, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-02-22 20:42:34', '0000-00-00 00:00:00', 0),
(104, 3, 6, 7, 27, 7, 7, 1, 'Once check this lead', '2017-02-17 00:41:42', '2017-02-22 20:47:27', 0),
(105, 3, 6, 27, 7, 0, 2, 1, 'He Dont want to Intrest for Tally', '2017-02-22 20:47:27', '2017-02-22 20:51:13', 0),
(106, 3, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-02-22 20:51:47', '0000-00-00 00:00:00', 0),
(107, 13, 31, 31, 7, 7, 8, 1, 'Lead Assigned and In-progress', '2017-02-22 00:42:33', '2017-02-23 10:48:01', 0),
(108, 38, 6, 7, 28, 7, 5, 1, 'fdsfd', '2017-02-20 00:09:49', '2017-02-23 12:00:45', 0),
(109, 38, 6, 28, 7, 0, 5, 1, 'Once Check Quotation', '2017-02-23 12:00:45', '2017-02-23 23:32:17', 0),
(110, 38, 6, 7, 7, 0, 5, 1, 'Once Check Quotation', '2017-02-23 23:32:17', '2017-02-23 23:32:43', 0),
(111, 38, 6, 7, 28, 7, 5, 1, 'Ok', '2017-02-23 23:32:43', '2017-02-24 01:32:11', 0),
(112, 2, 6, 7, 28, 7, 7, 1, 'Please Generate quotation', '2017-02-16 23:37:21', '2017-03-02 22:51:26', 0),
(113, 2, 6, 28, 7, 0, 5, 1, 'no remarks', '2017-03-02 22:51:26', '2017-03-02 22:53:16', 0),
(114, 2, 6, 7, 28, 7, 7, 1, 'Please update quotation', '2017-03-02 22:53:16', '2017-03-02 22:57:18', 0),
(115, 2, 6, 28, 7, 0, 5, 1, 'Tally', '2017-03-02 22:57:18', '2017-03-02 23:00:43', 0),
(116, 2, 6, 7, 28, 7, 7, 1, 'UPdate Quoation', '2017-03-02 23:00:43', '2017-03-03 01:00:12', 0),
(117, 2, 6, 28, 7, 0, 5, 1, 'No Remarks', '2017-03-03 01:00:12', '2017-03-03 01:02:11', 0),
(118, 2, 6, 7, 28, 7, 7, 1, 'Re generate', '2017-03-03 01:02:11', '2017-03-03 01:18:58', 0),
(119, 2, 6, 28, 7, 0, 5, 1, 'No Remarks', '2017-03-03 01:18:58', '2017-03-03 01:24:10', 0),
(120, 2, 6, 7, 28, 7, 5, 1, 'This is verified', '2017-03-03 01:24:10', '2017-03-03 01:29:48', 0),
(121, 2, 6, 28, 7, 0, 5, 1, 'Once check', '2017-03-03 01:29:48', '2017-03-03 01:39:25', 0),
(122, 2, 6, 7, 7, 0, 5, 1, 'Once check', '2017-03-03 01:39:25', '2017-03-03 01:40:23', 0),
(123, 2, 6, 7, 7, 0, 5, 1, 'Once check', '2017-03-03 01:40:23', '2017-03-03 01:41:18', 0),
(124, 2, 6, 7, 28, 7, 7, 1, 'Recheck', '2017-03-03 01:41:18', '2017-03-03 01:42:53', 0),
(125, 2, 6, 28, 7, 0, 5, 1, 'No Remarks', '2017-03-03 01:42:53', '2017-03-03 01:44:07', 0),
(126, 2, 6, 7, 28, 7, 5, 1, 'Lead is verified', '2017-03-03 01:44:07', '2017-03-03 01:44:47', 0),
(127, 2, 6, 28, 7, 0, 5, 1, 'Once check again', '2017-03-03 01:44:47', '2017-03-03 01:45:32', 0),
(128, 2, 6, 7, 28, 7, 7, 1, 'Not Checked', '2017-03-03 01:45:32', '2017-03-03 01:47:32', 0),
(129, 2, 6, 28, 7, 0, 4, 1, 'No Remarks', '2017-03-03 01:47:32', '2017-03-03 01:53:07', 0),
(130, 2, 6, 7, 7, 0, 4, 1, 'No Remarks', '2017-03-03 01:53:07', '2017-03-03 01:56:12', 0),
(131, 2, 6, 7, 7, 0, 4, 1, 'No Remarks', '2017-03-03 01:56:12', '2017-03-03 01:56:16', 0),
(132, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 10:15:44', '0000-00-00 00:00:00', 0),
(133, 2, 6, 7, 27, 7, 7, 1, 'Once check Customer Information', '2017-03-03 01:56:16', '2017-03-03 10:28:12', 0),
(134, 2, 6, 27, 7, 0, 4, 1, 'He is satisfied', '2017-03-03 10:28:12', '2017-03-03 16:40:57', 0),
(135, 2, 6, 7, 7, 0, 4, 1, 'He is satisfied', '2017-03-03 16:40:57', '2017-03-03 16:43:04', 0),
(136, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 16:58:59', '0000-00-00 00:00:00', 0),
(137, 2, 6, 7, 27, 7, 7, 1, 'Check it', '2017-03-03 16:43:04', '2017-03-03 16:59:10', 0),
(138, 2, 6, 27, 7, 0, 4, 1, 'He is Satisfied', '2017-03-03 16:59:10', '2017-03-03 17:05:36', 0),
(139, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 17:12:04', '0000-00-00 00:00:00', 0),
(140, 2, 6, 7, 27, 7, 7, 1, 'Check it once', '2017-03-03 17:05:36', '2017-03-03 17:12:16', 0),
(141, 2, 6, 27, 7, 0, 4, 1, 'He is satisfied', '2017-03-03 17:12:16', '2017-03-03 17:19:45', 0),
(142, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 17:33:08', '0000-00-00 00:00:00', 0),
(143, 2, 6, 7, 27, 7, 7, 1, 'Check it once', '2017-03-03 17:19:45', '2017-03-03 17:33:43', 0),
(144, 2, 6, 27, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 17:33:43', '2017-03-03 18:09:26', 0),
(145, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:26', '2017-03-03 18:09:28', 0),
(146, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:28', '2017-03-03 18:09:30', 0),
(147, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:30', '2017-03-03 18:09:31', 0),
(148, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:31', '2017-03-03 18:09:32', 0),
(149, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:32', '2017-03-03 18:09:32', 0),
(150, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:32', '2017-03-03 18:09:32', 0),
(151, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:32', '2017-03-03 18:09:32', 0),
(152, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:32', '2017-03-03 18:09:32', 0),
(153, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:32', '2017-03-03 18:09:33', 0),
(154, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:33', '2017-03-03 18:09:33', 0),
(155, 2, 6, 7, 7, 0, 4, 1, 'Yes Lead Completed', '2017-03-03 18:09:33', '2017-03-03 18:10:38', 0),
(156, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 18:11:14', '0000-00-00 00:00:00', 0),
(157, 2, 6, 7, 27, 7, 7, 1, 'Once again Check', '2017-03-03 18:10:38', '2017-03-03 18:11:25', 0),
(158, 2, 6, 27, 7, 0, 4, 1, 'Lead Completed', '2017-03-03 18:11:25', '2017-03-03 18:15:05', 0),
(159, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 18:15:32', '0000-00-00 00:00:00', 0),
(160, 2, 6, 7, 27, 7, 7, 1, 'Yaaa Check this once', '2017-03-03 18:15:05', '2017-03-03 18:15:48', 0),
(161, 2, 6, 27, 7, 0, 4, 1, 'He is completed', '2017-03-03 18:15:48', '2017-03-03 22:50:19', 0),
(162, 2, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 23:01:42', '0000-00-00 00:00:00', 0),
(163, 2, 6, 7, 27, 7, 1, 1, 'He is Satisfied', '2017-03-03 22:50:19', '2017-03-03 23:01:56', 0),
(164, 3, 6, 7, 27, 7, 7, 1, 'Please once check', '2017-02-22 20:51:13', '2017-03-03 23:18:32', 0),
(165, 3, 6, 27, 7, 0, 2, 1, 'He dont want to tally please closed with out any call to customer', '2017-03-03 23:18:32', '2017-03-03 23:20:12', 0),
(166, 3, 27, 7, 27, 0, 8, 0, 'Lead In-progress', '2017-03-03 23:31:43', '0000-00-00 00:00:00', 0),
(167, 3, 6, 7, 27, 7, 1, 1, 'Yes He dont want to tally', '2017-03-03 23:20:12', '2017-03-03 23:32:04', 0),
(168, 13, 31, 7, 7, 13, 5, 1, 'Handle This Lead', '2017-02-23 10:48:01', '2017-03-06 11:50:11', 0),
(169, 25, 31, 7, 13, 0, 5, 1, 'New Lead', '2017-02-22 20:15:40', '2017-03-06 12:19:20', 0),
(170, 25, 31, 13, 28, 13, 7, 1, 'Once check Return', '2017-03-06 12:19:20', '2017-03-06 15:50:24', 0),
(171, 25, 31, 28, 28, 28, 7, 1, 'Once check Return', '2017-03-06 15:50:24', '2017-03-06 15:50:26', 0),
(172, 25, 31, 28, 28, 28, 7, 1, 'Once check Return', '2017-03-06 15:50:26', '2017-03-06 15:50:43', 0),
(173, 25, 31, 28, 28, 28, 7, 1, 'Once check Return', '2017-03-06 15:50:43', '2017-03-06 15:51:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE IF NOT EXISTS `login_details` (
  `id` int(11) NOT NULL,
  `userid` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `userid`, `password`, `status`) VALUES
(1, 'nivsmart@admin.com', 'NivSmart@444', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type_id`, `product_name`, `status`, `created_date_time`, `updated_date_time`) VALUES
(1, 3, 'Customisation', 1, '2016-11-21 21:35:24', '0000-00-00 00:00:00'),
(2, 3, 'Micro Vertical', 1, '2016-11-21 21:35:31', '0000-00-00 00:00:00'),
(4, 2, 'Implementation Services', 1, '2016-11-21 21:37:02', '0000-00-00 00:00:00'),
(5, 2, 'Installation', 1, '2016-11-21 21:37:09', '0000-00-00 00:00:00'),
(6, 2, 'Onsite Troubleshooting', 1, '2016-11-21 21:37:16', '0000-00-00 00:00:00'),
(7, 2, 'Training', 1, '2016-11-21 21:37:23', '0000-00-00 00:00:00'),
(8, 1, 'Tally.ERP 9 - Sliver (Single User)', 1, '2016-11-21 21:41:18', '0000-00-00 00:00:00'),
(9, 1, 'Tally.ERP 9 - Gold (Multi User)', 1, '2016-11-21 21:41:25', '0000-00-00 00:00:00'),
(10, 1, 'Tally.ERP 9 - Auditors Edition', 1, '2016-11-21 21:41:31', '0000-00-00 00:00:00'),
(11, 1, 'Tally.ERP9 Rental', 0, '2016-11-21 21:41:36', '2017-02-22 19:11:56'),
(12, 2, 'Shoper 9', 1, '2016-11-21 21:41:42', '0000-00-00 00:00:00'),
(13, 1, 'Tally.Developer 9', 0, '2016-11-21 21:41:47', '2017-02-22 19:11:55'),
(14, 1, 'Tally.ERP Upgrade (Single User)', 1, '2016-11-21 21:41:53', '0000-00-00 00:00:00'),
(15, 1, 'Tally.ERP Upgrade (Multi User)', 0, '2016-11-21 21:41:59', '2017-02-22 19:11:54'),
(16, 1, 'TSS - Silver (Single User)', 1, '2016-11-21 21:42:04', '2017-02-22 19:11:37'),
(17, 1, 'TSS - Gold (Multi User)', 0, '2016-11-21 21:42:11', '2017-02-22 19:11:53'),
(18, 1, 'TSS - TE9AE(Auditor Edition)', 1, '2016-11-21 21:42:20', '0000-00-00 00:00:00'),
(19, 1, 'TSS - Shoper', 0, '2016-11-21 21:42:30', '2017-03-04 11:16:51'),
(20, 1, 'Tally Software Service', 1, '2016-11-21 21:42:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type`, `status`, `created_date_time`, `updated_date_time`) VALUES
(1, 'Sales', 1, '2016-11-16 09:27:45', '0000-00-00 00:00:00'),
(2, 'Service', 1, '2016-11-16 09:27:45', '0000-00-00 00:00:00'),
(3, 'Solution', 1, '2016-11-16 09:27:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL,
  `state` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `status`, `created_date_time`, `updated_date_time`) VALUES
(1, 'Andhra Pradesh', 1, '2016-11-21 20:56:36', '2016-12-02 02:20:02'),
(2, 'Telangana', 1, '2016-11-21 21:13:20', '2016-11-21 21:17:53'),
(3, 'Tamilnadu', 1, '2016-11-21 21:14:28', '2016-11-21 21:17:53'),
(4, 'Kerala', 1, '2016-11-21 21:14:30', '2017-03-03 23:38:38'),
(5, 'Pudhicherry', 1, '2017-02-22 11:58:37', '2017-02-22 12:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `tally_customers`
--

CREATE TABLE IF NOT EXISTS `tally_customers` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `serial_no` varchar(250) NOT NULL,
  `business_id` int(11) NOT NULL,
  `invoice` varchar(250) NOT NULL,
  `inventory` varchar(250) NOT NULL,
  `filing` varchar(250) NOT NULL,
  `diagonals` varchar(250) NOT NULL,
  `lead_implementation` text NOT NULL,
  `next_contact_date` datetime NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tally_customers`
--

INSERT INTO `tally_customers` (`id`, `leadid`, `serial_no`, `business_id`, `invoice`, `inventory`, `filing`, `diagonals`, `lead_implementation`, `next_contact_date`, `created_date_time`, `updated_date_time`) VALUES
(5, 2, 'TALLY1234586', 1, '1,2,3', '2,4', '3', '2,5,6', 'Lead Generated', '2017-03-23 00:00:00', '2017-03-03 18:15:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tally_guest_reg`
--

CREATE TABLE IF NOT EXISTS `tally_guest_reg` (
  `id` int(11) NOT NULL,
  `org_name` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `roll` varchar(20) NOT NULL,
  `if_tally` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tally_guest_reg`
--

INSERT INTO `tally_guest_reg` (`id`, `org_name`, `contact_person`, `mobile_no`, `city`, `roll`, `if_tally`, `created_date_time`) VALUES
(7, 'Charvikent', 'Prasad', '9491862697', 'Kakinada', 'Owner', 1, '2016-12-21 06:11:16'),
(8, 'Charvikent', 'Prasad', '9491862698', 'Kakinada', 'Owner', 0, '2016-12-21 06:21:41'),
(9, 'sjhjsnjnaja', 'hahaba', '8787878785', 'Guntur', 'Owner', 0, '2017-01-06 08:29:08'),
(10, 'AMAR RAMA AGENCIES', 'G.VENU', '9985369289', 'Guntur', 'Owner', 1, '2017-01-11 08:07:03'),
(11, 'VIJAYA SAI ENTERPRISES', 'SRINIVASA REDDY', '9866033488', 'Guntur', 'Owner', 0, '2017-01-12 08:29:10'),
(12, 'Jalluri &Co', 'J N V Suresh Kumar', '9346964232', 'Vijayawada', 'Accountant', 1, '2017-01-14 00:11:04'),
(13, 'manjunadha traders', 'srinivas', '9951024624', 'Ongole', 'Accountant', 0, '2017-01-14 00:21:54'),
(14, 'abc', 'xyz', '9292929292', 'Kurnool', 'Owner', 1, '2017-01-14 00:52:38'),
(15, 'Muthoot', 'Ramu', '9948720823', 'Guntur', 'Owner', 1, '2017-01-14 00:57:51'),
(16, 'SRI KRISHNA PHARMACY', 'K MURALI KRISHNA', '9848792665', 'Vijayawada', 'Accountant', 1, '2017-01-14 01:10:36'),
(17, 'Srivinayakatraders', 'Dinesh', '8008338777', 'Guntur', 'Owner', 0, '2017-01-14 01:24:12'),
(18, 'Srilakshmiprasannatraders', 'N.Veerababu', '9246643663', 'Visakhapatnam', 'Owner', 1, '2017-01-14 02:54:09'),
(19, 'chakri agencies', 'satyanarayana', '9293404012', 'Ongole', 'Owner', 1, '2017-01-17 00:26:48'),
(20, 'Vb', 'Vv', '9999999999', 'Adoni', 'Owner', 1, '2017-01-18 08:58:09'),
(21, 'Full adder servicez', 'Ramana.taddi', '8500339522', 'Vizianagaram', 'Owner', 0, '2017-01-18 08:59:15'),
(22, 'RC readymade center', 'Subhojit mitra', '7981952469', 'Srikakulam', 'Owner', 1, '2017-01-27 04:21:19'),
(23, 'NIV', 'Murali', '8712553990', 'Visakhapatnam', 'Owner', 1, '2017-01-27 08:06:17'),
(24, 'Mahalakshmi steel industries', 'NARESH', '9959719977', 'Visakhapatnam', 'Owner', 0, '2017-01-28 06:30:24'),
(25, 'MS KHETESWAR METAL INDUSTRIES', 'JHOTHI', '8885039788', 'Visakhapatnam', 'Owner', 0, '2017-01-28 06:35:07'),
(26, 'SREE SHYAM TRADING', 'S.KUMAR', '9440115220', 'Visakhapatnam', 'Owner', 0, '2017-01-28 07:15:08'),
(27, 'HARDWEARE SHOP', 'Shimhachalam', '9849446332', 'Visakhapatnam', 'Accountant', 0, '2017-01-30 00:48:09'),
(28, 'HARSHA INDUSTRIES', 'D. RAMANJANEJULLU', '9533444400', 'Visakhapatnam', 'Owner', 0, '2017-01-30 01:14:23'),
(29, 'VENKATADHIKSHA ENTERPRISES', 'VENKATA RAMANA', '9912627727', 'Visakhapatnam', 'Owner', 0, '2017-01-30 01:16:10'),
(30, 'MEENA METALS', 'SUDHARAM CHODARI', '9985050895', 'Visakhapatnam', 'Owner', 1, '2017-01-30 01:20:46'),
(31, 'PARAMESWARI STEEL PROFILES', 'SIVA', '9704716654', 'Visakhapatnam', 'Accountant', 0, '2017-01-30 01:25:14'),
(32, 'GEE DEE OVERSEAS', 'SANJAY GUPTHA', '9411982970', 'Visakhapatnam', 'Owner', 0, '2017-01-30 01:49:33'),
(33, 'PS ENTERPRISES', 'SAILIJESH', '9908812299', 'Visakhapatnam', 'Owner', 0, '2017-01-30 01:53:33'),
(34, 'ANURADHA ENTERPRISES', 'G.NAGESWARAO', '9291235789', 'Visakhapatnam', 'Accountant', 0, '2017-01-30 01:57:02'),
(35, 'RAVI IORN & STEELS', 'RAVI', '9885377999', 'Visakhapatnam', 'Owner', 0, '2017-01-30 02:02:32'),
(36, 'BALAJI STEEL PROFILES', 'PRANITH', '9912229666', 'Visakhapatnam', 'Owner', 0, '2017-01-30 02:25:04'),
(37, 'PJ IRON & HARDWARE STORES', 'RAMARAO', '9848193983', 'Visakhapatnam', 'Owner', 0, '2017-01-30 02:46:31'),
(38, 'ROYAL TILES', 'HARITHA', '8500617629', 'Vizianagaram', 'Owner', 0, '2017-01-30 02:51:47'),
(39, 'SRI LAKSHMI GANAPATHI HARDWARE & PLYWOODS', 'G. PAYIDI RAJU', '9908166373', 'Vizianagaram', 'Owner', 0, '2017-01-30 02:57:05'),
(40, 'VIJAYA DURGA ENTERPRISES', 'A. SRINIVASA RAO', '9440993585', 'Vizianagaram', 'Owner', 0, '2017-01-30 03:00:49'),
(41, 'AUTO SHOWROOM', 'SATYANARAYANA', '9490461639', 'Vizianagaram', 'Accountant', 1, '2017-01-30 03:02:44'),
(42, 'SREE SATYANARAYANA AGENCIES', 'SATYANARAYANA', '9440193199', 'Vizianagaram', 'Owner', 0, '2017-01-30 03:05:21'),
(43, 'BHANU ELECTRONICS', 'BHANU', '9885874564', 'Vizianagaram', 'Owner', 0, '2017-01-30 04:27:49'),
(44, 'S.R.IRON TRADERS', 'S.APPALA NAIDU', '9885458635', 'Visakhapatnam', 'Owner', 1, '2017-01-30 04:33:32'),
(45, 'Vanitha', 'vanita', '7097947071', 'Guntur', 'Owner', 1, '2017-01-30 04:39:03'),
(46, 'SATYANARAYANA JEWLLERS', 'PRAVEEN', '9246629493', 'Visakhapatnam', 'Owner', 0, '2017-01-30 04:47:44'),
(47, 'ENGINEERING SERVICE', 'K.RAMANA MURTHI', '9989849088', 'Visakhapatnam', 'Owner', 0, '2017-01-30 04:53:03'),
(48, 'SRI LAMBHODHARA HARDWEAR', 'RAMU NAIDU', '9492020045', 'Vizianagaram', 'Owner', 1, '2017-01-30 04:55:22'),
(49, 'LAKSHMI GLASS PLYWOOD & HARDWARE', 'L.R. DEWARI', '9885238987', 'Vizianagaram', 'Owner', 0, '2017-01-30 04:59:50'),
(50, 'SARNESWAR ENTERPRISES', 'GOPAL', '9948654101', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:01:32'),
(51, 'ADITYA HARDWARE & PLYWOOD', 'SANKARARAO', '9849651456', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:12:43'),
(52, 'SRI VASAVI LAKSHMI AGENCY', 'THULASI RAM', '9849291369', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:18:34'),
(53, 'SRI VASAVI', 'SATYANARAYANA GUPTA', '9010019854', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:22:30'),
(54, 'ARUNODAYA STEEL CORPORATION', 'JAGAN', '9440193677', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:25:12'),
(55, 'SRI SHIVA SAKTHI STEEL TRANDERS', 'SRIKATH', '9346917400', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:28:44'),
(56, 'SANTOSH', 'G.S.N. MURTY', '9866693802', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:30:32'),
(57, 'SRI SITAMAHALAKSHMI', 'GANGARAJU', '9440192437', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:36:33'),
(58, 'ARUN TILES SQUARE', 'ARUN', '9700045220', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:40:23'),
(59, 'RAVIRAJA MARBULS', 'PRASANTH', '8886144777', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:45:51'),
(60, 'SRI GANESH TRADERS', 'SRINIVASA RAO', '9441962737', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:52:29'),
(61, 'KRISHAN SEEDS', 'SRINIVAS', '9700373272', 'Vizianagaram', 'Owner', 0, '2017-01-30 05:59:44'),
(62, 'PADMA ENTERPRISES', 'BANGARAJU', '9440913387', 'Vizianagaram', 'Owner', 0, '2017-01-30 06:03:46'),
(63, 'SRI BALAJI GLASS WOR4KS', 'NARAYANAMURTY', '9640574549', 'Visakhapatnam', 'Owner', 0, '2017-01-30 06:17:17'),
(64, 'SRI GAYATHRI AGENCIES', 'SWAMI', '8977635677', 'Vizianagaram', 'Owner', 0, '2017-01-30 06:22:19'),
(65, 'FANCY KALYANAMANDAPAM', 'SRI VISALA TRADERS', '9985834835', 'Guntur', 'Accountant', 0, '2017-01-30 06:22:28'),
(66, 'FANCY KALYANAMANDAPAM', 'THIRUMALA RAO', '7799885521', 'Guntur', 'Accountant', 0, '2017-01-30 06:24:49'),
(67, 'FANCY KALYANAMANDAPAM', 'T NAGESWARA ARAO', '9394100371', 'Guntur', 'Owner', 0, '2017-01-30 06:25:37'),
(68, 'MOHAMMAD TAMIZUDDIN', 'MOHAMMAD TAMIZUDDIN', '9160394600', 'Tenali', 'Accountant', 1, '2017-01-30 06:26:04'),
(69, 'FANCY KALYANAMANDAPAM', 'J DURGA BHAVANI', '8154356801', 'Guntur', 'Accountant', 0, '2017-01-30 06:27:23'),
(70, 'FANCY KALYANAMANDAPAM', 'CH RAGHU', '9848733466', 'Guntur', 'Owner', 0, '2017-01-30 06:28:32'),
(71, 'FANCY KALYANAMANDAPAM', 'P RAMESH', '9848116609', 'Guntur', 'Owner', 0, '2017-01-30 06:29:08'),
(72, 'FANCY KALYANAMANDAPAM', 'K LAKSHMI NARAYANA', '9849412554', 'Guntur', 'Accountant', 0, '2017-01-30 06:29:51'),
(73, 'FANCY KALYANAMANDAPAM', 'RAMBABU', '9885004009', 'Guntur', 'Accountant', 0, '2017-01-30 06:30:33'),
(74, 'FANCY KALYANAMANDAPAM', 'P SAMBI REDDY', '9440477026', 'Guntur', 'Accountant', 0, '2017-01-30 06:31:01'),
(75, 'GADIPE CONSTRUTIONS', 'VENKATESWARA RAO', '9885438188', 'Visakhapatnam', 'Owner', 0, '2017-01-30 06:31:05'),
(76, 'FANCY KALYANAMANDAPAM', 'M MALLI KARJUNA RAO', '9396657186', 'Guntur', 'Accountant', 0, '2017-01-30 06:31:54'),
(77, 'FANCY KALYANAMANDAPAM', 'S JAGAN MOHAN RAO', '8143791450', 'Guntur', 'Accountant', 0, '2017-01-30 06:32:39'),
(78, 'FANCY KALYANAMANDAPAM', 'B V S PRASAD', '9397600067', 'Guntur', 'Accountant', 0, '2017-01-30 06:33:21'),
(79, 'FANCY KALYANAMANDAPAM', 'G SREERAMULU (RAMESH TRADERS )', '9849139397', 'Guntur', 'Owner', 0, '2017-01-30 06:35:24'),
(80, 'FANCY KALYANAMANDAPAM', 'P RAMESH', '9866944215', 'Guntur', 'Accountant', 0, '2017-01-30 06:37:34'),
(81, 'FANCY KALYANAMANDAPAM', 'K SRINIVASA RAO', '8501068036', 'Guntur', 'Accountant', 0, '2017-01-30 06:38:16'),
(82, 'FANCY KALYANAMANDAPAM', 'PHANI SIVA KUMAR', '9963911842', 'Guntur', 'Accountant', 0, '2017-01-30 06:39:26'),
(83, 'FANCY KALYANAMANDAPAM', 'K NAGARAJU', '9440781204', 'Guntur', 'Accountant', 0, '2017-01-30 06:40:37'),
(84, 'FANCY KALYANAMANDAPAM', 'SARAT', '9866273213', 'Guntur', 'Owner', 0, '2017-01-30 06:41:31'),
(85, 'FANCY KALYANAMANDAPAM', 'R MURALI', '9985068768', 'Guntur', 'Accountant', 0, '2017-01-30 06:42:42'),
(86, 'FANCY KALYANAMANDAPAM', 'G P REDDY', '8978573864', 'Guntur', 'Accountant', 0, '2017-01-30 06:43:39'),
(87, 'FANCY KALYANAMANDAPAM', 'P SREENIVASULU', '9440794860', 'Guntur', 'Owner', 0, '2017-01-30 06:44:35'),
(88, 'FANCY KALYANAMANDAPAM', 'G VENKATA RAO', '9440805005', 'Guntur', 'Owner', 0, '2017-01-30 06:45:59'),
(89, 'FANCY KALYANAMANDAPAM', 'M SRENIVAS', '9849285653', 'Guntur', 'Accountant', 0, '2017-01-30 06:47:15'),
(90, 'FANCY KALYANAMANDAPAM', 'CH KARTHIK', '9030906464', 'Guntur', 'Owner', 0, '2017-01-30 06:48:10'),
(91, 'FANCY KALYANAMANDAPAM', 'R SIVA RAMAKRISHNA', '8297377444', 'Guntur', 'Owner', 0, '2017-01-30 06:49:03'),
(92, 'FANCY KALYANAMANDAPAM', 'G BASAVARAJU', '9290822202', 'Guntur', 'Accountant', 0, '2017-01-30 06:49:51'),
(93, 'FANCY KALYANAMANDAPAM', 'D KRISHNA', '9849431881', 'Guntur', 'Owner', 0, '2017-01-30 06:50:27'),
(94, 'FANCY KALYANAMANDAPAM', 'G VENKATA SUBBA RAO', '9849652526', 'Guntur', 'Owner', 0, '2017-01-30 06:51:07'),
(95, 'FANCY KALYANAMANDAPAM', 'KAMAL', '9052361456', 'Guntur', 'Owner', 0, '2017-01-30 06:52:10'),
(96, 'FANCY KALYANAMANDAPAM', 'MP TRADERS', '8686287289', 'Guntur', 'Accountant', 0, '2017-01-30 06:52:57'),
(97, 'FANCY KALYANAMANDAPAM', 'CH SATISH KUMAR', '9849421882', 'Guntur', 'Owner', 0, '2017-01-30 06:53:59'),
(98, 'FANCY KALYANAMANDAPAM', 'A RAMU', '9441026443', 'Guntur', 'Accountant', 0, '2017-01-30 06:54:56'),
(99, 'FANCY KALYANAMANDAPAM', 'SOMASEKHAR', '9290268219', 'Guntur', 'Owner', 0, '2017-01-30 06:55:43'),
(100, 'FANCY KALYANAMANDAPAM', 'T RADHAKRISHNA', '9298008504', 'Guntur', 'Owner', 0, '2017-01-30 06:56:44'),
(101, 'FANCY KALYANAMANDAPAM', 'T BALAKOTESWARA RAO', '9394649774', 'Guntur', 'Owner', 0, '2017-01-30 06:57:37'),
(102, 'FANCY KALYANAMANDAPAM', 'SRINIDHI TRADERS', '9502116444', 'Guntur', 'Owner', 0, '2017-01-30 06:59:57'),
(103, 'FANCY KALYANAMANDAPAM', 'M PAVAN KUMAR', '9704562888', 'Guntur', 'Owner', 0, '2017-01-30 07:00:51'),
(104, 'FANCY KALYANAMANDAPAM', 'B SREENIVASA RAO', '9493128243', 'Guntur', 'Owner', 0, '2017-01-30 07:01:38'),
(105, 'FANCY KALYANAMANDAPAM', 'B VENKATESWARA RAO', '9346910117', 'Guntur', 'Owner', 0, '2017-01-30 07:02:40'),
(106, 'FANCY KALYANAMANDAPAM', 'P CHANDRA SEKHAR', '9347536343', 'Guntur', 'Owner', 0, '2017-01-30 07:03:51'),
(107, 'SHANTI TRADING CORORATION', 'ROHAN JAISWAL', '9502228213', 'Visakhapatnam', 'Owner', 0, '2017-01-30 07:04:22'),
(108, 'FANCY KALYANAMANDAPAM', 'B BHASKAR RAO', '7396285260', 'Guntur', 'Accountant', 0, '2017-01-30 07:04:29'),
(109, 'FANCY KALYANAMANDAPAM', 'K SITHA RAMULU', '7569416060', 'Guntur', 'Accountant', 0, '2017-01-30 07:05:47'),
(110, 'FANCY KALYANAMANDAPAM', 'A KOTESWARA RAO', '9848133733', 'Guntur', 'Accountant', 0, '2017-01-30 07:07:24'),
(111, 'FANCY KALYANAMANDAPAM', 'JAGAN MOHAN', '9848671769', 'Guntur', 'Owner', 0, '2017-01-30 07:08:12'),
(112, 'FANCY KALYANAMANDAPAM', 'PVV NARAYANA', '9866296598', 'Guntur', 'Owner', 0, '2017-01-30 07:08:59'),
(113, 'FANCY KALYANAMANDAPAM', 'I NAGA SURESH BABU', '8688844441', 'Guntur', 'Accountant', 0, '2017-01-30 07:09:48'),
(114, 'ONLINESHOPE', 'MR.RAM', '9100224225', 'Visakhapatnam', 'Owner', 0, '2017-01-30 07:09:54'),
(115, 'FANCY KALYANAMANDAPAM', 'G CHANDRA MOHAN', '9849974512', 'Guntur', 'Owner', 0, '2017-01-30 07:10:21'),
(116, 'FANCY KALYANAMANDAPAM', 'T V SRINIVASARAO', '9393749459', 'Guntur', 'Accountant', 0, '2017-01-30 07:11:10'),
(117, 'FANCY KALYANAMANDAPAM', 'K KRISHNA SAI ENTERPRISES', '9949883346', 'Guntur', 'Owner', 0, '2017-01-30 07:12:12'),
(118, 'FANCY KALYANAMANDAPAM', 'G BHASKAR RAO', '9573972050', 'Guntur', 'Owner', 0, '2017-01-30 07:12:55'),
(119, 'FANCY KALYANAMANDAPAM', 'AHMAD BASHA', '9966020006', 'Guntur', 'Accountant', 0, '2017-01-30 07:13:47'),
(120, 'FANCY KALYANAMANDAPAM', 'STELING TECHNOLOGIES', '9885389898', 'Guntur', 'Owner', 0, '2017-01-30 07:14:37'),
(121, 'FANCY KALYANAMANDAPAM', 'J VENKATESWARA KRISHNA RAO', '9848139236', 'Guntur', 'Owner', 0, '2017-01-30 07:15:50'),
(122, 'FANCY KALYANAMANDAPAM', 'CH PRASAD', '8125813259', 'Guntur', 'Accountant', 0, '2017-01-30 07:16:50'),
(123, 'FANCY KALYANAMANDAPAM', 'SRI SATYA SAI CROP CHEMICLES', '8008490888', 'Guntur', 'Accountant', 0, '2017-01-30 07:17:44'),
(124, 'FANCY KALYANAMANDAPAM', 'D NAGARJUNA RAO', '9849142385', 'Guntur', 'Accountant', 0, '2017-01-30 07:18:47'),
(125, 'FANCY KALYANAMANDAPAM', 'LAKSHMI VENKATESWAR GENERAL MARCHANT', '9989784993', 'Guntur', 'Owner', 0, '2017-01-30 07:20:03'),
(126, 'FANCY KALYANAMANDAPAM', 'D LOKESH KUMAR', '9290317393', 'Guntur', 'Accountant', 0, '2017-01-30 07:20:45'),
(127, 'FANCY KALYANAMANDAPAM', 'J SRINIVASA RAO', '9705566743', 'Guntur', 'Accountant', 0, '2017-01-30 07:22:02'),
(128, 'FANCY KALYANAMANDAPAM', 'S NARENDRA', '9030886991', 'Guntur', 'Accountant', 0, '2017-01-30 07:22:50'),
(129, 'FANCY KALYANAMANDAPAM', 'GAYATRI GENERAL MARCHANT', '9246420114', 'Guntur', 'Owner', 0, '2017-01-30 07:23:35'),
(130, 'FANCY KALYANAMANDAPAM', 'T CHAMUNDESWAR ARAO', '8977025704', 'Guntur', 'Owner', 0, '2017-01-30 07:24:27'),
(131, 'FANCY KALYANAMANDAPAM', 'PVNRN PAVAN KUMAR', '9849863183', 'Guntur', 'Accountant', 0, '2017-01-30 07:25:09'),
(132, 'FANCY KALYANAMANDAPAM', 'JUGRAJ BANDARI', '9848132201', 'Guntur', 'Owner', 0, '2017-01-30 07:26:01'),
(133, 'FANCY KALYANAMANDAPAM', 'A MADHU SUDAN GUPTA', '9885474276', 'Guntur', 'Accountant', 0, '2017-01-30 07:26:53'),
(134, 'FANCY KALYANAMANDAPAM', 'K R M V D PRASAD', '9390177810', 'Guntur', 'Owner', 0, '2017-01-30 07:27:50'),
(135, 'FANCY KALYANAMANDAPAM', 'K AMARNAD', '9866012257', 'Guntur', 'Owner', 0, '2017-01-30 07:28:32'),
(136, 'FANCY KALYANAMANDAPAM', 'V VALLABHA RAO', '9849472218', 'Guntur', 'Accountant', 0, '2017-01-30 07:29:42'),
(137, 'FANCY KALYANAMANDAPAM', 'T SUBRAMANYAM', '9963067381', 'Guntur', 'Accountant', 0, '2017-01-30 07:30:34'),
(138, 'FANCY KALYANAMANDAPAM', 'SRI SAI LAKSHMI GENERAL', '9848120277', 'Guntur', 'Accountant', 0, '2017-01-30 07:31:10'),
(139, 'FANCY KALYANAMANDAPAM', 'MNV SUBBARAO', '9247140082', 'Guntur', 'Accountant', 0, '2017-01-30 07:31:37'),
(140, 'FANCY KALYANAMANDAPAM', 'R AMRUTHA RAO', '9959168835', 'Guntur', 'Accountant', 0, '2017-01-30 07:32:19'),
(141, 'FANCY KALYANAMANDAPAM', 'CH VIJAY KUMAR', '9052622266', 'Guntur', 'Accountant', 0, '2017-01-30 07:33:03'),
(142, 'FANCY KALYANAMANDAPAM', 'SANDEEP BANDAR', '9394101348', 'Guntur', 'Owner', 0, '2017-01-30 07:33:33'),
(143, 'FANCY KALYANAMANDAPAM', 'Y CHANDRA SEKHAR RAO', '9395363825', 'Guntur', 'Accountant', 0, '2017-01-30 07:34:04'),
(144, 'FANCY KALYANAMANDAPAM', 'NAREDRA KUMAR GUPTHA', '9246467980', 'Guntur', 'Accountant', 0, '2017-01-30 07:34:47'),
(145, 'FANCY KALYANAMANDAPAM', 'B MARKANDEYA', '9885441785', 'Guntur', 'Owner', 0, '2017-01-30 07:35:23'),
(146, 'SREE LUMINRIES', 'SRINIVAS', '9848991902', 'Visakhapatnam', 'Owner', 0, '2017-01-31 00:29:40'),
(147, 'SREEDHARALA JOGARAO & SONS', 'S.L.N.KARTHIK', '9030256660', 'Visakhapatnam', 'Owner', 0, '2017-01-31 00:42:27'),
(148, 'SRI SUNIL ENTERPRISES', 'RAMESH KUMAR', '9247243191', 'Vizianagaram', 'Owner', 0, '2017-01-31 00:46:48'),
(149, 'SIRI GLAZINGS', 'M.LAKSHMI GANAPATHY', '9440421394', 'Vizianagaram', 'Owner', 0, '2017-01-31 00:52:38'),
(150, 'SRI LALITHA STEELS', 'SRINIVAS', '9866692741', 'Visakhapatnam', 'Owner', 0, '2017-01-31 00:57:17'),
(151, 'SUNDRA LAXMI TRADERS', 'B.GANESH', '8885228777', 'Visakhapatnam', 'Owner', 0, '2017-01-31 01:03:46'),
(152, 'SREE KANAKAMAHA LAKSHMI ENTERPRISES', 'D.RAMAKRISHNA', '9290870284', 'Visakhapatnam', 'Owner', 0, '2017-01-31 01:08:06'),
(153, 'THAKUR GARLIC', 'B.S CHAKRAVARTHI', '9652555248', 'Visakhapatnam', 'Owner', 0, '2017-01-31 01:14:18'),
(154, 'P.CHANDRAMOULI & CO', 'GANDHI', '9246036788', 'Visakhapatnam', 'Owner', 0, '2017-01-31 01:21:41'),
(155, 'ADITYA ENTERPRISES', 'VENKATA RAO', '9866832669', 'Visakhapatnam', 'Accountant', 1, '2017-01-31 01:42:07'),
(156, 'MAHALAKSHMI MOTORES', 'GANGADHAR', '9133550677', 'Visakhapatnam', 'Accountant', 0, '2017-01-31 01:45:09'),
(157, 'SRI KRISHNA GLASS', 'VAMSI', '9963266499', 'Visakhapatnam', 'Accountant', 1, '2017-01-31 01:48:21'),
(158, 'JAYABHERI AUTOMOTIVE', 'LAKSHMI', '9100979628', 'Visakhapatnam', 'Accountant', 1, '2017-01-31 01:53:45'),
(159, 'SRI SITHAMMA  GLASS & HARDWEAR', 'RAJAPRASAD', '9440192185', 'Vizianagaram', 'Owner', 0, '2017-01-31 02:32:36'),
(160, 'SRI SITHAMMA GLASS & HARDWEAR', 'NAGESWARARAO', '9440334609', 'Vizianagaram', 'Accountant', 0, '2017-01-31 02:33:51'),
(161, 'ARUN TILES SQUARE', 'VENKATESH', '9703945622', 'Vizianagaram', 'Accountant', 0, '2017-01-31 02:42:53'),
(162, 'SRINIVASA ENTERPRISES', 'SRINIVAS', '9985296867', 'Vizianagaram', 'Owner', 0, '2017-01-31 02:48:15'),
(163, 'SRINIVASA PAINTS & HARDWARES', 'SATYA KRISHNA', '9440879117', 'Vizianagaram', 'Owner', 0, '2017-01-31 03:00:50'),
(164, 'SRINIVASA PAINTS & HARDWARES', 'MURTHY', '9963327262', 'Vizianagaram', 'Accountant', 0, '2017-01-31 03:01:54'),
(165, 'ARUNODAYA STEEL CORPORATION', 'DIWAKAR', '9652341473', 'Vizianagaram', 'Accountant', 0, '2017-01-31 03:18:47'),
(166, 'VNR & CO', 'Mr.B Seetharama', '9676333481', 'Vijayawada', 'Accountant', 1, '2017-01-31 03:50:47'),
(167, 'VNR & CO', 'Mr. Rajendra', '9885642144', 'Guntur', 'Accountant', 1, '2017-01-31 03:51:37'),
(168, 'NAGESH CONSTRUCTIONS', 'NAGESH', '9246671972', 'Visakhapatnam', 'Owner', 1, '2017-01-31 04:45:42'),
(169, 'SRI BALAJI GLASS WORKS', 'AURN', '7416433414', 'Visakhapatnam', 'Accountant', 0, '2017-01-31 05:02:30'),
(170, 'SRI GAYATRI AGENCIES', 'PRASAD', '9866610667', 'Vizianagaram', 'Accountant', 0, '2017-01-31 05:11:49'),
(171, 'M.S.ENTERPRISES', 'AZEEZUR RAHMAN', '9885743981', 'Vizianagaram', 'Owner', 0, '2017-01-31 05:15:47'),
(172, 'SRI VENKATESWARA TIMBER & PLYWOOD AGENCIES', 'HITESH PATEL', '8897674142', 'Visakhapatnam', 'Accountant', 1, '2017-01-31 05:15:47'),
(173, 'M.S.ENTERPRISES', 'SRINIVAS', '9848831420', 'Vizianagaram', 'Accountant', 0, '2017-01-31 05:16:54'),
(174, 'SREEDHARALA JOARAO & SONS', 'VENKATARAO', '9848681818', 'Visakhapatnam', 'Accountant', 0, '2017-01-31 05:28:22'),
(175, 'SRI KRISHNA TILES', 'RAMARAO', '9866176802', 'Vizianagaram', 'Charted Accountant', 0, '2017-01-31 05:37:28'),
(176, 'SRI KRISHNA TILES', 'K.UMA MAHESWARA RAO', '8008395050', 'Vizianagaram', 'Owner', 0, '2017-01-31 05:38:59'),
(177, 'SRI KANAKAMAHALAKSHMI ENTERPRISES', 'KIRAN', '9866694542', 'Visakhapatnam', 'Accountant', 0, '2017-01-31 05:54:08'),
(178, 'A.V TILES', 'ANIL KUMAR', '9989905700', 'Visakhapatnam', 'Owner', 0, '2017-01-31 06:11:54'),
(179, 'SRI BALA GRANITES & MARBLES', 'G.S.NAIDU', '9396241656', 'Vizianagaram', 'Owner', 0, '2017-01-31 06:14:06'),
(180, 'SRI BALA GRANITES & MARBLES', 'RAJU', '7416962990', 'Vizianagaram', 'Accountant', 0, '2017-01-31 06:15:54'),
(181, 'FURNITURE GALLERY', 'APPARAO', '9246631368', 'Visakhapatnam', 'Accountant', 0, '2017-01-31 06:26:45'),
(182, 'FURNITURE GALLERY', 'SATISH', '9640929190', 'Visakhapatnam', 'Owner', 0, '2017-01-31 06:28:32'),
(183, 'SRINIVASA CORPORATION', 'P.PARAMESH', '9440435119', 'Vizianagaram', 'Owner', 0, '2017-01-31 06:32:06'),
(184, 'SRINIVASA CORPORATION', 'NAGARJUNA REDDY', '9347244455', 'Vizianagaram', 'Accountant', 0, '2017-01-31 06:34:27'),
(185, 'NEW MUMBAI STORES', 'J.AHMED', '9393109709', 'Visakhapatnam', 'Owner', 0, '2017-01-31 06:58:33'),
(186, 'VINAYAK ELECTRICAL & HARDWARE', 'G. PRAKASH', '9392016205', 'Visakhapatnam', 'Owner', 0, '2017-01-31 07:00:44'),
(187, 'M.S. ENTERPRISES', 'HAMZA RANGWALA', '9502539970', 'Visakhapatnam', 'Owner', 0, '2017-01-31 07:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `tally_quotation`
--

CREATE TABLE IF NOT EXISTS `tally_quotation` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leadprocessid` int(11) NOT NULL,
  `prospect_id` int(11) NOT NULL,
  `prospect_details_id` text NOT NULL,
  `rate` text NOT NULL,
  `quantity` text NOT NULL,
  `amount` varchar(250) NOT NULL,
  `des` text NOT NULL,
  `created_date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tally_quotation`
--

INSERT INTO `tally_quotation` (`id`, `leadid`, `emp_id`, `leadprocessid`, `prospect_id`, `prospect_details_id`, `rate`, `quantity`, `amount`, `des`, `created_date_time`) VALUES
(5, 2, 7, 125, 4, 'Tally.ERP 9 - Sliver (Single User)*Tally.ERP 9 - Auditors Edition*Tally.Developer 9*TSS - Silver (Single User)*TSS - Shoper', '1200*1500*2000*1300*4000', '3*2*1*3*1', '', 'This is Descriptio of the Quotation', '2017-03-03 01:44:07'),
(6, 25, 13, 169, 4, 'Tally.ERP 9 - Gold (Multi User)*Tally.Developer 9', '200*1500', '5*5', '', 'New Quotation', '2017-03-06 12:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_names`
--
ALTER TABLE `business_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_leads`
--
ALTER TABLE `crm_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_referred_customers`
--
ALTER TABLE `crm_referred_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_personal_details`
--
ALTER TABLE `customer_personal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_roles`
--
ALTER TABLE `dept_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_followups`
--
ALTER TABLE `lead_followups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_process`
--
ALTER TABLE `lead_process`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally_customers`
--
ALTER TABLE `tally_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally_guest_reg`
--
ALTER TABLE `tally_guest_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally_quotation`
--
ALTER TABLE `tally_quotation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `business_names`
--
ALTER TABLE `business_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `crm_leads`
--
ALTER TABLE `crm_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `crm_referred_customers`
--
ALTER TABLE `crm_referred_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_personal_details`
--
ALTER TABLE `customer_personal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `dept_roles`
--
ALTER TABLE `dept_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `lead_followups`
--
ALTER TABLE `lead_followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `lead_process`
--
ALTER TABLE `lead_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tally_customers`
--
ALTER TABLE `tally_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tally_guest_reg`
--
ALTER TABLE `tally_guest_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `tally_quotation`
--
ALTER TABLE `tally_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
