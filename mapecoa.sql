-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 05:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glamour`
--

-- --------------------------------------------------------

--
-- Table structure for table `anniversary`
--

CREATE TABLE `anniversary` (
  `id` int(100) NOT NULL,
  `user_id` int(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `guest_number` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `theme_design` varchar(100) NOT NULL,
  `extra_services` varchar(100) NOT NULL,
  `other_preferences` text NOT NULL,
  `upcoming_age` int(100) NOT NULL,
  `celeb_gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `receipt_id` varchar(255) NOT NULL,
  `billing_id` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `ref_num` varchar(255) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `dppayment` int(100) NOT NULL,
  `fppayment` int(100) NOT NULL,
  `date` varchar(255) NOT NULL,
  `mop` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `dpstatus` varchar(255) NOT NULL,
  `fpstatus` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE `birthday` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `upcoming_age` int(100) NOT NULL,
  `celeb_gender` varchar(50) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `guest_number` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `theme_design` varchar(100) NOT NULL,
  `extra_services` varchar(255) NOT NULL,
  `other_preferences` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `emailadd` varchar(100) NOT NULL,
  `bookdate` date NOT NULL,
  `weektype` varchar(100) NOT NULL,
  `event` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `downpayment` int(100) NOT NULL,
  `venueprice` int(100) NOT NULL,
  `cuisineprice` int(100) NOT NULL,
  `styleprice` int(100) NOT NULL,
  `serviceprice` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `coordinator_1` varchar(100) NOT NULL,
  `coordinator_2` varchar(100) NOT NULL,
  `coordinator_3` varchar(100) NOT NULL,
  `coordinator_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `christening`
--

CREATE TABLE `christening` (
  `id` int(100) NOT NULL,
  `user_id` int(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `celeb_gender` varchar(50) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `guest_number` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `theme_design` varchar(100) NOT NULL,
  `extra_services` varchar(255) NOT NULL,
  `other_preferences` text NOT NULL,
  `upcoming_age` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporate`
--

CREATE TABLE `corporate` (
  `id` int(100) NOT NULL,
  `user_id` int(255) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `guest_number` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `theme_design` varchar(100) NOT NULL,
  `extra_services` varchar(100) NOT NULL,
  `other_preferences` text NOT NULL,
  `upcoming_age` int(100) NOT NULL,
  `celeb_gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(100) NOT NULL,
  `price_name` varchar(100) NOT NULL,
  `price_topic` varchar(100) NOT NULL,
  `price_guestnum` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `price_event` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `price_name`, `price_topic`, `price_guestnum`, `price`, `price_event`) VALUES
(1, 'Normal', 'Cuisine', '1-50', 42500, ''),
(2, 'Normal', 'Cuisine', '51-100', 85000, ''),
(3, 'Normal', 'Cuisine', '101-200', 170000, ''),
(4, 'Normal', 'Cuisine', '201-300', 255000, ''),
(5, 'Deluxe', 'Cuisine', '1-50', 47500, ''),
(6, 'Deluxe', 'Cuisine', '51-100', 95000, ''),
(7, 'Deluxe', 'Cuisine', '101-200', 190000, ''),
(8, 'Deluxe', 'Cuisine', '201-300', 285000, ''),
(9, 'Royal', 'Cuisine', '1-50', 52500, ''),
(10, 'Royal', 'Cuisine', '51-100', 105000, ''),
(11, 'Royal', 'Cuisine', '101-200', 201000, ''),
(12, 'Royal', 'Cuisine', '201-300', 315000, ''),
(13, 'Basic', 'Style', '1-50', 15000, 'Wedding '),
(14, 'Basic', 'Style', '51-100', 25000, 'Wedding '),
(15, 'Basic', 'Style', '101-200', 45000, 'Wedding '),
(16, 'Basic', 'Style', '201-300', 80000, 'Wedding '),
(17, 'Sleek', 'Style', '1-50', 40000, 'Wedding '),
(18, 'Sleek', 'Style', '51-100', 70000, 'Wedding '),
(19, 'Sleek', 'Style', '101-200', 120000, 'Wedding '),
(20, 'Sleek', 'Style', '201-300', 200000, 'Wedding '),
(21, 'Polished', 'Style', '1-50', 120000, 'Wedding '),
(22, 'Polished', 'Style', '51-100', 240000, 'Wedding '),
(23, 'Polished', 'Style', '101-200', 300000, 'Wedding '),
(24, 'Polished', 'Style', '201-300', 420000, 'Wedding '),
(25, 'Basic', 'Style', '1-50', 15000, 'Birthday'),
(26, 'Basic', 'Style', '51-100', 20000, 'Birthday'),
(27, 'Basic', 'Style', '101-200', 40000, 'Birthday'),
(28, 'Basic', 'Style', '201-300', 75000, 'Birthday'),
(29, 'Sleek', 'Style', '1-50', 20000, 'Birthday'),
(30, 'Sleek', 'Style', '51-100', 30000, 'Birthday'),
(31, 'Sleek', 'Style', '101-200', 60000, 'Birthday'),
(32, 'Sleek', 'Style', '201-300', 90000, 'Birthday'),
(33, 'Polished', 'Style', '1-50', 100000, 'Birthday'),
(34, 'Polished', 'Style', '51-100', 180000, 'Birthday'),
(35, 'Polished', 'Style', '101-200', 300000, 'Birthday'),
(36, 'Polished', 'Style', '201-300', 400000, 'Birthday'),
(37, 'Basic', 'Style', '1-50', 8000, 'Christening'),
(38, 'Basic', 'Style', '51-100', 15000, 'Christening'),
(39, 'Basic', 'Style', '101-200', 25000, 'Christening'),
(40, 'Basic', 'Style', '201-300', 40000, 'Christening'),
(41, 'Sleek', 'Style', '1-50', 12000, 'Christening'),
(42, 'Sleek', 'Style', '51-100', 18000, 'Christening'),
(43, 'Sleek', 'Style', '101-200', 25000, 'Christening'),
(44, 'Sleek', 'Style', '201-300', 45000, 'Christening'),
(45, 'Polished', 'Style', '1-50', 15000, 'Christening'),
(46, 'Polished', 'Style', '51-100', 25000, 'Christening'),
(47, 'Polished', 'Style', '101-200', 40000, 'Christening'),
(48, 'Polished', 'Style', '201-300', 70000, 'Christening'),
(49, 'Basic', 'Style', '1-50', 8000, 'Anniversary'),
(50, 'Basic', 'Style', '51-100', 15000, 'Anniversary'),
(51, 'Basic', 'Style', '101-200', 25000, 'Anniversary'),
(52, 'Basic', 'Style', '201-300', 40000, 'Anniversary'),
(53, 'Sleek', 'Style', '1-50', 25000, 'Anniversary'),
(54, 'Sleek', 'Style', '51-100', 40000, 'Anniversary'),
(55, 'Sleek', 'Style', '101-200', 70000, 'Anniversary'),
(56, 'Sleek', 'Style', '201-300', 100000, 'Anniversary'),
(57, 'Polished', 'Style', '1-50', 150000, 'Anniversary'),
(58, 'Polished', 'Style', '51-100', 300000, 'Anniversary'),
(59, 'Polished', 'Style', '101-200', 350000, 'Anniversary'),
(60, 'Polished', 'Style', '201-300', 400000, 'Anniversary'),
(61, 'Basic', 'Style', '1-50', 8000, 'Corporate'),
(62, 'Basic', 'Style', '51-100', 15000, 'Corporate'),
(63, 'Basic', 'Style', '101-200', 25000, 'Corporate'),
(64, 'Basic', 'Style', '201-300', 40000, 'Corporate'),
(65, 'Sleek', 'Style', '1-50', 12000, 'Corporate'),
(66, 'Sleek', 'Style', '51-100', 18000, 'Corporate'),
(67, 'Sleek', 'Style', '101-200', 25000, 'Corporate'),
(68, 'Sleek', 'Style', '201-300', 45000, 'Corporate'),
(69, 'Polished', 'Style', '1-50', 30000, 'Corporate'),
(70, 'Polished', 'Style', '51-100', 45000, 'Corporate'),
(71, 'Polished', 'Style', '101-200', 75000, 'Corporate'),
(72, 'Polished', 'Style', '201-300', 160000, 'Corporate'),
(73, 'Photographer', 'Extra Services', '', 3999, ''),
(74, 'Videographer', 'Extra Services', '', 4000, ''),
(75, 'DJ Services', 'Extra Services', '', 5000, ''),
(76, 'Emcee', 'Extra Services', '', 25000, ''),
(77, 'Makeup Artist', 'Extra Services', '', 2500, ''),
(78, 'Bar Area', 'Extra Services', '', 11500, ''),
(79, 'Invitation Cards', 'Extra Services', '', 3000, ''),
(87, 'None', '', '1-50', 0, 'Wedding '),
(88, 'None', '', '51-100', 0, 'Wedding '),
(89, 'None', '', '101-200', 0, 'Wedding '),
(90, 'None', '', '201-300', 0, 'Wedding '),
(95, 'None', '', '1-50', 0, 'Birthday'),
(96, 'None', '', '51-100', 0, 'Birthday'),
(97, 'None', '', '101-200', 0, 'Birthday'),
(98, 'None', '', '201-300', 0, 'Birthday'),
(99, 'None', '', '1-50', 0, 'Christening'),
(100, 'None', '', '51-100', 0, 'Christening'),
(101, 'None', '', '101-200', 0, 'Christening'),
(102, 'None', '', '201-300', 0, 'Christening'),
(103, 'None', '', '1-50', 0, 'Anniversary'),
(104, 'None', '', '51-100', 0, 'Anniversary'),
(105, 'None', '', '101-200', 0, 'Anniversary'),
(106, 'None', '', '201-300', 0, 'Anniversary'),
(107, 'None', '', '1-50', 0, 'Corporate'),
(108, 'None', '', '51-100', 0, 'Corporate'),
(109, 'None', '', '101-200', 0, 'Corporate'),
(110, 'None', '', '201-300', 0, 'Corporate'),
(111, 'None', 'Extra Services', '', 0, ''),
(112, 'None', 'Extra Services', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(100) NOT NULL,
  `theme_name` varchar(100) NOT NULL,
  `theme_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `theme_name`, `theme_type`) VALUES
(1, 'Bohemian', 'Birthday'),
(2, 'Fairytale', 'Birthday'),
(3, 'Modern', 'Birthday'),
(4, 'Tropical Party', 'Birthday'),
(5, 'Retro', 'Birthday'),
(6, 'Costume', 'Birthday'),
(7, 'Garden Party', 'Christening'),
(8, 'Vintage Tea Party', 'Christening'),
(9, 'Fairytale Party', 'Christening'),
(10, 'Beach Party', 'Christening'),
(11, 'Rustic Barn Party', 'Christening'),
(12, 'Disney Theme', 'Christening'),
(13, 'Beach', 'Wedding'),
(14, 'Garden', 'Wedding'),
(15, 'Modern', 'Wedding'),
(16, 'Vintage', 'Wedding'),
(17, 'Rustic', 'Wedding'),
(18, 'Fairytale', 'Wedding'),
(19, 'Hollywood Glamour', 'Corporate'),
(20, 'Costume Party', 'Corporate'),
(21, 'Sports-themed Event', 'Corporate'),
(22, 'Black and White Ball', 'Corporate'),
(23, 'Vintage Chic', 'Corporate'),
(24, 'Masquerade Ball', 'Corporate'),
(25, 'Vintage', 'Anniversary'),
(26, 'Garden', 'Anniversary'),
(27, 'Masquerade Ball', 'Anniversary'),
(28, 'Travel', 'Anniversary'),
(29, 'Hollywood Glamour', 'Anniversary'),
(30, 'Rustic Chic', 'Anniversary');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reset_token` text DEFAULT NULL,
  `token_expired` date DEFAULT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `firstname`, `lastname`, `email`, `address`, `phone`, `user_status`, `password`, `reset_token`, `token_expired`, `verify_token`, `verify_status`) VALUES
(32, 500096020258, 'Glamour Team', 'Joervy', 'Sanchez', 'admin@a.com', '', '', 'Admin', '$2y$10$Qb0xVrtMW0neQeFlJ6/nW.Froh.uSZCeUxLbUJfRkPtmPH5ewpwNm', NULL, NULL, '', 1),
(33, 365175434, 'Luxx Venue Co.', 'Cyreene', 'Genova', 'venue@v.com', '', '', 'Venue Coordinator', '$2y$10$5rMH4E33PGZE9zRsiN1nmODWoM09GFilGcHEBNXivxAckrzG/3HgK', NULL, NULL, '', 1),
(34, 760246340624, 'REM Styles', 'Ariz', 'Salazar', 'style@s.com', '', '', 'Style Coordinator', '$2y$10$lRn4eNvxKWXuxHTjWtFjpeS4j4.uMh/uxxmACAtU6eT7HYviW5yF6', NULL, NULL, '', 1),
(35, 855716676347721335, 'Dons Talent Agency', 'Elnard', 'Vallejo', 'extra@e.com', '', '', 'Extra Services Coordinator', '$2y$10$hf7VzSDD/V5QpXd3Aeyu1.lSA5Og7mA0h3JbRYcl.K.uek1OYqMoC', NULL, NULL, '', 1),
(37, 75551244, 'Sour Catering', 'Glaidelyn', 'Cabalsi', 'catering@c.com', '', '', 'Catering Coordinator', '$2y$10$2q.XJC8ZfNLgnylGvAqm/.egAkdHVrpfoywKn7AmT/KWEFuRE8Bcu', NULL, NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(100) NOT NULL,
  `venuename` varchar(50) NOT NULL,
  `venuetype` varchar(50) NOT NULL,
  `venueaddress` varchar(255) NOT NULL,
  `venueimg` varchar(255) NOT NULL,
  `venuepano` varchar(255) NOT NULL,
  `weekday` int(100) NOT NULL,
  `weekend` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `venuename`, `venuetype`, `venueaddress`, `venueimg`, `venuepano`, `weekday`, `weekend`) VALUES
(1, 'The Emerald Events Place', 'Wedding', 'Antipolo, Rizal', 'wedding-venue1.jpg', 'https://shorturl.ac/7aw4h', 190000, 190000),
(2, 'The Mango Farm Events Place', 'Wedding', 'Cainta, Rizal', 'wedding-venue2.jpg', 'https://shorturl.ac/7aw4i', 99500, 99500),
(3, 'Lihim ng Kubli', 'Wedding', 'Indang, Cavite', 'wedding-venue3.jpg', 'https://shorturl.ac/7aw4k', 150000, 150000),
(4, 'Versailles Palace', 'Wedding', 'Almanza Dos, Las Piñas', 'wedding-venue4.jpg', 'https://shorturl.ac/7aw4m', 55000, 55000),
(5, 'The Madisons Events Place', 'Wedding', 'Cupang, Muntinlupa', 'wedding-venue5.jpg', 'https://shorturl.ac/7aw4n', 40000, 40000),
(7, 'Paradisso Terrestre', 'Birthday', 'Bacoor, Cavite', 'birthday-venue1.jpg', 'https://shorturl.ac/7aw4o', 40000, 50000),
(8, 'Glass Garden', 'Birthday', 'Evangelista Ave, Pasig', 'birthday-venue2.jpg', 'https://shorturl.ac/7aw4q', 110000, 140000),
(9, 'Versailles Palace', 'Birthday', 'Almanza Dos, Las Piñas', 'birthday-venue3.jpg', 'https://shorturl.ac/7aw4m', 45000, 45000),
(10, 'Fernwood Gardens', 'Birthday', 'Quezon City, Metro Manila', 'birthday-venue4.jpg', 'https://shorturl.ac/7aw4s', 145000, 145000),
(11, 'The Emerald Events Place', 'Birthday', 'Antipolo, Rizal', 'birthday-venue5.jpg', 'https://shorturl.ac/7aw4h', 130000, 130000),
(13, 'The Green Lounge', 'Christening', 'Greenhills, San Juan', 'christening-venue1.jpg', 'https://shorturl.ac/7aw4u', 75000, 85000),
(14, 'Sitio Elena', 'Christening', 'Cainta, Rizal', 'christening-venue2.jpg', 'https://shorturl.ac/7aw4v', 120000, 120000),
(15, 'Patio de Manila', 'Christening', 'Malate, Manila', 'christening-venue3.jpg', 'https://shorturl.ac/7aw4w', 35000, 35000),
(16, 'Sedretos Royale', 'Christening', 'Marikina, Metro Manila', 'christening-venue4.jpg', 'https://shorturl.ac/7aw4x', 35000, 35000),
(17, 'The Forest Barn', 'Christening', 'Magallanes, Cavite', 'christening-venue5.jpg', 'https://shorturl.ac/7aw4y', 80000, 80000),
(19, 'Lihim ng Kubli', 'Anniversary', 'Indang, Cavite', 'anniversary-venue1.jpg', 'https://shorturl.ac/7aw4k', 50000, 50000),
(26, 'The Green Lounge', 'Anniversary', 'Greenhills, San Juan', 'anniversary-venue2.jpg', 'https://shorturl.ac/7aw4z', 50000, 60000),
(27, 'Nuevo Comienzo Resort', 'Anniversary', 'Silang, Cavite', 'anniversary-venue3.jpg', 'https://shorturl.ac/7aw50', 25000, 25000),
(28, 'The Silica Events Place', 'Anniversary', 'Paranaque, Metro Manila', 'anniversary-venue4.jpg', 'https://shorturl.ac/7aw51', 30000, 30000),
(29, 'Fernwood Gardens', 'Anniversary', 'Quezon City, Metro Manila', 'anniversary-venue5.jpg', 'https://shorturl.ac/7aw4s', 175000, 175000),
(31, 'The Circle Events Place', 'Corporate', 'Quezon City, Metro Manila', 'corporate-venue1.jpg', 'https://shorturl.ac/7aw52', 47000, 47000),
(32, 'Lihim ng Kubli', 'Corporate', 'Indang, Cavite', 'corporate-venue2.jpg', 'https://shorturl.ac/7aw4k', 150000, 150000),
(33, 'One Grand Pavillion', 'Corporate', 'Malolos, Bulacan', 'corporate-venue3.jpg', 'https://shorturl.ac/7aw55', 45000, 45000),
(34, 'Paradisso Terrestre', 'Corporate', 'Bacoor, Cavite', 'corporate-venue4.jpg', 'https://shorturl.ac/7aw4o', 60000, 70000),
(35, 'Josephine Events', 'Corporate', 'Kawit, Cavite', 'corporate-venue5.jpg', 'https://shorturl.ac/7aw56', 58000, 58000),
(41, 'None', 'Wedding', '', '', '', 0, 0),
(42, 'None', 'Birthday', '', '', '', 0, 0),
(43, 'None', 'Christening', '', '', '', 0, 0),
(44, 'None', 'Anniversary', '', '', '', 0, 0),
(45, 'None', 'Corporate', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `id` int(100) NOT NULL,
  `user_id` int(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `guest_number` varchar(100) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `theme_design` varchar(100) NOT NULL,
  `extra_services` varchar(100) NOT NULL,
  `other_preferences` text NOT NULL,
  `upcoming_age` int(100) NOT NULL,
  `celeb_gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anniversary`
--
ALTER TABLE `anniversary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `christening`
--
ALTER TABLE `christening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporate`
--
ALTER TABLE `corporate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding`
--
ALTER TABLE `wedding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anniversary`
--
ALTER TABLE `anniversary`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `birthday`
--
ALTER TABLE `birthday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `christening`
--
ALTER TABLE `christening`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `corporate`
--
ALTER TABLE `corporate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `wedding`
--
ALTER TABLE `wedding`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
