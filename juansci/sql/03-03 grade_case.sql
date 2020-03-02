-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 07:31 PM
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
-- Table structure for table `grade_case`
--

CREATE TABLE `grade_case` (
  `EmployeeNum` int(11) NOT NULL,
  `SubjectCode` varchar(255) NOT NULL,
  `CaseValue` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_case`
--

INSERT INTO `grade_case` (`EmployeeNum`, `SubjectCode`, `CaseValue`) VALUES
(1, 'AP 7', 1),
(13, 'ENG 7 ', 1),
(4, 'ESP 7', 1),
(1, 'FIL 7', 6),
(4, 'MATH 7B', 1),
(23, 'RESEARCH 7', 1),
(4, 'TLE 7', 1),
(4, 'RESEARCH 7', 1),
(13, 'ESP 8', 1),
(23, 'RESEARCH 8', 1),
(29, 'AP 10', 4),
(29, 'ENG 10', 4),
(1, 'SCI 10B', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_case`
--
ALTER TABLE `grade_case`
  ADD KEY `EmployeeNum` (`EmployeeNum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
