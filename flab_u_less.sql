-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 03:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flab_u_less`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `attendance_type` varchar(255) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `member_id`, `check_in`, `attendance_type`, `reference_id`) VALUES
(401, 1, '2022-01-10 07:50:00', 'Class', 101),
(402, 2, '2022-06-18 15:50:00', 'Personal Training', 202),
(403, 3, '2022-02-14 09:50:00', 'Class', 103),
(404, 4, '2022-03-21 16:50:00', 'Personal Training', 204),
(405, 5, '2022-04-22 11:50:00', 'Personal Training', 205);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_type` varchar(255) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `member_id`, `booking_date`, `booking_type`, `reference_id`, `status`) VALUES
(1, 1, '2022-01-03', 'Class', 101, 'Booked'),
(2, 2, '2022-06-17', 'Personal Training', 102, 'Cancelled'),
(3, 3, '2022-02-03', 'Facility Reservation', 301, 'Booked'),
(4, 4, '2022-03-03', 'Class', 102, 'Booked'),
(5, 5, '2022-04-03', 'Personal Training', 202, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `instructor` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `instructor`, `start_time`, `end_time`, `max_participants`) VALUES
(101, 'Yoga Basics', 'Alice Johnson', '2022-01-10 08:00:00', '2022-01-10 09:00:00', 20),
(102, 'Advanced Cycling', 'Bob Brown', '2022-01-11 17:00:00', '2022-01-11 18:30:00', 15),
(103, 'Strength Training', 'Daniel Grey', '2022-02-14 10:00:00', '2022-02-14 11:00:00', 10),
(104, 'Pilates Beginner', 'Eva Black', '2022-03-15 14:00:00', '2022-03-15 15:00:00', 12),
(105, 'Kickboxing', 'Frank White', '2022-04-16 18:00:00', '2022-04-16 19:30:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `facility_reservation`
--

CREATE TABLE `facility_reservation` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `reserved_from` datetime DEFAULT NULL,
  `reserved_to` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_reservation`
--

INSERT INTO `facility_reservation` (`id`, `facility_name`, `reserved_from`, `reserved_to`) VALUES
(301, 'Tennis Court', '2022-01-13 13:00:00', '2022-01-13 15:00:00'),
(302, 'Squash Court', '2022-06-19 09:00:00', '2022-06-19 10:00:00'),
(303, 'Basketball Court', '2022-02-23 16:00:00', '2022-02-23 18:00:00'),
(304, 'Swimming Pool', '2022-03-24 10:00:00', '2022-03-24 12:00:00'),
(305, 'Volleyball Court', '2022-04-25 14:00:00', '2022-04-25 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `membership_status` varchar(255) DEFAULT NULL,
  `payment_info` varchar(255) DEFAULT NULL,
  `communication_preferences` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `phone`, `join_date`, `membership_status`, `payment_info`, `communication_preferences`, `password`) VALUES
(1, 'John Doe', 'johndoe@example.com', '123-456-7890', '2022-01-01', 'Active', 'Credit Card', 'Email', 'passwordJohn'),
(2, 'Jane Smith', 'janesmith@example.com', '098-765-4321', '2022-06-15', 'Inactive', 'PayPal', 'SMS', 'passwordJane'),
(3, 'Emily Clark', 'emilyclark@example.com', '321-654-9870', '2022-02-01', 'Active', 'Debit Card', 'Email', 'passwordEmily'),
(4, 'Michael Brown', 'michaelbrown@example.com', '654-321-0987', '2022-03-01', 'Active', 'Bank Transfer', 'Phone', 'passwordMichael'),
(5, 'Olivia Green', 'oliviagreen@example.com', '987-654-3210', '2022-04-01', 'Inactive', 'Cash', 'SMS', 'passwordOlivia');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `member_id`, `payment_date`, `amount`, `payment_method`, `status`) VALUES
(1, 1, '2022-01-02', 100, 'Credit Card', 'Completed'),
(2, 2, '2022-06-16', 50, 'PayPal', 'Pending'),
(3, 3, '2022-02-02', 75, 'Debit Card', 'Completed'),
(4, 4, '2022-03-02', 80, 'Bank Transfer', 'Completed'),
(5, 5, '2022-04-02', 65, 'Cash', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `personal_training_session`
--

CREATE TABLE `personal_training_session` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `trainer` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_training_session`
--

INSERT INTO `personal_training_session` (`id`, `member_id`, `trainer`, `start_time`, `end_time`) VALUES
(201, 1, 'Carol White', '2022-01-12 10:00:00', '2022-01-12 11:00:00'),
(202, 2, 'Dave Black', '2022-06-18 16:00:00', '2022-06-18 17:00:00'),
(203, 3, 'Gina Blue', '2022-02-20 09:00:00', '2022-02-20 10:00:00'),
(204, 4, 'Hank Green', '2022-03-21 17:00:00', '2022-03-21 18:00:00'),
(205, 5, 'Ivy Gold', '2022-04-22 12:00:00', '2022-04-22 13:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_reservation`
--
ALTER TABLE `facility_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `personal_training_session`
--
ALTER TABLE `personal_training_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `personal_training_session`
--
ALTER TABLE `personal_training_session`
  ADD CONSTRAINT `personal_training_session_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
