-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2025 at 11:07 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rolsadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Service` varchar(255) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ExprirationDate` varchar(10) NOT NULL,
  `CardNum` varchar(20) NOT NULL,
  `CVV` varchar(4) NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `CustomerID`, `Service`, `DateTime`, `Address`, `ExprirationDate`, `CardNum`, `CVV`, `Price`) VALUES
(1, 2, 'Solar panel installation', '2025-04-01 14:30:00', '59 Lawson Close,,,Newcastle Upon Tyne,Tyne and Wear', '11/11', '1111 1111 1111 1111', '123', '100.00'),
(2, 1, 'Consultation', '2025-11-05 10:00:00', 'Greggs,Q9,Quorum Business Park, Benton Lane,Newcastle Upon Tyne,Northumberland', '02/30', '5756 5783 7583 7897', '676', '100.00'),
(7, 3, 'Solar panel maintenance', '2025-03-28 09:49:00', 'Greggs,Q9,Quorum Business Park, Benton Lane,Newcastle Upon Tyne,Northumberland', '05/03', '1323 4564 5872 5675', '053', '100.00'),
(8, 3, 'Solar panel maintenance', '2025-03-28 09:49:00', 'Greggs,Q9,Quorum Business Park, Benton Lane,Newcastle Upon Tyne,Northumberland', '05/03', '1323 4564 5872 5675', '053', '100.00'),
(9, 3, 'Solar panel maintenance', '2025-04-24 17:00:00', '16 Clydesdale Road,,,Newcastle upon Tyne,Tyne and Wear', '12/27', '1111 1111 1111 1111', '334', '500.00'),
(10, 3, 'Solar panel maintenance', '2025-04-24 17:00:00', '16 Clydesdale Road,,,Newcastle upon Tyne,Tyne and Wear', '12/27', '1111 1111 1111 1111', '334', '500.00'),
(11, 3, 'Solar panel maintenance', '2025-04-24 17:00:00', '16 Clydesdale Road,,,Newcastle upon Tyne,Tyne and Wear', '12/27', '1111 1111 1111 1111', '334', '500.00'),
(12, 1, 'Smart meter installation', '2025-04-01 10:30:00', '16 Clydesdale Road,,,Newcastle upon Tyne,Tyne and Wear', '04/25', '1213 6873 7687 7858', '564', '10.00'),
(13, 1, 'Solar panel installation', '2025-11-05 05:11:00', '59 Lawson Close,,,Newcastle Upon Tyne,Tyne and Wear', '05/11', '4354 4646 5435 8768', '511', '8000.00'),
(14, 5, 'Smart meter installation', '2025-04-24 17:00:00', '9 Grey Street,,,Newcastle upon Tyne,Tyne and Wear', '23/32', '3364 6746 7865 7868', '4564', '10.00'),
(15, 5, 'Electric vehicle charging station maintenance', '2025-04-09 18:00:00', 'Micks Autos,Weetslade Industrial Estate,Great Lime Road,Dudley, Cramlington,Northumberland', '34/75', '3123 5675 5765 8969', '445', '400.00'),
(17, 6, 'Solar panel installation', '2025-07-10 09:45:00', '1 St. James Terrace,,,Riding Mill,Northumberland', '46/87', '3656 6456 7856 5674', '545', '8000.00'),
(18, 6, 'Smart meter installation', '2025-05-29 19:45:00', 'British Broadcasting Corporation,Broadcasting Centre,Barrack Road,Newcastle upon Tyne,Tyne and Wear', '36/46', '1322 3633 4564 7465', '345', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `CustomerID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CustomerID`, `Username`, `Email`, `Password`) VALUES
(1, 'testing', 'testing@test.com', '$2y$10$ZHpQO8bXWyc2hqIXXRRApOOUTI/VMH/wY8fM7OkP/777ymFogoAC6'),
(2, 'Nathan', 'nathangallagher101@gmail.com', '$2y$10$3YoF/laHiIVU8vvz8QpFTuIRSKKBWwWKcEoPB35Ez98UtcXv0DtMu'),
(3, 'Rotoris', 'daUnseen@gmail.com', '$2y$10$yTERUkZvd3bppD5nVUai8.hRfUPnEtfhNqnt28HEzvRkt4vcIRj3K'),
(4, 'grogle-simpson-5', 'i-defo-real@simpson.com', '$2y$10$PI2eXeUOizZZZOmqyEObKOA7wfDgAgyUOcNjqAwyzUFDNV2Og2iCK'),
(5, 'greg', 'greg1@gmail.com', '$2y$10$ltyN9Pa2MVIzgncWYEVZ9.TZ9euYEb6aFL14PoaCF1iEWEbWDhv0.'),
(6, 'peaksona', 'ace-defective@p3.com', '$2y$10$y5lvR/WJpnAG3bpdXjdJoOF7K8Coqyk3YP2Iy2d2p0GiKDcXmhqAS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `CustomerID` (`CustomerID`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
