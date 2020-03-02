-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 07:32 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sjshs`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_subject`
--

CREATE TABLE `grade_subject` (
  `GradeID` int(11) NOT NULL,
  `LRNNum` bigint(12) NOT NULL,
  `GradeLevel` int(11) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `Quarter` int(11) NOT NULL,
  `GradeRating` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_subject`
--

INSERT INTO `grade_subject` (`GradeID`, `LRNNum`, `GradeLevel`, `SubjectCode`, `Quarter`, `GradeRating`, `Status`, `DateCreated`) VALUES
(1, 111111111111, 7, 'AP 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(2, 111111111111, 7, 'AP 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(3, 111111111111, 7, 'AP 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(4, 111111111111, 7, 'AP 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(5, 111111111111, 7, 'ENG 7 ', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(6, 111111111111, 7, 'ENG 7 ', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(7, 111111111111, 7, 'ENG 7 ', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(8, 111111111111, 7, 'ENG 7 ', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(9, 111111111111, 7, 'ESP 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(10, 111111111111, 7, 'ESP 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(11, 111111111111, 7, 'ESP 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(12, 111111111111, 7, 'ESP 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(13, 111111111111, 7, 'FIL 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(14, 111111111111, 7, 'FIL 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(15, 111111111111, 7, 'FIL 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(16, 111111111111, 7, 'FIL 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(17, 111111111111, 7, 'MUSIC 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(18, 111111111111, 7, 'MUSIC 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(19, 111111111111, 7, 'MUSIC 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(20, 111111111111, 7, 'MUSIC 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(21, 111111111111, 7, 'ARTS 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(22, 111111111111, 7, 'ARTS 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(23, 111111111111, 7, 'ARTS 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(24, 111111111111, 7, 'ARTS 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(25, 111111111111, 7, 'PE 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(26, 111111111111, 7, 'PE 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(27, 111111111111, 7, 'PE 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(28, 111111111111, 7, 'PE 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(29, 111111111111, 7, 'HEALTH 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(30, 111111111111, 7, 'HEALTH 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(31, 111111111111, 7, 'HEALTH 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(32, 111111111111, 7, 'HEALTH 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(33, 111111111111, 7, 'MATH 7A', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(34, 111111111111, 7, 'MATH 7A', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(35, 111111111111, 7, 'MATH 7A', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(36, 111111111111, 7, 'MATH 7A', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(37, 111111111111, 7, 'MATH 7B', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(38, 111111111111, 7, 'MATH 7B', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(39, 111111111111, 7, 'MATH 7B', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(40, 111111111111, 7, 'MATH 7B', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(41, 111111111111, 7, 'RESEARCH 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(42, 111111111111, 7, 'RESEARCH 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(43, 111111111111, 7, 'RESEARCH 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(44, 111111111111, 7, 'RESEARCH 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(45, 111111111111, 7, 'SCI 7A', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(46, 111111111111, 7, 'SCI 7A', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(47, 111111111111, 7, 'SCI 7A', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(48, 111111111111, 7, 'SCI 7A', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(49, 111111111111, 7, 'SCI 7B', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(50, 111111111111, 7, 'SCI 7B', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(51, 111111111111, 7, 'SCI 7B', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(52, 111111111111, 7, 'SCI 7B', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(53, 111111111111, 7, 'TLE 7', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(54, 111111111111, 7, 'TLE 7', 2, 85, 'APPROVED', '2020-03-02 18:19:24'),
(55, 111111111111, 7, 'TLE 7', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(56, 111111111111, 7, 'TLE 7', 4, 85, 'APPROVED', '2020-03-02 18:19:24'),
(57, 111111111111, 8, 'AP 8', 1, 88, 'APPROVED', '2020-03-02 18:19:24'),
(58, 111111111111, 8, 'AP 8', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(59, 111111111111, 8, 'AP 8', 3, 91, 'APPROVED', '2020-03-02 18:19:24'),
(60, 111111111111, 8, 'AP 8', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(61, 111111111111, 8, 'ENG 8', 1, 86, 'APPROVED', '2020-03-02 18:19:24'),
(62, 111111111111, 8, 'ENG 8', 2, 86, 'APPROVED', '2020-03-02 18:19:24'),
(63, 111111111111, 8, 'ENG 8', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(64, 111111111111, 8, 'ENG 8', 4, 92, 'APPROVED', '2020-03-02 18:19:24'),
(65, 111111111111, 8, 'ESP 8', 1, 96, 'APPROVED', '2020-03-02 18:19:24'),
(66, 111111111111, 8, 'ESP 8', 2, 92, 'APPROVED', '2020-03-02 18:19:24'),
(67, 111111111111, 8, 'ESP 8', 3, 96, 'APPROVED', '2020-03-02 18:19:24'),
(68, 111111111111, 8, 'ESP 8', 4, 93, 'APPROVED', '2020-03-02 18:19:24'),
(69, 111111111111, 8, 'FIL 8', 1, 86, 'APPROVED', '2020-03-02 18:19:24'),
(70, 111111111111, 8, 'FIL 8', 2, 86, 'APPROVED', '2020-03-02 18:19:24'),
(71, 111111111111, 8, 'FIL 8', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(72, 111111111111, 8, 'FIL 8', 4, 92, 'APPROVED', '2020-03-02 18:19:24'),
(73, 111111111111, 8, 'MUSIC 8', 1, 87, 'APPROVED', '2020-03-02 18:19:24'),
(74, 111111111111, 8, 'MUSIC 8', 2, 87, 'APPROVED', '2020-03-02 18:19:24'),
(75, 111111111111, 8, 'MUSIC 8', 3, 89, 'APPROVED', '2020-03-02 18:19:24'),
(76, 111111111111, 8, 'MUSIC 8', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(77, 111111111111, 8, 'ARTS 8', 1, 85, 'APPROVED', '2020-03-02 18:19:24'),
(78, 111111111111, 8, 'ARTS 8', 2, 91, 'APPROVED', '2020-03-02 18:19:24'),
(79, 111111111111, 8, 'ARTS 8', 3, 91, 'APPROVED', '2020-03-02 18:19:24'),
(80, 111111111111, 8, 'ARTS 8', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(81, 111111111111, 8, 'PE 8', 1, 83, 'APPROVED', '2020-03-02 18:19:24'),
(82, 111111111111, 8, 'PE 8', 2, 89, 'APPROVED', '2020-03-02 18:19:24'),
(83, 111111111111, 8, 'PE 8', 3, 91, 'APPROVED', '2020-03-02 18:19:24'),
(84, 111111111111, 8, 'PE 8', 4, 93, 'APPROVED', '2020-03-02 18:19:24'),
(85, 111111111111, 8, 'HEALTH 8', 1, 84, 'APPROVED', '2020-03-02 18:19:24'),
(86, 111111111111, 8, 'HEALTH 8', 2, 88, 'APPROVED', '2020-03-02 18:19:24'),
(87, 111111111111, 8, 'HEALTH 8', 3, 89, 'APPROVED', '2020-03-02 18:19:24'),
(88, 111111111111, 8, 'HEALTH 8', 4, 92, 'APPROVED', '2020-03-02 18:19:24'),
(89, 111111111111, 8, 'MATH 8A', 1, 80, 'APPROVED', '2020-03-02 18:19:24'),
(90, 111111111111, 8, 'MATH 8A', 2, 80, 'APPROVED', '2020-03-02 18:19:24'),
(91, 111111111111, 8, 'MATH 8A', 3, 87, 'APPROVED', '2020-03-02 18:19:24'),
(92, 111111111111, 8, 'MATH 8A', 4, 86, 'APPROVED', '2020-03-02 18:19:24'),
(93, 111111111111, 8, 'MATH 8B', 1, 87, 'APPROVED', '2020-03-02 18:19:24'),
(94, 111111111111, 8, 'MATH 8B', 2, 86, 'APPROVED', '2020-03-02 18:19:24'),
(95, 111111111111, 8, 'MATH 8B', 3, 83, 'APPROVED', '2020-03-02 18:19:24'),
(96, 111111111111, 8, 'MATH 8B', 4, 86, 'APPROVED', '2020-03-02 18:19:24'),
(97, 111111111111, 8, 'SCI 8A', 1, 83, 'APPROVED', '2020-03-02 18:19:24'),
(98, 111111111111, 8, 'SCI 8A', 2, 86, 'APPROVED', '2020-03-02 18:19:24'),
(99, 111111111111, 8, 'SCI 8A', 3, 86, 'APPROVED', '2020-03-02 18:19:24'),
(100, 111111111111, 8, 'SCI 8A', 4, 89, 'APPROVED', '2020-03-02 18:19:24'),
(101, 111111111111, 8, 'RESEARCH 8', 1, 88, 'APPROVED', '2020-03-02 18:19:24'),
(102, 111111111111, 8, 'RESEARCH 8', 2, 88, 'APPROVED', '2020-03-02 18:19:24'),
(103, 111111111111, 8, 'RESEARCH 8', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(104, 111111111111, 8, 'RESEARCH 8', 4, 96, 'APPROVED', '2020-03-02 18:19:24'),
(105, 111111111111, 8, 'SCI 8B', 1, 83, 'APPROVED', '2020-03-02 18:19:24'),
(106, 111111111111, 8, 'SCI 8B', 2, 88, 'APPROVED', '2020-03-02 18:19:24'),
(107, 111111111111, 8, 'SCI 8B', 3, 85, 'APPROVED', '2020-03-02 18:19:24'),
(108, 111111111111, 8, 'SCI 8B', 4, 89, 'APPROVED', '2020-03-02 18:19:24'),
(110, 111111111111, 8, 'TLE 8', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(111, 111111111111, 8, 'TLE 8', 3, 91, 'APPROVED', '2020-03-02 18:19:24'),
(112, 111111111111, 8, 'TLE 8', 4, 92, 'APPROVED', '2020-03-02 18:19:24'),
(113, 111111111111, 8, 'TLE 8', 1, 87, 'APPROVED', '2020-03-02 18:19:24'),
(114, 111111111111, 9, 'AP 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(115, 111111111111, 9, 'AP 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(116, 111111111111, 9, 'AP 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(117, 111111111111, 9, 'AP 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(118, 111111111111, 9, 'ENG 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(119, 111111111111, 9, 'ENG 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(120, 111111111111, 9, 'ENG 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(121, 111111111111, 9, 'ENG 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(122, 111111111111, 9, 'ESP 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(123, 111111111111, 9, 'ESP 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(124, 111111111111, 9, 'ESP 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(125, 111111111111, 9, 'ESP 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(126, 111111111111, 9, 'FIL 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(127, 111111111111, 9, 'FIL 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(128, 111111111111, 9, 'FIL 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(129, 111111111111, 9, 'FIL 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(130, 111111111111, 9, 'FOLA 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(131, 111111111111, 9, 'FOLA 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(132, 111111111111, 9, 'FOLA 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(133, 111111111111, 9, 'FOLA 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(134, 111111111111, 9, 'MUSIC 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(135, 111111111111, 9, 'MUSIC 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(136, 111111111111, 9, 'MUSIC 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(137, 111111111111, 9, 'MUSIC 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(138, 111111111111, 9, 'ARTS 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(139, 111111111111, 9, 'ARTS 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(140, 111111111111, 9, 'ARTS 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(141, 111111111111, 9, 'ARTS 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(142, 111111111111, 9, 'PE 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(143, 111111111111, 9, 'PE 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(144, 111111111111, 9, 'PE 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(145, 111111111111, 9, 'PE 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(146, 111111111111, 9, 'HEALTH 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(147, 111111111111, 9, 'HEALTH 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(148, 111111111111, 9, 'HEALTH 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(149, 111111111111, 9, 'HEALTH 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(150, 111111111111, 9, 'MATH 9A', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(151, 111111111111, 9, 'MATH 9A', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(152, 111111111111, 9, 'MATH 9A', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(153, 111111111111, 9, 'MATH 9A', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(154, 111111111111, 9, 'MATH 9B', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(155, 111111111111, 9, 'MATH 9B', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(156, 111111111111, 9, 'MATH 9B', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(157, 111111111111, 9, 'MATH 9B', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(158, 111111111111, 9, 'SCI 9A', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(159, 111111111111, 9, 'SCI 9A', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(160, 111111111111, 9, 'SCI 9A', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(161, 111111111111, 9, 'SCI 9A', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(162, 111111111111, 9, 'SCI 9B', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(163, 111111111111, 9, 'SCI 9B', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(164, 111111111111, 9, 'SCI 9B', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(165, 111111111111, 9, 'SCI 9B', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(166, 111111111111, 9, 'TLE 9', 1, 90, 'APPROVED', '2020-03-02 18:19:24'),
(167, 111111111111, 9, 'TLE 9', 2, 90, 'APPROVED', '2020-03-02 18:19:24'),
(168, 111111111111, 9, 'TLE 9', 3, 90, 'APPROVED', '2020-03-02 18:19:24'),
(169, 111111111111, 9, 'TLE 9', 4, 90, 'APPROVED', '2020-03-02 18:19:24'),
(170, 111111111111, 10, 'AP 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(171, 111111111111, 10, 'AP 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(172, 111111111111, 10, 'AP 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(173, 111111111111, 10, 'AP 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(174, 111111111111, 10, 'ENG 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(175, 111111111111, 10, 'ENG 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(176, 111111111111, 10, 'ENG 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(177, 111111111111, 10, 'ENG 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(178, 111111111111, 10, 'ESP 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(179, 111111111111, 10, 'ESP 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(180, 111111111111, 10, 'ESP 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(181, 111111111111, 10, 'ESP 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(182, 111111111111, 10, 'FIL 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(183, 111111111111, 10, 'FIL 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(184, 111111111111, 10, 'FIL 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(185, 111111111111, 10, 'FIL 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(186, 111111111111, 10, 'FOLA 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(187, 111111111111, 10, 'FOLA 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(188, 111111111111, 10, 'FOLA 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(189, 111111111111, 10, 'FOLA 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(190, 111111111111, 10, 'MUSIC 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(191, 111111111111, 10, 'MUSIC 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(192, 111111111111, 10, 'MUSIC 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(193, 111111111111, 10, 'MUSIC 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(194, 111111111111, 10, 'ARTS 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(195, 111111111111, 10, 'ARTS 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(196, 111111111111, 10, 'ARTS 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(197, 111111111111, 10, 'ARTS 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(198, 111111111111, 10, 'PE 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(199, 111111111111, 10, 'PE 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(200, 111111111111, 10, 'PE 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(201, 111111111111, 10, 'PE 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(202, 111111111111, 10, 'HEALTH 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(203, 111111111111, 10, 'HEALTH 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(204, 111111111111, 10, 'HEALTH 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(205, 111111111111, 10, 'HEALTH 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(206, 111111111111, 10, 'MATH 10A', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(207, 111111111111, 10, 'MATH 10A', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(208, 111111111111, 10, 'MATH 10A', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(209, 111111111111, 10, 'MATH 10A', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(210, 111111111111, 10, 'MATH 10B', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(211, 111111111111, 10, 'MATH 10B', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(212, 111111111111, 10, 'MATH 10B', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(213, 111111111111, 10, 'MATH 10B', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(214, 111111111111, 10, 'SCI 10A', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(215, 111111111111, 10, 'SCI 10A', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(216, 111111111111, 10, 'SCI 10A', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(217, 111111111111, 10, 'SCI 10A', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(218, 111111111111, 10, 'SCI 10B', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(219, 111111111111, 10, 'SCI 10B', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(220, 111111111111, 10, 'SCI 10B', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(221, 111111111111, 10, 'SCI 10B', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(222, 111111111111, 10, 'TLE 10', 1, 95, 'APPROVED', '2020-03-02 18:19:24'),
(223, 111111111111, 10, 'TLE 10', 2, 95, 'APPROVED', '2020-03-02 18:19:24'),
(224, 111111111111, 10, 'TLE 10', 3, 95, 'APPROVED', '2020-03-02 18:19:24'),
(225, 111111111111, 10, 'TLE 10', 4, 95, 'APPROVED', '2020-03-02 18:19:24'),
(226, 394328483211, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(227, 123456789123, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(228, 199494113333, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(229, 472429112122, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(230, 567890321425, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(231, 155366694777, 7, 'AP 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(232, 567890321425, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(233, 155366694777, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(234, 123456789123, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(235, 472429112122, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(236, 199494113333, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29'),
(237, 394328483211, 7, 'FIL 7', 4, 80, 'PENDING', '2020-03-02 17:08:29');

--
-- Triggers `grade_subject`
--
DELIMITER $$
CREATE TRIGGER `AFTER INSERT grade_subject` AFTER INSERT ON `grade_subject` FOR EACH ROW INSERT INTO grade_subject_backup
SELECT *, "CREATED"
FROM grade_subject
WHERE GradeID = new.GradeID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER UPDATE grade_subject` AFTER UPDATE ON `grade_subject` FOR EACH ROW INSERT INTO grade_subject_backup
SELECT *, "UPDATED"
FROM grade_subject
WHERE GradeID = new.GradeID
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_subject`
--
ALTER TABLE `grade_subject`
  ADD PRIMARY KEY (`GradeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_subject`
--
ALTER TABLE `grade_subject`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
