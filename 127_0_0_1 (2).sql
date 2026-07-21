-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2019 at 09:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(20) NOT NULL,
  `course_description` varchar(200) NOT NULL,
  `major` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `course_code`, `course_description`, `major`) VALUES
(1, 'BSIT', 'INFORMATION TECHNOLOGY', 'WEB DEV');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enlistment`
--

CREATE TABLE IF NOT EXISTS `tbl_enlistment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `date` date NOT NULL,
  `courseid` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `acadyear` varchar(45) NOT NULL,
  `sem` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_enlistment`
--

INSERT INTO `tbl_enlistment` (`id`, `studentid`, `date`, `courseid`, `type`, `acadyear`, `sem`) VALUES
(1, 1, '2019-08-24', 1, 'NEW', '1', '1'),
(2, 2, '2019-08-24', 1, 'NEW', '1', '1'),
(3, 3, '2019-08-24', 1, 'NEW', '1', '1'),
(4, 4, '2019-08-27', 1, 'NEW', '1', '1'),
(5, 1, '2019-09-06', 1, 'NEW', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `action` text NOT NULL,
  `details` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `name`, `action`, `details`, `status`, `datetime`) VALUES
(1, '', 'Logout', 'Logout Account', 'Successful', '2019-08-15 12:32:23'),
(2, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-15 12:33:20'),
(3, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-15 12:34:53'),
(4, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-08-15 12:35:54'),
(5, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 12:36:33'),
(6, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 12:36:34'),
(7, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 12:36:34'),
(8, '', 'Logout', 'Logout Account', 'Successful', '2019-08-15 12:36:42'),
(9, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-15 12:36:54'),
(10, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-15 14:45:30'),
(11, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-15 14:45:53'),
(12, '2019-0002', 'Login', 'Logging in', 'Successful', '2019-08-15 14:46:34'),
(13, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 14:46:46'),
(14, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 14:46:47'),
(15, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-15 14:46:47'),
(16, '', 'Logout', 'Logout Account', 'Successful', '2019-08-15 14:46:56'),
(17, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-15 14:47:06'),
(18, 'admin', 'Login', 'Logging in', 'Successful', '2019-08-16 07:36:48'),
(19, '', 'Logout', 'Logout Account', 'Successful', '2019-08-16 08:06:32'),
(20, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-16 08:06:40'),
(21, '', 'Logout', 'Logout Account', 'Successful', '2019-08-16 08:10:34'),
(22, 'dean', 'Login', 'Logging in', 'Successful', '2019-08-16 08:11:42'),
(23, '', 'Logout', 'Logout Account', 'Successful', '2019-08-16 08:16:35'),
(24, 'admin', 'Login', 'Logging in', 'Successful', '2019-08-16 08:16:40'),
(25, 'admin', 'Deleted', 'admin removed  in the membership type table.', 'Successful', '2019-08-16 08:17:27'),
(26, 'admin', 'Deleted', 'admin removed dean in the membership type table.', 'Successful', '2019-08-16 08:19:25'),
(27, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:19:53'),
(28, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:22:10'),
(29, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:23:04'),
(30, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:24:25'),
(31, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:25:27'),
(32, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:25:34'),
(33, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:25:41'),
(34, 'admin', 'Updated', 'admin successfully updated information the user table.', 'Successful', '2019-08-16 08:25:48'),
(35, '', 'Logout', 'Logout Account', 'Successful', '2019-08-16 08:26:41'),
(36, 'admin', 'Login', 'Logging in', 'Successful', '2019-08-16 08:26:55'),
(37, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-21 17:57:43'),
(38, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-21 18:02:41'),
(39, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-21 18:19:52'),
(40, 'admin', 'Logout', 'Logout Account', 'Successful', '2019-08-21 19:06:14'),
(41, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-08-21 19:06:35'),
(42, '', 'Logout', 'Logout Account', 'Successful', '2019-08-21 19:12:33'),
(43, 'faculty', 'Login', 'Logging in', 'Successful', '2019-08-21 19:12:48'),
(44, '', 'Logout', 'Logout Account', 'Successful', '2019-08-21 19:16:49'),
(45, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-24 07:01:01'),
(46, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-24 07:01:51'),
(47, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-08-24 07:02:31'),
(48, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:02:55'),
(49, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:02:55'),
(50, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:02:55'),
(51, '', 'Logout', 'Logout Account', 'Successful', '2019-08-24 07:04:42'),
(52, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-24 07:04:47'),
(53, '', 'Logout', 'Logout Account', 'Successful', '2019-08-24 07:05:34'),
(54, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-24 07:05:41'),
(55, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-24 07:06:08'),
(56, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-24 07:06:38'),
(57, '2019-0002', 'Login', 'Logging in', 'Successful', '2019-08-24 07:07:08'),
(58, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:07:30'),
(59, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:07:31'),
(60, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 07:07:31'),
(61, '', 'Logout', 'Logout Account', 'Successful', '2019-08-24 07:07:37'),
(62, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-24 07:07:45'),
(63, '2019-0002', 'Login', 'Logging in', 'Successful', '2019-08-24 07:09:29'),
(64, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-24 09:38:07'),
(65, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-24 09:38:49'),
(66, '2019-0003', 'Login', 'Logging in', 'Successful', '2019-08-24 09:39:25'),
(67, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 09:39:41'),
(68, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 09:39:41'),
(69, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-08-24 09:39:41'),
(70, '', 'Logout', 'Logout Account', 'Successful', '2019-08-24 09:49:30'),
(71, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-08-27 14:38:08'),
(72, 'registrar', 'Login', 'Logging in', 'Successful', '2019-08-27 14:49:47'),
(73, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-08-27 14:50:15'),
(74, '', 'Logout', 'Logout Account', 'Successful', '2019-08-27 14:50:49'),
(75, '2019-0004', 'Login', 'Logging in', 'Successful', '2019-08-27 14:50:57'),
(76, '', 'Added', ' successfully added  in the student subject table.', 'Successful', '2019-08-27 14:52:50'),
(77, '', 'Added', ' successfully added  in the student subject table.', 'Successful', '2019-08-27 14:52:51'),
(78, '', 'Added', ' successfully added  in the student subject table.', 'Successful', '2019-08-27 14:52:51'),
(79, '', 'Logout', 'Logout Account', 'Successful', '2019-08-27 14:53:04'),
(80, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-27 14:53:09'),
(81, '2019-0004', 'Login', 'Logging in', 'Successful', '2019-08-27 14:53:52'),
(82, '', 'Logout', 'Logout Account', 'Successful', '2019-08-27 15:00:12'),
(83, 'cashier', 'Login', 'Logging in', 'Successful', '2019-08-27 15:10:26'),
(84, 'cashier', 'Login', 'Logging in', 'Successful', '2019-09-01 14:23:58'),
(85, '', 'Logout', 'Logout Account', 'Successful', '2019-09-01 16:13:27'),
(86, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-09-01 16:13:41'),
(87, '', 'Logout', 'Logout Account', 'Successful', '2019-09-01 16:17:12'),
(88, '2019-0002', 'Login', 'Logging in', 'Successful', '2019-09-01 17:15:11'),
(89, 'registrar', 'Login', 'Logging in', 'Successful', '2019-09-01 17:15:29'),
(90, 'registrar', 'Login', 'Logging in', 'Successful', '2019-09-03 07:14:11'),
(91, 'registrar', 'Updated', 'registrar successfully updated registrar information in the student informationsss table.', 'Successful', '2019-09-03 07:14:21'),
(92, 'registrar', 'Updated', 'registrar successfully updated registrar information in the student informationsss table.', 'Successful', '2019-09-03 07:14:34'),
(93, '', 'Logout', 'Logout Account', 'Successful', '2019-09-03 07:37:08'),
(94, 'cashier', 'Login', 'Logging in', 'Successful', '2019-09-03 07:37:14'),
(95, '', 'Logout', 'Logout Account', 'Successful', '2019-09-03 07:48:18'),
(96, 'admin', 'Login', 'Logging in', 'Successful', '2019-09-03 07:48:23'),
(97, 'cashier', 'Login', 'Logging in', 'Successful', '2019-09-05 08:50:12'),
(98, '2019-0002', 'Login', 'Logging in', 'Successful', '2019-09-05 08:50:36'),
(99, 'cashier', 'Added', 'cashier successfully added cashier in the student subject table.', 'Successful', '2019-09-05 08:50:48'),
(100, 'cashier', 'Added', 'cashier successfully added cashier in the student subject table.', 'Successful', '2019-09-05 08:50:48'),
(101, 'cashier', 'Added', 'cashier successfully added cashier in the student subject table.', 'Successful', '2019-09-05 08:50:48'),
(102, 'cashier', 'Login', 'Logging in', 'Successful', '2019-09-06 08:49:15'),
(103, '', 'Logout', 'Logout Account', 'Successful', '2019-09-06 09:21:20'),
(104, 'registrar', 'Login', 'Logging in', 'Successful', '2019-09-06 09:21:29'),
(105, 'registrar', 'Added', 'registrar successfully added registrar in the student information table.', 'Successful', '2019-09-06 09:21:54'),
(106, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-09-06 09:23:01'),
(107, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-09-06 09:23:45'),
(108, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-09-06 09:23:45'),
(109, 'registrar', 'Added', 'registrar successfully added registrar in the student subject table.', 'Successful', '2019-09-06 09:23:45'),
(110, '', 'Logout', 'Logout Account', 'Successful', '2019-09-06 09:24:54'),
(111, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-09-06 09:25:00'),
(112, 'cashier', 'Login', 'Logging in', 'Successful', '2019-09-06 09:25:10'),
(113, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-09-13 14:33:35'),
(114, '', 'Logout', 'Logout Account', 'Successful', '2019-09-13 14:57:39'),
(115, 'registrar', 'Login', 'Logging in', 'Successful', '2019-09-13 14:58:00'),
(116, '', 'Logout', 'Logout Account', 'Successful', '2019-09-13 16:41:14'),
(117, '2019-0001', 'Login', 'Logging in', 'Successful', '2019-09-13 16:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_misc`
--

CREATE TABLE IF NOT EXISTS `tbl_misc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `misc_description` varchar(100) NOT NULL,
  `misc_price` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_misc`
--

INSERT INTO `tbl_misc` (`id`, `misc_description`, `misc_price`) VALUES
(1, 'Reg Form', '5600'),
(2, 'Med and Dental', '100'),
(3, 'Guidance', '200');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_profile_id` varchar(10) NOT NULL,
  `receipt_no` varchar(20) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `discount` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE IF NOT EXISTS `tbl_room` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `room_code` varchar(50) NOT NULL,
  `room_description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `room_code`, `room_description`) VALUES
(1, '12345', 'ROOM1'),
(2, '123', 'ROOM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_schedule` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `section_id` varchar(10) NOT NULL,
  `subject_id` varchar(10) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `time_start` varchar(20) NOT NULL,
  `time_finish` varchar(20) NOT NULL,
  `days` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `section_id`, `subject_id`, `school_year`, `teacher_id`, `time_start`, `time_finish`, `days`, `room`) VALUES
(2, '2', '1', '2020-2021 - 1st semester', '5', '3:15 PM', '3:15 PM', 'TH', '12345'),
(3, '3', '2', '2020-2021 - 1st semester', '5', '1:15 AM', '3:15 PM', 'TH', '123'),
(4, '2', '2', '2020-2021 - 1st semester', '5', '1:15 AM', '3:15 PM', 'TH', '123'),
(5, '3', '2', '2020-2021 - 1st semester', '5', '1:15 AM', '3:15 PM', 'TH', '123'),
(6, '2', '1', '2020-2021 - 1st semester', '5', '3:15 PM', '3:15 PM', 'TH', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_year`
--

CREATE TABLE IF NOT EXISTS `tbl_school_year` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `school_year` varchar(10) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `online_registration` varchar(200) NOT NULL,
  `input_grades` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_school_year`
--

INSERT INTO `tbl_school_year` (`id`, `school_year`, `semester`, `status`, `online_registration`, `input_grades`) VALUES
(1, '2020-2021', '1st semester', 'on', 'on', ''),
(2, '2021-2022', '1st semester', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE IF NOT EXISTS `tbl_section` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NOT NULL,
  `section_description` varchar(30) NOT NULL,
  `slot` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `course_id`, `section_description`, `slot`) VALUES
(2, 1, 'SECTION1', '30'),
(3, 2, 'SECTION2', '30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_course`
--

CREATE TABLE IF NOT EXISTS `tbl_student_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_student_course`
--

INSERT INTO `tbl_student_course` (`id`, `course_id`, `student_id`, `reg_date`) VALUES
(1, 1, 1, '2019-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE IF NOT EXISTS `tbl_student_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_picture` varchar(200) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `address` varchar(200) NOT NULL,
  `birth_date` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_address` varchar(200) NOT NULL,
  `date_registered` varchar(50) NOT NULL,
  `year_level_id` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`id`, `student_picture`, `student_number`, `fname`, `mname`, `lname`, `email`, `password`, `address`, `birth_date`, `gender`, `contact`, `guardian_name`, `guardian_address`, `date_registered`, `year_level_id`, `status`) VALUES
(1, '', '2019-0001', 'TEST', 'TEST', 'TEST', 'petealloydbismonte@gmail.com', '5a1760628ea739e61d9bb798b50542d5', 'asdasd', '2019/09/06', 'Male', '(1111) 111-1111', 'asdasd', 'asdasd', '09-06-2019', '2', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_student_profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(10) NOT NULL,
  `school_year_id` varchar(10) NOT NULL,
  `section_id` varchar(10) NOT NULL,
  `verified` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL,
  `scholar` varchar(10) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_student_subject` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `schedule_id` varchar(20) NOT NULL,
  `school_year_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) DEFAULT NULL,
  `midterm` varchar(20) NOT NULL DEFAULT '0',
  `final` varchar(20) NOT NULL DEFAULT '0',
  `gpa` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_description` varchar(50) NOT NULL,
  `subject_name` varchar(45) NOT NULL,
  `prerequisite` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`id`, `course_id`, `unit_id`, `subject_code`, `subject_description`, `subject_name`, `prerequisite`) VALUES
(1, 1, 1, 'test-123', 'TEST', '', ''),
(2, 1, 2, 'TEST-412', 'PREREQUIS', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `picture` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `picture`, `username`, `password`, `fname`, `mname`, `lname`, `email`, `userid`) VALUES
(5, '69334859_2551712305067587_7559704415955845120_n.jpg', 'faculty', '5a1760628ea739e61d9bb798b50542d5', 'faculty', '.', 'faculty', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_description` varchar(10) NOT NULL,
  `unit_price` varchar(20) NOT NULL,
  `unit_type` varchar(20) NOT NULL,
  `unit_count` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `unit_description`, `unit_price`, `unit_type`, `unit_count`) VALUES
(1, 'Lecture', '209.37', 'MINOR', '2'),
(2, 'Laboratory', '315.96', 'MAJOR', '3'),
(3, 'NSTP', '500', 'NSTP', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_picture` varchar(200) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(500) NOT NULL,
  `userstat` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `userlvl` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_picture`, `username`, `password`, `fname`, `mname`, `lname`, `email`, `userstat`, `status`, `userlvl`) VALUES
(2, '', 'cashier', '5a1760628ea739e61d9bb798b50542d5', 'Cashier', 'C', 'Cashier', 'petealloydbismonte@gmail.com', 'on', '', 'CASHIER'),
(3, '123456789.jpg', 'admin', '5a1760628ea739e61d9bb798b50542d5', 'admin', 'a', 'admin', '', 'on', '', 'ADMINISTRATOR'),
(5, '', 'registrar', '5a1760628ea739e61d9bb798b50542d5', 'registrar', 'r', 'registrar', '', 'on', '', 'REGISTRAR'),
(6, 'ap,550x550,12x16,1,transparent,t.u2.png', 'dean', '5a1760628ea739e61d9bb798b50542d5', 'Dean', 'D', 'Dean', '', '', '', 'DEAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_yearlevel`
--

CREATE TABLE IF NOT EXISTS `tbl_yearlevel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `year_level` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_yearlevel`
--

INSERT INTO `tbl_yearlevel` (`id`, `year_level`) VALUES
(1, 'FIRST YEAR'),
(2, 'SECOND YEAR'),
(3, 'THIRD YEAR'),
(4, 'FOURTH YEAR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
