-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 01:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streepapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `Sender` varchar(128) NOT NULL DEFAULT 'missing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `text`, `date`, `Sender`) VALUES
(50, 'This is a test message for the admins', '2023-04-17 01:20:22', '664351468');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `type` varchar(63) NOT NULL,
  `date` datetime NOT NULL,
  `editor` varchar(127) NOT NULL,
  `subject` int(11) NOT NULL,
  `object` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`ID`, `type`, `date`, `editor`, `subject`, `object`) VALUES
(66, 'debtList', '2023-04-17 01:21:33', '180151675', 180151675, 0),
(67, 'debtList', '2023-04-17 01:21:33', '180151675', 664351468, 5);

-- --------------------------------------------------------

--
-- Table structure for table `personalia`
--

CREATE TABLE `personalia` (
  `ID` int(255) NOT NULL,
  `name` char(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL DEFAULT 'qwerty123',
  `debt` float NOT NULL,
  `lastused` datetime NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personalia`
--

INSERT INTO `personalia` (`ID`, `name`, `email`, `password`, `debt`, `lastused`, `isAdmin`, `isActive`) VALUES
(180151675, 'John Smith', 'JohnSmith@email.com', 'qwerty123', 9.2, '2023-04-17 01:20:37', 1, 1),
(664351468, 'Frank Wright', 'F.Wright@web.org', 'poiuy098', 5.8, '2023-04-17 01:20:56', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prodID` int(11) NOT NULL,
  `prodName` varchar(255) NOT NULL,
  `prodPrice` float NOT NULL,
  `colorHex` varchar(7) NOT NULL DEFAULT 'FF0000',
  `timessold` int(255) NOT NULL,
  `lastsold` datetime NOT NULL DEFAULT current_timestamp(),
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodID`, `prodName`, `prodPrice`, `colorHex`, `timessold`, `lastsold`, `isActive`) VALUES
(1, 'Drink', 0.8, '#00ff40', 5, '2014-03-19 01:36:20', 1),
(2, 'Snack', 1, '#e07bda', 1, '2023-04-17 01:17:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `devID` int(11) NOT NULL,
  `purchAmount` int(11) NOT NULL,
  `purchDate` datetime DEFAULT current_timestamp(),
  `purchPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchID`, `prodID`, `custID`, `devID`, `purchAmount`, `purchDate`, `purchPrice`) VALUES
(646, 1, 664351468, 664351468, 2, '2023-04-17 01:20:30', 0.8),
(647, 2, 664351468, 664351468, 1, '2023-04-17 01:20:33', 1),
(648, 1, 180151675, 664351468, 1, '2023-04-17 01:20:37', 0.8),
(649, 1, 664351468, 180151675, 2, '2023-04-17 01:20:56', 0.8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `personalia`
--
ALTER TABLE `personalia`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `personalia`
--
ALTER TABLE `personalia`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703276910;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=650;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
