-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 04:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_no`) VALUES
(11, '1112'),
(14, '3882'),
(29, '38821'),
(30, '2131'),
(31, '3212'),
(33, '2324'),
(35, '1212'),
(36, '1234'),
(37, '788778'),
(38, '11223'),
(39, '89898'),
(40, '123'),
(41, '456'),
(42, '3312'),
(43, '8989'),
(44, '776');

-- --------------------------------------------------------

--
-- Table structure for table `added_book`
--

CREATE TABLE `added_book` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `added_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `user_id`, `login_time`, `logout_time`) VALUES
(1, 2208, '2023-04-30 23:23:27', NULL),
(3, 2208, '2023-05-01 00:32:38', NULL),
(5, 2208, '2023-05-01 00:55:53', NULL),
(7, 2208, '2023-05-01 01:09:51', NULL),
(9, 2208, '2023-05-01 16:11:38', NULL),
(10, 2208, '2023-05-01 16:11:57', NULL),
(11, 12345, '2023-05-01 19:12:39', NULL),
(12, 2208, '2023-05-01 23:10:54', NULL),
(13, 2208, '2023-05-03 03:24:08', NULL),
(14, 12345, '2023-05-03 04:07:44', NULL),
(16, 2208, '2023-05-14 00:36:58', NULL),
(18, 8888, '2023-05-14 00:37:19', NULL),
(19, 8888, '2023-05-14 00:37:23', NULL),
(20, 12345, '2023-05-14 00:37:27', NULL),
(21, 2208, '2023-05-20 00:52:30', NULL),
(22, 12345, '2023-05-20 00:52:36', NULL),
(23, 2208, '2023-05-20 00:52:41', NULL),
(24, 2208, '2023-05-21 17:26:12', NULL),
(26, 12345, '2023-05-21 17:26:28', NULL),
(27, 2208, '2023-05-27 14:02:39', NULL),
(28, 117, '2023-05-27 14:02:51', NULL),
(29, 117, '2023-05-27 14:03:00', NULL),
(30, 2208, '2023-05-27 14:03:23', NULL),
(31, 12345, '2023-05-27 14:03:27', NULL),
(32, 117, '2023-05-27 14:03:44', NULL),
(33, 867, '2023-05-27 14:04:12', NULL),
(34, 2208, '2023-05-27 14:05:28', NULL),
(35, 8888, '2023-05-27 14:05:49', NULL),
(36, 2208, '2023-05-30 01:50:51', NULL),
(37, 117, '2023-05-30 01:50:53', NULL),
(38, 12345, '2023-05-30 01:51:01', NULL),
(39, 12345, '2023-05-30 01:51:06', NULL),
(40, 117, '2023-05-30 01:51:18', NULL),
(41, 2208, '2023-05-30 01:51:36', NULL),
(42, 2208, '2023-05-30 01:51:46', NULL),
(43, 2208, '2023-06-01 00:54:30', NULL),
(45, 2208, '2023-06-04 22:10:38', NULL),
(46, 9, '2023-06-04 22:10:45', NULL),
(47, 8, '2023-06-04 22:10:52', NULL),
(48, 117, '2023-06-04 22:10:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`) VALUES
(53, 'John David'),
(54, 'Anthony'),
(55, 'Rheneil C'),
(56, 'Angelo V'),
(57, 'Angelo C'),
(58, 'Rheyneil C');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `no_copies` int(11) NOT NULL DEFAULT 0,
  `no_cd_copy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `title`, `year`, `no_copies`, `no_cd_copy`) VALUES
(29, 'Data', 2003, 7, 2),
(30, 'Frequency', 2009, 4, 3),
(31, 'Data 2.4', 2003, 12, 22),
(32, 'Data 5.2', 20012, 10, 32),
(33, 'Frequency', 2007, 33, 232);

-- --------------------------------------------------------

--
-- Table structure for table `book_accounts`
--

CREATE TABLE `book_accounts` (
  `book_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_accounts`
--

INSERT INTO `book_accounts` (`book_id`, `account_id`) VALUES
(29, 40),
(29, 30),
(29, 41),
(30, 42),
(30, 43),
(30, 44),
(31, 42),
(31, 43),
(31, 44),
(32, 40),
(32, 30),
(32, 41),
(33, 42),
(33, 43),
(33, 44);

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `book_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`book_id`, `author_id`) VALUES
(29, 53),
(30, 53),
(31, 58),
(31, 57),
(32, 56),
(33, 57),
(33, 56);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_id`, `category_id`) VALUES
(29, 26),
(30, 23),
(30, 26),
(31, 26),
(32, 24),
(33, 26);

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `borrowing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkout_date` date NOT NULL,
  `duedate` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`borrowing_id`, `user_id`, `checkout_date`, `duedate`, `return_date`, `book_id`) VALUES
(110, 2208, '2023-06-03', '2023-06-09', '2023-06-03', 29),
(111, 2208, '2023-06-03', '2023-06-04', '2023-06-04', 29),
(112, 2208, '2023-06-03', '2023-06-04', '2023-06-04', 29),
(113, 2208, '2023-06-04', '2023-06-09', NULL, 29),
(114, 2208, '2023-06-04', '2023-06-09', NULL, 29),
(115, 2208, '2023-06-04', '2023-06-05', NULL, 29),
(116, 2208, '2023-06-04', '2023-06-06', '2023-06-04', 29),
(117, 2208, '2023-06-04', '2023-06-05', '2023-06-04', 29),
(118, 12345678, '2023-06-04', '2023-06-14', '2023-06-04', 29),
(119, 12345678, '2023-06-04', '2023-06-14', NULL, 29),
(120, 2208, '2023-06-04', '2023-06-03', NULL, 29),
(121, 117, '2023-06-04', '2023-06-05', NULL, 29),
(122, 2208, '2023-06-04', '2023-06-05', NULL, 29),
(123, 2208, '2023-06-04', '2023-06-05', NULL, 32),
(124, 2208, '2023-06-04', '2023-06-05', NULL, 32),
(125, 9, '2023-06-04', '2023-06-05', '2023-06-04', 30),
(126, 10, '2023-06-04', '2023-06-05', NULL, 31),
(127, 10, '2023-06-04', '2023-06-05', '2023-06-04', 33),
(128, 909, '2023-06-04', '2023-06-05', '2023-06-04', 30),
(129, 2208, '2023-06-04', '2023-06-05', '2023-06-04', 31),
(130, 2208, '2023-06-04', '2023-06-05', '2023-06-04', 29),
(131, 8080, '2023-06-04', '2023-06-05', '2023-06-04', 31),
(132, 12345, '2023-06-04', '2023-06-05', '2023-06-04', 30);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request`
--

CREATE TABLE `borrow_request` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requested_date` date DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `added` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_request`
--

INSERT INTO `borrow_request` (`book_id`, `user_id`, `requested_date`, `req_id`, `added`) VALUES
(29, 2208, '2023-06-03', 7, 1),
(29, 2208, '2023-06-03', 8, 1),
(29, 12345678, '2023-06-04', 9, 0),
(29, 12345678, '2023-06-04', 10, 0),
(30, 9, '2023-06-04', 11, 1),
(31, 9, '2023-06-04', 12, 0),
(31, 10, '2023-06-04', 13, 1),
(33, 10, '2023-06-04', 14, 1),
(30, 909, '2023-06-04', 15, 1),
(29, 909, '2023-06-04', 16, 0),
(31, 2208, '2023-06-04', 17, 1),
(32, 2208, '2023-06-04', 18, 0),
(29, 12345, '2023-06-04', 19, 0),
(30, 12345, '2023-06-04', 20, 1),
(31, 8080, '2023-06-04', 21, 1),
(32, 8080, '2023-06-04', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(23, 'Fiction'),
(24, 'History'),
(25, 'Magic'),
(26, 'Science'),
(27, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`) VALUES
(1, 'BSCS'),
(2, 'BSIT'),
(3, 'BSCPE'),
(4, 'ACT'),
(5, 'BAPS'),
(6, 'BSA'),
(7, 'BSBA-MFM'),
(8, 'BSAIS'),
(9, 'BSBA-MHRM'),
(10, 'BSE'),
(11, 'BEEd-MGE'),
(12, 'BEEd-ME'),
(13, 'BSE-MF'),
(14, 'BSE-ME'),
(15, 'BSN'),
(16, 'BSHM');

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `librarian_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`librarian_id`, `username`, `first_name`, `last_name`, `password`, `email`, `phone_number`) VALUES
(123, 'Dabid', 'John David', 'Capuyan', 'Dabid', 'johndavid.capuyan@wlcormoc.edu.ph', NULL),
(178, 'Rneil', 'Rheynil', 'Calderon', 'Rheynil69', 'reynilcalderon69@gmail.com', '0969696969'),
(2208, 'jejo123', 'Jejomar', 'Parrilla', 'Jejomar09', 'jpar1252003@gmail.com', '09073010472');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `notification_type` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `book_id`, `notification_type`, `created_at`) VALUES
(1, 2208, 29, 1, '2023-06-04 00:00:00'),
(2, 2208, 29, 1, '2023-06-04 04:23:46'),
(3, 117, 29, 0, '2023-06-04 04:25:06'),
(4, 2208, 29, 1, '2023-06-04 04:30:13'),
(5, 2208, 32, 0, '2023-06-04 15:47:38'),
(6, 2208, 32, 0, '2023-06-04 15:47:42'),
(7, 9, 30, 0, '2023-06-04 15:59:05'),
(8, 10, 31, 0, '2023-06-04 16:00:37'),
(9, 10, 33, 0, '2023-06-04 16:01:00'),
(10, 909, 30, 0, '2023-06-04 16:02:39'),
(11, 2208, 31, 0, '2023-06-04 16:03:48'),
(12, 2208, 29, 1, '2023-06-04 17:09:27'),
(13, 8080, 31, 0, '2023-06-04 17:42:42'),
(14, 12345, 30, 0, '2023-06-04 17:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `first_name`, `last_name`, `year`, `password`, `username`) VALUES
(8, 'johnmarlou.martinez@wlcormoc.edu.ph', 'John Marlou', 'Martinez', 2, '12345', 'JohnMar'),
(9, 'jewel.binueza@wlcormoc.edu.ph', 'Jewel', 'Binueza', 2, 'Abcd1234', 'Jewel'),
(10, 'sammer.sanchez@wlcormoc.edu.ph', 'Sammer', 'Sanchez', 2, 'Abcd1234', 'Sammer'),
(117, 'reynilcadlderon@gmail.com', 'Rheynil', 'Calderon', 3, 'palau123', 'RheyneilPalaUt'),
(867, 'johndavid.capuyan@wlcormoc.edu.ph', 'John David', 'Capuyan', 4, '213', 'JhD'),
(909, 'jheramay.binggoy@wlcormoc.edu.ph', 'Jhera May', 'Binggoy', 2, 'Jhera123', 'Jhera'),
(2208, 'jejomar.parrilla@wlcormoc.edu.ph', 'Jejomar', 'Parrilla', 2, 'Jejomar09', 'jejo123'),
(8080, 'ralphjoseph.rivera@wlcormoc.edu.ph', 'Ralph Joseph', 'Rivera', 3, 'Abcd1234', 'Ralph J'),
(8888, 'johnangelo.vanguardia@wlcormoc.edu.ph', 'John Angelo', 'Vanguardia', 2, 'Abcd1234', 'Angelo'),
(9090, 'jdafafjas@gmail.com', 'fjaka', 'jfklalda', 3, 'password', 'user'),
(12345, 'anthony.capuyan@wlcormoc.edu.ph', 'Anthony', 'Capuyan', 5, 'Capuyan123', 'Anthony'),
(68674, 'jerwin.fajardo@wlcormoc.edu.ph', 'Jerwin', 'Fajardo', 2, 'Jerwin12', 'Jartusok'),
(8080806, 'janu@gmail.com', 'San Juan', 'Jr', 3, 'Sando', 'SJ '),
(12345678, 'jackielou.gonzales@wlcormoc.edu.ph', 'Jackie Lou', 'Gonzaga', 2, 'Abcd1234', 'jackie123');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`user_id`, `course_id`) VALUES
(2208, 1),
(12345, 2),
(867, 2),
(68674, 2),
(8888, 2),
(8, 16),
(117, 1),
(12345678, 1),
(909, 1),
(8080, 2),
(9, 16),
(10, 1),
(8080806, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `added_book`
--
ALTER TABLE `added_book`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `fk_user_attendance` (`user_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_id` (`book_id`);

--
-- Indexes for table `book_accounts`
--
ALTER TABLE `book_accounts`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrow_request`
--
ALTER TABLE `borrow_request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`librarian_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `librarian_id` (`librarian_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `borrow_request`
--
ALTER TABLE `borrow_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added_book`
--
ALTER TABLE `added_book`
  ADD CONSTRAINT `added_book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `added_book_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_user_attendance` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `book_accounts`
--
ALTER TABLE `book_accounts`
  ADD CONSTRAINT `book_accounts_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `book_accounts_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `book_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `borrow_request`
--
ALTER TABLE `borrow_request`
  ADD CONSTRAINT `borrow_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `borrow_request_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `borrow_request_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `borrow_request_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `user_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
