-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2018 at 09:03 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `s_id` varchar(40) NOT NULL,
  `e_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `s_id`, `e_id`, `status`, `date`, `month`, `year`) VALUES
(70, 'ID201891001', 10, 0, 3, 6, 2018),
(71, 'ID201891002', 10, 1, 3, 6, 2018),
(72, 'ID201891003', 10, 0, 3, 6, 2018),
(73, 'ID201891004', 10, 0, 3, 6, 2018),
(74, 'ID201891005', 10, 1, 3, 6, 2018),
(75, 'ID201891006', 10, 0, 3, 6, 2018),
(82, 'ID201891001', 10, 1, 1, 6, 2018),
(83, 'ID201891002', 10, 1, 1, 6, 2018),
(84, 'ID201891003', 10, 0, 1, 6, 2018),
(85, 'ID201891004', 10, 1, 1, 6, 2018),
(86, 'ID201891005', 10, 1, 1, 6, 2018),
(87, 'ID201891006', 10, 1, 1, 6, 2018),
(88, 'ID201891001', 10, 1, 29, 6, 2018),
(89, 'ID201891002', 10, 1, 29, 6, 2018),
(90, 'ID201891003', 10, 0, 29, 6, 2018),
(91, 'ID201891004', 10, 0, 29, 6, 2018),
(92, 'ID201891005', 10, 1, 29, 6, 2018),
(93, 'ID201891006', 10, 1, 29, 6, 2018),
(94, 'ID201891001', 10, 0, 4, 6, 2018),
(95, 'ID201891002', 10, 0, 4, 6, 2018),
(96, 'ID201891003', 10, 1, 4, 6, 2018),
(97, 'ID201891004', 10, 1, 4, 6, 2018),
(98, 'ID201891005', 10, 0, 4, 6, 2018),
(99, 'ID201891006', 10, 1, 4, 6, 2018),
(100, 'ID201891001', 10, 1, 3, 6, 2018),
(101, 'ID201891002', 10, 0, 3, 6, 2018),
(102, 'ID201891003', 10, 1, 3, 6, 2018),
(103, 'ID201891004', 10, 1, 3, 6, 2018),
(104, 'ID201891005', 10, 1, 3, 6, 2018),
(105, 'ID201891006', 10, 1, 3, 6, 2018),
(106, 'ID201891001', 10, 1, 2, 6, 2018),
(107, 'ID201891002', 10, 1, 2, 6, 2018),
(108, 'ID201891003', 10, 0, 2, 6, 2018),
(109, 'ID201891004', 10, 0, 2, 6, 2018),
(110, 'ID201891005', 10, 1, 2, 6, 2018),
(111, 'ID201891006', 10, 1, 2, 6, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `batchnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batchnumber`) VALUES
(1, 2016),
(2, 2017),
(3, 2018),
(4, 2014);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `e_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `class` int(11) NOT NULL,
  `section` varchar(5) NOT NULL,
  `d_group` varchar(20) NOT NULL,
  `batchnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`e_id`, `t_id`, `sub_name`, `class`, `section`, `d_group`, `batchnumber`) VALUES
(6, 18, 'chemistry', 9, 'E', 'Commerce', 2002),
(7, 17, 'Social Science', 8, 'D', 'Commerce', 2001),
(8, 19, 'chemistry', 6, 'C', 'Science', 2001),
(9, 19, 'Social Science', 3, 'D', 'Commerce', 2018),
(10, 17, 'Physics', 9, 'A', 'Science', 2018),
(11, 21, 'Social Science', 9, 'A', 'Science', 2018),
(12, 17, 'Physics', 5, 'A', 'General', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `notice_title` varchar(100) NOT NULL,
  `notice` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice_title`, `notice`, `date`) VALUES
(3, 'hello', 'a.jpg', '2018-06-05 15:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `enroll_id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `term` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `enroll_id`, `student_id`, `term`, `mark`, `grade`) VALUES
(50, 10, 'ID201891001', 1, 10, 'F'),
(51, 10, 'ID201891002', 1, 50, 'B'),
(52, 10, 'ID201891003', 1, 60, 'A-'),
(53, 10, 'ID201891004', 1, 55, 'B'),
(54, 10, 'ID201891005', 1, 73, 'A'),
(55, 10, 'ID201891006', 1, 33, 'D'),
(56, 10, 'ID201891001', 3, 80, 'A+'),
(57, 10, 'ID201891002', 3, 70, 'A'),
(58, 10, 'ID201891003', 3, 43, 'C'),
(59, 10, 'ID201891004', 3, 55, 'B'),
(60, 10, 'ID201891005', 3, 80, 'A+'),
(61, 10, 'ID201891006', 3, 50, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `slide_title` varchar(100) NOT NULL,
  `slide` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slide_title`, `slide`) VALUES
(1, 'Hello', 'chicago.jpg'),
(4, 'fsd', 'ny.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_password` varchar(20) NOT NULL,
  `s_class` varchar(20) NOT NULL,
  `s_group` varchar(20) NOT NULL,
  `s_section` varchar(20) NOT NULL,
  `s_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `s_id`, `s_name`, `s_password`, `s_class`, `s_group`, `s_section`, `s_batch`) VALUES
(10, 'ID201891001', 'Hanif Chowdhury', '1234', '9', 'Science', 'A', 2018),
(11, 'ID201891002', 'Rakib Rahman', '1234', '9', 'Science', 'A', 2018),
(12, 'ID201891003', 'Imran Hossian', '1234', '9', 'Science', 'A', 2018),
(13, 'ID201891004', 'Akhi Akter ', '1234', '9', 'Science', 'A', 2018),
(14, 'ID201891005', 'Nazmul Hossain', '1234', '9', 'Science', 'A', 2018),
(15, 'ID201891006', 'Eva Sultana', '1234', '9', 'Science', 'A', 2018),
(16, 'ID201851001', 'Nabil Rahman', '1234', '5', 'General', 'A', 2018),
(17, 'ID201851007', 'Ayman Sadiq', '1234', '5', 'General', 'A', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `sub_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `sub_name`, `sub_code`, `sub_class`) VALUES
(1, 'Math', '', 9),
(2, 'Social Science', '', 7),
(4, 'Physics', '', 10),
(5, 'Chemistry', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `t_name` varchar(50) NOT NULL,
  `t_image` text NOT NULL,
  `t_email` varchar(100) NOT NULL,
  `t_phone` varchar(20) NOT NULL,
  `t_id` varchar(50) NOT NULL,
  `t_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `t_name`, `t_image`, `t_email`, `t_phone`, `t_id`, `t_password`) VALUES
(16, 'Eve Gandani', 'eva.jpg', 'abul@yahoo.com', '123', 'ID124501', '1234'),
(17, 'Gavin Belson', 'andro.JPG', 'gavin@gmail.com', '256234624', 'ID124506', '1234'),
(18, 'Andro Malik', 'gavinbelson.jpg', 'andro@gmail.com', '2353246', 'ID124505', '1234'),
(19, 'Monika Hamlon', 'amina.jpg', 'moknika@yahoo.com', '01713250355', 'ID124507', '1234'),
(21, 'Hasnat Jannatul', 'samasa.jpg', 'hasnat@gamilc.om', '0124513523', 'ID124502', '1234'),
(22, 'Justin trudeau', 'justin.jpg', 'justin@gmail.com', '023567', 'ID124503', '1234'),
(23, 'Donald Gilfoy', 'gilfoy.jpg', 'gilfoy@yahoo.com', '0174937484', 'ID124504', '1234'),
(24, 'Ahey Man', 'andro.JPG', 'ahey@gmail.com', '35325', 'ID124534', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
