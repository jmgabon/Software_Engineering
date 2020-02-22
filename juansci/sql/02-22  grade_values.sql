-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 11:40 AM
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
-- Table structure for table `grade_values`
--

CREATE TABLE `grade_values` (
  `GradeValID` int(11) NOT NULL,
  `LRNNum` bigint(12) NOT NULL,
  `GradeValLevel` int(11) NOT NULL,
  `BehaviorID` varchar(50) NOT NULL,
  `Quarter` int(11) NOT NULL,
  `GradeValRating` varchar(50) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `grade_values`
--
DELIMITER $$
CREATE TRIGGER `AFTER INSERT grade_values` AFTER INSERT ON `grade_values` FOR EACH ROW INSERT INTO grade_values_backup
SELECT *, "CREATED"
FROM grade_values
WHERE GradeValID = new.GradeValID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER UPDATE grade_values` AFTER UPDATE ON `grade_values` FOR EACH ROW INSERT INTO grade_values_backup
SELECT *, "UPDATED"
FROM grade_values
WHERE GradeValID = new.GradeValID
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_values`
--
ALTER TABLE `grade_values`
  ADD PRIMARY KEY (`GradeValID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_values`
--
ALTER TABLE `grade_values`
  MODIFY `GradeValID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
