-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2024 at 04:19 PM
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
-- Table structure for table `inventory_system_assets`
--

CREATE TABLE `inventory_system_assets` (
  `asset_id` bigint NOT NULL,
  `asset_name` varchar(255) COLLATE utf8mb3_bin NOT NULL,
  `asset_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `asset_location` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `asset_serialnum` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `asset_group` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `available_borrowing` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `currently_borrowed` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL,
  `borrowed_by_id` varchar(255) COLLATE utf8mb3_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `inventory_system_assets`
--

INSERT INTO `inventory_system_assets` (`asset_id`, `asset_name`, `asset_description`, `asset_location`, `asset_serialnum`, `asset_group`, `date_created`, `available_borrowing`, `currently_borrowed`, `borrowed_by_id`) VALUES
(103526377095, 'Macbook Air 2019', 'Apple Macbook Air, 13inch, 2019, 16GB Ram, 256GB, Grey', 'Marylebone Campus', '008569436246', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(127777831332, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(130288046676, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(132772904485, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(140921095066, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '315191335701', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(143583778293, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(146140358355, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(150019707894, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(154918249392, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(154965463186, 'Macbook Pro 2023', 'Apple Macbook Pro, 15 inch, 2023, M2 Pro, 32GB RAM, 512GB, Grey', 'Marylebone Campus', '225626893049', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(156010318201, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(164015486733, 'Macbook Pro 2023', 'Macbook Pro 2023, Grey, M2 Max, 1TB', 'Regent Street Campus', '811472332242', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(174623923698, 'Macbook Air 2019', 'Macbook Air 2019, grey, 256gb', 'Cavndish Campus', '393501978109', 'Cavendish Laptops', '2024-03-01', 'Yes', 'Yes', '35'),
(179898711883, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(182945099316, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '956094361848', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(196227810314, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '173180720898', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(202259516454, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '191444320024', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(202737671541, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '371789089912', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(214260537145, 'Macbook Air 2019', 'Apple Macbook Air, 13inch, 2019, 16GB Ram, 256GB, Grey', 'Marylebone Campus', '317430967125', 'Marylebone Laptops', '2024-03-03', 'Yes', 'Yes', '50'),
(219662976567, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '441822533371', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(241746400801, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(263073887921, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(274856409545, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(283260631498, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(301123205249, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '972298285733', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(313729007656, 'Macbook Pro 2019 ', 'Macbook Pro 2019, 15inch, grey, 1TB', 'Cavendish Campus', '406692518508', 'Cavendish Laptops', '2024-03-01', 'Yes', 'No', NULL),
(316079924031, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '552318015924', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(325252252117, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(327161996211, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(333240725504, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(335780257814, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(345104237500, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '808905444020', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(350672747792, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '293524132874', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(351711736146, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '939577003162', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(359690942245, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 512GB, 16GB Ram', 'Regent Street Campus', '154620582241', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(363488380285, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(390168627589, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(416413870665, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(434490388187, 'Macbook Pro 2023', 'Apple Macbook Pro, 15 inch, 2023, M2 Pro, 32GB RAM, 512GB, Grey', 'Marylebone Campus', '570052236274', 'Marylebone Laptops', '2024-03-03', 'Yes', 'Yes', '40'),
(445053620547, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '867456314743', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(447023044062, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '545982811262', 'Marylebone Laptops', '2024-03-03', 'Yes', 'Yes', '36'),
(452840438133, 'Macbook Pro 2019', 'Macbook Pro 2019, 13inch, grey, 500GB', 'Cavendish Campus', '449802685846', 'Cavendish Laptops', '2024-03-01', 'Yes', 'No', NULL),
(464643271038, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '700679448222', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(493900475805, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(502546210303, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(516375257292, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(523950545733, 'Macbook Pro 2023', 'Apple Macbook Pro, 15 inch, 2023, M2 Pro, 32GB RAM, 512GB, Grey', 'Marylebone Campus', '028070426797', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(531228450079, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '124733617462', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(534656499328, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(540448174335, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(546052882834, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '154453535236', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(552218380496, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(553195772018, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(557013906406, 'iMac', 'iMac 2021, Silver, 256GB', 'Cavendish Copeland G102', '326065774392', 'Copeland G102', '2024-03-01', 'No', 'No', NULL),
(566172922107, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '878964484710', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(575748633974, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '421188151954', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(577785751970, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '116386132181', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(579161546241, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '265032348399', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(588148140278, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '448707606469', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(590000414260, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(598551428712, 'iMac', 'iMac 2021, Silver, 256GB', 'Cavendish Copeland G102', '385358917839', 'Copeland G102', '2024-03-01', 'No', 'No', NULL),
(598877461221, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(609471008641, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(612942231065, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '321802647785', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(614913170738, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(623927265341, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '567588668596', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(638233505999, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '261320660553', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(645715130842, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(646167748313, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '318170553461', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(648866228586, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '774023291955', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(656479188263, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(658466193066, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 512GB, 16GB Ram', 'Regent Street Campus', '343793384222', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(662960092403, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(664124359910, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(664872665598, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(682366178339, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(683913461230, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(686448903965, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 512GB, 16GB Ram', 'Regent Street Campus', '120537981075', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(689565661149, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '442330649433', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(712995970676, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(734894994852, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '204469864130', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(744401249656, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(752876127176, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(764261366453, 'Macbook Pro 2023', 'Macbook Pro 2023, Grey, M2 Max, 1TB', 'Regent Street Campus', '885942620391', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(766341454846, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(770706259802, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '541338534793', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(790585071195, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 512GB, 16GB Ram', 'Regent Street Campus', '631841875190', 'Regent Street Laptops', '2024-03-01', 'Yes', 'Yes', '51'),
(792541798200, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(797808283913, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 1TB, 16GB Ram', 'Regent Street Campus', '411987654648', 'Regent Street Laptops', '2024-03-01', 'Yes', 'Yes', '39'),
(800061507808, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(813655107997, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '861536891374', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(818009203817, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '180794867619', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(820281404242, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '360202810603', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(828875643046, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '989253087111', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(832736736580, 'Macbook Air 2019', 'Macbook air retina 2019, grey, 256GB', 'Cavendish Campus', '490392680247', 'Cavendish Laptops', '2024-03-01', 'Yes', 'No', NULL),
(833179591424, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(845990248762, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(847999523622, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '467630013026', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(850067594309, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(859629700050, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(863849273386, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(869415401025, 'HP EliteOne 870', 'HP EliteOne 870, 27inch, i9, 32GB RAM, 1TB', 'Marylebone Campus', '396641402946', 'Marlyebone 2.102', '2024-03-01', 'No', 'No', NULL),
(873423214348, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(877132051600, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(878828636993, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(882297487872, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(883029480184, 'iMac', 'iMac 2021, Silver, 256GB', 'Cavendish Copeland G102', '937595141064', 'Copeland G102', '2024-03-01', 'No', 'No', NULL),
(888908744844, 'Optiplex Micro', 'Dell Optiplex Micro, i5, 16GB Ram, 512GB', 'Regent Street Campus', '488522760372', 'Regent 3.112', '2024-03-01', 'No', 'No', NULL),
(899829413258, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '174294913689', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(918514019204, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(928640890051, 'Dell XPS 14', 'Dell XPS 14 Laptop, 14inch, platinum, 512GB, 16GB Ram', 'Regent Street Campus', '242807419163', 'Regent Street Laptops', '2024-03-01', 'Yes', 'No', NULL),
(931061547552, 'ThinkPad P14s', 'Lenovo ThinkPad P14s,AMD Ryzen 5PRO, 16GB RAM, 256GB, Black', 'Marylebone Campus', '963377271802', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(938605891805, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(950372225645, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(963066751581, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(964825004300, 'Macbook Pro 2023', 'Apple Macbook Pro, 15 inch, 2023, M2 Pro, 32GB RAM, 512GB, Grey', 'Marylebone Campus', '552386001041', 'Marylebone Laptops', '2024-03-03', 'Yes', 'No', NULL),
(965292258716, 'iMac', 'iMac 2021, Silver, 256GB', 'Cavendish Copeland G102', '947721854750', 'Copeland G102', '2024-03-01', 'No', 'No', NULL),
(968411180572, 'Dell Precision 7875 Tower Workstation', 'Dell Precision 7875 Tower Workstation, AMD Threadripper 7935W, Nvidia T400, 32GB RAM, 512GB NVME', 'Cavendish Campus', '', 'Copeland 3.112', '2024-03-03', 'No', 'No', NULL),
(968811606842, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL),
(978505977515, 'HP Z2 G9 Tower Workstation', 'HP Z2 G9 Tower Workstation, i9, Nvidia RTX A4000, 32GB RAM, 2TB', 'Cavendish Campus', '269005715703', 'Cavendish 5.204', '2024-03-01', 'No', 'No', NULL),
(980064973436, 'iMac ', 'iMac2021, Silver, 256GB', 'Cavendish Copeland G102', '286692226788', 'Copeland G102', '2024-03-01', 'No', 'No', NULL),
(980256661264, 'Dell 4k Monitor S2721QSA', 'Dell 4k Monitor S2721QSA, 27inch, grey', 'Cavendish Campus', '', 'Cavendish 5.204', '2024-03-03', 'No', 'No', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_system_assets`
--
ALTER TABLE `inventory_system_assets`
  ADD PRIMARY KEY (`asset_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
