-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2020 at 06:00 AM
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
-- Table structure for table `grade_values`
--

CREATE TABLE `grade_values` (
  `GradeID` int(11) NOT NULL,
  `LRNNum` bigint(12) NOT NULL,
  `TeacherNum` int(11) NOT NULL,
  `GradeLevel` int(11) NOT NULL,
  `BehaviorCode` varchar(50) NOT NULL,
  `Quarter` int(11) NOT NULL,
  `GradeRating` varchar(50) DEFAULT NULL,
  `Status` varchar(20) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_values`
--

INSERT INTO `grade_values` (`GradeID`, `LRNNum`, `TeacherNum`, `GradeLevel`, `BehaviorCode`, `Quarter`, `GradeRating`, `Status`, `DateCreated`) VALUES
(1, 111111111111, 17, 8, 'A1', 1, 'AO', 'PENDING', '2020-03-19 04:51:11'),
(2, 111111111111, 17, 8, 'C1', 1, 'AO', 'PENDING', '2020-03-19 04:51:11'),
(3, 111111111111, 17, 8, 'A2', 1, 'SO', 'PENDING', '2020-03-19 04:52:45'),
(4, 111111111111, 17, 8, 'B1', 1, 'RO', 'PENDING', '2020-03-19 04:52:45'),
(5, 111111111111, 17, 8, 'C2', 1, 'SO', 'PENDING', '2020-03-19 04:52:45'),
(6, 111111111111, 17, 8, 'B2', 1, 'NO', 'PENDING', '2020-03-19 04:52:45'),
(7, 111111111111, 17, 8, 'D1', 1, 'RO', 'PENDING', '2020-03-19 04:52:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_values`
--
ALTER TABLE `grade_values`
  ADD PRIMARY KEY (`GradeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_values`
--
ALTER TABLE `grade_values`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
