-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2024 at 12:19 PM
-- Server version: 8.0.39-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affiliate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `token`) VALUES
(1, 'avenger@gmail.com', 'avenger', '27744798785965950');

-- --------------------------------------------------------

--
-- Table structure for table `aff`
--

CREATE TABLE `aff` (
  `id` int NOT NULL,
  `tgid` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varbinary(250) NOT NULL,
  `photo` varchar(2555) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postback` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aff`
--

INSERT INTO `aff` (`id`, `tgid`, `name`, `photo`, `token`, `upi`, `postback`, `status`) VALUES
(8, '1350180264', 0x43617368204c616e64, 'https://t.me/i/userpic/320/vncD3LDk5f4sXyzH7ygb1x2PLZBg0kLo_vo0aJ_FrF8.jpg', '2209662c0dee2cbcbc7a33c2e19b8891e694331dfb3dde2b7f4b7a8c3a8c1298', 'Devildp@upi', '', 'Active'),
(7, '1516610662', 0xf09d9a84f09d9a97f09d9a94f09d9a97f09d9a98f09d9aa0f09d9a9720f09d99b2f09d9a98f09d9a8df09d9a8ef09d9a9b, 'https://t.me/i/userpic/320/vZko0rWZ_DrUrXWG8J4Z6vAIV7TQkWDzQjlOdVAxfDE.jpg', '61701dd72f57c26f9a19bda36e499f80ed0998375ddc708ef97f946b180885ff', '', 'https://Fastback/test/hue', 'Active'),
(9, '5161495874', 0xf09d9794f09d97bbf09d97b6f09d97b8f09d97b2f09d988120f09d9796f09d97bcf09d97b1f09d97b2f09d97bf207c7c20f09d9795f09d9882f09d9880f09d9886, 'https://t.me/i/userpic/320/bY3RF0XC2vrI5XhRbggP2S16wbZELYttHQp4xDGjraWxUK4Dfckh3xR4H9voXi7u.jpg', '9ab630da5dc1bd86f52c157b7b4910fbcdb77d254aa576410a275e59611d589e', '', '', 'Active'),
(10, '6290531180', 0x4d616e75, 'https://t.me/i/userpic/320/8pdbKuH7WFu6GxxKbEJ2oF_K-x2kaafgZut4E4cUzCMCuzUGf0_ts4w9FEbsU1DA.jpg', '99e44934b522320a56c9d23f2c7540b128f14723500373cb564c61af7aa613db', '', '', 'Active'),
(11, '6420298804', 0xf09d9093f09d909ef09d909cf09d90a1f09d90a7f09d90a2f09d909cf09d909af09d90a520f09d9087f09d909af09d909cf09d90a4f09d909ef09d90ab205b20f09d9092f09d90aef09d90a9f09d90a9f09d90a8f09d90abf09d90ad205d, 'https://t.me/i/userpic/320/bUrLSBgkgNifcQByeJ7zDz0IEIxSIefpsYTkcJOorLkrTKcvv7qZgsvtn_uarxkg.jpg', '72e74e381a0eef6dae4622cd0b7ef21aaee60cee46f2ff9e9428cf13cd9e0783', '', '', 'Active'),
(12, '6043181314', 0xf09f929e54ca9ce1b4872052e1b48778, 'https://t.me/i/userpic/320/wcWnVTT1fn86QK0kapw-OK-NKE2yO-4mdASrOa86IHygIJBNwJ0tqgAWloPqEdsj.jpg', '916c94883c3427296124d148da33322d309d22c403b01b1e3356604f73f03873', '', '', 'Active'),
(13, '7391497133', 0x436f646572, 'https://t.me/i/userpic/320/yKCiZAEz0rsWE5UzYTCkhTeliGhuHXn5LhPWp8LT2yVK8d-AdCdQZGS7x6Oiex8Z.jpg', '69113710c4301c426599b34784518f838fd966c053a3753ec79ddd7dd1a12858', '', 'https://fastback.in/aff/c?o=40&a=13&aff_click_id={aff_click_id}&sub_aff_id={sub_aff_id}', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `balert`
--

CREATE TABLE `balert` (
  `user` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `tg` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balert`
--

INSERT INTO `balert` (`user`, `id`, `tg`) VALUES
('9895857176', '5553275202:AAFn76eHeQNpklSOg5bFLqG_13c7v_Ny1G0', '1442176965'),
('9679790152', '5571846902:AAECdRmuP6ZSp60FXqua1wIQ0NPvB7ffBQo', '1809269041');

-- --------------------------------------------------------

--
-- Table structure for table `conversions`
--

CREATE TABLE `conversions` (
  `id` int NOT NULL,
  `tid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `aff_click_id` varchar(200) NOT NULL,
  `sub_aff_id` varchar(200) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `offerid` varchar(200) NOT NULL,
  `userid` varchar(200) NOT NULL,
  `lead` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `conversions`
--

INSERT INTO `conversions` (`id`, `tid`, `aff_click_id`, `sub_aff_id`, `ip`, `offerid`, `userid`, `lead`, `date`) VALUES
(3, 'bccd0a54-7693-11ef-8e78-0a62d3774457', '7483297725', '6362104350', '162.158.162.112', '39', '7', '1', '2024-09-19'),
(4, 'e2958409-7693-11ef-8e78-0a62d3774457', '7483297725', '6362104350', '108.162.226.209', '39', '7', '0', '2024-09-19'),
(5, 'be639fc2-7747-11ef-8e78-0a62d3774457', '019284774', '9098652196', '172.69.222.96', '40', '13', '0', '2024-09-20'),
(6, '2766784d-7748-11ef-8e78-0a62d3774457', '{aff_click_id}', '{sub_aff_id}', '162.158.162.41', '40', '7', '0', '2024-09-20'),
(7, '1fbd6ec3-7749-11ef-8e78-0a62d3774457', '{aff_click_id}', '{sub_aff_id}', '172.71.124.88', '40', '10', '0', '2024-09-20'),
(8, '37563364-7749-11ef-8e78-0a62d3774457', '{aff_click_id}', '{sub_aff_id}', '162.158.189.112', '40', '10', '0', '2024-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int NOT NULL,
  `offerid` int NOT NULL,
  `userid` varchar(2000) NOT NULL,
  `name` varchar(200) NOT NULL,
  `leads` varchar(2000) NOT NULL,
  `amount` varchar(10000) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `offerid`, `userid`, `name`, `leads`, `amount`, `status`) VALUES
(10, 37, '1', 'Gonezap', '2', '14', 'success'),
(11, 37, '1', 'Gonezap', '2', '14', 'failed'),
(12, 37, '1', 'Gonezap', '2', '14', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `payout` varchar(200) NOT NULL,
  `d_event` varchar(200) NOT NULL,
  `event` varchar(200) NOT NULL,
  `caps` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `name`, `model`, `link`, `category`, `payout`, `d_event`, `event`, `caps`) VALUES
(40, 'Lemonn', 'CPT', 'https://pdg.gotrackier.com/click?campaign_id=633&pub_id=1239&p1={tid}', 'Trade', '300', 'h0ujuw', 'vds4t4', '50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aff`
--
ALTER TABLE `aff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversions`
--
ALTER TABLE `conversions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aff`
--
ALTER TABLE `aff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `conversions`
--
ALTER TABLE `conversions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
