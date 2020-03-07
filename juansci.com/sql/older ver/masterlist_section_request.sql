-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 05:04 AM
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
-- Structure for view `masterlist_section_request`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `masterlist_section_request`  AS  select `main_section`.`SectionNum` AS `SectionNum`,`main_section`.`SectionName` AS `SectionName`,`main_section`.`RoomNum` AS `RoomNum`,`main_section`.`GradeLevel` AS `GradeLevel`,`main_section`.`SchoolYear` AS `SchoolYear`,`main_section`.`Adviser` AS `Adviser`,if(isnull(`advisory`.`MiddleName`),concat(`advisory`.`LastName`,if(isnull(`advisory`.`ExtendedName`),'',`advisory`.`ExtendedName`),', ',`advisory`.`FirstName`,'',''),concat(`advisory`.`LastName`,' ',if(isnull(`advisory`.`ExtendedName`),'',`advisory`.`ExtendedName`),', ',`advisory`.`FirstName`,' ',left(`advisory`.`MiddleName`,1),'.')) AS `AdviserName`,`requests_schedule`.`CreatedBy` AS `CreatedBy`,if(isnull(`creator`.`MiddleName`),concat(`creator`.`LastName`,if(isnull(`creator`.`ExtendedName`),'',`creator`.`ExtendedName`),', ',`creator`.`FirstName`,'',''),concat(`creator`.`LastName`,' ',if(isnull(`creator`.`ExtendedName`),'',`creator`.`ExtendedName`),', ',`creator`.`FirstName`,' ',left(`creator`.`MiddleName`,1),'.')) AS `RequestedBy`,`requests_schedule`.`Status_` AS `Status_` from (((`main_section` left join `main_teacher` `advisory` on((`advisory`.`TeacherNum` = `main_section`.`Adviser`))) left join `requests_schedule` on((`main_section`.`SectionNum` = `requests_schedule`.`SectionNum`))) left join `main_teacher` `creator` on((`requests_schedule`.`CreatedBy` = `creator`.`TeacherNum`))) ;

--
-- VIEW  `masterlist_section_request`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
