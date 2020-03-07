-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2020 at 05:52 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

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
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `TeacherNum` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `AccessType` varchar(255) NOT NULL,
  `Access` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`TeacherNum`, `Username`, `Pass`, `AccessType`, `Access`) VALUES
(1, 'admin', '=KÉßzùÕ#ZI', 'principal', 1),
(2, '2-Apurada', '=KÉßzùÕ#ZI', 'coordinator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `main_teacherregistration`
--

CREATE TABLE `main_teacherregistration` (
  `TeacherNum` int(11) NOT NULL,
  `Shift` varchar(2) NOT NULL,
  `Major` varchar(10) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ExtendedName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Gender` varchar(6) NOT NULL,
  `Birthday` date NOT NULL,
  `BirthPlace` varchar(255) NOT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `CellphoneNum` varchar(13) DEFAULT NULL,
  `LandlineNum` varchar(20) DEFAULT NULL,
  `URL_Picture` varchar(255) NOT NULL,
  `Present_StreetAdd` varchar(100) DEFAULT NULL,
  `Present_City` varchar(40) NOT NULL,
  `Present_Province` varchar(40) NOT NULL,
  `Present_Country` varchar(40) NOT NULL,
  `Permanent_StreetAdd` varchar(100) DEFAULT NULL,
  `Permanent_City` varchar(40) NOT NULL,
  `Permanent_Province` varchar(40) NOT NULL,
  `Permanent_Country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_teacherregistration`
--

INSERT INTO `main_teacherregistration` (`TeacherNum`, `Shift`, `Major`, `LastName`, `ExtendedName`, `FirstName`, `MiddleName`, `Gender`, `Birthday`, `BirthPlace`, `Email`, `CellphoneNum`, `LandlineNum`, `URL_Picture`, `Present_StreetAdd`, `Present_City`, `Present_Province`, `Present_Country`, `Permanent_StreetAdd`, `Permanent_City`, `Permanent_Province`, `Permanent_Country`) VALUES
(2, 'AM', 'AP', 'Apurada', NULL, 'Hernan', NULL, 'Male', '1990-11-21', 'San Juan City', NULL, NULL, NULL, 'avatar5.png', NULL, 'San Juan City', 'Metro Manila', 'Phillipines', NULL, 'San Juan City', 'Metro Manila', 'Phillipines');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ControlNum` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `ApprovalDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `summary_roomcreation`
-- (See below for the actual view)
--
CREATE TABLE `summary_roomcreation` (
`ControlNum` int(11)
,`RoomNum` int(11)
,`RoomName` varchar(50)
,`Building` varchar(50)
,`Floor` int(2)
,`Type` varchar(10)
,`DateCreated` timestamp
,`CreatedBy` int(11)
,`Action_` varchar(10)
,`Status_` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `summary_studentregistration`
-- (See below for the actual view)
--
CREATE TABLE `summary_studentregistration` (
`ControlNum` int(11)
,`LRNNum` bigint(12)
,`LastName` varchar(50)
,`FirstName` varchar(50)
,`MiddleName` varchar(50)
,`Type` varchar(10)
,`URL_Picture` varchar(255)
,`DateCreated` timestamp
,`Action_` varchar(10)
,`Status_` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `summary_subjectcodecreation`
-- (See below for the actual view)
--
CREATE TABLE `summary_subjectcodecreation` (
`ControlNum` int(11)
,`SubjectCode` varchar(20)
,`SubjectDescription` varchar(255)
,`GradeLevel` int(2)
,`Frequency` int(1)
,`DateCreated` timestamp
,`CreatedBy` int(11)
,`Action_` varchar(10)
,`Status_` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `summary_teacherregistration`
-- (See below for the actual view)
--
CREATE TABLE `summary_teacherregistration` (
`ControlNum` int(11)
,`TeacherNum` int(11)
,`LastName` varchar(50)
,`FirstName` varchar(50)
,`MiddleName` varchar(50)
,`URL_Picture` varchar(255)
,`DateCreated` timestamp
,`Action_` varchar(10)
,`Status_` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `temp_roomcreation`
--

CREATE TABLE `temp_roomcreation` (
  `ControlNum` int(11) NOT NULL,
  `RoomNum` int(11) NOT NULL,
  `RoomName` varchar(50) DEFAULT NULL,
  `Building` varchar(50) DEFAULT NULL,
  `Floor` int(2) DEFAULT NULL,
  `Type` varchar(10) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL,
  `Action_` varchar(10) NOT NULL,
  `Status_` varchar(20) NOT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_roomcreation`
--

INSERT INTO `temp_roomcreation` (`ControlNum`, `RoomNum`, `RoomName`, `Building`, `Floor`, `Type`, `DateCreated`, `CreatedBy`, `Action_`, `Status_`, `ApprovedBy`, `ApprovalDate`, `Remarks`) VALUES
(1, 101, '101', 'ITC', 1, 'Classroom', '2020-03-01 14:26:51', 2, 'INSERT', 'PENDING', NULL, NULL, NULL),
(2, 102, '102', 'ITC', 1, 'Classroom', '2020-03-01 14:31:31', 2, 'INSERT', 'PENDING', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_studentregistration`
--

CREATE TABLE `temp_studentregistration` (
  `ControlNum` int(11) NOT NULL,
  `LRNNum` bigint(12) NOT NULL,
  `GradeLevel` int(2) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ExtendedName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Gender` varchar(6) NOT NULL,
  `Birthday` date NOT NULL,
  `BirthPlace` varchar(255) NOT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `CellphoneNum` varchar(13) DEFAULT NULL,
  `LandlineNum` varchar(20) DEFAULT NULL,
  `URL_Picture` varchar(255) NOT NULL,
  `Present_StreetAdd` varchar(100) DEFAULT NULL,
  `Present_City` varchar(40) NOT NULL,
  `Present_Province` varchar(40) NOT NULL,
  `Present_Country` varchar(40) NOT NULL,
  `Permanent_StreetAdd` varchar(100) DEFAULT NULL,
  `Permanent_City` varchar(40) NOT NULL,
  `Permanent_Province` varchar(40) NOT NULL,
  `Permanent_Country` varchar(40) NOT NULL,
  `Present_SchoolName` varchar(100) NOT NULL,
  `Present_SchoolAddress` varchar(255) DEFAULT NULL,
  `Present_SchoolContact` varchar(20) DEFAULT NULL,
  `MotherName` varchar(150) DEFAULT NULL,
  `MotherContact` varchar(20) DEFAULT NULL,
  `MotherEducation` varchar(50) DEFAULT NULL,
  `MotherOccupation` varchar(100) DEFAULT NULL,
  `FatherName` varchar(150) DEFAULT NULL,
  `FatherContact` varchar(20) DEFAULT NULL,
  `FatherEducation` varchar(50) DEFAULT NULL,
  `FatherOccupation` varchar(100) DEFAULT NULL,
  `GuardianName` varchar(150) DEFAULT NULL,
  `GuardianContact` varchar(20) DEFAULT NULL,
  `GuardianRelationship` varchar(50) DEFAULT NULL,
  `GuardianOccupation` varchar(100) DEFAULT NULL,
  `FirstReq` tinyint(1) NOT NULL,
  `SecondReq` tinyint(1) NOT NULL,
  `ThirdReq` tinyint(1) NOT NULL,
  `FourthReq` tinyint(1) NOT NULL,
  `FifthReq1` tinyint(1) NOT NULL,
  `FifthReq2` tinyint(1) NOT NULL,
  `FifthReq3` tinyint(1) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `Action_` varchar(10) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status_` varchar(20) NOT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_studentregistration`
--

INSERT INTO `temp_studentregistration` (`ControlNum`, `LRNNum`, `GradeLevel`, `Type`, `LastName`, `ExtendedName`, `FirstName`, `MiddleName`, `Gender`, `Birthday`, `BirthPlace`, `Email`, `CellphoneNum`, `LandlineNum`, `URL_Picture`, `Present_StreetAdd`, `Present_City`, `Present_Province`, `Present_Country`, `Permanent_StreetAdd`, `Permanent_City`, `Permanent_Province`, `Permanent_Country`, `Present_SchoolName`, `Present_SchoolAddress`, `Present_SchoolContact`, `MotherName`, `MotherContact`, `MotherEducation`, `MotherOccupation`, `FatherName`, `FatherContact`, `FatherEducation`, `FatherOccupation`, `GuardianName`, `GuardianContact`, `GuardianRelationship`, `GuardianOccupation`, `FirstReq`, `SecondReq`, `ThirdReq`, `FourthReq`, `FifthReq1`, `FifthReq2`, `FifthReq3`, `CreatedBy`, `Action_`, `DateCreated`, `Status_`, `ApprovedBy`, `ApprovalDate`, `Remarks`) VALUES
(1, 131324243535, 7, 'New', 'Gabon', 'Jr.', 'Jose Mari', 'Manuel', 'Male', '2008-03-28', 'Pasig City', 'gabonjosemari@gmail.com', '09182004644', '7251221', '430082_541686969183789_1029801639_n.jpg', '#4803 V. Baltazar, Pinagbuhatan', 'Pasig', 'Metro Manila', 'Philippines', '#4803 V. Baltazar, Pinagbuhatan', 'Pasig', 'Metro Manila', 'Philippines', 'La Immaculada Concepcion School', 'E. Caruncho Ave., Brgy. Malinao, Pasig City', '9002594', 'Mary Ann M. Gabon', '9002594', NULL, 'Housewife', 'Ernesto B. Gabon', '9002594', NULL, 'Crane Operator', 'Maritha M. Lirazan', '9002594', NULL, 'Housewife', 1, 1, 1, 1, 0, 0, 1, 2, 'INSERT', '2020-03-01 06:23:34', 'PENDING', NULL, NULL, ''),
(3, 123412341234, 7, 'New', 'Daguio ', NULL, 'Anndrew', 'Gorostiza', 'Female', '2009-03-12', 'Mandaluyong City', 'Andrea@brilliant', '09197518220', '87001', '430082_541686969183789_1029801639_n.jpg', NULL, 'Mandaluyong', 'Metro Manila', 'Portugal', NULL, 'Mandaluyong', 'Metro Manila', 'Portugal', 'Greenhills Elementary School', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Direk Bobby Gutierez', NULL, 'uncle', 'Director', 1, 1, 1, 1, 0, 0, 1, 2, 'INSERT', '2020-03-01 06:23:36', 'PENDING', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `temp_subjectcodecreation`
--

CREATE TABLE `temp_subjectcodecreation` (
  `ControlNum` int(11) NOT NULL,
  `SubjectCode` varchar(20) NOT NULL,
  `SubjectDescription` varchar(255) NOT NULL,
  `GradeLevel` int(2) NOT NULL,
  `Frequency` int(1) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL,
  `Action_` varchar(10) NOT NULL,
  `Status_` varchar(20) NOT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_subjectcodecreation`
--

INSERT INTO `temp_subjectcodecreation` (`ControlNum`, `SubjectCode`, `SubjectDescription`, `GradeLevel`, `Frequency`, `DateCreated`, `CreatedBy`, `Action_`, `Status_`, `ApprovedBy`, `ApprovalDate`, `Remarks`) VALUES
(2, 'AP 7', 'Araling Panlipunan 7', 7, 3, '2020-03-01 16:16:02', 2, 'INSERT', 'PENDING', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_teacherregistration`
--

CREATE TABLE `temp_teacherregistration` (
  `ControlNum` int(11) NOT NULL,
  `TeacherNum` int(11) DEFAULT NULL,
  `Shift` varchar(2) NOT NULL,
  `Major` varchar(10) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ExtendedName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) DEFAULT NULL,
  `Gender` varchar(6) NOT NULL,
  `Birthday` date NOT NULL,
  `BirthPlace` varchar(255) NOT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `CellphoneNum` varchar(13) DEFAULT NULL,
  `LandlineNum` varchar(20) DEFAULT NULL,
  `URL_Picture` varchar(255) NOT NULL,
  `Present_StreetAdd` varchar(100) DEFAULT NULL,
  `Present_City` varchar(40) NOT NULL,
  `Present_Province` varchar(40) NOT NULL,
  `Present_Country` varchar(40) NOT NULL,
  `Permanent_StreetAdd` varchar(100) DEFAULT NULL,
  `Permanent_City` varchar(40) NOT NULL,
  `Permanent_Province` varchar(40) NOT NULL,
  `Permanent_Country` varchar(40) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `Action_` varchar(10) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status_` varchar(20) NOT NULL,
  `ApprovedBy` int(11) DEFAULT NULL,
  `ApprovalDate` datetime DEFAULT NULL,
  `Remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_teacherregistration`
--

INSERT INTO `temp_teacherregistration` (`ControlNum`, `TeacherNum`, `Shift`, `Major`, `LastName`, `ExtendedName`, `FirstName`, `MiddleName`, `Gender`, `Birthday`, `BirthPlace`, `Email`, `CellphoneNum`, `LandlineNum`, `URL_Picture`, `Present_StreetAdd`, `Present_City`, `Present_Province`, `Present_Country`, `Permanent_StreetAdd`, `Permanent_City`, `Permanent_Province`, `Permanent_Country`, `CreatedBy`, `Action_`, `DateCreated`, `Status_`, `ApprovedBy`, `ApprovalDate`, `Remarks`) VALUES
(2, NULL, 'AM', 'AP', 'Apurada', NULL, 'Hernan', NULL, 'Male', '1990-11-21', 'San Juan City', NULL, NULL, NULL, 'avatar5.png', NULL, 'San Juan City', 'Metro Manila', 'Phillipines', NULL, 'San Juan City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 09:19:45', 'APPROVED', 1, '2020-02-19 00:00:00', NULL),
(3, NULL, 'AM', 'AP', 'Gabon', NULL, 'Jose Mari', 'Manuel', 'Male', '1997-03-28', 'Pasig City', 'gabonjosemari@gmail.com', NULL, '9002594', '46280_541687292517090_621937474_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:27:42', 'PENDING', NULL, NULL, ''),
(4, NULL, 'AM', 'AP', 'Gabon', NULL, 'Carlos Miguel', 'Manuel', 'Male', '1999-01-22', 'Pasig City', NULL, NULL, NULL, '407093_355692657777994_1875201973_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:31:26', 'PENDING', NULL, NULL, ''),
(5, NULL, 'AM', 'AP', 'Gabon', NULL, 'Patrick', 'Manuel', 'Male', '1998-11-20', 'Pasig City', NULL, NULL, NULL, '76371_541686522517167_1955437084_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:33:08', 'PENDING', NULL, NULL, ''),
(6, NULL, 'PM', 'ESP', 'Oprenario', NULL, 'Leslie Alexis', 'Manuel', 'Female', '1990-03-31', 'Pasig City', NULL, NULL, NULL, '430082_541686969183789_1029801639_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:34:49', 'PENDING', NULL, NULL, ''),
(7, NULL, 'PM', 'FIL', 'Cadayona', NULL, 'Gracielle Mae', 'Manuel', 'Female', '1987-06-24', 'Malabon City', NULL, NULL, NULL, '76371_541686522517167_1955437084_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:38:30', 'PENDING', NULL, NULL, ''),
(8, NULL, 'PM', 'SCI', 'Gubat', NULL, 'Edward', NULL, 'Male', '1990-03-12', 'Pasig City', NULL, NULL, NULL, '409104_346205608731927_533903614_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 07:39:58', 'PENDING', NULL, NULL, ''),
(11, NULL, 'AM', 'RESEARCH', 'Gabon', NULL, 'Mary Ann', NULL, 'Female', '1973-05-02', 'Malabon City', NULL, NULL, NULL, '430082_541686969183789_1029801639_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 12:48:06', 'PENDING', NULL, NULL, ''),
(12, NULL, 'AM', 'TLE', 'Gabon', NULL, 'Ernesto', 'Baccol', 'Male', '1969-01-03', 'Manila City', NULL, NULL, NULL, '430082_541686969183789_1029801639_n.jpg', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', NULL, 'Pasig City', 'Metro Manila', 'Phillipines', 2, 'INSERT', '2020-03-01 08:51:01', 'PENDING', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure for view `summary_roomcreation`
--
DROP TABLE IF EXISTS `summary_roomcreation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summary_roomcreation`  AS  select `temp_roomcreation`.`ControlNum` AS `ControlNum`,`temp_roomcreation`.`RoomNum` AS `RoomNum`,`temp_roomcreation`.`RoomName` AS `RoomName`,`temp_roomcreation`.`Building` AS `Building`,`temp_roomcreation`.`Floor` AS `Floor`,`temp_roomcreation`.`Type` AS `Type`,`temp_roomcreation`.`DateCreated` AS `DateCreated`,`temp_roomcreation`.`CreatedBy` AS `CreatedBy`,`temp_roomcreation`.`Action_` AS `Action_`,`temp_roomcreation`.`Status_` AS `Status_` from `temp_roomcreation` ;

-- --------------------------------------------------------

--
-- Structure for view `summary_studentregistration`
--
DROP TABLE IF EXISTS `summary_studentregistration`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summary_studentregistration`  AS  select `temp_studentregistration`.`ControlNum` AS `ControlNum`,`temp_studentregistration`.`LRNNum` AS `LRNNum`,`temp_studentregistration`.`LastName` AS `LastName`,`temp_studentregistration`.`FirstName` AS `FirstName`,`temp_studentregistration`.`MiddleName` AS `MiddleName`,`temp_studentregistration`.`Type` AS `Type`,`temp_studentregistration`.`URL_Picture` AS `URL_Picture`,`temp_studentregistration`.`DateCreated` AS `DateCreated`,`temp_studentregistration`.`Action_` AS `Action_`,`temp_studentregistration`.`Status_` AS `Status_` from `temp_studentregistration` ;

-- --------------------------------------------------------

--
-- Structure for view `summary_subjectcodecreation`
--
DROP TABLE IF EXISTS `summary_subjectcodecreation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summary_subjectcodecreation`  AS  select `temp_subjectcodecreation`.`ControlNum` AS `ControlNum`,`temp_subjectcodecreation`.`SubjectCode` AS `SubjectCode`,`temp_subjectcodecreation`.`SubjectDescription` AS `SubjectDescription`,`temp_subjectcodecreation`.`GradeLevel` AS `GradeLevel`,`temp_subjectcodecreation`.`Frequency` AS `Frequency`,`temp_subjectcodecreation`.`DateCreated` AS `DateCreated`,`temp_subjectcodecreation`.`CreatedBy` AS `CreatedBy`,`temp_subjectcodecreation`.`Action_` AS `Action_`,`temp_subjectcodecreation`.`Status_` AS `Status_` from `temp_subjectcodecreation` ;

-- --------------------------------------------------------

--
-- Structure for view `summary_teacherregistration`
--
DROP TABLE IF EXISTS `summary_teacherregistration`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summary_teacherregistration`  AS  select `temp_teacherregistration`.`ControlNum` AS `ControlNum`,`temp_teacherregistration`.`TeacherNum` AS `TeacherNum`,`temp_teacherregistration`.`LastName` AS `LastName`,`temp_teacherregistration`.`FirstName` AS `FirstName`,`temp_teacherregistration`.`MiddleName` AS `MiddleName`,`temp_teacherregistration`.`URL_Picture` AS `URL_Picture`,`temp_teacherregistration`.`DateCreated` AS `DateCreated`,`temp_teacherregistration`.`Action_` AS `Action_`,`temp_teacherregistration`.`Status_` AS `Status_` from `temp_teacherregistration` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`TeacherNum`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `main_teacherregistration`
--
ALTER TABLE `main_teacherregistration`
  ADD PRIMARY KEY (`TeacherNum`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `temp_roomcreation`
--
ALTER TABLE `temp_roomcreation`
  ADD PRIMARY KEY (`ControlNum`);

--
-- Indexes for table `temp_studentregistration`
--
ALTER TABLE `temp_studentregistration`
  ADD PRIMARY KEY (`ControlNum`);

--
-- Indexes for table `temp_subjectcodecreation`
--
ALTER TABLE `temp_subjectcodecreation`
  ADD PRIMARY KEY (`ControlNum`);

--
-- Indexes for table `temp_teacherregistration`
--
ALTER TABLE `temp_teacherregistration`
  ADD PRIMARY KEY (`ControlNum`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_teacherregistration`
--
ALTER TABLE `main_teacherregistration`
  MODIFY `TeacherNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_roomcreation`
--
ALTER TABLE `temp_roomcreation`
  MODIFY `ControlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_studentregistration`
--
ALTER TABLE `temp_studentregistration`
  MODIFY `ControlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_subjectcodecreation`
--
ALTER TABLE `temp_subjectcodecreation`
  MODIFY `ControlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_teacherregistration`
--
ALTER TABLE `temp_teacherregistration`
  MODIFY `ControlNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
