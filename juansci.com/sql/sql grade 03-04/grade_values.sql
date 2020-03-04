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
-- Dumping data for table `grade_values`
--

INSERT INTO `grade_values` (`GradeValID`, `LRNNum`, `GradeValLevel`, `BehaviorID`, `Quarter`, `GradeValRating`, `DateCreated`) VALUES
(1, 111111111111, 8, '1a', 4, 'AO', '2020-03-04 04:23:58'),
(2, 111111111111, 8, '2a', 4, 'AO', '2020-03-04 04:23:58'),
(3, 111111111111, 8, '3a', 4, 'AO', '2020-03-04 04:23:58'),
(4, 111111111111, 8, '1b', 4, 'AO', '2020-03-04 04:23:58'),
(5, 111111111111, 8, '2b', 4, 'AO', '2020-03-04 04:23:58'),
(6, 111111111111, 8, '3b', 4, 'AO', '2020-03-04 04:23:58'),
(7, 111111111111, 8, '4a', 4, 'AO', '2020-03-04 04:23:58');

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
  MODIFY `GradeValID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
