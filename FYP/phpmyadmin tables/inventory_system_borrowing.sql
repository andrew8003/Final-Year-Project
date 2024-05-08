-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2024 at 04:20 PM
-- Server version: 8.0.36-0ubuntu0.20.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w1816963_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_system_borrowing`
--

CREATE TABLE `inventory_system_borrowing` (
  `borrow_id` int NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `asset_id` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `borrow_time` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `date_borrowed` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `return_date` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `asset_returned` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `inventory_system_borrowing`
--

INSERT INTO `inventory_system_borrowing` (`borrow_id`, `user_id`, `asset_id`, `borrow_time`, `date_borrowed`, `return_date`, `asset_returned`) VALUES
(30, '39', '686448903965', '5', '2024-03-02', '2024-03-02', 'Yes'),
(31, '39', '658466193066', '7', '2024-03-02', '2024-03-02', 'Yes'),
(32, '39', '164015486733', '22', '2024-02-02', '2024-03-03', 'Yes'),
(33, '38', '797808283913', '7', '2024-03-03', '2024-03-03', 'Yes'),
(34, '36', '452840438133', '5', '2024-03-03', '2024-03-03', 'Yes'),
(35, '35', '686448903965', '6', '2024-03-03', '2024-03-03', 'Yes'),
(36, '40', '658466193066', '13', '2024-03-03', '2024-03-03', 'Yes'),
(39, '39', '313729007656', '4', '2024-03-03', '2024-03-03', 'Yes'),
(40, '39', '313729007656', '4', '2024-03-03', '2024-03-03', 'Yes'),
(41, '39', '764261366453', '3', '2024-03-03', '2024-03-03', 'Yes'),
(42, '39', '359690942245', '2', '2024-03-03', '2024-03-03', 'Yes'),
(43, '39', '313729007656', '6', '2024-03-03', '2024-03-03', 'Yes'),
(44, '54', '313729007656', '4', '2024-03-03', '2024-03-09', 'Yes'),
(45, '39', '546052882834', '4', '2024-03-03', '2024-03-03', 'Yes'),
(46, '41', '214260537145', '7', '2024-03-03', '2024-03-03', 'Yes'),
(47, '37', '686448903965', '5', '2024-03-03', '2024-03-03', 'Yes'),
(48, '45', '452840438133', '5', '2024-03-03', '2024-03-03', 'Yes'),
(49, '49', '658466193066', '7', '2024-03-03', '2024-03-03', 'Yes'),
(50, '39', '546052882834', '3', '2024-03-03', '2024-03-03', 'Yes'),
(51, '42', '832736736580', '5', '2024-03-03', '2024-03-03', 'Yes'),
(52, '41', '174623923698', '4', '2024-03-03', '2024-03-09', 'Yes'),
(53, '37', '686448903965', '6', '2024-03-03', '2024-03-09', 'Yes'),
(54, '45', '646167748313', '2', '2024-03-03', '2024-03-09', 'Yes'),
(55, '49', '546052882834', '7', '2024-03-03', '2024-03-09', 'Yes'),
(56, '39', '931061547552', '4', '2024-03-03', '2024-03-05', 'Yes'),
(57, '42', '434490388187', '5', '2024-03-03', '2024-03-09', 'Yes'),
(58, '39', '164015486733', '5', '2024-03-05', '2024-03-05', 'Yes'),
(59, '39', '202737671541', '4', '2024-03-05', '2024-03-08', 'Yes'),
(60, '39', '964825004300', '7', '2024-03-08', '2024-03-09', 'Yes'),
(61, '39', '164015486733', '5', '2024-03-09', '2024-03-09', 'Yes'),
(62, '39', '103526377095', '5', '2024-03-09', '2024-03-09', 'Yes'),
(63, '39', '154965463186', '5', '2024-03-09', '2024-03-09', 'Yes'),
(64, '39', '174623923698', '5', '2024-03-09', '2024-03-09', 'Yes'),
(65, '39', '174623923698', '5', '2024-03-09', '2024-03-09', 'Yes'),
(66, '39', '103526377095', '5', '2024-03-09', '2024-03-26', 'Yes'),
(67, '35', '452840438133', '3', '2024-03-27', '2024-03-29', 'Yes'),
(68, '35', '174623923698', '1', '2024-03-30', NULL, 'No'),
(69, '36', '447023044062', '5', '2024-03-31', NULL, 'No'),
(70, '51', '790585071195', '7', '2024-03-31', NULL, 'No'),
(71, '50', '214260537145', '6', '2024-03-31', NULL, 'No'),
(72, '40', '434490388187', '7', '2024-03-31', NULL, 'No'),
(73, '39', '797808283913', '4', '2024-03-31', NULL, 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_system_borrowing`
--
ALTER TABLE `inventory_system_borrowing`
  ADD PRIMARY KEY (`borrow_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_system_borrowing`
--
ALTER TABLE `inventory_system_borrowing`
  MODIFY `borrow_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
