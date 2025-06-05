-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2025 at 05:05 AM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dctregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(111) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'dctconadmin', 'admin@dctcon');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `place` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mci` varchar(100) NOT NULL,
  `state` text DEFAULT NULL,
  `meal` varchar(50) NOT NULL,
  `reg_for` varchar(100) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `name`, `category`, `place`, `mobile`, `email`, `mci`, `state`, `meal`, `reg_for`, `payment`, `image`, `registration_date`) VALUES
(1, 'Dr.Muthumani', 'Doctor', 'Lalgudi', '9884360161', 'drmuthumani@yahoo.co.in', '74438', 'Tamilnadu', 'Veg', '', '', '../adminpanel/payments/67f3a6f18d991.jpg', '2025-04-07 10:20:33'),
(2, 'Boobalan prabakaran', 'Doctor', 'Thuraiyur ', '9003791239', 'drboobalan@gmail.com', '83057', 'Tamilnadu ', 'Non-Veg', '', '', '../adminpanel/payments/67f4df3e85d50.jpeg', '2025-04-08 08:33:02'),
(3, 'Gregory', 'Doctor', 'Kallakudi', '9442264832', 'giri_jarvis2005@yahoo.com', '60119', 'Tamilnadu', 'Non-Veg', '', '', '../adminpanel/payments/68067e1ac86cf.jpg', '2025-04-21 17:19:22'),
(4, 'Rishi ', 'Student', 'Trichy ', '8870524100', 'rishi7viji@gmail.com', '176901', 'Tamil Nadu', 'Non-Veg', '', '', '../adminpanel/payments/68068361a12a9.png', '2025-04-21 17:41:53'),
(5, 'Vijayakumar', 'Doctor', 'Thuraiyur', '9842444036', 'annaiviji@gmail.com', '44710', 'Tamil Nadu', 'Non-Veg', '', '', '../adminpanel/payments/680683c898ce7.png', '2025-04-21 17:43:36'),
(7, 'Dr M Shunmugavelu', 'Doctor', 'Tiruchirappalli', '09843178131', 'msv_diab@yahoo.com', '32905', 'TAMILNADU', 'Non-Veg', '', '', '../adminpanel/payments/6807b119a6f25.jpeg', '2025-04-22 15:09:13'),
(8, 'Chandramohan Marudhai', 'Doctor', 'Thuraiyur ', '09894045036', 'drcmkalai@gmail.com', '46076', 'Tamil Nadu', 'Non-Veg', '', '', '../adminpanel/payments/680ccb55c566c.png', '2025-04-26 12:02:29'),
(9, 'Kowsalya', 'Doctor', 'Trichy', '+19786346826', 'kowsalyaannadurai98@gmail.com', 'PGM 1478', 'Tamilnadu', 'Non-Veg', '', '', '../adminpanel/payments/680cd2489e651.jpg', '2025-04-26 12:32:08'),
(11, 'Ramesh Ramanathan', 'Doctor', 'Trichy ', '09443354273', 'ramji.rmmc@gmail.com', '31402', 'Tamil Nadu', 'Veg', '', '', '../adminpanel/payments/680ee77f81cec.jpg', '2025-04-28 02:27:11'),
(12, 'N.RAJASEKARAN', 'Doctor', 'Perambalur ', '9842488088', 'drnrajasekaranmd@gmail.com', '40444', 'Tamilnadu', 'Non-Veg', '', '', '../adminpanel/payments/680eeb8d35048.png', '2025-04-28 02:44:29'),
(13, 'Thameena Dhasneem.M', 'Doctor', 'Trichy', '7904607650', 'thameenadhasneem@gmail.com', '134301', '134301', 'Veg', '', '', '../adminpanel/payments/6810654171863.png', '2025-04-29 05:36:01'),
(14, 'Dr ML Balamurugan ', 'Doctor', 'Trichy ', '9443354050', 'mlbtdsc@gmail.com', '39130', 'Tamilnadu', 'Non-Veg', '', '', '../adminpanel/payments/681072ee139ad.jpg', '2025-04-29 06:34:22'),
(15, 'Jayasree Ramesh ', 'Doctor', 'Trichy', '9443354732', 'lalgudi.rmmc@gmail.com', '37151', 'Tamil nadu', 'Veg', '', '', '../adminpanel/payments/681313ac098f7.jpg', '2025-05-01 06:24:44'),
(16, 'Dr.Sunredharababu', 'Doctor', 'Sriragam', '9442642712', 'drgsbabu@gmail.com', '31407', 'Tamilnadu ', 'Veg', '', '', '../adminpanel/payments/681452bbc1f17.jpg', '2025-05-02 05:06:03'),
(17, 'Dr.JC sekar', 'Doctor', 'Vadamadurai ', '9486278568', 'sekarjc59@gmail.com', '35876', 'Tamilnadu ', 'Veg', '', '', '../adminpanel/payments/68145424aa471.jpg', '2025-05-02 05:12:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
