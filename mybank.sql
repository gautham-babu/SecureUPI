-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 09:58 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `email`, `password`, `type`, `date`) VALUES
(1, 'admin@gmail.com', 'admin', 'manager', '2024-10-18 04:36:27'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `userId`, `notice`, `date`) VALUES
(1, '1', 'Dear Customer! <br> Our privacy policy is changed for account information, get new prospectus from our webite.', '2024-10-18 13:11:46');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `action`, `credit`, `debit`, `other`, `userId`, `date`) VALUES
(43, 'withdraw', NULL, '1500', '210336', 2, '2024-10-20 16:19:39'),
(44, 'withdraw', NULL, '500', '248896', 1, '2024-10-20 17:06:13'),
(45, 'deposit', '1200', NULL, '689774', 1, '2024-10-20 17:07:03'),
(46, 'withdraw', NULL, '500', '757222', 2, '2024-10-20 18:05:09'),
(47, 'deposit', '1500', NULL, '424242', 2, '2024-10-20 18:05:34'),
(69, 'debit', NULL, '123', '1729425875', 1, '2025-03-23 15:02:24'),
(70, 'debit', NULL, '877', '1729425875', 1, '2025-03-23 15:14:30'),
(72, 'debit', NULL, '258', '1729425875', 1, '2025-03-23 15:17:20'),
(74, 'debit', NULL, '10', '1729425875', 1, '2025-03-23 15:25:45'),
(75, 'debit', NULL, '10', '1729425875', 1, '2025-03-23 15:27:12'),
(77, 'debit', NULL, '50', '1729425875', 1, '2025-03-23 15:56:24'),
(78, 'credit', '50', NULL, '10054777', 3, '2025-03-23 15:56:24'),
(79, 'debit', NULL, '27', '1729425875', 1, '2025-03-23 16:14:55'),
(80, 'credit', '27', NULL, '10054777', 3, '2025-03-23 16:14:55'),
(83, 'fraud', NULL, '56', '1742711851', 1, '2025-03-23 16:24:02'),
(84, 'fraud', NULL, '200', '1742753381', 1, '2025-03-23 18:12:21'),
(85, 'debit', NULL, '23', '1005469', 1, '2025-03-23 18:15:55'),
(86, 'credit', '23', NULL, '10054777', 2, '2025-03-23 18:15:55'),
(87, 'fraud', NULL, '250', '1742753381', 1, '2025-03-25 09:11:26'),
(88, 'debit', NULL, '200', '1005469', 1, '2025-03-25 09:12:52'),
(89, 'credit', '200', NULL, '10054777', 2, '2025-03-25 09:12:52'),
(90, 'debit', NULL, '10', '1005469', 1, '2025-03-26 20:55:12'),
(91, 'credit', '10', NULL, '10054777', 2, '2025-03-26 20:55:12'),
(92, 'fraud', NULL, '90', '1742753381', 1, '2025-03-27 02:41:20'),
(93, 'fraud', NULL, '10', '1742711851', 1, '2025-03-27 04:11:58'),
(94, 'debit', NULL, '90', '1005469', 1, '2025-03-27 04:14:56'),
(95, 'credit', '90', NULL, '10054777', 2, '2025-03-27 04:14:56'),
(96, 'debit', NULL, '90', '1005469', 1, '2025-03-27 04:15:00'),
(97, 'credit', '90', NULL, '10054777', 2, '2025-03-27 04:15:00'),
(98, 'debit', NULL, '10', '1729425875', 1, '2025-03-27 05:12:32'),
(99, 'credit', '10', NULL, '10054777', 3, '2025-03-27 05:12:32'),
(100, 'debit', NULL, '20', '1729425875', 1, '2025-03-27 05:15:40'),
(101, 'credit', '20', NULL, '10054777', 3, '2025-03-27 05:15:40'),
(102, 'debit', NULL, '10', '1005469', 1, '2025-03-27 05:24:52'),
(103, 'credit', '10', NULL, '10054777', 2, '2025-03-27 05:24:52'),
(104, 'fraud', NULL, '50', '1742711851', 1, '2025-03-27 05:25:57'),
(105, 'debit', NULL, '8000', '10054777', 2, '2025-03-27 07:14:19'),
(106, 'credit', '8000', NULL, '1005469', 1, '2025-03-27 07:14:19'),
(107, 'debit', NULL, '2000', '1005469', 1, '2025-03-27 07:17:57'),
(108, 'credit', '2000', NULL, '10054777', 2, '2025-03-27 07:17:57'),
(109, 'fraud', NULL, '100', '1742711851', 1, '2025-03-27 07:21:37'),
(110, 'fraud', NULL, '100', '1742711851', 1, '2025-03-27 15:15:46'),
(111, 'debit', NULL, '50', '1005469', 1, '2025-03-27 15:21:07'),
(112, 'credit', '50', NULL, '10054777', 2, '2025-03-27 15:21:07'),
(113, 'debit', NULL, '20', '1005469', 1, '2025-03-27 16:05:39'),
(114, 'credit', '20', NULL, '10054777', 2, '2025-03-27 16:05:39'),
(115, 'fraud', NULL, '55', '1742711851', 1, '2025-03-27 16:06:03'),
(117, 'debit', NULL, '500', '1005469', 1, '2025-03-27 16:09:50'),
(118, 'credit', '500', NULL, '10054777', 2, '2025-03-27 16:09:50'),
(119, 'debit', NULL, '60', '1005469', 1, '2025-03-27 16:16:26'),
(120, 'credit', '60', NULL, '10054777', 2, '2025-03-27 16:16:26'),
(121, 'fraud', NULL, '40', '1742711851', 1, '2025-03-27 16:17:07'),
(122, 'debit', NULL, '250', '1005469', 13, '2025-03-27 16:36:38'),
(123, 'credit', '250', NULL, '1742711851', 2, '2025-03-27 16:36:38'),
(124, 'debit', NULL, '100', '1005469', 13, '2025-03-27 16:38:27'),
(125, 'credit', '100', NULL, '1742711851', 2, '2025-03-27 16:38:27'),
(126, 'fraud', NULL, '440', '1742711851', 1, '2025-03-27 16:42:26'),
(129, 'wrong pin', NULL, '58', '1005469', 1, '2025-03-27 17:42:07'),
(130, 'wrong pin', NULL, '125', '1005469', 13, '2025-03-27 18:31:29'),
(131, 'wrong pin', NULL, '56', '1005469', 13, '2025-03-27 18:32:51'),
(132, 'debit', NULL, '50', '1005469', 13, '2025-03-27 18:36:36'),
(133, 'credit', '50', NULL, '1742711851', 2, '2025-03-27 18:36:36'),
(134, 'debit', NULL, '10', '1005469', 13, '2025-03-27 18:39:53'),
(135, 'credit', '10', NULL, '1742711851', 2, '2025-03-27 18:39:53'),
(136, 'debit', NULL, '20', '1005469', 13, '2025-03-27 18:40:15'),
(137, 'credit', '20', NULL, '1742711851', 2, '2025-03-27 18:40:15'),
(138, 'wrong pin', NULL, '25', '1005469', 13, '2025-03-27 18:40:56'),
(139, 'wrong pin', NULL, '89', '1005469', 13, '2025-03-27 18:41:11'),
(140, 'wrong pin', NULL, '56', '1005469', 13, '2025-03-27 18:41:23'),
(141, 'fraud', NULL, '20', '1742711851', 1, '2025-03-27 19:46:57'),
(142, 'debit', NULL, '1000', '1742711851', 1, '2025-03-27 21:10:17'),
(143, 'credit', '1000', NULL, '10054777', 13, '2025-03-27 21:10:17'),
(144, 'fraud', NULL, '400', '1742711851', 1, '2025-03-27 21:14:56'),
(145, 'debit', NULL, '500', '1005469', 1, '2025-03-27 21:15:24'),
(146, 'credit', '500', NULL, '10054777', 2, '2025-03-27 21:15:24'),
(147, 'fraud', NULL, '500', '10054777', 2, '2025-03-27 21:19:01'),
(152, 'debit', NULL, '950', '1729425875', 2, '2025-03-27 21:27:23'),
(153, 'credit', '950', NULL, '1005469', 3, '2025-03-27 21:27:23'),
(154, 'debit', NULL, '250', '1729425875', 2, '2025-03-27 21:30:36'),
(155, 'credit', '250', NULL, '1005469', 3, '2025-03-27 21:30:36'),
(156, 'debit', NULL, '750', '1743101821', 2, '2025-03-27 21:47:48'),
(157, 'credit', '750', NULL, '1005469', 15, '2025-03-27 21:47:48'),
(158, 'debit', NULL, '500', '1005469', 15, '2025-03-27 21:48:46'),
(159, 'credit', '500', NULL, '1743101821', 2, '2025-03-27 21:48:46'),
(160, 'debit', NULL, '50', '1005469', 15, '2025-03-27 21:50:04'),
(161, 'credit', '50', NULL, '1743101821', 2, '2025-03-27 21:50:04'),
(162, 'wrong pin', NULL, '2000', '1743101821', 16, '2025-03-27 21:56:25'),
(163, 'debit', NULL, '200', '1743101821', 16, '2025-03-27 21:56:48'),
(164, 'credit', '200', NULL, '1743112415', 15, '2025-03-27 21:56:48'),
(165, 'debit', NULL, '40', '1005469', 1, '2025-03-27 22:55:07'),
(166, 'credit', '40', NULL, '10054777', 2, '2025-03-27 22:55:07'),
(167, 'wrong pin', NULL, '50', '1005469', 1, '2025-03-27 22:55:21'),
(168, 'wrong pin', NULL, '500', '1005469', 1, '2025-03-27 22:55:51'),
(169, 'wrong pin', NULL, '55', '1005469', 1, '2025-03-27 22:56:21'),
(170, 'wrong pin', NULL, '56', '1005469', 1, '2025-03-27 22:56:35'),
(171, 'wrong pin', NULL, '56', '1005469', 1, '2025-03-27 22:56:53'),
(172, 'fraud', NULL, '56', '1742711851', 1, '2025-03-27 22:57:26'),
(173, 'debit', NULL, '500', '1005469', 1, '2025-03-27 23:15:56'),
(174, 'credit', '500', NULL, '10054777', 2, '2025-03-27 23:15:56'),
(175, 'wrong pin', NULL, '400', '1005469', 1, '2025-03-27 23:16:14'),
(176, 'fraud', NULL, '45', '1742711851', 1, '2025-03-27 23:18:41'),
(177, 'fraud', NULL, '90', '10054777', 2, '2025-03-27 23:19:54'),
(178, 'fraud', NULL, '52', '10054777', 2, '2025-03-27 23:21:35'),
(179, 'fraud', NULL, '52', '10054777', 2, '2025-03-27 23:21:49'),
(180, 'fraud', NULL, '56', '10054777', 2, '2025-03-27 23:21:59'),
(181, 'fraud', NULL, '56', '10054777', 2, '2025-03-27 23:22:19'),
(182, 'fraud', NULL, '89', '10054777', 2, '2025-03-27 23:22:28'),
(183, 'debit', NULL, '89', '10054777', 2, '2025-03-27 23:22:55'),
(184, 'credit', '89', NULL, '1005469', 1, '2025-03-27 23:22:55'),
(185, 'debit', NULL, '89', '10054777', 2, '2025-03-27 23:23:31'),
(186, 'credit', '89', NULL, '1005469', 1, '2025-03-27 23:23:31'),
(187, 'debit', NULL, '500', '1005469', 1, '2025-03-27 23:47:23'),
(188, 'credit', '500', NULL, '10054777', 2, '2025-03-27 23:47:23'),
(189, 'fraud', NULL, '80', '1742711851', 1, '2025-03-27 23:48:02'),
(190, 'debit', NULL, '500', '1005469', 1, '2025-03-27 23:54:22'),
(191, 'credit', '500', NULL, '10054777', 2, '2025-03-27 23:54:22'),
(192, 'fraud', NULL, '200', '1742711851', 1, '2025-03-27 23:54:59'),
(193, 'debit', NULL, '500', '1005469', 1, '2025-03-28 08:47:21'),
(194, 'credit', '500', NULL, '10054777', 2, '2025-03-28 08:47:21'),
(195, 'fraud', NULL, '100', '1742711851', 1, '2025-03-28 08:47:57'),
(196, 'debit', NULL, '300', '1005469', 1, '2025-03-28 09:07:25'),
(197, 'credit', '300', NULL, '10054777', 2, '2025-03-28 09:07:25'),
(198, 'debit', NULL, '66', '1005469', 1, '2025-03-28 09:44:11'),
(199, 'credit', '66', NULL, '10054777', 2, '2025-03-28 09:44:11'),
(200, 'wrong pin', NULL, '500', '1005469', 1, '2025-03-28 09:46:44'),
(201, 'debit', NULL, '100', '1005469', 1, '2025-03-28 10:00:44'),
(202, 'credit', '100', NULL, '10054777', 2, '2025-03-28 10:00:44'),
(203, 'fraud', NULL, '600', '1742711851', 1, '2025-03-28 10:15:22'),
(204, 'fraud', NULL, '150', '1742711851', 1, '2025-03-28 10:18:23'),
(205, 'debit', NULL, '800', '1005469', 1, '2025-03-28 20:48:14'),
(206, 'credit', '800', NULL, '10054777', 2, '2025-03-28 20:48:14'),
(207, 'debit', NULL, '800', '1742711851', 1, '2025-03-28 20:48:37'),
(209, 'fraud', NULL, '2', '1742711851', 1, '2025-03-28 20:50:22'),
(210, 'debit', NULL, '250', '10054777', 2, '2025-03-28 20:51:06'),
(211, 'credit', '250', NULL, '1005469', 1, '2025-03-28 20:51:06'),
(212, 'fraud', NULL, '500', '1742753381', 2, '2025-03-29 01:24:37'),
(213, 'fraud', NULL, '400', '10054777', 2, '2025-03-29 01:26:51'),
(214, 'debit', NULL, '600', '10054777', 2, '2025-03-29 01:27:11'),
(215, 'credit', '600', NULL, '1005469', 1, '2025-03-29 01:27:11'),
(216, 'debit', NULL, '28', '10054777', 2, '2025-03-29 01:27:41'),
(217, 'credit', '28', NULL, '1005469', 1, '2025-03-29 01:27:41'),
(218, 'wrong pin', NULL, '200', '1005469', 27, '2025-03-29 01:30:27'),
(219, 'wrong pin', NULL, '56', '1005469', 27, '2025-03-29 01:30:46'),
(220, 'debit', NULL, '89', '1005469', 27, '2025-03-29 01:30:58'),
(221, 'credit', '89', NULL, '1743194290', 2, '2025-03-29 01:30:58'),
(222, 'wrong pin', NULL, '895', '1005469', 27, '2025-03-29 01:31:08'),
(223, 'wrong pin', NULL, '57', '1005469', 27, '2025-03-29 01:31:31'),
(224, 'wrong pin', NULL, '78', '1005469', 27, '2025-03-29 01:31:43'),
(225, 'debit', NULL, '1200', '1005469', 27, '2025-03-29 01:53:45'),
(226, 'credit', '1200', NULL, '1743194290', 2, '2025-03-29 01:53:45'),
(227, 'debit', NULL, '700', '1005469', 27, '2025-03-29 01:55:10'),
(228, 'credit', '700', NULL, '1743194290', 2, '2025-03-29 01:55:10'),
(229, 'debit', NULL, '90', '1005469', 1, '2025-03-29 02:05:09'),
(230, 'credit', '90', NULL, '10054777', 2, '2025-03-29 02:05:09'),
(231, 'debit', NULL, '800', '10054777', 2, '2025-03-29 02:06:36'),
(232, 'credit', '800', NULL, '1005469', 1, '2025-03-29 02:06:36'),
(233, 'fraud', NULL, '1500', '10054777', 2, '2025-03-29 02:07:07'),
(234, 'fraud', NULL, '500', '10054777', 2, '2025-03-29 02:15:40'),
(235, 'debit', NULL, '1000', '1743101821', 2, '2025-03-29 02:17:17'),
(236, 'credit', '1000', NULL, '1005469', 15, '2025-03-29 02:17:17'),
(237, 'debit', NULL, '500', '1005469', 1, '2025-03-29 06:45:51'),
(238, 'credit', '500', NULL, '10054777', 2, '2025-03-29 06:45:51'),
(239, 'fraud', NULL, '50', '1742711851', 1, '2025-03-29 06:46:27'),
(240, 'wrong pin', NULL, '554', '1742711851', 1, '2025-03-29 06:46:42'),
(241, 'debit', NULL, '500', '1005469', 1, '2025-04-02 19:34:46'),
(242, 'credit', '500', NULL, '10054777', 2, '2025-04-02 19:34:46'),
(243, 'fraud', NULL, '100', '1742711851', 1, '2025-04-02 19:35:10'),
(244, 'wrong pin', NULL, '200', '1005469', 1, '2025-04-02 19:35:46');

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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Previous_Fraudulent_Activity` varchar(10) DEFAULT NULL,
  `Daily_Transaction_Count` varchar(10) DEFAULT NULL,
  `Failed_Transaction_Count` varchar(10) DEFAULT NULL,
  `upi_pin` text,
  `branch` varchar(10) DEFAULT NULL,
  `Avg_Transaction_Amount` varchar(10) DEFAULT NULL,
  `Acc_Age` varchar(10) DEFAULT NULL,
  `Risk_Score` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `email`, `password`, `name`, `balance`, `aadhaar`, `number`, `address`, `accountNo`, `date`, `Previous_Fraudulent_Activity`, `Daily_Transaction_Count`, `Failed_Transaction_Count`, `upi_pin`, `branch`, `Avg_Transaction_Amount`, `Acc_Age`, `Risk_Score`) VALUES
(1, 'liya@gmail.com', 'liya123', 'Liya Latheef', '600', '564820114266', '8619995867', 'Malappuram', '10054777', '2024-09-18 04:50:06', '0', '17', '6', '1234', '2', '369.91', '191', '0.5'),
(2, 'emmanuel@gmail.com', 'emmanuel123', 'Emmanuel J Jose', '17079', '509924456633', '9788564521', 'Ernakulam', '1005469', '2024-10-01 05:50:06', '0', '38', '0', '1234', '1', '518.20', '183', '0.5'),
(3, 'fidha@gmail.com', 'fidha123', 'Fidha Fathima N S', '17146', '598863625112', '9748888865', 'Ernakulam', '1729425875', '2024-10-20 12:05:36', '0', '5', '0', '1234', '1', '1500', '180', '0.5'),
(13, 'gautham@gmail.com', 'gautham', 'Gautham Babu', '7620', '8953', '9289501501', 'Ernakulam', '1742711851', '2025-03-23 06:38:28', '1', '26', '20', '1234', '1', '1000', '10', '0.5'),
(14, 'narayanan@gmail.com', 'naru', 'Narayanan K', '10000', '98564', '9747001522', 'Kozhikode', '1742753381', '2025-03-23 18:11:11', '1', '20', '10', '1234', '2', '2000', '180', '0.5'),
(15, 'neha@gmail.com', 'neha', 'Neha Prasannan', '6400', '987598652144', '9748001508', 'Alapuzha', '1743101821', '2025-03-27 19:02:09', '0', '2', '0', '1234', '1', '3000', '1', '0.5'),
(27, 'gauthambabu12@gmail.com', 'rahul', 'Rahul Raj', '4011', '568546113131', '9945415213', 'Wayanad', '1743194290', '2025-03-28 20:39:28', '1', '9', '5', '1234', '2', '367.86', '180', '0.5');

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
  MODIFY `feedbackId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `transactionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
