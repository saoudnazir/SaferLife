-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2019 at 08:25 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saferlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `c_ID` int(11) NOT NULL,
  `p_ID` int(11) NOT NULL,
  `b_Date` date NOT NULL,
  `b_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`c_ID`, `p_ID`, `b_Date`, `b_Time`) VALUES
(1, 1, '2019-03-05', '03:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `c_ID` int(11) NOT NULL,
  `c_Location` varchar(100) COLLATE ascii_bin NOT NULL,
  `c_Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`c_ID`, `c_Location`, `c_Level`) VALUES
(1, '120 Spencer St Melbourne VIC 3021', 3);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `p_ID` int(5) NOT NULL,
  `p_Name` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `p_Age` int(10) DEFAULT NULL,
  `p_Note` varchar(500) COLLATE ascii_bin NOT NULL,
  `p_Images` varchar(10000) COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`p_ID`, `p_Name`, `p_Age`, `p_Note`, `p_Images`) VALUES
(1, 'Saoud', 21, 'A Pakistani Guy', 'yjgjm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD KEY `c_ID` (`c_ID`),
  ADD KEY `p_ID` (`p_ID`);

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`c_ID`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`p_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `c_ID` FOREIGN KEY (`c_ID`) REFERENCES `crime` (`c_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_ID` FOREIGN KEY (`p_ID`) REFERENCES `people` (`p_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
