-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2020 at 11:38 AM
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
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_values_backup`
--

CREATE TABLE `grade_values_backup` (
  `GradeValID` int(11) NOT NULL,
  `LRNNum` bigint(12) NOT NULL,
  `GradeValLevel` int(11) NOT NULL,
  `BehaviorID` varchar(50) NOT NULL,
  `Quarter` int(11) NOT NULL,
  `GradeValRating` varchar(50) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_values_backup`
--

INSERT INTO `grade_values_backup` (`GradeValID`, `LRNNum`, `GradeValLevel`, `BehaviorID`, `Quarter`, `GradeValRating`, `DateCreated`, `Action`) VALUES
(1, 111111111111, 8, '1a', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(3, 111111111111, 8, '3a', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(7, 111111111111, 8, '4a', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(6, 111111111111, 8, '3b', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(2, 111111111111, 8, '2a', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(4, 111111111111, 8, '1b', 4, 'AO', '2020-03-04 04:23:58', 'CREATED'),
(5, 111111111111, 8, '2b', 4, 'AO', '2020-03-04 04:23:58', 'CREATED');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
