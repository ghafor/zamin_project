-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2019 at 04:00 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `criminal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_persian_ci NOT NULL,
  `level` tinyint(1) NOT NULL,
  `image_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`, `level`, `image_name`) VALUES
(1, 'غفور', 'یعقوبی', 'admin', '88360dfa8826c449351cc7ef079aca1d', 1, '1544713757'),
(17, 'رحمت', 'یوسفی', 'rahmat', '88360dfa8826c449351cc7ef079aca1d', 2, '1545466015'),
(18, 'Admin', 'Admin', 'admin', '9411d8d4eea6d16cfa76571aec288255', 1, '1546758164');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `user_id` int(11) NOT NULL,
  `document_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`user_id`, `document_name`) VALUES
(3, '1550944762'),
(3, '15509447621'),
(3, '1550944791'),
(3, '1554649866'),
(3, '1554649876');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(10) NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `father_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `grand_father_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_persian_ci NOT NULL DEFAULT 'male',
  `reason` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `event_type` varchar(128) COLLATE utf8mb4_persian_ci NOT NULL,
  `place` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `date` date NOT NULL,
  `wakil` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `p_province` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `p_district` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `p_village` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `t_province` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `t_nahiya` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `t_gozar` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `related_employee_name` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `related_employee_number` varchar(64) COLLATE utf8mb4_persian_ci NOT NULL,
  `result` varchar(256) COLLATE utf8mb4_persian_ci NOT NULL,
  `person_image_name` varchar(128) COLLATE utf8mb4_persian_ci NOT NULL,
  `ssn` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `first_name`, `father_name`, `grand_father_name`, `gender`, `reason`, `event_type`, `place`, `date`, `wakil`, `p_province`, `p_district`, `p_village`, `t_province`, `t_nahiya`, `t_gozar`, `related_employee_name`, `related_employee_number`, `result`, `person_image_name`, `ssn`) VALUES
(3, 'بیکار', 'منتبی', 'lkj', 'male', '', 'مینشسبت', 'یسمشبنت', '2019-02-23', 'احمد', '', 'یسمبنت', 'منت', '', '', '', '', '', '', '1550944755', 234234),
(4, 'ali', 'منتبی', 'رضا', 'male', '', '', '', '2019-02-23', '', '', '', '', '', '', '', '', '', '', '1550944879', 12121212),
(5, 'ali', 'منتبی', 'رضا', 'male', '', '', '', '2019-02-23', '', '', '', '', '', '', '', '', '', '', '1550944904', 0),
(6, '', '', '', 'male', '', '', '', '0621-02-17', '', '', '', '', '', '', '', '', '', '', '1555256323', 0),
(7, '', '', '', 'male', '', '', '', '0621-02-17', '', '', '', '', '', '', '', '', '', '', '1555256337', 0),
(8, '', '', '', 'male', '', '', '', '0621-02-17', '', '', '', '', '', '', '', '', '', '', '1555256347', 0),
(9, '', '', '', 'male', '', '', '', '0621-02-17', '', '', '', '', '', '', '', '', '', '', '1555256356', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilage`
--

CREATE TABLE `privilage` (
  `user_id` int(10) NOT NULL,
  `read_person` tinyint(1) NOT NULL DEFAULT '1',
  `write_person` tinyint(1) NOT NULL DEFAULT '0',
  `delete_person` tinyint(1) NOT NULL DEFAULT '0',
  `add_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilage`
--

INSERT INTO `privilage` (`user_id`, `read_person`, `write_person`, `delete_person`, `add_admin`) VALUES
(1, 1, 1, 1, 1),
(17, 1, 0, 0, 0),
(18, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recover`
--

CREATE TABLE `recover` (
  `user_id` int(11) NOT NULL,
  `pin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `recover`
--

INSERT INTO `recover` (`user_id`, `pin`) VALUES
(1, 12345);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `name` varchar(256) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilage`
--
ALTER TABLE `privilage`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recover`
--
ALTER TABLE `recover`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privilage`
--
ALTER TABLE `privilage`
  ADD CONSTRAINT `privilage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recover`
--
ALTER TABLE `recover`
  ADD CONSTRAINT `recover_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
