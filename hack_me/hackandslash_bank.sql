-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 04:55 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackandslash_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `Username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Full_Name` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `Birth_Year` int(4) NOT NULL,
  `Social_Security` int(9) NOT NULL,
  `Amount_Stored` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`Username`, `Password`, `Full_Name`, `Birth_Year`, `Social_Security`, `Amount_Stored`) VALUES
('wongw', 'websys', 'Wilson Wong', 1999, 123456789, 1000000),
('looka', 'websys', 'Arron Look', 1999, 234567890, 1000000),
('pikef', 'websysleader', 'Finnegan Pike', 1999, 345678901, 1000001),
('castillos', 'websys', 'Sebastian Castillo-Sanchez', 1999, 456789012, 1000000),
('munast', 'professor', 'Thilanka Munasinghe', 1500, 135792468, -1000),
('smithj', 'abc123', 'Joe Smith', 1999, 112233445, 1234),
('voorhej', 'hacker', 'Jason Voorhees', 1980, 131313130, 11111),
('actuallyit', 'youreit', 'IT', 1986, 123454321, 11111);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
