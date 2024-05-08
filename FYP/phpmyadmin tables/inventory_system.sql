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
-- Table structure for table `inventory_system`
--

CREATE TABLE `inventory_system` (
  `user_id` int NOT NULL,
  `usertype` varchar(1) COLLATE utf8mb3_bin NOT NULL,
  `username` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb3_bin NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb3_bin NOT NULL,
  `account_disabled` varchar(1) COLLATE utf8mb3_bin DEFAULT NULL,
  `currently_borrowing` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `currently_borrowed_id` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `inventory_system`
--

INSERT INTO `inventory_system` (`user_id`, `usertype`, `username`, `password`, `email`, `telephone`, `account_disabled`, `currently_borrowing`, `currently_borrowed_id`) VALUES
(25, 'A', 'admin', '$2y$10$AgRKHPDPsefBBB4US7sOkeQWyIvnGTCd8KlaEpBSA.hNL4fJ8vsYG', 'Admin@westminster.ac.uk', '02840625485', '0', 'No', NULL),
(33, 'U', 'shar01n', '$2y$10$FmXBZsPNK6s/xtXcYGdnXuLb.QFERpc/MzDRemja4Re.VByvOjPiu', 'sharonh@gmail.com', '07934010554', '0', 'No', NULL),
(34, 'U', 'jonothan sanders', '$2y$10$5MS6FN186ti2r0PPPpEo4e9iKTIKpAQbVcR6AAY4Z.C9ScYRmYKpO', 'jsanders@hotmail.com', '07987451225', '0', 'No', NULL),
(35, 'U', 'rick', '$2y$10$3ZtFTWpI6xmrxW/SAFgRX.GarazUHWrl0cvf6APN0Jv7pObibosyC', 'rastley@gmail.com', '07541236558', '0', 'Yes', '174623923698'),
(36, 'U', 'linus', '$2y$10$HxLKRu5aKNxSObsSDBwsTOPf2I6Wyh6nBxEInnJv/16A0YQMWXxH.', 'torvalds@hotmail.com', '07954126587', '0', 'Yes', '447023044062'),
(37, 'U', 'tim', '$2y$10$InBJR5ag5tAT9h9Rfpux0O1HKwFlfo9qUmUm3Kjq9INk2rf6GQ1Rq', 'tcook@apple.com', '07954621448', '0', 'No', NULL),
(38, 'U', 'william', '$2y$10$1KN/yM6dyCCdPXW3GPNBYOwZGZIoUNWqCKqyTA3s5CLadjRZTOpYu', 'willontheinternet@yahoo.com', '07954863221', '0', 'No', NULL),
(39, 'U', 'andrew', '$2y$10$GlkAtckikJ5M8z3nmfP6YuAGHDJPKuf6IyYW/uio6pzQEKOGdVp8e', 'w1816963@westminster.ac.uk', '07934010441', '0', 'Yes', '797808283913'),
(40, 'U', 'jessica', '$2y$10$wA7S9JGzG9lwfbq0Q6LlTeKxhLiKpNlBKJuGfaUdSLFpebdWAFLMO', 'jessica2001@apple.com', '07945874551', '0', 'Yes', '434490388187'),
(41, 'U', 'lisa', '$2y$10$EAhLuZcgyCLmDbjrxEDrL.vk9kBYUx2XDq0ClMHMBTMapLMOp/qZi', 'lisag@yahoo.com', '07964123554', '0', 'No', NULL),
(42, 'U', 'rodger', '$2y$10$k4SQ8YuAlNOJoPKRP5x1qOuOh3vjwK8sURRR34maP.Tcx7Yr.bn9G', 'rodgeron@apple.com', '07956432187', '0', 'No', NULL),
(43, 'A', 'admins friend', '$2y$10$Se16VkV4NpbQXu3EjzSeyuR7a4pEztKH/MQqWzvDcVPsG.YnKPo0W', 'adminsfriend@westminster.ac.uk', '07965412335', '0', 'No', NULL),
(44, 'U', 'saul', '$2y$10$K/JPWSST4fz/DuwBoHdojuuV6ZJThrmsIzNzJKnYgq9gGHp3spgm.', 's.goodman@hotmail.com', '07954612334', '0', 'No', NULL),
(45, 'U', 'jessie', '$2y$10$SfkMXGMMZI4jtUY1t6fbluVddXUj4kv/Ta7CBeia19UgyM6V3jkTG', 'pinkman@yahoo.com', '04578945112', '0', 'No', NULL),
(46, 'U', 'walt', '$2y$10$1FectVrRNdWHV4Z6LW/M2ubSyvZVgLlSZ3PFrRrRd5Euva006I2q6', 'w.white@yahoo.com', '08845648779', '0', 'No', NULL),
(48, 'U', 'elon', '$2y$10$/k90FtbUyLjaobM/ze9gy.6HOLDUdrxN1refiEXWseUPPkqEkCkT.', 't3sla@outlook.com', '09874568115', '0', 'No', NULL),
(49, 'U', 'louise', '$2y$10$qy9uVZ7igfPEitAF92Z/xuYYstbTpL5N5yij6JptJ52ollfAUC5c.', 'lhill@outlook.com', '07845614775', '0', 'No', NULL),
(50, 'U', 'abdul', '$2y$10$93lmNy1nsMsModLF4XBaV.icbgA1I4sPpwIzLChVWOZgam7jJK4E6', 'abahe@gmail.com', '78458798556', '0', 'Yes', '214260537145'),
(51, 'U', 'jake', '$2y$10$zUm9HtQfMfFwE5.Fx7UQvuf.meWrSGpcKr8hicP7.AbkX.Yp.9d1y', 'smithy@gmail.com', '07954687134', '0', 'Yes', '790585071195'),
(52, 'U', 'samuel', '$2y$10$yeHFRSTnNYIZcIZN.IbYe.vWuoD2ljBmhJS73gfwwuBgHGhjOAkqy', 'smartin@yahoo.com', '07965487321', '0', 'No', NULL),
(53, 'U', 'james', '$2y$10$j9E9Cn81qHix8dmYA8xi2O76bsOIaWUp9CG/pMm0e.u8p55o6ov0m', 'james2002@gmail.com', '07895465448', '0', 'No', NULL),
(54, 'U', 'leon', '$2y$10$Ha6S4f0.qrWxK9VtzF5UoOcia5E.gi5yZmpoBmg9IFVRiF5AaX1.i', 'lrichard@yahoo.com', '07965487245', '0', 'No', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_system`
--
ALTER TABLE `inventory_system`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_system`
--
ALTER TABLE `inventory_system`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
