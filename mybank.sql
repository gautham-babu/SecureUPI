-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 08:58 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybank`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchId` int NOT NULL,
  `branchNo` varchar(20) NOT NULL,
  `branchName` varchar(20) NOT NULL
) ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchId`, `branchNo`, `branchName`) VALUES
(1, '100101', 'Ernakulam'),
(2, '100102', 'Kozhikode');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int NOT NULL,
  `message` text NOT NULL,
  `userId` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `message`, `userId`, `date`) VALUES
(5, 'need help with creating a new account with same number', 1, '2024-10-20 15:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` int NOT NULL,
  `email` varchar(20)  NOT NULL,
  `password` varchar(20)  NOT NULL,
  `type` varchar(10)  NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `email`, `password`, `type`, `date`) VALUES
(1, 'managerfed@gmail.com', 'manager', 'manager', '2024-10-18 04:36:27'),
(2, 'cashier1@gmail.com', 'cashier1', 'cashier', '2024-10-20 07:14:47'),
(3, 'cashier2@gmail.com', 'cashier2', 'cashier', '2024-10-20 11:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int NOT NULL,
  `userId` varchar(20) NOT NULL,
  `notice` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `userId`, `notice`, `date`) VALUES
(1, '1', 'Dear Customer! <br> Our privacy policy is changed for account information, get new prospectus from your nearest branch.', '2024-10-18 13:11:46'),
(2, '1', 'Apply for loans easily with us', '2024-10-15 12:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int NOT NULL,
  `action` varchar(10) NOT NULL,
  `credit` varchar(20) DEFAULT NULL,
  `debit` varchar(20) DEFAULT NULL,
  `other` varchar(20) NOT NULL,
  `userId` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `action`, `credit`, `debit`, `other`, `userId`, `date`) VALUES
(40, 'transfer', NULL, '2000', '1005469', 1, '2024-10-20 15:35:17'),
(41, 'transfer', NULL, '800', '1005469', 1, '2024-10-20 15:55:55'),
(42, 'transfer', NULL, '1000', '1005469', 1, '2024-10-20 15:57:24'),
(43, 'withdraw', NULL, '1500', '210336', 2, '2024-10-20 16:19:39'),
(44, 'withdraw', NULL, '500', '248896', 1, '2024-10-20 17:06:13'),
(45, 'deposit', '1200', NULL, '689774', 1, '2024-10-20 17:07:03'),
(46, 'withdraw', NULL, '500', '757222', 2, '2024-10-20 18:05:09'),
(47, 'deposit', '1500', NULL, '424242', 2, '2024-10-20 18:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` varchar(20) NOT NULL,
  `balance` varchar(10) NOT NULL,
  `aadhaar` varchar(12) NOT NULL,
  `number` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `accountNo` varchar(20) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `accountType` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `email`, `password`, `name`, `balance`, `aadhaar`, `number`, `address`, `accountNo`, `branch`, `accountType`, `date`) VALUES
(1, 'liya@gmail.com', 'liya123', 'Liya Latheef', '9300', '564820114266', '8619995867', 'Malappuram', '10054777', '1', 'Savings', '2024-09-18 04:50:06'),
(2, 'emmanuel@gmail.com', 'emmanuel123', 'Emmanuel J Jose', '12456', '509924456633', '9788564521', 'Ernakulam', '1005469', '1', 'Current', '2024-10-01 05:50:06'),
(3, 'fidha@gmail.com', 'fidha123', 'Fidha Fathima N S', '14900', '598863625112', '9748888865', 'Ernakulam', '1729425875', '2', 'Savings', '2024-10-20 12:05:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
