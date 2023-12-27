-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-kolek`
--

-- --------------------------------------------------------

--
-- Table structure for table `baranggay`
--

CREATE TABLE `baranggay` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baranggay`
--

INSERT INTO `baranggay` (`b_id`, `b_name`, `m_id`) VALUES
(3, 'gonzalez', 1),
(4, 'tavera', 1),
(5, 'baño', 1),
(6, 'taft', 1),
(7, 'rizal', 1),
(14, 'burgos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_stats`
--

CREATE TABLE `form_stats` (
  `s_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=enable, 0=disable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_stats`
--

INSERT INTO `form_stats` (`s_id`, `status`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `municpality`
--

CREATE TABLE `municpality` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municpality`
--

INSERT INTO `municpality` (`m_id`, `m_name`) VALUES
(1, 'Pakil'),
(2, 'Siniloan'),
(3, 'Pangil'),
(4, 'Paete'),
(5, 'kalayaan'),
(6, 'Longus'),
(7, 'Lumban'),
(8, 'Pagsanjan'),
(9, 'Sta. Cruz'),
(10, 'Pila'),
(11, 'Famy'),
(12, 'Victoria'),
(13, 'Cavinti'),
(14, 'Luisiana'),
(15, 'Los Baños'),
(16, 'Mabitac'),
(17, 'Majayjay'),
(18, 'Magdalena'),
(19, 'Santa Maria'),
(20, 'Nagcarlan'),
(21, 'Calauan'),
(22, 'Cavinti'),
(23, 'Calamba'),
(24, 'San Pedro'),
(25, 'Bay'),
(26, 'Biñan'),
(27, 'Santa Rosa'),
(28, 'Liliw');

-- --------------------------------------------------------

--
-- Table structure for table `tblcitizencharter`
--

CREATE TABLE `tblcitizencharter` (
  `cc_id` int(11) NOT NULL,
  `cc_lgu` varchar(255) NOT NULL,
  `cc_lgu_office` text NOT NULL,
  `frontline_service` text NOT NULL,
  `cc_procedure` text NOT NULL,
  `time` text NOT NULL,
  `responsible_person` text NOT NULL,
  `requirements` text NOT NULL,
  `output` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcitizencharter`
--

INSERT INTO `tblcitizencharter` (`cc_id`, `cc_lgu`, `cc_lgu_office`, `frontline_service`, `cc_procedure`, `time`, `responsible_person`, `requirements`, `output`) VALUES
(1, 'Municipal Government of Pakil, Laguna', 'Municipal Environment and Natural Resources Office/Office of the Mayor', 'Garbage Collection', '    Daily collection of segregated solid waste from barangay pick-up station', '5 hours daily from Monday to Friday or as per schedule', 'MRF/Dumptruck Personnel', 'Schedule of collection', 'Solid waste collected');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulletin`
--

CREATE TABLE `tbl_bulletin` (
  `b_id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `b_message` text NOT NULL,
  `b_photo` varchar(300) NOT NULL,
  `b_posted_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_pass` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `b_brgy_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bulletin`
--

INSERT INTO `tbl_bulletin` (`b_id`, `posted_by`, `b_message`, `b_photo`, `b_posted_date`, `date_pass`, `time_from`, `time_to`, `b_brgy_id`) VALUES
(354, 70, 'TWFnYW5kYW5nIGFyYXcgcG8gc2FpbnlvbmcgbGFoYXQgbWFnIGtha2Fyb24gcG8gdGF5byBuZyBvYW5nb25nb2xla3RhIG5nIGJhc3VyYW5nIGRpIG5hYnVidWxvayBtYWtpa2lsYWJhcyBuYWxhbmcgcG8gU0FMQU1BVCBQTyA=', '../img/otw.jpg', '2023-11-20 23:42:14', '2023-11-21', '07:41:00', '13:41:00', 5),
(355, 70, 'S29sZWt0YSBuZyBtZ2EgbmFidXVsb2sgbmEgYmFzdXJhLg==', '../img/otw.jpg', '2023-11-21 00:07:11', '2023-11-21', '06:00:00', '12:00:00', 3),
(356, 70, 'S29sZWt0YSBuZyBtZ2EgaGluZGkgbmFidWJ1bG9rIG5hIGJhc3VyYS4gTWFyYW1pbmcgU2FsYW1hdCBwby4=', '../img/otw.jpg', '2023-11-21 00:08:11', '2023-11-21', '06:00:00', '12:00:00', 4),
(357, 83, 'TWF5IGtvbGVrdGEgcG8gdGF5byBuZyBiYXN1cmEgbmEgcmVjeWNhYmxlIG1ha2lraWxhYmFzIG5hbGFuZyBwbyBzYWxhbWF0IHBvIA==', '../img/otw.jpg', '2023-11-21 00:11:18', '2023-11-21', '08:10:00', '13:10:00', 3),
(358, 70, 'TWFraWtpbGFiYXMgbmFwbyBuZyBpbnlvbmcgbWdhIGJhc3VyYSBwYXJhIG1hZGFsaSBuYSBwbyBhbmcga29sZWtzeW9uIG5hdGluLg==', '../img/otw.jpg', '2023-11-21 00:11:32', '2023-11-22', '06:00:00', '11:00:00', 7),
(359, 70, 'S29sZWt0YSBuZyBtZ2EgYmFzdXJhIG5hIG5hYnVidWxvay4=', '../img/otw.jpg', '2023-11-27 09:34:14', '2023-11-27', '05:33:00', '10:33:00', 3),
(360, 70, 'TWF5IGtvbGVrdGEgcG8gdGF5byBuZyBiYXN1cmEgbWFraWtpbGFiYXMgbmFwbyBtYWxhcGl0IHNhIGthbGFzYWRhIGxhaGF0IHBvIG5nIG5hYnVidWxvayBhdCBoaW5kaSBuYWJ1YnVsb2suIE1hcmFtaW5nIFNhbGFtYXQgUG8h', '../img/otw.jpg', '2023-11-30 04:06:56', '2023-12-01', '06:00:00', '12:00:00', 3),
(361, 91, 'TUFHQU5EQSBBUkFXIFBPIE1HQSBLQUJBUkFOR0FZIE1BQVJJTkcgUE8gUEFLSUxBQkFTIFBPIEFORyBJTllPTkcgTUdBIEJBU1VSQQ==', '../img/otw.jpg', '2023-12-09 01:09:58', '2023-12-09', '09:45:00', '11:45:00', 7),
(362, 91, 'QW5nIGtva29sZWt0YWhpbiBwbyBuYXRpbiBuZ2F5b24gYXkgYmFzdXJhbmcgaGluZGkgbmFidWJ1bG9r', '../img/otw.jpg', '2023-12-09 02:00:51', '2023-12-09', '10:05:00', '10:15:00', 7),
(363, 89, 'TWdhIG5hYnVidWxvay5uYSBiYXN1cmEgYW5nIGtva29sZWt0YWhpbiBtYWtpa2lsYWJhcyBuYWxhbmcgcG8=', '../img/otw.jpg', '2023-12-13 08:23:28', '2023-12-14', '06:00:00', '09:00:00', 14),
(364, 89, 'TWdhIG5hYnVidWxvay5uYSBiYXN1cmEgYW5nIGtva29sZWt0YWhpbiBtYWtpa2lsYWJhcyBuYWxhbmcgcG8=', '../img/otw.jpg', '2023-12-13 08:23:30', '2023-12-14', '06:00:00', '09:00:00', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulletin_comment`
--

CREATE TABLE `tbl_bulletin_comment` (
  `bc_id` int(11) NOT NULL,
  `bc_comment_by` int(11) NOT NULL,
  `bc_comment` text NOT NULL,
  `bc_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bc_bulletin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bulletin_comment`
--

INSERT INTO `tbl_bulletin_comment` (`bc_id`, `bc_comment_by`, `bc_comment`, `bc_timestamp`, `bc_bulletin_id`) VALUES
(44, 70, 'Hotdog', '2023-11-30 04:03:20', 359),
(45, 94, 'Collected', '2023-11-30 04:08:55', 360),
(46, 100, 'Collected', '2023-12-09 01:57:34', 361),
(47, 100, 'Salamat po sa impormasyon ', '2023-12-09 02:01:36', 362);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulletin_viewer`
--

CREATE TABLE `tbl_bulletin_viewer` (
  `v_id` int(11) NOT NULL,
  `v_b_id` int(11) NOT NULL,
  `v_user_id` int(11) DEFAULT NULL,
  `v_status` int(11) NOT NULL DEFAULT 0 COMMENT '0-unseen,1-seen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bulletin_viewer`
--

INSERT INTO `tbl_bulletin_viewer` (`v_id`, `v_b_id`, `v_user_id`, `v_status`) VALUES
(26, 354, 4, 1),
(27, 354, 70, 1),
(28, 354, 71, 1),
(29, 355, 4, 1),
(30, 355, 70, 1),
(33, 356, 4, 1),
(34, 356, 70, 1),
(35, 357, 4, 1),
(36, 357, 70, 1),
(40, 358, 4, 1),
(41, 358, 70, 1),
(44, 359, 4, 1),
(45, 359, 70, 1),
(48, 360, 4, 1),
(49, 360, 70, 1),
(50, 360, 88, 0),
(51, 360, 89, 0),
(52, 360, 90, 0),
(53, 360, 91, 1),
(54, 360, 92, 0),
(55, 360, 94, 1),
(56, 361, 4, 1),
(57, 361, 70, 0),
(58, 361, 88, 0),
(59, 361, 89, 0),
(60, 361, 90, 0),
(61, 361, 91, 1),
(62, 361, 92, 0),
(63, 361, 100, 1),
(64, 362, 4, 1),
(65, 362, 70, 0),
(66, 362, 88, 0),
(67, 362, 89, 0),
(68, 362, 90, 0),
(69, 362, 91, 1),
(70, 362, 92, 0),
(71, 362, 100, 1),
(72, 363, 4, 1),
(73, 363, 70, 0),
(74, 363, 88, 0),
(75, 363, 89, 0),
(76, 363, 90, 0),
(77, 363, 91, 0),
(78, 363, 92, 0),
(79, 363, 99, 0),
(80, 364, 4, 1),
(81, 364, 70, 0),
(82, 364, 88, 0),
(83, 364, 89, 0),
(84, 364, 90, 0),
(85, 364, 91, 0),
(86, 364, 92, 0),
(87, 364, 99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collection_completion_report`
--

CREATE TABLE `tbl_collection_completion_report` (
  `ccr_id` int(11) NOT NULL,
  `ccr_user_id` int(11) NOT NULL,
  `ccr_total_truck` varchar(100) NOT NULL,
  `ccr_brgy` int(11) DEFAULT NULL,
  `ccr_date_collection` varchar(100) DEFAULT NULL,
  `ccr_date_reported` timestamp NOT NULL DEFAULT current_timestamp(),
  `ccr_date_transferred` timestamp NULL DEFAULT NULL,
  `ccr_status` varchar(150) NOT NULL COMMENT 'collected, on the way, transferred'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_collection_completion_report`
--

INSERT INTO `tbl_collection_completion_report` (`ccr_id`, `ccr_user_id`, `ccr_total_truck`, `ccr_brgy`, `ccr_date_collection`, `ccr_date_reported`, `ccr_date_transferred`, `ccr_status`) VALUES
(23, 70, '4', 3, '2023-10-04', '2023-10-07 12:23:39', '2023-11-20 23:43:14', 'transferred'),
(24, 70, '6', 4, '2023-10-05', '2023-10-07 12:23:51', '2023-11-20 23:43:17', 'transferred'),
(25, 70, '6', 6, '2023-10-05', '2023-10-07 12:23:51', '2023-11-20 23:43:19', 'transferred'),
(26, 70, '3', 3, '2023-11-20', '2023-11-20 03:49:47', '2023-11-20 23:43:22', 'transferred'),
(27, 70, '3', 3, '2023-11-21', '2023-11-20 23:29:49', '2023-11-20 23:43:56', 'transferred'),
(28, 70, '5', 4, '2023-11-21', '2023-11-20 23:43:41', '2023-11-23 06:19:41', 'transferred'),
(29, 70, '2', 3, '2023-11-21', '2023-11-21 00:46:42', NULL, 'on the way'),
(30, 70, '3', 3, '2023-11-21', '2023-11-21 05:23:50', NULL, 'collected'),
(31, 70, '4', 3, '2023-11-27', '2023-11-30 04:28:58', NULL, 'collected'),
(32, 91, '4', 7, '2023-11-08', '2023-12-09 01:16:09', NULL, 'collected'),
(33, 91, '5', 7, '2023-10-13', '2023-12-09 01:20:02', NULL, 'collected'),
(34, 89, '3', 14, '2023-11-17', '2023-12-13 08:24:03', NULL, 'collected'),
(35, 89, '4', 14, '2023-12-22', '2023-12-13 08:24:14', NULL, 'collected'),
(36, 89, '2', 14, '2023-12-28', '2023-12-13 08:24:29', NULL, 'collected'),
(37, 89, '3', 14, '2023-11-30', '2023-12-13 08:24:44', NULL, 'collected'),
(38, 92, '3', 5, '2023-11-08', '2023-12-13 08:25:20', NULL, 'collected'),
(39, 92, '2', 5, '2023-11-15', '2023-12-13 08:25:34', NULL, 'collected'),
(40, 92, '1', 5, '2023-11-22', '2023-12-13 08:25:48', NULL, 'collected'),
(41, 92, '3', 5, '2023-11-29', '2023-12-13 08:26:02', NULL, 'collected');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collection_ratings`
--

CREATE TABLE `tbl_collection_ratings` (
  `cr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cr_sitio` varchar(255) NOT NULL,
  `brgy` int(11) NOT NULL,
  `cr_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `ratings` int(11) NOT NULL COMMENT '1-Not at all satisfied\r\n2-slightly satisfied\r\n3-moderately satisfied\r\n4-Very satisfied\r\n5-Extremely satisfied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_collection_ratings`
--

INSERT INTO `tbl_collection_ratings` (`cr_id`, `user_id`, `cr_sitio`, `brgy`, `cr_timestamp`, `status`, `ratings`) VALUES
(6, 71, 'Sitio 1', 5, '2023-12-23 10:54:29', 'collected', 4),
(7, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'collected', 3),
(8, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 3),
(9, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 1),
(10, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 2),
(11, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 5),
(12, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 5),
(13, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 5),
(14, 71, 'Sitio 1', 5, '2023-12-23 10:54:29', 'collected', 4),
(15, 71, 'Sitio 2', 5, '2023-12-23 10:55:01', 'not-collected', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collector_satisfactory_rating`
--

CREATE TABLE `tbl_collector_satisfactory_rating` (
  `rate_id` int(11) NOT NULL,
  `rated_by` int(11) NOT NULL,
  `collectors_id` int(11) NOT NULL,
  `ratings_no` int(11) NOT NULL,
  `date_rated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_collector_satisfactory_rating`
--

INSERT INTO `tbl_collector_satisfactory_rating` (`rate_id`, `rated_by`, `collectors_id`, `ratings_no`, `date_rated`) VALUES
(31, 71, 70, 91, '2023-10-31'),
(46, 71, 70, 51, '2023-11-21'),
(47, 100, 91, 22, '2023-12-09'),
(48, 96, 91, 30, '2023-12-09'),
(49, 94, 91, 18, '2023-12-09'),
(50, 96, 91, 3, '2023-12-09'),
(51, 97, 91, 14, '2023-12-09'),
(52, 96, 89, 100, '2023-12-13'),
(53, 96, 89, 29, '2023-12-13'),
(54, 96, 89, 64, '2023-12-13'),
(55, 96, 89, 51, '2023-12-13'),
(56, 96, 89, 81, '2023-12-13'),
(57, 97, 90, 0, '2023-12-13'),
(58, 97, 90, 54, '2023-12-13'),
(59, 97, 90, 86, '2023-12-13'),
(60, 97, 90, 82, '2023-12-13'),
(61, 97, 90, 17, '2023-12-13'),
(62, 99, 92, 80, '2023-12-13'),
(63, 99, 92, 80, '2023-12-13'),
(64, 99, 92, 83, '2023-12-13'),
(65, 99, 92, 93, '2023-12-13'),
(66, 99, 92, 95, '2023-12-13'),
(67, 99, 92, 100, '2023-12-13'),
(68, 99, 92, 83, '2023-12-13'),
(69, 99, 92, 93, '2023-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notif_rating` varchar(100) NOT NULL,
  `notif_message` text NOT NULL,
  `notif_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notif_view` int(11) NOT NULL DEFAULT 0,
  `notif_view_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `report_id` int(11) NOT NULL,
  `report_user_id` int(11) NOT NULL,
  `r_brgy` int(11) NOT NULL,
  `r_sitio` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending, done, verified, false-complaint, on-process, rated',
  `date_reported` date DEFAULT NULL,
  `report_m_id` int(11) NOT NULL,
  `report_b_id` int(11) NOT NULL,
  `r_proof` varchar(300) DEFAULT NULL,
  `r_posted_proof` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`report_id`, `report_user_id`, `r_brgy`, `r_sitio`, `message`, `status`, `date_reported`, `report_m_id`, `report_b_id`, `r_proof`, `r_posted_proof`) VALUES
(79, 94, 3, '', 'hindi regular na pag kulekta ng basura', 'rated', '2023-11-30', 1, 3, '../upload/images (14).jpeg', '2023-11-30 04:27:43'),
(80, 97, 6, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'done', '2023-12-04', 1, 6, '../upload/images_(15).jpeg', '2023-12-13 08:37:37'),
(81, 94, 3, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'rated', '2023-12-04', 1, 3, NULL, NULL),
(82, 100, 7, '', 'hind sumusunod sa schedule ng pangungulekta ng basura', 'false-complaint', '2023-12-13', 1, 7, NULL, NULL),
(83, 100, 7, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'false-complaint', '2023-12-13', 1, 7, NULL, NULL),
(84, 100, 7, '', 'hindi regular na pag kulekta ng basura', 'done', '2023-12-13', 1, 7, '../upload/images_(15).jpeg', '2023-12-13 08:37:37'),
(85, 100, 7, '', 'Others -Mabaho na ang amoy dahil aa dami ng basura', 'false-complaint', '2023-12-13', 1, 7, NULL, NULL),
(86, 100, 7, '', 'Others -Naglabas agad ng mga basura wala pang announce ng kolekta.', 'false-complaint', '2023-12-13', 1, 7, NULL, NULL),
(87, 95, 4, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'false-complaint', '2023-12-13', 1, 4, NULL, NULL),
(88, 95, 4, '', 'hind sumusunod sa schedule ng pangungulekta ng basura', 'false-complaint', '2023-12-13', 1, 4, NULL, NULL),
(89, 95, 4, '', 'hindi regular na pag kulekta ng basura', 'false-complaint', '2023-12-13', 1, 4, NULL, NULL),
(90, 95, 4, '', 'hindi maayus na segregation', 'false-complaint', '2023-12-13', 1, 4, NULL, NULL),
(91, 95, 4, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'false-complaint', '2023-12-13', 1, 4, NULL, NULL),
(92, 96, 5, '', 'hind sumusunod sa schedule ng pangungulekta ng basura', 'done', '2023-12-13', 1, 5, '../upload/images_(15).jpeg', '2023-12-13 08:37:37'),
(93, 96, 5, '', 'hindi regular na pag kulekta ng basura', 'false-complaint', '2023-12-13', 1, 5, NULL, NULL),
(94, 96, 5, '', 'Others -Ayaw kunin ang basura sobrang dami na nakatmabak', 'false-complaint', '2023-12-13', 1, 5, NULL, NULL),
(95, 96, 5, '', 'hindi regular na pag kulekta ng basura', 'false-complaint', '2023-12-13', 1, 5, NULL, NULL),
(96, 96, 5, '', 'Others -Hindi sumusunod sa schedule ng kolekta', 'done', '2023-12-13', 1, 5, '../upload/images_(15).jpeg', '2023-12-13 08:37:37'),
(97, 97, 6, '', 'hind sumusunod sa schedule ng pangungulekta ng basura', 'false-complaint', '2023-12-13', 1, 6, NULL, NULL),
(98, 97, 6, '', 'Others -Ginawang basurahan na ang ilog dito sa amin', 'false-complaint', '2023-12-13', 1, 6, NULL, NULL),
(99, 97, 6, '', 'Others -Ilog ginawa ng tambakan puro basura', 'false-complaint', '2023-12-13', 1, 6, NULL, NULL),
(100, 97, 6, '', 'hindi maayus na segregation', 'false-complaint', '2023-12-13', 1, 6, NULL, NULL),
(101, 99, 14, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'false-complaint', '2023-12-13', 1, 14, NULL, NULL),
(102, 99, 14, '', 'kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura', 'done', '2023-12-13', 1, 14, '../upload/images_(15).jpeg', '2023-12-13 08:37:37'),
(103, 99, 14, '', 'hind sumusunod sa schedule ng pangungulekta ng basura', 'false-complaint', '2023-12-13', 1, 14, NULL, NULL),
(104, 99, 14, '', 'hindi regular na pag kulekta ng basura', 'false-complaint', '2023-12-13', 1, 14, NULL, NULL),
(105, 99, 14, '', 'Others -Nakakalat na ang basura sa tagal ng koleksyon.', 'false-complaint', '2023-12-13', 1, 14, NULL, NULL),
(106, 71, 5, 'km 19', 'hindi regular na pag kulekta ng basura', 'pending', '2023-12-23', 1, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_feedback`
--

CREATE TABLE `tbl_report_feedback` (
  `rf_id` int(11) NOT NULL,
  `rf_rate` int(11) NOT NULL,
  `rf_feedback` longtext NOT NULL,
  `rf_report_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report_feedback`
--

INSERT INTO `tbl_report_feedback` (`rf_id`, `rf_rate`, `rf_feedback`, `rf_report_id`) VALUES
(38, 30, 'Tm90IGJlZW4gYWRkcmVzc2Vk', 81),
(39, 92, 'TWFodXNheSBkYWhpbCBuYWdhbXBhbmFuIG5nIGF5b3M=', 79);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_image`
--

CREATE TABLE `tbl_report_image` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(100) NOT NULL,
  `img_path` varchar(200) NOT NULL,
  `img_report_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report_image`
--

INSERT INTO `tbl_report_image` (`img_id`, `img_name`, `img_path`, `img_report_id`) VALUES
(73, 'images (9).jpeg', '../upload/images (9).jpeg', 79),
(74, 'images (13).jpeg', '../upload/images (13).jpeg', 80),
(75, 'images (16).jpeg', '../upload/images (16).jpeg', 81),
(76, 'images_(7).jpeg', '../upload/images_(7).jpeg', 82),
(77, 'images_(12).jpeg', '../upload/images_(12).jpeg', 83),
(78, 'images_(9).jpeg', '../upload/images_(9).jpeg', 84),
(79, 'images_(12).jpeg', '../upload/images_(12).jpeg', 85),
(80, 'images (5).jpeg', '../upload/images (5).jpeg', 86),
(81, 'images (2).jpeg', '../upload/images (2).jpeg', 87),
(82, 'images (6).jpeg', '../upload/images (6).jpeg', 88),
(83, 'images (7).jpeg', '../upload/images (7).jpeg', 89),
(84, 'images (3).jpeg', '../upload/images (3).jpeg', 90),
(85, 'images (4).jpeg', '../upload/images (4).jpeg', 91),
(86, 'images (13).jpeg', '../upload/images (13).jpeg', 92),
(87, 'images (8).jpeg', '../upload/images (8).jpeg', 93),
(88, 'images (16).jpeg', '../upload/images (16).jpeg', 94),
(89, 'images (19).jpeg', '../upload/images (19).jpeg', 95),
(90, 'images (7).jpeg', '../upload/images (7).jpeg', 96),
(91, 'images (15).jpeg', '../upload/images (15).jpeg', 97),
(92, 'images (10).jpeg', '../upload/images (10).jpeg', 98),
(93, 'images (15).jpeg', '../upload/images (15).jpeg', 99),
(94, 'images (9).jpeg', '../upload/images (9).jpeg', 100),
(95, 'download.jpeg', '../upload/download.jpeg', 101),
(96, 'images (1).jpeg', '../upload/images (1).jpeg', 102),
(97, 'images (11).jpeg', '../upload/images (11).jpeg', 103),
(98, 'images (18).jpeg', '../upload/images (18).jpeg', 104),
(99, 'images (8).jpeg', '../upload/images (8).jpeg', 105),
(100, 'collector.jpg', '../upload/collector.jpg', 106);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_status`
--

CREATE TABLE `tbl_report_status` (
  `s_id` int(11) NOT NULL,
  `s_status` varchar(100) NOT NULL,
  `s_report_id` int(11) NOT NULL,
  `s_date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report_status`
--

INSERT INTO `tbl_report_status` (`s_id`, `s_status`, `s_report_id`, `s_date_updated`) VALUES
(151, 'pending', 63, '2023-10-29 00:11:56'),
(152, 'on-process', 63, '2023-10-29 00:12:12'),
(153, 'verified', 63, '2023-10-29 00:12:19'),
(154, 'done', 63, '2023-10-29 00:13:37'),
(155, 'rated', 63, '2023-10-31 11:35:46'),
(156, 'pending', 76, '2023-11-26 20:41:37'),
(157, 'pending', 77, '2023-11-26 20:47:19'),
(158, 'on-process', 77, '2023-11-26 20:48:25'),
(159, 'verified', 77, '2023-11-26 20:49:43'),
(160, 'done', 77, '2023-11-26 20:51:02'),
(161, 'rated', 77, '2023-11-26 20:52:11'),
(162, 'pending', 78, '2023-11-26 21:03:09'),
(163, 'pending', 79, '2023-11-30 04:13:33'),
(164, 'on-process', 79, '2023-11-30 04:26:34'),
(165, 'verified', 79, '2023-11-30 04:27:02'),
(166, 'done', 79, '2023-11-30 04:27:43'),
(167, 'pending', 80, '2023-12-04 00:11:15'),
(168, 'pending', 81, '2023-12-04 00:14:04'),
(169, 'on-process', 81, '2023-12-08 11:29:23'),
(170, 'false-complaint', 81, '2023-12-09 01:17:15'),
(171, 'on-process', 80, '2023-12-09 01:17:24'),
(172, 'rated', 81, '2023-12-12 12:43:47'),
(173, 'rated', 79, '2023-12-12 12:44:23'),
(174, 'pending', 82, '2023-12-13 07:14:34'),
(175, 'pending', 83, '2023-12-13 07:14:50'),
(176, 'pending', 84, '2023-12-13 07:16:42'),
(177, 'pending', 85, '2023-12-13 07:17:14'),
(178, 'pending', 86, '2023-12-13 07:21:38'),
(179, 'pending', 87, '2023-12-13 07:22:53'),
(180, 'pending', 88, '2023-12-13 07:23:23'),
(181, 'pending', 89, '2023-12-13 07:23:34'),
(182, 'pending', 90, '2023-12-13 07:26:07'),
(183, 'pending', 91, '2023-12-13 07:26:34'),
(184, 'pending', 92, '2023-12-13 07:43:36'),
(185, 'pending', 93, '2023-12-13 07:43:52'),
(186, 'pending', 94, '2023-12-13 07:44:34'),
(187, 'pending', 95, '2023-12-13 07:44:44'),
(188, 'pending', 96, '2023-12-13 07:45:16'),
(189, 'pending', 97, '2023-12-13 07:58:56'),
(190, 'pending', 98, '2023-12-13 07:59:25'),
(191, 'pending', 99, '2023-12-13 08:00:53'),
(192, 'pending', 100, '2023-12-13 08:01:08'),
(193, 'pending', 101, '2023-12-13 08:13:42'),
(194, 'pending', 102, '2023-12-13 08:13:57'),
(195, 'pending', 103, '2023-12-13 08:15:49'),
(196, 'pending', 104, '2023-12-13 08:18:19'),
(197, 'pending', 105, '2023-12-13 08:18:51'),
(198, 'on-process', 92, '2023-12-13 08:27:43'),
(199, 'on-process', 100, '2023-12-13 08:27:49'),
(200, 'on-process', 101, '2023-12-13 08:28:07'),
(201, 'on-process', 84, '2023-12-13 08:28:18'),
(202, 'on-process', 96, '2023-12-13 08:28:23'),
(203, 'false-complaint', 101, '2023-12-13 08:28:42'),
(204, 'verified', 92, '2023-12-13 08:28:47'),
(205, 'verified', 96, '2023-12-13 08:28:52'),
(206, 'verified', 80, '2023-12-13 08:29:00'),
(207, 'verified', 84, '2023-12-13 08:29:08'),
(208, 'on-process', 103, '2023-12-13 08:29:12'),
(209, 'on-process', 102, '2023-12-13 08:29:16'),
(210, 'verified', 102, '2023-12-13 08:29:44'),
(211, 'on-process', 86, '2023-12-13 08:29:54'),
(212, 'on-process', 105, '2023-12-13 08:35:15'),
(213, 'on-process', 104, '2023-12-13 08:35:15'),
(214, 'on-process', 99, '2023-12-13 08:35:15'),
(215, 'on-process', 98, '2023-12-13 08:35:15'),
(216, 'on-process', 97, '2023-12-13 08:35:15'),
(217, 'on-process', 95, '2023-12-13 08:35:15'),
(218, 'on-process', 94, '2023-12-13 08:35:15'),
(219, 'on-process', 93, '2023-12-13 08:35:15'),
(220, 'on-process', 91, '2023-12-13 08:35:15'),
(221, 'on-process', 90, '2023-12-13 08:35:15'),
(222, 'on-process', 89, '2023-12-13 08:35:15'),
(223, 'on-process', 88, '2023-12-13 08:35:15'),
(224, 'on-process', 87, '2023-12-13 08:35:15'),
(225, 'on-process', 85, '2023-12-13 08:35:15'),
(226, 'on-process', 83, '2023-12-13 08:35:15'),
(227, 'on-process', 82, '2023-12-13 08:35:15'),
(228, 'done', 92, '2023-12-13 08:37:37'),
(229, 'done', 92, '2023-12-13 08:37:37'),
(230, 'done', 92, '2023-12-13 08:37:37'),
(231, 'done', 92, '2023-12-13 08:37:37'),
(232, 'done', 92, '2023-12-13 08:37:37'),
(233, 'false-complaint', 105, '2023-12-13 08:39:22'),
(234, 'false-complaint', 104, '2023-12-13 08:39:22'),
(235, 'false-complaint', 103, '2023-12-13 08:39:22'),
(236, 'false-complaint', 100, '2023-12-13 08:39:22'),
(237, 'false-complaint', 99, '2023-12-13 08:39:22'),
(238, 'false-complaint', 98, '2023-12-13 08:39:22'),
(239, 'false-complaint', 97, '2023-12-13 08:39:22'),
(240, 'false-complaint', 95, '2023-12-13 08:39:22'),
(241, 'false-complaint', 94, '2023-12-13 08:39:22'),
(242, 'false-complaint', 93, '2023-12-13 08:39:22'),
(243, 'false-complaint', 91, '2023-12-13 08:39:22'),
(244, 'false-complaint', 90, '2023-12-13 08:39:22'),
(245, 'false-complaint', 89, '2023-12-13 08:39:22'),
(246, 'false-complaint', 88, '2023-12-13 08:39:22'),
(247, 'false-complaint', 87, '2023-12-13 08:39:22'),
(248, 'false-complaint', 86, '2023-12-13 08:39:22'),
(249, 'false-complaint', 85, '2023-12-13 08:39:22'),
(250, 'false-complaint', 83, '2023-12-13 08:39:22'),
(251, 'false-complaint', 82, '2023-12-13 08:39:22'),
(252, 'pending', 106, '2023-12-23 04:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `r_id` int(11) NOT NULL,
  `r_user_id` int(11) NOT NULL,
  `request` longtext NOT NULL,
  `request_date` varchar(200) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `r_status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'approved,pending, on-process, done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`r_id`, `r_user_id`, `request`, `request_date`, `date_posted`, `r_status`) VALUES
(19, 100, 'Nagrennovate ng bahay maraming panambak na lupa. Dito po sa harap ng brgy hall sa may kalsada', '2023-11-30', '2023-12-09 01:11:20', 'done'),
(20, 96, 'Makiki kuha nga mga hazardous na basura baka pagmulan pa ng sakit dito po malapit sa baranggay hall ng baño.', '2023-12-13', '2023-12-13 07:47:59', 'pending'),
(21, 96, 'Mga lumang gamit na nakatambak itatapon na dito po sa malapit m&w', '2023-11-02', '2023-12-13 07:54:56', 'pending'),
(22, 97, 'Mayroong mga salamin na basag ang itatapon saka mga hazardous na chemical na maaring maging sanhi ng sakit.', '2023-12-30', '2023-12-13 07:57:16', 'pending'),
(23, 97, 'Mayroong mga lupa na pwedeng panambak dito nakaharang sa daan malapit sa sementeryo ng ilaya.', '2023-12-21', '2023-12-13 07:58:11', 'pending'),
(24, 99, 'Mga basurang nakuha sa ilog na naipon sa taning kalsada nakaharang na po makikikuha nalang salamat po', '2023-12-15', '2023-12-13 08:09:09', 'pending'),
(25, 99, 'Mayroong nagtapon ng mga medical waste malapit sa ating ilog baka kumalat pa makiki-pickup nalang po salamat.', '2023-12-14', '2023-12-13 08:13:19', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `accnt_status` varchar(100) NOT NULL DEFAULT 'active' COMMENT 'active,inactive',
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) NOT NULL COMMENT '1-Admin,2-Household,3-Collector',
  `photo` text DEFAULT NULL,
  `brgy` int(11) DEFAULT NULL,
  `user_m_id` int(11) NOT NULL,
  `duty` int(11) DEFAULT 0 COMMENT '1-On-duty, 0-Off-duty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `fname`, `mname`, `lname`, `accnt_status`, `username`, `password`, `email`, `phone`, `user_type`, `photo`, `brgy`, `user_m_id`, `duty`) VALUES
(4, 'Juan', 'A', 'Dela Cruz', 'active', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'mail.verifier2022@gmail.com', '09159459270', '1', '../upload/admin.png', NULL, 1, 0),
(70, 'Michael', 'A', 'James', 'active', 'collector', 'e9b14f010c91507ddbdd32bd28911ba8a9f3d30f', 'ebacalso77@gmail.com', '09976093431', '3', '../upload/pngwing.com.png', 5, 1, 1),
(71, 'John', 'A', 'ken', 'active', 'resident1', 'da285a3093edf44c93434fd31810cbb516e20b96', 'edward.bacalso77@gmail.com', '09976093431', '2', '../upload/pngwing.com.png', 5, 1, 0),
(88, 'Lebron', 'B.', 'James', 'active', 'collector01', '5ec62e6b693a7024b8d6301ce6f4ca5725bb14cb', 'lebronjames@gmail.com', '09876543210', '3', '../upload/images (5).jpeg', 4, 1, 1),
(89, 'Kobe', 'D.', 'Bryant', 'active', 'collector02', '585c270dde7ccf556103042dac4032b89670f7ca', 'kobebryant@gmail.com', '09876543210', '3', '../upload/images (6).jpeg', 5, 1, 1),
(90, 'Jessica', 'M.', 'Soho', 'active', 'collector03', '2af76e1953ebc18bac4bfce1b43a15fca8b0b33d', 'jessicasoho@gmail.com', '09876543210', '3', '../upload/images (4).png', 6, 1, 0),
(91, 'Oggie', 'C.', 'Diaz', 'active', 'collector04', 'e3b8dd467af00209a8380c3c8367a75f52a7a4bf', 'oggiediaz@gmail.com', '09876543210', '3', '../upload/images (2).png', 7, 1, 1),
(92, 'Monkey', 'D.', 'Luffy', 'active', 'collector05', '766a4075c297a2a16c8ad1852cbbee8ea762bde8', 'monkeyluffy@gmail.com', '09876543210', '3', '../upload/images (2).png', 14, 1, 1),
(94, 'Jan Mervin', 'V.', 'Delos Santos', 'active', 'usermervin', '35dfc1bf2805e0c0ea2f98c0b135ad0cb7e62f02', 'janmervindelossantos@gmail.com', '09876543210', '2', '../upload/images (2).png', 3, 1, 0),
(95, 'Jeremie', 'P.', 'Aguilar', 'active', 'userjeremie', 'c00133e755ca6d453290c68e8eedbbdcc4a6605f', 'parba.jeremie@gmail.com', '09876543210', '2', '../upload/images (2).png', 4, 1, 0),
(96, 'Jhon Carlo', 'Q.', 'Roco', 'active', 'usercarlo', 'abf80cd500b15759476ea403bb8cce64afec9f16', 'jhoncarloroco@gmail.com', '09876543210', '2', '../upload/images (2).png', 5, 1, 0),
(97, 'Matt Justin', 'P.', 'Echavaria', 'active', 'userjustin', '3d70f45c33d80ea6a518c78e4a303d42493a1e14', 'mattjustinechavaria@gmail.com', '09876543210', '2', '../upload/images (2).png', 6, 1, 0),
(99, 'Ian Christopher', 'E.', 'Tatel', 'active', 'userchristopher', 'ec3d98a869637c72f75f3c269aef8523d1cfdbb1', 'ianchristopheratel@gmail.com', '09876543210', '2', '../upload/images (2).png', 14, 1, 0),
(100, 'Aaron', 'E.', 'Espetero', 'active', 'useraaron', '4293190203cb81a46cdac337a11d39ac98dfa43e', 'aaronespetero@gmail.com', '09876543210', '2', '../upload/images (2).png', 7, 1, 0),
(101, 'Rio', 'P', 'Liwanag', 'active', 'Rio1', 'a03dfa92173091eb522d9c65633644f05455d556', 'rioliwanag09@gmail.com', '09267381332', '2', '../upload/inbound7329698252719743262.jpg', 7, 1, 0),
(102, 'Matt', 'P', 'Echavaria', 'active', 'User1', 'd7316a3074d562269cf4302e4eed46369b523687', 'mstt@gmail.com', '09267381332', '2', '../upload/Screenshot_20231216-193149.jpg', 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baranggay`
--
ALTER TABLE `baranggay`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `form_stats`
--
ALTER TABLE `form_stats`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `municpality`
--
ALTER TABLE `municpality`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tblcitizencharter`
--
ALTER TABLE `tblcitizencharter`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `tbl_bulletin`
--
ALTER TABLE `tbl_bulletin`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `b_brgy_id` (`b_brgy_id`);

--
-- Indexes for table `tbl_bulletin_comment`
--
ALTER TABLE `tbl_bulletin_comment`
  ADD PRIMARY KEY (`bc_id`),
  ADD KEY `bc_bulletin_id` (`bc_bulletin_id`),
  ADD KEY `bc_comment_by` (`bc_comment_by`);

--
-- Indexes for table `tbl_bulletin_viewer`
--
ALTER TABLE `tbl_bulletin_viewer`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `v_b_id` (`v_b_id`),
  ADD KEY `v_user_id` (`v_user_id`);

--
-- Indexes for table `tbl_collection_completion_report`
--
ALTER TABLE `tbl_collection_completion_report`
  ADD PRIMARY KEY (`ccr_id`),
  ADD KEY `ccr_user_id` (`ccr_user_id`),
  ADD KEY `ccr_brgy` (`ccr_brgy`);

--
-- Indexes for table `tbl_collection_ratings`
--
ALTER TABLE `tbl_collection_ratings`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `tbl_collector_satisfactory_rating`
--
ALTER TABLE `tbl_collector_satisfactory_rating`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `rated_by` (`rated_by`,`collectors_id`),
  ADD KEY `collectors_id` (`collectors_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_user_id` (`report_user_id`),
  ADD KEY `tbl_report_ibfk_2` (`report_m_id`),
  ADD KEY `tbl_report_ibfk_3` (`report_b_id`),
  ADD KEY `r_brgy` (`r_brgy`);

--
-- Indexes for table `tbl_report_feedback`
--
ALTER TABLE `tbl_report_feedback`
  ADD PRIMARY KEY (`rf_id`),
  ADD KEY `rf_report_id` (`rf_report_id`);

--
-- Indexes for table `tbl_report_image`
--
ALTER TABLE `tbl_report_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `img_report_id` (`img_report_id`);

--
-- Indexes for table `tbl_report_status`
--
ALTER TABLE `tbl_report_status`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_report_id` (`s_report_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `r_user_id` (`r_user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `tbl_user_ibfk_1` (`user_m_id`),
  ADD KEY `tbl_user_ibfk_2` (`brgy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baranggay`
--
ALTER TABLE `baranggay`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `form_stats`
--
ALTER TABLE `form_stats`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `municpality`
--
ALTER TABLE `municpality`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblcitizencharter`
--
ALTER TABLE `tblcitizencharter`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bulletin`
--
ALTER TABLE `tbl_bulletin`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `tbl_bulletin_comment`
--
ALTER TABLE `tbl_bulletin_comment`
  MODIFY `bc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_bulletin_viewer`
--
ALTER TABLE `tbl_bulletin_viewer`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_collection_completion_report`
--
ALTER TABLE `tbl_collection_completion_report`
  MODIFY `ccr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_collection_ratings`
--
ALTER TABLE `tbl_collection_ratings`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_collector_satisfactory_rating`
--
ALTER TABLE `tbl_collector_satisfactory_rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_report_feedback`
--
ALTER TABLE `tbl_report_feedback`
  MODIFY `rf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_report_image`
--
ALTER TABLE `tbl_report_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_report_status`
--
ALTER TABLE `tbl_report_status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baranggay`
--
ALTER TABLE `baranggay`
  ADD CONSTRAINT `baranggay_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `municpality` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_bulletin`
--
ALTER TABLE `tbl_bulletin`
  ADD CONSTRAINT `tbl_bulletin_ibfk_1` FOREIGN KEY (`b_brgy_id`) REFERENCES `baranggay` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_bulletin_comment`
--
ALTER TABLE `tbl_bulletin_comment`
  ADD CONSTRAINT `tbl_bulletin_comment_ibfk_1` FOREIGN KEY (`bc_bulletin_id`) REFERENCES `tbl_bulletin` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bulletin_comment_ibfk_2` FOREIGN KEY (`bc_comment_by`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_bulletin_viewer`
--
ALTER TABLE `tbl_bulletin_viewer`
  ADD CONSTRAINT `tbl_bulletin_viewer_ibfk_1` FOREIGN KEY (`v_b_id`) REFERENCES `tbl_bulletin` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bulletin_viewer_ibfk_2` FOREIGN KEY (`v_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_collection_completion_report`
--
ALTER TABLE `tbl_collection_completion_report`
  ADD CONSTRAINT `tbl_collection_completion_report_ibfk_1` FOREIGN KEY (`ccr_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_collection_completion_report_ibfk_2` FOREIGN KEY (`ccr_brgy`) REFERENCES `baranggay` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_collector_satisfactory_rating`
--
ALTER TABLE `tbl_collector_satisfactory_rating`
  ADD CONSTRAINT `tbl_collector_satisfactory_rating_ibfk_1` FOREIGN KEY (`rated_by`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_collector_satisfactory_rating_ibfk_2` FOREIGN KEY (`collectors_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `tbl_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD CONSTRAINT `tbl_report_ibfk_1` FOREIGN KEY (`report_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_report_ibfk_2` FOREIGN KEY (`report_m_id`) REFERENCES `municpality` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_report_ibfk_3` FOREIGN KEY (`report_b_id`) REFERENCES `baranggay` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_report_image`
--
ALTER TABLE `tbl_report_image`
  ADD CONSTRAINT `tbl_report_image_ibfk_1` FOREIGN KEY (`img_report_id`) REFERENCES `tbl_report` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD CONSTRAINT `tbl_request_ibfk_1` FOREIGN KEY (`r_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`user_m_id`) REFERENCES `municpality` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_ibfk_2` FOREIGN KEY (`brgy`) REFERENCES `baranggay` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
